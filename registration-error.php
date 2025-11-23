<?php

/**
 * صفحه خطای ثبت‌نام آنلاین مدرسه سلمان فارسی
 * 
 * نمایش پیام خطا در صورت نامعتبر بودن توکن یا سایر خطاها
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'includes/config.php';
require_once 'includes/ContentManager.php';

// دریافت زبان فعلی
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
if (!in_array($lang, ['fa', 'en', 'ar'])) {
    $lang = 'fa';
}

// تنظیم جهت نمایش بر اساس زبان
$isRtl = ($lang == 'fa' || $lang == 'ar');

// تعیین نوع خطا
$errorType = isset($_GET['error']) ? $_GET['error'] : 'unknown';

// ایجاد نمونه مدیریت محتوا
$contentManager = new ContentManager($db, 'reg_error', $lang);  // از reg_error به جای reg-error استفاده کنید

// دریافت متن‌ها از دیتابیس
$pageTitle = $contentManager->getContent('page_title');
$headerTitle = $contentManager->getContent('header_title');
$headerSubtitle = $contentManager->getContent('header_subtitle');
$errorMessageInvalidToken = $contentManager->getContent('error_message_invalid_token');
$errorMessageUnknown = $contentManager->getContent('error_message_unknown');
$returnButtonLabel = $contentManager->getContent('return_button_label');
$errorIcon = $contentManager->getContent('error_icon', true); // true means get raw content, not translated

// اگر محتوا از دیتابیس پیدا نشد، مقادیر پیش‌فرض تنظیم می‌شوند
if (empty($pageTitle)) {
    if ($lang == 'fa') {
        $pageTitle = 'خطای دسترسی';
        $headerTitle = 'خطای دسترسی';
        $headerSubtitle = 'متأسفانه خطایی در دسترسی به اطلاعات ثبت‌نام رخ داده است';
        $errorMessageInvalidToken = 'لینک مورد نظر معتبر نیست یا منقضی شده است.';
        $errorMessageUnknown = 'خطای نامشخص در دسترسی به اطلاعات ثبت‌نام.';
        $returnButtonLabel = 'بازگشت به صفحه ثبت‌نام';
    } else if ($lang == 'ar') {
        $pageTitle = 'خطأ في الوصول';
        $headerTitle = 'خطأ في الوصول';
        $headerSubtitle = 'عذراً، حدث خطأ في الوصول إلى معلومات التسجيل الخاصة بك';
        $errorMessageInvalidToken = 'الرابط المقدم غير صالح أو انتهت صلاحيته.';
        $errorMessageUnknown = 'خطأ غير معروف في الوصول إلى معلومات التسجيل.';
        $returnButtonLabel = 'العودة إلى صفحة التسجيل';
    } else {
        $pageTitle = 'Access Error';
        $headerTitle = 'Access Error';
        $headerSubtitle = 'Sorry, there was an error accessing your registration information';
        $errorMessageInvalidToken = 'The provided link is invalid or has expired.';
        $errorMessageUnknown = 'Unknown error accessing registration information.';
        $returnButtonLabel = 'Return to Registration Page';
    }
}

// اگر آیکون خطا تنظیم نشده، مقدار پیش‌فرض استفاده می‌شود
if (empty($errorIcon)) {
    $errorIcon = 'fas fa-exclamation-circle';
}

// تعیین پیام خطای مناسب
$errorMessage = ($errorType == 'invalid_token') ? $errorMessageInvalidToken : $errorMessageUnknown;

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>" class="<?php echo $isRtl ? 'rtl' : ''; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | <?php echo $contentManager->getSiteName(); ?></title>
    
    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <!-- CSS فایل‌ها -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/pages.css.php'; ?>
</head>
<body class="<?php echo $isRtl ? 'rtl' : ''; ?>">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>
        <!-- Mountain Header -->
        <header class="mountain-header">
            <lottie-player 
                src="assets/css/Animation.json"
                background="transparent"
                speed="1"
                style=" width: 100vw;
                height: 120vh;
                position: absolute;
                top:70%; /* به جای 50% - انیمیشن رو بالا می‌بره */
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 1;
                pointer-events: none;"
                loop
                autoplay>
            </lottie-player>

            <!-- Content -->
            <div class="header-content" style="padding-top: 200px;">
                <div class="glass-container">
                    <h1 class="header-title"
                    style=" font-size: 3rem;
                            font-weight: 800;
                            color: #ffffff;
                            margin: 0 0 1.5rem 0;
                            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.7);
                            letter-spacing: -0.02em;
                            line-height: 1.1;" > <?php echo $headerTitle; ?>
                            </h1>
                    <p class="header-subtitle">
                    <?php echo $headerSubtitle; ?>
                    </p>
                </div>
            </div>
        </header>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const lottiePlayer = document.querySelector('lottie-player');
                
                // Event listener برای خطایابی
                lottiePlayer.addEventListener('error', function() {
                    console.log('خطا در بارگذاری انیمیشن Lottie');
                    // نمایش پس‌زمینه CSS
                    document.querySelector('.gradient-background').style.display = 'block';
                });
            });
        </script>

    <!-- Error Section -->
    <section class="error-section">
        <div class="container">
            <div class="error-card text-center p-5">
                <div class="error-icon">
                    <i class="<?php echo $errorIcon; ?>"></i>
                </div>
                <h2 class="error-title"><?php echo $headerTitle; ?></h2>
                <p class="error-message"><?php echo $errorMessage; ?></p>
                
                <a href="registration.php?lang=<?php echo $lang; ?>" class="btn-registration">
                    <?php echo $returnButtonLabel; ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Site Footer -->
    <?php include_once 'includes/footer.php'; ?>

    <!-- Required Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
</body>
</html>