<?php
// محاسبه تعداد ثبت‌نام‌های در انتظار برای نمایش در سایدبار
$pending_count_result = mysqli_query($db, "SELECT COUNT(*) as count FROM registrations WHERE registration_status='pending'");
$pending_count = 0;
if($pending_count_result && $row = mysqli_fetch_assoc($pending_count_result)) {
    $pending_count = $row['count'];
}
?>

<style>
    /* Fixed Sidebar Styles */
    .sidenav-container {
        position: fixed;
        top: 0;
        right: 0;
        width: 250px;
        height: 100vh;
        background: white;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        z-index: 1200;
    }
    
    .sidenav-header {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .sidenav-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    
    .sidenav-logo img {
        width: 225px;
        height: 45px;
        margin-left: 10px;
    }
    
    .sidenav-logo span {
        font-weight: bold;
        font-size: 1.1rem;
        color: #333;
    }
    
    .sidenav-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px 0;
    }
    
    /* Hide scrollbar for Chrome, Safari and Opera */
    .sidenav-body::-webkit-scrollbar {
        display: none;
    }
    
    /* Hide scrollbar for IE, Edge and Firefox */
    .sidenav-body {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    
    .sidenav-section {
        margin-bottom: 15px;
    }
    
    .sidenav-section-title {
        padding: 5px 20px;
        font-size: 0.7rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #1473e6;
        margin-bottom: 5px;
    }
    
    .sidenav-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidenav-menu-item {
        padding: 0 10px;
    }
    
    .sidenav-menu-link {
        display: flex;
        align-items: center;
        padding: 10px;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    
    .sidenav-menu-link:hover {
        background: #f5f8fd;
    }
    
    .sidenav-menu-link.active {
        background: #e6f2ff;
        color: #1473e6;
        font-weight: 500;
    }
    
    .sidenav-menu-icon {
        width: 20px;
        text-align: center;
        margin-left: 10px;
    }
    
    .sidenav-menu-text {
        flex: 1;
    }
    
    .sidenav-menu-badge {
        padding: 2px 6px;
        font-size: 0.7rem;
        border-radius: 10px;
        background: #dc3545;
        color: white;
        font-weight: bold;
    }
    
    .sidenav-footer {
        padding: 15px;
        border-top: 1px solid #f0f0f0;
    }
    
    .sidenav-logout {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .sidenav-logout:hover {
        background: #d32f2f;
        color: white;
    }
    
    .sidenav-logout i {
        margin-left: 8px;
    }
    
    /* Main content margin */
    .main-content {
        margin-right: 250px;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .sidenav-container {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        
        .sidenav-container.show {
            transform: translateX(0);
        }
        
        .main-content {
            margin-right: 0;
        }
        
        .sidenav-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            display: none;
        }
        
        .sidenav-backdrop.show {
            display: block;
        }
    }
</style>

<div class="sidenav-backdrop" id="sidenavBackdrop" onclick="toggleSidebar()"></div>

<div class="sidenav-container" id="sidenavContainer">
    <!-- Sidebar Header with Logo -->
    <div class="sidenav-header">
        <a href="<?php echo site_url(); ?>" class="sidenav-logo">
            <img src="assets/Media/logo/farsi-logo.png" alt="<?php echo $SCHOOL_NAME; ?>">
        </a>
    </div>
    
    <!-- Sidebar Body with Menu -->
    <div class="sidenav-body">
        <!-- Dashboard -->
        <div class="sidenav-section">
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url(); ?>" class="sidenav-menu-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-home"></i>
                        </span>
                        <span class="sidenav-menu-text">داشبورد</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Content Management -->
        <div class="sidenav-section">
            <div class="sidenav-section-title">مدیریت محتوا</div>
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('posts/list.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/posts/') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-newspaper text-success"></i>
                        </span>
                        <span class="sidenav-menu-text">اخبار و مقالات</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('categories/list.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/categories/') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-tag text-success"></i>
                        </span>
                        <span class="sidenav-menu-text">دسته‌بندی‌ها</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('reviews/list.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/reviews/') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-comment text-success"></i>
                        </span>
                        <span class="sidenav-menu-text">نظرات و تجربیات</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('gallery/manage.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/gallery/') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-images text-success"></i>
                        </span>
                        <span class="sidenav-menu-text">گالری تصاویر</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Student Management -->
        <div class="sidenav-section">
            <div class="sidenav-section-title">مدیریت دانش‌آموزان</div>
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('students/registrations.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/students/registrations.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-user-plus text-warning"></i>
                        </span>
                        <span class="sidenav-menu-text">ثبت‌نام‌های جدید</span>
                        <?php if($pending_count > 0): ?>
                            <span class="sidenav-menu-badge"><?php echo $pending_count; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('students/list.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/students/list.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-user-graduate text-warning"></i>
                        </span>
                        <span class="sidenav-menu-text">لیست دانش‌آموزان</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('students/parents.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/students/parents.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-users text-warning"></i>
                        </span>
                        <span class="sidenav-menu-text">والدین</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('students/documents.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/students/documents.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-file-alt text-warning"></i>
                        </span>
                        <span class="sidenav-menu-text">مدارک</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Staff Management -->
        <div class="sidenav-section">
            <div class="sidenav-section-title">مدیریت کارکنان</div>
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('staff/list.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/staff/list.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-chalkboard-teacher text-info"></i>
                        </span>
                        <span class="sidenav-menu-text">لیست کارکنان</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('staff/add.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/staff/add.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-user-plus text-info"></i>
                        </span>
                        <span class="sidenav-menu-text">افزودن کارمند</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Transportation -->
        <div class="sidenav-section">
            <div class="sidenav-section-title">سرویس ایاب و ذهاب</div>
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('transportation/routes.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/transportation/routes.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-route text-danger"></i>
                        </span>
                        <span class="sidenav-menu-text">مسیرهای سرویس</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('transportation/assignments.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/transportation/assignments.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-bus-alt text-danger"></i>
                        </span>
                        <span class="sidenav-menu-text">تخصیص دانش‌آموزان</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Communications -->
        <div class="sidenav-section">
            <div class="sidenav-section-title">ارتباطات</div>
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('communications/contact_messages.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/communications/contact_messages.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-envelope text-secondary"></i>
                        </span>
                        <span class="sidenav-menu-text">پیام‌های تماس با ما</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('communications/newsletter.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/communications/newsletter.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-paper-plane text-secondary"></i>
                        </span>
                        <span class="sidenav-menu-text">خبرنامه</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('communications/email_sender.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/communications/email_sender.php') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-mail-bulk text-secondary"></i>
                        </span>
                        <span class="sidenav-menu-text">ارسال ایمیل</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- System -->
        <div class="sidenav-section">
            <div class="sidenav-section-title">سیستم</div>
            <ul class="sidenav-menu">
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('reports/students.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/reports/') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-chart-bar text-dark"></i>
                        </span>
                        <span class="sidenav-menu-text">گزارش‌ها</span>
                    </a>
                </li>
                <li class="sidenav-menu-item">
                    <a href="<?php echo admin_url('settings/general.php'); ?>" class="sidenav-menu-link <?php echo (strpos($_SERVER['PHP_SELF'], '/settings/') !== false) ? 'active' : ''; ?>">
                        <span class="sidenav-menu-icon">
                            <i class="fas fa-cog text-dark"></i>
                        </span>
                        <span class="sidenav-menu-text">تنظیمات</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Sidebar Footer with Logout Button -->
    <div class="sidenav-footer">
        <a href="<?php echo admin_url('config/loguot-admin.php'); ?>" class="sidenav-logout">
            <i class="fas fa-sign-out-alt"></i>
            خروج از سیستم
        </a>
    </div>
</div>

<script>
    // Toggle sidebar on mobile
    function toggleSidebar() {
        const sidenavContainer = document.getElementById('sidenavContainer');
        const sidenavBackdrop = document.getElementById('sidenavBackdrop');
        
        sidenavContainer.classList.toggle('show');
        sidenavBackdrop.classList.toggle('show');
    }
</script>