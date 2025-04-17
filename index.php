<?php
/**
 * Salman Farsi Educational Complex - Premium Creative Homepage
 * 
 * Fully multilingual homepage that loads content dynamically from database
 * SEO optimized for top search engine ranking in all supported languages
 * 
 * @package Salman Educational Complex
 * @version 9.0
 */

// Load configuration
require_once 'includes/config.php';

// Database connection
$db = connectDB();

// Get all active languages
$query = "SELECT * FROM languages WHERE is_active = 1 ORDER BY is_default DESC";
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
 * Get content from database by field key and section
 * 
 * @param string $field_key Field key to retrieve
 * @param string $section_id Section ID (optional)
 * @param int $fallback_lang_id Fallback language ID if content not found
 * @return string Content or empty string if not found
 */
function getDbContent($field_key, $section_id = null, $fallback_lang_id = 2) {
    global $db, $language_id;
    
    // Build the query
    $query = "SELECT content FROM home_content WHERE field_key = ? AND language_id = ?";
    $params = [$field_key, $language_id];
    $types = "si";
    
    if ($section_id) {
        $query .= " AND section_id = ?";
        $params[] = $section_id;
        $types .= "s";
    }
    
    $query .= " LIMIT 1";
    
    // Execute the query
    $stmt = $db->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Return content if found
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['content'];
    }
    
    // Try fallback language if content not found
    if ($language_id != $fallback_lang_id) {
        $fallback_query = "SELECT content FROM home_content WHERE field_key = ?";
        $fallback_params = [$field_key];
        $fallback_types = "s";
        
        if ($section_id) {
            $fallback_query .= " AND section_id = ?";
            $fallback_params[] = $section_id;
            $fallback_types .= "s";
        }
        
        $fallback_query .= " AND language_id = ? LIMIT 1";
        $fallback_params[] = $fallback_lang_id;
        $fallback_types .= "i";
        
        $fallback_stmt = $db->prepare($fallback_query);
        $fallback_stmt->bind_param($fallback_types, ...$fallback_params);
        $fallback_stmt->execute();
        $fallback_result = $fallback_stmt->get_result();
        
        if ($fallback_result && $fallback_result->num_rows > 0) {
            $row = $fallback_result->fetch_assoc();
            return $row['content'];
        }
    }
    
    // Return empty string if no content found
    return '';
}

/**
 * Get repeatable content items (like education paths, features, etc.)
 * 
 * @param string $field_key Field key to retrieve
 * @param string $section_id Section ID
 * @param int $fallback_lang_id Fallback language ID if content not found
 * @return array Array of content items
 */
function getRepeatableDbContent($field_key, $section_id, $fallback_lang_id = 2) {
    global $db, $language_id;
    
    // Query to get repeatable content for current language
    $query = "SELECT * FROM home_content 
              WHERE field_key = ? 
              AND section_id = ? 
              AND language_id = ? 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
    
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssi", $field_key, $section_id, $language_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }
    
    // Try fallback language if no items found
    if ($language_id != $fallback_lang_id) {
        $fallback_query = "SELECT * FROM home_content 
                          WHERE field_key = ? 
                          AND section_id = ? 
                          AND language_id = ? 
                          AND is_repeatable = 1 
                          ORDER BY sort_order ASC";
        
        $fallback_stmt = $db->prepare($fallback_query);
        $fallback_stmt->bind_param("ssi", $field_key, $section_id, $fallback_lang_id);
        $fallback_stmt->execute();
        $fallback_result = $fallback_stmt->get_result();
        
        if ($fallback_result && $fallback_result->num_rows > 0) {
            while ($row = $fallback_result->fetch_assoc()) {
                $items[] = $row;
            }
        }
    }
    
    return $items;
}

// Get SEO data from database or use default values
$seo_title = getDbContent('seo_title', 'meta') ?: ($isRtl ? 'مجتمع آموزشی سلمان فارسی | صفحه اصلی' : 'Salman Farsi Educational Complex | Home');
$seo_description = getDbContent('seo_description', 'meta') ?: ($isRtl ? 'مجتمع آموزشی سلمان فارسی، ارائه دهنده آموزش با کیفیت فارسی و بین المللی در دبی برای دانش‌آموزان ایرانی' : 'Salman Farsi Educational Complex, providing high-quality Persian and international education in Dubai for Iranian students');
$seo_keywords = getDbContent('seo_keywords', 'meta') ?: ($isRtl ? 'مدرسه ایرانی، دبی، آموزش فارسی، مجتمع آموزشی، سلمان فارسی' : 'Iranian school, Dubai, Persian education, educational complex, Salman Farsi');

// Build canonical and alternate URLs for hreflang
$canonical_base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";
$canonical_url = $canonical_base . strtok($_SERVER['REQUEST_URI'], '?');
$alternate_urls = [];
foreach ($available_languages as $alt_lang => $lang_data) {
    $alternate_urls[$alt_lang] = $canonical_url . '?lang=' . $alt_lang;
}

// Set location data for Schema.org
$location_data = [
    'name' => $isRtl ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex',
    'address' => $isRtl ? 'دبی، امارات متحده عربی' : 'Dubai, United Arab Emirates',
    'telephone' => '+971 4 123 4567',
    'email' => 'info@salmanschool.ae'
];

// Social media profiles
$social_profiles = [
    'facebook' => 'https://www.facebook.com/salmanfarsischool',
    'instagram' => 'https://www.instagram.com/salmanfarsischool',
    'twitter' => 'https://twitter.com/salmanfarsisch',
    'linkedin' => 'https://www.linkedin.com/company/salmanfarsischool'
];

// Set Open Graph data
$og_type = 'website';
$og_image = 'assets/images/og-images/home-' . $lang . '.jpg'; // Language-specific OG images
$og_site_name = $isRtl ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    
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
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>
    
    <meta http-equiv="Content-Security-Policy" content="style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; style-src-elem 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com/ajax/libs/animate.css/ https://cdnjs.cloudflare.com/ajax/libs/font-awesome/ https://cdn.jsdelivr.net/;">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- WOW.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.css">

    <!-- Main CSS -->
    <?php include_once 'assets/css/pages/home.css.php'; ?>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EducationalOrganization",
      "name": "<?php echo $isRtl ? 'مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex'; ?>",
      "alternateName": "<?php echo $isRtl ? 'Salman Farsi Educational Complex' : 'مجتمع آموزشی سلمان فارسی'; ?>",
      "url": "<?php echo $canonical_url; ?>",
      "logo": "<?php echo $canonical_base; ?>/assets/images/logo.png",
      "sameAs": [
        "<?php echo $social_profiles['facebook']; ?>",
        "<?php echo $social_profiles['instagram']; ?>",
        "<?php echo $social_profiles['twitter']; ?>",
        "<?php echo $social_profiles['linkedin']; ?>"
      ],
      "description": "<?php echo $seo_description; ?>",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Dubai",
        "addressRegion": "Dubai",
        "addressCountry": "AE"
      },
      "telephone": "<?php echo $location_data['telephone']; ?>",
      "email": "<?php echo $location_data['email']; ?>",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "125"
      },
      "numberOfStudents": "490",
      "foundingDate": "1956",
      "areaServed": {
        "@type": "City",
        "name": "Dubai"
      },
      "availableLanguage": ["Persian", "English", "Arabic"]
    }
    </script>
    
    <!-- Local Business Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "<?php echo $location_data['name']; ?>",
      "image": "<?php echo $canonical_base; ?>/assets/images/logo.png",
      "@id": "<?php echo $canonical_url; ?>#localbusiness",
      "url": "<?php echo $canonical_url; ?>",
      "telephone": "<?php echo $location_data['telephone']; ?>",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Dubai",
        "addressRegion": "Dubai",
        "addressCountry": "AE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 25.2048,
        "longitude": 55.2708
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday"
        ],
        "opens": "07:30",
        "closes": "15:30"
      },
      "sameAs": [
        "<?php echo $social_profiles['facebook']; ?>",
        "<?php echo $social_profiles['instagram']; ?>",
        "<?php echo $social_profiles['twitter']; ?>",
        "<?php echo $social_profiles['linkedin']; ?>"
      ]
    }
    </script>
</head>

<body>
    <!-- Google Tag Manager (noscript) - Uncomment and add your GTM ID in production -->
    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
       <!-- Header -->
    <?php include_once 'includes/menu.php'; ?>

<!-- Hero Section -->
<section class="hero-section" id="home">
    <!-- Particle Container for Interactive Background -->
    <div id="particles-js" class="particles-container"></div>
    
    <!-- Hero Shapes -->
    <div class="hero-shape-1"></div>
    <div class="hero-shape-2"></div>
    
    <!-- Hero meteors -->
    <div class="hero-meteor hero-meteor-1"></div>
    <div class="hero-meteor hero-meteor-2"></div>
    
    <div class="container">
        <div class="row align-items-center">
            <!-- Hero Content -->
            <div class="col-lg-6">
                <div class="hero-content wow fadeInUp">
                    <div class="hero-badge">
                        <i class="fas fa-graduation-cap"></i>
                        <?php echo getDbContent('hero_badge', 'hero'); ?>
                    </div>
                    
                    <h1 class="hero-title">
                        <?php echo getDbContent('hero_title', 'hero'); ?>
                    </h1>
                    
                    <p class="hero-description">
                        <?php echo getDbContent('hero_description', 'hero'); ?>
                    </p>
                    
                    <div class="hero-buttons">
                        <a href="<?php echo getDbContent('hero_btn_primary_url', 'hero'); ?>?lang=<?php echo $lang; ?>" class="btn btn-primary">
                            <?php echo getDbContent('hero_btn_primary', 'hero'); ?>
                            <i class="fas fa-arrow-<?php echo $isRtl ? 'right' : 'left'; ?>"></i>
                            
                        </a>
                        <a href="<?php echo getDbContent('hero_btn_secondary_url', 'hero'); ?>?lang=<?php echo $lang; ?>" class="btn btn-outline">
                            <?php echo getDbContent('hero_btn_secondary', 'hero'); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="col-lg-6">
                <div class="hero-image-wrapper wow fadeInUp" data-wow-delay="0.3s">
                    <div class="hero-image">
                        <div class="hero-image-main">
                            <img src="<?php echo getDbContent('hero_image', 'hero'); ?>" 
                                 alt="<?php echo $isRtl ? 'دانش‌آموزان مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex Students'; ?>"
                                 width="600" height="400" loading="eager">
                        </div>
                        
                        <div class="hero-feature hero-feature-1">
                            <i class="fas fa-medal"></i>
                            <div class="hero-feature-content">
                                <h4><?php echo getDbContent('hero_feature1_title', 'hero'); ?></h4>
                                <p><?php echo getDbContent('hero_feature1_text', 'hero'); ?></p>
                            </div>
                        </div>
                        
                        <div class="hero-feature hero-feature-2">
                            <i class="fas fa-history"></i>
                            <div class="hero-feature-content">
                                <h4><?php echo getDbContent('hero_feature2_title', 'hero'); ?></h4>
                                <p><?php echo getDbContent('hero_feature2_text', 'hero'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Educational Paths Section -->
<section class="edu-path-section" id="educational-paths">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-subtitle wow fadeInUp"><?php echo getDbContent('edu_paths_subtitle', 'edu_paths'); ?></span>
            <h2 class="section-heading wow fadeInUp" data-wow-delay="0.2s">
                <?php echo getDbContent('edu_paths_title', 'edu_paths'); ?>
            </h2>
            <div class="section-divider wow fadeInUp" data-wow-delay="0.3s"></div>
            <p class="section-description text-center wow fadeInUp" data-wow-delay="0.4s">
                <?php echo getDbContent('edu_paths_description', 'edu_paths'); ?>
            </p>
        </div>
        
        <div class="edu-path-grid">
            <?php 
            // Get educational paths from database
            $edu_paths = getRepeatableDbContent('path_title', 'path_items');
            foreach ($edu_paths as $index => $path): 
                // Get the sort order for the index
                $sort_order = $path['sort_order'];
                
                // Find related content for this path
                $path_icon = getRepeatableDbContent('path_icon', 'path_items');
                $path_icon = !empty($path_icon[$index]) ? $path_icon[$index]['content'] : 'fas fa-graduation-cap';
                
                $path_description = getRepeatableDbContent('path_description', 'path_items');
                $path_description = !empty($path_description[$index]) ? $path_description[$index]['content'] : '';
                
                $path_link_text = getRepeatableDbContent('path_link_text', 'path_items');
                $path_link_text = !empty($path_link_text[$index]) ? $path_link_text[$index]['content'] : '';
                
                $path_link_url = getRepeatableDbContent('path_link_url', 'path_items');
                $path_link_url = !empty($path_link_url[$index]) ? $path_link_url[$index]['content'] : '#';
            ?>
            <div class="edu-path-card wow fadeInUp" data-wow-delay="<?php echo 0.1 * ($index + 1); ?>s" itemscope itemtype="https://schema.org/Course">
                <div class="edu-path-icon">
                    <i class="<?php echo $path_icon; ?>"></i>
                </div>
                <h3 class="edu-path-title" itemprop="name"><?php echo $path['content']; ?></h3>
                <p class="edu-path-text" itemprop="description">
                    <?php echo $path_description; ?>
                </p>
                <a href="<?php echo $path_link_url; ?>?lang=<?php echo $lang; ?>" class="edu-path-link" itemprop="url">
                    <?php echo $path_link_text; ?>
                    <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                </a>
                <meta itemprop="provider" content="Salman Farsi Educational Complex">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about" itemscope itemtype="https://schema.org/EducationalOrganization">
    <div class="container">
        <div class="row align-items-center">
            <!-- About Image -->
            <div class="col-lg-6">
                <div class="about-image-wrapper wow fadeInLeft">
                    <div class="about-image">
                        <div class="about-image-wrap">
                            <img src="<?php echo getDbContent('about_image', 'about'); ?>" 
                                 alt="<?php echo $isRtl ? 'ساختمان مجتمع آموزشی سلمان فارسی' : 'Salman Farsi Educational Complex Building'; ?>"
                                 width="540" height="400" loading="lazy" itemprop="image">
                        </div>
                        
                        <div class="about-experience">
                            <div class="about-experience-number" itemprop="foundingDate" content="1956"><?php echo getDbContent('about_experience_number', 'about'); ?></div>
                            <div class="about-experience-text">
                                <?php echo getDbContent('about_experience_text', 'about'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- About Content -->
            <div class="col-lg-6">
                <div class="about-content wow fadeInRight">
                    <span class="section-subtitle"><?php echo getDbContent('about_subtitle', 'about'); ?></span>
                    <h2 class="section-heading" itemprop="name">
                        <?php echo getDbContent('about_title', 'about'); ?>
                    </h2>
                    <div class="section-divider"></div>
                    
                    <p class="about-text" itemprop="description">
                        <?php echo getDbContent('about_text', 'about'); ?>
                    </p>
                    
                    <ul class="about-features">
                        <?php 
                        // Get about features from database
                        $about_features = getRepeatableDbContent('feature_text', 'about_features');
                        foreach ($about_features as $feature): 
                        ?>
                        <li class="about-feature" itemprop="knowsAbout">
                            <i class="fas fa-check"></i>
                            <span><?php echo $feature['content']; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <a href="<?php echo getDbContent('about_button_url', 'about'); ?>?lang=<?php echo $lang; ?>" class="btn btn-primary" itemprop="url">
                        <?php echo getDbContent('about_button_text', 'about'); ?>
                        <i class="fas fa-arrow-<?php echo $isRtl ? 'right' : 'left'; ?>"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">            
    <div class="container stats-container">
        <div class="stats-grid" itemscope itemtype="https://schema.org/EducationalOrganization">
            <?php 
            // Get stats from database
            $stat_icons = getRepeatableDbContent('stat_icon', 'stats');
            $stat_numbers = getRepeatableDbContent('stat_number', 'stats');
            $stat_labels = getRepeatableDbContent('stat_label', 'stats');
            
            // Map stat positions to Schema.org properties
            $stat_schema_props = [
                0 => 'alumni', // Graduates
                1 => 'foundingDate', // Years of experience 
                2 => 'numberOfStudents', // Current students
                3 => 'memberOf' // University partners
            ];
            
            // Loop through stats
            for ($i = 0; $i < count($stat_icons); $i++): 
                $delay = 0.1 + ($i * 0.2);
                $schema_prop = isset($stat_schema_props[$i]) ? $stat_schema_props[$i] : '';
            ?>
            <div class="stat-card wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                <div class="stat-icon">
                    <i class="<?php echo $stat_icons[$i]['content']; ?>"></i>
                </div>
                <div class="stat-number" data-count="<?php echo $stat_numbers[$i]['content']; ?>" <?php if($schema_prop): ?>itemprop="<?php echo $schema_prop; ?>"<?php endif; ?>>
                    <?php echo $stat_numbers[$i]['content']; ?>+
                </div>
                <div class="stat-label"><?php echo $stat_labels[$i]['content']; ?></div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- University Logos Section -->
<section class="university-logos-section py-5 bg-light">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="section-subtitle wow fadeInUp"><?php echo getDbContent('university_subtitle', 'universities'); ?></span>
            <h2 class="section-heading wow fadeInUp" data-wow-delay="0.2s">
                <?php echo getDbContent('university_title', 'universities'); ?>
            </h2>
            <div class="section-divider wow fadeInUp" data-wow-delay="0.3s"></div>
            <p class="section-description wow fadeInUp" data-wow-delay="0.4s">
                <?php echo getDbContent('university_description', 'universities'); ?>
            </p>
        </div>

        <!-- Universities Carousel -->
        <div class="university-carousel-container position-relative mt-5 wow fadeInUp" data-wow-delay="0.5s">
            <!-- Static Marquee Effect for Universities -->
            <div class="university-marquee overflow-hidden">
                <div class="university-marquee-content d-flex align-items-center justify-content-around" id="university-marquee-content">
                    <?php 
                    // Get university logos from database
                    $university_items = getRepeatableDbContent('univ_name', 'university_items');
                    foreach ($university_items as $university): 
                    ?>
                    <div class="university-logo mx-4 p-3 bg-white rounded-3 shadow-sm" data-bs-toggle="tooltip" 
                        title="<?php echo $university['content']; ?>" itemscope itemtype="https://schema.org/CollegeOrUniversity">
                        <meta itemprop="name" content="<?php echo $university['content']; ?>">
                        <img src="<?php echo $university['image_path']; ?>" 
                            alt="<?php echo $university['content']; ?> <?php echo $isRtl ? 'لوگو' : 'Logo'; ?>"
                            class="img-fluid" style="max-height: 70px; max-width: 140px;" itemprop="logo">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Gradient Overlays -->
            <div class="university-overlay-start position-absolute top-0 start-0 h-100" style="width: 100px; background: linear-gradient(to right, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%); z-index: 1;"></div>
            <div class="university-overlay-end position-absolute top-0 end-0 h-100" style="width: 100px; background: linear-gradient(to left, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%); z-index: 1;"></div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section" id="testimonials">
    <!-- Starry Background Overlay -->
    <div class="stars-overlay"></div>
    
    <!-- Floating Shapes -->
    <div class="floating-shape shape1"></div>
    <div class="floating-shape shape2"></div>
    <div class="floating-shape shape3"></div>
    
    <div class="container">
        <div class="text-center mb-5 position-relative z-1">
            <span class="section-subtitle wow fadeInUp"><?php echo getDbContent('testimonials_subtitle', 'testimonials'); ?></span>
            <h2 class="section-heading wow fadeInUp" data-wow-delay="0.2s">
                <?php echo getDbContent('testimonials_title', 'testimonials'); ?>
            </h2>
            <div class="section-divider wow fadeInUp" data-wow-delay="0.3s"></div>
            <p class="section-description wow fadeInUp" data-wow-delay="0.4s">
                <?php echo getDbContent('testimonials_description', 'testimonials'); ?>
            </p>
        </div>
        
        <?php
        // Get testimonials from database
        $testimonials = [];
        
        try {
            if (isset($db) && $db) {
                // Query to fetch reviews based on language
                $lang_id = $language_id;
                
                $reviews_query = "
                    SELECT r.review_id, rt.person_name, rt.person_position, rt.content, m.file_path AS image_url 
                    FROM reviews r
                    LEFT JOIN review_translations rt ON r.review_id = rt.review_id AND rt.language_id = ?
                    LEFT JOIN media m ON r.media_id = m.media_id
                    WHERE rt.status = 'published'
                    ORDER BY r.created_at DESC LIMIT 6
                ";
                
                $stmt = $db->prepare($reviews_query);
                if ($stmt) {
                    $stmt->bind_param('i', $lang_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $testimonials[] = $row;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // Silent fail - will use fallback data
        }
        
        // Fallback data if no testimonials found in database
        if (empty($testimonials)) {
            $testimonials = [
                [
                    'person_name' => $isRtl ? 'فاطمه رضوی' : 'Fatima Razavi',
                    'person_position' => $isRtl ? 'والد دانش‌آموز' : 'Parent',
                    'content' => $isRtl ? 'فرزند من در این مدرسه رشد فوق‌العاده‌ای داشته است. معلمان مجرب و محیط آموزشی امن و پویا باعث شده تا او با اشتیاق به مدرسه بیاید و مهارت‌های ارزشمندی را کسب کند.' : 'My child has had tremendous growth at this school. The experienced teachers and safe, dynamic learning environment have made him eager to come to school and gain valuable skills.',
                    'image_url' => 'assets/images/testimonials/parent1.jpg',
                    'rating' => 5
                ],
                [
                    'person_name' => $isRtl ? 'محمد صدری' : 'Mohammad Sadri',
                    'person_position' => $isRtl ? 'پدر دانش‌آموز' : 'Father',
                    'content' => $isRtl ? 'آموزش دوزبانه و برنامه‌های متنوع فرهنگی، فرزند من را برای زندگی در دنیای چندفرهنگی آماده کرده است. از انتخاب مجتمع سلمان فارسی برای تحصیل فرزندم بسیار خرسندم.' : 'The bilingual education and diverse cultural programs have prepared my child for life in a multicultural world. I am very pleased with choosing Salman Farsi Complex for my child\'s education.',
                    'image_url' => 'assets/images/testimonials/parent2.jpg',
                    'rating' => 5
                ],
                [
                    'person_name' => $isRtl ? 'سارا حسینی' : 'Sara Hosseini',
                    'person_position' => $isRtl ? 'دانش‌آموز سابق' : 'Former Student',
                    'content' => $isRtl ? 'سال‌های تحصیل من در سلمان فارسی، پایه‌های موفقیت دانشگاهی من را شکل داد. روش‌های آموزشی نوآورانه و معلمان دلسوز، نه تنها دانش علمی بلکه مهارت‌های زندگی را نیز به من آموختند.' : 'My years at Salman Farsi shaped the foundation of my academic success. The innovative teaching methods and caring teachers taught me not only academic knowledge but also life skills.',
                    'image_url' => 'assets/images/testimonials/student1.jpg',
                    'rating' => 5
                ]
            ];
        }
        ?>
        
        <div class="testimonial-carousel-container wow fadeIn" data-wow-delay="0.5s">
            <div class="testimonial-carousel owl-carousel">
                <?php foreach ($testimonials as $index => $testimonial): ?>
                <div class="testimonial-card" itemscope itemtype="https://schema.org/Review">
                    <div class="testimonial-card-inner">
                        <div class="testimonial-content">
                            <span class="quote-icon"><i class="fas fa-quote-<?php echo $isRtl ? 'right' : 'left'; ?>"></i></span>
                            <p itemprop="reviewBody"><?php echo htmlspecialchars($testimonial['content']); ?></p>
                        </div>
                        
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <?php 
                                $image_path = !empty($testimonial['image_url']) ? 
                                    $testimonial['image_url'] : 
                                    'assets/images/testimonials/default.jpg';
                                ?>
                                <img src="<?php echo htmlspecialchars($image_path); ?>" 
                                     alt="<?php echo htmlspecialchars($testimonial['person_name']); ?>" 
                                     width="60" height="60" loading="lazy" itemprop="image">
                            </div>
                            <div class="testimonial-author-info">
                                <h4 itemprop="author" itemscope itemtype="https://schema.org/Person">
                                    <span itemprop="name"><?php echo htmlspecialchars($testimonial['person_name']); ?></span>
                                </h4>
                                <p itemprop="author" itemscope itemtype="https://schema.org/Person">
                                    <meta itemprop="description" content="<?php echo htmlspecialchars($testimonial['person_position']); ?>">
                                    <?php echo htmlspecialchars($testimonial['person_position']); ?>
                                </p>
                                <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                    <meta itemprop="worstRating" content="1">
                                    <meta itemprop="bestRating" content="5">
                                    <meta itemprop="ratingValue" content="<?php echo isset($testimonial['rating']) ? $testimonial['rating'] : 5; ?>">
                                    <?php 
                                    $rating = isset($testimonial['rating']) ? $testimonial['rating'] : 5;
                                    for ($i = 0; $i < 5; $i++): 
                                    ?>
                                        <i class="fas fa-star<?php echo ($i >= $rating) ? '-o' : ''; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <meta itemprop="itemReviewed" content="Salman Farsi Educational Complex">
                        <meta itemprop="datePublished" content="2024-04-<?php echo 10 + $index; ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Custom Navigation -->
            <div class="testimonial-nav">
                <button class="testimonial-prev"><i class="fas fa-arrow-<?php echo $isRtl ? 'right' : 'left'; ?>"></i></button>
                <button class="testimonial-next"><i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i></button>
            </div>
        </div>
        
        <!-- Testimonial Background Elements -->
        <div class="testimonial-bg-circle testimonial-bg-circle-1"></div>
        <div class="testimonial-bg-circle testimonial-bg-circle-2"></div>
    </div>
</section>

<!-- Video Tour Section -->
<section class="video-tour-section position-relative">
    <!-- Video Container with Parallax Effect -->
    <div class="video-tour-wrapper position-relative overflow-hidden">
        <!-- Video Thumbnail Image -->
        <div class="video-thumbnail position-absolute w-100 h-100">
            <img src="<?php echo getDbContent('video_thumbnail', 'video'); ?>" 
                alt="<?php echo getDbContent('video_title', 'video'); ?>" 
                class="w-100 h-100 object-fit-cover" id="videoThumbnail"
                width="1200" height="675" loading="lazy">
                
            <!-- Particle Overlay (Stars Effect) -->
            <div class="particles-js position-absolute top-0 start-0 w-100 h-100" id="particles-video"></div>
            
            <!-- Dark Gradient Overlay -->
            <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
        </div>
        
        <!-- Content Overlay -->
        <div class="video-tour-content">
            <div class="container">
                <h2 class="video-tour-title">
                    <?php echo getDbContent('video_title', 'video'); ?>
                </h2>
                
                <p class="video-tour-description">
                    <?php echo getDbContent('video_description', 'video'); ?>
                </p>
                
                <!-- Play Button with Pulse Effect -->
                <div class="video-play-container">
                    <a href="#" class="video-play-btn" data-bs-toggle="modal" data-bs-target="#videoModal"
                       aria-label="<?php echo $isRtl ? 'مشاهده ویدیو' : 'Watch video'; ?>">
                        <i class="fas fa-play"></i>
                    </a>
                    
                    <!-- Pulsing Circles -->
                    <div class="pulse-circles">
                        <div class="pulse-circle"></div>
                        <div class="pulse-circle" style="animation-delay: 1s;"></div>
                    </div>
                </div>
                
                <!-- Video Info Badge -->
                <div class="video-info-badge">
                    <i class="fas fa-clock"></i>
                    <span class="video-duration"><?php echo getDbContent('video_duration', 'video'); ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="videoModalLabel">
                        <?php echo getDbContent('video_title', 'video'); ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="about:blank" allowfullscreen allow="fullscreen; accelerometer; gyroscope; picture-in-picture" class="rounded" title="<?php echo getDbContent('video_title', 'video'); ?>"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq" itemscope itemtype="https://schema.org/FAQPage">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-subtitle wow fadeInUp"><?php echo getDbContent('faq_subtitle', 'faq'); ?></span>
            <h2 class="section-heading wow fadeInUp" data-wow-delay="0.2s">
                <?php echo getDbContent('faq_title', 'faq'); ?>
            </h2>
            <div class="section-divider wow fadeInUp" data-wow-delay="0.3s"></div>
            <p class="section-description text-center wow fadeInUp" data-wow-delay="0.4s">
                <?php echo getDbContent('faq_description', 'faq'); ?>
            </p>
        </div>
        
        <div class="faq-container">
            <?php 
            // Get FAQ items from database
            $faq_questions = getRepeatableDbContent('faq_question', 'faq_items');
            $faq_answers = getRepeatableDbContent('faq_answer', 'faq_items');
            
            for ($i = 0; $i < count($faq_questions); $i++): 
                $is_active = ($i === 0) ? ' active' : '';
                $delay = 0.1 * $i;
            ?>
            <div class="faq-item<?php echo $is_active; ?> wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="faq-question">
                    <span itemprop="name"><?php echo $faq_questions[$i]['content']; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-answer-content" itemprop="text">
                        <p><?php echo $faq_answers[$i]['content']; ?></p>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        
        <div class="faq-more wow fadeInUp" data-wow-delay="0.5s">
            <a href="<?php echo getDbContent('faq_button_url', 'faq'); ?>?lang=<?php echo $lang; ?>" class="btn btn-primary">
                <?php echo getDbContent('faq_button_text', 'faq'); ?>
                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 position-relative overflow-hidden">
    <!-- Background Gradient is applied via CSS classes -->
    
    <!-- Animated Shapes -->
    <div class="animated-shapes">
        <!-- Floating Circles -->
        <div class="shape-circle position-absolute" 
            style="width: 150px; height: 150px; top: -50px; left: 10%; animation: float 8s ease-in-out infinite;"></div>
        <div class="shape-circle position-absolute" 
            style="width: 100px; height: 100px; bottom: -30px; right: 15%; animation: float 6s ease-in-out infinite;"></div>
        
        <!-- Floating Blobs -->
        <div class="shape-blob position-absolute" 
            style="width: 200px; height: 200px; top: 20%; right: -50px; animation: float 10s ease-in-out infinite alternate;"></div>
        <div class="shape-blob position-absolute" 
            style="width: 180px; height: 180px; bottom: 10%; left: -50px; animation: float 8s ease-in-out infinite 1s alternate;"></div>
    </div>
    
    <!-- Star Pattern Overlay -->
    <div class="star-pattern position-absolute top-0 start-0 w-100 h-100"></div>
    
    <!-- Meteor Effects -->
    <div class="cta-meteor cta-meteor-1"></div>
    <div class="cta-meteor cta-meteor-2"></div>
    
    <div class="container position-relative z-1">
        <div class="cta-content wow fadeIn">
            <!-- Animated Badge -->
            <div class="cta-badge wow fadeInDown">
                <span class="badge">
                    <?php echo getDbContent('cta_badge', 'cta'); ?>
                </span>
            </div>
            
            <h2 class="cta-title wow fadeInUp" data-wow-delay="0.2s">
                <?php echo getDbContent('cta_title', 'cta'); ?>
            </h2>
            
            <p class="cta-text wow fadeInUp" data-wow-delay="0.4s">
                <?php echo getDbContent('cta_text', 'cta'); ?>
            </p>
            
            <div class="cta-buttons wow fadeInUp" data-wow-delay="0.6s">
                <a href="<?php echo getDbContent('cta_btn_primary_url', 'cta'); ?>?lang=<?php echo $lang; ?>" class="btn btn-light btn-lg rounded-pill px-5 py-3 text-primary fw-semibold shadow-lg hover-scale">
                    <i class="fas fa-user-plus me-2"></i>
                    <?php echo getDbContent('cta_btn_primary', 'cta'); ?>
                </a>
                
                <a href="<?php echo getDbContent('cta_btn_secondary_url', 'cta'); ?>?lang=<?php echo $lang; ?>" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-semibold hover-scale">
                    <i class="fas fa-envelope me-2"></i>
                    <?php echo getDbContent('cta_btn_secondary', 'cta'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include_once 'includes/footer.php'; ?>
</div>

<!-- Back to Top Button -->
<a href="#" class="back-to-top" id="backToTop" aria-label="<?php echo $isRtl ? 'برگشت به بالا' : 'Back to top'; ?>">
<i class="fas fa-arrow-up"></i>
</a>

<!-- Scripts -->
<script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- WOW.js for scroll animations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Particles.js for background effects -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

<!-- Custom Script -->
<script>
$(document).ready(function() {
    'use strict';
    
    // Initialize WOW.js
    new WOW().init();
    
    // Page Loader
    $(window).on('load', function() {
        setTimeout(function() {
            $('.page-loader').fadeOut(500);
        }, 800);
    });
    
    // Initialize Particles.js for hero section
    if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#6C63FF"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 2,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#6C63FF",
                    "opacity": 0.2,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": true,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 0.6
                        }
                    },
                    "push": {
                        "particles_nb": 4
                    }
                }
            },
            "retina_detect": true
        });
        
        // Particles for video section
        particlesJS('particles-video', {
            "particles": {
                "number": {
                    "value": 50,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle"
                },
                "opacity": {
                    "value": 0.5,
                    "random": true
                },
                "size": {
                    "value": 3,
                    "random": true
                },
                "line_linked": {
                    "enable": false
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out"
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "bubble"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "repulse"
                    }
                },
                "modes": {
                    "bubble": {
                        "distance": 150,
                        "size": 5,
                        "duration": 2,
                        "opacity": 0.8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    }
                }
            }
        });
    }
    
    // Testimonials Carousel
    $('.testimonial-carousel').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        smartSpeed: 700,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            992: { items: 3 }
        }
    });
    
    // Custom Navigation for Testimonials
    $('.testimonial-prev').click(function() {
        $('.testimonial-carousel').trigger('prev.owl.carousel');
    });
    
    $('.testimonial-next').click(function() {
        $('.testimonial-carousel').trigger('next.owl.carousel');
    });
    
    // FAQ Accordion
    $('.faq-question').on('click', function() {
        $(this).parent().toggleClass('active').siblings().removeClass('active');
    });
    
    // Video Modal
    $('#videoModal').on('show.bs.modal', function () {
        var iframe = $(this).find('iframe');
        var src = '<?php echo getDbContent('video_url', 'video'); ?>'; // Get video source from database
        iframe.attr('src', src);
    });
    
    $('#videoModal').on('hidden.bs.modal', function () {
        var iframe = $(this).find('iframe');
        iframe.attr('src', 'about:blank');
    });
    
    // Parallax Effects for Scrolling
    let lastKnownScrollPosition = 0;
let ticking = false;

function doSomething(scrollPos) {
    // انجام انیمیشن‌های اسکرول با requestAnimationFrame
    $('.hero-shape-1, .hero-shape-2').css({
        'transform': 'translateY(' + scrollPos * 0.1 + 'px)'
    });
}

document.addEventListener('scroll', function(e) {
    lastKnownScrollPosition = window.scrollY;

    if (!ticking) {
        window.requestAnimationFrame(function() {
            doSomething(lastKnownScrollPosition);
            ticking = false;
        });

        ticking = true;
    }
});
    
    // Back to Top
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $('#backToTop').addClass('active');
        } else {
            $('#backToTop').removeClass('active');
        }
    });
    
    $('#backToTop').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });
    
    // Smooth Scroll for Anchor Links
    $('a[href^="#"]:not([href="#"])').on('click', function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
    
    // University Logos Marquee
    function setupMarquee() {
        const marqueeContent = document.getElementById('university-marquee-content');
        if (!marqueeContent) return;
        
        const logoElements = marqueeContent.querySelectorAll('.university-logo');
        
        // Clone the logos and append to create infinite scroll effect
        logoElements.forEach(logo => {
            const clone = logo.cloneNode(true);
            marqueeContent.appendChild(clone);
        });
        
        // Set animation properties based on RTL or LTR
        const isRtl = <?php echo $isRtl ? 'true' : 'false'; ?>;
        const direction = isRtl ? 'right' : 'left';
        const distance = isRtl ? '100%' : '-100%';
        
        // Add animation
        marqueeContent.style.animationName = 'scrollLogos';
        marqueeContent.style.animationDuration = '40s';
        marqueeContent.style.animationTimingFunction = 'linear';
        marqueeContent.style.animationIterationCount = 'infinite';
        
        // Create keyframes for the animation
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            @keyframes scrollLogos {
                from {
                    transform: translateX(0);
                }
                to {
                    transform: translateX(${distance});
                }
            }
        `;
        document.head.appendChild(styleSheet);
        
        // Pause animation on hover
        marqueeContent.addEventListener('mouseenter', () => {
            marqueeContent.style.animationPlayState = 'paused';
        });
        
        marqueeContent.addEventListener('mouseleave', () => {
            marqueeContent.style.animationPlayState = 'running';
        });
    }
    
    setupMarquee();
    
    // Animate stat numbers
    var statsAnimated = false;
    
    function animateStats() {
        $('.stat-number').each(function() {
            var $this = $(this);
            var countTo = $this.attr('data-count');
            
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        });
    }
    
    // Function to check if element is in viewport
    function isInViewport(element) {
        if (!element.length) return false;
        
        var elementTop = element.offset().top;
        var elementBottom = elementTop + element.outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        
        return elementBottom > viewportTop && elementTop < viewportBottom;
    }
    
    // Initialize stats animation when visible
    $(window).scroll(function() {
        if (!statsAnimated && isInViewport($('.stats-section'))) {
            animateStats();
            statsAnimated = true;
        }
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Language Switcher
    $('#languageSwitcherBtn').click(function() {
        $('#languageOptions').toggleClass('active');
    });
    
    // Close language switcher when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.language-switcher-floating').length) {
            $('#languageOptions').removeClass('active');
        }
    });
    
    // Trigger scroll event to check if stats section is already visible
    $(window).trigger('scroll');
});

// Add structured data for BreadcrumbList
var breadcrumbSchema = {
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "<?php echo $isRtl ? 'صفحه اصلی' : 'Home'; ?>",
    "item": "<?php echo $canonical_url; ?>"
  }]
};

// Add this data to the page
var breadcrumbScript = document.createElement('script');
breadcrumbScript.type = 'application/ld+json';
breadcrumbScript.textContent = JSON.stringify(breadcrumbSchema);
document.head.appendChild(breadcrumbScript);
</script>
</body>
</html>
<?php
// Close the database connection at the end of the file
try {
    if (isset($db) && $db) {
        closeDB($db);
    }
} catch (Exception $e) {
    // Log error silently
}
?>