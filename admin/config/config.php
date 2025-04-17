<?php
// شروع جلسه
session_start();

// تنظیمات پایگاه داده
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'salman';

// اتصال به پایگاه داده
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
mysqli_set_charset($db, "utf8");

// بررسی اتصال به پایگاه داده
if (!$db) {
    die("خطا در اتصال به پایگاه داده: " . mysqli_connect_error());
}

// تنظیم مسیرهای ثابت سایت
$ROOT_URL = '/salman'; // مسیر ریشه سایت (تغییر دهید اگر متفاوت است)
$ADMIN_URL = $ROOT_URL . '/admin'; // مسیر پنل ادمین
$ASSETS_URL = $ROOT_URL . '/assets'; // مسیر فایل‌های استاتیک
$ADMIN_ASSETS_URL = $ADMIN_URL . '/assets'; // مسیر فایل‌های استاتیک ادمین
$IMAGES_URL = $ASSETS_URL . '/images'; // مسیر تصاویر

// مسیر شامل‌ها
$INCLUDE_PATH = dirname(__DIR__) . '/includes';

// نام مجتمع
$SCHOOL_NAME = 'مجتمع آموزشی سلمان فارسی';
$SCHOOL_NAME_EN = 'Salman Farsi Educational Complex';

// =================== توابع مسیردهی ===================

/**
 * مسیر سایت اصلی را برمی‌گرداند
 */
function site_url($path = '') {
    global $ROOT_URL;
    return $ROOT_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * مسیر پنل ادمین را برمی‌گرداند
 */
function admin_url($path = '') {
    global $ADMIN_URL;
    return $ADMIN_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * مسیر فایل‌های استاتیک را برمی‌گرداند
 */
function asset_url($path = '') {
    global $ASSETS_URL;
    return $ASSETS_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * مسیر فایل‌های استاتیک ادمین را برمی‌گرداند
 */
function admin_asset_url($path = '') {
    global $ADMIN_ASSETS_URL;
    return $ADMIN_ASSETS_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * مسیر تصاویر را برمی‌گرداند
 */
function image_url($path = '') {
    global $IMAGES_URL;
    return $IMAGES_URL . ($path ? '/' . ltrim($path, '/') : '');
}

/**
 * مسیر تصاویر آپلود شده را برمی‌گرداند
 */
function upload_url($type, $filename = '') {
    global $ROOT_URL;
    
    $paths = [
        'blog' => '/assets/images/blog',
        'blog_extra' => '/assets/images/blog/Extra_Post_Images',
        'staff' => '/assets/images/Staff',
        'avatar' => '/assets/images/avatar',
        'profile' => '/Registration/uploads/profile_photos',
        'documents' => '/Registration/uploads/documents'
    ];
    
    if (!isset($paths[$type])) {
        return '';
    }
    
    if (empty($filename)) {
        return $ROOT_URL . $paths[$type];
    }
    
    // اگر فایل‌نام شامل مسیر کامل است، فقط نام فایل را استخراج می‌کنیم
    if (strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
        $filename = basename($filename);
    }
    
    return $ROOT_URL . $paths[$type] . '/' . $filename;
}

// نمایش اطلاعات دیباگ مسیرها (فقط در محیط توسعه)
if (isset($_GET['debug_paths'])) {
    echo "<pre>";
    echo "ROOT_URL: " . $ROOT_URL . "\n";
    echo "ADMIN_URL: " . $ADMIN_URL . "\n";
    echo "ASSETS_URL: " . $ASSETS_URL . "\n";
    echo "ADMIN_ASSETS_URL: " . $ADMIN_ASSETS_URL . "\n";
    echo "IMAGES_URL: " . $IMAGES_URL . "\n";
    echo "</pre>";
    
    echo "<pre>";
    echo "Example site_url(): " . site_url('index.php') . "\n";
    echo "Example admin_url(): " . admin_url('posts/list.php') . "\n";
    echo "Example asset_url(): " . asset_url('css/style.css') . "\n";
    echo "Example image_url(): " . image_url('logo.png') . "\n";
    echo "Example upload_url(): " . upload_url('blog', 'post1.jpg') . "\n";
    echo "</pre>";
    
    exit;
}
?>