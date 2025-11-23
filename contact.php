<?php
/**
 * Contact Us Page - Premium Edition
 * 
 * Extraordinary, high-end contact page for Salman Educational Complex
 * with bilingual support, advanced interactive features, and complete SEO optimization.
 * 
 * @package Salman Educational Complex
 * @version 3.3
 */

// Load configuration
require_once 'includes/config.php';
require_once 'includes/contact_helper.php';

// Database connection
$db = connectDB();

// Get all active languages
$query = "SELECT * FROM core_languages WHERE is_active = 1 ORDER BY is_default DESC";
$languages_result = $db->query($query);
$available_languages = [];

if ($languages_result && $languages_result->num_rows > 0) {
    while ($lang = $languages_result->fetch_assoc()) {
        $available_languages[$lang['code']] = $lang;
        if ($lang['is_default'] == 1) {
            $default_language = $lang['code'];
        }
    }
} else {
    // Fallback if no languages in database
    $available_languages = [
        'fa' => ['language_id' => 1, 'code' => 'fa', 'name' => 'Persian', 'native_name' => 'فارسی', 'is_rtl' => 1, 'is_default' => 1],
        'en' => ['language_id' => 2, 'code' => 'en', 'name' => 'English', 'native_name' => 'English', 'is_rtl' => 0, 'is_default' => 0],
        'ar' => ['language_id' => 3, 'code' => 'ar', 'name' => 'Arabic', 'native_name' => 'العربية', 'is_rtl' => 1, 'is_default' => 0]
    ];
    $default_language = 'fa';
}

// Set language based on URL parameter or session
$lang = isset($_GET['lang']) && array_key_exists($_GET['lang'], $available_languages) ? 
        $_GET['lang'] : 
        (isset($_SESSION['lang']) && array_key_exists($_SESSION['lang'], $available_languages) ? 
            $_SESSION['lang'] : $default_language);

// Update session with current language
$_SESSION['lang'] = $lang;

// Get language settings
$current_lang = $available_languages[$lang];
$language_id = $current_lang['language_id'];
$isRtl = (bool)$current_lang['is_rtl'];

/**
 * Get configuration value from core_config table
 * 
 * @param string $key Configuration key to retrieve
 * @param string $default Default value if not found
 * @param string $lang Language code (fa, en, ar) 
 * @return string Configuration value or default if not found
 */
function getConfig($key, $default = '', $lang = null) {
    global $db, $current_lang;
    
    // If language is not specified, use current language from session
    if ($lang === null) {
        $lang = isset($current_lang['code']) ? $current_lang['code'] : 'fa';
    }
    
    // If language is not default (fa), append language code to key
    $config_key = ($lang != 'fa') ? $key . '_' . $lang : $key;
    
    // Build and execute query
    $query = "SELECT config_value FROM core_config WHERE config_key = ? LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $config_key);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Return result if found
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['config_value'];
    }
    
    // If language-specific configuration not found and language is not fa,
    // try to get the default (fa) configuration
    if ($lang != 'fa') {
        $stmt = $db->prepare("SELECT config_value FROM core_config WHERE config_key = ? LIMIT 1");
        $stmt->bind_param('s', $key);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['config_value'];
        }
    }
    
    // Return default value if no configuration found
    return $default;
}

// Get contact information from core_config table
$address = getConfig('contact_address', '', $lang);
$phone = getConfig('contact_phone', '+97142988116', $lang);
$email = getConfig('contact_email', 'info@ir-salmanfarsi.com', $lang);
$support_email = getConfig('support_email', 'support@ir-salmanfarsi.com', $lang);

// Get site information
$site_name = getConfig('site_name', 'مجتمع آموزشی سلمان فارسی', $lang);
$site_description = getConfig('site_description', '', $lang);

// Get SEO data
$seo_title = getConfig('meta_title', '', $lang) ?: 
    ($isRtl ? 'تماس با ما | ' . $site_name : 'Contact Us | ' . $site_name);
    
$seo_description = getConfig('meta_description', '', $lang) ?: 
    ($isRtl ? 'تماس با ' . $site_name . '. آدرس، شماره تلفن، ایمیل و ساعات کاری ما را مشاهده کنید.' : 
    'Contact ' . $site_name . '. View our address, phone number, email and working hours.');
    
$seo_keywords = getConfig('meta_keywords', '', $lang);

// Get social media links
$social_profiles = [
    'instagram' => getConfig('social_instagram', 'https://www.instagram.com/ir.salmanfarsi/'),
    'telegram' => getConfig('social_telegram', 'https://t.me/salmanfarsi_ae'),
    'whatsapp' => getConfig('social_whatsapp', 'https://wa.me/97142988116'),
    'youtube' => getConfig('social_youtube', 'https://www.youtube.com/@salmanfarsiiranianschool73/videos'),
    'linkedin' => getConfig('social_linkedin', '')
];

// Build canonical and alternate URLs for hreflang
$canonical_base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";
$canonical_url = $canonical_base . strtok($_SERVER['REQUEST_URI'], '?');
$alternate_urls = [];
foreach ($available_languages as $alt_lang => $lang_data) {
    $alternate_urls[$alt_lang] = $canonical_url . '?lang=' . $alt_lang;
}

// Set Open Graph data
$og_type = 'website';
$og_image = 'assets/images/og-images/contact-' . $lang . '.jpg'; // Language-specific OG images
$og_site_name = $site_name;

// Location data for Schema.org
$location_data = [
    'name' => $site_name,
    'address' => $address,
    'telephone' => $phone,
    'email' => $email,
    'geo' => [
        'latitude' => '25.280527',
        'longitude' => '55.370178'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    
    <!-- Primary Meta Tags -->
    <title><?php echo $seo_title; ?></title>
    <meta name="title" content="<?php echo $seo_title; ?>">
    <meta name="description" content="<?php echo $seo_description; ?>">
    <meta name="keywords" content="<?php echo $seo_keywords; ?>">
    <meta name="author" content="<?php echo $isRtl ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex'; ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="<?php echo $lang; ?>">
    
    <!-- Canonical and Alternate Language Links -->
    <link rel="canonical" href="<?php echo $canonical_url . ($lang != $default_language ? '?lang='.$lang : ''); ?>">
    <?php foreach ($alternate_urls as $alt_lang => $alt_url): ?>
    <link rel="alternate" hreflang="<?php echo $alt_lang; ?>" href="<?php echo $alt_url; ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?php echo $alternate_urls[$default_language]; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo $og_type; ?>">
    <meta property="og:url" content="<?php echo $alternate_urls[$lang]; ?>">
    <meta property="og:title" content="<?php echo $seo_title; ?>">
    <meta property="og:description" content="<?php echo $seo_description; ?>">
    <meta property="og:image" content="<?php echo $canonical_base; ?>/<?php echo $og_image; ?>">
    <meta property="og:site_name" content="<?php echo $og_site_name; ?>">
    <meta property="og:locale" content="<?php echo $lang; ?>">
    <?php foreach ($available_languages as $alt_lang => $alt_data): if ($alt_lang != $lang): ?>
    <meta property="og:locale:alternate" content="<?php echo $alt_lang; ?>">
    <?php endif; endforeach; ?>
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo $alternate_urls[$lang]; ?>">
    <meta name="twitter:title" content="<?php echo $seo_title; ?>">
    <meta name="twitter:description" content="<?php echo $seo_description; ?>">
    <meta name="twitter:image" content="<?php echo $canonical_base; ?>/<?php echo $og_image; ?>">
    
    <!-- Mobile Specific -->
    <meta name="theme-color" content="#6C63FF">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- vendor styles -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    
    
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/pages.css.php'; ?>
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EducationalOrganization",
      "name": "<?php echo $location_data['name']; ?>",
      "alternateName": "<?php echo $isRtl ? 'Salman Farsi Educational Complex' : 'مجتمع آموزشی سلمان فارسی'; ?>",
      "url": "<?php echo $canonical_url; ?>",
      "logo": "<?php echo $canonical_base; ?>/assets/images/logo.png",
      "sameAs": [
        "<?php echo $social_profiles['instagram']; ?>",
        "<?php echo $social_profiles['youtube']; ?>",
        "<?php echo $social_profiles['whatsapp']; ?>"
      ],
      "description": "<?php echo $seo_description; ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo $location_data['address']; ?>",
        "addressLocality": "Dubai",
        "addressRegion": "Dubai",
        "addressCountry": "AE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "<?php echo $location_data['geo']['latitude']; ?>",
        "longitude": "<?php echo $location_data['geo']['longitude']; ?>"
      },
      "telephone": "<?php echo $location_data['telephone']; ?>",
      "email": "<?php echo $location_data['email']; ?>",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?php echo $location_data['telephone']; ?>",
        "contactType": "customer service",
        "availableLanguage": ["Persian", "English", "Arabic"]
      }
    }
    </script>
    
    <!-- BreadcrumbList Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "<?php echo $isRtl ? 'صفحه اصلی' : 'Home'; ?>",
          "item": "<?php echo $canonical_base; ?>/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "<?php echo $isRtl ? 'تماس با ما' : 'Contact Us'; ?>",
          "item": "<?php echo $canonical_url; ?>"
        }
      ]
    }
    </script>
    
    <!-- LocalBusiness Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "<?php echo $location_data['name']; ?>",
      "image": "<?php echo $canonical_base; ?>/assets/images/logo.png",
      "@id": "<?php echo $canonical_url; ?>#localbusiness",
      "url": "<?php echo $canonical_url; ?>",
      "telephone": "<?php echo $location_data['telephone']; ?>",
      "email": "<?php echo $location_data['email']; ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo $location_data['address']; ?>",
        "addressLocality": "Dubai",
        "addressRegion": "Dubai",
        "addressCountry": "AE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "<?php echo $location_data['geo']['latitude']; ?>",
        "longitude": "<?php echo $location_data['geo']['longitude']; ?>"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday"],
          "opens": "07:00",
          "closes": "14:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Friday",
          "opens": "07:00",
          "closes": "12:00"
        }
      ],
      "sameAs": [
        "<?php echo $social_profiles['instagram']; ?>",
        "<?php echo $social_profiles['youtube']; ?>",
        "<?php echo $social_profiles['whatsapp']; ?>"
      ]
    }
    </script>
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
                            line-height: 1.1;" ><?php echo getDbContent('page_title', 'header'); ?>
                            </h1>
                    <p class="header-subtitle">
                    <?php echo getDbContent('page_subtitle', 'header'); ?>
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

        <!-- Enhanced Contact Information Cards Section -->
        <section class="contact-section">
            <div class="contact-shapes">
                <div class="contact-shape contact-shape-1"></div>
                <div class="contact-shape contact-shape-2"></div>
                <div class="contact-shape contact-shape-3"></div>
            </div>
            
            <div class="container contact-container">
                <div class="row">
                    <div class="col-lg-4 fade-in">
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <div class="contact-card-particle particle-1"></div>
                                <div class="contact-card-particle particle-2"></div>
                                <div class="contact-card-particle particle-3"></div>
                                
                                <h3 class="contact-card-title">
                                    <?php echo getDbContent('contact_info_title', 'info'); ?>
                                </h3>
                                <p class="contact-card-subtitle">
                                    <?php echo getDbContent('contact_info_subtitle', 'info'); ?>
                                </p>
                            </div>
                            <div class="contact-card-body">
                                <div class="contact-shape-accent contact-shape-accent-1"></div>
                                <div class="contact-shape-accent contact-shape-accent-2"></div>
                                
                                <div class="contact-info-item" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo getDbContent('address_label', 'info'); ?>
                                        </div>
                                        <div class="contact-info-value" itemprop="streetAddress">
                                            <?php echo $address; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo getDbContent('phone_info_label', 'info'); ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>" class="<?php echo $isRtl ? 'numbers-ltr' : ''; ?>" itemprop="telephone">
                                                <?php echo formatPhone($phone, $lang); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo getDbContent('email_info_label', 'info'); ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <a href="mailto:<?php echo $email; ?>" itemprop="email">
                                                <?php echo $email; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <div class="contact-info-label">
                                            <?php echo getDbContent('hours_label', 'info'); ?>
                                        </div>
                                        <div class="contact-info-value">
                                            <?php echo nl2br(displayWorkingHours($lang));  ?>
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="social-links">
                                    <a href="<?php echo $social_profiles['instagram']; ?>" class="social-link" title="Instagram" rel="noopener">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="<?php echo $social_profiles['youtube']; ?>" class="social-link" title="YouTube" rel="noopener">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="<?php echo $social_profiles['whatsapp']; ?>" class="social-link" title="WhatsApp" rel="noopener">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 fade-in-delay-1">
                        <div class="contact-form-card scale-in">
                            <div class="contact-form">
                                <h2 class="form-title">
                                    <?php echo getDbContent('form_title', 'form'); ?>
                                </h2>
                                <p class="form-subtitle">
                                    <?php echo getDbContent('form_subtitle', 'form'); ?>
                                </p>

                                <form id="contactForm" class="contact-form-validated">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="name" class="form-label">
                                                    <?php echo getDbContent('fullname_label', 'form'); ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="name" name="name" class="form-control" 
                                                    placeholder="<?php echo getDbContent('fullname_placeholder', 'form'); ?>" 
                                                    data-error-message="<?php echo $isRtl ? 'لطفاً نام خود را وارد کنید' : 'Please enter your name'; ?>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="email" class="form-label">
                                                    <?php echo getDbContent('email_label', 'form'); ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" id="email" name="email" class="form-control" 
                                                    placeholder="<?php echo getDbContent('email_placeholder', 'form'); ?>"
                                                    data-error-message="<?php echo $isRtl ? 'لطفاً یک آدرس ایمیل معتبر وارد کنید' : 'Please enter a valid email address'; ?>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="phone" class="form-label">
                                                    <?php echo getDbContent('phone_label', 'form'); ?>
                                                </label>
                                                <input type="tel" id="phone" name="phone" class="form-control" 
                                                    placeholder="<?php echo getDbContent('phone_placeholder', 'form'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label for="subject" class="form-label">
                                                    <?php echo getDbContent('subject_label', 'form'); ?> <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="subject" name="subject" class="form-control" 
                                                    placeholder="<?php echo getDbContent('subject_placeholder', 'form'); ?>"
                                                    data-error-message="<?php echo $isRtl ? 'لطفاً موضوع پیام را وارد کنید' : 'Please enter a subject'; ?>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label for="message" class="form-label">
                                            <?php echo getDbContent('message_label', 'form'); ?> <span class="text-danger">*</span>
                                        </label>
                                        <textarea id="message" name="message" class="form-control" 
                                            placeholder="<?php echo getDbContent('message_placeholder', 'form'); ?>"
                                            data-error-message="<?php echo $isRtl ? 'لطفاً پیام خود را وارد کنید' : 'Please enter your message'; ?>"
                                            required rows="5"></textarea>
                                    </div>

                                    <button type="submit" class="submit-button">
                                        <?php echo getDbContent('submit_button', 'form'); ?>
                                        <i class="fas <?php echo $isRtl ? 'fa-arrow-left' : 'fa-arrow-right'; ?>"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Map Section -->
                <div class="map-section fade-in-delay-2">
                    <div class="map-gradient-overlay"></div>
                    
                    <div class="map-info-card scale-in">
                        <h3 class="map-info-title">
                            <?php echo getDbContent('map_title', 'map'); ?>
                        </h3>
                        <p class="map-info-text">
                            <?php echo getDbContent('map_description', 'map'); ?>
                        </p>
                        <a href="https://maps.app.goo.gl/dKBSob8Mv74Ay8QU7" target="_blank" rel="noopener" class="map-direction-btn">
                            <i class="fas fa-directions"></i>
                            <?php echo getDbContent('get_directions', 'map'); ?>
                        </a>
                    </div>
                    
                    <iframe class="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.7044105734994!2d55.3701782!3d25.280527099999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5c5ccc1839a7%3A0x4dc94820fc33cef1!2sSalman%20Farsi%20Iranian%20Boys%20School!5e0!3m2!1sen!2sae!4v1730836760722!5m2!1sen!2sae" 
                        title="<?php echo $isRtl ? 'موقعیت مجتمع آموزشی سلمان فارسی بر روی نقشه' : 'Salman Farsi Educational Complex Location on Map'; ?>"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>

        <!-- Contact Modal -->
        <div id="contactModal" class="contact-modal">
            <div class="contact-modal-overlay"></div>
            <div class="contact-modal-container">
                <div id="modalIcon" class="contact-modal-icon success">
                    <i id="modalIconType" class="fas fa-check-circle"></i>
                </div>
                <h3 id="modalTitle" class="contact-modal-title">
                    <?php echo getDbContent('success_title', 'modal'); ?>
                </h3>
                <p id="modalMessage" class="contact-modal-message">
                    <?php echo getDbContent('success_message', 'modal'); ?>
                </p>
                <button id="modalClose" class="contact-modal-btn">
                    <?php echo getDbContent('modal_button', 'modal'); ?>
                </button>
            </div>
        </div>
    </div><!-- /.page-wrapper -->



    <!-- Minimal set of scripts to avoid JS errors -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for Contact Page -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            'use strict';
            
            // Hide preloader immediately
            document.querySelectorAll('.preloader').forEach(function(el) {
                el.style.display = 'none';
            });
            
            // Create cosmic stars for the header
            createCosmicStars();
            
            // Animate shooting stars
            animateShootingStars();

            // Get form and modal elements
            const contactForm = document.getElementById('contactForm');
            const contactModal = document.getElementById('contactModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalIcon = document.getElementById('modalIcon');
            const modalIconType = document.getElementById('modalIconType');
            const modalClose = document.getElementById('modalClose');
            
            // Set up form submission via AJAX
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Client-side validation
                    if (!validateForm()) {
                        return false;
                    }
                    
                    // Show loading state
                    contactForm.classList.add('form-loading');
                    
                    // Create form data object
                    const formData = new FormData();
                    formData.append('name', document.getElementById('name').value);
                    formData.append('email', document.getElementById('email').value);
                    formData.append('phone', document.getElementById('phone').value);
                    formData.append('subject', document.getElementById('subject').value);
                    formData.append('message', document.getElementById('message').value);
                    formData.append('lang', '<?php echo $lang; ?>');
                    
                    // Send XHR request
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'includes/process-contact.php', true);
                    xhr.onload = function() {
                        // Remove loading state
                        contactForm.classList.remove('form-loading');
                        
                        if (xhr.status === 200) {
                            try {
                                console.log("Response:", xhr.responseText); // For debugging
                                const data = JSON.parse(xhr.responseText);
                                
                                // Show appropriate modal
                                if (data.status === 'success') {
                                    showModal(
                                        '<?php echo getDbContent('success_title', 'modal'); ?>', 
                                        '<?php echo getDbContent('success_message', 'modal'); ?>',
                                        'success'
                                    );
                                    // Reset form on success
                                    contactForm.reset();
                                } else {
                                    showModal(
                                        '<?php echo getDbContent('error_title', 'modal'); ?>',
                                        data.message || '<?php echo getDbContent('error_message', 'modal'); ?>',
                                        'error'
                                    );
                                }
                            } catch (e) {
                                console.error('Error parsing response:', e, xhr.responseText);
                                showModal(
                                    '<?php echo getDbContent('system_error_title', 'modal'); ?>',
                                    '<?php echo getDbContent('system_error_message', 'modal'); ?>',
                                    'error'
                                );
                            }
                        } else {
                            showModal(
                                '<?php echo getDbContent('system_error_title', 'modal'); ?>',
                                '<?php echo getDbContent('system_error_message', 'modal'); ?>',
                                'error'
                            );
                            console.error('XHR Error:', xhr.status);
                        }
                    };
                    
                    xhr.onerror = function() {
                        // Remove loading state
                        contactForm.classList.remove('form-loading');
                        
                        // Show error modal
                        showModal(
                            '<?php echo getDbContent('connection_error_title', 'modal'); ?>',
                            '<?php echo getDbContent('connection_error_message', 'modal'); ?>',
                            'error'
                        );
                    };
                    
                    xhr.send(formData);
                });
            }
            
            // Function to show modal
            function showModal(title, message, type = 'success') {
                modalTitle.textContent = title;
                modalMessage.textContent = message;
                
                if (type === 'success') {
                    modalIcon.className = 'contact-modal-icon success';
                    modalIconType.className = 'fas fa-check-circle';
                } else {
                    modalIcon.className = 'contact-modal-icon error';
                    modalIconType.className = 'fas fa-exclamation-circle';
                }
                
                contactModal.classList.add('show');
            }
            
            // Close modal when clicking the button or overlay
            if (modalClose) {
                modalClose.addEventListener('click', function() {
                    contactModal.classList.remove('show');
                });
            }
            
            if (contactModal) {
                contactModal.querySelector('.contact-modal-overlay').addEventListener('click', function() {
                    contactModal.classList.remove('show');
                });
            }
            
            // Form validation function
            function validateForm() {
                let isValid = true;
                const requiredFields = contactForm.querySelectorAll('[required]');
                
                // Clear previous errors
                contactForm.querySelectorAll('.is-invalid').forEach(field => {
                    field.classList.remove('is-invalid');
                });
                
                contactForm.querySelectorAll('.form-error').forEach(error => {
                    error.remove();
                });
                
                requiredFields.forEach(field => {
                    // Check if field is empty
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                        
                        // Create error message
                        const errorElem = document.createElement('div');
                        errorElem.className = 'form-error';
                        errorElem.textContent = field.getAttribute('data-error-message') || 
                            '<?php echo $isRtl ? 'این فیلد الزامی است' : 'This field is required'; ?>';
                        field.parentNode.insertBefore(errorElem, field.nextSibling);
                    }
                    
                    // Validate email format
                    if (field.type === 'email' && field.value.trim()) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            field.classList.add('is-invalid');
                            isValid = false;
                            
                            // Create error message
                            const errorElem = document.createElement('div');
                            errorElem.className = 'form-error';
                            errorElem.textContent = '<?php echo $isRtl ? 'لطفاً یک آدرس ایمیل معتبر وارد کنید' : 'Please enter a valid email address'; ?>';
                            field.parentNode.insertBefore(errorElem, field.nextSibling);
                        }
                    }
                    
                    // Remove error when typing
                    field.addEventListener('input', function() {
                        if (field.value.trim()) {
                            field.classList.remove('is-invalid');
                            const errorElem = field.nextElementSibling;
                            if (errorElem && errorElem.classList.contains('form-error')) {
                                errorElem.remove();
                            }
                        }
                    });
                });
                
                return isValid;
            }
            
            // Back to Top Button
            const backToTopButton = document.getElementById('backToTop');
            
            if (backToTopButton) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTopButton.classList.add('visible');
                    } else {
                        backToTopButton.classList.remove('visible');
                    }
                });
                
                backToTopButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
        
        // Function to create cosmic stars dynamically
        function createCosmicStars() {
            const cosmicBg = document.querySelector('.cosmic-bg');
            if (!cosmicBg) return;
            
            const starsCount = 80;
            
            for (let i = 0; i < starsCount; i++) {
                const star = document.createElement('div');
                star.className = 'cosmic-star';
                
                // Random size between 1-4 pixels
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
        
        // Function to animate shooting stars
        function animateShootingStars() {
            // Create shooting stars
            const cosmicBg = document.querySelector('.cosmic-bg');
            if (!cosmicBg) return;
            
            for (let i = 0; i < 2; i++) {
                const shootingStar = document.createElement('div');
                shootingStar.className = 'shooting-star';
                cosmicBg.appendChild(shootingStar);
            }
            
            const shootingStars = document.querySelectorAll('.shooting-star');
            
            shootingStars.forEach((star, index) => {
                setInterval(() => {
                    // Random top position
                    star.style.top = `${Math.random() * 80}%`;
                    star.style.left = `${Math.random() * 80}%`;
                    
                    // Trigger animation
                    star.style.animation = 'none';
                    setTimeout(() => {
                        star.style.animation = `shooting ${Math.random() * 3 + 3}s linear forwards`;
                    }, 10);
                }, (index + 1) * 5000); // Different intervals for each star
            });
        }
    </script>
</body>
</html>
<?php
// Close the database connection at the end of the file
try {
    if (isset($db) && $db) {
        if (function_exists('closeDB')) {
            closeDB($db);
        } else {
            $db->close();
        }
    }
} catch (Exception $e) {
    // Log error silently
}
?>
