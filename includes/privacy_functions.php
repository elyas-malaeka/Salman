<?php
/**
 * توابع کمکی برای صفحه حریم خصوصی
 * 
 * این فایل شامل توابعی است که محتوا را از جدول privacy_content در دیتابیس دریافت می‌کنند.
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

/**
 * دریافت محتوای ثابت از جدول privacy_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string محتوای فیلد
 */
function getPrivacyContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM privacy_content 
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
 * دریافت محتوای بخش خاص
 *
 * @param string $section_id شناسه بخش
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از محتواهای بخش
 */
function getPrivacySectionContent($section_id, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT field_key, content FROM privacy_content 
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
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از آیتم‌های تکرارشونده
 */
function getPrivacyRepeatableItems($section_id, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT field_key, content FROM privacy_content 
              WHERE section_id = '{$section_id}' 
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
 * دریافت آیتم‌های بخش شرح اشتراک‌گذاری
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از آیتم‌های شرح اشتراک‌گذاری
 */
function getPrivacySharingItems($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT field_key, content FROM privacy_content 
              WHERE section_id = 'sharing_items' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        $current_index = -1;
        
        while ($row = mysqli_fetch_assoc($result)) {
            if (strpos($row['field_key'], '_title') !== false) {
                $current_index++;
                $items[$current_index] = [
                    'title' => $row['content'],
                    'text' => ''
                ];
            } elseif (strpos($row['field_key'], '_text') !== false && $current_index >= 0) {
                $items[$current_index]['text'] = $row['content'];
            }
        }
    }
    
    return $items;
}

/**
 * دریافت داده‌های مورد نیاز برای بخش مقدمه
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه داده‌های بخش مقدمه
 */
function getIntroductionData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getPrivacyContent('intro_title', $lang),
        'text_1' => getPrivacyContent('intro_text_1', $lang),
        'text_2' => getPrivacyContent('intro_text_2', $lang),
        'callout' => getPrivacyContent('intro_callout', $lang)
    ];
}

/**
 * دریافت داده‌های مورد نیاز برای بخش جمع‌آوری اطلاعات
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه داده‌های بخش جمع‌آوری اطلاعات
 */
function getCollectionData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getPrivacyContent('collection_title', $lang),
        'text_1' => getPrivacyContent('collection_text_1', $lang),
        'text_2' => getPrivacyContent('collection_text_2', $lang),
        'subtitle_1' => getPrivacyContent('collection_subtitle_1', $lang),
        'items_1' => getPrivacyRepeatableItems('collection_items_1', $lang),
        'subtitle_2' => getPrivacyContent('collection_subtitle_2', $lang),
        'text_3' => getPrivacyContent('collection_text_3', $lang),
        'items_2' => getPrivacyRepeatableItems('collection_items_2', $lang)
    ];
}

/**
 * دریافت داده‌های مورد نیاز برای بخش نحوه استفاده از اطلاعات
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه داده‌های بخش نحوه استفاده از اطلاعات
 */
function getUsageData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getPrivacyContent('usage_title', $lang),
        'text' => getPrivacyContent('usage_text', $lang),
        'items' => getPrivacyRepeatableItems('usage_items', $lang)
    ];
}

/**
 * دریافت داده‌های مورد نیاز برای بخش اشتراک‌گذاری اطلاعات
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه داده‌های بخش اشتراک‌گذاری اطلاعات
 */
function getSharingData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getPrivacyContent('sharing_title', $lang),
        'text' => getPrivacyContent('sharing_text', $lang),
        'items' => getPrivacySharingItems($lang)
    ];
}