<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بارگذاری جی‌دی‌اف برای تاریخ شمسی
require_once '../includes/jdf.php';

// پردازش تغییر وضعیت ثبت‌نام
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $registration_id = intval($_POST['registration_id']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $notes = mysqli_real_escape_string($db, $_POST['notes'] ?? '');
    
    $query = "UPDATE registrations SET registration_status = '$status', special_notes = '$notes' WHERE registration_id = $registration_id";
    
    if (mysqli_query($db, $query)) {
        // دریافت اطلاعات دانش‌آموز برای لاگ
        $student = mysqli_fetch_assoc(mysqli_query($db, "
            SELECT s.first_name, s.last_name 
            FROM registrations r
            JOIN students s ON r.student_id = s.student_id
            WHERE r.registration_id = $registration_id
        "));
        
        // تعیین متن وضعیت برای لاگ
        $status_text = '';
        switch ($status) {
            case 'pending':
                $status_text = 'در انتظار بررسی';
                break;
            case 'approved':
                $status_text = 'تأیید شده';
                break;
            case 'rejected':
                $status_text = 'رد شده';
                break;
        }
        
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "وضعیت ثبت‌نام دانش‌آموز {$student['first_name']} {$student['last_name']} به $status_text تغییر کرد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_registration_status', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">وضعیت ثبت‌نام با موفقیت بروزرسانی شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در بروزرسانی وضعیت ثبت‌نام: ' . mysqli_error($db) . '</div>';
    }
}

// فیلترها
$where_clauses = [];
$params = [];

// فیلتر وضعیت ثبت‌نام
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = mysqli_real_escape_string($db, $_GET['status']);
    $where_clauses[] = "r.registration_status = '$status'";
    $params[] = "status=" . urlencode($status);
}

// فیلتر پایه تحصیلی
if (isset($_GET['grade']) && !empty($_GET['grade'])) {
    $grade = intval($_GET['grade']);
    $where_clauses[] = "s.academic_grade = $grade";
    $params[] = "grade=$grade";
}

// جستجو
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    $where_clauses[] = "(s.first_name LIKE '%$search%' OR s.last_name LIKE '%$search%' OR s.national_id LIKE '%$search%' OR s.passport_number LIKE '%$search%')";
    $params[] = "search=" . urlencode($search);
}

// ساخت جمله WHERE
$where_clause = '';
if (!empty($where_clauses)) {
    $where_clause = " WHERE " . implode(" AND ", $where_clauses);
} else {
    // در صورت نبود فیلتر، پیش‌فرض فقط موارد در انتظار نمایش داده شود
    $where_clause = " WHERE r.registration_status = 'pending'";
}

// ساخت query string برای پیجینیشن
$query_string = '';
if (!empty($params)) {
    $query_string = '&' . implode('&', $params);
}

// تنظیمات پیجینیشن
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// کوئری ثبت‌نام‌ها
$query = "
    SELECT r.*, s.first_name, s.last_name, s.father_name, s.academic_grade, s.major, s.nationality, s.profile_photo_path
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    $where_clause
    ORDER BY r.registration_date DESC
    LIMIT $offset, $limit
";
$result = mysqli_query($db, $query);

// محاسبه تعداد کل رکوردها برای پیجینیشن
$count_query = "
    SELECT COUNT(*) as total
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    $where_clause
";
$count_result = mysqli_query($db, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_pages = ceil($count_row['total'] / $limit);

// آمار کلی وضعیت ثبت‌نام‌ها
$stats_query = "
    SELECT 
        COUNT(*) as total_count,
        SUM(CASE WHEN r.registration_status = 'pending' THEN 1 ELSE 0 END) as pending_count,
        SUM(CASE WHEN r.registration_status = 'approved' THEN 1 ELSE 0 END) as approved_count,
        SUM(CASE WHEN r.registration_status = 'rejected' THEN 1 ELSE 0 END) as rejected_count
    FROM registrations r
";
$stats_result = mysqli_query($db, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);

// گرفتن لیست پایه‌های تحصیلی
$grades_query = mysqli_query($db, "SELECT * FROM academic_grades ORDER BY grade_number");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت ثبت‌نام‌ها - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php echo $message; ?>
            
            <!-- آمار خلاصه -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">کل ثبت‌نام‌ها</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['total_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-clipboard-list text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">در انتظار بررسی</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['pending_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="fas fa-hourglass-half text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">تأیید شده</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['approved_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fas fa-check text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">رد شده</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['rejected_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="fas fa-times text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- فیلترها -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>جستجو و فیلتر</h6>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search">جستجو</label>
                                            <input type="text" class="form-control" id="search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="نام، نام خانوادگی، کد ملی یا شماره پاسپورت">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">وضعیت ثبت‌نام</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="">همه وضعیت‌ها</option>
                                                <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''; ?>>در انتظار بررسی</option>
                                                <option value="approved" <?php echo (isset($_GET['status']) && $_GET['status'] == 'approved') ? 'selected' : ''; ?>>تأیید شده</option>
                                                <option value="rejected" <?php echo (isset($_GET['status']) && $_GET['status'] == 'rejected') ? 'selected' : ''; ?>>رد شده</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="grade">پایه تحصیلی</label>
                                            <select class="form-select" id="grade" name="grade">
                                                <option value="">همه پایه‌ها</option>
                                                <?php mysqli_data_seek($grades_query, 0); ?>
                                                <?php while($grade = mysqli_fetch_assoc($grades_query)): ?>
                                                    <option value="<?php echo $grade['grade_number']; ?>" <?php echo (isset($_GET['grade']) && $_GET['grade'] == $grade['grade_number']) ? 'selected' : ''; ?>>
                                                        <?php echo $grade['grade_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 d-flex align-items-end">
                                        <div class="form-group w-100">
                                            <button type="submit" class="btn btn-primary w-100">اعمال فیلترها</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- لیست ثبت‌نام‌ها -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>لیست ثبت‌نام‌های دانش‌آموزان</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دانش‌آموز</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">پایه تحصیلی</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نام پدر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاریخ ثبت‌نام</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while($registration = mysqli_fetch_assoc($result)): 
                                                // تبدیل تاریخ ثبت‌نام میلادی به شمسی
                                                $reg_date = $registration['registration_date'];
                                                $gregorian_date = date('Y-m-d', strtotime($reg_date));
                                                list($gy, $gm, $gd) = explode('-', $gregorian_date);
                                                list($jy, $jm, $jd) = gregorian_to_jalali($gy, $gm, $gd);
                                                $jalali_date = $jy . '/' . sprintf('%02d', $jm) . '/' . sprintf('%02d', $jd);
                                                $reg_time = date('H:i', strtotime($reg_date));
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <?php if (!empty($registration['profile_photo_path']) && file_exists($registration['profile_photo_path'])): ?>
                                                                <div>
                                                                    <img src="<?php echo $registration['profile_photo_path']; ?>" class="avatar avatar-sm me-3" alt="user image">
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo $registration['first_name'] . ' ' . $registration['last_name']; ?></h6>
                                                                <p class="text-xs text-secondary mb-0"><?php echo $registration['nationality']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            پایه <?php echo $registration['academic_grade']; ?>
                                                            <?php if (!empty($registration['major'])): ?>
                                                                - <?php echo $registration['major']; ?>
                                                            <?php endif; ?>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $registration['father_name']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $jalali_date; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $reg_time; ?></p>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if ($registration['registration_status'] == 'pending') {
                                                            echo '<span class="badge badge-sm bg-gradient-warning">در انتظار بررسی</span>';
                                                        } elseif ($registration['registration_status'] == 'approved') {
                                                            echo '<span class="badge badge-sm bg-gradient-success">تأیید شده</span>';
                                                        } elseif ($registration['registration_status'] == 'rejected') {
                                                            echo '<span class="badge badge-sm bg-gradient-danger">رد شده</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="view.php?id=<?php echo $registration['student_id']; ?>" class="btn btn-sm btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View user">
                                                            <i class="fas fa-eye"></i> مشاهده
                                                        </a>
                                                        <button 
                                                            class="btn btn-sm btn-primary change-status"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#statusModal"
                                                            data-id="<?php echo $registration['registration_id']; ?>"
                                                            data-status="<?php echo $registration['registration_status']; ?>"
                                                            data-notes="<?php echo htmlspecialchars($registration['special_notes']); ?>"
                                                            data-name="<?php echo $registration['first_name'] . ' ' . $registration['last_name']; ?>">
                                                            <i class="fas fa-edit"></i> تغییر وضعیت
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">هیچ ثبت‌نامی یافت نشد.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- پیجینیشن -->
                            <?php if($total_pages > 1): ?>
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php if($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo $query_string; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?><?php echo $query_string; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        
                                        <?php if($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo $query_string; ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <!-- مودال تغییر وضعیت -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">تغییر وضعیت ثبت‌نام</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" name="registration_id" id="registration_id">
                        
                        <div class="form-group">
                            <label for="student_name">دانش‌آموز</label>
                            <input type="text" class="form-control" id="student_name" readonly>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="status">وضعیت جدید</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending">در انتظار بررسی</option>
                                <option value="approved">تأیید شده</option>
                                <option value="rejected">رد شده</option>
                            </select>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="notes">یادداشت/توضیحات</label>
                            <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" name="update_status" class="btn btn-primary">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // پر کردن اطلاعات مودال
        document.addEventListener('DOMContentLoaded', function() {
            const statusModal = document.getElementById('statusModal');
            
            if (statusModal) {
                statusModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    
                    // دریافت اطلاعات از دکمه
                    const id = button.getAttribute('data-id');
                    const status = button.getAttribute('data-status');
                    const notes = button.getAttribute('data-notes');
                    const name = button.getAttribute('data-name');
                    
                    // تنظیم مقادیر در مودال
                    document.getElementById('registration_id').value = id;
                    document.getElementById('student_name').value = name;
                    document.getElementById('status').value = status;
                    document.getElementById('notes').value = notes;
                });
            }
        });
    </script>
</body>
</html>