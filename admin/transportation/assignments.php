<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// پردازش فرم تخصیص دانش‌آموز به مسیر
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign_student'])) {
    $student_id = intval($_POST['student_id']);
    $route_id = intval($_POST['route_id']);
    $location = mysqli_real_escape_string($db, $_POST['location']);
    
    // بررسی تکراری نبودن
    $check_query = "SELECT * FROM transportation WHERE student_id = $student_id";
    $check_result = mysqli_query($db, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        // بروزرسانی تخصیص موجود
        $update_query = "UPDATE transportation SET route_id = $route_id, location = '$location' WHERE student_id = $student_id";
        if (mysqli_query($db, $update_query)) {
            // ثبت فعالیت در لاگ
            $user_id = $_SESSION['admin_id'] ?? 0;
            
            // دریافت اطلاعات دانش‌آموز و مسیر برای لاگ
            $student = mysqli_fetch_assoc(mysqli_query($db, "SELECT first_name, last_name FROM students WHERE student_id = $student_id"));
            $route = mysqli_fetch_assoc(mysqli_query($db, "SELECT route_name FROM transportation_routes WHERE id = $route_id"));
            
            $action_description = "تخصیص سرویس دانش‌آموز {$student['first_name']} {$student['last_name']} به مسیر {$route['route_name']} بروزرسانی شد";
            mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_transportation', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
            
            $message = '<div class="alert alert-success">تخصیص دانش‌آموز به مسیر با موفقیت بروزرسانی شد.</div>';
        } else {
            $message = '<div class="alert alert-danger">خطا در بروزرسانی تخصیص: ' . mysqli_error($db) . '</div>';
        }
    } else {
        // افزودن تخصیص جدید
        $insert_query = "INSERT INTO transportation (student_id, route_id, location) VALUES ($student_id, $route_id, '$location')";
        if (mysqli_query($db, $insert_query)) {
            // ثبت فعالیت در لاگ
            $user_id = $_SESSION['admin_id'] ?? 0;
            
            // دریافت اطلاعات دانش‌آموز و مسیر برای لاگ
            $student = mysqli_fetch_assoc(mysqli_query($db, "SELECT first_name, last_name FROM students WHERE student_id = $student_id"));
            $route = mysqli_fetch_assoc(mysqli_query($db, "SELECT route_name FROM transportation_routes WHERE id = $route_id"));
            
            $action_description = "دانش‌آموز {$student['first_name']} {$student['last_name']} به مسیر سرویس {$route['route_name']} تخصیص داده شد";
            mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'add_transportation', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
            
            $message = '<div class="alert alert-success">دانش‌آموز با موفقیت به مسیر تخصیص داده شد.</div>';
        } else {
            $message = '<div class="alert alert-danger">خطا در تخصیص دانش‌آموز به مسیر: ' . mysqli_error($db) . '</div>';
        }
    }
}

// حذف تخصیص
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $transportation_id = intval($_GET['delete']);
    
    // دریافت اطلاعات تخصیص برای لاگ
    $transportation = mysqli_fetch_assoc(mysqli_query($db, "
        SELECT t.*, s.first_name, s.last_name, r.route_name 
        FROM transportation t
        JOIN students s ON t.student_id = s.student_id
        JOIN transportation_routes r ON t.route_id = r.id
        WHERE t.transportation_id = $transportation_id
    "));
    
    if ($transportation && mysqli_query($db, "DELETE FROM transportation WHERE transportation_id = $transportation_id")) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "تخصیص دانش‌آموز {$transportation['first_name']} {$transportation['last_name']} از مسیر سرویس {$transportation['route_name']} حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_transportation', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">تخصیص مورد نظر با موفقیت حذف شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در حذف تخصیص: ' . mysqli_error($db) . '</div>';
    }
}

// دریافت لیست مسیرها
$routes_query = mysqli_query($db, "SELECT * FROM transportation_routes WHERE active = 1 ORDER BY city, route_name");

// دریافت لیست دانش‌آموزان
$students_query = mysqli_query($db, "
    SELECT s.student_id, s.first_name, s.last_name, s.academic_grade, s.profile_photo_path
    FROM students s
    LEFT JOIN registrations r ON s.student_id = r.student_id
    WHERE r.registration_status = 'approved' OR r.registration_status IS NULL
    ORDER BY s.last_name, s.first_name
");

// فیلترینگ تخصیص‌ها
$where_clause = '';
$route_filter = '';
if (isset($_GET['route_id']) && is_numeric($_GET['route_id'])) {
    $route_filter = intval($_GET['route_id']);
    $where_clause = " WHERE t.route_id = $route_filter";
}

// جستجوی دانش‌آموز
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    if (!empty($where_clause)) {
        $where_clause .= " AND (s.first_name LIKE '%$search%' OR s.last_name LIKE '%$search%')";
    } else {
        $where_clause = " WHERE s.first_name LIKE '%$search%' OR s.last_name LIKE '%$search%'";
    }
}

// پیجینیشن
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// دریافت لیست تخصیص‌ها
$query = "
    SELECT t.*, s.first_name, s.last_name, s.academic_grade, s.profile_photo_path, 
           r.route_name, r.city, r.route_name_fa, r.city_fa
    FROM transportation t
    JOIN students s ON t.student_id = s.student_id
    JOIN transportation_routes r ON t.route_id = r.id
    $where_clause
    ORDER BY r.city, r.route_name, s.last_name, s.first_name
    LIMIT $offset, $limit
";
$result = mysqli_query($db, $query);

// محاسبه تعداد کل رکوردها برای پیجینیشن
$count_query = "
    SELECT COUNT(*) as total
    FROM transportation t
    JOIN students s ON t.student_id = s.student_id
    JOIN transportation_routes r ON t.route_id = r.id
    $where_clause
";
$count_result = mysqli_query($db, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_pages = ceil($count_row['total'] / $limit);

// آمار تخصیص‌های هر مسیر
$stats_query = "
    SELECT r.id, r.route_name, r.city, COUNT(t.transportation_id) as count
    FROM transportation_routes r
    LEFT JOIN transportation t ON r.id = t.route_id
    WHERE r.active = 1
    GROUP BY r.id
    ORDER BY r.city, r.route_name
";
$stats_result = mysqli_query($db, $stats_query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تخصیص دانش‌آموزان به سرویس - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php echo $message; ?>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>تخصیص دانش‌آموز به مسیر</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="student_id">انتخاب دانش‌آموز <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="student_id" name="student_id" required>
                                        <option value="">-- انتخاب دانش‌آموز --</option>
                                        <?php while($student = mysqli_fetch_assoc($students_query)): ?>
                                            <option value="<?php echo $student['student_id']; ?>">
                                                <?php echo $student['first_name'] . ' ' . $student['last_name'] . ' (پایه ' . $student['academic_grade'] . ')'; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="route_id">انتخاب مسیر <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="route_id" name="route_id" required>
                                        <option value="">-- انتخاب مسیر --</option>
                                        <?php 
                                        $current_city = '';
                                        mysqli_data_seek($routes_query, 0);
                                        while($route = mysqli_fetch_assoc($routes_query)): 
                                            if ($route['city'] != $current_city) {
                                                if ($current_city != '') {
                                                    echo '</optgroup>';
                                                }
                                                echo '<optgroup label="' . $route['city'] . ' - ' . $route['city_fa'] . '">';
                                                $current_city = $route['city'];
                                            }
                                        ?>
                                            <option value="<?php echo $route['id']; ?>">
                                                <?php echo $route['route_name'] . ' (' . $route['route_name_fa'] . ')'; ?>
                                            </option>
                                        <?php 
                                        endwhile;
                                        if ($current_city != '') {
                                            echo '</optgroup>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="location">موقعیت/محل سوار شدن</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="مثال: نزدیک مسجد امام علی">
                                </div>
                                
                                <div class="text-end mt-4">
                                    <button type="submit" name="assign_student" class="btn btn-primary">تخصیص به مسیر</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>آمار مسیرها</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شهر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">مسیر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تعداد دانش‌آموز</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($stat = mysqli_fetch_assoc($stats_result)): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?php echo $stat['city']; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $stat['route_name']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo number_format($stat['count']); ?></p>
                                                </td>
                                                <td>
                                                    <a href="?route_id=<?php echo $stat['id']; ?>" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-filter"></i> فیلتر
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>لیست تخصیص‌های سرویس</h6>
                            <div class="d-flex">
                                <form class="me-2" method="get" action="">
                                    <?php if (!empty($route_filter)): ?>
                                        <input type="hidden" name="route_id" value="<?php echo $route_filter; ?>">
                                    <?php endif; ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="جستجوی دانش‌آموز..." value="<?php echo htmlspecialchars($search); ?>">
                                        <button class="input-group-text" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <?php if (!empty($route_filter) || !empty($search)): ?>
                                    <a href="assignments.php" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-times"></i> حذف فیلترها
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دانش‌آموز</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">شهر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">مسیر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">موقعیت/محل</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while($assignment = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <?php if (!empty($assignment['profile_photo_path']) && file_exists($assignment['profile_photo_path'])): ?>
                                                                <div>
                                                                    <img src="<?php echo $assignment['profile_photo_path']; ?>" class="avatar avatar-sm me-3" alt="user image">
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo $assignment['first_name'] . ' ' . $assignment['last_name']; ?></h6>
                                                                <p class="text-xs text-secondary mb-0">پایه <?php echo $assignment['academic_grade']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $assignment['city']; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $assignment['city_fa']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $assignment['route_name']; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $assignment['route_name_fa']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $assignment['location'] ?: '-'; ?></p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="../students/view.php?id=<?php echo $assignment['student_id']; ?>" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> مشاهده دانش‌آموز
                                                        </a>
                                                        <a href="?delete=<?php echo $assignment['transportation_id']; ?><?php echo !empty($route_filter) ? '&route_id=' . $route_filter : ''; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این تخصیص اطمینان دارید؟');">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-4">هیچ تخصیصی یافت نشد.</td>
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
                                        <?php 
                                        // ساخت پارامترهای URL برای پیجینیشن
                                        $query_params = [];
                                        if (!empty($route_filter)) {
                                            $query_params[] = 'route_id=' . $route_filter;
                                        }
                                        if (!empty($search)) {
                                            $query_params[] = 'search=' . urlencode($search);
                                        }
                                        $query_string = implode('&', $query_params);
                                        if (!empty($query_string)) {
                                            $query_string = '&' . $query_string;
                                        }
                                        ?>
                                        
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // فعال‌سازی select2 برای سلکت‌ها
            $('.select2').select2({
                dir: "rtl",
                language: "fa"
            });
        });
    </script>
</body>
</html>