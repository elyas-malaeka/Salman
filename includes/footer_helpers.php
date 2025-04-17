<?php
/**
 * Footer Helper Functions for Salman Educational Complex
 * 
 * Simple helper functions to retrieve footer content from database
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

/**
 * Get footer content from database
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
    
    // Sanitize inputs
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    // Query the database
    $query = "SELECT content FROM footer_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    
    // Fallback to default values if not found in database
    $defaults = [
        // English defaults
        'en' => [
            'site_name' => 'Salman Educational Complex',
            'school_description' => 'Salman Educational Complex aims to provide quality education in a safe and dynamic environment, preparing students for success in today\'s and tomorrow\'s world.',
            'copyright_text' => 'All Rights Reserved | Salman Educational Complex',
            'subscribe_button' => 'Subscribe',
            'email_placeholder' => 'Enter your email',
            'quick_links_title' => 'Quick Links',
            'curriculum_title' => 'Curriculum',
            'instagram_title' => 'Follow on Instagram',
            'back_to_top' => 'Back to top',
            'close_button' => 'Close',
            'logo_path_ltr' => 'assets/images/logo-dark.png',
            'logo_path_rtl' => 'assets/images/logo-dark.png'
        ],
        // Farsi defaults
        'fa' => [
            'site_name' => 'مجتمع آموزشی سلمان',
            'school_description' => 'مجتمع آموزشی سلمان با هدف ارائه آموزش با کیفیت در محیطی امن و پویا، دانش‌آموزان را برای موفقیت در دنیای امروز و فردا آماده می‌کند.',
            'copyright_text' => 'تمامی حقوق محفوظ است | مجتمع آموزشی سلمان',
            'subscribe_button' => 'اشتراک',
            'email_placeholder' => 'ایمیل خود را وارد کنید',
            'quick_links_title' => 'لینک‌های سریع',
            'curriculum_title' => 'برنامه درسی',
            'instagram_title' => 'ما را در اینستاگرام دنبال کنید',
            'back_to_top' => 'بازگشت به بالا',
            'close_button' => 'بستن',
            'logo_path_ltr' => 'assets/images/farsi-logo.png',
            'logo_path_rtl' => 'assets/images/farsi-logo.png'
        ],
        // Arabic defaults
        'ar' => [
            'site_name' => 'مجمع سلمان التعليمي',
            'school_description' => 'يهدف مجمع سلمان التعليمي إلى توفير تعليم عالي الجودة في بيئة آمنة وديناميكية، ويعد الطلاب للنجاح في عالم اليوم والغد.',
            'copyright_text' => 'جميع الحقوق محفوظة | مجمع سلمان التعليمي',
            'subscribe_button' => 'اشتراك',
            'email_placeholder' => 'أدخل بريدك الإلكتروني',
            'quick_links_title' => 'روابط سريعة',
            'curriculum_title' => 'المناهج الدراسية',
            'instagram_title' => 'تابعنا على انستغرام',
            'back_to_top' => 'العودة إلى الأعلى',
            'close_button' => 'إغلاق',
            'logo_path_ltr' => 'assets/images/farsi-logo.png',
            'logo_path_rtl' => 'assets/images/farsi-logo.png'
        ]
    ];
    
    // Return the default value if available
    if (isset($defaults[$lang][$field_key])) {
        return $defaults[$lang][$field_key];
    }
    
    return "";
}

/**
 * Get footer links (quick links, curriculum links, etc.)
 * 
 * @param string $section_id Section identifier (quick_links, curriculum_links)
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
    
    // Query the database
    $query = "SELECT content FROM footer_content 
              WHERE section_id = '{$section_id}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $links = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $links[] = json_decode($row['content'], true);
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
        } else if ($section_id == 'curriculum_links') {
            if ($lang == 'fa') {
                $links = [
                    ['title' => 'بخش احسان', 'url' => 'Curriculum.php#ehsan-section'],
                    ['title' => 'دبستان', 'url' => 'Curriculum.php#primary-school'],
                    ['title' => 'متوسطه اول', 'url' => 'Curriculum.php#middle-school'],
                    ['title' => 'متوسطه دوم', 'url' => 'Curriculum.php#high-school']
                ];
            } else if ($lang == 'ar') {
                $links = [
                    ['title' => 'قسم إحسان', 'url' => 'Curriculum.php#ehsan-section'],
                    ['title' => 'المدرسة الابتدائية', 'url' => 'Curriculum.php#primary-school'],
                    ['title' => 'المدرسة المتوسطة', 'url' => 'Curriculum.php#middle-school'],
                    ['title' => 'المدرسة الثانوية', 'url' => 'Curriculum.php#high-school']
                ];
            } else {
                $links = [
                    ['title' => 'Ehsan Section', 'url' => 'Curriculum.php#ehsan-section'],
                    ['title' => 'Primary School', 'url' => 'Curriculum.php#primary-school'],
                    ['title' => 'Middle School', 'url' => 'Curriculum.php#middle-school'],
                    ['title' => 'High School', 'url' => 'Curriculum.php#high-school']
                ];
            }
        }
    }
    
    return $links;
}

/**
 * Get social media links
 * 
 * @param string $lang Language code
 * @return array Array of social media links
 */
function getSocialLinks($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
    }
    
    // Sanitize input
    $lang = mysqli_real_escape_string($db, $lang);
    
    // Query the database
    $query = "SELECT content FROM footer_content 
              WHERE section_id = 'social_links' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $socialLinks = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $socialLinks[] = json_decode($row['content'], true);
        }
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
    
    // Try to get from database
    $query = "SELECT content FROM footer_content 
              WHERE section_id = 'instagram_posts' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC 
              LIMIT 4";
              
    $result = mysqli_query($db, $query);
    $posts = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = json_decode($row['content'], true);
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