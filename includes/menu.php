<?php
    /**
     * Enhanced Light Mode Navigation System
     * Mobile-Optimized, Conflict-Free, Performance-Optimized
     * 
     * @package Salman Educational Complex
     * @version 15.0 - Light Mode Mobile Edition
     * @author Advanced Development Team
     */

    require_once 'includes/config.php';

    // Performance optimization: Cache database queries
    class NavigationCache {
        private static $cache = [];
        
        public static function get($key) {
            return isset(self::$cache[$key]) ? self::$cache[$key] : null;
        }
        
        public static function set($key, $value) {
            self::$cache[$key] = $value;
        }
    }

    // Get current language with fallback
    $lang = getCurrentLanguage() ?? 'fa';
    $isRtl = in_array($lang, ['fa', 'ar']);
    $dir = $isRtl ? 'rtl' : 'ltr';

    // Global database connection with error handling
    global $db;

    // Optimized default menu function
    function getDefaultMenuItems($language = 'fa') {
        $menus = [
            'fa' => [
                ['id' => 1, 'title' => 'صفحه اصلی', 'url' => 'index.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 2, 'title' => 'درباره ما', 'url' => 'about.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 3, 'title' => 'برنامه‌های آموزشی', 'url' => 'curriculum.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 4, 'title' => 'تماس با ما', 'url' => 'contact.php', 'parent_id' => null, 'has_children' => false],
            ],
            'en' => [
                ['id' => 1, 'title' => 'Home', 'url' => 'index.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 2, 'title' => 'About Us', 'url' => 'about.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 3, 'title' => 'Curriculum', 'url' => 'curriculum.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 4, 'title' => 'Contact Us', 'url' => 'contact.php', 'parent_id' => null, 'has_children' => false],
            ],
            'ar' => [
                ['id' => 1, 'title' => 'الصفحة الرئيسية', 'url' => 'index.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 2, 'title' => 'من نحن', 'url' => 'about.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 3, 'title' => 'المناهج', 'url' => 'curriculum.php', 'parent_id' => null, 'has_children' => false],
                ['id' => 4, 'title' => 'اتصل بنا', 'url' => 'contact.php', 'parent_id' => null, 'has_children' => false],
            ]
        ];
        
        return $menus[$language] ?? $menus['fa'];
    }

    // Enhanced database connection checker
    function isDatabaseConnected($db) {
        return $db && ($db instanceof mysqli) && @mysqli_ping($db);
    }

    // Optimized menu retrieval with caching
    function getMainMenuItems($db = null, $language = 'fa') {
        $cacheKey = "main_menu_{$language}";
        $cached = NavigationCache::get($cacheKey);
        
        if ($cached !== null) {
            return $cached;
        }
        
        if (!isDatabaseConnected($db)) {
            $items = getDefaultMenuItems($language);
            NavigationCache::set($cacheKey, $items);
            return $items;
        }
        
        $language = mysqli_real_escape_string($db, $language);
        $query = "SELECT * FROM menu_items 
                WHERE parent_id IS NULL 
                AND language_id = '{$language}' 
                AND is_active = 1 
                ORDER BY `order` ASC";
        
        $result = mysqli_query($db, $query);
        $items = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['has_children'] = hasSubmenuItems($db, $row['id'], $language);
                $items[] = $row;
            }
        } else {
            $items = getDefaultMenuItems($language);
        }
        
        NavigationCache::set($cacheKey, $items);
        return $items;
    }

    function getSubmenuItems($db, $parent_id, $language) {
        if (!isDatabaseConnected($db)) return [];
        
        $cacheKey = "submenu_{$parent_id}_{$language}";
        $cached = NavigationCache::get($cacheKey);
        
        if ($cached !== null) {
            return $cached;
        }
        
        $parent_id = (int)$parent_id;
        $language = mysqli_real_escape_string($db, $language);
        $query = "SELECT * FROM menu_items 
                WHERE parent_id = {$parent_id} 
                AND language_id = '{$language}' 
                AND is_active = 1 
                ORDER BY `order` ASC";
                
        $result = mysqli_query($db, $query);
        $items = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['has_children'] = hasSubmenuItems($db, $row['id'], $language);
                $items[] = $row;
            }
        }
        
        NavigationCache::set($cacheKey, $items);
        return $items;
    }

    function hasSubmenuItems($db, $parent_id, $language) {
        if (!isDatabaseConnected($db)) return false;
        
        $parent_id = (int)$parent_id;
        $language = mysqli_real_escape_string($db, $language);
        
        $query = "SELECT COUNT(*) as count FROM menu_items 
                WHERE parent_id = {$parent_id} 
                AND language_id = '{$language}' 
                AND is_active = 1";
                
        $result = mysqli_query($db, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['count'] > 0;
        }
        
        return false;
    }

    // Enhanced social media links function
    function getSocialMediaLinksFromConfig($db) {
        if (!isDatabaseConnected($db)) return [];
        
        $cacheKey = "social_media_links";
        $cached = NavigationCache::get($cacheKey);
        
        if ($cached !== null) {
            return $cached;
        }
        
        $query = "SELECT config_key, config_value FROM core_config 
                WHERE config_group = 'social' 
                AND config_value != '' 
                ORDER BY id ASC";
                
        $result = mysqli_query($db, $query);
        $items = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            $iconMapping = [
                'social_instagram' => 'fab fa-instagram',
                'social_telegram' => 'fab fa-telegram-plane',
                'social_whatsapp' => 'fab fa-whatsapp',
                'social_youtube' => 'fab fa-youtube',
                'social_linkedin' => 'fab fa-linkedin-in',
                'social_facebook' => 'fab fa-facebook-f',
                'social_twitter' => 'fab fa-twitter'
            ];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $platform = $row['config_key'];
                $url = $row['config_value'];
                
                if (!empty($url)) {
                    $items[] = [
                        'url' => $url,
                        'icon_class' => $iconMapping[$platform] ?? 'fas fa-link',
                        'platform' => str_replace('social_', '', $platform)
                    ];
                }
            }
        }
        
        NavigationCache::set($cacheKey, $items);
        return $items;
    }

    // Enhanced contact info function
    function getContactInfoFromConfig($db, $language = 'fa') {
        if (!isDatabaseConnected($db)) return [];
        
        $cacheKey = "contact_info_{$language}";
        $cached = NavigationCache::get($cacheKey);
        
        if ($cached !== null) {
            return $cached;
        }
        
        $items = [];
        
        // Get contact email
        $query = "SELECT config_value FROM core_config WHERE config_key = 'contact_email' LIMIT 1";
        $result = mysqli_query($db, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $items['email'] = [
                'type' => 'email',
                'value' => $row['config_value'],
                'icon_class' => 'fas fa-envelope'
            ];
        }
        
        // Get contact phone
        $query = "SELECT config_value FROM core_config WHERE config_key = 'contact_phone' LIMIT 1";
        $result = mysqli_query($db, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $items['phone'] = [
                'type' => 'phone',
                'value' => $row['config_value'],
                'icon_class' => 'fas fa-phone-alt'
            ];
        }
        
        NavigationCache::set($cacheKey, $items);
        return $items;
    }

    // Enhanced config setting function
    function getConfigSetting($db, $key) {
        if (!isDatabaseConnected($db)) return '';
        
        $cacheKey = "config_{$key}";
        $cached = NavigationCache::get($cacheKey);
        
        if ($cached !== null) {
            return $cached;
        }
        
        $key = mysqli_real_escape_string($db, $key);
        $query = "SELECT config_value FROM core_config 
                WHERE config_key = '{$key}' 
                LIMIT 1";
                
        $result = mysqli_query($db, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $value = $row['config_value'];
            NavigationCache::set($cacheKey, $value);
            return $value;
        }
        
        return '';
    }

    // Legacy compatibility functions
    function getSocialMediaLinks($db) {
        try {
            $query = "SELECT * FROM social_media 
                    WHERE is_active = 1 
                    ORDER BY `order` ASC";
            $result = mysqli_query($db, $query);
            $items = [];
            
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $items[] = $row;
                }
            }
            
            return $items;
        } catch (Exception $e) {
            return getSocialMediaLinksFromConfig($db);
        }
    }

    function getContactInfo($db, $language) {
        $items = getContactInfoFromConfig($db, $language);
        
        if (empty($items)) {
            try {
                $language = mysqli_real_escape_string($db, $language);
                $query = "SELECT * FROM contact_info 
                        WHERE language_id = '{$language}' 
                        AND is_active = 1";
                $result = mysqli_query($db, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $items[$row['type']] = $row;
                    }
                }
            } catch (Exception $e) {
                return [];
            }
        }
        
        return $items;
    }

    function getSetting($db, $key) {
        $value = getConfigSetting($db, $key);
        
        if (empty($value)) {
            try {
                $key = mysqli_real_escape_string($db, $key);
                $query = "SELECT value FROM site_settings 
                        WHERE `key` = '{$key}' 
                        LIMIT 1";
                $result = mysqli_query($db, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    return $row['value'];
                }
            } catch (Exception $e) {
                return '';
            }
        }
        
        return $value;
    }

    // Get data from database with error handling
    try {
        $mainMenuItems = getMainMenuItems($db, $lang);
        $socialMediaLinks = getSocialMediaLinksFromConfig($db);
        $contactInfo = getContactInfoFromConfig($db, $lang);
    } catch (Exception $e) {
        $mainMenuItems = getDefaultMenuItems($lang);
        $socialMediaLinks = [];
        $contactInfo = [];
    }

    // Get site settings with fallbacks
    $siteName = getConfigSetting($db, "site_name_{$lang}") ?: 
            getConfigSetting($db, "site_name") ?: 
            'Salman Farsi Educational Complex';

    $logoDarkPath = getConfigSetting($db, 'logo_dark_path') ?: 'assets/images/logo-dark.png';
    $logoLightPath = getConfigSetting($db, 'logo_light_path') ?: 'assets/images/logo-light.png';

    // Apply Now button settings
    $applyNowText = $lang == 'fa' ? 'ثبت‌نام' : ($lang == 'ar' ? 'سجل الآن' : 'Apply Now');
    $applyNowUrl = 'Terms-and-Conditions-for-Registration.php';

    // Generate unique namespace ID for CSS isolation
    $navId = 'salman_nav_' . substr(md5(__FILE__), 0, 8);
?>

<!-- Light Mode Navigation System - Mobile Optimized -->
<style id="<?php echo $navId; ?>_styles">
    /* CSS NAMESPACE: <?php echo $navId; ?> - Light Mode Only */
    #<?php echo $navId; ?> {
        /* Light Mode Color Scheme */
        --sn-primary: #6461FC;
        --sn-secondary: #FF7A1A;
        --sn-accent: #7854f7;
        --sn-light: #ffffff;
        --sn-dark: #333333;
        --sn-gray: #f8f9fa;
        --sn-light-gray: #e9ecef;
        --sn-border: #dee2e6;
        --sn-text: #495057;
        --sn-text-light: #6c757d;
        --sn-radius: 12px;
        --sn-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        --sn-shadow-lg: 0 8px 30px rgba(0, 0, 0, 0.15);
        --sn-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        --sn-z-base: 1000;
        --sn-z-dropdown: 1050;
        --sn-z-mobile: 9990;
        --sn-z-overlay: 9999;
        
        /* Reset and base styles */
        position: relative;
        width: 100%;
        z-index: var(--sn-z-base);
        font-family: inherit;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Reset all nested elements */
    #<?php echo $navId; ?> *,
    #<?php echo $navId; ?> *::before,
    #<?php echo $navId; ?> *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Main Header Container */
    #<?php echo $navId; ?> .sn-header {
        position: absolute;
        width: 100%;
        left: 0;
        top: 0;
        z-index: var(--sn-z-base);
    }

    #<?php echo $navId; ?> .sn-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }

    /* Topbar Styles - Light */
    #<?php echo $navId; ?> .sn-topbar {
        padding: 12px 0;
        background: linear-gradient(135deg, var(--sn-primary) 0%, var(--sn-accent) 100%);
        color: var(--sn-light);
    }

    #<?php echo $navId; ?> .sn-topbar__inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }
    

    #<?php echo $navId; ?> .sn-topbar__contact {
        display: flex;
        gap: 25px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #<?php echo $navId; ?> .sn-topbar__contact-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    #<?php echo $navId; ?> .sn-topbar__contact-item a {
        color: var(--sn-light);
        text-decoration: none;
        transition: var(--sn-transition);
        font-size: 15px;
    }

    #<?php echo $navId; ?> .sn-topbar__contact-item a:hover {
        color: var(--orange);
    }

    #<?php echo $navId; ?> .sn-topbar__contact-item i {
        margin-right: 5px;
        font-size: 14px;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-topbar__contact-item i {
        margin-right: 0;
        margin-left: 5px;
    }

    /* Social Media Links - Light Mode */
    #<?php echo $navId; ?> .sn-topbar__social {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    #<?php echo $navId; ?> .sn-topbar__social-link {
        display: inline-flex !important;
        width: 32px !important;
        height: 32px !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        border-radius: 50% !important;
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: var(--sn-light) !important;
        transition: var(--sn-transition) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    #<?php echo $navId; ?> .sn-topbar__social-link:hover {
        background-color: var(--orange) !important;
        transform: translateY(-2px) !important;
    }

    #<?php echo $navId; ?> .sn-topbar__social-link i {
        font-size: 16px !important;
        line-height: 1 !important;
        margin: 0 !important;
    }

    /* Main Navigation - Light Mode */
    #<?php echo $navId; ?> .sn-main-nav {
        position: relative;
        padding: 25px 0;
        background-color: transparent;
        z-index: var(--sn-z-base);
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?> .sn-main-nav.sticky {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 15px 0;
        z-index: 99999 !important;
        animation: slideDownNav 0.4s ease-out;
    }

    #<?php echo $navId; ?> .sn-main-nav.sticky .sn-main-nav__inner {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }

    @keyframes slideDownNav {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    #<?php echo $navId; ?> .sn-main-nav__inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: var(--sn-radius);
        padding: 0 30px;
        box-shadow: var(--sn-shadow);
        border: 1px solid var(--sn-border);
        min-height: 80px;
    }

    /* Logo Styles */
    #<?php echo $navId; ?> .sn-logo {
        max-width: 160px;
        padding: 15px 0;
        flex-shrink: 0;
    }

    #<?php echo $navId; ?> .sn-logo img {
        width: 100%;
        height: auto;
        display: block;
        max-height: 50px;
        object-fit: contain;
    }

    /* Menu Styles - Light Mode */
    #<?php echo $navId; ?> .sn-menu {
        display: flex;
        margin: 0;
        padding: 0;
        list-style: none;
        align-items: center;
    }

    #<?php echo $navId; ?> .sn-menu-item {
        position: relative;
        margin: 0 5px;
    }

    #<?php echo $navId; ?> .sn-menu-link {
        display: block;
        padding: 25px 18px;
        color: var(--sn-text);
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        transition: var(--sn-transition);
        white-space: nowrap;
        position: relative;
    }

    #<?php echo $navId; ?> .sn-menu-link:hover,
    #<?php echo $navId; ?> .sn-menu-item.active > .sn-menu-link {
        color: var(--sn-primary);
    }

    /* Enhanced Dropdown Styles - Light Mode */
    #<?php echo $navId; ?> .sn-menu-item.has-dropdown > .sn-menu-link::after {
        content: "\f107";
        font-family: "Font Awesome 5 Free", "FontAwesome";
        font-weight: 900;
        margin-left: 8px;
        transition: var(--sn-transition);
        display: inline-block;
        font-size: 12px;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-menu-item.has-dropdown > .sn-menu-link::after {
        margin-left: 0;
        margin-right: 8px;
    }

    #<?php echo $navId; ?> .sn-menu-item.has-dropdown:hover > .sn-menu-link::after {
        transform: rotate(180deg);
    }

    #<?php echo $navId; ?> .sn-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 240px;
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: var(--sn-radius);
        box-shadow: var(--sn-shadow-lg);
        padding: 15px 0;
        margin: 0;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px) scale(0.95);
        transition: var(--sn-transition);
        z-index: var(--sn-z-dropdown);
        border: 1px solid var(--sn-border);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-dropdown {
        left: auto;
        right: 0;
    }

    #<?php echo $navId; ?> .sn-menu-item:hover > .sn-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
    }

    #<?php echo $navId; ?> .sn-dropdown-item {
        position: relative;
    }

    #<?php echo $navId; ?> .sn-dropdown-link {
        display: block;
        padding: 12px 25px;
        color: var(--sn-text);
        text-decoration: none;
        transition: var(--sn-transition);
        border-left: 3px solid transparent;
        font-size: 14px;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-dropdown-link {
        border-left: none;
        border-right: 3px solid transparent;
    }

    #<?php echo $navId; ?> .sn-dropdown-link:hover {
        background-color: var(--sn-gray);
        color: var(--sn-primary);
        border-left-color: var(--sn-primary);
        padding-left: 30px;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-dropdown-link:hover {
        border-left-color: transparent;
        border-right-color: var(--sn-primary);
        padding-left: 25px;
        padding-right: 30px;
    }

    /* Multi-level dropdown support */
    #<?php echo $navId; ?> .sn-dropdown-item.has-dropdown > .sn-dropdown-link::after {
        content: "\f105";
        font-family: "Font Awesome 5 Free", "FontAwesome";
        font-weight: 900;
        float: right;
        font-size: 12px;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-dropdown-item.has-dropdown > .sn-dropdown-link::after {
        content: "\f104";
        float: left;
    }

    #<?php echo $navId; ?> .sn-dropdown .sn-dropdown {
        top: 0;
        left: 100%;
        margin-left: 2px;
        transform: translateX(15px) scale(0.95);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-dropdown .sn-dropdown {
        left: auto;
        right: 100%;
        margin-left: 0;
        margin-right: 2px;
        transform: translateX(-15px) scale(0.95);
    }

    #<?php echo $navId; ?> .sn-dropdown-item.has-dropdown:hover > .sn-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(0) scale(1);
    }

    /* Navigation Extras - Light Mode */
    #<?php echo $navId; ?> .sn-nav-extras {
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
    }

    #<?php echo $navId; ?> .sn-search-toggle,
    #<?php echo $navId; ?> .sn-lang-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        color: var(--sn-text);
        text-decoration: none;
        cursor: pointer;
        transition: var(--sn-transition);
        background-color: var(--sn-gray);
        border-radius: 50%;
        border: none;
    }

    #<?php echo $navId; ?> .sn-search-toggle:hover,
    #<?php echo $navId; ?> .sn-lang-toggle:hover {
        color: var(--sn-light);
        background-color: var(--sn-primary);
        transform: translateY(-2px);
    }

    #<?php echo $navId; ?> .sn-search-toggle i {
        font-size: 16px;
    }

    #<?php echo $navId; ?> .sn-lang-toggle img {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        object-fit: cover;
    }

    #<?php echo $navId; ?> .sn-nav-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 46px;
        padding: 0 25px;
        background: linear-gradient(135deg, var(--sn-primary) 0%, var(--sn-accent) 100%);
        color: var(--sn-light);
        border-radius: 25px;
        font-weight: 500;
        text-decoration: none;
        transition: var(--sn-transition);
        font-size: 15px;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    #<?php echo $navId; ?> .sn-nav-btn:hover {
        background: linear-gradient(135deg, var(--orange) 0%,rgb(105, 16, 230) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 122, 26, 0.3);
    }

    /* Language Dropdown - Light Mode */
    #<?php echo $navId; ?> .sn-lang-dropdown {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(15px);
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: var(--sn-radius);
        box-shadow: var(--sn-shadow-lg);
        padding: 15px;
        margin-top: 10px;
        min-width: 160px;
        opacity: 0;
        visibility: hidden;
        transition: var(--sn-transition);
        z-index: var(--sn-z-dropdown);
        border: 1px solid var(--sn-border);
    }

    #<?php echo $navId; ?> .sn-lang-toggle:hover + .sn-lang-dropdown,
    #<?php echo $navId; ?> .sn-lang-dropdown:hover {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    #<?php echo $navId; ?> .sn-lang-dropdown::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 8px solid var(--sn-light);
    }

    #<?php echo $navId; ?> .sn-lang-item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: var(--sn-text);
        text-decoration: none;
        border-radius: 8px;
        transition: var(--sn-transition);
        margin-bottom: 8px;
    }

    #<?php echo $navId; ?> .sn-lang-item:last-child {
        margin-bottom: 0;
    }

    #<?php echo $navId; ?> .sn-lang-item:hover {
        background-color: var(--sn-gray);
    }

    #<?php echo $navId; ?> .sn-lang-item.active {
        background-color: var(--sn-primary);
        color: var(--sn-light);
    }

    #<?php echo $navId; ?> .sn-lang-flag {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: cover;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-lang-flag {
        margin-right: 0;
        margin-left: 12px;
    }

    /* Mobile Navigation Styles - Light Mode */
    #<?php echo $navId; ?> .sn-mobile-nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: var(--sn-z-mobile);
        opacity: 0;
        visibility: hidden;
        transition: var(--sn-transition);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
    }

    #<?php echo $navId; ?> .sn-mobile-nav.active {
        opacity: 1;
        visibility: visible;
    }

    #<?php echo $navId; ?> .sn-mobile-container {
        position: fixed;
        top: 0;
        right: -350px;
        width: 350px;
        max-width: 90%;
        height: 100%;
        background: var(--sn-light);
        box-shadow: -10px 0 25px rgba(0, 0, 0, 0.2);
        padding: 30px 0 0;
        overflow-y: auto;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-mobile-container {
        right: auto;
        left: -350px;
    }

    #<?php echo $navId; ?> .sn-mobile-nav.active .sn-mobile-container {
        right: 0;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-mobile-nav.active .sn-mobile-container {
        right: auto;
        left: 0;
    }

    #<?php echo $navId; ?> .sn-mobile-header {
        padding: 0 30px;
        margin-bottom: 30px;
        position: relative;
        border-bottom: 1px solid var(--sn-border);
        padding-bottom: 20px;
    }

    #<?php echo $navId; ?> .sn-mobile-close {
        position: absolute;
        top: 0;
        right: 30px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sn-gray);
        border-radius: 50%;
        color: var(--sn-text);
        border: none;
        font-size: 16px;
        cursor: pointer;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-mobile-close {
        right: auto;
        left: 30px;
    }

    #<?php echo $navId; ?> .sn-mobile-close:hover {
        background-color: var(--orange);
        color: var(--sn-light);
        transform: scale(1.1);
    }

    #<?php echo $navId; ?> .sn-mobile-logo {
        max-width: 140px;
    }

    #<?php echo $navId; ?> .sn-mobile-logo img {
        width: 100%;
        height: auto;
        max-height: 40px;
        object-fit: contain;
    }

    /* Mobile Menu - Light Mode */
    #<?php echo $navId; ?> .sn-mobile-menu {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #<?php echo $navId; ?> .sn-mobile-item {
        position: relative;
        margin-bottom: 2px;
        border-left: 3px solid transparent;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-mobile-item {
        border-left: none;
        border-right: 3px solid transparent;
    }

    #<?php echo $navId; ?> .sn-mobile-item.active {
        border-left-color: var(--sn-primary);
        background: var(--sn-gray);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-mobile-item.active {
        border-left-color: transparent;
        border-right-color: var(--sn-primary);
    }

    #<?php echo $navId; ?> .sn-mobile-link {
        display: block;
        padding: 18px 30px;
        color: var(--sn-text);
        text-decoration: none;
        font-weight: 500;
        transition: var(--sn-transition);
        font-size: 16px;
    }

    #<?php echo $navId; ?> .sn-mobile-link:hover {
        color: var(--sn-primary);
        background-color: var(--sn-gray);
    }

    #<?php echo $navId; ?> .sn-mobile-item.has-dropdown > .sn-mobile-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #<?php echo $navId; ?> .sn-mobile-dropdown-toggle {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sn-gray);
        border-radius: 50%;
        color: var(--sn-text);
        transition: var(--sn-transition);
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    #<?php echo $navId; ?> .sn-mobile-dropdown-toggle.active {
        background-color: var(--sn-primary);
        color: var(--sn-light);
        transform: rotate(180deg);
    }

    #<?php echo $navId; ?> .sn-mobile-dropdown {
        display: none;
        border-left: 1px solid var(--sn-border);
        margin-left: 30px;
        padding-left: 20px;
        list-style: none;
        background-color: var(--sn-gray);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-mobile-dropdown {
        margin-left: 0;
        padding-left: 0;
        margin-right: 30px;
        padding-right: 20px;
        border-left: none;
        border-right: 1px solid var(--sn-border);
    }

    #<?php echo $navId; ?> .sn-mobile-dropdown-link {
        display: block;
        padding: 15px 20px;
        color: var(--sn-text-light);
        text-decoration: none;
        transition: var(--sn-transition);
        font-size: 14px;
    }

    #<?php echo $navId; ?> .sn-mobile-dropdown-link:hover {
        color: var(--sn-primary);
        background-color: var(--sn-light);
    }

    /* Mobile Footer - Light Mode */
    #<?php echo $navId; ?> .sn-mobile-footer {
        background: var(--sn-gray);
        padding: 25px 30px;
        margin-top: 30px;
        border-top: 1px solid var(--sn-border);
    }

    #<?php echo $navId; ?> .sn-mobile-contact {
        margin: 0 0 25px;
        padding: 0;
        list-style: none;
    }

    #<?php echo $navId; ?> .sn-mobile-contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        color: var(--sn-text);
    }

    #<?php echo $navId; ?> .sn-mobile-contact-item i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sn-primary);
        border-radius: 50%;
        color: var(--sn-light);
        font-size: 16px;
    }

    #<?php echo $navId; ?> .sn-mobile-contact-item a {
        color: var(--sn-text);
        text-decoration: none;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?> .sn-mobile-contact-item a:hover {
        color: var(--sn-primary);
    }

    #<?php echo $navId; ?> .sn-mobile-social {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    #<?php echo $navId; ?> .sn-mobile-social-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sn-primary);
        border-radius: 50%;
        color: var(--sn-light);
        text-decoration: none;
        transition: var(--sn-transition);
        font-size: 16px;
    }

    #<?php echo $navId; ?> .sn-mobile-social-link:hover {
        background-color: var(--orange);
        transform: translateY(-2px);
    }

    #<?php echo $navId; ?> .sn-mobile-langs h4 {
        color: var(--sn-text);
        margin-bottom: 15px;
        font-size: 16px;
        font-weight: 600;
    }

    /* Search Overlay - Light Mode */
    #<?php echo $navId; ?> .sn-search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
         background: rgba(255, 255, 255, 0.70) !important;
        z-index: var(--sn-z-overlay);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: var(--sn-transition);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    #<?php echo $navId; ?> .sn-search-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    #<?php echo $navId; ?> .sn-search-close {
        position: absolute;
        top: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sn-gray);
        border-radius: 50%;
        color: var(--sn-text);
        border: none;
        font-size: 20px;
        cursor: pointer;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-search-close {
        right: auto;
        left: 30px;
    }

    #<?php echo $navId; ?> .sn-search-close:hover {
        background-color: var(--orange);
        color: var(--sn-light);
        transform: scale(1.1);
    }

    #<?php echo $navId; ?> .sn-search-form {
        width: 90%;
        max-width: 600px;
        position: relative;
    }

    #<?php echo $navId; ?> .sn-search-input {
        width: 100%;
        height: 70px;
        background-color: transparent;
        border: none;
        border-bottom: 3px solid var(--sn-border);
        color: var(--sn-text);
        font-size: 28px;
        padding: 0 60px 0 0;
        transition: var(--sn-transition);
        font-family: inherit;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-search-input {
        padding: 0 0 0 60px;
    }

    #<?php echo $navId; ?> .sn-search-input:focus {
        outline: none;
        border-color: var(--sn-primary);
    }

    #<?php echo $navId; ?> .sn-search-input::placeholder {
        color: var(--sn-text-light);
    }

    #<?php echo $navId; ?> .sn-search-btn {
        position: absolute;
        top: 0;
        right: 0;
        height: 70px;
        background-color: transparent;
        border: none;
        color: var(--sn-text);
        font-size: 24px;
        cursor: pointer;
        transition: var(--sn-transition);
        width: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-search-btn {
        right: auto;
        left: 0;
    }

    #<?php echo $navId; ?> .sn-search-btn:hover {
        color: var(--sn-primary);
    }

    /* Language Overlay - Light Mode */
    #<?php echo $navId; ?> .sn-lang-overlay {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: var(--sn-light);
        z-index: var(--sn-z-overlay);
        opacity: 0;
        visibility: hidden;
        transition: var(--sn-transition);
        transform: translateY(100%);
        padding: 30px 20px;
        border-radius: 25px 25px 0 0;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
        border-top: 1px solid var(--sn-border);
    }

    #<?php echo $navId; ?> .sn-lang-overlay.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    #<?php echo $navId; ?> .sn-lang-overlay-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sn-gray);
        border-radius: 50%;
        color: var(--sn-text);
        border: none;
        font-size: 18px;
        cursor: pointer;
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-lang-overlay-close {
        right: auto;
        left: 20px;
    }

    #<?php echo $navId; ?> .sn-lang-overlay-close:hover {
        background-color: var(--orange);
        
        color: var(--sn-light);
        transform: scale(1.1);
    }

    #<?php echo $navId; ?> .sn-lang-overlay-header {
        margin-bottom: 25px;
        text-align: center;
    }

    #<?php echo $navId; ?> .sn-lang-overlay-title {
        color: var(--sn-text);
        font-size: 24px;
        margin: 0;
        font-weight: 600;
    }

    #<?php echo $navId; ?> .sn-lang-overlay-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 300px;
        margin: 0 auto;
    }

    #<?php echo $navId; ?> .sn-lang-overlay-item {
        display: flex;
        align-items: center;
        padding: 18px 20px;
        border-radius: 12px;
        background-color: var(--sn-gray);
        color: var(--sn-text);
        text-decoration: none;
        transition: var(--sn-transition);
        border: 1px solid var(--sn-border);
    }

    #<?php echo $navId; ?> .sn-lang-overlay-item.active {
        background-color: var(--sn-primary);
        color: var(--sn-light);
        transform: scale(1.02);
        border-color: var(--sn-primary);
    }

    #<?php echo $navId; ?> .sn-lang-overlay-item:hover {
        background-color: var(--sn-light-gray);
        transform: translateY(-2px);
        box-shadow: var(--sn-shadow);
    }

    #<?php echo $navId; ?> .sn-lang-overlay-flag {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
    }

    #<?php echo $navId; ?>[dir="rtl"] .sn-lang-overlay-flag {
        margin-right: 0;
        margin-left: 15px;
    }

    #<?php echo $navId; ?> .sn-lang-overlay-name {
        font-size: 18px;
        font-weight: 500;
    }

    /* Bottom Mobile Navigation - Always Visible on Mobile */
    #<?php echo $navId; ?> .sn-bottom-nav {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, var(--sn-primary) 0%, var(--sn-accent) 100%);
        border-radius: 30px;
        box-shadow: var(--sn-shadow-lg);
        padding: 12px;
        display: none; /* Hidden by default */
        align-items: center;
        justify-content: center;
        gap: 8px;
        z-index: calc(var(--sn-z-overlay) - 1);
        max-width: 320px;
        width: calc(100% - 40px);
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?> .sn-bottom-nav-item {
        background-color: transparent;
        border: none;
        padding: 0;
        margin: 0;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--sn-light);
        text-decoration: none;
        transition: var(--sn-transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    #<?php echo $navId; ?> .sn-bottom-nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: scale(0);
        transition: var(--sn-transition);
    }

    #<?php echo $navId; ?> .sn-bottom-nav-item:hover::before,
    #<?php echo $navId; ?> .sn-bottom-nav-item.active::before {
        transform: scale(1);
    }

    #<?php echo $navId; ?> .sn-bottom-nav-item:hover,
    #<?php echo $navId; ?> .sn-bottom-nav-item.active {
        transform: translateY(-3px);
    }

    #<?php echo $navId; ?> .sn-bottom-nav-icon {
        font-size: 20px;
        margin-bottom: 4px;
        position: relative;
        z-index: 1;
    }

    #<?php echo $navId; ?> .sn-bottom-nav-text {
        font-size: 10px;
        opacity: 0.9;
        position: relative;
        z-index: 1;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 1199px) {
        #<?php echo $navId; ?> .sn-menu-link {
            padding: 25px 15px;
            font-size: 14px;
        }
        
        #<?php echo $navId; ?> .sn-main-nav__inner {
            padding: 0 25px;
        }
    }

    @media (max-width: 991px) {
        #<?php echo $navId; ?> .sn-menu {
            display: none;
        }
        
        /* Show bottom navigation on mobile */
        #<?php echo $navId; ?> .sn-bottom-nav {
            display: flex !important;
        }

        #<?php echo $navId; ?> .sn-main-nav__inner {
            padding: 0 20px;
            min-height: 70px;
        }
        
        #<?php echo $navId; ?> .sn-logo {
            max-width: 140px;
        }
        
        #<?php echo $navId; ?> .sn-nav-extras {
            gap: 12px;
        }
        
        #<?php echo $navId; ?> .sn-search-toggle,
        #<?php echo $navId; ?> .sn-lang-toggle {
            width: 38px;
            height: 38px;
        }
    }

    @media (max-width: 767px) {
        #<?php echo $navId; ?> .sn-topbar__contact {
            display: none;
        }

        #<?php echo $navId; ?> .sn-topbar__inner {
            justify-content: center;
        }
        
        #<?php echo $navId; ?> .sn-nav-btn {
            display: none;
        }
        
        #<?php echo $navId; ?> .sn-main-nav__inner {
            padding: 0 15px;
        }
        
        #<?php echo $navId; ?> .sn-logo {
            max-width: 120px;
        }
        
        #<?php echo $navId; ?> .sn-search-input {
            font-size: 24px;
            height: 60px;
        }
        
        #<?php echo $navId; ?> .sn-search-btn {
            height: 60px;
            font-size: 20px;
        }
        
        #<?php echo $navId; ?> .sn-mobile-container {
            width: 300px;
        }
    }

    @media (max-width: 575px) {
        #<?php echo $navId; ?> .sn-container {
            padding: 0 15px;
        }
        
        #<?php echo $navId; ?> .sn-topbar {
            padding: 10px 0;
        }
        
        #<?php echo $navId; ?> .sn-main-nav {
            padding: 20px 0;
        }
        
        #<?php echo $navId; ?> .sn-bottom-nav {
            bottom: 15px;
            padding: 10px;
            gap: 6px;
        }
        
        #<?php echo $navId; ?> .sn-bottom-nav-item {
            width: 55px;
            height: 55px;
        }
        
        #<?php echo $navId; ?> .sn-bottom-nav-icon {
            font-size: 18px;
        }
        
        #<?php echo $navId; ?> .sn-bottom-nav-text {
            font-size: 9px;
        }
    }

    /* Performance optimizations */
    #<?php echo $navId; ?> * {
        will-change: auto;
    }
    
    #<?php echo $navId; ?> .sn-dropdown,
    #<?php echo $navId; ?> .sn-mobile-nav,
    #<?php echo $navId; ?> .sn-search-overlay,
    #<?php echo $navId; ?> .sn-lang-overlay {
        will-change: transform, opacity;
    }

    /* Print styles */
    @media print {
        #<?php echo $navId; ?> {
            display: none !important;
        }
    }
</style>

<!-- Light Mode Navigation HTML Structure -->
<div id="<?php echo $navId; ?>" dir="<?php echo $dir; ?>">
    <!-- Main Header -->
    <header class="sn-header">
        <!-- Topbar -->
        <div class="sn-topbar">
            <div class="sn-container">
                <div class="sn-topbar__inner">
                    <!-- Social Media Links -->
                    <div class="sn-topbar__social">
                        <?php foreach ($socialMediaLinks as $social): ?>
                            <a href="<?php echo htmlspecialchars($social['url']); ?>" 
                               class="sn-topbar__social-link" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="<?php echo ucfirst($social['platform']); ?>">
                                <i class="<?php echo htmlspecialchars($social['icon_class']); ?>" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Contact Information -->
                    <ul class="sn-topbar__contact">
                        <?php foreach ($contactInfo as $info): ?>
                            <li class="sn-topbar__contact-item">
                                <i class="<?php echo htmlspecialchars($info['icon_class']); ?>" aria-hidden="true"></i>
                                <?php if ($info['type'] == 'email'): ?>
                                    <a href="mailto:<?php echo htmlspecialchars($info['value']); ?>"><?php echo htmlspecialchars($info['value']); ?></a>
                                <?php elseif ($info['type'] == 'phone'): ?>
                                    <a href="tel:+<?php echo preg_replace('/[^0-9]/', '', $info['value']); ?>"><?php echo htmlspecialchars($info['value']); ?></a>
                                <?php else: ?>
                                    <span><?php echo htmlspecialchars($info['value']); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="sn-main-nav" id="<?php echo $navId; ?>_main_nav" role="navigation" aria-label="Main Navigation">
            <div class="sn-container">
                <div class="sn-main-nav__inner">
                    <!-- Logo -->
                    <a href="index.php" class="sn-logo" aria-label="<?php echo htmlspecialchars($siteName); ?> - Home">
                        <img src="<?php echo htmlspecialchars($logoDarkPath); ?>" 
                             alt="<?php echo htmlspecialchars($siteName); ?>"
                             loading="lazy">
                    </a>

                    <!-- Main Menu -->
                    <ul class="sn-menu" role="menubar">
                        <?php 
                        foreach ($mainMenuItems as $item): 
                            $isActive = basename($_SERVER['PHP_SELF']) == basename($item['url']);
                            $hasDropdown = $item['has_children'];
                        ?>
                            <li class="sn-menu-item <?php echo $isActive ? 'active' : ''; ?> <?php echo $hasDropdown ? 'has-dropdown' : ''; ?>" 
                                role="none">
                                <a href="<?php echo htmlspecialchars($item['url']); ?>" 
                                   class="sn-menu-link"
                                   role="menuitem"
                                   <?php echo $hasDropdown ? 'aria-haspopup="true" aria-expanded="false"' : ''; ?>>
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </a>
                                
                                <?php if ($hasDropdown): 
                                    $submenuItems = getSubmenuItems($db, $item['id'], $lang);
                                ?>
                                    <ul class="sn-dropdown" role="menu" aria-label="<?php echo htmlspecialchars($item['title']); ?> submenu">
                                        <?php foreach ($submenuItems as $subitem): 
                                            $isSubActive = basename($_SERVER['PHP_SELF']) == basename($subitem['url']);
                                            $hasChildren = $subitem['has_children'];
                                        ?>
                                            <li class="sn-dropdown-item <?php echo $isSubActive ? 'active' : ''; ?> <?php echo $hasChildren ? 'has-dropdown' : ''; ?>" 
                                                role="none">
                                                <a href="<?php echo htmlspecialchars($subitem['url']); ?>" 
                                                   class="sn-dropdown-link"
                                                   role="menuitem"
                                                   <?php echo $hasChildren ? 'aria-haspopup="true" aria-expanded="false"' : ''; ?>>
                                                    <?php echo htmlspecialchars($subitem['title']); ?>
                                                </a>
                                                
                                                <?php if ($hasChildren): 
                                                    $childItems = getSubmenuItems($db, $subitem['id'], $lang);
                                                ?>
                                                    <ul class="sn-dropdown" role="menu" aria-label="<?php echo htmlspecialchars($subitem['title']); ?> submenu">
                                                        <?php foreach ($childItems as $childItem): 
                                                            $isChildActive = basename($_SERVER['PHP_SELF']) == basename($childItem['url']);
                                                        ?>
                                                            <li class="sn-dropdown-item <?php echo $isChildActive ? 'active' : ''; ?>" role="none">
                                                                <a href="<?php echo htmlspecialchars($childItem['url']); ?>" 
                                                                   class="sn-dropdown-link"
                                                                   role="menuitem">
                                                                    <?php echo htmlspecialchars($childItem['title']); ?>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Navigation Extras -->
                    <div class="sn-nav-extras">
                        <!-- Search Button -->
                        <button class="sn-search-toggle" 
                                id="<?php echo $navId; ?>_search_toggle"
                                aria-label="Search"
                                type="button">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>

                        <!-- Language Switcher -->
                        <div class="sn-lang-toggle" 
                             id="<?php echo $navId; ?>_lang_toggle"
                             aria-label="Language Switcher"
                             tabindex="0">
                            <img src="assets/images/flags/<?php echo $lang; ?>.png" 
                                 alt="<?php echo $lang == 'fa' ? 'فارسی' : ($lang == 'ar' ? 'العربية' : 'English'); ?>"
                                 loading="lazy">
                        </div>

                        <!-- Language Dropdown -->
                        <div class="sn-lang-dropdown" id="<?php echo $navId; ?>_lang_dropdown">
                            <a href="?lang=en" class="sn-lang-item <?php echo $lang == 'en' ? 'active' : ''; ?>">
                                <img src="assets/images/flags/en.png" alt="" class="sn-lang-flag" loading="lazy">
                                <span>English</span>
                            </a>
                            <a href="?lang=fa" class="sn-lang-item <?php echo $lang == 'fa' ? 'active' : ''; ?>">
                                <img src="assets/images/flags/fa.png" alt="" class="sn-lang-flag" loading="lazy">
                                <span>فارسی</span>
                            </a>
                            <a href="?lang=ar" class="sn-lang-item <?php echo $lang == 'ar' ? 'active' : ''; ?>">
                                <img src="assets/images/flags/ar.png" alt="" class="sn-lang-flag" loading="lazy">
                                <span>العربية</span>
            </a>
                        </div>

                        <!-- Apply Now Button -->
                        <a href="<?php echo htmlspecialchars($applyNowUrl); ?>" 
                           class="sn-nav-btn"
                           aria-label="<?php echo htmlspecialchars($applyNowText); ?>">
                            <?php echo htmlspecialchars($applyNowText); ?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Navigation -->
    <div class="sn-mobile-nav" id="<?php echo $navId; ?>_mobile_nav" role="dialog" aria-modal="true" aria-label="Mobile Navigation">
        <div class="sn-mobile-container">
            <!-- Mobile Header -->
            <div class="sn-mobile-header">
                <!-- Close Button -->
                <button class="sn-mobile-close" 
                        id="<?php echo $navId; ?>_mobile_close"
                        aria-label="Close Navigation"
                        type="button">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>

                <!-- Mobile Logo -->
                <div class="sn-mobile-logo">
                    <img src="<?php echo htmlspecialchars($logoDarkPath); ?>" 
                         alt="<?php echo htmlspecialchars($siteName); ?>"
                         loading="lazy">
                </div>
            </div>

            <!-- Mobile Menu -->
            <ul class="sn-mobile-menu" role="menu">
                <?php foreach ($mainMenuItems as $item): 
                    $isActive = basename($_SERVER['PHP_SELF']) == basename($item['url']);
                    $hasDropdown = $item['has_children'];
                    $dropdownId = $navId . '_dropdown_' . $item['id'];
                ?>
                    <li class="sn-mobile-item <?php echo $isActive ? 'active' : ''; ?> <?php echo $hasDropdown ? 'has-dropdown' : ''; ?>" 
                        role="none">
                        <a href="<?php echo $hasDropdown ? 'javascript:void(0)' : htmlspecialchars($item['url']); ?>" 
                           class="sn-mobile-link"
                           role="menuitem">
                            <?php echo htmlspecialchars($item['title']); ?>
                            <?php if ($hasDropdown): ?>
                                <button class="sn-mobile-dropdown-toggle" 
                                        data-dropdown="<?php echo $dropdownId; ?>"
                                        aria-label="Toggle <?php echo htmlspecialchars($item['title']); ?> submenu"
                                        type="button">
                                    <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                </button>
                            <?php endif; ?>
                        </a>
                        
                        <?php if ($hasDropdown): 
                            $submenuItems = getSubmenuItems($db, $item['id'], $lang);
                        ?>
                            <ul class="sn-mobile-dropdown" 
                                id="<?php echo $dropdownId; ?>"
                                role="menu">
                                <?php foreach ($submenuItems as $subitem): 
                                    $hasChildren = $subitem['has_children'];
                                    $subdropdownId = $navId . '_subdropdown_' . $subitem['id'];
                                ?>
                                    <li class="<?php echo $hasChildren ? 'has-dropdown' : ''; ?>" role="none">
                                        <a href="<?php echo $hasChildren ? 'javascript:void(0)' : htmlspecialchars($subitem['url']); ?>" 
                                           class="sn-mobile-dropdown-link"
                                           role="menuitem">
                                            <?php echo htmlspecialchars($subitem['title']); ?>
                                            <?php if ($hasChildren): ?>
                                                <button class="sn-mobile-dropdown-toggle" 
                                                        data-dropdown="<?php echo $subdropdownId; ?>"
                                                        aria-label="Toggle <?php echo htmlspecialchars($subitem['title']); ?> submenu"
                                                        type="button">
                                                    <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                                </button>
                                            <?php endif; ?>
                                        </a>
                                        
                                        <?php if ($hasChildren): 
                                            $childItems = getSubmenuItems($db, $subitem['id'], $lang);
                                        ?>
                                            <ul class="sn-mobile-dropdown" 
                                                id="<?php echo $subdropdownId; ?>"
                                                role="menu">
                                                <?php foreach ($childItems as $childItem): ?>
                                                    <li role="none">
                                                        <a href="<?php echo htmlspecialchars($childItem['url']); ?>" 
                                                           class="sn-mobile-dropdown-link"
                                                           role="menuitem">
                                                            <?php echo htmlspecialchars($childItem['title']); ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Mobile Footer -->
            <div class="sn-mobile-footer">
                <!-- Mobile Language Switcher -->
                <div class="sn-mobile-langs">
                    <h4>
                        <?php echo $lang == 'fa' ? 'انتخاب زبان:' : ($lang == 'ar' ? 'اختر اللغة:' : 'Select Language:'); ?>
                    </h4>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="?lang=en" 
                           class="sn-mobile-social-link <?php echo $lang == 'en' ? 'active' : ''; ?>" 
                           style="<?php echo $lang == 'en' ? 'background-color: var(--orange);' : ''; ?>"
                           aria-label="Switch to English">
                            <img src="assets/images/flags/en.png" 
                                 alt="English" 
                                 style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;"
                                 loading="lazy">
                        </a>
                        <a href="?lang=fa" 
                           class="sn-mobile-social-link <?php echo $lang == 'fa' ? 'active' : ''; ?>" 
                           style="<?php echo $lang == 'fa' ? 'background-color: var(--orange);' : ''; ?>"
                           aria-label="Switch to Persian">
                            <img src="assets/images/flags/fa.png" 
                                 alt="فارسی" 
                                 style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;"
                                 loading="lazy">
                        </a>
                        <a href="?lang=ar" 
                           class="sn-mobile-social-link <?php echo $lang == 'ar' ? 'active' : ''; ?>" 
                           style="<?php echo $lang == 'ar' ? 'background-color: var(--orange);' : ''; ?>"
                           aria-label="Switch to Arabic">
                            <img src="assets/images/flags/ar.png" 
                                 alt="العربية" 
                                 style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;"
                                 loading="lazy">
                        </a>
                    </div>
                </div>

                <!-- Mobile Contact Info -->
                <ul class="sn-mobile-contact">
                    <?php foreach ($contactInfo as $info): ?>
                        <li class="sn-mobile-contact-item">
                            <i class="<?php echo htmlspecialchars($info['icon_class']); ?>" aria-hidden="true"></i>
                            <?php if ($info['type'] == 'email'): ?>
                                <a href="mailto:<?php echo htmlspecialchars($info['value']); ?>"><?php echo htmlspecialchars($info['value']); ?></a>
                            <?php elseif ($info['type'] == 'phone'): ?>
                                <a href="tel:+<?php echo preg_replace('/[^0-9]/', '', $info['value']); ?>"><?php echo htmlspecialchars($info['value']); ?></a>
                            <?php else: ?>
                                <span><?php echo htmlspecialchars($info['value']); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Mobile Social Links -->
                <div class="sn-mobile-social">
                    <?php foreach ($socialMediaLinks as $social): ?>
                        <a href="<?php echo htmlspecialchars($social['url']); ?>" 
                           class="sn-mobile-social-link" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           aria-label="<?php echo ucfirst($social['platform']); ?>">
                            <i class="<?php echo htmlspecialchars($social['icon_class']); ?>" aria-hidden="true"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="sn-search-overlay" id="<?php echo $navId; ?>_search_overlay" role="dialog" aria-modal="true" aria-label="Search">
        <button class="sn-search-close" 
                id="<?php echo $navId; ?>_search_close"
                aria-label="Close Search"
                type="button">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        <form class="sn-search-form" action="blog.php" method="get" role="search">
            <input type="text" 
                   name="search" 
                   class="sn-search-input" 
                   placeholder="<?php echo $lang == 'fa' ? 'جستجو کنید...' : ($lang == 'ar' ? 'ابحث هنا...' : 'Search Here...'); ?>"
                   aria-label="Search input"
                   autocomplete="off">
            <button type="submit" 
                    class="sn-search-btn"
                    aria-label="Submit search">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <?php if ($lang != 'en'): ?>
                <input type="hidden" name="lang" value="<?php echo $lang; ?>">
            <?php endif; ?>
        </form>
    </div>

    <!-- Language Mobile Overlay -->
    <div class="sn-lang-overlay" id="<?php echo $navId; ?>_lang_overlay" role="dialog" aria-modal="true" aria-label="Language Selection">
        <button class="sn-lang-overlay-close" 
                id="<?php echo $navId; ?>_lang_close"
                aria-label="Close Language Selection"
                type="button">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        <div class="sn-lang-overlay-header">
            <h2 class="sn-lang-overlay-title">
                <?php echo $lang == 'fa' ? 'انتخاب زبان' : ($lang == 'ar' ? 'اختر اللغة' : 'Select Language'); ?>
            </h2>
        </div>
        <div class="sn-lang-overlay-items">
            <a href="?lang=en" class="sn-lang-overlay-item <?php echo $lang == 'en' ? 'active' : ''; ?>">
                <img src="assets/images/flags/en.png" 
                     alt="English" 
                     class="sn-lang-overlay-flag"
                     loading="lazy">
                <span class="sn-lang-overlay-name">English</span>
            </a>
            <a href="?lang=fa" class="sn-lang-overlay-item <?php echo $lang == 'fa' ? 'active' : ''; ?>">
                <img src="assets/images/flags/fa.png" 
                     alt="فارسی" 
                     class="sn-lang-overlay-flag"
                     loading="lazy">
                <span class="sn-lang-overlay-name">فارسی</span>
            </a>
            <a href="?lang=ar" class="sn-lang-overlay-item <?php echo $lang == 'ar' ? 'active' : ''; ?>">
                <img src="assets/images/flags/ar.png" 
                     alt="العربية" 
                     class="sn-lang-overlay-flag"
                     loading="lazy">
                <span class="sn-lang-overlay-name">العربية</span>
            </a>
        </div>
    </div>

    <!-- Bottom Mobile Navigation -->
    <div class="sn-bottom-nav" id="<?php echo $navId; ?>_bottom_nav">
        <a href="index.php" 
           class="sn-bottom-nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"
           aria-label="Home">
            <span class="sn-bottom-nav-icon">
                <i class="fas fa-home" aria-hidden="true"></i>
            </span>
            <span class="sn-bottom-nav-text">
                <?php echo $lang == 'fa' ? 'خانه' : ($lang == 'ar' ? 'الرئيسية' : 'Home'); ?>
            </span>
        </a>
        <button class="sn-bottom-nav-item" 
                id="<?php echo $navId; ?>_bottom_search"
                aria-label="Search"
                type="button">
            <span class="sn-bottom-nav-icon">
                <i class="fas fa-search" aria-hidden="true"></i>
            </span>
            <span class="sn-bottom-nav-text">
                <?php echo $lang == 'fa' ? 'جستجو' : ($lang == 'ar' ? 'بحث' : 'Search'); ?>
            </span>
        </button>
        <button class="sn-bottom-nav-item" 
                id="<?php echo $navId; ?>_bottom_lang"
                aria-label="Language"
                type="button">
            <span class="sn-bottom-nav-icon">
                <i class="fas fa-globe" aria-hidden="true"></i>
            </span>
            <span class="sn-bottom-nav-text">
                <?php echo $lang == 'fa' ? 'زبان' : ($lang == 'ar' ? 'اللغة' : 'Language'); ?>
            </span>
        </button>
        <button class="sn-bottom-nav-item" 
                id="<?php echo $navId; ?>_bottom_menu"
                aria-label="Menu"
                type="button">
            <span class="sn-bottom-nav-icon">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </span>
            <span class="sn-bottom-nav-text">
                <?php echo $lang == 'fa' ? 'منو' : ($lang == 'ar' ? 'القائمة' : 'Menu'); ?>
            </span>
        </button>
    </div>
</div>

<!-- Enhanced Mobile-Optimized JavaScript -->
<script id="<?php echo $navId; ?>_script">
(function() {
    'use strict';
    
    // Check if we're on mobile device first
    const isMobileDevice = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isTouchDevice = 'ontouchstart' in window;
    
    // Namespace all functionality
    const MobileNavigation = {
        // Configuration
        config: {
            navId: '<?php echo $navId; ?>',
            breakpoint: 991,
            stickyOffset: 100,
            animationDuration: 300,
            debounceDelay: 16
        },
        
        // Cache DOM elements
        elements: {},
        
        // State management
        state: {
            isMobile: false,
            isReady: false,
            activeOverlay: null
        },
        
        // Initialize
        init() {
            // Wait for DOM to be ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => this.setup());
            } else {
                this.setup();
            }
        },
        
        setup() {
            try {
                this.cacheElements();
                this.checkMobile();
                this.bindEvents();
                this.initStickyHeader();
                this.state.isReady = true;
                
                // Force show bottom nav on mobile immediately
                if (this.state.isMobile && this.elements.bottomNav) {
                    this.elements.bottomNav.style.display = 'flex';
                    this.elements.bottomNav.style.opacity = '1';
                    this.elements.bottomNav.style.visibility = 'visible';
                }
                
                console.log('Navigation initialized successfully');
            } catch (error) {
                console.error('Navigation initialization failed:', error);
                // Fallback: ensure bottom nav is visible on mobile
                this.fallbackMobileNav();
            }
        },
        
        // Fallback mobile navigation
        fallbackMobileNav() {
            const bottomNav = document.querySelector(`#${this.config.navId} .sn-bottom-nav`);
            if (bottomNav && window.innerWidth <= this.config.breakpoint) {
                bottomNav.style.display = 'flex';
                bottomNav.style.opacity = '1';
                bottomNav.style.visibility = 'visible';
            }
        },
        
        // Cache elements with error handling
        cacheElements() {
            const navId = this.config.navId;
            
            try {
                this.elements = {
                    container: document.getElementById(navId),
                    mainNav: document.getElementById(`${navId}_main_nav`),
                    bottomNav: document.getElementById(`${navId}_bottom_nav`),
                    
                    // Mobile Navigation
                    mobileNav: document.getElementById(`${navId}_mobile_nav`),
                    mobileClose: document.getElementById(`${navId}_mobile_close`),
                    
                    // Search
                    searchOverlay: document.getElementById(`${navId}_search_overlay`),
                    searchToggle: document.getElementById(`${navId}_search_toggle`),
                    bottomSearch: document.getElementById(`${navId}_bottom_search`),
                    searchClose: document.getElementById(`${navId}_search_close`),
                    searchInput: document.querySelector(`#${navId} .sn-search-input`),
                    
                    // Language
                    langOverlay: document.getElementById(`${navId}_lang_overlay`),
                    bottomLang: document.getElementById(`${navId}_bottom_lang`),
                    langClose: document.getElementById(`${navId}_lang_close`),
                    langToggle: document.getElementById(`${navId}_lang_toggle`),
                    langDropdown: document.getElementById(`${navId}_lang_dropdown`),
                    
                    // Bottom Navigation
                    bottomMenu: document.getElementById(`${navId}_bottom_menu`),
                    
                    // Dropdowns
                    dropdownToggles: document.querySelectorAll(`#${navId} .sn-mobile-dropdown-toggle`)
                };
                
                // Log missing elements in development
                if (window.location.hostname === 'localhost') {
                    Object.keys(this.elements).forEach(key => {
                        if (!this.elements[key] && !key.includes('Toggle')) {
                            console.warn(`Element not found: ${key}`);
                        }
                    });
                }
                
            } catch (error) {
                console.error('Error caching elements:', error);
            }
        },
        
        // Check mobile state
        checkMobile() {
            this.state.isMobile = window.innerWidth <= this.config.breakpoint;
            
            if (this.elements.bottomNav) {
                if (this.state.isMobile) {
                    this.elements.bottomNav.style.display = 'flex';
                    this.elements.bottomNav.style.opacity = '1';
                    this.elements.bottomNav.style.visibility = 'visible';
                } else {
                    this.elements.bottomNav.style.display = 'none';
                    this.closeAllOverlays();
                }
            }
        },
        
        // Bind events with error handling
        bindEvents() {
            try {
                // Scroll events (throttled)
                window.addEventListener('scroll', this.throttle(() => {
                    this.handleScroll();
                }, this.config.debounceDelay), { passive: true });
                
                // Resize events (debounced)
                window.addEventListener('resize', this.debounce(() => {
                    this.checkMobile();
                }, 250));
                
                // Mobile menu toggle
                if (this.elements.bottomMenu) {
                    this.elements.bottomMenu.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.toggleMobileMenu();
                    });
                }
                
                // Mobile close
                if (this.elements.mobileClose) {
                    this.elements.mobileClose.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.closeMobileMenu();
                    });
                }
                
                // Search toggles
                [this.elements.searchToggle, this.elements.bottomSearch].forEach(element => {
                    if (element) {
                        element.addEventListener('click', (e) => {
                            e.preventDefault();
                            this.toggleSearchOverlay();
                        });
                    }
                });
                
                // Search close
                if (this.elements.searchClose) {
                    this.elements.searchClose.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.closeSearchOverlay();
                    });
                }
                
                // Language toggles
                if (this.elements.bottomLang) {
                    this.elements.bottomLang.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.toggleLangOverlay();
                    });
                }
                
                // Language close
                if (this.elements.langClose) {
                    this.elements.langClose.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.closeLangOverlay();
                    });
                }
                
                // Mobile dropdown toggles
                this.elements.dropdownToggles.forEach(toggle => {
                    if (toggle) {
                        toggle.addEventListener('click', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            this.toggleMobileDropdown(toggle);
                        });
                    }
                });
                
                // Backdrop clicks
                [this.elements.mobileNav, this.elements.searchOverlay, this.elements.langOverlay].forEach(overlay => {
                    if (overlay) {
                        overlay.addEventListener('click', (e) => {
                            if (e.target === overlay) {
                                this.closeOverlay(overlay);
                            }
                        });
                    }
                });
                
                // Keyboard events
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeAllOverlays();
                    }
                });
                
                // Language dropdown hover (desktop only)
                if (!isMobileDevice && this.elements.langToggle && this.elements.langDropdown) {
                    this.bindLanguageHover();
                }
                
                // Search input events
                if (this.elements.searchInput) {
                    this.elements.searchInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            const form = this.elements.searchInput.closest('form');
                            if (form) form.submit();
                        }
                    });
                }
                
            } catch (error) {
                console.error('Error binding events:', error);
            }
        },
        
        // Language hover functionality for desktop
        bindLanguageHover() {
            let hoverTimeout;
            
            const showDropdown = () => {
                clearTimeout(hoverTimeout);
                if (this.elements.langDropdown) {
                    this.elements.langDropdown.style.opacity = '1';
                    this.elements.langDropdown.style.visibility = 'visible';
                    this.elements.langDropdown.style.transform = 'translateX(-50%) translateY(0)';
                }
            };
            
            const hideDropdown = () => {
                hoverTimeout = setTimeout(() => {
                    if (this.elements.langDropdown) {
                        this.elements.langDropdown.style.opacity = '0';
                        this.elements.langDropdown.style.visibility = 'hidden';
                        this.elements.langDropdown.style.transform = 'translateX(-50%) translateY(10px)';
                    }
                }, 100);
            };
            
            this.elements.langToggle.addEventListener('mouseenter', showDropdown);
            this.elements.langToggle.addEventListener('mouseleave', hideDropdown);
            this.elements.langDropdown.addEventListener('mouseenter', showDropdown);
            this.elements.langDropdown.addEventListener('mouseleave', hideDropdown);
        },
        
        // Sticky header functionality
        initStickyHeader() {
            this.handleScroll();
        },
        
        handleScroll() {
            if (!this.elements.mainNav) return;
            
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > this.config.stickyOffset) {
                this.elements.mainNav.classList.add('sticky');
            } else {
                this.elements.mainNav.classList.remove('sticky');
            }
        },
        
        // Mobile menu functions
        toggleMobileMenu() {
            if (!this.elements.mobileNav) return;
            
            const isActive = this.elements.mobileNav.classList.contains('active');
            
            if (isActive) {
                this.closeMobileMenu();
            } else {
                this.openMobileMenu();
            }
        },
        
        openMobileMenu() {
            if (!this.elements.mobileNav) return;
            
            this.closeAllOverlays();
            this.elements.mobileNav.classList.add('active');
            this.state.activeOverlay = 'mobile';
            document.body.style.overflow = 'hidden';
            
            // Focus management
            setTimeout(() => {
                const firstFocusable = this.elements.mobileNav.querySelector('button, a, [tabindex]:not([tabindex="-1"])');
                if (firstFocusable) firstFocusable.focus();
            }, this.config.animationDuration);
        },
        
        closeMobileMenu() {
            if (!this.elements.mobileNav) return;
            
            this.elements.mobileNav.classList.remove('active');
            this.state.activeOverlay = null;
            document.body.style.overflow = '';
            
            if (this.elements.bottomMenu) {
                this.elements.bottomMenu.focus();
            }
        },
        
        // Search overlay functions
        toggleSearchOverlay() {
            if (!this.elements.searchOverlay) return;
            
            const isActive = this.elements.searchOverlay.classList.contains('active');
            
            if (isActive) {
                this.closeSearchOverlay();
            } else {
                this.openSearchOverlay();
            }
        },
        
        openSearchOverlay() {
            if (!this.elements.searchOverlay) return;
            
            this.closeAllOverlays();
            this.elements.searchOverlay.classList.add('active');
            this.state.activeOverlay = 'search';
            document.body.style.overflow = 'hidden';
            
            // Focus on search input
            setTimeout(() => {
                if (this.elements.searchInput) {
                    this.elements.searchInput.focus();
                }
            }, this.config.animationDuration);
        },
        
        closeSearchOverlay() {
            if (!this.elements.searchOverlay) return;
            
            this.elements.searchOverlay.classList.remove('active');
            this.state.activeOverlay = null;
            document.body.style.overflow = '';
        },
        
        // Language overlay functions
        toggleLangOverlay() {
            if (!this.elements.langOverlay) return;
            
            const isActive = this.elements.langOverlay.classList.contains('active');
            
            if (isActive) {
                this.closeLangOverlay();
            } else {
                this.openLangOverlay();
            }
        },
        
        openLangOverlay() {
            if (!this.elements.langOverlay) return;
            
            this.closeAllOverlays();
            this.elements.langOverlay.classList.add('active');
            this.state.activeOverlay = 'language';
            document.body.style.overflow = 'hidden';
        },
        
        closeLangOverlay() {
            if (!this.elements.langOverlay) return;
            
            this.elements.langOverlay.classList.remove('active');
            this.state.activeOverlay = null;
            document.body.style.overflow = '';
        },
        
        // Mobile dropdown functionality
        toggleMobileDropdown(toggle) {
            const dropdownId = toggle.getAttribute('data-dropdown');
            const dropdown = document.getElementById(dropdownId);
            
            if (!dropdown) return;
            
            const isActive = toggle.classList.contains('active');
            
            // Close all other dropdowns
            this.elements.dropdownToggles.forEach(otherToggle => {
                if (otherToggle !== toggle && otherToggle.classList.contains('active')) {
                    otherToggle.classList.remove('active');
                    const otherDropdownId = otherToggle.getAttribute('data-dropdown');
                    const otherDropdown = document.getElementById(otherDropdownId);
                    if (otherDropdown) {
                        this.slideUp(otherDropdown);
                    }
                }
            });
            
            // Toggle current dropdown
            toggle.classList.toggle('active');
            
            if (isActive) {
                this.slideUp(dropdown);
            } else {
                this.slideDown(dropdown);
            }
        },
        
        // Animation functions
        slideUp(element) {
            if (!element) return;
            
            element.style.height = element.scrollHeight + 'px';
            element.style.transition = `height ${this.config.animationDuration}ms ease`;
            element.style.overflow = 'hidden';
            
            requestAnimationFrame(() => {
                element.style.height = '0px';
            });
            
            setTimeout(() => {
                element.style.display = 'none';
                element.style.height = '';
                element.style.overflow = '';
                element.style.transition = '';
            }, this.config.animationDuration);
        },
        
        slideDown(element) {
            if (!element) return;
            
            element.style.display = 'block';
            element.style.height = '0px';
            element.style.overflow = 'hidden';
            element.style.transition = `height ${this.config.animationDuration}ms ease`;
            
            requestAnimationFrame(() => {
                const height = element.scrollHeight;
                element.style.height = height + 'px';
            });
            
            setTimeout(() => {
                element.style.height = '';
                element.style.overflow = '';
                element.style.transition = '';
            }, this.config.animationDuration);
        },
        
        // Close specific overlay
        closeOverlay(overlay) {
            if (!overlay) return;
            
            if (overlay === this.elements.mobileNav) {
                this.closeMobileMenu();
            } else if (overlay === this.elements.searchOverlay) {
                this.closeSearchOverlay();
            } else if (overlay === this.elements.langOverlay) {
                this.closeLangOverlay();
            }
        },
        
        // Close all overlays
        closeAllOverlays() {
            this.closeMobileMenu();
            this.closeSearchOverlay();
            this.closeLangOverlay();
        },
        
        // Utility functions
        throttle(func, delay) {
            let timeoutId;
            let lastExecTime = 0;
            
            return function (...args) {
                const currentTime = Date.now();
                
                if (currentTime - lastExecTime > delay) {
                    func.apply(this, args);
                    lastExecTime = currentTime;
                } else {
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(() => {
                        func.apply(this, args);
                        lastExecTime = Date.now();
                    }, delay - (currentTime - lastExecTime));
                }
            };
        },
        
        debounce(func, delay) {
            let timeoutId;
            
            return function (...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => func.apply(this, args), delay);
            };
        }
    };
    
    // Initialize navigation
    MobileNavigation.init();
    
    // Global error handler for navigation
    window.addEventListener('error', (e) => {
        if (e.message.includes('Navigation') || e.filename.includes('menu')) {
            console.error('Navigation error caught:', e);
            // Fallback to show bottom nav
            if (window.innerWidth <= 991) {
                const bottomNav = document.querySelector(`#${MobileNavigation.config.navId} .sn-bottom-nav`);
                if (bottomNav) {
                    bottomNav.style.display = 'flex';
                    bottomNav.style.opacity = '1';
                    bottomNav.style.visibility = 'visible';
                }
            }
        }
    });
    
    // Expose for debugging (development only)
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        window.SalmanMobileNav = MobileNavigation;
    }
    
})();

</script>

<!-- Content Padding Helper -->
<style>
/* Ensure content doesn't overlap with fixed header */
.content-wrapper,
.main-content,
body > main,
.page-content,
section:first-of-type,
.hero-section,
.banner-section {
    padding-top: 140px !important;
}

/* Responsive content padding */
@media (max-width: 991px) {
    .content-wrapper,
    .main-content,
    body > main,
    .page-content,
    section:first-of-type,
    .hero-section,
    .banner-section {
        padding-top: 120px !important;
        padding-bottom: 100px !important; /* Space for bottom nav */
    }
}

@media (max-width: 767px) {
    .content-wrapper,
    .main-content,
    body > main,
    .page-content,
    section:first-of-type,
    .hero-section,
    .banner-section {
        padding-top: 100px !important;
        padding-bottom: 90px !important;
    }
}

@media (max-width: 575px) {
    .content-wrapper,
    .main-content,
    body > main,
    .page-content,
    section:first-of-type,
    .hero-section,
    .banner-section {
        padding-top: 90px !important;
        padding-bottom: 85px !important;
    }
}

/* Fix for any conflicting z-index issues */
body {
    position: relative;
}

/* Ensure navigation is always on top */
#<?php echo $navId; ?> {
    position: relative;
    z-index: 999999 !important;
}

#<?php echo $navId; ?> .sn-mobile-nav,
#<?php echo $navId; ?> .sn-search-overlay,
#<?php echo $navId; ?> .sn-lang-overlay {
    z-index: 999999 !important;
}

#<?php echo $navId; ?> .sn-bottom-nav {
    z-index: 999998 !important;
}
</style>

<!-- Performance and SEO Optimizations -->
<link rel="preload" href="assets/images/flags/<?php echo $lang; ?>.png" as="image">
<link rel="prefetch" href="assets/images/flags/en.png">
<link rel="prefetch" href="assets/images/flags/fa.png">
<link rel="prefetch" href="assets/images/flags/ar.png">

<!-- Mobile Meta Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

<!-- Touch Events Optimization -->
<style>
/* Touch optimization for mobile devices */
#<?php echo $navId; ?> button,
#<?php echo $navId; ?> a,
#<?php echo $navId; ?> .sn-bottom-nav-item {
    -webkit-tap-highlight-color: transparent;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    touch-action: manipulation;
}

/* Prevent zoom on input focus (iOS) */
#<?php echo $navId; ?> input {
    font-size: 16px !important;
}

/* Fix for iOS safari bottom bar */
@supports (padding: max(0px)) {
    #<?php echo $navId; ?> .sn-bottom-nav {
        padding-bottom: max(12px, env(safe-area-inset-bottom));
    }
}
</style>
<!-- فقط این کد را کپی کنید و در انتهای صفحه قبل از </body> قرار دهید -->

<script>
// Instant Fix - Just Copy This!
window.addEventListener('load', function() {
    // Hide all overlays first
    document.querySelectorAll('.sn-search-overlay, .sn-lang-overlay, .sn-mobile-nav').forEach(el => {
        el.style.display = 'none';
    });
    
    // Search button fix
    setInterval(function() {
        var searchBtn = document.querySelector('[id$="_search_toggle"]');
        if (searchBtn && !searchBtn.hasFixedClick) {
            searchBtn.hasFixedClick = true;
            searchBtn.style.cursor = 'pointer';
            searchBtn.onclick = function(e) {
                e.preventDefault();
                var overlay = document.querySelector('.sn-search-overlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    overlay.style.zIndex = '9999999';
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                return false;
            };
        }
        
        // Language button fix for mobile
        var langBtn = document.querySelector('[id$="_lang_toggle"]');
        if (langBtn && !langBtn.hasFixedClick && window.innerWidth <= 991) {
            langBtn.hasFixedClick = true;
            langBtn.style.cursor = 'pointer';
            langBtn.onclick = function(e) {
                e.preventDefault();
                var overlay = document.querySelector('.sn-lang-overlay');
                if (overlay) {
                    overlay.style.display = 'block';
                    overlay.style.zIndex = '9999999';
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                return false;
            };
        }
        
        // Bottom nav fixes
        var bottomSearch = document.querySelector('[id$="_bottom_search"]');
        if (bottomSearch && !bottomSearch.hasFixedClick) {
            bottomSearch.hasFixedClick = true;
            bottomSearch.onclick = function(e) {
                e.preventDefault();
                var overlay = document.querySelector('.sn-search-overlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    overlay.style.zIndex = '9999999';
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                return false;
            };
        }
        
        var bottomLang = document.querySelector('[id$="_bottom_lang"]');
        if (bottomLang && !bottomLang.hasFixedClick) {
            bottomLang.hasFixedClick = true;
            bottomLang.onclick = function(e) {
                e.preventDefault();
                var overlay = document.querySelector('.sn-lang-overlay');
                if (overlay) {
                    overlay.style.display = 'block';
                    overlay.style.zIndex = '9999999';
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                return false;
            };
        }
        
        var bottomMenu = document.querySelector('[id$="_bottom_menu"]');
        if (bottomMenu && !bottomMenu.hasFixedClick) {
            bottomMenu.hasFixedClick = true;
            bottomMenu.onclick = function(e) {
                e.preventDefault();
                var overlay = document.querySelector('.sn-mobile-nav');
                if (overlay) {
                    overlay.style.display = 'block';
                    overlay.style.zIndex = '9999999';
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                return false;
            };
        }
    }, 100); // Check every 100ms
    
    // Close buttons
    document.addEventListener('click', function(e) {
        // Close search
        if (e.target.closest('[id$="_search_close"]')) {
            e.preventDefault();
            var overlay = document.querySelector('.sn-search-overlay');
            if (overlay) {
                overlay.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
        
        // Close language
        if (e.target.closest('[id$="_lang_close"]')) {
            e.preventDefault();
            var overlay = document.querySelector('.sn-lang-overlay');
            if (overlay) {
                overlay.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
        
        // Close mobile menu
        if (e.target.closest('[id$="_mobile_close"]')) {
            e.preventDefault();
            var overlay = document.querySelector('.sn-mobile-nav');
            if (overlay) {
                overlay.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
        
        // Click overlay to close
        if (e.target.matches('.sn-search-overlay, .sn-lang-overlay, .sn-mobile-nav')) {
            e.target.classList.remove('active');
            e.target.style.display = 'none';
            document.body.style.overflow = '';
        }
    });
});
</script>