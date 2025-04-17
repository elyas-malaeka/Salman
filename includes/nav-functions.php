<?php
/**
 * Menu Helper Functions
 * Functions to help with database-driven navigation
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

/**
 * Get main menu items from database
 * 
 * @param object $db Database connection
 * @param string $language Current language code
 * @return array Array of main menu items
 */
function getMainMenuItems($db, $language) {
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
            $items[] = $row;
        }
    }
    
    return $items;
}

/**
 * Get submenu items for a specific parent menu item
 * 
 * @param object $db Database connection
 * @param int $parent_id Parent menu item ID
 * @param string $language Current language code
 * @return array Array of submenu items
 */
function getSubmenuItems($db, $parent_id, $language) {
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
            // Check if this submenu item has its own children
            $row['has_children'] = hasSubmenuItems($db, $row['id'], $language);
            $items[] = $row;
        }
    }
    
    return $items;
}

/**
 * Check if a menu item has children
 * 
 * @param object $db Database connection
 * @param int $parent_id Parent menu item ID
 * @param string $language Current language code
 * @return bool True if menu item has children, false otherwise
 */
function hasSubmenuItems($db, $parent_id, $language) {
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

/**
 * Get social media links from database
 * 
 * @param object $db Database connection
 * @return array Array of social media links
 */
function getSocialMediaLinks($db) {
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
}

/**
 * Get contact information from database
 * 
 * @param object $db Database connection
 * @param string $language Current language code
 * @return array Array of contact information
 */
function getContactInfo($db, $language) {
    $language = mysqli_real_escape_string($db, $language);
    $query = "SELECT * FROM contact_info 
              WHERE language_id = '{$language}' 
              AND is_active = 1";
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items[$row['type']] = $row;
        }
    }
    
    return $items;
}

/**
 * Get a site setting from database
 * 
 * @param object $db Database connection
 * @param string $key Setting key
 * @return string Setting value or empty string if not found
 */
function getSetting($db, $key) {
    $key = mysqli_real_escape_string($db, $key);
    $query = "SELECT value FROM site_settings 
              WHERE `key` = '{$key}' 
              LIMIT 1";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['value'];
    }
    
    return '';
}

/**
 * Recursively render a menu for admin interface
 * 
 * @param object $db Database connection
 * @param int|null $parent_id Parent menu item ID or null for root items
 * @param string $language Language code
 * @return string HTML output of the menu
 */
function renderAdminMenu($db, $parent_id = null, $language = 'en') {
    $output = '';
    
    if ($parent_id === null) {
        $query = "SELECT * FROM menu_items 
                  WHERE parent_id IS NULL 
                  AND language_id = '{$language}' 
                  ORDER BY `order` ASC";
    } else {
        $parent_id = (int)$parent_id;
        $query = "SELECT * FROM menu_items 
                  WHERE parent_id = {$parent_id} 
                  AND language_id = '{$language}' 
                  ORDER BY `order` ASC";
    }
    
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $output .= '<ul class="admin-menu' . ($parent_id === null ? '' : ' nested') . '">';
        
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= '<li class="admin-menu-item" data-id="' . $row['id'] . '">';
            $output .= '<div class="menu-item-controls">';
            $output .= '<span class="item-title">' . htmlspecialchars($row['title']) . '</span>';
            $output .= '<span class="item-url">' . htmlspecialchars($row['url']) . '</span>';
            $output .= '<div class="item-actions">';
            $output .= '<button class="edit-item" data-id="' . $row['id'] . '">Edit</button>';
            $output .= '<button class="delete-item" data-id="' . $row['id'] . '">Delete</button>';
            $output .= '<button class="add-child" data-id="' . $row['id'] . '">Add Child</button>';
            $output .= '<button class="move-up" data-id="' . $row['id'] . '">↑</button>';
            $output .= '<button class="move-down" data-id="' . $row['id'] . '">↓</button>';
            $output .= '<span class="status-indicator ' . ($row['is_active'] ? 'active' : 'inactive') . '"></span>';
            $output .= '</div>';
            $output .= '</div>';
            
            // Recursively render children
            $output .= renderAdminMenu($db, $row['id'], $language);
            
            $output .= '</li>';
        }
        
        $output .= '</ul>';
    }
    
    return $output;
}

/**
 * Generate language selection HTML
 * 
 * @param string $current_lang Current language code
 * @return string HTML for language selection
 */
function getLanguageSelectorHtml($current_lang) {
    $languages = [
        'en' => 'English',
        'fa' => 'فارسی',
        'ar' => 'العربية'
    ];
    
    $html = '<div class="language-selector">';
    foreach ($languages as $code => $name) {
        $active = ($code === $current_lang) ? ' active' : '';
        $html .= '<a href="?lang=' . $code . '" class="language-item' . $active . '">';
        $html .= '<img src="assets/images/flags/' . $code . '.png" alt="' . $name . '">';
        $html .= '<span>' . $name . '</span>';
        $html .= '</a>';
    }
    $html .= '</div>';
    
    return $html;
}

/**
 * Check if current page matches URL
 * 
 * @param string $url URL to check
 * @return bool True if current page matches URL
 */
function isCurrentPage($url) {
    $current_page = basename($_SERVER['PHP_SELF']);
    $menu_url = basename($url);
    
    if ($menu_url === '#') {
        return false;
    }
    
    return $current_page === $menu_url;
}