<?php
/**
 * About Us Page - Enhanced Version with Multiple Language Support
 * 
 * Clean, responsive presentation of the school's history and values
 * Built with modern animations, interactive elements and multilingual support
 * 
 * @package Salman Educational Complex
 * @version 3.0
 * @author Salman Farsi Web Team
 */

// Include configuration file
require_once 'includes/config.php';

// Include about page helper functions
require_once 'includes/about_helpers.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa' || $lang == 'ar');

// Set font family based on language
$fontFamily = ($isRtl) ? "'Vazir', 'Vazirmatn', sans-serif" : "'Plus Jakarta Sans', sans-serif";

// Define Arabic-specific styles
$arSpecificStyle = ($lang == 'ar') ? 'font-family: "Cairo", sans-serif; letter-spacing: 0;' : '';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo getAboutContent('page_title'); ?> | <?php echo SITE_NAME_EN; ?></title>

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
    <?php if ($lang == 'ar'): ?>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

    <!-- Custom Styles for About Page -->
    <?php include_once 'assets/css/pages/about.css.php'; ?>      
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>
    <div class="page-wrapper">
        <?php include_once 'includes/menu.php'; ?>

        <!-- Header Section with Cosmic Background -->
        <section class="about-header">
            <!-- Cosmic Background Effect -->
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Stars are added dynamically via JavaScript -->
            </div> 
            <div class="container">
                <div class="about-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="about-header__title">
                        <?php echo getAboutContent('page_title'); ?>
                    </h1>
                    <p class="about-header__subtitle">
                        <?php echo getAboutContent('header_subtitle'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- About Section with Video -->
        <section class="about-section">
            <div class="container">
                <div class="row">
                    <!-- Video Column -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <!-- Interactive Video Player with Custom Controls -->
                        <div class="about-video wow fadeInLeft" data-wow-delay="200ms">
                            <div class="video-container">
                                <div class="video-wrapper">
                                    <video id="schoolVideo" class="school-video" poster="<?php echo getAboutContent('video_thumbnail'); ?>" preload="metadata">
                                        <source src="<?php echo getAboutContent('video_path'); ?>" type="video/mp4">
                                        <?php echo t('video_not_supported', $lang); ?>
                                    </video>
                                    <div class="video-overlay" id="videoOverlay">
                                        <div class="play-button" id="customPlayButton">
                                            <i class="fas fa-play"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-caption">
                                    <?php echo getAboutContent('video_caption'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Column -->
                    <div class="col-lg-6">
                        <div class="about-content wow fadeInRight" data-wow-delay="200ms">
                            <p class="about-heading__tagline">
                                <?php echo getAboutContent('history_tagline'); ?>
                            </p>
                            <h2 class="about-heading__title">
                                <?php echo getAboutContent('history_title'); ?>
                            </h2>
                            <div class="about-content__text">
                                <p><?php echo getAboutContent('history_paragraph_1'); ?></p>
                                <p><?php echo getAboutContent('history_paragraph_2'); ?></p>
                                <p><?php echo getAboutContent('history_paragraph_3'); ?></p>
                            </div>
                            
                            <!-- Highlights with Icon -->
                            <div class="about-highlights">
                                <div class="row">
                                    <?php
                                    $highlights = getAboutHighlights();
                                    $half = ceil(count($highlights) / 2);
                                    $firstHalf = array_slice($highlights, 0, $half);
                                    $secondHalf = array_slice($highlights, $half);
                                    ?>
                                    
                                    <div class="col-md-6">
                                        <?php foreach ($firstHalf as $index => $highlight): ?>
                                        <div class="about-highlight" data-wow-delay="<?php echo (0.3 + $index * 0.1); ?>s">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            <?php echo $highlight['title']; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php foreach ($secondHalf as $index => $highlight): ?>
                                        <div class="about-highlight" data-wow-delay="<?php echo (0.3 + (count($firstHalf) + $index) * 0.1); ?>s">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            <?php echo $highlight['title']; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Campus Information Section -->
        <section class="about-section bg-light">
            <div class="container">
                <div class="row">
                    <!-- Content Column -->
                    <div class="col-lg-6 order-lg-1 order-2">
                        <div class="about-content wow fadeInLeft" data-wow-delay="200ms">
                           <p class="about-heading__tagline">
                                <?php echo getAboutContent('campus_tagline'); ?>
                            </p>
                            <h2 class="about-heading__title">
                                <?php echo getAboutContent('campus_title'); ?>
                            </h2>
                            <div class="about-content__text">
                                <p><?php echo getAboutContent('campus_paragraph_1'); ?></p>
                                <p><?php echo getAboutContent('campus_paragraph_2'); ?></p>
                            </div>
                            
                            <!-- Campus Statistics with Animation -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="campus-stat text-center p-3 bg-white rounded shadow-sm" data-wow-delay="0.3s">
                                        <h3 class="fs-2 text-primary fw-bold count-animation" data-count="<?php echo getAboutContent('campus_stat_1'); ?>">0</h3>
                                        <p class="mb-0"><?php echo getAboutContent('campus_stat_1_label'); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="campus-stat text-center p-3 bg-white rounded shadow-sm" data-wow-delay="0.5s">
                                        <h3 class="fs-2 text-primary fw-bold count-animation" data-count="<?php echo getAboutContent('campus_stat_2'); ?>">0</h3>
                                        <p class="mb-0"><?php echo getAboutContent('campus_stat_2_label'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Column -->
                    <div class="col-lg-6 order-lg-2 order-1 mb-5 mb-lg-0">
                        <div class="about-image wow fadeInRight" data-wow-delay="200ms">
                            <img src="<?php echo getAboutContent('campus_image'); ?>" alt="Salman Farsi Campus" class="img-fluid rounded shadow">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section with Interactive Cards -->
        <section class="features-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                        <p class="about-heading__tagline">
                            <?php echo getAboutContent('features_tagline'); ?>
                        </p>
                        <h2 class="about-heading__title">
                            <?php echo getAboutContent('features_title'); ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row">
                    <?php 
                    $features = getAboutFeatures();
                    foreach ($features as $index => $feature): 
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-item wow fadeInUp" data-wow-delay="<?php echo (100 + $index * 100); ?>ms">
                            <div class="feature-item__icon">
                                <i class="<?php echo $feature['icon']; ?>"></i>
                            </div>
                            <h3 class="feature-item__title">
                                <?php echo $feature['title']; ?>
                            </h3>
                            <p class="feature-item__text">
                                <?php echo $feature['description']; ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Stats Section with Animated Counters -->
        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <?php 
                    $stats = getAboutStats();
                    foreach ($stats as $index => $stat): 
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item wow fadeInUp" data-wow-delay="<?php echo (100 + $index * 100); ?>ms">
                            <div class="stats-item__icon">
                                <i class="<?php echo $stat['icon']; ?>"></i>
                            </div>
                            <div class="stats-item__number">
                                <span class="counter-value" data-count="<?php echo $stat['number']; ?>">0</span>+
                            </div>
                            <div class="stats-item__text">
                                <?php echo $stat['text']; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Graduates Success Section -->
        <section class="about-section">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Image Column -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="about-image wow fadeInLeft" data-wow-delay="200ms">
                            <img src="<?php echo getAboutContent('graduates_image'); ?>" alt="Salman Farsi Graduates" class="img-fluid rounded shadow">
                        </div>
                    </div>
                    
                    <!-- Content Column -->
                    <div class="col-lg-6">
                        <div class="about-content wow fadeInRight" data-wow-delay="200ms">
                            <p class="about-heading__tagline">
                                <?php echo getAboutContent('graduates_tagline'); ?>
                            </p>
                            <h2 class="about-heading__title">
                                <?php echo getAboutContent('graduates_title'); ?>
                            </h2>
                            <div class="about-content__text">
                                <p><?php echo getAboutContent('graduates_paragraph_1'); ?></p>
                                <p><?php echo getAboutContent('graduates_paragraph_2'); ?></p>
                            </div>
                            
                            <!-- Graduate Statistics -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="graduate-stat text-center p-3 bg-light rounded">
                                        <h3 class="fs-2 text-primary fw-bold counter-value" data-count="<?php echo getAboutContent('graduate_stat_1'); ?>">0</h3><span class="fs-2 text-primary fw-bold">%+</span>
                                        <p class="mb-0"><?php echo getAboutContent('graduate_stat_1_label'); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="graduate-stat text-center p-3 bg-light rounded">
                                        <h3 class="fs-2 text-primary fw-bold counter-value" data-count="<?php echo getAboutContent('graduate_stat_2'); ?>">0</h3><span class="fs-2 text-primary fw-bold">%+</span>
                                        <p class="mb-0"><?php echo getAboutContent('graduate_stat_2_label'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section with Leadership -->
        <section class="team-section bg-light">
            <div class="container">
                <!-- Section Header -->
                <div class="row">
                    <div class="col-md-8 mx-auto text-center mb-5 wow fadeInUp" data-wow-delay="100ms">
                         <p class="about-heading__tagline">
                            <?php echo getAboutContent('team_tagline'); ?>
                        </p>
                        <h2 class="about-heading__title">
                            <?php echo getAboutContent('team_title'); ?>
                        </h2>
                    </div>
                </div>
                
                <!-- Team Members Row -->
                <div class="row">
                    <?php 
                    $team_members = getAboutTeamMembers();
                    foreach ($team_members as $index => $member): 
                    ?>
                    <!-- Team Member <?php echo $index + 1; ?> -->
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item wow fadeInUp" data-wow-delay="<?php echo (100 + $index * 100); ?>ms">
                            <div class="team-item__image">
                                <img src="<?php echo $member['image_path']; ?>" alt="<?php echo $member['name']; ?>">
                            </div>
                            <div class="team-item__content">
                                <h3 class="team-item__title">
                                    <a href="#"><?php echo $member['name']; ?></a>
                                </h3>
                                <p class="team-item__designation">
                                    <?php echo $member['position']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- View All Staff Button -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="staff.php" class="btn btn-primary btn-lg px-4 py-2 wow fadeInUp" data-wow-delay="500ms">
                        <?php echo getAboutContent('view_all_staff_button'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-5 cta-section" style="background-color: var(--primary-color);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-7">
                        <div class="text-white">
                            <h2 class="cta-heading wow fadeInLeft" data-wow-delay="300ms">
                                <?php echo getAboutContent('cta_title'); ?>
                            </h2>
                            <p class="cta-subheading wow fadeInLeft" data-wow-delay="400ms">
                                <?php echo getAboutContent('cta_subtitle'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 text-md-end text-center mt-4 mt-md-0 wow fadeInRight" data-wow-delay="500ms">
                        <a href="Terms and Conditions for Registration.php" class="btn btn-light cta-btn fw-bold">
                            <?php echo getAboutContent('cta_button_text'); ?>
                        </a>
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

    <!-- Enhanced Custom JavaScript for About Us Page -->
    <script>
        /**
         * Custom JavaScript for About Us Page - Enhanced Version
         * Includes animations, counter effects, and video player functionality
         * 
         * @package Salman Educational Complex
         * @version 3.0
         */
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize components
            initCosmicStars();
            initVideoPlayer();
            initCounters();
            initWowAnimations();
            initFeatureHover();
            
            /**
             * Create cosmic stars animation
             * Adds dynamic stars to the header background
             */
            function initCosmicStars() {
                const cosmicBg = document.querySelector('.cosmic-bg');
                if (!cosmicBg) return;
                
                const starsCount = 80; // More stars for better effect
                
                for (let i = 0; i < starsCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'cosmic-star';
                    
                    // Random size between 1-4px
                    const size = Math.random() * 3 + 1;
                    star.style.width = `${size}px`;
                    star.style.height = `${size}px`;
                    
                    // Random position
                    star.style.left = `${Math.random() * 100}%`;
                    star.style.top = `${Math.random() * 100}%`;
                    
                    // Random animation duration and delay
                    star.style.animationDuration = `${Math.random() * 3 + 1}s`;
                    star.style.animationDelay = `${Math.random() * 3}s`;
                    
                    cosmicBg.appendChild(star);
                }
            }
            
            /**
             * Initialize custom video player
             * Handles play/pause functionality and overlay display
             */
            function initVideoPlayer() {
                const video = document.getElementById('schoolVideo');
                const videoOverlay = document.getElementById('videoOverlay');
                const customPlayButton = document.getElementById('customPlayButton');
                
                if (!video || !videoOverlay || !customPlayButton) return;
                
                const videoContainer = video.closest('.video-container');
                
                // Play button click handler
                customPlayButton.addEventListener('click', function() {
                    playVideo();
                });
                
                // Video click handler for play/pause toggle
                video.addEventListener('click', function() {
                    if (video.paused) {
                        playVideo();
                    } else {
                        pauseVideo();
                    }
                });
                
                // Show overlay when video is paused
                video.addEventListener('pause', function() {
                    showOverlay();
                });
                
                // Show overlay when video ends
                video.addEventListener('ended', function() {
                    showOverlay();
                });
                
                // Helper function to play video
                function playVideo() {
                    video.play()
                        .then(() => {
                            hideOverlay();
                        })
                        .catch(error => {
                            console.error('Error playing video:', error);
                            // Show a message to the user that they need to interact with the page first
                            alert('Please interact with the page first to play the video');
                        });
                }
                
                // Helper function to pause video
                function pauseVideo() {
                    video.pause();
                    showOverlay();
                }
                
                // Helper function to hide overlay
                function hideOverlay() {
                    videoContainer.classList.add('video-playing');
                }
                
                // Helper function to show overlay
                function showOverlay() {
                    videoContainer.classList.remove('video-playing');
                }
            }
            
            /**
             * Initialize number counters
             * Animates counting from 0 to target number
             */
            function initCounters() {
                // Select all counter elements
                const counters = document.querySelectorAll('.counter-value');
                const countAnimations = document.querySelectorAll('.count-animation');
                
                // Set up intersection observer for triggering count animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -100px 0px'
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const element = entry.target;
                            const target = parseInt(element.getAttribute('data-count'));
                            animateCounter(element, target);
                            observer.unobserve(element);
                        }
                    });
                }, observerOptions);
                
                // Observe all counter elements
                counters.forEach(counter => {
                    observer.observe(counter);
                });
                
                countAnimations.forEach(counter => {
                    observer.observe(counter);
                });
                
                /**
                 * Animate counter from 0 to target
                 * 
                 * @param {HTMLElement} element - The counter element
                 * @param {number} target - The target number
                 */
                function animateCounter(element, target) {
                    const duration = 2000; // 2 seconds
                    const frameRate = 30; // Frames per second
                    const totalFrames = duration * frameRate / 1000;
                    let frame = 0;
                    
                    const counter = setInterval(() => {
                        frame++;
                        
                        // Calculate current value using easeOutQuad
                        const progress = frame / totalFrames;
                        const easedProgress = 1 - Math.pow(1 - progress, 2);
                        const currentValue = Math.floor(easedProgress * target);
                        
                        // Update counter display
                        element.textContent = currentValue;
                        
                        // Check if animation is complete
                        if (frame === totalFrames) {
                            clearInterval(counter);
                            element.textContent = target;
                        }
                    }, 1000 / frameRate);
                }
            }
            
            /**
             * Initialize WOW.js animations
             * Handles scroll-based animations
             */
            function initWowAnimations() {
                if (typeof WOW === 'function') {
                    new WOW({
                        boxClass: 'wow',
                        animateClass: 'animated',
                        offset: 50,
                        mobile: true,
                        live: true
                    }).init();
                }
            }
            
            /**
             * Add 3D hover effect to feature cards
             * Creates dynamic 3D effect on mouse move
             */
            function initFeatureHover() {
                const features = document.querySelectorAll('.feature-item');
                
                features.forEach(feature => {
                    feature.addEventListener('mousemove', function(e) {
                        const { left, top, width, height } = this.getBoundingClientRect();
                        const x = (e.clientX - left) / width - 0.5;
                        const y = (e.clientY - top) / height - 0.5;
                        
                        this.style.transform = `translateY(-15px) perspective(1000px) rotateX(${y * -10}deg) rotateY(${x * 10}deg)`;
                        
                        const icon = this.querySelector('.feature-item__icon');
                        if (icon) {
                            icon.style.transform = `translateZ(20px) rotateY(${x * 30}deg)`;
                        }
                    });
                    
                    feature.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) perspective(1000px) rotateX(0) rotateY(0)';
                        
                        const icon = this.querySelector('.feature-item__icon');
                        if (icon) {
                            icon.style.transform = '';
                            
                            // Add a small animation when leaving
                            setTimeout(() => {
                                icon.style.transition = 'transform 0.5s ease';
                                icon.style.transform = 'rotateY(0)';
                            }, 50);
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>