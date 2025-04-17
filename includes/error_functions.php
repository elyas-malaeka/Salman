<?php
/**
 * توابع کمکی برای صفحه خطا
 * 
 * این فایل شامل توابعی است که محتوا را از جدول error_content در دیتابیس دریافت می‌کنند.
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

/**
 * دریافت محتوای ثابت از جدول error_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string محتوای فیلد
 */
function getErrorContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM error_content 
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
 * دریافت مسیر تصویر از جدول error_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return string مسیر تصویر
 */
function getErrorImagePath($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT image_path FROM error_content 
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
 * دریافت داده‌های کامل صفحه خطا
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از داده‌های صفحه خطا
 */
function getErrorPageData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'page_title' => getErrorContent('page_title', $lang),
        'error_title' => getErrorContent('error_title', $lang),
        'error_text' => getErrorContent('error_text', $lang),
        'button_text' => getErrorContent('button_text', $lang),
        'logo_path' => getErrorContent('logo_path_light', $lang),
        'logo_alt' => getErrorContent('logo_alt', $lang),
        'lang_btn' => [
            'fa' => getErrorContent('lang_btn_fa', $lang),
            'en' => getErrorContent('lang_btn_en', $lang),
            'ar' => getErrorContent('lang_btn_ar', $lang)
        ]
    ];
}