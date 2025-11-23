<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بارگذاری جی‌دی‌اف برای تاریخ شمسی
require_once '../includes/jdf.php';

// آماده‌سازی فیلترها
$filters = [];
$where_clauses = [];

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

// فیلتر رشته تحصیلی (برای دبیرستان)
if (isset($_GET['major']) && !empty($_GET['major'])) {
    $major = mysqli_real_escape_string($db, $_GET['major']);
    $filters['major'] = $major;
    $where_clauses[] = "s.major = '$major'";
}

// فیلتر وضعیت ثبت‌نام
if (isset($_GET['registration_status']) && !empty($_GET['registration_status'])) {
    $registration_status = mysqli_real_escape_string($db, $_GET['registration_status']);
    $filters['registration_status'] = $registration_status;
    $where_clauses[] = "r.registration_status = '$registration_status'";
}

// ساخت جمله WHERE نهایی
$where_clause = '';
if (!empty($where_clauses)) {
    $where_clause = " WHERE " . implode(" AND ", $where_clauses);
}

// کوئری گزارش‌گیری از دانش‌آموزان
$query = "
    SELECT s.*, r.registration_status, r.registration_date, 
           f.full_name as father_name, f.mobile_number as father_mobile, 
           m.full_name as mother_name, m.mobile_number as mother_mobile
    FROM students s
    LEFT JOIN registrations r ON s.student_id = r.student_id
    LEFT JOIN fathers f ON s.student_id = f.student_id
    LEFT JOIN mothers m ON s.student_id = m.student_id
    $where_clause
    ORDER BY s.last_name, s.first_name
";
$result = mysqli_query($db, $query);

// گروه‌بندی آمار
$query_stats = "
    SELECT COUNT(*) as total_count,
           SUM(CASE WHEN s.academic_grade BETWEEN 1 AND 6 THEN 1 ELSE 0 END) as elementary_count,
           SUM(CASE WHEN s.academic_grade BETWEEN 7 AND 9 THEN 1 ELSE 0 END) as middle_count,
           SUM(CASE WHEN s.academic_grade BETWEEN 10 AND 12 THEN 1 ELSE 0 END) as high_count,
           SUM(CASE WHEN r.registration_status = 'pending' THEN 1 ELSE 0 END) as pending_count,
           SUM(CASE WHEN r.registration_status = 'approved' THEN 1 ELSE 0 END) as approved_count,
           SUM(CASE WHEN r.registration_status = 'rejected' THEN 1 ELSE 0 END) as rejected_count
    FROM students s
    LEFT JOIN registrations r ON s.student_id = r.student_id
    $where_clause
";
$stats_result = mysqli_query($db, $query_stats);
$stats = mysqli_fetch_assoc($stats_result);

// دریافت لیست پایه‌های تحصیلی
$grades_query = mysqli_query($db, "SELECT * FROM academic_grades ORDER BY grade_number");

// دریافت لیست ملیت‌ها
$nationalities_query = mysqli_query($db, "SELECT DISTINCT nationality FROM students ORDER BY nationality");

// دریافت لیست مذاهب
$religions_query = mysqli_query($db, "SELECT DISTINCT religion FROM students ORDER BY religion");

// دریافت لیست رشته‌های تحصیلی
$majors_query = mysqli_query($db, "SELECT * FROM majors ORDER BY major_id");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارش آمار دانش‌آموزان - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <!-- فیلترهای گزارش -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>فیلترهای گزارش</h6>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <div class="row">
                                    <div class="col-md-3">
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
                                    
                                    <div class="col-md-3">
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
                                    
                                    <div class="col-md-3">
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
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="major">رشته تحصیلی</label>
                                            <select class="form-select" id="major" name="major">
                                                <option value="">همه رشته‌ها</option>
                                                <?php while($major = mysqli_fetch_assoc($majors_query)): ?>
                                                    <option value="<?php echo $major['major_name']; ?>" <?php echo (isset($filters['major']) && $filters['major'] == $major['major_name']) ? 'selected' : ''; ?>>
                                                        <?php echo $major['major_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-3">
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
                                    
                                    <div class="col-md-9 d-flex align-items-end">
                                        <div class="form-group w-100 text-end">
                                            <button type="submit" class="btn btn-primary">اعمال فیلترها</button>
                                            <a href="students.php" class="btn btn-secondary">حذف فیلترها</a>
                                            <?php if (!empty($where_clauses)): ?>
                                                <button type="button" class="btn btn-success" onclick="exportToExcel()">
                                                    <i class="fas fa-file-excel me-1"></i> خروجی اکسل
                                                </button>
                                                <button type="button" class="btn btn-danger" onclick="printReport()">
                                                    <i class="fas fa-print me-1"></i> چاپ گزارش
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- آمار خلاصه -->
            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">تعداد کل</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['total_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">ابتدایی</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['elementary_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fas fa-child text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">متوسطه اول</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['middle_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                        <i class="fas fa-book-reader text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">متوسطه دوم</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['high_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="fas fa-user-graduate text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- نمودارها -->
            <div class="row mb-4">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>توزیع بر اساس مقطع تحصیلی</h6>
                        </div>
                        <div class="card-body">
                            <div id="education-level-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>وضعیت ثبت‌نام</h6>
                        </div>
                        <div class="card-body">
                            <div id="registration-status-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- جدول نتایج -->
            <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="row" id="reportData">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>لیست دانش‌آموزان (<?php echo number_format(mysqli_num_rows($result)); ?> نفر)</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام و نام خانوادگی</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">پایه</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ملیت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">مذهب</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اطلاعات پدر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اطلاعات مادر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت ثبت‌نام</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاریخ ثبت‌نام</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($student = mysqli_fetch_assoc($result)): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <?php if (!empty($student['profile_photo_path']) && file_exists($student['profile_photo_path'])): ?>
                                                            <div>
                                                                <img src="<?php echo $student['profile_photo_path']; ?>" class="avatar avatar-sm me-3" alt="student image">
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">پایه <?php echo $student['academic_grade']; ?></p>
                                                    <?php if (!empty($student['major'])): ?>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $student['major']; ?></p>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $student['nationality']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $student['religion']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $student['father_name'] ?? 'ثبت نشده'; ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?php echo $student['father_mobile'] ?? ''; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $student['mother_name'] ?? 'ثبت نشده'; ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?php echo $student['mother_mobile'] ?? ''; ?></p>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $status_class = '';
                                                    $status_text = 'نامشخص';
                                                    
                                                    if ($student['registration_status'] == 'pending') {
                                                        $status_class = 'bg-warning';
                                                        $status_text = 'در انتظار بررسی';
                                                    } elseif ($student['registration_status'] == 'approved') {
                                                        $status_class = 'bg-success';
                                                        $status_text = 'تأیید شده';
                                                    } elseif ($student['registration_status'] == 'rejected') {
                                                        $status_class = 'bg-danger';
                                                        $status_text = 'رد شده';
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if (!empty($student['registration_date'])) {
                                                        $reg_date = jdate('Y/m/d', strtotime($student['registration_date']));
                                                        echo '<p class="text-xs font-weight-bold mb-0">' . $reg_date . '</p>';
                                                    } else {
                                                        echo '<p class="text-xs font-weight-bold mb-0">ثبت نشده</p>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                            <h5>هیچ دانش‌آموزی با شرایط مورد نظر یافت نشد.</h5>
                            <p class="text-muted">لطفاً فیلترهای جستجو را تغییر دهید.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // نمودار توزیع مقطع تحصیلی
        var educationOptions = {
          series: [{
            name: 'تعداد دانش‌آموزان',
            data: [
              <?php echo $stats['elementary_count']; ?>, 
              <?php echo $stats['middle_count']; ?>, 
              <?php echo $stats['high_count']; ?>
            ]
          }],
          chart: {
            type: 'bar',
            height: 300,
            fontFamily: 'Estedad, Tahoma, sans-serif',
          },
          plotOptions: {
            bar: {
              borderRadius: 4,
              horizontal: false,
              columnWidth: '55%',
            },
          },
          dataLabels: {
            enabled: true
          },
          colors: ['#4361ee'],
          xaxis: {
            categories: ['ابتدایی', 'متوسطه اول', 'متوسطه دوم'],
            labels: {
              style: {
                fontFamily: 'Estedad, Tahoma, sans-serif'
              }
            }
          }
        };

        var educationChart = new ApexCharts(document.querySelector("#education-level-chart"), educationOptions);
        educationChart.render();
        
        // نمودار وضعیت ثبت‌نام
        var registrationOptions = {
          series: [
            <?php echo $stats['pending_count']; ?>, 
            <?php echo $stats['approved_count']; ?>, 
            <?php echo $stats['rejected_count']; ?>
          ],
          chart: {
            type: 'donut',
            height: 300,
            fontFamily: 'Estedad, Tahoma, sans-serif',
          },
          labels: ['در انتظار بررسی', 'تأیید شده', 'رد شده'],
          colors: ['#ffc107', '#28a745', '#dc3545'],
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
          }]
        };

        var registrationChart = new ApexCharts(document.querySelector("#registration-status-chart"), registrationOptions);
        registrationChart.render();
        
        // چاپ گزارش
        function printReport() {
            window.print();
        }
        
        // خروجی اکسل (شبیه‌سازی)
        function exportToExcel() {
            alert('در یک محیط واقعی، این دکمه یک فایل اکسل از داده‌های جدول ایجاد می‌کند.');
            // در یک محیط واقعی، می‌توان از کتابخانه‌هایی مانند PHPExcel یا SheetJS استفاده کرد
        }
    </script>
</body>
</html>