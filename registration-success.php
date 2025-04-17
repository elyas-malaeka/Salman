<?php
/**
 * صفحه موفقیت ثبت‌نام آنلاین مدرسه سلمان فارسی
 * 
 * نمایش پیام موفقیت و شماره پیگیری ثبت‌نام با طراحی مدرن و بهینه برای چاپ
 * 
 * @package Salman Educational Complex
 * @version 3.2 - با امنیت توکن
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'includes/config.php';
require_once 'includes/registration-functions.php';
require_once 'includes/RegistrationSuccessContent.php';
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

// ایجاد نمونه مدیریت محتوا
$contentManager = new RegistrationSuccessContent($db, $lang);

// دریافت محتوای صفحه - بقیه کد بدون تغییر
$pageTitle = $contentManager->get('page_title', $lang);
$headerTitle = $contentManager->get('header_title', $lang);
$headerSubtitle = $contentManager->get('header_subtitle', $lang);
$successMessage = $contentManager->get('success_message', $lang);
$congratsText = $contentManager->get('congratulations', $lang);
$trackingNumberLabel = $contentManager->get('tracking_number_label', $lang);
$nextStepsLabel = $contentManager->get('next_steps_label', $lang);
$contactInfoLabel = $contentManager->get('contact_info_label', $lang);
$printButtonLabel = $contentManager->get('print_button_label', $lang);
$returnButtonLabel = $contentManager->get('return_button_label', $lang);
$registrationConfirmation = $contentManager->get('registration_confirmation', $lang);
$confirmationMessage = $contentManager->get('confirmation_message', $lang);
$studentNameLabel = $contentManager->get('student_name_label', $lang);
$registrationDateLabel = $contentManager->get('registration_date_label', $lang);
$registrationStatusLabel = $contentManager->get('registration_status_label', $lang);

// تنظیم وضعیت ثبت‌نام و کلاس مربوطه
$statusTranslations = [
    'pending' => $contentManager->get('status_pending', $lang),
    'approved' => $contentManager->get('status_approved', $lang),
    'rejected' => $contentManager->get('status_rejected', $lang)
];


$status = isset($registrationInfo['registration_status']) ? $registrationInfo['registration_status'] : 'pending';
$registrationStatus = isset($statusTranslations[$status]) ? $statusTranslations[$status] : $statusTranslations['pending'];

$statusClass = '';
switch($registrationInfo['registration_status']) {
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
$nextSteps = $contentManager->getNextSteps($lang);

// دریافت اطلاعات تماس
$contactInfo = $contentManager->getContactInfo($lang);

// تولید آیکون‌های مناسب برای اطلاعات تماس
function getContactIcon($info) {
    $type = isset($info['type']) ? $info['type'] : '';
    
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
                
                <!-- Meteor animations -->
                <div class="meteor" style="top: 20%; right: 20%; animation-delay: 2s;"></div>
                <div class="meteor" style="top: 50%; right: 40%; animation-delay: 4s;"></div>
                <div class="meteor" style="top: 10%; right: 60%; animation-delay: 8s;"></div>
            </div>
    </section>

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
                        <p class="tracking-hint"><?php echo $contentManager->get('tracking_hint', $lang); ?></p>
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
                                    <i class="fas <?php echo getContactIcon($info); ?>"></i>
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
                    
                    <!-- دکمه‌های عملیاتی - حذف onclick تا از چاپ مضاعف جلوگیری شود -->
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
        <div class="certificate-watermark"><?php echo $contentManager->getSiteName($lang); ?></div>
        
        <div class="certificate-header">
            <img src="assets/images/logo.png" alt="<?php echo $contentManager->getSiteName($lang); ?>" class="certificate-logo">
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
            <div><?php echo $contentManager->getSiteName($lang); ?></div>
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
                <title><?php echo $contentManager->getSiteName($lang); ?> - <?php echo $registrationConfirmation; ?></title>
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
                    <div class="certificate-watermark"><?php echo $contentManager->getSiteName($lang); ?></div>
                    
                    <div class="certificate-header">
                        <img src="assets/images/logo.png" alt="<?php echo $contentManager->getSiteName($lang); ?>" class="school-logo">
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
                        <div><?php echo $contentManager->getSiteName($lang); ?></div>
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