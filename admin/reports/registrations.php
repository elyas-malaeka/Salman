<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بارگذاری جی‌دی‌اف برای تاریخ شمسی
require_once '../includes/jdf.php';

// تنظیمات صفحه‌بندی
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// تنظیم فیلترهای جستجو
$filters = [];
$where_clauses = [];

// فیلتر بازه زمانی
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

if (!empty($start_date)) {
    $filters['start_date'] = $start_date;
    // تبدیل تاریخ شمسی به میلادی برای کوئری
    $start_date_array = explode('/', $start_date);
    if (count($start_date_array) == 3) {
        $start_date_miladi = jalali_to_gregorian($start_date_array[0], $start_date_array[1], $start_date_array[2]);
        $start_date_formatted = $start_date_miladi[0] . '-' . $start_date_miladi[1] . '-' . $start_date_miladi[2];
        $where_clauses[] = "r.registration_date >= '$start_date_formatted 00:00:00'";
    }
}

if (!empty($end_date)) {
    $filters['end_date'] = $end_date;
    // تبدیل تاریخ شمسی به میلادی برای کوئری
    $end_date_array = explode('/', $end_date);
    if (count($end_date_array) == 3) {
        $end_date_miladi = jalali_to_gregorian($end_date_array[0], $end_date_array[1], $end_date_array[2]);
        $end_date_formatted = $end_date_miladi[0] . '-' . $end_date_miladi[1] . '-' . $end_date_miladi[2];
        $where_clauses[] = "r.registration_date <= '$end_date_formatted 23:59:59'";
    }
}

// فیلتر وضعیت ثبت‌نام
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = mysqli_real_escape_string($db, $_GET['status']);
    $filters['status'] = $status;
    $where_clauses[] = "r.registration_status = '$status'";
}

// فیلتر پایه تحصیلی
if (isset($_GET['grade']) && !empty($_GET['grade'])) {
    $grade = intval($_GET['grade']);
    $filters['grade'] = $grade;
    $where_clauses[] = "s.academic_grade = $grade";
}

// ساخت جمله WHERE نهایی
$where_clause = '';
if (!empty($where_clauses)) {
    $where_clause = " WHERE " . implode(" AND ", $where_clauses);
}

// کوئری آمار ثبت‌نام‌ها با فیلترها
$query = "
    SELECT r.*, s.first_name, s.last_name, s.academic_grade, s.profile_photo_path
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    $where_clause
    ORDER BY r.registration_date DESC
    LIMIT $offset, $limit
";
$result = mysqli_query($db, $query);

// محاسبه تعداد کل رکوردها برای صفحه‌بندی
$count_query = "
    SELECT COUNT(*) as total
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    $where_clause
";
$count_result = mysqli_query($db, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_pages = ceil($count_row['total'] / $limit);

// محاسبه آمار کلی
$stats_query = "
    SELECT 
        COUNT(*) as total_count,
        SUM(CASE WHEN r.registration_status = 'pending' THEN 1 ELSE 0 END) as pending_count,
        SUM(CASE WHEN r.registration_status = 'approved' THEN 1 ELSE 0 END) as approved_count,
        SUM(CASE WHEN r.registration_status = 'rejected' THEN 1 ELSE 0 END) as rejected_count
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    $where_clause
";
$stats_result = mysqli_query($db, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);

// محاسبه آمار ماهانه
$monthly_stats_query = "
    SELECT 
        DATE_FORMAT(r.registration_date, '%Y-%m') as month,
        COUNT(*) as count
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    $where_clause
    GROUP BY DATE_FORMAT(r.registration_date, '%Y-%m')
    ORDER BY month
    LIMIT 12
";
$monthly_stats_result = mysqli_query($db, $monthly_stats_query);
$monthly_stats = [];
$months_labels = [];
$months_data = [];

while ($row = mysqli_fetch_assoc($monthly_stats_result)) {
    $monthly_stats[] = $row;
    
    // تبدیل تاریخ میلادی به شمسی برای نمودار
    $year = substr($row['month'], 0, 4);
    $month = substr($row['month'], 5, 2);
    $jdate = gregorian_to_jalali($year, $month, 1);
    $month_name = jdate_words(['mm' => $jdate[1]])['mm'];
    
    $months_labels[] = $month_name . ' ' . $jdate[0];
    $months_data[] = $row['count'];
}

// دریافت لیست پایه‌های تحصیلی
$grades_query = mysqli_query($db, "SELECT * FROM academic_grades ORDER BY grade_number");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارش ثبت‌نام‌ها - مجتمع آموزشی سلمان</title>
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
            <!-- فیلترها -->
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
                                            <label for="start_date">از تاریخ</label>
                                            <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="<?php echo isset($filters['start_date']) ? $filters['start_date'] : ''; ?>" placeholder="1400/01/01">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">تا تاریخ</label>
                                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="<?php echo isset($filters['end_date']) ? $filters['end_date'] : ''; ?>" placeholder="1400/12/29">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">وضعیت ثبت‌نام</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="">همه وضعیت‌ها</option>
                                                <option value="pending" <?php echo (isset($filters['status']) && $filters['status'] == 'pending') ? 'selected' : ''; ?>>در انتظار بررسی</option>
                                                <option value="approved" <?php echo (isset($filters['status']) && $filters['status'] == 'approved') ? 'selected' : ''; ?>>تأیید شده</option>
                                                <option value="rejected" <?php echo (isset($filters['status']) && $filters['status'] == 'rejected') ? 'selected' : ''; ?>>رد شده</option>
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
                                                    <option value="<?php echo $grade['grade_number']; ?>" <?php echo (isset($filters['grade']) && $filters['grade'] == $grade['grade_number']) ? 'selected' : ''; ?>>
                                                        <?php echo $grade['grade_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">اعمال فیلترها</button>
                                        <a href="registrations.php" class="btn btn-secondary">حذف فیلترها</a>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">کل ثبت‌نام‌ها</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['total_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-clipboard-list text-lg opacity-10" aria-hidden="true"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">در انتظار بررسی</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['pending_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="fas fa-clock text-lg opacity-10" aria-hidden="true"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">تأیید شده</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['approved_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fas fa-check text-lg opacity-10" aria-hidden="true"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">رد شده</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['rejected_count']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="fas fa-times text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- نمودار روند ثبت‌نام -->
            <div class="row mb-4">
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>روند ثبت‌نام‌ها در ماه‌های اخیر</h6>
                        </div>
                        <div class="card-body p-3">
                            <div id="registration-trend-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>توزیع وضعیت ثبت‌نام‌ها</h6>
                        </div>
                        <div class="card-body p-3">
                            <div id="status-pie-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- جدول ثبت‌نام‌ها -->
            <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="row" id="reportData">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>لیست ثبت‌نام‌ها (<?php echo number_format($count_row['total']); ?> مورد)</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دانش‌آموز</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">پایه</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاریخ ثبت‌نام</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">توضیحات</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($registration = mysqli_fetch_assoc($result)): ?>
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
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">پایه <?php echo $registration['academic_grade']; ?></p>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $registration_date = $registration['registration_date'];
                                                    $gregorian_date = date('Y-m-d', strtotime($registration_date));
                                                    list($gy, $gm, $gd) = explode('-', $gregorian_date);
                                                    list($jy, $jm, $jd) = gregorian_to_jalali($gy, $gm, $gd);
                                                    $jalali_date = $jy . '/' . sprintf('%02d', $jm) . '/' . sprintf('%02d', $jd);
                                                    $time = date('H:i', strtotime($registration_date));
                                                    ?>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $jalali_date; ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?php echo $time; ?></p>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $status_class = '';
                                                    $status_text = '';
                                                    
                                                    if ($registration['registration_status'] == 'pending') {
                                                        $status_class = 'bg-gradient-warning';
                                                        $status_text = 'در انتظار بررسی';
                                                    } elseif ($registration['registration_status'] == 'approved') {
                                                        $status_class = 'bg-gradient-success';
                                                        $status_text = 'تأیید شده';
                                                    } elseif ($registration['registration_status'] == 'rejected') {
                                                        $status_class = 'bg-gradient-danger';
                                                        $status_text = 'رد شده';
                                                    }
                                                    ?>
                                                    <span class="badge badge-sm <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo !empty($registration['special_notes']) ? $registration['special_notes'] : '-'; ?></p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="../students/view.php?id=<?php echo $registration['student_id']; ?>" class="btn btn-sm btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View student">
                                                        <i class="fas fa-eye"></i> مشاهده
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <?php if($total_pages > 1): ?>
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php 
                                        // Build the query parameters for pagination links
                                        $query_params = [];
                                        foreach($filters as $key => $value) {
                                            $query_params[] = $key . '=' . urlencode($value);
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
            <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x mb-3 text-muted"></i>
                            <h5>هیچ ثبت‌نامی با شرایط مورد نظر یافت نشد.</h5>
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
        
        // نمودار روند ثبت‌نام
        var trendOptions = {
          series: [{
            name: 'تعداد ثبت‌نام',
            data: <?php echo json_encode($months_data); ?>
          }],
          chart: {
            type: 'area',
            height: 300,
            fontFamily: 'Estedad, Tahoma, sans-serif',
            toolbar: {
              show: false
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2
          },
          colors: ['#3498db'],
          xaxis: {
            categories: <?php echo json_encode($months_labels); ?>,
            labels: {
              style: {
                fontFamily: 'Estedad, Tahoma, sans-serif'
              }
            }
          },
          yaxis: {
            labels: {
              style: {
                fontFamily: 'Estedad, Tahoma, sans-serif'
              }
            }
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          },
          fill: {
            type: 'gradient',
            gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.7,
              opacityTo: 0.3,
              stops: [0, 90, 100]
            }
          }
        };

        var trendChart = new ApexCharts(document.querySelector("#registration-trend-chart"), trendOptions);
        trendChart.render();
        
        // نمودار توزیع وضعیت
        var statusPieOptions = {
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
          colors: ['#ffc107', '#2ecc71', '#e74c3c'],
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
        };

        var statusPieChart = new ApexCharts(document.querySelector("#status-pie-chart"), statusPieOptions);
        statusPieChart.render();
        
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