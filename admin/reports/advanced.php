<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بارگذاری جی‌دی‌اف برای تاریخ شمسی
require_once '../includes/jdf.php';

// آماده‌سازی فیلترهای پیشرفته
$filters = [];
$where_clauses = [];
$joins = [];
$having_clauses = [];
$group_by = '';

// فرض: هیچ فیلتری بدون جدول داده اعمال نشده
$tables_used = ['students AS s'];

// فیلتر پایه تحصیلی
if (isset($_GET['grade']) && !empty($_GET['grade'])) {
    $grade = intval($_GET['grade']);
    $filters['grade'] = $grade;
    $where_clauses[] = "s.academic_grade = $grade";
}

// فیلتر ملیت
if (isset($_GET['nationality']) && !empty($_GET['nationality'])) {
    $nationality = mysqli_real_escape_string($db, $_GET['nationality']);
    $filters['nationality'] = $nationality;
    $where_clauses[] = "s.nationality = '$nationality'";
}

// فیلتر مذهب
if (isset($_GET['religion']) && !empty($_GET['religion'])) {
    $religion = mysqli_real_escape_string($db, $_GET['religion']);
    $filters['religion'] = $religion;
    $where_clauses[] = "s.religion = '$religion'";
}

// فیلتر رشته تحصیلی
if (isset($_GET['major']) && !empty($_GET['major'])) {
    $major = mysqli_real_escape_string($db, $_GET['major']);
    $filters['major'] = $major;
    $where_clauses[] = "s.major = '$major'";
}

// فیلتر وضعیت ثبت‌نام
if (isset($_GET['registration_status']) && !empty($_GET['registration_status'])) {
    $registration_status = mysqli_real_escape_string($db, $_GET['registration_status']);
    $filters['registration_status'] = $registration_status;
    if (!in_array('registrations AS r', $tables_used)) {
        $joins[] = "LEFT JOIN registrations AS r ON s.student_id = r.student_id";
        $tables_used[] = 'registrations AS r';
    }
    $where_clauses[] = "r.registration_status = '$registration_status'";
}

// فیلتر بازه تاریخ ثبت‌نام
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

if (!empty($start_date)) {
    $filters['start_date'] = $start_date;
    // تبدیل تاریخ شمسی به میلادی
    $start_date_array = explode('/', $start_date);
    if (count($start_date_array) == 3) {
        $start_date_miladi = jalali_to_gregorian($start_date_array[0], $start_date_array[1], $start_date_array[2]);
        $start_date_formatted = $start_date_miladi[0] . '-' . $start_date_miladi[1] . '-' . $start_date_miladi[2];
        if (!in_array('registrations AS r', $tables_used)) {
            $joins[] = "LEFT JOIN registrations AS r ON s.student_id = r.student_id";
            $tables_used[] = 'registrations AS r';
        }
        $where_clauses[] = "r.registration_date >= '$start_date_formatted 00:00:00'";
    }
}

if (!empty($end_date)) {
    $filters['end_date'] = $end_date;
    // تبدیل تاریخ شمسی به میلادی
    $end_date_array = explode('/', $end_date);
    if (count($end_date_array) == 3) {
        $end_date_miladi = jalali_to_gregorian($end_date_array[0], $end_date_array[1], $end_date_array[2]);
        $end_date_formatted = $end_date_miladi[0] . '-' . $end_date_miladi[1] . '-' . $end_date_miladi[2];
        if (!in_array('registrations AS r', $tables_used)) {
            $joins[] = "LEFT JOIN registrations AS r ON s.student_id = r.student_id";
            $tables_used[] = 'registrations AS r';
        }
        $where_clauses[] = "r.registration_date <= '$end_date_formatted 23:59:59'";
    }
}

// فیلتر مسیر سرویس
if (isset($_GET['route_id']) && !empty($_GET['route_id'])) {
    $route_id = intval($_GET['route_id']);
    $filters['route_id'] = $route_id;
    if (!in_array('transportation AS t', $tables_used)) {
        $joins[] = "LEFT JOIN transportation AS t ON s.student_id = t.student_id";
        $tables_used[] = 'transportation AS t';
    }
    $where_clauses[] = "t.route_id = $route_id";
}

// فیلتر مدرک آپلود شده
if (isset($_GET['has_document_type']) && !empty($_GET['has_document_type'])) {
    $document_type = mysqli_real_escape_string($db, $_GET['has_document_type']);
    $filters['has_document_type'] = $document_type;
    if (!in_array('documents AS d', $tables_used)) {
        $joins[] = "LEFT JOIN documents AS d ON s.student_id = d.student_id";
        $tables_used[] = 'documents AS d';
    }
    $where_clauses[] = "d.document_type = '$document_type'";
}

// فیلتر گروه‌بندی
$group_by_field = isset($_GET['group_by']) ? $_GET['group_by'] : '';
if (!empty($group_by_field)) {
    $filters['group_by'] = $group_by_field;
    
    switch($group_by_field) {
        case 'academic_grade':
            $group_by = "GROUP BY s.academic_grade";
            break;
        case 'nationality':
            $group_by = "GROUP BY s.nationality";
            break;
        case 'religion':
            $group_by = "GROUP BY s.religion";
            break;
        case 'registration_status':
            if (!in_array('registrations AS r', $tables_used)) {
                $joins[] = "LEFT JOIN registrations AS r ON s.student_id = r.student_id";
                $tables_used[] = 'registrations AS r';
            }
            $group_by = "GROUP BY r.registration_status";
            break;
        case 'route_id':
            if (!in_array('transportation AS t', $tables_used)) {
                $joins[] = "LEFT JOIN transportation AS t ON s.student_id = t.student_id";
                $tables_used[] = 'transportation AS t';
                $joins[] = "LEFT JOIN routes AS rt ON t.route_id = rt.route_id";
                $tables_used[] = 'routes AS rt';
            }
            $group_by = "GROUP BY t.route_id";
            break;
        default:
            $group_by = "";
    }
}

// ساخت جمله WHERE نهایی
$where_clause = '';
if (!empty($where_clauses)) {
    $where_clause = " WHERE " . implode(" AND ", $where_clauses);
}

// ساخت جمله JOIN نهایی
$join_clause = '';
if (!empty($joins)) {
    $join_clause = " " . implode(" ", $joins);
}

// ساخت کوئری نهایی
if (!empty($group_by)) {
    // گزارش گروه‌بندی شده
    switch($group_by_field) {
        case 'academic_grade':
            $query = "
                SELECT s.academic_grade, 
                       CASE 
                           WHEN s.academic_grade BETWEEN 1 AND 6 THEN CONCAT('پایه ', s.academic_grade, ' ابتدایی')
                           WHEN s.academic_grade BETWEEN 7 AND 9 THEN CONCAT('پایه ', s.academic_grade, ' متوسطه اول')
                           WHEN s.academic_grade BETWEEN 10 AND 12 THEN CONCAT('پایه ', s.academic_grade, ' متوسطه دوم')
                           ELSE CONCAT('پایه ', s.academic_grade)
                       END AS group_title,
                       COUNT(*) AS count
                FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
                GROUP BY s.academic_grade
                ORDER BY s.academic_grade
            ";
            break;
        case 'nationality':
            $query = "
                SELECT s.nationality AS group_title, COUNT(*) AS count
                FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
                GROUP BY s.nationality
                ORDER BY count DESC
            ";
            break;
        case 'religion':
            $query = "
                SELECT s.religion AS group_title, COUNT(*) AS count
                FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
                GROUP BY s.religion
                ORDER BY count DESC
            ";
            break;
        case 'registration_status':
            $query = "
                SELECT r.registration_status,
                       CASE r.registration_status
                           WHEN 'pending' THEN 'در انتظار بررسی'
                           WHEN 'approved' THEN 'تأیید شده'
                           WHEN 'rejected' THEN 'رد شده'
                           ELSE 'نامشخص'
                       END AS group_title,
                       COUNT(*) AS count
                FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
                GROUP BY r.registration_status
                ORDER BY r.registration_status
            ";
            break;
        case 'route_id':
            $query = "
                SELECT t.route_id, rt.route_name AS group_title, COUNT(*) AS count
                FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
                GROUP BY t.route_id, rt.route_name
                ORDER BY count DESC
            ";
            break;
        default:
            $query = "
                SELECT s.student_id, s.first_name, s.last_name, s.academic_grade
                FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
                ORDER BY s.last_name, s.first_name
            ";
    }
} else {
    // گزارش جزئیات (بدون گروه‌بندی)
    $query = "
        SELECT s.student_id, s.first_name, s.last_name, s.academic_grade, s.nationality, s.religion, 
               s.major, s.contact_number, s.profile_photo_path
        FROM " . implode(", ", $tables_used) . $join_clause . $where_clause . "
        ORDER BY s.last_name, s.first_name
    ";
}

// اجرای کوئری
$result = mysqli_query($db, $query);
if (!$result) {
    die('خطا در اجرای کوئری: ' . mysqli_error($db));
}

// گرفتن لیست‌های مورد نیاز برای فیلتر
$grades_query = mysqli_query($db, "SELECT * FROM academic_grades ORDER BY grade_number");
$nationalities_query = mysqli_query($db, "SELECT DISTINCT nationality FROM students ORDER BY nationality");
$religions_query = mysqli_query($db, "SELECT DISTINCT religion FROM students ORDER BY religion");
$majors_query = mysqli_query($db, "SELECT * FROM majors ORDER BY major_id");
$routes_query = mysqli_query($db, "SELECT * FROM routes ORDER BY route_id");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارش پیشرفته - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- تاریخ شمسی -->
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <!-- فیلترهای پیشرفته -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>گزارش‌گیری پیشرفته</h6>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="grade">پایه تحصیلی</label>
                                            <select class="form-select" id="grade" name="grade">
                                                <option value="">همه پایه‌ها</option>
                                                <?php while($grade = mysqli_fetch_assoc($grades_query)): ?>
                                                    <option value="<?php echo $grade['grade_number']; ?>" <?php echo (isset($filters['grade']) && $filters['grade'] == $grade['grade_number']) ? 'selected' : ''; ?>>
                                                        <?php echo $grade['grade_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nationality">ملیت</label>
                                            <select class="form-select" id="nationality" name="nationality">
                                                <option value="">همه ملیت‌ها</option>
                                                <?php while($nationality = mysqli_fetch_assoc($nationalities_query)): ?>
                                                    <option value="<?php echo $nationality['nationality']; ?>" <?php echo (isset($filters['nationality']) && $filters['nationality'] == $nationality['nationality']) ? 'selected' : ''; ?>>
                                                        <?php echo $nationality['nationality']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="religion">مذهب</label>
                                            <select class="form-select" id="religion" name="religion">
                                                <option value="">همه مذاهب</option>
                                                <?php while($religion = mysqli_fetch_assoc($religions_query)): ?>
                                                    <option value="<?php echo $religion['religion']; ?>" <?php echo (isset($filters['religion']) && $filters['religion'] == $religion['religion']) ? 'selected' : ''; ?>>
                                                        <?php echo $religion['religion']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="major">رشته تحصیلی</label>
                                            <select class="form-select" id="major" name="major">
                                                <option value="">همه رشته‌ها</option>
                                                <?php mysqli_data_seek($majors_query, 0); ?>
                                                <?php while($major = mysqli_fetch_assoc($majors_query)): ?>
                                                    <option value="<?php echo $major['major_name']; ?>" <?php echo (isset($filters['major']) && $filters['major'] == $major['major_name']) ? 'selected' : ''; ?>>
                                                        <?php echo $major['major_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="registration_status">وضعیت ثبت‌نام</label>
                                            <select class="form-select" id="registration_status" name="registration_status">
                                                <option value="">همه وضعیت‌ها</option>
                                                <option value="pending" <?php echo (isset($filters['registration_status']) && $filters['registration_status'] == 'pending') ? 'selected' : ''; ?>>در انتظار بررسی</option>
                                                <option value="approved" <?php echo (isset($filters['registration_status']) && $filters['registration_status'] == 'approved') ? 'selected' : ''; ?>>تأیید شده</option>
                                                <option value="rejected" <?php echo (isset($filters['registration_status']) && $filters['registration_status'] == 'rejected') ? 'selected' : ''; ?>>رد شده</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="route_id">مسیر سرویس</label>
                                            <select class="form-select" id="route_id" name="route_id">
                                                <option value="">همه مسیرها</option>
                                                <?php while($route = mysqli_fetch_assoc($routes_query)): ?>
                                                    <option value="<?php echo $route['route_id']; ?>" <?php echo (isset($filters['route_id']) && $filters['route_id'] == $route['route_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $route['route_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">از تاریخ ثبت‌نام</label>
                                            <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="<?php echo isset($filters['start_date']) ? $filters['start_date'] : ''; ?>" placeholder="1400/01/01">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">تا تاریخ ثبت‌نام</label>
                                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="<?php echo isset($filters['end_date']) ? $filters['end_date'] : ''; ?>" placeholder="1400/12/29">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="has_document_type">مدرک آپلود شده</label>
                                            <select class="form-select" id="has_document_type" name="has_document_type">
                                                <option value="">هر نوع مدرک</option>
                                                <option value="emirates_id" <?php echo (isset($filters['has_document_type']) && $filters['has_document_type'] == 'emirates_id') ? 'selected' : ''; ?>>کارت شناسایی امارات</option>
                                                <option value="passport" <?php echo (isset($filters['has_document_type']) && $filters['has_document_type'] == 'passport') ? 'selected' : ''; ?>>پاسپورت</option>
                                                <option value="national_id" <?php echo (isset($filters['has_document_type']) && $filters['has_document_type'] == 'national_id') ? 'selected' : ''; ?>>کارت ملی</option>
                                                <option value="birth_certificate" <?php echo (isset($filters['has_document_type']) && $filters['has_document_type'] == 'birth_certificate') ? 'selected' : ''; ?>>شناسنامه</option>
                                                <option value="academic_certificate" <?php echo (isset($filters['has_document_type']) && $filters['has_document_type'] == 'academic_certificate') ? 'selected' : ''; ?>>مدرک تحصیلی</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="group_by">گروه‌بندی نتایج</label>
                                            <select class="form-select" id="group_by" name="group_by">
                                                <option value="">بدون گروه‌بندی</option>
                                                <option value="academic_grade" <?php echo (isset($filters['group_by']) && $filters['group_by'] == 'academic_grade') ? 'selected' : ''; ?>>پایه تحصیلی</option>
                                                <option value="nationality" <?php echo (isset($filters['group_by']) && $filters['group_by'] == 'nationality') ? 'selected' : ''; ?>>ملیت</option>
                                                <option value="religion" <?php echo (isset($filters['group_by']) && $filters['group_by'] == 'religion') ? 'selected' : ''; ?>>مذهب</option>
                                                <option value="registration_status" <?php echo (isset($filters['group_by']) && $filters['group_by'] == 'registration_status') ? 'selected' : ''; ?>>وضعیت ثبت‌نام</option>
                                                <option value="route_id" <?php echo (isset($filters['group_by']) && $filters['group_by'] == 'route_id') ? 'selected' : ''; ?>>مسیر سرویس</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">اعمال فیلترها</button>
                                        <a href="advanced.php" class="btn btn-secondary">حذف فیلترها</a>
                                        <?php if (!empty($where_clauses) || !empty($group_by)): ?>
                                            <button type="button" class="btn btn-success" onclick="exportToExcel()">
                                                <i class="fas fa-file-excel me-1"></i> خروجی اکسل
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="printReport()">
                                                <i class="fas fa-print me-1"></i> چاپ گزارش
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- نتایج گزارش -->
            <div class="row" id="reportData">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>نتایج گزارش 
                                <?php if (!empty($group_by)): ?>
                                - گروه‌بندی شده بر اساس: 
                                <?php 
                                switch($group_by_field) {
                                    case 'academic_grade':
                                        echo 'پایه تحصیلی';
                                        break;
                                    case 'nationality':
                                        echo 'ملیت';
                                        break;
                                    case 'religion':
                                        echo 'مذهب';
                                        break;
                                    case 'registration_status':
                                        echo 'وضعیت ثبت‌نام';
                                        break;
                                    case 'route_id':
                                        echo 'مسیر سرویس';
                                        break;
                                }
                                ?>
                                <?php endif; ?>
                            </h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php if (!empty($group_by)): ?>
                                    <!-- نمایش نتیجه گروه‌بندی شده -->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                <?php 
                                                                switch($group_by_field) {
                                                                    case 'academic_grade':
                                                                        echo 'پایه تحصیلی';
                                                                        break;
                                                                    case 'nationality':
                                                                        echo 'ملیت';
                                                                        break;
                                                                    case 'religion':
                                                                        echo 'مذهب';
                                                                        break;
                                                                    case 'registration_status':
                                                                        echo 'وضعیت ثبت‌نام';
                                                                        break;
                                                                    case 'route_id':
                                                                        echo 'مسیر سرویس';
                                                                        break;
                                                                }
                                                                ?>
                                                            </th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تعداد</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">درصد</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $total_count = 0;
                                                        $chart_labels = [];
                                                        $chart_data = [];
                                                        mysqli_data_seek($result, 0);
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                            $total_count += $row['count'];
                                                            $chart_labels[] = $row['group_title'];
                                                            $chart_data[] = $row['count'];
                                                        }
                                                        mysqli_data_seek($result, 0);
                                                        while($row = mysqli_fetch_assoc($result)):
                                                            $percentage = ($row['count'] / $total_count) * 100;
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex px-2 py-1">
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm"><?php echo $row['group_title']; ?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p class="text-xs font-weight-bold mb-0"><?php echo number_format($row['count']); ?></p>
                                                                </td>
                                                                <td>
                                                                    <p class="text-xs font-weight-bold mb-0"><?php echo number_format($percentage, 2); ?>%</p>
                                                                </td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                        <tr class="bg-light">
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">مجموع</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0"><?php echo number_format($total_count); ?></p>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0">100%</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <div id="report-chart" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- نمایش نتیجه بدون گروه‌بندی -->
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام و نام خانوادگی</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">پایه</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ملیت</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">مذهب</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">رشته</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">شماره تماس</th>
                                                    <th class="text-secondary opacity-7">عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($student = mysqli_fetch_assoc($result)): ?>
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
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">پایه <?php echo $student['academic_grade']; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo $student['nationality']; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo $student['religion']; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo !empty($student['major']) ? $student['major'] : '-'; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo $student['contact_number']; ?></p>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a href="../students/view.php?id=<?php echo $student['student_id']; ?>" class="btn btn-sm btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View student">
                                                                <i class="fas fa-eye"></i> مشاهده
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                                    <h5>هیچ نتیجه‌ای یافت نشد.</h5>
                                    <p class="text-muted">لطفاً فیلترهای جستجو را تغییر دهید.</p>
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
    
    <!-- تاریخ شمسی -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    
    <script>
        // تاریخ شمسی
        $(document).ready(function() {
            $(".datepicker").pDatepicker({
                format: 'YYYY/MM/DD',
                autoClose: true
            });
        });
        
        <?php if (!empty($group_by) && isset($chart_labels) && isset($chart_data)): ?>
        // نمودار گزارش گروه‌بندی شده
        var chartOptions = {
            <?php if(count($chart_labels) <= 3): ?>
            // نمودار ستونی برای تعداد کم آیتم
            series: [{
                name: 'تعداد',
                data: <?php echo json_encode($chart_data); ?>
            }],
            chart: {
                type: 'bar',
                height: 300,
                fontFamily: 'Estedad, Tahoma, sans-serif',
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: true
            },
            colors: ['#3498db'],
            xaxis: {
                categories: <?php echo json_encode($chart_labels); ?>,
                labels: {
                    style: {
                        fontFamily: 'Estedad, Tahoma, sans-serif'
                    }
                }
            }
            <?php else: ?>
            // نمودار دایره‌ای برای تعداد زیاد آیتم
            series: <?php echo json_encode($chart_data); ?>,
            chart: {
                type: 'pie',
                height: 300,
                fontFamily: 'Estedad, Tahoma, sans-serif',
            },
            labels: <?php echo json_encode($chart_labels); ?>,
            legend: {
                position: 'bottom',
                fontFamily: 'Estedad, Tahoma, sans-serif',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 320
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            }
            <?php endif; ?>
        };

        var chart = new ApexCharts(document.querySelector("#report-chart"), chartOptions);
        chart.render();
        <?php endif; ?>
        
        // چاپ گزارش
        function printReport() {
            window.print();
        }
        
        // خروجی اکسل
        function exportToExcel() {
            alert('در یک محیط واقعی، این دکمه یک فایل اکسل از داده‌های جدول ایجاد می‌کند.');
        }
    </script>
</body>
</html>