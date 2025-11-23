<?php
/**
 * Ehsan Students of Determination (SOD) Page
 * 
 * Displays detailed information about the Ehsan department of Salman Farsi Educational Complex,
 * which provides specialized education and rehabilitation services for students with special needs.
 * 
 * @package Salman Educational Complex
 * @version 3.0
 */

// Include configuration file
require_once 'includes/config.php';

// شامل‌سازی توابع مربوط به صفحه بخش احسان
require_once 'includes/ehsan-functions.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa' || $lang == 'ar');

// دریافت محتوای صفحه از دیتابیس
$pageTitle = getEhsanContent('page_title', $lang);
$pageSubtitle = getEhsanContent('page_subtitle', $lang);
$introContent = getEhsanIntroContent($lang);
$objectivesTitle = getEhsanContent('objectives_title', $lang);
$objectives = getEhsanObjectives($lang);
$speechTherapyContent = getEhsanSpeechTherapyContent($lang);
$speechTherapyAreas = getEhsanSpeechTherapyAreas($lang);
$servicesTitle = getEhsanContent('services_title', $lang);
$services = getEhsanServices($lang);
$conclusionContent = getEhsanConclusionContent($lang);
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

    <!-- CSS فایل‌ها -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />


    
     <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/pages.css.php'; ?>
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <!-- منوی سایت -->
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
                    style=" font-size: 3.2rem;
                            font-weight: 800;
                            color: #ffffff;
                            margin: 0 0 1.5rem 0;
                            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.7);
                            letter-spacing: -0.02em;
                            line-height: 1.1;" > <?php echo $pageTitle; ?>
                            </h1>
                    <p class="header-subtitle">
                      <?php echo $pageSubtitle; ?>
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
        

        <!-- Introduction Section -->
        <section class="ehsan-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="ehsan-image wow fadeInUp" data-wow-delay="100ms">
                            <img src="<?php echo $introContent['image']; ?>" alt="<?php echo $introContent['title']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-4 wow fadeInRight" data-wow-delay="200ms">
                            <h2 class="section-title">
                                <?php echo $introContent['title']; ?>
                            </h2>
                            <div class="section-description">
                                <p><?php echo $introContent['description1']; ?></p>
                                <p><?php echo $introContent['description2']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Objectives Section -->
        <section class="ehsan-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                        <h2 class="section-title">
                            <?php echo $objectivesTitle; ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row">
                    <?php 
                    // Display first 4 objectives in a 2x2 grid
                    for ($i = 0; $i < min(4, count($objectives)); $i++): 
                        $objective = $objectives[$i];
                        $delay = 200 + ($i * 100);
                    ?>
                    <div class="col-lg-6 mb-4 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $objective['title']; ?>
                            </h4>
                            <p>
                                <?php echo $objective['description']; ?>
                            </p>
                        </div>
                    </div>
                    <?php endfor; ?>
                    
                    <?php
                    // If there's a 5th objective (as in the original file), display it as full width
                    if (count($objectives) >= 5):
                        $lastObjective = $objectives[4];
                    ?>
                    <div class="col-lg-12 mb-4 wow fadeInUp" data-wow-delay="600ms">
                        <div class="objective-box">
                            <h4 style="color: rgb(15, 12, 95);">
                                <?php echo $lastObjective['title']; ?>
                            </h4>
                            <p>
                                <?php echo $lastObjective['description']; ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <!-- Speech Therapy Services Section -->
        <section class="ehsan-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="ehsan-image wow fadeInUp" data-wow-delay="300ms">
                                    <img src="<?php echo $speechTherapyContent['image1']; ?>" alt="<?php echo $speechTherapyContent['title']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="ehsan-image wow fadeInUp" data-wow-delay="400ms">
                                    <img src="<?php echo $speechTherapyContent['image2']; ?>" alt="<?php echo $speechTherapyContent['title']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="pe-lg-4 wow fadeInLeft" data-wow-delay="200ms">
                            <h2 class="section-title">
                                <?php echo $speechTherapyContent['title']; ?>
                            </h2>
                            <div class="section-description">
                                <p><?php echo $speechTherapyContent['description']; ?></p>
                            </div>

                            <h3 class="mt-5 mb-4" style="font-size: 22px; font-weight: 700; color: rgb(15, 12, 95);">
                                <?php echo $speechTherapyContent['areas_title']; ?>
                            </h3>
                            
                            <ul class="check-list">
                                <?php foreach ($speechTherapyAreas as $area): ?>
                                <li>
                                    <strong><?php echo $area['title']; ?>:</strong> 
                                    <?php echo $area['description']; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Services Provided Section -->
        <section class="ehsan-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                        <h2 class="section-title">
                            <?php echo $servicesTitle; ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row">
                    <?php 
                    // First 3 services in first row (col-lg-4)
                    for ($i = 0; $i < min(3, count($services)); $i++): 
                        $service = $services[$i];
                        $delay = 200 + ($i * 100);
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="<?php echo $service['icon']; ?>"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $service['title']; ?>
                                </h3>
                                <p class="service-card__text">
                                    <?php echo $service['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                    
                    <?php 
                    // Remaining services in second row (col-lg-6)
                    for ($i = 3; $i < count($services); $i++): 
                        $service = $services[$i];
                        $delay = 500 + (($i - 3) * 100);
                    ?>
                    <div class="col-lg-6 col-md-6 mb-4 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>ms">
                        <div class="service-card">
                            <div class="service-card__content">
                                <div class="service-card__icon">
                                    <i class="<?php echo $service['icon']; ?>"></i>
                                </div>
                                <h3 class="service-card__title">
                                    <?php echo $service['title']; ?>
                                </h3>
                                <p class="service-card__text">
                                    <?php echo $service['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        
        <!-- Conclusion Section -->
        <section class="ehsan-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                        <div class="ehsan-image">
                            <img src="<?php echo $conclusionContent['image']; ?>" alt="<?php echo $conclusionContent['title']; ?>">
                        </div>
                        
                        <div class="text-center mt-5">
                            <h2 class="section-title">
                                <?php echo $conclusionContent['title']; ?>
                            </h2>
                            <div class="section-description">
                                <p><?php echo $conclusionContent['description']; ?></p>
                            </div>
                        </div>
                        
                        <div class="cta-box wow fadeInUp" data-wow-delay="300ms">
                            <h3>
                                <?php echo $conclusionContent['cta_title']; ?>
                            </h3>
                            <p>
                                <?php echo $conclusionContent['cta_description']; ?>
                            </p>
                            <a href="contact.php<?php echo '?lang=' . $lang; ?>" class="btn-cta">
                                <?php echo $conclusionContent['cta_button_text']; ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div><!-- /.page-wrapper -->

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="assets/vendors/tiny-slider/tiny-slider.js"></script>
    <script src="assets/vendors/wnumb/wNumb.min.js"></script>
    <script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/imagesloaded/imagesloaded.min.js"></script>
    <script src="assets/vendors/isotope/isotope.js"></script>
    <script src="assets/vendors/slick/slick.min.js"></script>
    <script src="assets/vendors/jquery-flipster-master/jquery.flipster.min.js"></script>
    <script src="assets/vendors/countdown/countdown.min.js"></script>
    <script src="assets/vendors/jquery-circleType/jquery.circleType.js"></script>
    <script src="assets/vendors/jquery-lettering/jquery.lettering.min.js"></script>
    
    <!-- Template JS -->
    <script src="assets/js/salman.js"></script>
    
    <!-- Custom JS for Ehsan SOD Page -->
    <script>
        // Initialize wow.js for animations
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