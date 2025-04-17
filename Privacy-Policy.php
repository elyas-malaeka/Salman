<?php
/**
 * Privacy Policy Page
 * 
 * This file contains the privacy policy information of Salman Educational Complex
 * including data collection, usage, and user rights.
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

// Include configuration file
require_once 'includes/config.php';

// Include privacy helper functions
require_once 'includes/privacy_functions.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');

// Get introduction data
$introData = getIntroductionData($lang);

// Get collection data
$collectionData = getCollectionData($lang);

// Get usage data
$usageData = getUsageData($lang);

// Get sharing data
$sharingData = getSharingData($lang);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo t('privacy_policy', $lang); ?> | <?php echo SITE_NAME_EN; ?></title>

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

    <!-- Custom Styles for Privacy Policy Page -->
    <?php include_once 'assets/css/pages/privacy-policy.css.php'; ?>      
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Privacy Policy Hero Header Section -->
        <section class="privacy-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
                <div class="privacy-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="privacy-header__title">
                        <?php echo getPrivacyContent('page_title'); ?>
                    </h1>
                    <p class="privacy-header__subtitle">
                        <?php echo getPrivacyContent('page_subtitle'); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Privacy Policy Main Section -->
        <section class="privacy-policy-section">
            <div class="container">
                <div class="row">
                    <!-- Table of Contents Sidebar -->
                    <div class="col-lg-3">
                        <div class="privacy-toc" id="privacyToc">
                            <div class="privacy-toc__header">
                                <h3 class="privacy-toc__title"><?php echo $lang == 'fa' ? 'فهرست مطالب' : 'Table of Contents'; ?></h3>
                            </div>
                            <ul class="privacy-toc__list">
                                <li class="privacy-toc__item">
                                    <a href="#introduction" class="privacy-toc__link active">
                                        <span class="privacy-toc__icon"><i class="fas fa-info-circle"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_intro_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#collection" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-clipboard-list"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_collection_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#usage" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-tasks"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_usage_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#sharing" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-share-alt"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_sharing_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#security" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-shield-alt"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_security_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#cookies" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-cookie"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_cookies_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#rights" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-user-shield"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_rights_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#children" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-child"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_children_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#changes" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-sync-alt"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_changes_title', $lang); ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#contact" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-envelope"></i></span>
                                        <span class="privacy-toc__text"><?php echo t('privacy_contact_title', $lang); ?></span>
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="privacy-actions">
                                <button class="privacy-print-btn" id="printPrivacy">
                                    <i class="fas fa-print"></i>
                                    <span><?php echo $lang == 'fa' ? 'چاپ سند' : 'Print Document'; ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Privacy Policy Content -->
                    <div class="col-lg-9">
                        <div class="privacy-policy-content">
                            <!-- Introduction Section -->
                            <div class="privacy-block wow fadeInUp" id="introduction">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo $introData['title']; ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $introData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $introData['text_2']; ?></p>
                                    
                                    <div class="privacy-callout">
                                        <div class="privacy-callout__icon">
                                            <i class="fas fa-lightbulb"></i>
                                        </div>
                                        <div class="privacy-callout__content">
                                            <p><?php echo $introData['callout']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Information Collection Section -->
                            <div class="privacy-block wow fadeInUp" id="collection">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo $collectionData['title']; ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $collectionData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $collectionData['text_2']; ?></p>
                                    
                                    <h4 class="privacy-block__subtitle"><?php echo $collectionData['subtitle_1']; ?></h4>
                                    <ul class="privacy-list">
                                        <?php foreach ($collectionData['items_1'] as $item): ?>
                                        <li><?php echo $item['content']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    
                                    <h4 class="privacy-block__subtitle"><?php echo $collectionData['subtitle_2']; ?></h4>
                                    <p class="privacy-block__text"><?php echo $collectionData['text_3']; ?></p>
                                    <ul class="privacy-list">
                                        <?php foreach ($collectionData['items_2'] as $item): ?>
                                        <li><?php echo $item['content']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Information Usage Section -->
                            <div class="privacy-block wow fadeInUp" id="usage">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo $usageData['title']; ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $usageData['text']; ?></p>
                                    <ul class="privacy-list">
                                        <?php foreach ($usageData['items'] as $item): ?>
                                        <li><?php echo $item['content']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Information Sharing Section -->
                            <div class="privacy-block wow fadeInUp" id="sharing">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-share-alt"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo $sharingData['title']; ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $sharingData['text']; ?></p>
                                    <ul class="privacy-list privacy-list--structured">
                                        <?php foreach ($sharingData['items'] as $item): ?>
                                        <li>
                                            <span class="privacy-list__title"><?php echo $item['title']; ?></span>
                                            <span class="privacy-list__text"><?php echo $item['text']; ?></span>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Data Security Section -->
                            <div class="privacy-block wow fadeInUp" id="security">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo t('privacy_security_title', $lang); ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo t('privacy_security_text_1', $lang); ?></p>
                                    <p class="privacy-block__text"><?php echo t('privacy_security_text_2', $lang); ?></p>
                                    
                                    <div class="privacy-measures">
                                        <div class="privacy-measure-item">
                                            <div class="privacy-measure-icon">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                            <div class="privacy-measure-text">
                                                <?php echo t('privacy_security_item_1', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-measure-item">
                                            <div class="privacy-measure-icon">
                                                <i class="fas fa-user-lock"></i>
                                            </div>
                                            <div class="privacy-measure-text">
                                                <?php echo t('privacy_security_item_2', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-measure-item">
                                            <div class="privacy-measure-icon">
                                                <i class="fas fa-database"></i>
                                            </div>
                                            <div class="privacy-measure-text">
                                                <?php echo t('privacy_security_item_3', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-measure-item">
                                            <div class="privacy-measure-icon">
                                                <i class="fas fa-users-cog"></i>
                                            </div>
                                            <div class="privacy-measure-text">
                                                <?php echo t('privacy_security_item_4', $lang); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cookies Section -->
                            <div class="privacy-block wow fadeInUp" id="cookies">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-cookie"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo t('privacy_cookies_title', $lang); ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo t('privacy_cookies_text_1', $lang); ?></p>
                                    <p class="privacy-block__text"><?php echo t('privacy_cookies_text_2', $lang); ?></p>
                                    <p class="privacy-block__text"><?php echo t('privacy_cookies_text_3', $lang); ?></p>
                                    
                                    <div class="privacy-cookies-table">
                                        <div class="privacy-cookies-row privacy-cookies-header">
                                            <div class="privacy-cookies-cell"><?php echo $lang == 'fa' ? 'نوع کوکی' : 'Cookie Type'; ?></div>
                                            <div class="privacy-cookies-cell"><?php echo $lang == 'fa' ? 'توضیحات' : 'Description'; ?></div>
                                        </div>
                                        <div class="privacy-cookies-row">
                                            <div class="privacy-cookies-cell"><strong><?php echo t('privacy_cookies_item_1_title', $lang); ?></strong></div>
                                            <div class="privacy-cookies-cell"><?php echo t('privacy_cookies_item_1_text', $lang); ?></div>
                                        </div>
                                        <div class="privacy-cookies-row">
                                            <div class="privacy-cookies-cell"><strong><?php echo t('privacy_cookies_item_2_title', $lang); ?></strong></div>
                                            <div class="privacy-cookies-cell"><?php echo t('privacy_cookies_item_2_text', $lang); ?></div>
                                        </div>
                                        <div class="privacy-cookies-row">
                                            <div class="privacy-cookies-cell"><strong><?php echo t('privacy_cookies_item_3_title', $lang); ?></strong></div>
                                            <div class="privacy-cookies-cell"><?php echo t('privacy_cookies_item_3_text', $lang); ?></div>
                                        </div>
                                        <div class="privacy-cookies-row">
                                            <div class="privacy-cookies-cell"><strong><?php echo t('privacy_cookies_item_4_title', $lang); ?></strong></div>
                                            <div class="privacy-cookies-cell"><?php echo t('privacy_cookies_item_4_text', $lang); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Rights Section -->
                            <div class="privacy-block wow fadeInUp" id="rights">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo t('privacy_rights_title', $lang); ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo t('privacy_rights_text', $lang); ?></p>
                                    
                                    <div class="privacy-rights-grid">
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo t('privacy_rights_item_1', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo t('privacy_rights_item_2', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo t('privacy_rights_item_3', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas fa-download"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo t('privacy_rights_item_4', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas fa-ban"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo t('privacy_rights_item_5', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo t('privacy_rights_item_6', $lang); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="privacy-block__text"><?php echo t('privacy_rights_contact', $lang); ?></p>
                                </div>
                            </div>

                            <!-- Children's Privacy Section -->
                            <div class="privacy-block wow fadeInUp" id="children">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo t('privacy_children_title', $lang); ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo t('privacy_children_text', $lang); ?></p>
                                    
                                    <div class="privacy-callout privacy-callout--important">
                                        <div class="privacy-callout__icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="privacy-callout__content">
                                            <p><?php echo $lang == 'fa' ? 'ما از مسئولیت خود در قبال حفاظت از اطلاعات کودکان آگاه هستیم و تمام قوانین مربوطه را در این زمینه رعایت می‌کنیم.' : 'We are aware of our responsibility to protect children\'s information and comply with all relevant laws in this regard.'; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Policy Changes Section -->
                            <div class="privacy-block wow fadeInUp" id="changes">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo t('privacy_changes_title', $lang); ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo t('privacy_changes_text_1', $lang); ?></p>
                                    <p class="privacy-block__text"><?php echo t('privacy_changes_text_2', $lang); ?></p>
                                </div>
                            </div>

                            <!-- Contact Section -->
                            <div class="privacy-block wow fadeInUp" id="contact">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h3 class="privacy-block__title"><?php echo t('privacy_contact_title', $lang); ?></h3>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo t('privacy_contact_text', $lang); ?></p>
                                    <div class="contact-info">
                                        <div class="contact-info-row">
                                            <div class="contact-info-label">
                                                <i class="fas fa-envelope"></i>
                                                <span><?php echo t('email', $lang); ?></span>
                                            </div>
                                            <div class="contact-info-value">
                                                <a href="mailto:privacy@salmanschool.ae">privacy@salmanschool.ae</a>
                                            </div>
                                        </div>
                                        <div class="contact-info-row">
                                            <div class="contact-info-label">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span><?php echo t('address', $lang); ?></span>
                                            </div>
                                            <div class="contact-info-value">
                                                <?php echo t('school_address', $lang); ?>
                                            </div>
                                        </div>
                                        <div class="contact-info-row">
                                            <div class="contact-info-label">
                                                <i class="fas fa-phone-alt"></i>
                                                <span><?php echo t('phone', $lang); ?></span>
                                            </div>
                                            <div class="contact-info-value">
                                                <a href="tel:+97142988116" class="<?php echo $isRtl ? 'numbers-ltr' : ''; ?>">
                                                    <?php echo formatPhone('+97142988116', $lang); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Last Updated Section -->
                            <div class="privacy-updated">
                                <p><?php echo t('privacy_last_updated', $lang); ?> 
                                <?php echo $lang == 'fa' ? gregorianToJalali('2024-03-01', true) : 'March 1, 2024'; ?></p>
                            </div>
                            
                            <!-- Back to Top Button -->
                            <a href="#" class="back-to-top" id="backToTop">
                                <i class="fas fa-arrow-up"></i>
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
    
    <!-- Cosmic Background JS -->
    <script src="assets/js/cosmic-bg.js"></script>
    
    <!-- Privacy Policy JS -->
    <script src="assets/js/privacy-policy.js"></script>
</body>
</html>