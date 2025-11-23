<?php
/**
 * About Page Helper Functions (Updated)
 * 
 * This file contains functions for retrieving content for the About page
 * from the database in different languages using new modular table structure.
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

/**
 * Get a single content item from temp_about tables
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
    
    // Use prepared statements for security
    $query = "SELECT t.content_value 
              FROM temp_about_content c
              JOIN temp_about_translations t ON c.content_id = t.content_id
              WHERE c.field_key = ? 
              AND t.language_id = ? 
              AND c.is_repeatable = 0 
              LIMIT 1";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $field_key, $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['content_value'];
    }
    
    return "";
}

/**
 * Get image path from temp_about_content table
 * 
 * @param string $field_key The field key to retrieve
 * @param string $lang Language code (fa, en, ar) - not used directly but kept for API compatibility
 * @return string The image path or empty string if not found
 */
function getAboutImagePath($field_key, $lang = null) {
    global $db;
    
    // Image paths are stored in content table and are language-independent
    $query = "SELECT image_path 
              FROM temp_about_content 
              WHERE field_key = ? 
              LIMIT 1";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $field_key);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['image_path'] ?? "";
    }
    
    return "";
}

/**
 * Get repeatable items from temp_about tables
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
    
    $query = "SELECT c.content_id, c.image_path, t.content_value 
              FROM temp_about_content c
              JOIN temp_about_translations t ON c.content_id = t.content_id
              WHERE c.field_key = ? 
              AND t.language_id = ? 
              AND c.is_repeatable = 1 
              ORDER BY c.sort_order ASC";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $field_key, $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = json_decode($row['content_value'], true);
            // If not a JSON string, use the raw content
            if ($item === null) {
                $item = ['content' => $row['content_value']];
            }
            
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
    
    $query = "SELECT c.field_key, c.is_repeatable, c.image_path, t.content_value 
              FROM temp_about_content c
              JOIN temp_about_translations t ON c.content_id = t.content_id
              WHERE c.section_id = ? 
              AND t.language_id = ? 
              ORDER BY c.sort_order ASC";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $section_id, $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    $content = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['is_repeatable'] == 1) {
                if (!isset($content[$row['field_key']])) {
                    $content[$row['field_key']] = [];
                }
                
                $item = json_decode($row['content_value'], true);
                // If not a JSON string, use the raw content
                if ($item === null) {
                    $item = ['content' => $row['content_value']];
                }
                
                if (isset($row['image_path']) && !empty($row['image_path'])) {
                    $item['image_path'] = $row['image_path'];
                }
                
                $content[$row['field_key']][] = $item;
            } else {
                $content[$row['field_key']] = $row['content_value'];
                
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