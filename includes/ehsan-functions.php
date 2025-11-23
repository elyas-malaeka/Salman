<?php
/**
 * توابع کمکی برای دریافت محتوای صفحه بخش احسان (Ehsan SOD) از دیتابیس
 * این فایل با ساختار جدید جداول ماژولار سازگار شده است
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
    
    // استفاده از prepared statements برای امنیت بیشتر
    $query = "SELECT t.content_value 
              FROM temp_ehsan_content c
              JOIN temp_ehsan_translations t ON c.content_id = t.content_id 
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
 * دریافت مسیر تصویر برای بخش‌های مختلف صفحه بخش احسان
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar) - صرفاً برای سازگاری با API قبلی
 * @return string مسیر تصویر
 */
function getEhsanImagePath($field_key, $lang = null) {
    global $db;
    
    // مسیرهای تصویر مستقل از زبان ذخیره می‌شوند
    $query = "SELECT image_path 
              FROM temp_ehsan_content 
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
        'image' => getEhsanImagePath('intro_description_2')
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
    
    $query = "SELECT c.content_id, t.content_value 
              FROM temp_ehsan_content c
              JOIN temp_ehsan_translations t ON c.content_id = t.content_id 
              WHERE c.field_key = 'objective_item' 
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
            // اگر محتوا JSON نیست، از محتوای اصلی استفاده کن
            if ($item === null) {
                $item = ['content' => $row['content_value']];
            }
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
        'image1' => getEhsanImagePath('speech_therapy_image_1'),
        'image2' => getEhsanImagePath('speech_therapy_image_2')
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
    
    $query = "SELECT c.content_id, t.content_value 
              FROM temp_ehsan_content c
              JOIN temp_ehsan_translations t ON c.content_id = t.content_id
              WHERE c.field_key = 'speech_therapy_area' 
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
            // اگر محتوا JSON نیست، از محتوای اصلی استفاده کن
            if ($item === null) {
                $item = ['content' => $row['content_value']];
            }
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
    
    $query = "SELECT c.content_id, t.content_value 
              FROM temp_ehsan_content c
              JOIN temp_ehsan_translations t ON c.content_id = t.content_id
              WHERE c.field_key = 'service_item' 
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
            // اگر محتوا JSON نیست، از محتوای اصلی استفاده کن
            if ($item === null) {
                $item = ['content' => $row['content_value']];
            }
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
        'image' => getEhsanImagePath('conclusion_description'), // مسیر تصویر بدون نیاز به کد زبان
        'cta_title' => getEhsanContent('cta_title', $lang),
        'cta_description' => getEhsanContent('cta_description', $lang),
        'cta_button_text' => getEhsanContent('cta_button_text', $lang)
    ];
}