<?php
/**
 * Terms and Conditions for Registration Page - Database Driven Approach
 * 
 * This file contains the registration terms, requirements, fees information,
 * and payment methods for Salman Educational Complex.
 * 
 * @package Salman Educational Complex
 * @version 3.0
 */

// Include configuration file
require_once 'includes/config.php';
require_once 'includes/terms_functions.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo getTermsContent('page_title', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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

    <!-- Template Styles -->
    <link rel="stylesheet" href="assets/css/salman.css" />
    <!-- Custom Styles for Registration Terms Page -->
    <?php include_once 'assets/css/pages/terms.css.php'; ?>    

</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Header Section -->
        <section class="terms-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="terms-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="terms-header__title">
                        <?php echo getTermsContent('header_title', $lang); ?>
                    </h1>
                    <p class="terms-header__subtitle">
                        <?php echo getTermsContent('header_subtitle', $lang); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content Section for Terms and Registration -->
        <section class="terms-registration-section">
            <div class="container">
                <div class="row">
                    <!-- Left Content Column -->
                    <div class="col-lg-8">
                        <!-- Registration Instructions -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="100ms">
                            <h3 class="section-title">
                                <i class="fas fa-clipboard-list section-icon"></i>
                                <?php echo getTermsContent('registration_instructions_title', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <div class="documents-required">
                                    <h4><?php echo getTermsContent('required_documents_title', $lang); ?></h4>
                                    <p><?php echo getTermsContent('documents_ready_text', $lang); ?></p>
                                    <ul class="check-list">
                                        <?php
                                        $requiredDocuments = getTermsRepeatingItems('required_document', $lang);
                                        foreach ($requiredDocuments as $document) {
                                            echo '<li><span class="icon"><i class="fas fa-check"></i></span> ' . $document . '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Transportation Services -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="200ms">
                            <h3 class="section-title">
                                <i class="fas fa-bus-alt section-icon"></i>
                                <?php echo getTermsContent('transportation_services_title', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <p>
                                    <?php echo getTermsContent('transportation_info_text', $lang); ?>
                                    <strong><?php echo getTermsContent('coordinator_name', $lang); ?></strong> 
                                    <?php echo getTermsContent('contact_label', $lang); ?>
                                    <a href="tel:<?php echo getTermsContent('coordinator_phone', $lang); ?>" class="highlight-phone <?php echo $isRtl ? 'numbers-ltr' : ''; ?>">
                                        <?php echo formatPhone(getTermsContent('coordinator_phone', $lang), $lang); ?>
                                    </a>
                                    
                                    <?php echo getTermsContent('transportation_regulations_text', $lang); ?>
                                </p>
                                
                                <div class="transportation-routes">
                                    <h4><?php echo getTermsContent('transportation_routes_title', $lang); ?></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered route-table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo getTermsContent('route_label', $lang); ?></th>
                                                    <th><?php echo getTermsContent('stops_label', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Get bus routes from bus_routes and bus_route_translations tables
                                                $busRoutes = getBusRoutes($lang);
                                                foreach ($busRoutes as $route) {
                                                    echo '<tr>';
                                                    echo '<td>' . $route['route_id'] . '</td>';
                                                    echo '<td>' . $route['description'] . '</td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tuition Fees -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="300ms">
                            <h3 class="section-title">
                                <i class="fas fa-money-bill-wave section-icon"></i>
                                <?php echo getTermsContent('tuition_fees_title', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <div class="tuition-fees">
                                    <h4><?php echo getTermsContent('basic_tuition_fees_title', $lang); ?></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered fees-table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo getTermsContent('grade_label', $lang); ?></th>
                                                    <th><?php echo getTermsContent('tuition_fee_label', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Get tuition fees from the database
                                                $tuitionFees = getTuitionFees($lang);
                                                foreach ($tuitionFees as $fee) {
                                                    echo '<tr>';
                                                    echo '<td>' . $fee['grade_name'] . '</td>';
                                                    echo '<td>' . $fee['fee_amount'] . ' AED</td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h4><?php echo getTermsContent('transportation_fees_title', $lang); ?></h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered fees-table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo getTermsContent('route_label', $lang); ?></th>
                                                    <th><?php echo getTermsContent('transportation_fee_label', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Get transportation fees from the database
                                                $transportationFees = getTransportationFees($lang);
                                                foreach ($transportationFees as $fee) {
                                                    echo '<tr>';
                                                    echo '<td>' . $fee['location_name'] . '</td>';
                                                    echo '<td>' . $fee['fee_amount'] . ' AED</td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="400ms">
                            <h3 class="section-title">
                                <i class="fas fa-credit-card section-icon"></i>
                                <?php echo getTermsContent('payment_methods_title', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <div class="payment-methods">
                                    <?php echo getTermsContent('payment_methods_content', $lang); ?>
                                </div>

                                <div class="bank-accounts">
                                    <h4><?php echo getTermsContent('bank_accounts_title', $lang); ?></h4>
                                    <ul class="account-list">
                                        <?php
                                        $bankAccounts = getTermsRepeatingItems('bank_account', $lang);
                                        foreach ($bankAccounts as $account) {
                                            $accountData = json_decode($account, true);
                                            echo '<li><span class="icon"><i class="fas fa-university"></i></span> ';
                                            echo '<strong>' . $accountData['title'] . '</strong> ' . $accountData['details'] . '</li>';
                                        }
                                        ?>
                                    </ul>
                                    <p><strong><?php echo getTermsContent('approved_banks_title', $lang); ?></strong> <?php echo getTermsContent('approved_banks_list', $lang); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- School Regulations -->
                        <div class="registration-block wow fadeInUp" data-wow-delay="500ms">
                            <h3 class="section-title">
                                <i class="fas fa-gavel section-icon"></i>
                                <?php echo getTermsContent('school_regulations_title', $lang); ?>
                            </h3>
                            <div class="registration-content">
                                <p><?php echo getTermsContent('code_of_conduct_text', $lang); ?></p>
                                <div class="regulation-action">
                                    <a href="<?php echo getTermsContent('code_of_conduct_link', $lang); ?>" class="btn btn-primary terms-btn">
                                        <i class="fas fa-book-open me-2"></i>
                                        <span><?php echo getTermsContent('read_complete_code_button', $lang); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar Column -->
                    <div class="col-lg-4">
                        <div class="registration-sidebar sticky-sidebar wow fadeInRight" data-wow-delay="200ms">
                            <!-- Apply CTA Widget -->
                            <div class="sidebar-widget registration-cta">
                                <h3><?php echo getTermsContent('apply_today_title', $lang); ?></h3>
                                <p><?php echo getTermsContent('apply_today_text', $lang); ?></p>
                                <a href="Registration.php<?php echo '?lang=' . $lang; ?>" class="btn btn-apply">
                                    <i class="fas fa-user-plus me-2"></i>
                                    <span><?php echo getTermsContent('apply_now_button', $lang); ?></span>
                                </a>
                            </div>
                            
                            <!-- Contact Info Widget -->
                            <div class="sidebar-widget contact-info">
                                <h3><?php echo getTermsContent('need_help_title', $lang); ?></h3>
                                <ul class="contact-list">
                                    <li>
                                        <span class="icon"><i class="fas fa-phone-alt"></i></span>
                                        <div class="text">
                                            <h5><?php echo getTermsContent('call_us_label', $lang); ?></h5>
                                            <a href="tel:<?php echo getTermsContent('school_phone', $lang); ?>" class="contact-link">
                                                <?php echo formatPhone(getTermsContent('school_phone', $lang), $lang); ?>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon"><i class="fas fa-envelope"></i></span>
                                        <div class="text">
                                            <h5><?php echo getTermsContent('email_label', $lang); ?></h5>
                                            <a href="mailto:<?php echo getTermsContent('school_email', $lang); ?>" class="contact-link">
                                                <?php echo getTermsContent('school_email', $lang); ?>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <div class="text">
                                            <h5><?php echo getTermsContent('visit_us_label', $lang); ?></h5>
                                            <p><?php echo getTermsContent('school_address', $lang); ?></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Important Dates Widget -->
                            <div class="sidebar-widget important-dates">
                                <h3><?php echo getTermsContent('important_dates_title', $lang); ?></h3>
                                <ul class="dates-list">
                                    <?php
                                    $importantDates = getTermsRepeatingItems('important_date', $lang);
                                    foreach ($importantDates as $date) {
                                        $dateData = json_decode($date, true);
                                        echo '<li>';
                                        echo '<span class="date">' . $dateData['date'] . '</span>';
                                        echo '<p>' . $dateData['description'] . '</p>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <!-- FAQ Quick Link Widget -->
                            <div class="sidebar-widget faq-link">
                                <h3><?php echo getTermsContent('faq_section_title', $lang); ?></h3>
                                <p><?php echo getTermsContent('faq_section_text', $lang); ?></p>
                                <a href="faq.php<?php echo '?lang=' . $lang; ?>" class="btn btn-outline">
                                    <i class="fas fa-question-circle me-2"></i>
                                    <span><?php echo getTermsContent('view_faqs_button', $lang); ?></span>
                                </a>
                            </div>
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
    
    <!-- Custom JS for Cosmic Background -->
    <script src="assets/js/cosmic-bg.js"></script>
    
    <!-- Custom JS for Sticky Sidebar -->
    <script>
 // Optimized sticky sidebar functionality
$(document).ready(function() {
    const sidebar = $('.sticky-sidebar');
    const contentArea = $('.terms-registration-section');
    const footer = $('footer');
    
    // Exit if sidebar doesn't exist
    if (sidebar.length === 0) return;
    
    // Store initial positions to avoid recalculating
    let initialSidebarTop = sidebar.offset().top;
    let sidebarWidth = sidebar.parent().width();
    
    // Use requestAnimationFrame to throttle scroll events
    let ticking = false;
    
    function updateSidebar() {
        const scrollTop = $(window).scrollTop();
        const sidebarHeight = sidebar.outerHeight();
        const footerTop = footer.offset().top;
        const stopPoint = footerTop - sidebarHeight - 40; // 40px buffer
        
        // Reset ticking flag
        ticking = false;
        
        // Only apply sticky behavior if sidebar is shorter than content area
        if (sidebarHeight >= contentArea.outerHeight()) {
            sidebar.css({
                'position': 'relative',
                'top': '0',
                'bottom': 'auto',
                'width': '100%'
            });
            return;
        }
        
        if (scrollTop > initialSidebarTop) {
            if (scrollTop < stopPoint) {
                // Pin sidebar to follow scroll
                sidebar.css({
                    'position': 'fixed',
                    'top': '20px',
                    'bottom': 'auto',
                    'width': sidebarWidth
                });
            } else {
                // Stop sidebar before footer
                sidebar.css({
                    'position': 'absolute',
                    'top': (stopPoint - initialSidebarTop) + 'px',
                    'bottom': 'auto',
                    'width': sidebarWidth
                });
            }
        } else {
            // Reset to original position
            sidebar.css({
                'position': 'relative',
                'top': '0',
                'bottom': 'auto',
                'width': '100%'
            });
        }
    }
    
    // Initial call
    updateSidebar();
    
    // Throttle scroll events with requestAnimationFrame
    $(window).on('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateSidebar();
            });
            ticking = true;
        }
    });
    
    // Only update dimensions on resize, not position
    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            sidebarWidth = sidebar.parent().width();
            sidebar.css('width', sidebarWidth);
            updateSidebar();
        }, 250);
    });
});
    </script>
</body>
</html>