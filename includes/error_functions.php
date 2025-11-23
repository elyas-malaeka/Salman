<?php
/**
 * توابع کمکی برای صفحه خطا
 *
 * این فایل شامل توابعی است که محتوا را از جداول temp_404_content و temp_404_translations در دیتابیس دریافت می‌کنند.
 *
 * @package Salman Educational Complex
 * @version 3.0
 */

/**
 * دریافت محتوای ثابت از جداول temp_404_content و temp_404_translations
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
   
    // استفاده از prepared statements برای امنیت بیشتر
    $query = "SELECT t.content_value 
              FROM temp_404_content c
              JOIN temp_404_translations t ON c.content_id = t.content_id
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
 * دریافت مسیر تصویر از جدول temp_404_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری) - فقط برای سازگاری با API قبلی
 * @return string مسیر تصویر
 */
function getErrorImagePath($field_key, $lang = null) {
    global $db;
   
    // مسیرهای تصویر مستقل از زبان هستند و در جدول temp_404_content ذخیره می‌شوند
    $query = "SELECT image_path 
              FROM temp_404_content 
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