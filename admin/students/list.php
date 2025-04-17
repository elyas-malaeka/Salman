<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بارگذاری جی‌دی‌اف برای تاریخ شمسی
require_once '../includes/jdf.php';

// فیلترها
$where_clauses = [];
$params = [];

// فیلتر پایه تحصیلی
if (isset($_GET['grade']) && !empty($_GET['grade'])) {
    $grade = intval($_GET['grade']);
    $where_clauses[] = "s.academic_grade = $grade";
    $params[] = "grade=$grade";
}

// فیلتر ملیت
if (isset($_GET['nationality']) && !empty($_GET['nationality'])) {
    $nationality = mysqli_real_escape_string($db, $_GET['nationality']);
    $where_clauses[] = "s.nationality = '$nationality'";
    $params[] = "nationality=" . urlencode($nationality);
}

// فیلتر وضعیت ثبت‌نام
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = mysqli_real_escape_string($db, $_GET['status']);
    $where_clauses[] = "r.registration_status = '$status'";
    $params[] = "status=" . urlencode($status);
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

// کوئری دانش‌آموزان
$query = "
    SELECT s.*, r.registration_status, r.registration_date
    FROM students s
    LEFT JOIN registrations r ON s.student_id = r.student_id
    $where_clause
    ORDER BY s.student_id DESC
    LIMIT $offset, $limit
";
$result = mysqli_query($db, $query);

// محاسبه تعداد کل رکوردها برای پیجینیشن
$count_query = "
    SELECT COUNT(*) as total
    FROM students s
    LEFT JOIN registrations r ON s.student_id = r.student_id
    $where_clause
";
$count_result = mysqli_query($db, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_pages = ceil($count_row['total'] / $limit);

// آمار کلی
$stats_query = "
    SELECT 
        COUNT(*) as total_count,
        SUM(CASE WHEN r.registration_status = 'pending' THEN 1 ELSE 0 END) as pending_count,
        SUM(CASE WHEN r.registration_status = 'approved' THEN 1 ELSE 0 END) as approved_count,
        SUM(CASE WHEN r.registration_status = 'rejected' THEN 1 ELSE 0 END) as rejected_count,
        SUM(CASE WHEN s.academic_grade BETWEEN 1 AND 6 THEN 1 ELSE 0 END) as elementary_count,
        SUM(CASE WHEN s.academic_grade BETWEEN 7 AND 9 THEN 1 ELSE 0 END) as middle_count,
        SUM(CASE WHEN s.academic_grade BETWEEN 10 AND 12 THEN 1 ELSE 0 END) as high_count
    FROM students s
    LEFT JOIN registrations r ON s.student_id = r.student_id
    $where_clause
";
$stats_result = mysqli_query($db, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);

// گرفتن لیست پایه‌های تحصیلی
$grades_query = mysqli_query($db, "SELECT * FROM academic_grades ORDER BY grade_number");

// گرفتن لیست ملیت‌ها
$nationalities_query = mysqli_query($db, "SELECT DISTINCT nationality FROM students ORDER BY nationality");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست دانش‌آموزان - مجتمع آموزشی سلمان</title>
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
            <!-- آمار خلاصه -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">کل دانش‌آموزان</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['total_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-users text-lg opacity-10"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">در انتظار تأیید</p>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">دبستان</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['elementary_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fas fa-child text-lg opacity-10"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">متوسطه</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['middle_count'] + $stats['high_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                        <i class="fas fa-user-graduate text-lg opacity-10"></i>
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
                                            <label for="grade">پایه تحصیلی</label>
                                            <select class="form-select" id="grade" name="grade">
                                                <option value="">همه پایه‌ها</option>
                                                <?php while($grade = mysqli_fetch_assoc($grades_query)): ?>
                                                    <option value="<?php echo $grade['grade_number']; ?>" <?php echo (isset($_GET['grade']) && $_GET['grade'] == $grade['grade_number']) ? 'selected' : ''; ?>>
                                                        <?php echo $grade['grade_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nationality">ملیت</label>
                                            <select class="form-select" id="nationality" name="nationality">
                                                <option value="">همه ملیت‌ها</option>
                                                <?php while($nationality = mysqli_fetch_assoc($nationalities_query)): ?>
                                                    <option value="<?php echo $nationality['nationality']; ?>" <?php echo (isset($_GET['nationality']) && $_GET['nationality'] == $nationality['nationality']) ? 'selected' : ''; ?>>
                                                        <?php echo $nationality['nationality']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
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
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">اعمال فیلترها</button>
                                        <a href="list.php" class="btn btn-secondary">حذف فیلترها</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- لیست دانش‌آموزان -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>لیست دانش‌آموزان</h6>
                            <a href="view.php?new=1" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i> افزودن دانش‌آموز جدید
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دانش‌آموز</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">پایه تحصیلی</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ملیت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاریخ تولد</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت ثبت‌نام</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while($student = mysqli_fetch_assoc($result)): 
                                                // تبدیل تاریخ تولد میلادی به شمسی
                                                $birthdate = $student['birthdate'];
                                                $gregorian_date = date('Y-m-d', strtotime($birthdate));
                                                list($gy, $gm, $gd) = explode('-', $gregorian_date);
                                                list($jy, $jm, $jd) = gregorian_to_jalali($gy, $gm, $gd);
                                                $jalali_birthdate = $jy . '/' . sprintf('%02d', $jm) . '/' . sprintf('%02d', $jd);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <?php if (!empty($student['profile_photo_path']) && file_exists($student['profile_photo_path'])): ?>
                                                                <div>
                                                                    <img src="<?php echo $student['profile_photo_path']; ?>" class="avatar avatar-sm me-3" alt="user image">
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h6>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    <?php 
                                                                    if (!empty($student['national_id'])) {
                                                                        echo 'کد ملی: ' . $student['national_id'];
                                                                    } elseif (!empty($student['passport_number'])) {
                                                                        echo 'شماره پاسپورت: ' . $student['passport_number'];
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            پایه <?php echo $student['academic_grade']; ?>
                                                            <?php if (!empty($student['major'])): ?>
                                                                - <?php echo $student['major']; ?>
                                                            <?php endif; ?>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $student['nationality']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $jalali_birthdate; ?></p>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if ($student['registration_status'] == 'pending') {
                                                            echo '<span class="badge badge-sm bg-gradient-warning">در انتظار بررسی</span>';
                                                        } elseif ($student['registration_status'] == 'approved') {
                                                            echo '<span class="badge badge-sm bg-gradient-success">تأیید شده</span>';
                                                        } elseif ($student['registration_status'] == 'rejected') {
                                                            echo '<span class="badge badge-sm bg-gradient-danger">رد شده</span>';
                                                        } else {
                                                            echo '<span class="badge badge-sm bg-gradient-secondary">نامشخص</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="view.php?id=<?php echo $student['student_id']; ?>" class="btn btn-sm btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            <i class="fas fa-eye"></i> مشاهده
                                                        </a>
                                                        <a href="view.php?id=<?php echo $student['student_id']; ?>&edit=1" class="btn btn-sm btn-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            <i class="fas fa-edit"></i> ویرایش
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">هیچ دانش‌آموزی یافت نشد.</td>
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
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
</body>
</html>