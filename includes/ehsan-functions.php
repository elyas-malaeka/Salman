<?php
/**
 * توابع کمکی برای دریافت محتوای صفحه بخش احسان (Ehsan SOD) از دیتابیس
 * این فایل باید در مسیر includes/ehsan-functions.php ذخیره شود
 */

/**
 * دریافت محتوای متنی ثابت صفحه بخش احسان
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar)
 * @return string محتوای متنی یا مقدار پیش‌فرض
 */
function getEhsanContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM ehsan_content 
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
 * دریافت مسیر تصویر برای بخش‌های مختلف صفحه بخش احسان
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar)
 * @return string مسیر تصویر
 */
function getEhsanImagePath($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT image_path FROM ehsan_content 
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
 * دریافت محتوای بخش مقدمه صفحه بخش احسان
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه حاوی عناوین و توضیحات بخش مقدمه
 */
function getEhsanIntroContent($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getEhsanContent('intro_title', $lang),
        'description1' => getEhsanContent('intro_description_1', $lang),
        'description2' => getEhsanContent('intro_description_2', $lang),
        'image' => getEhsanImagePath('intro_description_2', $lang)
    ];
}

/**
 * دریافت اهداف بخش احسان
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه‌ای از اهداف
 */
function getEhsanObjectives($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM ehsan_content 
              WHERE field_key = 'objective_item' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item = json_decode($row['content'], true);
            $items[] = $item;
        }
    }
    
    return $items;
}

/**
 * دریافت محتوای بخش گفتاردرمانی
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه حاوی عناوین، توضیحات و تصاویر بخش گفتاردرمانی
 */
function getEhsanSpeechTherapyContent($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getEhsanContent('speech_therapy_title', $lang),
        'description' => getEhsanContent('speech_therapy_description', $lang),
        'areas_title' => getEhsanContent('speech_therapy_areas_title', $lang),
        'image1' => getEhsanImagePath('speech_therapy_image_1', $lang),
        'image2' => getEhsanImagePath('speech_therapy_image_2', $lang)
    ];
}

/**
 * دریافت حیطه‌های خدمات گفتاردرمانی
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه‌ای از حیطه‌های خدمات
 */
function getEhsanSpeechTherapyAreas($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM ehsan_content 
              WHERE field_key = 'speech_therapy_area' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item = json_decode($row['content'], true);
            $items[] = $item;
        }
    }
    
    return $items;
}

/**
 * دریافت آیتم‌های خدمات ارائه‌شده
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه‌ای از خدمات
 */
function getEhsanServices($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM ehsan_content 
              WHERE field_key = 'service_item' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item = json_decode($row['content'], true);
            $items[] = $item;
        }
    }
    
    return $items;
}

/**
 * دریافت محتوای بخش نتیجه‌گیری
 *
 * @param string $lang کد زبان (fa, en, ar)
 * @return array آرایه حاوی عناوین، توضیحات و تصویر بخش نتیجه‌گیری
 */
function getEhsanConclusionContent($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    return [
        'title' => getEhsanContent('conclusion_title', $lang),
        'description' => getEhsanContent('conclusion_description', $lang),
        'image' => getEhsanImagePath('conclusion_description', $lang),
        'cta_title' => getEhsanContent('cta_title', $lang),
        'cta_description' => getEhsanContent('cta_description', $lang),
        'cta_button_text' => getEhsanContent('cta_button_text', $lang)
    ];
}