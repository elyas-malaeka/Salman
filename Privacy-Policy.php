<?php
/**
 * صفحه سیاست حریم خصوصی - مجتمع آموزشی سلمان فارسی
 * 
 * این فایل شامل اطلاعات سیاست حریم خصوصی مجتمع آموزشی سلمان فارسی است
 * شامل نحوه جمع‌آوری، استفاده، اشتراک‌گذاری و حفاظت از داده‌های شخصی
 * 
 * @package Salman Educational Complex
 * @version 4.0
 */

// شامل‌سازی فایل‌های پیکربندی و توابع
require_once 'includes/config.php';
require_once 'includes/privacy_functions.php';

// دریافت زبان فعلی
$lang = getCurrentLanguage();
$isRtl = in_array($lang, explode(',', getSiteConfig('rtl_languages')));

// دریافت اطلاعات سربرگ
$pageTitle = getPrivacyContent('page_title', $lang, $lang == 'fa' ? 'سیاست حریم خصوصی' : ($lang == 'en' ? 'Privacy Policy' : 'سياسة الخصوصية'));
$pageSubtitle = getPrivacyContent('page_subtitle', $lang);

// دریافت نام سایت بر اساس زبان
$siteName = getSiteConfig("site_name" . ($lang != 'fa' ? "_$lang" : ""));

// دریافت داده‌های تمام بخش‌ها
$introData = getIntroductionData($lang);
$collectionData = getCollectionData($lang);
$usageData = getUsageData($lang);
$sharingData = getSharingData($lang);
$securityData = getSecurityData($lang);
$cookiesData = getCookiesData($lang);
$rightsData = getRightsData($lang);
$childrenData = getChildrenData($lang);
$changesData = getChangesData($lang);
$contactData = getContactData($lang);
$faqData = getFaqData($lang);
$quickContactData = getQuickContactData($lang);

// دریافت تاریخ آخرین به‌روزرسانی با فرمت مناسب
$lastUpdateDate = getPrivacyLastUpdateDate();
if ($lang == 'fa') {
    $lastUpdateDate = gregorianToJalali($lastUpdateDate, true);
} else if ($lang == 'en') {
    $lastUpdateDate = date('F j, Y', strtotime($lastUpdateDate));
} else if ($lang == 'ar') {
    $lastUpdateDate = date('Y-m-d', strtotime($lastUpdateDate));
}

// URL صفحه تماس با ما
$contactPageUrl = 'contact.php?lang=' . $lang;
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo htmlspecialchars($pageSubtitle); ?>" />

    <meta name="robots" content="index, follow">
    <meta name="author" content="<?php echo $siteName; ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageTitle); ?>, <?php echo getSiteConfig("site_name" . ($lang != 'fa' ? "_$lang" : "")); ?>">
    
    
    <title><?php echo htmlspecialchars(strip_tags($pageTitle)); ?> | <?php echo $siteName; ?></title>
    <!-- Open Graph Tags for Social Media -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars($pageSubtitle); ?>" />
    <meta property="og:image" content="<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/logo-social.png"; ?>" />
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?php echo $siteName; ?>" />
    
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageSubtitle); ?>">
    <meta name="twitter:image" content="<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/logo-social.png"; ?>">
    
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "<?php echo htmlspecialchars($pageTitle); ?>",
      "description": "<?php echo htmlspecialchars($pageSubtitle); ?>",
      "dateModified": "<?php echo date('c', strtotime($lastUpdateDate)); ?>",
      "publisher": {
        "@type": "Organization",
        "name": "<?php echo $siteName; ?>",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/logo-dark.png"; ?>"
        }
      },
      "mainEntity": {
        "@type": "Article",
        "name": "<?php echo htmlspecialchars($pageTitle); ?>",
        "datePublished": "<?php echo date('c', strtotime($lastUpdateDate)); ?>",
        "dateModified": "<?php echo date('c', strtotime($lastUpdateDate)); ?>"
      }
    }
    </script>
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
        <?php include_once 'includes/menu.php'; ?>

        <header class="cosmic-header">
            <!-- پس‌زمینه کیهانی -->
            <div class="cosmic-bg">
                <!-- ستاره‌های متحرک -->
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
                <div class="cosmic-star"></div>
            </div>

            <!-- سیارات کیهانی -->
            <div class="cosmic-planet"></div>
            <div class="cosmic-planet"></div>
            <div class="cosmic-planet"></div>
            <div class="cosmic-planet"></div>

            <!-- دنباله‌دار -->
            <div class="comet"></div>

            <!-- اورلی کنتراست -->
            <div class="content-overlay"></div>

            <!-- محتوای اصلی -->
            <div class="header-content">
                                        
                    </h1>
                    <p class="header-subtitle">
                       
                <h1 class="header-title"><?php echo $pageTitle; ?></h1>
                <p class="header-subtitle"> <?php echo $pageSubtitle; ?></p>
            </div>
        </header>

        <!-- Privacy Policy Main Section -->
        <section class="privacy-policy-section">
            <div class="container">
                <div class="row">
                    <!-- Table of Contents Sidebar -->
                    <div class="col-lg-3">
                        <div class="privacy-toc" id="privacyToc">
                            <div class="privacy-toc__header">
                                <h3 class="privacy-toc__title"><?php echo $lang == 'fa' ? 'فهرست مطالب' : ($lang == 'en' ? 'Table of Contents' : 'جدول المحتويات'); ?></h3>
                            </div>
                            <ul class="privacy-toc__list">
                                <li class="privacy-toc__item">
                                    <a href="#introduction" class="privacy-toc__link active">
                                        <span class="privacy-toc__icon"><i class="fas fa-info-circle"></i></span>
                                        <span class="privacy-toc__text"><?php echo $introData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#collection" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-clipboard-list"></i></span>
                                        <span class="privacy-toc__text"><?php echo $collectionData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#usage" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-tasks"></i></span>
                                        <span class="privacy-toc__text"><?php echo $usageData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#sharing" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-share-alt"></i></span>
                                        <span class="privacy-toc__text"><?php echo $sharingData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#security" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-shield-alt"></i></span>
                                        <span class="privacy-toc__text"><?php echo $securityData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#cookies" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-cookie"></i></span>
                                        <span class="privacy-toc__text"><?php echo $cookiesData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#rights" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-user-shield"></i></span>
                                        <span class="privacy-toc__text"><?php echo $rightsData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#children" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-child"></i></span>
                                        <span class="privacy-toc__text"><?php echo $childrenData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#faq" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-question-circle"></i></span>
                                        <span class="privacy-toc__text"><?php echo $faqData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#changes" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-sync-alt"></i></span>
                                        <span class="privacy-toc__text"><?php echo $changesData['title']; ?></span>
                                    </a>
                                </li>
                                <li class="privacy-toc__item">
                                    <a href="#contact" class="privacy-toc__link">
                                        <span class="privacy-toc__icon"><i class="fas fa-envelope"></i></span>
                                        <span class="privacy-toc__text"><?php echo $contactData['title']; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Privacy Policy Content -->
                    <div class="col-lg-9">
                        <div class="privacy-policy-content">
                            <!-- Introduction Section -->
                            <div class="privacy-block" id="introduction">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $introData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $introData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $introData['text_2']; ?></p>
                                    
                                    <div class="privacy-callout">
                                        <div class="privacy-callout__icon">
                                            <i class="fas fa-lightbulb" aria-hidden="true"></i>
                                        </div>
                                        <div class="privacy-callout__content">
                                            <p><?php echo $introData['callout']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Information Collection Section -->
                            <div class="privacy-block" id="collection">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $collectionData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $collectionData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $collectionData['text_2']; ?></p>
                                    
                                    <h3 class="privacy-block__subtitle"><?php echo $collectionData['subtitle_1']; ?></h3>
                                    <ul class="privacy-list">
                                        <?php foreach ($collectionData['student_items'] as $item): ?>
                                        <li><?php echo $item['content']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    
                                    <h3 class="privacy-block__subtitle"><?php echo $collectionData['subtitle_2']; ?></h3>
                                    <p class="privacy-block__text"><?php echo $collectionData['text_3']; ?></p>
                                    <ul class="privacy-list">
                                        <?php foreach ($collectionData['online_items'] as $item): ?>
                                        <li><?php echo $item['content']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Information Usage Section -->
                            <div class="privacy-block" id="usage">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-tasks" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $usageData['title']; ?></h2>
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
                            <div class="privacy-block" id="sharing">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-share-alt" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $sharingData['title']; ?></h2>
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
                            <div class="privacy-block" id="security">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $securityData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $securityData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $securityData['text_2']; ?></p>
                                    
                                    <div class="privacy-measures">
                                        <?php foreach ($securityData['items'] as $index => $item): ?>
                                        <div class="privacy-measure-item">
                                            <div class="privacy-measure-icon">
                                                <i class="fas <?php echo getSecurityIcon($index); ?>" aria-hidden="true"></i>
                                            </div>
                                            <div class="privacy-measure-text">
                                                <?php echo $item['content']; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Cookies Section -->
                            <div class="privacy-block" id="cookies">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-cookie" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $cookiesData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $cookiesData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $cookiesData['text_2']; ?></p>
                                    <p class="privacy-block__text"><?php echo $cookiesData['text_3']; ?></p>
                                    
                                    <div class="privacy-cookies-table">
                                        <div class="privacy-cookies-row privacy-cookies-header">
                                            <div class="privacy-cookies-cell"><?php echo $lang == 'fa' ? 'نوع کوکی' : ($lang == 'en' ? 'Cookie Type' : 'نوع ملف تعريف الارتباط'); ?></div>
                                            <div class="privacy-cookies-cell"><?php echo $lang == 'fa' ? 'توضیحات' : ($lang == 'en' ? 'Description' : 'وصف'); ?></div>
                                        </div>
                                        <?php foreach ($cookiesData['items'] as $item): ?>
                                        <div class="privacy-cookies-row">
                                            <div class="privacy-cookies-cell"><strong><?php echo $item['title']; ?></strong></div>
                                            <div class="privacy-cookies-cell"><?php echo $item['text']; ?></div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <!-- Cookie Settings Section -->
                                    <div class="privacy-cookie-settings">
                                        <h3 class="privacy-block__subtitle"><?php echo $cookiesData['settings']['title']; ?></h3>
                                        <p class="privacy-block__text"><?php echo $cookiesData['settings']['description']; ?></p>
                                        
                                        <div class="cookie-settings-controls">
                                            <div class="cookie-setting-item">
                                                <label class="switch">
                                                    <input type="checkbox" id="essential-cookies" checked disabled>
                                                    <span class="slider round"></span>
                                                </label>
                                                <div class="cookie-setting-info">
                                                    <span class="cookie-setting-name"><?php echo $cookiesData['settings']['essential_title']; ?></span>
                                                    <span class="cookie-setting-desc"><?php echo $cookiesData['settings']['essential_description']; ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="cookie-setting-item">
                                                <label class="switch">
                                                    <input type="checkbox" id="preference-cookies" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                                <div class="cookie-setting-info">
                                                    <span class="cookie-setting-name"><?php echo $cookiesData['settings']['preference_title']; ?></span>
                                                    <span class="cookie-setting-desc"><?php echo $cookiesData['settings']['preference_description']; ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="cookie-setting-item">
                                                <label class="switch">
                                                    <input type="checkbox" id="analytics-cookies" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                                <div class="cookie-setting-info">
                                                    <span class="cookie-setting-name"><?php echo $cookiesData['settings']['analytics_title']; ?></span>
                                                    <span class="cookie-setting-desc"><?php echo $cookiesData['settings']['analytics_description']; ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="cookie-settings-buttons">
                                                <button type="button" id="save-cookie-settings" class="cookie-settings-btn save-btn">
                                                    <?php echo $cookiesData['settings']['save']; ?>
                                                </button>
                                                <button type="button" id="reject-all-cookies" class="cookie-settings-btn reject-btn">
                                                    <?php echo $cookiesData['settings']['reject']; ?>
                                                </button>
                                                <button type="button" id="accept-all-cookies" class="cookie-settings-btn accept-btn">
                                                    <?php echo $cookiesData['settings']['accept']; ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Rights Section -->
                            <div class="privacy-block" id="rights">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-user-shield" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $rightsData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $rightsData['text']; ?></p>
                                    
                                    <div class="privacy-rights-grid">
                                        <?php foreach ($rightsData['items'] as $index => $item): ?>
                                        <div class="privacy-right-item">
                                            <div class="privacy-right-icon">
                                                <i class="fas <?php echo getRightsIcon($index); ?>" aria-hidden="true"></i>
                                            </div>
                                            <div class="privacy-right-text">
                                                <?php echo $item['content']; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <p class="privacy-block__text"><?php echo $rightsData['contact']; ?></p>
                                </div>
                            </div>

                            <!-- Children's Privacy Section -->
                            <div class="privacy-block" id="children">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-child" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $childrenData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $childrenData['text']; ?></p>
                                    
                                    <div class="privacy-callout privacy-callout--important">
                                        <div class="privacy-callout__icon">
                                            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                                        </div>
                                        <div class="privacy-callout__content">
                                            <p><?php echo $childrenData['callout']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FAQ Section -->
                            <div class="privacy-block" id="faq">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-question-circle" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $faqData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $faqData['description']; ?></p>
                                    
                                    <div class="privacy-faq">
                                        <?php 
                                        // اطمینان از وجود آیتم‌های سوال و جواب
                                        if (!empty($faqData['items'])) {
                                            foreach ($faqData['items'] as $index => $item): 
                                        ?>
                                        <div class="privacy-faq-item">
                                            <div class="privacy-faq-question">
                                                <div class="d-flex align-items-center w-100">
                                                    <span class="faq-icon"><i class="fas fa-plus"></i></span>
                                                    <span class="faq-text flex-grow-1"><?php echo $item['question']; ?></span>
                                                </div>
                                            </div>
                                            <div class="privacy-faq-answer">
                                                <p><?php echo $item['answer']; ?></p>
                                            </div>
                                        </div>
                                        <?php 
                                            endforeach;
                                        } else {
                                            echo '<p class="text-center">'. ($lang == 'fa' ? 'در حال حاضر سوالی موجود نیست.' : ($lang == 'en' ? 'No questions available at the moment.' : 'لا توجد أسئلة متاحة في الوقت الحالي.')) .'</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Policy Changes Section -->
                            <div class="privacy-block" id="changes">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-sync-alt" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $changesData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $changesData['text_1']; ?></p>
                                    <p class="privacy-block__text"><?php echo $changesData['text_2']; ?></p>
                                </div>
                            </div>

                            <!-- Contact Section -->
                            <div class="privacy-block" id="contact">
                                <div class="privacy-block__header">
                                    <div class="privacy-block__icon">
                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                    </div>
                                    <h2 class="privacy-block__title"><?php echo $contactData['title']; ?></h2>
                                </div>
                                <div class="privacy-block__content">
                                    <p class="privacy-block__text"><?php echo $contactData['text']; ?></p>
                                    <div class="contact-info">
                                        <div class="contact-info-row">
                                            <div class="contact-info-label">
                                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                                <span><?php echo $contactData['labels']['email']; ?></span>
                                            </div>
                                            <div class="contact-info-value">
                                                <a href="mailto:<?php echo $contactData['email']; ?>"><?php echo $contactData['email']; ?></a>
                                            </div>
                                        </div>
                                        <div class="contact-info-row">
                                            <div class="contact-info-label">
                                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                                <span><?php echo $contactData['labels']['address']; ?></span>
                                            </div>
                                            <div class="contact-info-value">
                                                <?php echo $contactData['site_contact']['address']; ?>
                                            </div>
                                        </div>
                                        <div class="contact-info-row">
                                            <div class="contact-info-label">
                                                <i class="fas fa-phone-alt" aria-hidden="true"></i>
                                                <span><?php echo $contactData['labels']['phone']; ?></span>
                                            </div>
                                            <div class="contact-info-value">
                                                <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $contactData['site_contact']['phone']); ?>" class="<?php echo $isRtl ? 'numbers-ltr' : ''; ?>">
                                                    <?php echo $contactData['site_contact']['phone']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quick Contact Box -->
                                    <div class="privacy-quick-contact">
                                        <div class="privacy-quick-contact__header">
                                            <h3><?php echo $quickContactData['title']; ?></h3>
                                        </div>
                                        <div class="privacy-quick-contact__content">
                                            <p><?php echo $quickContactData['description']; ?></p>
                                            <a href="<?php echo $contactPageUrl; ?>" class="privacy-contact-btn">
                                                <i class="fas fa-envelope"></i>
                                                <span><?php echo $quickContactData['button']; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Last Updated Section -->
                            <div class="privacy-updated">
                                <p><?php echo $contactData['last_updated']; ?> <?php echo $lastUpdateDate; ?></p>
                            </div>
                            
                            <!-- Back to Top Button -->
                            <a href="#" class="back-to-top" id="backToTop" aria-label="<?php echo $lang == 'fa' ? 'بازگشت به بالا' : ($lang == 'en' ? 'Back to top' : 'العودة إلى الأعلى'); ?>">
                                <i class="fas fa-arrow-up" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Script></Script>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div><!-- /.page-wrapper -->

    <!-- Toast Notification (for cookie settings) -->
    <div class="privacy-toast" id="privacy-toast"></div>

    <!-- Custom JavaScript for Privacy Policy Page -->
    <script src="assets/js/privacy-policy.js"></script>
    
    <!-- Backup JavaScript for core functionality -->
    <script>
    // این اسکریپت به عنوان پشتیبان در صورت عدم بارگذاری فایل اصلی عمل می‌کند
    jQuery(document).ready(function($) {
        console.log('Backup script initialized for privacy page');
        
        // پشتیبان برای FAQ
        if (typeof window.initFAQAccordion !== 'function') {
            console.log('Using backup FAQ script');
            
            // مخفی کردن تمام پاسخ‌ها در ابتدا
            $('.privacy-faq-answer').hide();
            
            // رویداد کلیک روی سوالات
            $('.privacy-faq-question').on('click', function() {
                console.log('FAQ question clicked (backup)');
                
                var $question = $(this);
                var $answer = $question.next('.privacy-faq-answer');
                var isActive = $question.hasClass('active');
                
                // بستن تمام سوالات باز
                $('.privacy-faq-question').removeClass('active');
                $('.privacy-faq-answer').slideUp(300);
                
                // اگر قبلاً باز نبوده، باز شود
                if (!isActive) {
                    $question.addClass('active');
                    $answer.slideDown(300);
                    console.log('Opening FAQ answer');
                }
            });
        }
        
        // پشتیبان برای تنظیمات کوکی
        if (typeof window.initCookieSettings !== 'function') {
            console.log('Using backup cookie settings script');
            
            // ذخیره تنظیمات کوکی
            $('#save-cookie-settings, #reject-all-cookies, #accept-all-cookies').on('click', function() {
                var action = $(this).attr('id');
                var message = '';
                
                if (action === 'reject-all-cookies') {
                    $('#preference-cookies, #analytics-cookies').prop('checked', false);
                    message = '<?php echo $lang == 'fa' ? 'کوکی‌های غیرضروری رد شدند' : ($lang == 'en' ? 'Non-essential cookies rejected' : 'تم رفض ملفات تعريف الارتباط غير الأساسية'); ?>';
                } else if (action === 'accept-all-cookies') {
                    $('#preference-cookies, #analytics-cookies').prop('checked', true);
                    message = '<?php echo $lang == 'fa' ? 'همه کوکی‌ها پذیرفته شدند' : ($lang == 'en' ? 'All cookies accepted' : 'تم قبول جميع ملفات تعريف الارتباط'); ?>';
                } else {
                    message = '<?php echo $lang == 'fa' ? 'تنظیمات با موفقیت ذخیره شد' : ($lang == 'en' ? 'Settings saved successfully' : 'تم حفظ الإعدادات بنجاح'); ?>';
                }
                
                // ذخیره تنظیمات در localStorage
                try {
                    var preferences = {
                        essential: true,
                        preference: $('#preference-cookies').is(':checked'),
                        analytics: $('#analytics-cookies').is(':checked')
                    };
                    
                    localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
                    console.log('Cookie preferences saved:', preferences);
                } catch (e) {
                    console.error('Error saving cookie preferences:', e);
                }
                
                // نمایش پیام
                var $toast = $('.privacy-toast');
                $toast.text(message).addClass('show');
                
                setTimeout(function() {
                    $toast.removeClass('show');
                }, 3000);
            });
            
            // بارگیری تنظیمات ذخیره شده
            try {
                var storedPrefs = localStorage.getItem('cookiePreferences');
                if (storedPrefs) {
                    var preferences = JSON.parse(storedPrefs);
                    $('#preference-cookies').prop('checked', preferences.preference || false);
                    $('#analytics-cookies').prop('checked', preferences.analytics || false);
                }
            } catch (e) {
                console.error('Error loading cookie preferences:', e);
            }
        }
        
        // پشتیبان برای ستاره‌های کیهانی
        if ($('.cosmic-star').length === 0) {
            console.log('Creating cosmic stars (backup)');
            
            var $cosmicBg = $('.cosmic-bg');
            
            // افزودن ستاره‌های تصادفی
            for (var i = 0; i < 100; i++) {
                var size = Math.random() * 3 + 1;
                var opacity = Math.random() * 0.8 + 0.2;
                var posX = Math.random() * 100;
                var posY = Math.random() * 100;
                var duration = Math.random() * 4 + 3;
                
                var $star = $('<div class="cosmic-star"></div>').css({
                    width: size + 'px',
                    height: size + 'px',
                    opacity: opacity,
                    top: posY + '%',
                    left: posX + '%',
                    'animation-duration': duration + 's'
                });
                
                $cosmicBg.append($star);
            }
        }
        
        // پشتیبان برای دکمه بازگشت به بالا
        $('.back-to-top').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 800);
        });
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').addClass('visible');
            } else {
                $('.back-to-top').removeClass('visible');
            }
        });
        
        // پشتیبان برای جداول پاسخگو
        if ($(window).width() < 768) {
            $('.privacy-cookies-table').each(function() {
                if (!$(this).hasClass('responsive-table')) {
                    $(this).addClass('responsive-table');
                    
                    var headerCells = $(this).find('.privacy-cookies-header .privacy-cookies-cell');
                    var headerTexts = [];
                    
                    headerCells.each(function() {
                        headerTexts.push($(this).text());
                    });
                    
                    $(this).find('.privacy-cookies-row:not(.privacy-cookies-header)').each(function() {
                        $(this).find('.privacy-cookies-cell').each(function(index) {
                            if (headerTexts[index]) {
                                $(this).attr('data-title', headerTexts[index]);
                            }
                        });
                    });
                }
            });
        }
        
        // فراخوانی رویداد اسکرول برای تنظیم وضعیت اولیه
        $(window).trigger('scroll');
    });
    </script>
</body>
</html>