<?php
/**
 * Main Configuration File
 */

// Prevent direct script access
if (!defined('BASEPATH')) {
    define('BASEPATH', true);
}

// ======================= //
// TIME ZONE CONFIGURATION //
// ======================= //
date_default_timezone_set('Asia/Dubai');

// ======================= //
// SESSION CONFIGURATION   //
// ======================= //
$session_timeout = 1800; // 30 minutes (1800 seconds)
$session_name = 'salman_session';

// IMPORTANT: Check if session is already started before trying to configure it
if (session_status() == PHP_SESSION_NONE) {
    // Session security settings - set these BEFORE starting the session
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.gc_maxlifetime', $session_timeout);
    
    // Cookie settings - set these BEFORE starting the session
    session_name($session_name);
    session_set_cookie_params([
        'lifetime' => $session_timeout,
        'path'     => '/',
        'domain'   => '',
        'secure'   => false, // Change to true in production environment
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    // Now it's safe to start the session
    session_start();
} 

// Update last activity time for existing sessions
$_SESSION['last_activity'] = time();

// Check for session timeout and auto-logout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    session_unset();
    session_destroy();
    // Redirect to login page if in admin section
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        header('Location: ../login/index.php?expired=1');
        exit;
    }
}


// Start or continue session
if (!session_id()) {
    session_start();
}

// Check for session timeout and auto-logout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    session_unset();
    session_destroy();
    // Redirect to login page if in admin section
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        header('Location: ../login/index.php?expired=1');
        exit;
    }
}
$_SESSION['last_activity'] = time();

// ======================= //
// DATABASE CONFIGURATION  //
// ======================= //
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'salman');

// Create database connection
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$db) {
    die("Database connection error: " . mysqli_connect_error());
}
mysqli_set_charset($db, "utf8mb4");

// ======================= //
// SITE CONFIGURATION      //
// ======================= //
define('SITE_NAME', 'مجتمع آموزشی سلمان فارسی');
define('SITE_NAME_EN', 'Salman Farsi Educational Complex');
define('SITE_NAME_AR', 'مجمع سلمان الفارسی التعلیمی');
define('SITE_URL', 'http://localhost/web');
define('ADMIN_EMAIL', 'admin@salmanschool.ae');

// ======================= //
// LANGUAGE CONFIGURATION  //
// ======================= //

// همیشه زبان پیش‌فرض را تنظیم کن اگر تنظیم نشده باشد
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fa'; // زبان پیش‌فرض فارسی
}

// بررسی اگر پارامتر زبان در URL وجود دارد و آپدیت نشست
if (isset($_GET['lang']) && in_array($_GET['lang'], ['fa', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// همیشه ریدایرکت برای اضافه کردن پارامتر زبان اگر وجود ندارد (به جز در صفحه index.php)
if (!isset($_GET['lang']) && basename($_SERVER['PHP_SELF']) !== 'index.php' && !headers_sent()) {
    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $connector = (strpos($current_url, '?') !== false) ? '&' : '?';
    $redirect_url = $current_url . $connector . 'lang=' . $_SESSION['lang'];
    
    header("Location: $redirect_url");
    exit;
}

$current_language = $_SESSION['lang'];
$dir = ($current_language == 'fa') ? 'rtl' : 'ltr';
// اطمینان از حفظ پارامتر زبان در لینک‌های داخلی
function processInternalLinks() {
    if (!headers_sent()) {
        ob_start(function($buffer) {
            $lang = getCurrentLanguage();
            
            // این الگو همه لینک‌های <a href="..."> را می‌گیرد
            $pattern = '/<a([^>]*?)href=["\']([^"\']*?)["\']([^>]*?)>/i';
            
            return preg_replace_callback($pattern, function($matches) use ($lang) {
                $url = $matches[2];
                
                // فقط پردازش فایل‌های PHP (لینک‌های داخلی)
                if (preg_match('/\.php($|\?)/', $url) && strpos($url, 'lang=') === false && strpos($url, '://') === false) {
                    $connector = (strpos($url, '?') !== false) ? '&' : '?';
                    $url .= $connector . 'lang=' . $lang;
                    return '<a' . $matches[1] . 'href="' . $url . '"' . $matches[3] . '>';
                }
                
                return $matches[0];
            }, $buffer);
        });
    }
}

/**
 * ایجاد URL برای تغییر زبان که صفحه فعلی را حفظ می‌کند
 * 
 * @param string $targetLang زبان مقصد (en یا fa)
 * @return string URL برای تغییر زبان
 */
function getLanguageSwitchUrl($targetLang) {
    $url = $_SERVER['REQUEST_URI'];
    
    // حذف پارامتر زبان موجود
    $url = preg_replace('/([?&])lang=[^&]+(&|$)/', '$1', $url);
    
    // پاکسازی URL
    $url = rtrim($url, '?&');
    
    // اضافه کردن پارامتر زبان جدید
    $connector = (strpos($url, '?') !== false) ? '&' : '?';
    
    return $url . $connector . 'lang=' . $targetLang;
}

// شروع بافر خروجی برای پردازش لینک‌ها
processInternalLinks();

// ======================= //
// HELPER FUNCTIONS        //
// ======================= //

/**
 * Sanitize input data
 *
 * @param string $data Input data
 * @return string Sanitized data
 */
function clean($data) {
    global $db;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($db) {
        $data = mysqli_real_escape_string($db, $data);
    }
    return $data;
}

/**
 * Check if user is logged in
 *
 * @return bool True if logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['admin-login']);
}

/**
 * Redirect to another page
 *
 * @param string $url Target URL
 * @return void
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Load translation JSON file
 *
 * @param string $language Language code (fa or en)
 * @return array Array of translations
 */
function loadTranslations($language) {
    $json_file = __DIR__ . '/../languages/' . $language . '.json';
    if (file_exists($json_file)) {
        $json_content = file_get_contents($json_file);
        return json_decode($json_content, true);
    }
    return [];
}

// Load translations
$translations = loadTranslations($current_language);

/**
 * Translate text by key
 *
 * @param string $key Translation key (e.g., "Header.home")
 * @return string Translated text or original key if translation not found
 */
function __($key) {
    global $translations;
    if (strpos($key, '.') === false) {
        return isset($translations[$key]) ? $translations[$key] : $key;
    }
    $keys = explode('.', $key);
    $value = $translations;
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $key;
        }
    }
    return is_string($value) ? $value : $key;
}

/**
 * Create new database connection using OOP (if needed)
 *
 * @return mysqli Database connection
 */
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

/**
 * Close database connection
 *
 * @param mysqli $conn Database connection
 */
function closeDB($conn) {
    $conn->close();
}

/**
 * Get current language
 *
 * @return string Current language code (en or fa)
 */
function getCurrentLanguage() {
    return isset($_SESSION['lang']) ? $_SESSION['lang'] : 'fa';
}

/**
 * Truncate text to specified length
 *
 * @param string $text Original text
 * @param int $length Maximum length
 * @return string Truncated text
 */
function truncateText($text, $length = 150) {
    if (mb_strlen($text) > $length) {
        return mb_substr($text, 0, $length) . '...';
    }
    return $text;
}

/**
 * Convert Gregorian date to Jalali (Persian) date
 * 
 * @param string $date Gregorian date
 * @param bool $withNumbers Convert numbers to Persian (optional)
 * @return string Jalali date
 */
function gregorianToJalali($date, $withNumbers = true) {
    $date_array = explode("-", date("Y-m-d", strtotime($date)));
    $g_y = $date_array[0];
    $g_m = $date_array[1];
    $g_d = $date_array[2];
    
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    
    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;
    
    $g_day_no = 365 * $gy + intval(($gy + 3) / 4) - intval(($gy + 99) / 100) + intval(($gy + 399) / 400);
    
    for ($i = 0; $i < $gm; ++$i) {
        $g_day_no += $g_days_in_month[$i];
    }
    
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0))) {
        $g_day_no++;
    }
    
    $g_day_no += $gd;
    
    $j_day_no = $g_day_no - 79;
    
    $j_np = intval($j_day_no / 12053);
    $j_day_no = $j_day_no % 12053;
    
    $jy = 979 + 33 * $j_np + 4 * intval($j_day_no / 1461);
    
    $j_day_no %= 1461;
    
    if ($j_day_no >= 366) {
        $jy += intval(($j_day_no - 1) / 365);
        $j_day_no = ($j_day_no - 1) % 365;
    }
    
    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i) {
        $j_day_no -= $j_days_in_month[$i];
    }
    
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    
    // Persian month names
    $jalali_months = array(
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند'
    );
    
    $result = $jd . ' ' . $jalali_months[$jm] . ' ' . $jy;
    
    // Convert numbers to Persian if requested
    if ($withNumbers) {
        $result = convertToFarsiNumber($result);
    }
    
    return $result;
}

/**
 * Format date according to language
 * 
 * @param string $date Date string
 * @param string $lang Language code (en or fa)
 * @return string Formatted date
 */
function formatDate($date, $lang = 'en') {
    if ($lang == 'en') {
        return date('F j, Y', strtotime($date));
    } else {
        // Convert to Persian date for Farsi language
        return gregorianToJalali($date, true);
    }
}

$translationsFallback = [
    // مقادیر پیش‌فرض کلیدهای پرکاربرد
    'header.home' => [
        'fa' => 'خانه',
        'en' => 'Home',
        'ar' => 'الرئيسية'
    ],
    'header.about' => [
        'fa' => 'درباره ما',
        'en' => 'About Us',
        'ar' => 'من نحن'
    ],
    'header.contact' => [
        'fa' => 'تماس با ما',
        'en' => 'Contact Us',
        'ar' => 'اتصل بنا'
    ],
    'header.services' => [
        'fa' => 'خدمات',
        'en' => 'Services',
        'ar' => 'خدمات'
    ]
    // سایر کلیدهای مورد نیاز را می‌توانید اضافه کنید
];
define('DEV_MODE', true);
// Use fallback translations if JSON translations are not loaded
if (empty($translations)) {
    $translations = $translationsFallback;
}

/**
 * Get translation from fallback array
 *
 * @param string $key Text key
 * @param string $lang Language code (fa or en)
 * @return string Translated text or original key
 */
function t($key, $lang) {
    global $translations;
    return isset($translations[$key][$lang]) ? $translations[$key][$lang] : $key;
}
/**
 * تبدیل اعداد انگلیسی به فارسی
 * 
 * @param string|int $number عدد یا رشته حاوی اعداد انگلیسی
 * @return string رشته حاوی اعداد فارسی
 */
function convertToFarsiNumber($number) {
    $farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    
    return str_replace($englishDigits, $farsiDigits, (string)$number);
}

/**
 * نمایش شماره تلفن با فرمت مناسب زبان
 * 
 * @param string $phone شماره تلفن
 * @param string $lang زبان (en یا fa)
 * @return string شماره تلفن فرمت‌بندی شده
 */
function formatPhone($phone, $lang = 'en') {
    // حذف کاراکترهای غیر عددی
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    
    // فرمت‌بندی شماره تلفن
    if (strlen($cleanPhone) >= 10) {
        // برای اعداد طولانی مثل شماره موبایل با کد کشور
        $formattedPhone = '+' . substr($cleanPhone, 0, 3) . ' ' . substr($cleanPhone, 3, 2) . ' ' . substr($cleanPhone, 5, 3) . ' ' . substr($cleanPhone, 8);
    } else {
        // برای شماره‌های کوتاه‌تر
        $formattedPhone = $phone;
    }
    
    // تبدیل به فارسی برای زبان فارسی
    if ($lang == 'fa') {
        return convertToFarsiNumber($formattedPhone);
    }
    
    return $formattedPhone;
}

// Default redirection to English language
if (!defined('REDIRECT_DONE')) {
    define('REDIRECT_DONE', true);
    
    // If language parameter is not set
    if (!isset($_GET['lang'])) {
        // Create new URL with English language parameter
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $connector = (strpos($current_url, '?') !== false) ? '&' : '?';
        $redirect_url = $current_url . $connector . 'lang=en';
        
        // Redirect to new URL
        header("Location: $redirect_url");
        exit;
    }
}

?>


