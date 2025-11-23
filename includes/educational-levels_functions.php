<?php
/**
 * توابع کمکی برای صفحه مقاطع تحصیلی
 * 
 * این فایل شامل توابعی است که محتوا را از جداول جدید مقاطع تحصیلی دریافت می‌کنند.
 * 
 * @package Salman Educational Complex
 * @version 3.0
 */

/**
 * دریافت متغیر اتصال به دیتابیس
 */
function getDBConnection() {
    global $db, $conn, $mysqli, $connection, $pdo;
    
    // بررسی متغیرهای اتصال متداول
    if (isset($db) && $db) return $db;
    if (isset($conn) && $conn) return $conn;
    if (isset($mysqli) && $mysqli) return $mysqli;
    if (isset($connection) && $connection) return $connection;
    if (isset($pdo) && $pdo) return $pdo;
    
    // در صورتی که هیچ متغیر اتصالی یافت نشد
    die("خطا: متغیر اتصال به دیتابیس یافت نشد. لطفاً با مدیر سیستم تماس بگیرید.");
}

/**
 * دریافت محتوای ترجمه شده برای یک فیلد خاص
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string محتوای ترجمه شده
 */
function getCurriculumContent($field_key, $lang = null) {
    $db_connection = getDBConnection();
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db_connection, $field_key);
    $lang = mysqli_real_escape_string($db_connection, $lang);
    
    $query = "SELECT t.content_value 
              FROM temp_edu_levels_content c
              JOIN temp_edu_levels_translations t ON c.content_id = t.content_id
              WHERE c.field_key = '{$field_key}' 
              AND t.language_id = '{$lang}' 
              LIMIT 1";
              
    $result = mysqli_query($db_connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content_value'];
    }
    
    return "";
}

/**
 * دریافت مسیر تصویر
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string مسیر تصویر
 */
function getCurriculumImage($field_key, $lang = null) {
    $db_connection = getDBConnection();
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db_connection, $field_key);
    
    $query = "SELECT image_path 
              FROM temp_edu_levels_content
              WHERE field_key = '{$field_key}' 
              LIMIT 1";
              
    $result = mysqli_query($db_connection, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['image_path'] ? $row['image_path'] : '';
    }
    
    return "";
}

/**
 * دریافت محتوای بخش خاص
 *
 * @param string $section_id شناسه بخش
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از محتواهای بخش
 */
function getCurriculumSectionContent($section_id, $lang = null) {
    $db_connection = getDBConnection();
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db_connection, $section_id);
    $lang = mysqli_real_escape_string($db_connection, $lang);
    
    $query = "SELECT c.field_key, t.content_value 
              FROM temp_edu_levels_content c
              JOIN temp_edu_levels_translations t ON c.content_id = t.content_id
              WHERE c.section_id = '{$section_id}' 
              AND t.language_id = '{$lang}' 
              AND c.is_repeatable = 0 
              ORDER BY c.sort_order ASC";
              
    $result = mysqli_query($db_connection, $query);
    $contents = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $contents[$row['field_key']] = $row['content_value'];
        }
    }
    
    return $contents;
}

/**
 * دریافت آیتم‌های تکرارشونده از یک بخش
 *
 * @param string $section_id شناسه بخش
 * @param string $field_key کلید فیلد (اختیاری)
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از آیتم‌های تکرارشونده
 */
function getCurriculumRepeatableItems($section_id, $field_key = null, $lang = null) {
    $db_connection = getDBConnection();
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db_connection, $section_id);
    $lang = mysqli_real_escape_string($db_connection, $lang);
    
    $field_condition = "";
    if ($field_key) {
        $field_key = mysqli_real_escape_string($db_connection, $field_key);
        $field_condition = "AND c.field_key = '{$field_key}'";
    }
    
    $query = "SELECT c.field_key, t.content_value 
              FROM temp_edu_levels_content c
              JOIN temp_edu_levels_translations t ON c.content_id = t.content_id
              WHERE c.section_id = '{$section_id}' 
              {$field_condition}
              AND t.language_id = '{$lang}' 
              AND c.is_repeatable = 1 
              ORDER BY c.sort_order ASC";
              
    $result = mysqli_query($db_connection, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = [
                'field_key' => $row['field_key'],
                'content' => $row['content_value']
            ];
        }
    }
    
    return $items;
}

/**
 * دریافت ویژگی‌های دبیرستان
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از ویژگی‌های دبیرستان
 */
function getHighSchoolFeatures($lang = null) {
    $db_connection = getDBConnection();
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $lang = mysqli_real_escape_string($db_connection, $lang);
    $features = [];
    
    // در جدول جدید، ما فقط نیاز به دریافت عنوان و جداگانه گرفتن متن داریم
    $titles = getCurriculumRepeatableItems('high_features', 'high_feature_title', $lang);
    
    // برای هر عنوان، باید متن مربوطه را پیدا کنیم
    foreach ($titles as $index => $title) {
        // با استفاده از query مستقیم
        $sort_order = $index + 1;
        $query = "SELECT t.content_value 
                  FROM temp_edu_levels_content c
                  JOIN temp_edu_levels_translations t ON c.content_id = t.content_id
                  WHERE c.field_key = 'high_feature_text' 
                  AND c.sort_order = {$sort_order}
                  AND t.language_id = '{$lang}'
                  LIMIT 1";
                  
        $result = mysqli_query($db_connection, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $features[] = [
                'title' => $title['content'],
                'text' => $row['content_value']
            ];
        } else {
            // اگر متن پیدا نشد، حداقل عنوان را اضافه کنیم
            $features[] = [
                'title' => $title['content'],
                'text' => ''
            ];
        }
    }
    
    return $features;
}