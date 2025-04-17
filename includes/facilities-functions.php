<?php
/**
 * توابع کمکی برای دریافت محتوای صفحه امکانات (Facilities) از دیتابیس
 * این فایل باید در مسیر includes/facilities-functions.php ذخیره شود
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
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM facilities_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 0 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    
    // اگر محتوا پیدا نشد، متن پیش‌فرض برگردانده می‌شود
    return "";
}

/**
 * دریافت مسیر تصویر برای بخش‌های مختلف صفحه امکانات
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar)
 * @return string مسیر تصویر
 */
function getFacilityImagePath($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT image_path FROM facilities_content 
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
        'image' => getFacilityImagePath('intro_description', $lang)
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
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content, image_path FROM facilities_content 
              WHERE field_key = 'facility_item' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item = json_decode($row['content'], true);
            $item['image'] = $row['image_path'];
            $items[] = $item;
        }
    }
    
    return $items;
}