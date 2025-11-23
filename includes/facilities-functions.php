<?php
/**
 * توابع کمکی برای دریافت محتوای صفحه امکانات (Facilities) از دیتابیس
 * این فایل با ساختار جداول جدید ماژولار به‌روزرسانی شده است
 */

/**
 * دریافت محتوای متنی ثابت صفحه امکانات
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar)
 * @return string محتوای متنی یا مقدار پیش‌فرض
 */
function getFacilityStaticContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // استفاده از prepared statements برای افزایش امنیت
    $query = "SELECT t.content_value 
              FROM temp_facilities_content c
              JOIN temp_facilities_translations t ON c.content_id = t.content_id
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
    
    // اگر محتوا پیدا نشد، متن پیش‌فرض برگردانده می‌شود
    return "";
}

/**
 * دریافت مسیر تصویر برای بخش‌های مختلف صفحه امکانات
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar) - تنها برای سازگاری با API قبلی
 * @return string مسیر تصویر
 */
function getFacilityImagePath($field_key, $lang = null) {
    global $db;
    
    // مسیرهای تصویر مستقل از زبان هستند
    $query = "SELECT image_path 
              FROM temp_facilities_content 
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
 * دریافت محتوای بخش مقدمه (Introduction) صفحه امکانات
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه حاوی عناوین و توضیحات بخش مقدمه
 */
function getFacilityIntroContent($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getFacilityStaticContent('intro_title', $lang),
        'subtitle' => getFacilityStaticContent('intro_subtitle', $lang),
        'description' => getFacilityStaticContent('intro_description', $lang),
        'image' => getFacilityImagePath('intro_description') // مسیر تصویر مستقل از زبان
    ];
}

/**
 * دریافت تمام بخش‌های امکانات و خدمات
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه‌ای از بخش‌های امکانات
 */
function getFacilityItems($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $query = "SELECT c.content_id, c.image_path, t.content_value
              FROM temp_facilities_content c
              JOIN temp_facilities_translations t ON c.content_id = t.content_id
              WHERE c.field_key = 'facility_item' 
              AND t.language_id = ? 
              AND c.is_repeatable = 1 
              ORDER BY c.sort_order ASC";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = json_decode($row['content_value'], true);
            // اگر محتوا JSON نیست، از متن اصلی استفاده کن
            if ($item === null) {
                $item = ['title' => $row['content_value']];
            }
            $item['image'] = $row['image_path'];
            $items[] = $item;
        }
    }
    
    return $items;
}