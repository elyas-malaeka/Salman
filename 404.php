<?php
/**
 * 404 Error Page
 * 
 * This file displays a custom 404 error page for Salman Educational Complex
 * with multilingual support.
 * 
 * @package Salman Educational Complex
 * @version 2.1
 */

// Include configuration file - if not on server root, adjust path accordingly
if (file_exists('includes/config.php')) {
    require_once 'includes/config.php';
} else if (file_exists('../includes/config.php')) {
    require_once '../includes/config.php';
} else {
    // Fallback if config can't be found - set a default language
    $_SESSION['lang'] = $_SESSION['lang'] ?? 'en';
}

// Include error helper functions
if (file_exists('includes/error_functions.php')) {
    require_once 'includes/error_functions.php';
} else if (file_exists('../includes/error_functions.php')) {
    require_once '../includes/error_functions.php';
}

// Set HTTP response code
http_response_code(404);

// Get language from URL parameter, session, or default to English
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en');

// Validate language
if (!in_array($lang, ['en', 'fa', 'ar'])) {
    $lang = 'en';
}

// Store language in session
$_SESSION['lang'] = $lang;

// Set RTL direction for Arabic and Persian
$isRtl = in_array($lang, ['fa', 'ar']);

// Get page data
$errorData = isset($db) ? getErrorPageData($lang) : [
    'page_title' => $lang == 'fa' ? 'خطای 404 | مجتمع آموزشی سلمان' : ($lang == 'ar' ? 'خطأ 404 | مجمع سلمان التعليمي' : '404 Error | Salman Educational Complex'),
    'error_title' => $lang == 'fa' ? 'اوپس، صفحه‌ای یافت نشد!' : ($lang == 'ar' ? 'عفوًا، الصفحة غير موجودة!' : 'Oops, page not found!'),
    'error_text' => $lang == 'fa' ? 'صفحه‌ای که به دنبال آن هستید ممکن است حذف شده، نام آن تغییر کرده یا موقتاً در دسترس نباشد.' : ($lang == 'ar' ? 'من المحتمل أن تكون الصفحة التي تبحث عنها قد تمت إزالتها، أو تم تغيير اسمها، أو أنها غير متوفرة مؤقتًا.' : 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.'),
    'button_text' => $lang == 'fa' ? 'بازگشت به صفحه اصلی' : ($lang == 'ar' ? 'العودة إلى الصفحة الرئيسية' : 'Back to Homepage'),
    'logo_path' => $lang == 'fa' ? 'assets/images/farsi-logo.png' : 'assets/images/logo-dark.png',
    'logo_alt' => $lang == 'fa' ? 'مجتمع آموزشی سلمان' : ($lang == 'ar' ? 'مجمع سلمان التعليمي' : 'Salman Educational Complex'),
    'lang_btn' => [
        'fa' => $lang == 'fa' ? 'فارسی' : ($lang == 'ar' ? 'الفارسية' : 'Persian'),
        'en' => $lang == 'fa' ? 'English' : ($lang == 'ar' ? 'الإنجليزية' : 'English'),
        'ar' => $lang == 'fa' ? 'العربية' : ($lang == 'ar' ? 'العربية' : 'Arabic')
    ]
];

// Fix image paths if necessary
$logoPath = $errorData['logo_path'];
if (!file_exists($logoPath) && file_exists('../' . $logoPath)) {
    $logoPath = '../' . $logoPath;
}

// Use a relative path for assets based on whether we're in a subdirectory
$assetsPath = '';
if (!file_exists('assets/images/404.svg') && file_exists('../assets/images/404.svg')) {
    $assetsPath = '../';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $errorData['page_title']; ?></title>

    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $assetsPath; ?>assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $assetsPath; ?>assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $assetsPath; ?>assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="<?php echo $assetsPath; ?>assets/images/favicons/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    
    <?php if ($isRtl): ?>
    <!-- Vazirmatn for Persian and Noto Sans Arabic for Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/bootstrap-select/bootstrap-select.min.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/tiny-slider/tiny-slider.css" />
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/vendors/salman-icons/style.css" />

    <!-- Template Styles -->
    <link rel="stylesheet" href="<?php echo $assetsPath; ?>assets/css/salman.css" />
    <!-- Custom Styles for 404 erorr Page -->
    <?php include_once 'assets/css/pages/404.css.php'; ?>   

</head>
<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>
    
    <div class="page-wrapper">
        <!-- Language Selector -->
        <div class="error-language-selector">
            <a href="404.php?lang=en" class="lang-btn<?php echo $lang == 'en' ? ' active' : ''; ?>" data-lang="en"><?php echo $errorData['lang_btn']['en']; ?></a>
            <a href="404.php?lang=fa" class="lang-btn<?php echo $lang == 'fa' ? ' active' : ''; ?>" data-lang="fa"><?php echo $errorData['lang_btn']['fa']; ?></a>
            <a href="404.php?lang=ar" class="lang-btn<?php echo $lang == 'ar' ? ' active' : ''; ?>" data-lang="ar"><?php echo $errorData['lang_btn']['ar']; ?></a>
        </div>

        <!-- 404 Error Content -->
        <section class="error-404-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <!-- SVG Image -->
                        <div class="error-404-svg">
                            <img src="<?php echo $assetsPath; ?>assets/images/404.svg" alt="404" class="error-svg-image">
                        </div>
                        
                        <!-- Localized Error Content -->
                        <div class="error-content">
                            <h2 class="error-404-title"><?php echo $errorData['error_title']; ?></h2>
                            <p class="error-404-text"><?php echo $errorData['error_text']; ?></p>
                            <a href="index.php?lang=<?php echo $lang; ?>" class="error-404-btn"><?php echo $errorData['button_text']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Logo -->
       
    </div>

    <!-- Basic Scripts -->
    <script src="<?php echo $assetsPath; ?>assets/vendors/jquery/jquery-3.7.0.min.js"></script>
</body>
</html>