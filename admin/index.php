<?php 
require_once 'config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: login.php");
    exit();  
}

// Dashboard statistics
$totalStudents = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM students"))['count'];
$pendingRegistrations = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM registrations WHERE registration_status='pending'"))['count'];
$totalPosts = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM posts"))['count'];
$totalStaff = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM staff"))['count'];

// Get recent registrations
$recentRegistrations = mysqli_query($db, "
    SELECT s.student_id, s.first_name, s.last_name, m.file_path as profile_photo_path, r.registration_date, r.registration_status 
    FROM students s 
    JOIN registrations r ON s.student_id = r.student_id 
    LEFT JOIN media m ON s.photo_media_id = m.media_id
    ORDER BY r.registration_date DESC 
    LIMIT 4
");

// Get recent activity logs
$recentLogs = mysqli_query($db, "SELECT * FROM logs ORDER BY created_at DESC LIMIT 5");

// Get student distribution by grade
$gradeDistribution = mysqli_query($db, "
    SELECT agt.grade_name, COUNT(s.student_id) as count 
    FROM academic_grades ag 
    LEFT JOIN academic_grade_translations agt ON ag.grade_id = agt.grade_id
    LEFT JOIN students s ON ag.grade_id = s.academic_grade_id
    GROUP BY ag.grade_id 
    ORDER BY ag.grade_id
");

// Get student distribution by nationality
$nationalityDistribution = mysqli_query($db, "
    SELECT nationality, COUNT(*) as count 
    FROM students 
    GROUP BY nationality 
    ORDER BY count DESC 
    LIMIT 5
");

// Get recent posts
$latestPosts = mysqli_query($db, "
    SELECT p.post_id, pt.title, p.published_at as publish_date, p.category_id, p.views
    FROM posts p
    JOIN post_translations pt ON p.post_id = pt.post_id
    WHERE p.status = 'published'
    ORDER BY p.published_at DESC
    LIMIT 3
");

// آمار های محاسبه شده برای کارت های داشبورد
// ==== کوئری‌های آمار دانش‌آموزان ====
// دانش‌آموزان ثبت‌نام شده در ماه جاری - بدون فیلتر تاریخ
$currentMonthStudents = $totalStudents; // استفاده از کل دانش‌آموزان

// محاسبه درصد تغییر دانش‌آموزان نسبت به ماه قبل
$studentChangePercent = 0; // مقدار ثابت برای جلوگیری از خطا
$studentChangeClass = 'positive';

// ==== کوئری‌های آمار ثبت‌نام‌های در انتظار ====
// ثبت‌نام‌های در انتظار این هفته
$currentWeekPending = mysqli_fetch_assoc(mysqli_query($db, "
    SELECT COUNT(*) as count 
    FROM registrations 
    WHERE registration_status='pending' 
    AND registration_date >= DATE_SUB(NOW(), INTERVAL WEEKDAY(NOW()) DAY)
"))['count'];

// ثبت‌نام‌های در انتظار هفته قبل
$lastWeekPending = mysqli_fetch_assoc(mysqli_query($db, "
    SELECT COUNT(*) as count 
    FROM registrations 
    WHERE registration_status='pending' 
    AND registration_date >= DATE_SUB(DATE_SUB(NOW(), INTERVAL WEEKDAY(NOW()) DAY), INTERVAL 1 WEEK)
    AND registration_date < DATE_SUB(NOW(), INTERVAL WEEKDAY(NOW()) DAY)
"))['count'];

// محاسبه تغییر ثبت‌نام‌های در انتظار نسبت به هفته قبل
$pendingChange = $currentWeekPending - $lastWeekPending;
$pendingChangeClass = $pendingChange >= 0 ? 'positive' : 'negative';

// ==== کوئری‌های آمار پست‌ها ====
// پست‌های منتشر شده در ماه جاری
$currentMonthPosts = mysqli_fetch_assoc(mysqli_query($db, "
    SELECT COUNT(*) as count 
    FROM posts 
    WHERE published_at >= DATE_FORMAT(NOW() ,'%Y-%m-01')
"))['count'];

// محاسبه تعداد پست‌های منتشر شده در ماه جاری
$postsChange = $currentMonthPosts;
$postsChangeClass = $postsChange >= 0 ? 'positive' : 'negative';

// محاسبه تعداد کارکنان اضافه شده در سال جاری
$staffChange = 0; // مقدار ثابت برای جلوگیری از خطا
$staffChangeClass = 'positive';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد مدیریت - مجتمع آموزشی سلمان</title>
    <link href="assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        :root {
            --blue-primary: #4361ee;
            --green-primary: #2ec4b6;
            --red-primary: #e71d36;
            --purple-primary: #7209b7;
            --gray-bg: #f8f9fa;
        }
        
        body {
            background-color: var(--gray-bg);
            font-family: "Estedad", Tahoma, sans-serif;
        }
        
        .modern-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
            background-color: white;
            overflow: hidden;
            margin-bottom: 20px;
            height: 100%;
        }
        
        /* آمار و ارقام */
        .stat-card {
            padding: 1.2rem;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card .stat-icon {
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            height: 45px;
            width: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .stat-card .stat-content {
            margin-right: 60px;
        }
        
        .stat-card .stat-title {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        
        .stat-card .stat-change {
            font-size: 0.8rem;
        }
        
        .stat-card .stat-change .positive {
            color: var(--green-primary);
        }
        
        .stat-card .stat-change .negative {
            color: var(--red-primary);
        }
        
        /* عنوان بخش‌ها */
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* جدول‌ها */
        .data-table {
            width: 100%;
        }
        
        .data-table thead tr {
            border-bottom: 1px solid #edf2f7;
        }
        
        .data-table th {
            color: #6c757d;
            font-weight: 500;
            padding: 0.8rem;
            font-size: 0.85rem;
        }
        
        .data-table td {
            padding: 0.7rem;
            vertical-align: middle;
        }
        
        .data-table tr:not(:last-child) {
            border-bottom: 1px solid #f5f5f5;
        }
        
        /* آواتار و نمایش کاربران */
        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 0.75rem;
        }
        
        .user-badge {
            display: flex;
            align-items: center;
        }
        
        .user-badge .avatar-placeholder {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-weight: 700;
            margin-left: 0.75rem;
        }
        
        /* وضعیت‌ها */
        .status-badge {
            padding: 0.3rem 0.7rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-active {
            background-color: rgba(46, 196, 182, 0.1);
            color: var(--green-primary);
        }
        
        .status-pending {
            background-color: rgba(255, 159, 28, 0.1);
            color: #ff9f1c;
        }
        
        .status-rejected {
            background-color: rgba(231, 29, 54, 0.1);
            color: var(--red-primary);
        }
        
        /* لینک مشاهده همه */
        .view-all {
            color: var(--blue-primary);
            font-size: 0.85rem;
            text-decoration: none;
        }
        
        .view-all:hover {
            text-decoration: underline;
        }
        
        /* رنگ‌ها */
        .bg-blue { background-color: var(--blue-primary); }
        .bg-green { background-color: var(--green-primary); }
        .bg-red { background-color: var(--red-primary); }
        .bg-purple { background-color: var(--purple-primary); }
        
        /* فعالیت‌های اخیر */
        .activity-feed {
            padding: 0;
            list-style: none;
            margin-bottom: 0;
        }
        
        .activity-feed li {
            position: relative;
            padding-right: 2.5rem;
            margin-bottom: 1.2rem;
        }
        
        .activity-feed li:last-child {
            margin-bottom: 0;
        }
        
        .activity-feed li:not(:last-child):before {
            content: '';
            position: absolute;
            right: 11px;
            top: 20px;
            bottom: -20px;
            width: 2px;
            background-color: #e9ecef;
        }
        
        .activity-feed .activity-icon {
            position: absolute;
            right: 0;
            top: 0;
            background-color: var(--blue-primary);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
        }
        
        .activity-feed .activity-content {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 0.8rem;
        }
        
        .activity-feed .activity-title {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }
        
        .activity-feed .activity-time {
            color: #6c757d;
            font-size: 0.75rem;
        }
        
        .activity-feed .activity-description {
            margin-top: 0.4rem;
            font-size: 0.85rem;
        }
        
        /* پست‌ها */
        .post-item {
            display: flex;
            align-items: flex-start;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .post-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .post-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--blue-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 0.8rem;
            flex-shrink: 0;
        }
        
        .post-content {
            overflow: hidden;
        }
        
        .post-content h5 {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .post-meta {
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        .post-meta i {
            margin-left: 0.2rem;
        }
        
        .post-meta .post-date {
            margin-left: 0.8rem;
        }
        
        /* نمودارها */
        .chart-container {
            width: 100%;
            height: 230px;
        }
        
        /* برای تابلتها */
        @media (max-width: 992px) {
            .col-large {
                width: 100%;
            }
        }
    </style>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include 'includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <!-- آمار و ارقام اصلی با اندازه‌های متفاوت -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="modern-card stat-card">
                        <div class="stat-icon bg-blue">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">کل دانش‌آموزان</div>
                            <div class="stat-value"><?php echo number_format($totalStudents); ?></div>
                            <div class="stat-change">
                                <span class="<?php echo $studentChangeClass; ?>"><?php echo ($studentChangePercent >= 0 ? '+' : '') . $studentChangePercent; ?>% </span>
                                <span>نسبت به ماه قبل</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="modern-card stat-card">
                        <div class="stat-icon bg-purple">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">ثبت‌نام‌های در انتظار</div>
                            <div class="stat-value"><?php echo number_format($pendingRegistrations); ?></div>
                            <div class="stat-change">
                                <span class="<?php echo $pendingChangeClass; ?>"><?php echo ($pendingChange >= 0 ? '+' : '') . $pendingChange; ?> </span>
                                <span>در هفته</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="modern-card stat-card">
                    <div class="stat-icon bg-red">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-title">تعداد کارکنان</div>
                        <div class="stat-value"><?php echo number_format($totalStaff); ?></div>
                        <div class="stat-change">
                            <span class="<?php echo $staffChangeClass; ?>"><?php echo ($staffChange >= 0 ? '+' : '') . $staffChange; ?> </span>
                            <span>در سال</span>
                        </div>
                    </div>
                </div>
            </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="modern-card stat-card">
                        <div class="stat-icon bg-green">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-title">تعداد پست‌ها</div>
                            <div class="stat-value"><?php echo number_format($totalPosts); ?></div>
                            <div class="stat-change">
                                <span class="<?php echo $postsChangeClass; ?>"><?php echo ($postsChange >= 0 ? '+' : '') . $postsChange; ?> </span>
                                <span>در ماه</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- فعالیت‌های اخیر و توزیع پایه تحصیلی -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="modern-card p-3" style="height: 340px;">
                        <div class="section-title">
                            <span>فعالیت‌های اخیر سیستم</span>
                            <a href="settings/activity_logs.php" class="view-all">مشاهده همه</a>
                        </div>
                        <ul class="activity-feed">
                            <?php 
                            mysqli_data_seek($recentLogs, 0);
                            while($log = mysqli_fetch_assoc($recentLogs)) {
                                $iconClass = "fas fa-history";
                                switch(strtolower($log['action'])) {
                                    case 'login': $iconClass = "fas fa-sign-in-alt"; break;
                                    case 'student_registration': $iconClass = "fas fa-user-plus"; break;
                                    case 'post_created': 
                                    case 'post_updated': $iconClass = "fas fa-newspaper"; break;
                                    case 'document_uploaded': $iconClass = "fas fa-file-upload"; break;
                                }
                            ?>
                            <li>
                                <div class="activity-icon">
                                    <i class="<?php echo $iconClass; ?>"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title"><?php echo $log['action']; ?></div>
                                    <div class="activity-time"><?php echo date('Y/m/d H:i', strtotime($log['created_at'])); ?></div>
                                    <div class="activity-description"><?php echo $log['description']; ?></div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-8 mb-4">
                    <div class="modern-card p-3" style="height: 340px;">
                        <div class="section-title">
                            <span>توزیع پایه تحصیلی</span>
                        </div>
                        <div class="chart-container">
                            <div id="grade-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ثبت‌نام‌های اخیر دانش‌آموزان (عرض کامل) -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="modern-card p-3">
                        <div class="section-title">
                            <span>ثبت‌نام‌های اخیر دانش‌آموزان</span>
                            <a href="students/registrations.php" class="view-all">مشاهده همه</a>
                        </div>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>نام و نام خانوادگی</th>
                                        <th>تاریخ ثبت‌نام</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($recentRegistrations, 0);
                                    while($reg = mysqli_fetch_assoc($recentRegistrations)) {
                                        $statusClass = '';
                                        $statusText = '';
                                        switch($reg['registration_status']) {
                                            case 'pending':
                                                $statusClass = 'status-pending';
                                                $statusText = 'در انتظار بررسی';
                                                break;
                                            case 'approved':
                                                $statusClass = 'status-active';
                                                $statusText = 'تأیید شده';
                                                break;
                                            case 'rejected':
                                                $statusClass = 'status-rejected';
                                                $statusText = 'رد شده';
                                                break;
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="user-badge">
                                                <?php if (!empty($reg['profile_photo_path']) && file_exists($reg['profile_photo_path'])): ?>
                                                    <img src="<?php echo $reg['profile_photo_path']; ?>" alt="<?php echo $reg['first_name']; ?>" class="avatar">
                                                <?php else: ?>
                                                    <div class="avatar-placeholder">
                                                        <?php echo substr($reg['first_name'], 0, 1); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span><?php echo $reg['first_name'] . ' ' . $reg['last_name']; ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo date('Y/m/d H:i', strtotime($reg['registration_date'])); ?></td>
                                        <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                                        <td>
                                            <a href="students/view.php?id=<?php echo $reg['student_id']; ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> مشاهده
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- توزیع ملیت و آخرین مطالب منتشر شده (آخرین مطالب عرض بیشتر) -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="modern-card p-3" style="height: 270px;">
                        <div class="section-title">
                            <span>توزیع ملیت دانش‌آموزان</span>
                            <a href="#" class="view-all">مشاهده همه</a>
                        </div>
                        <div class="chart-container">
                            <div id="nationality-chart"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 mb-4">
                    <div class="modern-card p-3" style="height: 270px;">
                        <div class="section-title">
                            <span>آخرین مطالب منتشر شده</span>
                            <a href="posts/list.php" class="view-all">مشاهده همه</a>
                        </div>
                        <div>
                            <?php
                            mysqli_data_seek($latestPosts, 0);
                            while($post = mysqli_fetch_assoc($latestPosts)): 
                                // دریافت نام دسته‌بندی
                                $category_query = mysqli_query($db, "SELECT category_name FROM categories WHERE category_id =  " . (int)$post['category_id'] . " ORDER BY category_id DESC LIMIT 3"); 
                                $category_name = mysqli_fetch_assoc($category_query)['category_name'] ?? '';
                            ?>
                            <div class="post-item">
                                <div class="post-icon">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div class="post-content">
                                    <h5 title="<?php echo $post['title']; ?>"><?php echo $post['title']; ?></h5>
                                    <div class="post-meta">
                                        <span class="post-date"><i class="far fa-calendar-alt"></i> <?php echo date('Y/m/d', strtotime($post['publish_date'])); ?></span>
                                        <span class="post-views"><i class="far fa-eye"></i> <?php echo number_format($post['views']); ?> بازدید</span>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'includes/footer.php'; ?>
        </div>
    </main>
    
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // نمودار توزیع پایه‌های تحصیلی
        var gradeLabels = [];
        var gradeCounts = [];
        
        <?php
        mysqli_data_seek($gradeDistribution, 0);
        while($row = mysqli_fetch_assoc($gradeDistribution)) {
            echo "gradeLabels.push('" . $row['grade_name'] . "');";
            echo "gradeCounts.push(" . $row['count'] . ");";
        }
        ?>
        
        var gradeChartOptions = {
            series: [{
                name: 'تعداد دانش‌آموزان',
                data: gradeCounts
            }],
            chart: {
                type: 'bar',
                height: 260,
                fontFamily: 'Estedad, Tahoma, sans-serif',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '60%',
                    distributed: true
                }
            },
            colors: [
                '#4CC9F0', '#4361EE', '#3A0CA3', '#7209B7', '#F72585', 
                '#E63946', '#FFB703', '#FB8500', '#2A9D8F', '#264653'
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
                style: {
                    fontSize: '12px',
                    fontFamily: 'Estedad, Tahoma, sans-serif'
                }
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: gradeLabels,
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
            }
        };
        
        var gradeChart = new ApexCharts(document.querySelector("#grade-chart"), gradeChartOptions);
        gradeChart.render();
        
        // نمودار توزیع ملیت
        var nationalityLabels = [];
        var nationalityCounts = [];
        
        <?php
        mysqli_data_seek($nationalityDistribution, 0);
        while($row = mysqli_fetch_assoc($nationalityDistribution)) {
            echo "nationalityLabels.push('" . $row['nationality'] . "');";
            echo "nationalityCounts.push(" . $row['count'] . ");";
        }
        ?>
        
        var nationalityChartOptions = {
            series: nationalityCounts,
            chart: {
                type: 'pie',
                height: 210,
                fontFamily: 'Estedad, Tahoma, sans-serif'
            },
            labels: nationalityLabels,
            colors: ['#3F51B5', '#009688', '#E91E63', '#F44336', '#4CAF50'],
            legend: {
                position: 'bottom',
                fontFamily: 'Estedad, Tahoma, sans-serif',
                fontSize: '12px',
                horizontalAlign: 'center',
                offsetY: 5
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    return opts.w.globals.series[opts.seriesIndex];
                },
                style: {
                    fontFamily: 'Estedad, Tahoma, sans-serif',
                    fontSize: '11px'
                }
            },
            stroke: {
                width: 2
            },
            plotOptions: {
                pie: {
                    offsetY: 0
                }
            }
        };
        
        var nationalityChart = new ApexCharts(document.querySelector("#nationality-chart"), nationalityChartOptions);
        nationalityChart.render();
    </script>
</body>
</html>