<!-- Add Bootstrap 5 CSS and FontAwesome if not already included -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* Simple navbar styling */
.admin-top-navbar {
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 10px 0;
    margin-bottom: 20px;
}

.admin-navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px;
}

.admin-navbar-left {
    display: flex;
    align-items: center;
}

.admin-navbar-right {
    display: flex;
    align-items: center;
}

.admin-toggle-btn {
    background: none;
    border: none;
    font-size: 20px;
    margin-left: 15px;
    cursor: pointer;
}

.admin-title {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

.admin-navbar-item {
    margin-right: 15px;
}

.admin-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    position: relative;
}

.admin-notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: #dc3545;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-user-btn {
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    border: 1px solid #e0e0e0;
    border-radius: 20px;
    padding: 5px 10px;
}

.admin-avatar {
    width: 28px;
    height: 28px;
    background-color: #0d6efd;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 8px;
    font-size: 14px;
    font-weight: bold;
}

/* Custom dropdown styles to fix the close issue */
.admin-dropdown {
    position: relative;
    display: inline-block;
}

.admin-dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background-color: white;
    min-width: 200px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    z-index: 1000;
    border-radius: 4px;
    padding: 8px 0;
    margin-top: 5px;
}

.admin-dropdown-menu.show {
    display: block;
}

.admin-dropdown-header {
    padding: 6px 16px;
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
    border-bottom: 1px solid #e9ecef;
    margin-bottom: 5px;
}

.admin-dropdown-item {
    display: block;
    width: 100%;
    padding: 8px 16px;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    text-decoration: none;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

.admin-dropdown-item:hover, .admin-dropdown-item:focus {
    color: #16181b;
    text-decoration: none;
    background-color: #f8f9fa;
}

.admin-dropdown-divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #e9ecef;
}

.admin-dropdown-icon {
    margin-left: 10px;
    width: 16px;
    text-align: center;
}

.text-danger {
    color: #dc3545;
}

.text-warning {
    color: #ffc107;
}
</style>

<div class="admin-top-navbar">
    <div class="admin-navbar-container">
        <!-- Left side with menu toggle and title -->
        <div class="admin-navbar-left">
    <h1 class="admin-title">
        <?php
        // Get current page path information
        $currentPage = basename($_SERVER['PHP_SELF'], '.php');
        $currentDir = basename(dirname($_SERVER['PHP_SELF']));
        $fullPath = $currentDir . '/' . $currentPage;
        
        // Comprehensive mapping of page titles
        $pageTitles = [
            // Dashboard
            'index' => 'داشبورد مدیریت',
            
            // Students section
            'students/list' => 'لیست دانش‌آموزان',
            'students/view' => 'مشاهده اطلاعات دانش‌آموز',
            'students/registrations' => 'مدیریت ثبت‌نام‌ها',
            'students/documents' => 'مدیریت مدارک دانش‌آموزان',
            'students/parents' => 'اطلاعات والدین',
            
            // Staff section
            'staff/list' => 'لیست کارکنان',
            'staff/add' => 'افزودن کارمند جدید',
            'staff/edit' => 'ویرایش اطلاعات کارمند',
            
            // Posts section
            'posts/list' => 'لیست مطالب',
            'posts/add' => 'افزودن مطلب جدید',
            'posts/edit' => 'ویرایش مطلب',
            
            // Categories section
            'categories/list' => 'لیست دسته‌بندی‌ها',
            'categories/manage' => 'مدیریت دسته‌بندی‌ها',
            
            // Reviews section
            'reviews/list' => 'لیست نظرات',
            'reviews/add' => 'افزودن نظر جدید',
            'reviews/edit' => 'ویرایش نظر',
            
            // Gallery section
            'gallery/manage' => 'مدیریت گالری تصاویر',
            
            // Communications section
            'communications/contact_messages' => 'پیام‌های تماس با ما',
            'communications/email_sender' => 'ارسال ایمیل',
            'communications/newsletter' => 'مدیریت خبرنامه',
            
            // Transportation section
            'transportation/routes' => 'مسیرهای سرویس',
            'transportation/assignments' => 'تخصیص سرویس به دانش‌آموزان',
            
            // Reports section
            'reports/students' => 'گزارش دانش‌آموزان',
            'reports/registrations' => 'گزارش ثبت‌نام‌ها',
            'reports/advanced' => 'گزارش‌های پیشرفته',
            
            // Settings section
            'settings/general' => 'تنظیمات عمومی',
            'settings/admin_users' => 'مدیریت کاربران ادمین',
            'settings/form_options' => 'تنظیمات فرم‌ها',
            'settings/activity_logs' => 'گزارش فعالیت‌ها'
        ];
        
        // Section titles for fallback
        $sectionTitles = [
            'students' => 'مدیریت دانش‌آموزان',
            'staff' => 'مدیریت کارکنان',
            'posts' => 'مدیریت محتوا',
            'categories' => 'مدیریت دسته‌بندی‌ها',
            'reviews' => 'مدیریت نظرات',
            'gallery' => 'گالری تصاویر',
            'communications' => 'مدیریت ارتباطات',
            'transportation' => 'سرویس ایاب و ذهاب',
            'reports' => 'گزارش‌ها',
            'settings' => 'تنظیمات سیستم'
        ];
        
        // Display the appropriate title
        if ($currentPage == 'index' && $currentDir == '') {
            echo 'داشبورد مدیریت';
        } elseif (isset($pageTitles[$fullPath])) {
            echo $pageTitles[$fullPath];
        } elseif (isset($sectionTitles[$currentDir])) {
            echo $sectionTitles[$currentDir];
        } else {
            echo 'پنل مدیریت ' . $SCHOOL_NAME;
        }
        ?>
    </h1>
</div>
        
        <!-- Right side with actions -->
        <div class="admin-navbar-right">
            <!-- Notifications -->
            <div class="admin-navbar-item admin-dropdown">
                <button class="admin-btn" type="button" onclick="toggleDropdown('notificationsDropdown')">
                    <i class="fas fa-bell fa-lg"></i>
                    <?php
                    // Get pending notifications
                    $pending_count = 0;
                    if(isset($db)) {
                        $query = mysqli_query($db, "SELECT COUNT(*) as count FROM registrations WHERE registration_status='pending'");
                        if ($query && $row = mysqli_fetch_assoc($query)) {
                            $pending_count = $row['count'];
                        }
                    }
                    
                    if ($pending_count > 0) {
                        echo '<span class="admin-notification-badge">' . $pending_count . '</span>';
                    }
                    ?>
                </button>
                <div class="admin-dropdown-menu" id="notificationsDropdown">
                    <div class="admin-dropdown-header">اعلان‌ها</div>
                    <?php if ($pending_count > 0): ?>
                    <a class="admin-dropdown-item" href="<?php echo admin_url('students/registrations.php'); ?>">
                        <i class="fas fa-user-plus text-warning admin-dropdown-icon"></i>
                        <span><?php echo $pending_count; ?> ثبت‌نام جدید</span>
                    </a>
                    <?php else: ?>
                    <span class="admin-dropdown-item">اعلان جدیدی ندارید</span>
                    <?php endif; ?>
                    <div class="admin-dropdown-divider"></div>
                    <a class="admin-dropdown-item" href="<?php echo admin_url('settings/activity_logs.php'); ?>">مشاهده همه</a>
                </div>
            </div>
            
            <!-- User menu -->
            <div class="admin-navbar-item admin-dropdown">
                <button class="admin-user-btn" type="button" onclick="toggleDropdown('userDropdown')">
                    <div class="admin-avatar">م</div>
                    <span class="d-none d-md-inline">مدیر سیستم</span>
                </button>
                <div class="admin-dropdown-menu" id="userDropdown">
                    <a class="admin-dropdown-item" href="<?php echo admin_url('settings/admin_users.php?action=profile'); ?>">
                        <i class="fas fa-user-cog admin-dropdown-icon"></i>
                        <span>پروفایل</span>
                    </a>
                    <a class="admin-dropdown-item" href="<?php echo admin_url('settings/general.php'); ?>">
                        <i class="fas fa-cog admin-dropdown-icon"></i>
                        <span>تنظیمات</span>
                    </a>
                    <div class="admin-dropdown-divider"></div>
                    <a class="admin-dropdown-item text-danger" href="<?php echo admin_url('config/loguot-admin.php'); ?>">
                        <i class="fas fa-sign-out-alt admin-dropdown-icon"></i>
                        <span>خروج</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Function to toggle sidebar
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    
    if (sidebar) {
        sidebar.classList.toggle('show');
    }
    
    if (backdrop) {
        backdrop.classList.toggle('show');
    }
}

// Custom dropdown toggle function that prevents immediate closing
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    const allDropdowns = document.querySelectorAll('.admin-dropdown-menu');
    
    // Close all other dropdowns
    allDropdowns.forEach(function(menu) {
        if (menu.id !== id) {
            menu.classList.remove('show');
        }
    });
    
    // Toggle current dropdown
    dropdown.classList.toggle('show');
    
    // Prevent event propagation
    event.stopPropagation();
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.admin-dropdown-menu');
    dropdowns.forEach(function(dropdown) {
        if (!dropdown.parentElement.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
});

// Prevent closing dropdown when clicking inside it
document.querySelectorAll('.admin-dropdown-menu').forEach(function(menu) {
    menu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});
</script>