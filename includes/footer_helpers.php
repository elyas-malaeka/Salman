<?php
/**
 * Footer Helper Functions for Salman Educational Complex
 * 
 * Enhanced helper functions to retrieve footer content from database
 * Uses core_config for common data and footer tables for specific content
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

/**
 * Get core config value
 * 
 * @param string $config_key The config key to retrieve
 * @return string The config value or empty string
 */
function getCoreConfig($config_key) {
    global $db;
    
    // Sanitize inputs
    $config_key = mysqli_real_escape_string($db, $config_key);
    
    // Query the database
    $query = "SELECT config_value FROM core_config 
              WHERE config_key = '{$config_key}' 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['config_value'];
    }
    
    return "";
}

/**
 * Get site name based on language
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return string The site name in the specified language
 */
function getSiteName($lang = null) {
    if (!$lang) {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    }
    
    $site_name_keys = [
        'fa' => 'site_name',
        'en' => 'site_name_en',
        'ar' => 'site_name_ar'
    ];
    
    $key = isset($site_name_keys[$lang]) ? $site_name_keys[$lang] : 'site_name';
    return getCoreConfig($key);
}

/**
 * Get site description based on language
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return string The site description in the specified language
 */
function getSiteDescription($lang = null) {
    if (!$lang) {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    }
    
    $site_desc_keys = [
        'fa' => 'site_description',
        'en' => 'site_description_en',
        'ar' => 'site_description_ar'
    ];
    
    $key = isset($site_desc_keys[$lang]) ? $site_desc_keys[$lang] : 'site_description';
    return getCoreConfig($key);
}

/**
 * Get footer content from database
 * Checks both temp_footer tables for the content
 * 
 * @param string $field_key The field key to retrieve
 * @param string $lang Language code (fa, en, ar)
 * @return string The content
 */
function getFooterContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    }
    
    // Special cases for fields that should be fetched from elsewhere
    if ($field_key == 'site_name') {
        return getSiteName($lang);
    } else if ($field_key == 'school_description') {
        return getSiteDescription($lang);
    } else if ($field_key == 'logo_path_ltr' || $field_key == 'logo_path_rtl') {
        return getCoreConfig('logo_dark_path');
    }
    
    // Sanitize inputs
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    // Query the temp_footer tables
    $query = "SELECT tft.content_value 
              FROM temp_footer_content tfc 
              JOIN temp_footer_translations tft ON tfc.content_id = tft.content_id 
              WHERE tfc.field_key = '{$field_key}' 
              AND tft.language_id = '{$lang}' 
              AND tfc.is_active = 1 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content_value'];
    }
    
    // Fallback to default values if not found in database
    $defaults = [
        // English defaults
        'en' => [
            'subscribe_button' => 'Subscribe',
            'email_placeholder' => 'Enter your email',
            'quick_links_title' => 'Quick Links',
            'educational_levels_title' => 'Educational Levels',
            'instagram_title' => 'Follow on Instagram',
            'back_to_top' => 'Back to top',
            'close_button' => 'Close',
            'copyright_text' => 'All Rights Reserved | Salman Educational Complex',
            'copyright_year_suffix' => '© {year}'
        ],
        // Farsi defaults
        'fa' => [
            'subscribe_button' => 'اشتراک',
            'email_placeholder' => 'ایمیل خود را وارد کنید',
            'quick_links_title' => 'لینک‌های سریع',
            'educational_levels_title' => 'مقاطع تحصیلی',
            'instagram_title' => 'ما را در اینستاگرام دنبال کنید',
            'back_to_top' => 'بازگشت به بالا',
            'close_button' => 'بستن',
            'copyright_text' => 'تمامی حقوق محفوظ است | مجتمع آموزشی سلمان',
            'copyright_year_suffix' => '© {year}'
        ],
        // Arabic defaults
        'ar' => [
            'subscribe_button' => 'اشتراك',
            'email_placeholder' => 'أدخل بريدك الإلكتروني',
            'quick_links_title' => 'روابط سريعة',
            'educational_levels_title' => 'المستويات التعليمية',
            'instagram_title' => 'تابعنا على انستغرام',
            'back_to_top' => 'العودة إلى الأعلى',
            'close_button' => 'إغلاق',
            'copyright_text' => 'جميع الحقوق محفوظة | مجمع سلمان التعليمي',
            'copyright_year_suffix' => '© {year}'
        ]
    ];
    
    // Return the default value if available
    if (isset($defaults[$lang][$field_key])) {
        return $defaults[$lang][$field_key];
    }
    
    return "";
}

/**
 * Get complete copyright text with year
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return string Complete copyright text with year
 */
function getCopyrightText($lang = null) {
    $site_name = getSiteName($lang);
    $year_suffix = getFooterContent('copyright_year_suffix', $lang);
    
    // Replace {year} placeholder with current year
    $year_suffix = str_replace('{year}', date('Y'), $year_suffix);
    
    // Use appropriate text based on language
    if ($lang == 'fa') {
        return "تمامی حقوق محفوظ است | {$site_name} {$year_suffix}";
    } else if ($lang == 'ar') {
        return "جميع الحقوق محفوظة | {$site_name} {$year_suffix}";
    } else {
        return "All Rights Reserved | {$site_name} {$year_suffix}";
    }
}

/**
 * Get footer links (quick links, educational_levels links, etc.)
 * 
 * @param string $section_id Section identifier (quick_links, educational_levels)
 * @param string $lang Language code
 * @return array Array of links with titles and URLs
 */
function getFooterLinks($section_id, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    }
    
    // Sanitize inputs
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    // Handle special case for educational_levels section
    if ($section_id == 'curriculum_links') {
        $section_id = 'educational_levels';
    }
    
    // Query the database
    $query = "SELECT tft.content_value 
              FROM temp_footer_content tfc 
              JOIN temp_footer_translations tft ON tfc.content_id = tft.content_id 
              WHERE tfc.section_id = '{$section_id}' 
              AND tft.language_id = '{$lang}' 
              AND tfc.is_repeatable = 1 
              AND tfc.is_active = 1 
              ORDER BY tfc.sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $links = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $links[] = json_decode($row['content_value'], true);
        }
    }
    
    // If no links found in the database, use default values
    if (empty($links)) {
        if ($section_id == 'quick_links') {
            if ($lang == 'fa') {
                $links = [
                    ['title' => 'تماس با ما', 'url' => 'contact.php'],
                    ['title' => 'وبلاگ و اخبار', 'url' => 'blog.php'],
                    ['title' => 'امکانات', 'url' => 'Facilities.php'],
                    ['title' => 'سوالات متداول', 'url' => 'faq.php'],
                    ['title' => 'حریم خصوصی', 'url' => 'Privacy Policy.php']
                ];
            } else if ($lang == 'ar') {
                $links = [
                    ['title' => 'اتصل بنا', 'url' => 'contact.php'],
                    ['title' => 'المدونة والأخبار', 'url' => 'blog.php'],
                    ['title' => 'المرافق', 'url' => 'Facilities.php'],
                    ['title' => 'الأسئلة الشائعة', 'url' => 'faq.php'],
                    ['title' => 'سياسة الخصوصية', 'url' => 'Privacy Policy.php']
                ];
            } else {
                $links = [
                    ['title' => 'Contact Us', 'url' => 'contact.php'],
                    ['title' => 'Blog & News', 'url' => 'blog.php'],
                    ['title' => 'Facilities', 'url' => 'Facilities.php'],
                    ['title' => 'FAQ', 'url' => 'faq.php'],
                    ['title' => 'Privacy Policy', 'url' => 'Privacy Policy.php']
                ];
            }
        } else if ($section_id == 'educational_levels') {
            if ($lang == 'fa') {
                $links = [
                    ['title' => 'بخش احسان', 'url' => 'educational-levels.php#ehsan-section'],
                    ['title' => 'دبستان', 'url' => 'educational-levels.php#primary-school'],
                    ['title' => 'متوسطه اول', 'url' => 'educational-levels.php#middle-school'],
                    ['title' => 'متوسطه دوم', 'url' => 'educational-levels.php#high-school']
                ];
            } else if ($lang == 'ar') {
                $links = [
                    ['title' => 'قسم إحسان', 'url' => 'educational-levels.php#ehsan-section'],
                    ['title' => 'المدرسة الابتدائية', 'url' => 'educational-levels.php#primary-school'],
                    ['title' => 'المدرسة المتوسطة', 'url' => 'educational-levels.php#middle-school'],
                    ['title' => 'المدرسة الثانوية', 'url' => 'educational-levels.php#high-school']
                ];
            } else {
                $links = [
                    ['title' => 'Ehsan Section', 'url' => 'educational-levels.php#ehsan-section'],
                    ['title' => 'Primary School', 'url' => 'educational-levels.php#primary-school'],
                    ['title' => 'Middle School', 'url' => 'educational-levels.php#middle-school'],
                    ['title' => 'High School', 'url' => 'educational-levels.php#high-school']
                ];
            }
        }
    }
    
    return $links;
}

/**
 * Get social media links from core_config
 * 
 * @return array Array of social media links
 */
function getSocialLinks() {
    // Get social links from core_config
    $socialLinks = [];
    
    // Instagram
    $instagram = getCoreConfig('social_instagram');
    if (!empty($instagram)) {
        $socialLinks[] = ['name' => 'Instagram', 'icon' => 'instagram', 'url' => $instagram];
    }
    
    // YouTube
    $youtube = getCoreConfig('social_youtube');
    if (!empty($youtube)) {
        $socialLinks[] = ['name' => 'YouTube', 'icon' => 'youtube', 'url' => $youtube];
    }
    
    // WhatsApp
    $whatsapp = getCoreConfig('social_whatsapp');
    if (!empty($whatsapp)) {
        $socialLinks[] = ['name' => 'WhatsApp', 'icon' => 'whatsapp', 'url' => $whatsapp];
    }
    
    // Telegram
    $telegram = getCoreConfig('social_telegram');
    if (!empty($telegram)) {
        $socialLinks[] = ['name' => 'Telegram', 'icon' => 'telegram', 'url' => $telegram];
    }
    
    // LinkedIn
    $linkedin = getCoreConfig('social_linkedin');
    if (!empty($linkedin)) {
        $socialLinks[] = ['name' => 'LinkedIn', 'icon' => 'linkedin', 'url' => $linkedin];
    }
    
    // Default social links if none found in database
    if (empty($socialLinks)) {
        $socialLinks = [
            ['name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/ir.salmanfarsi/'],
            ['name' => 'YouTube', 'icon' => 'youtube', 'url' => 'https://www.youtube.com/@salmanfarsiiranianschool73/videos'],
            ['name' => 'WhatsApp', 'icon' => 'whatsapp', 'url' => 'https://wa.me/97142988116']
        ];
    }
    
    return $socialLinks;
}

/**
 * Get Instagram posts
 * 
 * @param string $lang Language code
 * @return array Array of Instagram posts
 */
function getInstagramPosts($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    }
    
    // Sanitize input
    $lang = mysqli_real_escape_string($db, $lang);
    
    // Try to get from database
    $query = "SELECT tfc.image_path, tft.content_value 
              FROM temp_footer_content tfc 
              JOIN temp_footer_translations tft ON tfc.content_id = tft.content_id 
              WHERE tfc.section_id = 'instagram_posts' 
              AND tft.language_id = '{$lang}' 
              AND tfc.is_repeatable = 1 
              AND tfc.is_active = 1 
              ORDER BY tfc.sort_order ASC 
              LIMIT 4";
              
    $result = mysqli_query($db, $query);
    $posts = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content = json_decode($row['content_value'], true);
            $posts[] = [
                'image' => $row['image_path'],
                'link' => $content['link']
            ];
        }
    }
    
    // Default Instagram posts if none found in database
    if (empty($posts)) {
        $posts = [
            [
                'image' => 'assets/images/instagram/post1.jpg',
                'link' => 'https://www.instagram.com/ir.salmanfarsi/reel/DGxEgQRSYSO/'
            ],
            [
                'image' => 'assets/images/instagram/post2.jpg',
                'link' => 'https://www.instagram.com/ir.salmanfarsi/reel/DG0vtmpvZgA/'
            ],
            [
                'image' => 'assets/images/instagram/post3.jpg',
                'link' => 'https://www.instagram.com/ir.salmanfarsi/reel/DGXmpk-yCs9/'
            ],
            [
                'image' => 'assets/images/instagram/post4.jpg',
                'link' => 'https://www.instagram.com/p/DGua6ipPWj7/'
            ]
        ];
    }
    
    return $posts;
}