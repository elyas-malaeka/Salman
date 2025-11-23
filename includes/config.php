<?php
/**
 * Main Configuration File
 * بازنویسی شده با پشتیبانی کامل از زبان عربی و بهبود امنیت
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

// Check if session is already started before configuring it
if (session_status() == PHP_SESSION_NONE) {
    // Session security settings - set these BEFORE starting the session
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.gc_maxlifetime', $session_timeout);
    
    // Enhanced cookie security settings
    $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'; // Automatically detect HTTPS
    session_name($session_name);
    session_set_cookie_params([
        'lifetime' => $session_timeout,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $secure, // Automatic based on connection type
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    // Now it's safe to start the session
    session_start();
}

// Update last activity time for existing sessions
$_SESSION['last_activity'] = time();

// Check for session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    session_unset();
    session_destroy();
    // Redirect to login page if in admin section
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        header('Location: ../login/index.php?expired=1');
        exit;
    }
}

// ======================= //
// DATABASE CONFIGURATION  //
// ======================= //
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pages');


// Create database connection with better error handling
try {
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$db) {
        throw new Exception(mysqli_connect_error());
    }
    mysqli_set_charset($db, "utf8mb4");
} catch (Exception $e) {
    if (defined('DEV_MODE') && DEV_MODE) {
        die("Database connection error: " . $e->getMessage());
    } else {
        die("A database error occurred. Please contact the administrator.");
    }
}

// ======================= //
// SITE CONFIGURATION      //
// ======================= //
define('SITE_NAME', 'مجتمع آموزشی سلمان فارسی');
define('SITE_NAME_EN', 'Salman Farsi Educational Complex');
define('SITE_NAME_AR', 'مجمع سلمان الفارسی التعلیمی');
define('SITE_URL', 'http://localhost/web');
define('ADMIN_EMAIL', 'admin@salmanschool.ae');
define('DEV_MODE', true);

// ======================= //
// LANGUAGE CONFIGURATION  //
// ======================= //

// برخلاف کد قبلی، حالا از زبان عربی هم پشتیبانی می‌کنیم
$supported_languages = ['fa', 'en', 'ar'];
$default_language = 'fa';

// تنظیم زبان پیش‌فرض اگر تنظیم نشده باشد
if (!isset($_SESSION['lang']) || !in_array($_SESSION['lang'], $supported_languages)) {
    $_SESSION['lang'] = $default_language;
}

// بررسی پارامتر زبان در URL و آپدیت نشست
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

// ریدایرکت برای اضافه کردن پارامتر زبان اگر وجود ندارد (به جز در صفحه index.php)
if (!isset($_GET['lang']) && basename($_SERVER['PHP_SELF']) !== 'index.php' && !headers_sent()) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $current_url = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $connector = (strpos($current_url, '?') !== false) ? '&' : '?';
    $redirect_url = $current_url . $connector . 'lang=' . $_SESSION['lang'];
    
    header("Location: $redirect_url");
    exit;
}

$current_language = $_SESSION['lang'];

// تنظیم جهت صفحه بر اساس زبان
$dir = (in_array($current_language, ['fa', 'ar'])) ? 'rtl' : 'ltr';

/**
 * ایجاد URL برای تغییر زبان با حفظ صفحه فعلی
 * 
 * @param string $targetLang زبان مقصد (en, fa, ar)
 * @return string URL برای تغییر زبان
 */
function getLanguageSwitchUrl($targetLang) {
    global $supported_languages;
    
    // بررسی معتبر بودن زبان مقصد
    if (!in_array($targetLang, $supported_languages)) {
        return '#'; // برگشت یک لینک خالی در صورت نامعتبر بودن زبان
    }
    
    $url = $_SERVER['REQUEST_URI'];
    
    // حذف پارامتر زبان موجود
    $url = preg_replace('/([?&])lang=[^&]+(&|$)/', '$1', $url);
    
    // پاکسازی URL
    $url = rtrim($url, '?&');
    
    // اضافه کردن پارامتر زبان جدید
    $connector = (strpos($url, '?') !== false) ? '&' : '?';
    
    return $url . $connector . 'lang=' . $targetLang;
}

/**
 * پردازش لینک‌های داخلی برای حفظ پارامتر زبان
 */
function processInternalLinks() {
    if (!headers_sent()) {
        ob_start(function($buffer) {
            $lang = getCurrentLanguage();
            
            // الگو برای گرفتن لینک‌های <a href="...">
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

// شروع بافر خروجی برای پردازش لینک‌ها
processInternalLinks();

// ======================= //
// TRANSLATION FUNCTIONS   //
// ======================= //

/**
 * بارگذاری فایل ترجمه JSON
 *
 * @param string $language کد زبان (fa, en, ar)
 * @return array آرایه ترجمه‌ها
 */
function loadTranslations($language) {
    global $supported_languages;
    
    // بررسی معتبر بودن زبان
    if (!in_array($language, $supported_languages)) {
        $language = 'fa'; // استفاده از زبان پیش‌فرض اگر زبان نامعتبر است
    }
    
    $json_file = __DIR__ . '/../languages/' . $language . '.json';
    
    if (file_exists($json_file)) {
        $json_content = file_get_contents($json_file);
        $translations = json_decode($json_content, true);
        
        // بررسی خطا در JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Error parsing translation file for language '{$language}': " . json_last_error_msg());
            return [];
        }
        
        return $translations;
    } else {
        error_log("Translation file for language '{$language}' not found at: {$json_file}");
        return [];
    }
}

// ترجمه‌های پیش‌فرض برای کلیدهای اصلی - اکنون با پشتیبانی از عربی
$translationsFallback = [
    'header' => [
        'home' => [
            'fa' => 'خانه',
            'en' => 'Home',
            'ar' => 'الرئيسية'
        ],
        'about' => [
            'fa' => 'درباره ما',
            'en' => 'About Us',
            'ar' => 'من نحن'
        ],
        'contact' => [
            'fa' => 'تماس با ما',
            'en' => 'Contact Us',
            'ar' => 'اتصل بنا'
        ],
        'services' => [
            'fa' => 'خدمات',
            'en' => 'Services',
            'ar' => 'خدمات'
        ],
        'news' => [
            'fa' => 'اخبار',
            'en' => 'News',
            'ar' => 'أخبار'
        ],
        'gallery' => [
            'fa' => 'گالری',
            'en' => 'Gallery',
            'ar' => 'معرض الصور'
        ],
        'language' => [
            'fa' => 'زبان',
            'en' => 'Language',
            'ar' => 'اللغة'
        ]
    ],
    'footer' => [
        'copyright' => [
            'fa' => 'تمامی حقوق محفوظ است',
            'en' => 'All Rights Reserved',
            'ar' => 'جميع الحقوق محفوظة'
        ],
        'address' => [
            'fa' => 'آدرس',
            'en' => 'Address',
            'ar' => 'العنوان'
        ],
        'phone' => [
            'fa' => 'تلفن',
            'en' => 'Phone',
            'ar' => 'الهاتف'
        ],
        'email' => [
            'fa' => 'ایمیل',
            'en' => 'Email',
            'ar' => 'البريد الإلكتروني'
        ]
    ],
    'buttons' => [
        'read_more' => [
            'fa' => 'ادامه مطلب',
            'en' => 'Read More',
            'ar' => 'قراءة المزيد'
        ],
        'submit' => [
            'fa' => 'ارسال',
            'en' => 'Submit',
            'ar' => 'إرسال'
        ],
        'cancel' => [
            'fa' => 'انصراف',
            'en' => 'Cancel',
            'ar' => 'إلغاء'
        ]
    ]
];

// بارگذاری ترجمه‌ها
$translations = loadTranslations($current_language);

// استفاده از ترجمه‌های پیش‌فرض اگر فایل ترجمه بارگذاری نشد
if (empty($translations)) {
    $translations = $translationsFallback;
}

/**
 * ترجمه متن با استفاده از کلید
 *
 * @param string $key کلید ترجمه (مثلاً "header.home")
 * @return string متن ترجمه شده یا کلید اصلی اگر ترجمه یافت نشد
 */
function __($key) {
    global $translations, $translationsFallback, $current_language;
    
    // اگر کلید شامل نقطه نیست، مستقیماً از آرایه اصلی بررسی کنید
    if (strpos($key, '.') === false) {
        if (isset($translations[$key])) {
            return $translations[$key];
        } else {
            // بررسی در ترجمه‌های پیش‌فرض
            if (isset($translationsFallback[$key][$current_language])) {
                return $translationsFallback[$key][$current_language];
            }
            return $key;
        }
    }
    
    // برای کلیدهای چند سطحی (با نقطه)
    $keys = explode('.', $key);
    
    // بررسی در ترجمه‌های اصلی
    $value = $translations;
    $found = true;
    
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            $found = false;
            break;
        }
    }
    
    if ($found && is_string($value)) {
        return $value;
    }
    
    // اگر در ترجمه‌های اصلی یافت نشد، در ترجمه‌های پیش‌فرض بررسی کنید
    $fallback = $translationsFallback;
    $found = true;
    
    foreach ($keys as $k) {
        if (isset($fallback[$k])) {
            $fallback = $fallback[$k];
        } else {
            $found = false;
            break;
        }
    }
    
    if ($found && isset($fallback[$current_language])) {
        return $fallback[$current_language];
    }
    
    // اگر در هیچ کجا یافت نشد، کلید اصلی را برگردانید
    return $key;
}

/**
 * دریافت ترجمه از آرایه پشتیبان
 *
 * @param string $key کلید متن
 * @param string $lang کد زبان (fa, en, ar)
 * @return string متن ترجمه شده یا کلید اصلی
 */
function t($key, $lang) {
    global $translationsFallback, $translations;
    
    // ابتدا در ترجمه‌های اصلی بررسی کنید
    if (isset($translations[$key][$lang])) {
        return $translations[$key][$lang];
    }
    
    // سپس در ترجمه‌های پشتیبان بررسی کنید
    if (isset($translationsFallback[$key][$lang])) {
        return $translationsFallback[$key][$lang];
    }
    
    return $key;
}

// ======================= //
// HELPER FUNCTIONS        //
// ======================= //

/**
 * پاکسازی داده‌های ورودی
 *
 * @param string $data داده ورودی
 * @return string داده پاکسازی شده
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
 * بررسی وضعیت ورود کاربر
 *
 * @return bool درست اگر وارد شده باشد، در غیر این صورت نادرست
 */
function isLoggedIn() {
    return isset($_SESSION['admin-login']) && $_SESSION['admin-login'] === true;
}

/**
 * هدایت به صفحه دیگر
 *
 * @param string $url آدرس مقصد
 * @param int $status_code کد وضعیت HTTP (اختیاری)
 * @return void
 */
function redirect($url, $status_code = 302) {
    header("Location: $url", true, $status_code);
    exit();
}

/**
 * دریافت زبان فعلی
 *
 * @return string کد زبان فعلی (fa, en, ar)
 */
function getCurrentLanguage() {
    global $default_language;
    return isset($_SESSION['lang']) ? $_SESSION['lang'] : $default_language;
}

/**
 * کوتاه کردن متن به طول مشخص
 *
 * @param string $text متن اصلی
 * @param int $length حداکثر طول
 * @return string متن کوتاه شده
 */
function truncateText($text, $length = 150) {
    if (mb_strlen($text) > $length) {
        return mb_substr($text, 0, $length) . '...';
    }
    return $text;
}

/**
 * ایجاد اتصال جدید به پایگاه داده به صورت شی‌گرا
 *
 * @return mysqli اتصال به پایگاه داده
 */
function connectDB() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        if (defined('DEV_MODE') && DEV_MODE) {
            die("Database connection error: " . $e->getMessage());
        } else {
            die("A database error occurred. Please contact the administrator.");
        }
    }
}

/**
 * بستن اتصال پایگاه داده
 *
 * @param mysqli $conn اتصال پایگاه داده
 */
function closeDB($conn) {
    if ($conn instanceof mysqli) {
        $conn->close();
    }
}

/**
 * تبدیل تاریخ میلادی به شمسی (جلالی)
 * 
 * @param string $date تاریخ میلادی
 * @param bool $withNumbers تبدیل اعداد به فارسی (اختیاری)
 * @return string تاریخ شمسی
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
    
    // نام‌های ماه‌های شمسی
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
    
    // تبدیل اعداد به فارسی در صورت درخواست
    if ($withNumbers) {
        $result = convertToFarsiNumber($result);
    }
    
    return $result;
}



/**
 * فرمت‌بندی تاریخ براساس زبان
 * 
 * @param string $date رشته تاریخ
 * @param string $lang کد زبان (fa, en, ar)
 * @return string تاریخ فرمت‌بندی شده
 */
function formatDate($date, $lang = null) {
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    
    switch ($lang) {
        case 'fa':
            return gregorianToJalali($date, true);
            case 'en':
            case 'ar':
        default:
            return date('F j, Y', strtotime($date));
    }
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
 * تبدیل اعداد انگلیسی به عربی
 * 
 * @param string|int $number عدد یا رشته حاوی اعداد انگلیسی
 * @return string رشته حاوی اعداد عربی
 */
function convertToArabicNumber($number) {
    $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    
    return str_replace($englishDigits, $arabicDigits, (string)$number);
}

/**
 * نمایش شماره تلفن با فرمت مناسب زبان
 * 
 * @param string $phone شماره تلفن
 * @param string $lang زبان (en, fa, ar)
 * @return string شماره تلفن فرمت‌بندی شده
 */
function formatPhone($phone, $lang = null) {
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    
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
    
    // تبدیل اعداد به فارسی یا عربی بر اساس زبان
    switch ($lang) {
        case 'fa':
            return convertToFarsiNumber($formattedPhone);
        case 'ar':
            return convertToArabicNumber($formattedPhone);
        case 'en':
        default:
            return $formattedPhone;
    }
}

/**
 * مدیریت خطاها و ثبت آن‌ها
 * 
 * @param string $message پیام خطا
 * @param string $level سطح خطا (error, warning, info)
 * @param bool $display نمایش خطا به کاربر
 * @return void
 */
function logError($message, $level = 'error', $display = false) {
    // ثبت خطا در فایل log
    error_log("[{$level}] " . date('Y-m-d H:i:s') . ": {$message}");
    
    // نمایش خطا به کاربر در حالت توسعه
    if ($display && defined('DEV_MODE') && DEV_MODE) {
        echo "<div class='alert alert-danger'>{$message}</div>";
    }
}

/**
 * کد امنیتی نمایش عکس (تصویر امنیتی)
 * 
 * @param int $length طول کد امنیتی
 * @return string کد امنیتی تولید شده
 */
function generateCaptchaCode($length = 6) {
    $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $code = '';
    $max = strlen($characters) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[random_int(0, $max)];
    }
    
    $_SESSION['captcha_code'] = $code;
    return $code;
}

/**
 * تولید توکن CSRF برای امنیت فرم‌ها
 * 
 * @return string توکن CSRF
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * بررسی توکن CSRF
 * 
 * @param string $token توکن ارسال شده
 * @return bool نتیجه بررسی
 */
function verifyCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

// کد بازنویسی شده برای هدایت پیش‌فرض به زبان درخواستی
if (!isset($_GET['lang'])) {
    // تلاش برای تشخیص زبان مرورگر کاربر
    $browser_lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';
    
    // اگر زبان مرورگر یکی از زبان‌های پشتیبانی شده است، از آن استفاده کنید
    if (in_array($browser_lang, $supported_languages)) {
        $detected_lang = $browser_lang;
    } else {
        // در غیر این صورت از زبان پیش‌فرض استفاده کنید
        $detected_lang = $default_language;
    }
    
    // ایجاد URL جدید با پارامتر زبان
    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $connector = (strpos($current_url, '?') !== false) ? '&' : '?';
    $redirect_url = $current_url . $connector . 'lang=' . $detected_lang;
    
    // هدایت به URL جدید
    if (!headers_sent()) {
        header("Location: $redirect_url");
        exit;
    }
}
?>
<?php
/**
 * تابع نمایش ساعات کاری برای همه زبان‌ها
 * 
 * @param string $display_lang زبان نمایش (fa, en, ar)
 * @return string متن ساعات کاری فرمت‌بندی شده
 */
function displayWorkingHours($display_lang = 'fa') {
    // خواندن تنظیمات از دیتابیس
    $days_start = (int)getConfig('working_days_start', '1');
    $days_end = (int)getConfig('working_days_end', '4');
    $weekday_start = getConfig('working_hours_weekdays_start', '7:00');
    $weekday_end = getConfig('working_hours_weekdays_end', '14:00');
    $friday_start = getConfig('working_hours_friday_start', '7:00');
    $friday_end = getConfig('working_hours_friday_end', '12:00');
    $friday_open = (bool)getConfig('working_friday_open', '1');
    $weekend_open = (bool)getConfig('working_weekend_open', '0');
    
    // نام روزها در زبان‌های مختلف
    $days_names = [
        'fa' => ['یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه'],
        'en' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'ar' => ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت']
    ];
    
    // انتخاب زبان
    $lang = isset($days_names[$display_lang]) ? $display_lang : 'fa';
    $day_names = $days_names[$lang];
    
    // تنظیم کلمات کلیدی بر اساس زبان
    $from_to = ($lang === 'en') ? "%s: %s to %s" : "%s: %s تا %s";
    $closed = ($lang === 'en') ? "Closed" : "تعطیل";
    $and = ($lang === 'en') ? " & " : " و ";
    
    // تبدیل فرمت زمان
    $format_time = function($time) use ($lang) {
        if ($lang === 'en') {
            // تبدیل به فرمت AM/PM
            $parts = explode(':', $time);
            $hour = (int)$parts[0];
            $minute = isset($parts[1]) ? $parts[1] : '00';
            
            $suffix = ($hour >= 12) ? 'PM' : 'AM';
            $hour = ($hour > 12) ? $hour - 12 : $hour;
            $hour = ($hour == 0) ? 12 : $hour;
            
            return $hour . ':' . $minute . ' ' . $suffix;
        }
        
        // برای فارسی و عربی همان فرمت اصلی استفاده می‌شود
        return $time;
    };
    
    // ساخت متن ساعات کاری
    $output = '';
    
    // روزهای هفته
    if ($days_start <= $days_end) {
        $day_start_name = $day_names[$days_start];
        $day_end_name = $day_names[$days_end];
        
        $day_range = ($lang === 'en') ? 
            "$day_start_name to $day_end_name" : 
            "$day_start_name تا $day_end_name";
        
        $formatted_start = $format_time($weekday_start);
        $formatted_end = $format_time($weekday_end);
        
        $output .= sprintf($from_to, $day_range, $formatted_start, $formatted_end) . "\n";
    }
    
    // جمعه
    $friday_name = $day_names[5]; // index 5 is Friday
    if ($friday_open) {
        $formatted_start = $format_time($friday_start);
        $formatted_end = $format_time($friday_end);
        
        $output .= sprintf($from_to, $friday_name, $formatted_start, $formatted_end) . "\n";
    } else {
        $output .= "$friday_name: $closed\n";
    }
    
    // آخر هفته (شنبه و یکشنبه)
    if (!$weekend_open) {
        $output .= $day_names[6] . $and . $day_names[0] . ": $closed";
    }
    
    return trim($output);
}
?>