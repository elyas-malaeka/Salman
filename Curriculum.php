<?php
/**
 * Curriculum Page
 * 
 * This file displays the curriculum information for Salman Educational Complex,
 * including Ehsan section (for students with special needs), Elementary, 
 * Middle School and High School divisions.
 * 
 * @package Salman Educational Complex
 * @version 2.1
 */

// Include configuration file
require_once 'includes/config.php';
// Include curriculum helper functions
require_once 'includes/curriculum_functions.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo t('curriculum_title', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.css" />
    <link rel="stylesheet" href="assets/vendors/salman-icons/style.css" />
    <link rel="stylesheet" href="assets/vendors/slick/slick.css">
    <link rel="stylesheet" href="assets/vendors/jquery-flipster-master/jquery.flipster.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css" />
    
    <!-- Custom Styles for Curriculum Page -->
    <?php include_once 'assets/css/pages/curriculum.css.php'; ?>   
   
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Header Section -->
        <section class="curriculum-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="curriculum-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="curriculum-header__title">
                        <?php echo getCurriculumContent('page_title'); ?>
                    </h1>
                    <p class="curriculum-header__subtitle">
                        <?php echo getCurriculumContent('page_subtitle'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Ehsan Section -->
        <section class="curriculum-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="section-image wow fadeInUp" data-wow-delay="100ms">
                            <!-- Using the correct image path from database -->
                            <img src="<?php echo getCurriculumImage('ehsan_image'); ?>" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان بخش احسان' : 'Ehsan section students'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-content ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo getCurriculumContent('ehsan_section_label'); ?></p>
                            <div class="special-needs-badge">
                                <i class="fas fa-star me-1"></i>
                                <?php echo getCurriculumContent('ehsan_badge'); ?>
                            </div>
                            <h2 class="section-title">
                                <?php echo getCurriculumContent('ehsan_title'); ?>
                            </h2>
                            <p class="section-description">
                                <?php echo getCurriculumContent('ehsan_description'); ?>
                            </p>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title" style="color: rgb(15, 12, 95);">
                                        <?php echo getCurriculumContent('ehsan_feature1_title'); ?>
                                    </h4>
                                    <p class="feature-text">
                                        <?php echo getCurriculumContent('ehsan_feature1_text'); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title" style="color: rgb(15, 12, 95);">
                                        <?php echo getCurriculumContent('ehsan_feature2_title'); ?>
                                    </h4>
                                    <p class="feature-text">
                                        <?php echo getCurriculumContent('ehsan_feature2_text'); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <a href="Ehsan SOD page.php<?php echo '?lang=' . $lang; ?>" class="btn btn-read-more">
                                <?php echo getCurriculumContent('ehsan_button_text'); ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Elementary Section -->
        <section class="curriculum-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0">
                        <div class="row wow fadeInUp" data-wow-delay="200ms">
                            <div class="col-md-12 mb-4">
                                <div class="section-image">
                                    <!-- Using the correct image path from database -->
                                    <img src="<?php echo getCurriculumImage('elementary_image'); ?>" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان ابتدایی' : 'Elementary students'; ?>">
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="section-content pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo getCurriculumContent('elementary_section_label'); ?></p>
                            <h2 class="section-title">
                                <?php echo getCurriculumContent('elementary_title'); ?>
                            </h2>
                            
                            <div class="ps-lg-0 mt-4">
                                <h3 style="font-size: 22px; margin-bottom: 20px; font-weight: 700; color: rgb(15, 12, 95);">
                                    <?php echo getCurriculumContent('elementary_subtitle'); ?>
                                </h3>
                                <p class="section-description">
                                    <?php echo getCurriculumContent('elementary_description'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Middle School Section -->
        <section class="curriculum-section">
            <div class="container">
            <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="section-image wow fadeInUp" data-wow-delay="100ms">
                            <!-- Using the correct image path from database -->
                            <img src="<?php echo getCurriculumImage('middle_image'); ?>" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان راهنمایی' : 'Middle school students'; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-content ps-lg-5 wow fadeInRight" data-wow-delay="200ms">
                            <p class="section-label"><?php echo getCurriculumContent('middle_section_label'); ?></p>
                            <h2 class="section-title">
                                <?php echo getCurriculumContent('middle_title'); ?>
                            </h2>
                            <p class="section-description">
                                <?php echo getCurriculumContent('middle_description1'); ?>
                            </p>
                            <p class="section-description">
                                <?php echo getCurriculumContent('middle_description2'); ?>
                            </p>
                            
                            <div class="key-focus">
                                <h4 style="color: rgb(15, 12, 95);">
                                    <?php echo getCurriculumContent('middle_focus_title'); ?>
                                </h4>
                                <p>
                                    <?php echo getCurriculumContent('middle_focus_text'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- High School Section -->
        <section class="curriculum-section" style="background-color: var(--bg-light);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-5 mb-lg-0 order-lg-2">
                        <div class="section-image h-100 wow fadeInUp" data-wow-delay="200ms">
                            <!-- Using the correct image path from database -->
                            <img src="<?php echo getCurriculumImage('high_image'); ?>" alt="<?php echo $lang == 'fa' ? 'دانش‌آموزان دبیرستان' : 'High school students'; ?>" style="height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-7 order-lg-1">
                        <div class="section-content pe-lg-5 wow fadeInLeft" data-wow-delay="100ms">
                            <p class="section-label"><?php echo getCurriculumContent('high_section_label'); ?></p>
                            <h2 class="section-title">
                                <?php echo getCurriculumContent('high_title'); ?>
                            </h2>
                            <p class="section-description">
                                <?php echo getCurriculumContent('high_description'); ?>
                            </p>
                            
                            <div class="row">
                                <?php
                                // دریافت ویژگی‌های دبیرستان از دیتابیس
                                $features = getHighSchoolFeatures();
                                $delay = 200;
                                foreach ($features as $index => $feature):
                                    $delay += 100;
                                ?>
                                <div class="col-md-6 mb-4">
                                    <div class="feature-box wow fadeInUp" data-wow-delay="<?php echo $delay; ?>ms">
                                        <h4 style="color: rgb(15, 12, 95);">
                                            <?php echo $feature['title']; ?></h4>
                                        <p>
                                            <?php echo $feature['text']; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel"><?php echo $lang == 'fa' ? 'تور مدرسه' : 'School Tour'; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoFrame" src="" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    
    <!-- Custom JS for Curriculum Page -->
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
        
        // Video modal functionality
        $(document).ready(function() {
            generateStars();
            
            // Video URLs mapping
            const videoURLs = {
                'elementary-tour': 'https://www.youtube.com/embed/your-elementary-video-id'
            };
            
            // Play button click handler
            $('.play-button').on('click', function() {
                const videoId = $(this).data('video-id');
                const videoURL = videoURLs[videoId] || '';
                
                $('#videoFrame').attr('src', videoURL);
                $('#videoModal').modal('show');
            });
            
            // Stop video when modal is closed
            $('#videoModal').on('hidden.bs.modal', function () {
                $('#videoFrame').attr('src', '');
            });
        });
    </script>
</body>
</html>