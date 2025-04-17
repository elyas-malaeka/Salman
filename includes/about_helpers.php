<?php
/**
 * About Page Helper Functions
 * 
 * This file contains functions for retrieving content for the About page
 * from the database in different languages.
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

/**
 * Get a single content item from about_content table
 * 
 * @param string $field_key The field key to retrieve
 * @param string $lang Language code (fa, en, ar)
 * @return string The content value or empty string if not found
 */
function getAboutContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM about_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 0 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    
    return "";
}

/**
 * Get image path from about_content table
 * 
 * @param string $field_key The field key to retrieve
 * @param string $lang Language code (fa, en, ar)
 * @return string The image path or empty string if not found
 */
function getAboutImagePath($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT image_path FROM about_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['image_path'];
    }
    
    return "";
}

/**
 * Get repeatable items from about_content table
 * 
 * @param string $field_key The field key to retrieve
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of items with their content
 */
function getAboutItems($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content, image_path FROM about_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item = json_decode($row['content'], true);
            if (isset($row['image_path']) && !empty($row['image_path'])) {
                $item['image_path'] = $row['image_path'];
            }
            $items[] = $item;
        }
    }
    
    return $items;
}

/**
 * Get all section content for about page
 * 
 * @param string $section_id The section ID to retrieve content for
 * @param string $lang Language code (fa, en, ar)
 * @return array Associative array of content for the section
 */
function getAboutSectionContent($section_id, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT field_key, content, is_repeatable, image_path 
              FROM about_content 
              WHERE section_id = '{$section_id}' 
              AND language_id = '{$lang}' 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $content = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['is_repeatable'] == 1) {
                if (!isset($content[$row['field_key']])) {
                    $content[$row['field_key']] = [];
                }
                
                $item = json_decode($row['content'], true);
                if (isset($row['image_path']) && !empty($row['image_path'])) {
                    $item['image_path'] = $row['image_path'];
                }
                
                $content[$row['field_key']][] = $item;
            } else {
                $content[$row['field_key']] = $row['content'];
                
                if (isset($row['image_path']) && !empty($row['image_path'])) {
                    $content[$row['field_key'] . '_image'] = $row['image_path'];
                }
            }
        }
    }
    
    return $content;
}

/**
 * Get highlights for about page
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of highlight items
 */
function getAboutHighlights($lang = null) {
    return getAboutItems('highlight_item', $lang);
}

/**
 * Get feature items for about page
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of feature items
 */
function getAboutFeatures($lang = null) {
    return getAboutItems('feature_item', $lang);
}

/**
 * Get stats items for about page
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of stats items
 */
function getAboutStats($lang = null) {
    return getAboutItems('stats_item', $lang);
}

/**
 * Get team members for about page
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of team member items
 */
function getAboutTeamMembers($lang = null) {
    return getAboutItems('team_member', $lang);
}