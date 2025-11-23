<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بارگذاری جی‌دی‌اف برای تاریخ شمسی
require_once '../includes/jdf.php';

// تنظیمات پیجینیشن
$limit = 30;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// فیلترها
$where_clauses = [];
$params = [];

// فیلتر بر اساس نوع فعالیت
if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = mysqli_real_escape_string($db, $_GET['action']);
    $where_clauses[] = "action = '$action'";
    $params[] = "action=" . urlencode($_GET['action']);
}

// فیلتر بر اساس بازه زمانی
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

if (!empty($start_date)) {
    // تبدیل تاریخ شمسی به میلادی
    $start_date_array = explode('/', $start_date);
    if (count($start_date_array) == 3) {
        $start_date_miladi = jalali_to_gregorian($start_date_array[0], $start_date_array[1], $start_date_array[2]);
        $start_date_formatted = $start_date_miladi[0] . '-' . $start_date_miladi[1] . '-' . $start_date_miladi[2];
        $where_clauses[] = "created_at >= '$start_date_formatted 00:00:00'";
        $params[] = "start_date=" . urlencode($start_date);
    }
}

if (!empty($end_date)) {
    // تبدیل تاریخ شمسی به میلادی
    $end_date_array = explode('/', $end_date);
    if (count($end_date_array) == 3) {
        $end_date_miladi = jalali_to_gregorian($end_date_array[0], $end_date_array[1], $end_date_array[2]);
        $end_date_formatted = $end_date_miladi[0] . '-' . $end_date_miladi[1] . '-' . $end_date_miladi[2];
        $where_clauses[] = "created_at <= '$end_date_formatted 23:59:59'";
        $params[] = "end_date=" . urlencode($end_date);
    }
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

// کوئری لاگ‌ها
$logs_query = "
    SELECT l.*, a.username as admin_username 
    FROM activity_logs l
    LEFT JOIN admin a ON l.user_id = a.id
    $where_clause
    ORDER BY l.created_at DESC
    LIMIT $offset, $limit
";
$logs_result = mysqli_query($db, $logs_query);

// محاسبه تعداد کل رکوردها برای پیجینیشن
$count_query = "SELECT COUNT(*) as total FROM activity_logs $where_clause";
$count_result = mysqli_query($db, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_pages = ceil($count_row['total'] / $limit);

// دریافت انواع فعالیت‌ها برای فیلتر
$action_types_query = "SELECT DISTINCT action FROM activity_logs ORDER BY action";
$action_types_result = mysqli_query($db, $action_types_query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لاگ فعالیت‌ها - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- تاریخ شمسی -->
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
    <style>
        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 14px;
        }
        
        .activity-login { background-color: #2ecc71; }
        .activity-logout { background-color: #e74c3c; }
        .activity-create { background-color: #3498db; }
        .activity-update { background-color: #f39c12; }
        .activity-delete { background-color: #e74c3c; }
        .activity-other { background-color: #9b59b6; }
    </style>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>لاگ فعالیت‌های سیستم</h6>
                        </div>
                        <div class="card-body">
                            <!-- فیلترها -->
                            <form method="get" action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="action">نوع فعالیت</label>
                                            <select class="form-select" id="action" name="action">
                                                <option value="">همه فعالیت‌ها</option>
                                                <?php while($action_type = mysqli_fetch_assoc($action_types_result)): ?>
                                                    <option value="<?php echo $action_type['action']; ?>" <?php echo (isset($_GET['action']) && $_GET['action'] == $action_type['action']) ? 'selected' : ''; ?>>
                                                        <?php echo $action_type['action']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">از تاریخ</label>
                                            <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="<?php echo $start_date; ?>" placeholder="1400/01/01">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">تا تاریخ</label>
                                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="<?php echo $end_date; ?>" placeholder="1400/12/29">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 d-flex align-items-end">
                                        <div class="form-group w-100">
                                            <button type="submit" class="btn btn-primary w-100">اعمال فیلتر</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- جدول لاگ‌ها -->
                            <div class="table-responsive mt-4">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شناسه</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نوع فعالیت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">توضیحات</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">کاربر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">آی‌پی</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاریخ و زمان</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($log = mysqli_fetch_assoc($logs_result)): 
                                            // تعیین آیکون و کلاس مناسب برای هر فعالیت
                                            $icon_class = 'activity-other';
                                            $icon = 'fas fa-cog';
                                            
                                            if (strpos($log['action'], 'login') !== false) {
                                                $icon_class = 'activity-login';
                                                $icon = 'fas fa-sign-in-alt';
                                            } elseif (strpos($log['action'], 'logout') !== false) {
                                                $icon_class = 'activity-logout';
                                                $icon = 'fas fa-sign-out-alt';
                                            } elseif (strpos($log['action'], 'create') !== false || strpos($log['action'], 'add') !== false || strpos($log['action'], 'new') !== false || strpos($log['action'], 'register') !== false) {
                                                $icon_class = 'activity-create';
                                                $icon = 'fas fa-plus';
                                            } elseif (strpos($log['action'], 'update') !== false || strpos($log['action'], 'edit') !== false || strpos($log['action'], 'modify') !== false) {
                                                $icon_class = 'activity-update';
                                                $icon = 'fas fa-edit';
                                            } elseif (strpos($log['action'], 'delete') !== false || strpos($log['action'], 'remove') !== false) {
                                                $icon_class = 'activity-delete';
                                                $icon = 'fas fa-trash';
                                            }
                                            
                                            // تبدیل تاریخ میلادی به شمسی
                                            $created_at = strtotime($log['created_at']);
                                            list($gy, $gm, $gd) = explode('-', date('Y-m-d', $created_at));
                                            list($jy, $jm, $jd) = gregorian_to_jalali($gy, $gm, $gd);
                                            $shamsi_date = $jy . '/' . sprintf('%02d', $jm) . '/' . sprintf('%02d', $jd);
                                            $time = date('H:i:s', $created_at);
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $log['log_id']; ?></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="activity-icon <?php echo $icon_class; ?> me-3">
                                                            <i class="<?php echo $icon; ?>"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?php echo $log['action']; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $log['description']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        <?php echo !empty($log['admin_username']) ? $log['admin_username'] : 'کاربر ' . $log['user_id']; ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $log['ip_address']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $shamsi_date; ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?php echo $time; ?></p>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
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
    </script>
</body>
</html>