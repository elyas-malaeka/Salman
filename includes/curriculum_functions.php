<?php
/**
 * توابع کمکی برای صفحه برنامه درسی
 * 
 * این فایل شامل توابعی است که محتوا را از جدول curriculum_content در دیتابیس دریافت می‌کنند.
 * 
 * @package Salman Educational Complex
 * @version 2.1
 */

/**
 * دریافت محتوای ثابت از جدول curriculum_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string محتوای فیلد
 */
function getCurriculumContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM curriculum_content 
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
 * دریافت مسیر تصویر از جدول curriculum_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string مسیر تصویر
 */
function getCurriculumImage($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT image_path FROM curriculum_content 
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
 * دریافت محتوای بخش خاص
 *
 * @param string $section_id شناسه بخش
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از محتواهای بخش
 */
function getCurriculumSectionContent($section_id, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT field_key, content FROM curriculum_content 
              WHERE section_id = '{$section_id}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 0 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $contents = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $contents[$row['field_key']] = $row['content'];
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
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $field_condition = "";
    if ($field_key) {
        $field_key = mysqli_real_escape_string($db, $field_key);
        $field_condition = "AND field_key = '{$field_key}'";
    }
    
    $query = "SELECT field_key, content FROM curriculum_content 
              WHERE section_id = '{$section_id}' 
              {$field_condition}
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = [
                'field_key' => $row['field_key'],
                'content' => $row['content']
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
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $features = [];
    $titles = getCurriculumRepeatableItems('high_features', 'high_feature_title', $lang);
    $texts = getCurriculumRepeatableItems('high_features', 'high_feature_text', $lang);
    
    for ($i = 0; $i < count($titles); $i++) {
        if (isset($titles[$i]) && isset($texts[$i])) {
            $features[] = [
                'title' => $titles[$i]['content'],
                'text' => $texts[$i]['content']
            ];
        }
    }
    
    return $features;
}