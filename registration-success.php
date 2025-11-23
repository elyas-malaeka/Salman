<?php
/**
 * صفحه موفقیت ثبت‌نام آنلاین مدرسه سلمان فارسی
 * 
 * نمایش پیام موفقیت و شماره پیگیری ثبت‌نام با طراحی مدرن و بهینه برای چاپ
 * با استفاده از جداول temp_reg_success_content و temp_reg_success_translations
 * 
 * @package Salman Educational Complex
 * @version 4.2 - با امنیت توکن و استفاده از جداول ترجمه
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'includes/config.php';
require_once 'includes/registration-functions.php';
require_once 'includes/registration-success.php'; // تغییر مسیر فایل
require_once 'includes/token-validator.php'; // اضافه کردن فایل validator توکن

// دریافت زبان فعلی
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
if (!in_array($lang, ['fa', 'en', 'ar'])) {
    $lang = 'fa';
}

// تنظیم جهت نمایش بر اساس زبان
$isRtl = ($lang == 'fa' || $lang == 'ar');

// اینجا تغییر اصلی است: بررسی توکن به جای ID
$token = isset($_GET['token']) ? $_GET['token'] : '';
$registrationInfo = validateRegistrationToken($token);

// اگر توکن نامعتبر است یا منقضی شده، هدایت به صفحه خطا
if (!$registrationInfo) {
    header('Location: registration-error.php?error=invalid_token&lang=' . $lang);
    exit;
}

// حالا $registrationInfo شامل اطلاعات ثبت‌نام است، از جمله registration_id
$registrationId = $registrationInfo['registration_id'];

// بررسی وجود کلید وضعیت و تنظیم مقدار پیش‌فرض اگر وجود ندارد
$status = isset($registrationInfo['registration_status']) ? $registrationInfo['registration_status'] : 'pending';

/**
 * دریافت محتوا از جدول محتوا و ترجمه
 * 
 * @param string $fieldKey کلید فیلد
 * @param string $lang زبان
 * @param bool $isRepeatable آیا محتوا تکرارشونده است
 * @return string|array محتوا
 */
function getContent($fieldKey, $lang, $isRepeatable = false) {
    global $db;
    
    $fieldKey = mysqli_real_escape_string($db, $fieldKey);
    $lang = mysqli_real_escape_string($db, $lang);
    $isRepeatableValue = $isRepeatable ? 1 : 0;
    
    $query = "SELECT t.content_value 
              FROM temp_reg_success_content c
              JOIN temp_reg_success_translations t ON c.content_id = t.content_id
              WHERE c.field_key = '{$fieldKey}' 
              AND t.language_id = '{$lang}'
              AND c.is_repeatable = {$isRepeatableValue}
              AND c.is_active = 1";
    
    if ($isRepeatable) {
        $query .= " ORDER BY c.sort_order ASC";
    } else {
        $query .= " LIMIT 1";
    }
    
    $result = mysqli_query($db, $query);
    
    if (!$result) {
        return $isRepeatable ? [] : '';
    }
    
    if ($isRepeatable) {
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row['content_value'];
        }
        return $items;
    } else {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['content_value'];
        }
        return '';
    }
}

/**
 * دریافت محتوای قدم‌های بعدی
 * 
 * @param string $lang زبان
 * @return array آرایه‌ای از قدم‌های بعدی
 */
function getNextSteps($lang) {
    global $db;
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT t.content_value 
              FROM temp_reg_success_content c
              JOIN temp_reg_success_translations t ON c.content_id = t.content_id
              WHERE c.field_key LIKE 'next_step_%' 
              AND t.language_id = '{$lang}'
              AND c.is_repeatable = 1
              AND c.is_active = 1
              ORDER BY c.sort_order ASC";
    
    $result = mysqli_query($db, $query);
    
    if (!$result) {
        return [];
    }
    
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row['content_value'];
    }
    
    return $items;
}

/**
 * دریافت اطلاعات تماس
 * 
 * @param string $lang زبان
 * @return array آرایه‌ای از اطلاعات تماس
 */
function getContactInforeg($lang) {
    $contactInfo = [];
    
    // دریافت شماره تلفن
    $phoneValues = getContent('contact_phone', $lang, true);
    $phoneTitle = getContent('contact_phone_title', $lang);
    if (!empty($phoneValues)) {
        $contactInfo[] = [
            'title' => $phoneTitle,
            'value' => $phoneValues[0],
            'type' => 'phone'
        ];
    }
    
    // دریافت ایمیل
    $emailValues = getContent('contact_email', $lang, true);
    $emailTitle = getContent('contact_email_title', $lang);
    if (!empty($emailValues)) {
        $contactInfo[] = [
            'title' => $emailTitle,
            'value' => $emailValues[0],
            'type' => 'email'
        ];
    }
    
    // دریافت آدرس
    $addressValues = getContent('contact_address', $lang, true);
    $addressTitle = getContent('contact_address_title', $lang);
    if (!empty($addressValues)) {
        $contactInfo[] = [
            'title' => $addressTitle,
            'value' => $addressValues[0],
            'type' => 'address'
        ];
    }
    
    // دریافت ساعات کاری
    $hoursValues = getContent('contact_hours', $lang, true);
    $hoursTitle = getContent('contact_hours_title', $lang);
    if (!empty($hoursValues)) {
        $contactInfo[] = [
            'title' => $hoursTitle,
            'value' => $hoursValues[0],
            'type' => 'hours'
        ];
    }
    
    return $contactInfo;
}

/**
 * تولید آیکون‌های مناسب برای اطلاعات تماس
 * 
 * @param string $type نوع اطلاعات تماس
 * @return string کلاس آیکون
 */
function getContactIcon($type) {
    switch ($type) {
        case 'phone':
            return 'fa-phone-alt';
        case 'email':
            return 'fa-envelope';
        case 'address':
            return 'fa-map-marker-alt';
        case 'hours':
            return 'fa-clock';
        default:
            return 'fa-info-circle';
    }
}

/**
 * دریافت نام سایت
 * 
 * @param string $lang زبان
 * @return string نام سایت
 */
function getSiteName($lang = 'fa') {
    global $db;
    
    // اگر نام سایت به زبان فعلی وجود دارد، آن را برمی‌گردانیم
    if ($lang != 'fa') {
        $query = "SELECT config_value FROM core_config 
                  WHERE config_key = 'site_name_{$lang}' 
                  LIMIT 1";
        
        $result = mysqli_query($db, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['config_value'];
        }
    }
    
    // در غیر این صورت نام سایت به زبان فارسی را برمی‌گردانیم
    $query = "SELECT config_value FROM core_config 
              WHERE config_key = 'site_name' 
              LIMIT 1";
    
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['config_value'];
    }
    
    // مقدار پیش‌فرض اگر در دیتابیس نباشد
    return "مجتمع آموزشی سلمان فارسی";
}


// دریافت محتوای صفحه
$pageTitle = getContent('page_title', $lang);
$headerTitle = getContent('header_title', $lang);
$headerSubtitle = getContent('header_subtitle', $lang);
$successMessage = getContent('success_message', $lang);
$congratsText = getContent('congratulations', $lang);
$trackingNumberLabel = getContent('tracking_number_label', $lang);
$nextStepsLabel = getContent('next_steps_label', $lang);
$contactInfoLabel = getContent('contact_info_label', $lang);
$printButtonLabel = getContent('print_button_label', $lang);
$returnButtonLabel = getContent('return_button_label', $lang);
$registrationConfirmation = getContent('registration_confirmation', $lang);
$confirmationMessage = getContent('confirmation_message', $lang);
$studentNameLabel = getContent('student_name_label', $lang);
$registrationDateLabel = getContent('registration_date_label', $lang);
$registrationStatusLabel = getContent('registration_status_label', $lang);

// تنظیم وضعیت ثبت‌نام و کلاس مربوطه
$statusTranslations = [
    'pending' => getContent('status_pending', $lang),
    'approved' => getContent('status_approved', $lang),
    'rejected' => getContent('status_rejected', $lang)
];

$registrationStatus = isset($statusTranslations[$status]) ? $statusTranslations[$status] : $statusTranslations['pending'];

$statusClass = '';
switch($status) {
    case 'approved':
        $statusClass = 'status-approved';
        break;
    case 'rejected':
        $statusClass = 'status-rejected';
        break;
    default:
        $statusClass = 'status-pending';
}

// دریافت مراحل بعدی
$nextSteps = getNextSteps($lang);

// دریافت اطلاعات تماس
$contactInfo = getContactInforeg($lang);

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>" class="<?php echo $isRtl ? 'rtl' : ''; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | <?php echo getSiteName($lang); ?></title>
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

    <!-- Success Section -->
    <section class="success-section">
        <div class="container">
            <div class="success-container">
                <!-- هدر نمایش موفقیت -->
                <div class="success-header">
                    <div class="success-icon-wrap">
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <h2 class="success-title"><?php echo $congratsText; ?></h2>
                    <p class="success-subtitle"><?php echo $successMessage; ?></p>
                </div>
                
                <!-- بدنه نمایش موفقیت -->
                <div class="success-body">
                    <!-- کارت شماره پیگیری -->
                    <div class="tracking-card">
                        <h3 class="tracking-title"><?php echo $trackingNumberLabel; ?></h3>
                        <div class="tracking-number"><?php echo $registrationId; ?></div>
                    </div>
                    
                    <!-- بخش اطلاعات دانش‌آموز -->
                    <div class="info-section">
                        <h3 class="info-heading"><?php echo $studentNameLabel; ?></h3>
                        <div class="student-info-grid">
                            <div class="info-item">
                                <div class="info-label"><?php echo $studentNameLabel; ?></div>
                                <div class="info-value"><?php echo $registrationInfo['first_name'] . ' ' . $registrationInfo['last_name']; ?></div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label"><?php echo $registrationDateLabel; ?></div>
                                <div class="info-value"><?php echo isset($registrationInfo['registration_date']) ? formatDate($registrationInfo['registration_date']) : formatDate(''); ?></div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label"><?php echo $trackingNumberLabel; ?></div>
                                <div class="info-value"><?php echo $registrationId; ?></div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label"><?php echo $registrationStatusLabel; ?></div>
                                <div class="info-value">
                                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo $registrationStatus; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- بخش مراحل بعدی -->
                    <?php if (!empty($nextSteps)): ?>
                    <div class="info-section">
                        <h3 class="info-heading"><?php echo $nextStepsLabel; ?></h3>
                        <ul class="steps-list">
                            <?php foreach ($nextSteps as $step): ?>
                            <li class="step-item">
                                <div class="step-text"><?php echo $step; ?></div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <!-- بخش اطلاعات تماس -->
                    <?php if (!empty($contactInfo)): ?>
                    <div class="info-section">
                        <h3 class="info-heading"><?php echo $contactInfoLabel; ?></h3>
                        <div class="contact-grid">
                            <?php foreach ($contactInfo as $info): ?>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas <?php echo getContactIcon($info['type']); ?>"></i>
                                </div>
                                <div class="contact-text">
                                    <?php if (!empty($info['title'])): ?>
                                    <div class="contact-label"><?php echo $info['title']; ?></div>
                                    <?php endif; ?>
                                    <div class="contact-value"><?php echo $info['value']; ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- دکمه‌های عملیاتی -->
                    <div class="action-buttons">
                        <button class="btn-action btn-print">
                            <i class="fas fa-print"></i>
                            <?php echo $printButtonLabel; ?>
                        </button>
                        <a href="index.php?lang=<?php echo $lang; ?>" class="btn-action btn-home">
                            <i class="fas fa-home"></i>
                            <?php echo $returnButtonLabel; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- بخش گواهی قابل پرینت - فقط در زمان چاپ نمایش داده می‌شود -->
    <div class="print-certificate">
        <div class="certificate-watermark"><?php echo getSiteName($lang); ?></div>
        
        <div class="certificate-header">
            <img src="assets/images/logo.png" alt="<?php echo getSiteName($lang); ?>" class="certificate-logo">
            <h2 class="certificate-title"><?php echo $registrationConfirmation; ?></h2>
            <p class="certificate-subtitle"><?php echo $confirmationMessage; ?></p>
        </div>
        
        <div class="certificate-body">
            <div class="certificate-info-grid">
                <div class="certificate-info-item">
                    <div class="info-label"><?php echo $studentNameLabel; ?></div>
                    <div class="info-value"><?php echo $registrationInfo['first_name'] . ' ' . $registrationInfo['last_name']; ?></div>
                </div>
                
                <div class="certificate-info-item">
                    <div class="info-label"><?php echo $registrationDateLabel; ?></div>
                    <div class="info-value"><?php echo isset($registrationInfo['registration_date']) ? formatDate($registrationInfo['registration_date']) : formatDate(''); ?></div>
                </div>
                
                <div class="certificate-info-item">
                    <div class="info-label"><?php echo $trackingNumberLabel; ?></div>
                    <div class="info-value"><?php echo $registrationId; ?></div>
                </div>
                
                <div class="certificate-info-item">
                    <div class="info-label"><?php echo $registrationStatusLabel; ?></div>
                    <div class="info-value"><?php echo $registrationStatus; ?></div>
                </div>
            </div>
            
            <?php if (!empty($nextSteps)): ?>
            <div class="info-section">
                <h3 class="info-heading"><?php echo $nextStepsLabel; ?></h3>
                <ul class="steps-list">
                    <?php foreach ($nextSteps as $step): ?>
                    <li class="step-item">
                        <div class="step-text"><?php echo $step; ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="certificate-footer">
            <div><?php echo getSiteName($lang); ?></div>
            <div><?php echo date('Y/m/d H:i'); ?></div>
        </div>
    </div>

    <!-- Site Footer -->
    <?php include_once 'includes/footer.php'; ?>

    <!-- Required Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create confetti effect
            createConfetti();
            
            // تنظیم گوش دهنده رویداد برای دکمه چاپ
            const printButton = document.querySelector('.btn-print');
            if (printButton) {
                printButton.addEventListener('click', printCertificate);
            }
        });
        // Function to create confetti animation
        function createConfetti() {
            const confettiCount = 200;
            const container = document.querySelector('body');
            
            // Array of colors for confetti
            const colors = ['#6C9EFF', '#9471FF', '#6C63FF', '#A89BFF', '#FF6B8B', '#FFDE59'];
            
            // Create each confetti piece
            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.zIndex = '1000';
                confetti.style.top = '-10px';
                confetti.style.borderRadius = '0';
                
                // Random properties
                const size = Math.random() * 10 + 5;
                const positionX = Math.random() * 100;
                const color = colors[Math.floor(Math.random() * colors.length)];
                const shape = Math.random() > 0.5 ? 'circle' : 'rect';
                const duration = Math.random() * 3 + 2;
                const delay = Math.random() * 3;
                
                // Set styles
                confetti.style.width = `${size}px`;
                confetti.style.height = shape === 'circle' ? `${size}px` : `${size * 1.5}px`;
                confetti.style.left = `${positionX}%`;
                confetti.style.backgroundColor = color;
                confetti.style.opacity = Math.random() * 0.6 + 0.4;
                
                if (shape === 'circle') {
                    confetti.style.borderRadius = '50%';
                }
                
                // Set animation
                confetti.style.animation = `fallAnimation ${duration}s ease-in ${delay}s forwards`;
                
                // Add to container
                container.appendChild(confetti);
                
                // Remove after animation completes
                setTimeout(() => {
                    confetti.remove();
                }, (duration + delay) * 1000);
            }
            
            // Add animation keyframes
            if (!document.getElementById('confettiAnimation')) {
                const style = document.createElement('style');
                style.id = 'confettiAnimation';
                style.innerHTML = `
                    @keyframes fallAnimation {
                        0% {
                            transform: translateY(0) rotate(0deg);
                            opacity: 1;
                        }
                        100% {
                            transform: translateY(100vh) rotate(720deg);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }
        }
        
        // تابع بهبودیافته برای چاپ گواهی
        function printCertificate() {
            // ساخت یک فریم موقت برای چاپ
            const iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            document.body.appendChild(iframe);
            
            // محتوای صفحه چاپ
            const printContent = `
            <!DOCTYPE html>
            <html dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
            <head>
                <meta charset="UTF-8">
                <title><?php echo getSiteName($lang); ?> - <?php echo $registrationConfirmation; ?></title>
                <style>
                    body {
                        font-family: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
                        padding: 20mm;
                        margin: 0;
                        direction: <?php echo $isRtl ? 'rtl' : 'ltr'; ?>;
                    }
                    .certificate-container {
                        position: relative;
                        max-width: 800px;
                        margin: 0 auto;
                        padding: 20px;
                        border: 1px solid #eee;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    .certificate-header {
                        text-align: center;
                        margin-bottom: 30px;
                        padding-bottom: 20px;
                        border-bottom: 2px solid #eee;
                    }
                    .school-logo {
                        max-width: 150px;
                        margin: 0 auto 20px;
                        display: block;
                    }
                    .certificate-title {
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 10px;
                        color: #333;
                    }
                    .certificate-message {
                        font-size: 16px;
                        color: #555;
                    }
                    .student-info-box {
                        background: #f9f9ff;
                        border-radius: 5px;
                        padding: 20px;
                        margin-bottom: 30px;
                    }
                    .student-info-row {
                        display: flex;
                        margin-bottom: 15px;
                        padding-bottom: 15px;
                        border-bottom: 1px solid #eee;
                    }
                    .student-info-row:last-child {
                        margin-bottom: 0;
                        padding-bottom: 0;
                        border-bottom: none;
                    }
                    .student-info-label {
                        flex: 0 0 40%;
                        font-weight: bold;
                        color: #333;
                    }
                    .student-info-value {
                        flex: 0 0 60%;
                        color: #444;
                    }
                    .registration-status {
                        display: inline-block;
                        padding: 5px 15px;
                        border-radius: 20px;
                        font-size: 14px;
                        font-weight: 500;
                    }
                    .status-pending {
                        background-color: #FFF8E1;
                        color: #FFA000;
                    }
                    .status-approved {
                        background-color: #E8F5E9;
                        color: #4CAF50;
                    }
                    .status-rejected {
                        background-color: #FFEBEE;
                        color: #F44336;
                    }
                    .certificate-footer {
                        display: flex;
                        justify-content: space-between;
                        margin-top: 30px;
                        padding-top: 20px;
                        border-top: 1px solid #eee;
                        font-size: 12px;
                        color: #777;
                    }
                    .certificate-watermark {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%) rotate(-45deg);
                        font-size: 80px;
                        color: rgba(0, 0, 0, 0.03);
                        font-weight: bold;
                        z-index: -1;
                        white-space: nowrap;
                    }
                    @media print {
                        body {
                            -webkit-print-color-adjust: exact !important;
                            color-adjust: exact !important;
                            print-color-adjust: exact !important;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="certificate-container">
                    <div class="certificate-watermark"><?php echo getSiteName($lang); ?></div>
                    
                    <div class="certificate-header">
                        <img src="assets/images/logo.png" alt="<?php echo getSiteName($lang); ?>" class="school-logo">
                        <h2 class="certificate-title"><?php echo $registrationConfirmation; ?></h2>
                        <p class="certificate-message"><?php echo $confirmationMessage; ?></p>
                    </div>
                    
                    <div class="student-info-box">
                        <div class="student-info-row">
                            <div class="student-info-label"><?php echo $studentNameLabel; ?></div>
                            <div class="student-info-value"><?php echo $registrationInfo['first_name'] . ' ' . $registrationInfo['last_name']; ?></div>
                        </div>
                        
                        <div class="student-info-row">
                            <div class="student-info-label"><?php echo $trackingNumberLabel; ?></div>
                            <div class="student-info-value"><?php echo $registrationId; ?></div>
                        </div>
                        
                        <div class="student-info-row">
                            <div class="student-info-label"><?php echo $registrationDateLabel; ?></div>
                            <div class="student-info-value"><?php echo isset($registrationInfo['registration_date']) ? formatDate($registrationInfo['registration_date']) : formatDate(''); ?></div>
                        </div>
                        
                        <div class="student-info-row">
                            <div class="student-info-label"><?php echo $registrationStatusLabel; ?></div>
                            <div class="student-info-value">
                                <span class="registration-status <?php echo $statusClass; ?>"><?php echo $registrationStatus; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="certificate-footer">
                        <div><?php echo getSiteName($lang); ?></div>
                        <div><?php echo date('Y/m/d H:i'); ?></div>
                    </div>
                </div>
            </body>
            </html>
            `;
            
            // نوشتن محتوا در فریم و چاپ آن
            iframe.contentWindow.document.open();
            iframe.contentWindow.document.write(printContent);
            iframe.contentWindow.document.close();
            
            iframe.onload = function() {
                // منتظر بارگذاری تصاویر
                setTimeout(function() {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                    
                    // حذف فریم بعد از چاپ
                    setTimeout(function() {
                        document.body.removeChild(iframe);
                    }, 500);
                }, 500);
            };
        }
    </script>
</body>
</html>