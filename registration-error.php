<?php

/**
 * صفحه خطای ثبت‌نام آنلاین مدرسه سلمان فارسی
 * 
 * نمایش پیام خطا در صورت نامعتبر بودن توکن یا سایر خطاها
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'includes/config.php';
require_once 'includes/RegistrationSuccessContent.php';

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
$contentManager = new RegistrationSuccessContent($db, $lang);

// تنظیم عنوان‌ها و پیام‌ها بر اساس زبان
if ($lang == 'fa') {
    $pageTitle = 'خطای دسترسی';
    $headerTitle = 'خطای دسترسی';
    $headerSubtitle = 'متأسفانه خطایی در دسترسی به اطلاعات ثبت‌نام رخ داده است';
    $errorMessages = [
        'invalid_token' => 'لینک مورد نظر معتبر نیست یا منقضی شده است.',
        'unknown' => 'خطای نامشخص در دسترسی به اطلاعات ثبت‌نام.'
    ];
    $returnButtonLabel = 'بازگشت به صفحه ثبت‌نام';
} else if ($lang == 'ar') {
    $pageTitle = 'خطأ في الوصول';
    $headerTitle = 'خطأ في الوصول';
    $headerSubtitle = 'عذراً، حدث خطأ في الوصول إلى معلومات التسجيل الخاصة بك';
    $errorMessages = [
        'invalid_token' => 'الرابط المقدم غير صالح أو انتهت صلاحيته.',
        'unknown' => 'خطأ غير معروف في الوصول إلى معلومات التسجيل.'
    ];
    $returnButtonLabel = 'العودة إلى صفحة التسجيل';
} else {
    $pageTitle = 'Access Error';
    $headerTitle = 'Access Error';
    $headerSubtitle = 'Sorry, there was an error accessing your registration information';
    $errorMessages = [
        'invalid_token' => 'The provided link is invalid or has expired.',
        'unknown' => 'Unknown error accessing registration information.'
    ];
    $returnButtonLabel = 'Return to Registration Page';
}

$errorMessage = isset($errorMessages[$errorType]) ? $errorMessages[$errorType] : $errorMessages['unknown'];

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>" class="<?php echo $isRtl ? 'rtl' : ''; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | <?php echo $contentManager->getSiteName($lang); ?></title>
    
    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>
    
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">

    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/typography.css.php'; ?>
    <?php include_once 'assets/css/rtl-support.css.php'; ?>

    <!-- Page Specific CSS -->
    <?php include_once 'assets/css/pages/registration.css.php'; ?>
    
</head>
<body class="<?php echo $isRtl ? 'rtl' : ''; ?>">
    <!-- منوی سایت -->
    <?php include_once 'includes/menu.php'; ?>
    
    <!-- هدر صفحه ثبت‌نام (کیهانی) -->
    <section class="cosmic-header text-center">
        <div class="container">
            <h1 class="cosmic-header__title"><?php echo $headerTitle; ?></h1>
            <p class="cosmic-header__subtitle"><?php echo $headerSubtitle; ?></p>
        </div>
        <div class="cosmic-bg">
            <!-- Cosmic planets -->
            <div class="cosmic-planet" style="width: 300px; height: 300px; background: #6c63ff; top: -100px; right: -100px; animation: float 20s ease infinite;"></div>
            <div class="cosmic-planet" style="width: 200px; height: 200px; background: #3a32d1; bottom: -80px; left: -50px; animation: float 15s ease infinite reverse;"></div>
            
            <!-- Cosmic stars -->
            <?php for ($i = 0; $i < 30; $i++): 
                $top = rand(5, 95);
                $left = rand(5, 95);
                $size = rand(1, 3);
                $opacity = (rand(40, 100) / 100);
                $delay = (rand(0, 50) / 10);
            ?>
            <div class="cosmic-star" style="top: <?php echo $top; ?>%; left: <?php echo $left; ?>%; width: <?php echo $size; ?>px; height: <?php echo $size; ?>px; opacity: <?php echo $opacity; ?>; animation: twinkle 3s infinite <?php echo $delay; ?>s;"></div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Error Section -->
    <section class="error-section">
        <div class="container">
            <div class="error-card text-center p-5">
                <div class="error-icon">
                    <i class="fas fa-exclamation-circle"></i>
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