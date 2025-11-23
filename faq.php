<?php
/**
 * صفحه سوالات متداول (FAQ) با طراحی مدرن
 * 
 * نمایش سوالات متداول با سیستم ترجمه و طراحی مدرن
 * با پشتیبانی از جستجو و سیستم تب‌بندی دسته‌بندی‌ها
 * 
 * @package Salman Educational Complex
 * @version 5.0
 */

// Include configuration file
require_once 'includes/config.php';

// شامل‌سازی توابع مخصوص FAQ
require_once 'includes/faq-functions.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa' || $lang == 'ar');

// دریافت محتوای متنی صفحه از دیتابیس
$pageTitle = getFaqStaticContent('page_title', $lang);
$pageSubtitle = getFaqStaticContent('page_subtitle', $lang);
$searchPlaceholder = getFaqStaticContent('search_placeholder', $lang);
$noResults = getFaqStaticContent('no_results', $lang);
$tryAgain = getFaqStaticContent('try_again', $lang);
$registerSidebarTitle = getFaqStaticContent('register_sidebar_title', $lang);
$registerSidebarText = getFaqStaticContent('register_sidebar_text', $lang);
$registerButton = getFaqStaticContent('register_button', $lang);
$moreQuestionsTitle = getFaqStaticContent('more_questions', $lang);
$contactUsText = getFaqStaticContent('contact_us_text', $lang);

// دریافت دسته‌بندی‌ها و سوالات
$faqCategories = getFaqCategories($lang);
$faqCategories = getFaqItems($faqCategories, $lang);

// Original faq.php continues below this line...
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
    <!-- Vendor CSS -->
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
                            line-height: 1.1;" > <?php echo $pageTitle; ?>
                            </h1>
                    <p class="header-subtitle">
                      <?php echo $pageSubtitle; ?>
                    </p>

                     <!-- Search Bar -->
                    <div class="faq-search wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" id="faqSearch" class="faq-search__input" placeholder="<?php echo $searchPlaceholder; ?>">
                        <button class="faq-search__btn" aria-label="<?php echo $lang == 'fa' ? 'جستجو' : 'Search'; ?>">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
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

        <!-- Main FAQ Content -->
        <section class="faq-content">
            <div class="container">
                <div class="row">
                    <!-- FAQ Sidebar (Left Column) -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="faq-sidebar wow fadeInLeft" data-wow-delay="400ms">
                            <!-- Decorative shapes -->
                            <div class="faq-sidebar__shape"></div>
                            <div class="faq-sidebar__shape"></div>
                            
                            <h2 class="faq-sidebar__title">
                                <?php echo $registerSidebarTitle; ?>
                            </h2>
                            <p class="faq-sidebar__text">
                                <?php echo $registerSidebarText; ?>
                            </p>
                            <a href="Terms and Conditions for Registration.php<?php echo '?lang=' . $lang; ?>" class="faq-sidebar__btn">
                                <i class="fas fa-file-alt"></i>
                                <?php echo $registerButton; ?>
                            </a>
                            
                            <!-- Divider -->
                            <div class="faq-sidebar__divider"></div>
                            
                            <!-- Still Have Questions Section -->
                            <h3 class="faq-sidebar__title" style="font-size: 22px;">
                                <?php echo $moreQuestionsTitle; ?>
                            </h3>
                            <p class="faq-sidebar__text">
                                <?php echo $contactUsText; ?>
                            </p>
                            <a href="contact.php<?php echo '?lang=' . $lang; ?>" class="faq-sidebar__btn">
                                <i class="fas fa-envelope"></i>
                                <?php echo t('contact_us', $lang); ?>
                            </a>
                        </div>
                    </div>
                    
                    <!-- FAQ Content (Right Column) -->
                    <div class="col-lg-8">
                        <div class="faq-main wow fadeInRight" data-wow-delay="400ms">
                            <!-- Tab Navigation -->
                            <div class="faq-nav">
                                <?php $firstCategory = true; foreach ($faqCategories as $categoryId => $category): ?>
                                <button class="faq-nav__item <?php echo $firstCategory ? 'active' : ''; ?>" data-category="<?php echo $categoryId; ?>">
                                    <span class="faq-nav__icon">
                                        <i class="fas <?php echo $category['icon']; ?>"></i>
                                    </span>
                                    <span><?php echo $category['title']; ?></span>
                                </button>
                                <?php $firstCategory = false; endforeach; ?>
                            </div>
                            
                            <!-- FAQ Categories -->
                            <?php $firstCategory = true; foreach ($faqCategories as $categoryId => $category): ?>
                            <div id="<?php echo $categoryId; ?>" class="faq-category <?php echo $firstCategory ? 'active' : ''; ?>">
                                <div class="faq-category__header">
                                    <div class="faq-category__icon" style="background-color: <?php echo $category['color']; ?>">
                                        <i class="fas <?php echo $category['icon']; ?>"></i>
                                    </div>
                                    <h2 class="faq-category__title"><?php echo $category['title']; ?></h2>
                                </div>
                                
                                <div class="faq-items">
                                    <?php $firstItem = true; foreach ($category['questions'] as $item): ?>
                                    <div class="faq-item <?php echo $firstItem ? 'active' : ''; ?>">
                                        <button class="faq-question">
                                            <?php echo $item['question']; ?>
                                            <span class="faq-icon">
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                        </button>
                                        <div class="faq-answer">
                                            <p><?php echo $item['answer']; ?></p>
                                        </div>
                                    </div>
                                    <?php $firstItem = false; endforeach; ?>
                                </div>
                            </div>
                            <?php $firstCategory = false; endforeach; ?>
                            
                            <!-- No Results Message (initially hidden) -->
                            <div id="noResults" class="no-results">
                                <div class="no-results__icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h3 class="no-results__title">
                                    <?php echo $noResults; ?>
                                </h3>
                                <p class="no-results__text">
                                    <?php echo $tryAgain; ?>
                                </p>
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
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- FAQ Specific Scripts -->
    <script src="assets/js/faq.js"></script>
</body>
</html>