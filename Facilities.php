<?php
/**
 * Facilities Page
 * 
 * This file displays information about the facilities and services available
 * at the Salman Farsi Educational Complex using dynamic content from database.
 * 
 * @package Salman Educational Complex
 * @version 3.0
 */

// Include configuration file
require_once 'includes/config.php';

// شامل‌سازی توابع مربوط به صفحه امکانات
require_once 'includes/facilities-functions.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa' || $lang == 'ar');

// دریافت محتوای صفحه از دیتابیس
$pageTitle = getFacilityStaticContent('page_title', $lang);
$pageSubtitle = getFacilityStaticContent('page_subtitle', $lang);

// دریافت محتوای بخش مقدمه از دیتابیس
$introContent = getFacilityIntroContent($lang);

// دریافت بخش‌های مختلف امکانات از دیتابیس
$facilities = getFacilityItems($lang);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?> | <?php echo SITE_NAME_EN; ?></title>

    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- CSS فایل‌ها -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />

    <!-- Custom Styles for Registration Terms Page -->
    <?php include_once 'assets/css/pages/facilities.css.php'; ?>      


</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- منوی سایت -->
        <?php include_once 'includes/menu.php'; ?>
        
        <!-- Hero Header Section -->
        <section class="facilities-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="facilities-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="facilities-header__title">
                        <?php echo $pageTitle; ?>
                    </h1>
                    <p class="facilities-header__subtitle">
                        <?php echo $pageSubtitle; ?>
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Introduction Section -->
        <section class="facility-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="facility-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="<?php echo $introContent['image']; ?>" alt="<?php echo $introContent['title']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo $introContent['subtitle']; ?></p>
                            <h2 class="section-title">
                                <?php echo $introContent['title']; ?>
                            </h2>
                            <div class="section-description">
                                <p><?php echo $introContent['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- بخش اصلی امکانات -->
        <div class="facilities-container">
            <div class="container">
                <!-- نمایش پویای بخش‌های امکانات -->
                <?php foreach ($facilities as $index => $facility): 
                    $isEven = ($index % 2 !== 0);
                    
                    // تعیین ترتیب نمایش تصویر و متن بر اساس زوج/فرد بودن شاخص و زبان
                    $imageOrderClass = "";
                    $textOrderClass = "";
                    
                    if ($isRtl) { // فارسی یا عربی
                        if ($isEven) {
                            $imageOrderClass = "order-md-1";
                            $textOrderClass = "order-md-2";
                        } else {
                            $imageOrderClass = "order-md-2";
                            $textOrderClass = "order-md-1";
                        }
                    } else { // انگلیسی
                        if ($isEven) {
                            $imageOrderClass = "order-md-2";
                            $textOrderClass = "order-md-1";
                        } else {
                            $imageOrderClass = "order-md-1";
                            $textOrderClass = "order-md-2";
                        }
                    }
                ?>
                <div class="facility-block">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- ستون تصویر -->
                            <div class="col-md-5 <?php echo $imageOrderClass; ?>">
                                <div class="facility-image">
                                    <img src="<?php echo $facility['image']; ?>" alt="<?php echo $facility['title']; ?>">
                                </div>
                            </div>
                            
                            <!-- ستون محتوا -->
                            <div class="col-md-7 <?php echo $textOrderClass; ?>">
                                <div class="facility-content">
                                    <span class="facility-subtitle"><?php echo $facility['subtitle']; ?></span>
                                    <h2 class="facility-title"><?php echo $facility['title']; ?></h2>
                                    <p class="facility-description"><?php echo $facility['description']; ?></p>
                                    
                                    <?php if (!empty($facility['features'])): ?>
                                    <ul class="facility-features">
                                        <?php foreach ($facility['features'] as $feature): ?>
                                        <li><?php echo $feature; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                    
                                    <?php if (isset($facility['additional_text'])): ?>
                                    <p class="facility-description"><?php echo $facility['additional_text']; ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if (isset($facility['focus_title']) && isset($facility['focus_text'])): ?>
                                    <div class="key-focus-box">
                                        <h4><?php echo $facility['focus_title']; ?></h4>
                                        <p><?php echo $facility['focus_text']; ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- فوتر سایت -->
        <?php include_once 'includes/footer.php'; ?>
    </div>

    <!-- اسکریپت‌ها -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <script>
        // راه‌اندازی انیمیشن‌ها
        new WOW().init();
        
        // Generate random stars for cosmic background
        function generateStars() {
            const cosmicBg = document.querySelector('.cosmic-bg');
            if (!cosmicBg) return;
            
            const starsCount = 100;
            
            for (let i = 0; i < starsCount; i++) {
                const star = document.createElement('div');
                star.classList.add('cosmic-star');
                
                // Random size between 1-3px
                const size = Math.random() * 2 + 1;
                star.style.width = size + 'px';
                star.style.height = size + 'px';
                
                // Random position
                star.style.top = Math.random() * 100 + '%';
                star.style.left = Math.random() * 100 + '%';
                
                // Random animation delay
                star.style.animationDelay = Math.random() * 2 + 's';
                
                cosmicBg.appendChild(star);
            }
        }
        
        $(document).ready(function() {
            generateStars();
        });
    </script>
</body>
</html>