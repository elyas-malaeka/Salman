<?php
/**
 * Theme Helpers - توابع کمکی برای مدیریت تم سایت
 */

/**
 * دریافت تنظیمات تم با حداقل وابستگی به ساختار جدول
 * 
 * @param string|null $language زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از تنظیمات تم
 */
function getThemeSettings($language = null) {
    global $db;
    
    $settings = [];
    
    // آیا ستون language_id وجود دارد؟
    $hasLanguageColumn = false;
    $result = mysqli_query($db, "SHOW COLUMNS FROM theme_settings LIKE 'language_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $hasLanguageColumn = true;
    }
    
    // آیا ستون is_active وجود دارد؟
    $hasActiveColumn = false;
    $result = mysqli_query($db, "SHOW COLUMNS FROM theme_settings LIKE 'is_active'");
    if ($result && mysqli_num_rows($result) > 0) {
        $hasActiveColumn = true;
    }
    
    // ساخت کوئری مناسب با ساختار جدول
    $query = "SELECT setting_key, setting_value FROM theme_settings WHERE 1=1";
    
    // اضافه کردن شرط زبان اگر ستون وجود دارد
    if ($hasLanguageColumn && $language !== null) {
        $query .= " AND (language_id = '" . mysqli_real_escape_string($db, $language) . "' OR language_id IS NULL OR language_id = '')";
    }
    
    // اضافه کردن شرط فعال بودن اگر ستون وجود دارد
    if ($hasActiveColumn) {
        $query .= " AND is_active = 1";
    }
    
    $result = mysqli_query($db, $query);
    if (!$result) {
        error_log("خطا در دریافت تنظیمات تم: " . mysqli_error($db));
        return $settings;
    }
    
    while ($row = mysqli_fetch_assoc($result)) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    
    return $settings;
}

/**
 * ذخیره تنظیم تم با سازگاری با ساختارهای مختلف جدول
 * 
 * @param string $key کلید تنظیم
 * @param string $value مقدار جدید
 * @param string|null $language زبان (اختیاری)
 * @return bool نتیجه عملیات
 */
function saveThemeSetting($key, $value, $language = null) {
    global $db;
    
    // خروج در صورت خالی بودن کلید
    if (empty($key)) {
        return false;
    }
    
    // بررسی ساختار جدول
    $hasLanguageColumn = false;
    $result = mysqli_query($db, "SHOW COLUMNS FROM theme_settings LIKE 'language_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $hasLanguageColumn = true;
    }
    
    // ساخت شرط جستجو براساس ساختار جدول
    $searchQuery = "SELECT id FROM theme_settings WHERE setting_key = '" . 
                  mysqli_real_escape_string($db, $key) . "'";
    
    if ($hasLanguageColumn && $language !== null) {
        $searchQuery .= " AND language_id = '" . mysqli_real_escape_string($db, $language) . "'";
    } elseif ($hasLanguageColumn) {
        $searchQuery .= " AND (language_id IS NULL OR language_id = '')";
    }
    
    $result = mysqli_query($db, $searchQuery);
    if (!$result) {
        error_log("خطا در جستجوی تنظیم تم: " . mysqli_error($db));
        return false;
    }
    
    if (mysqli_num_rows($result) > 0) {
        // به‌روزرسانی رکورد موجود
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        
        $updateQuery = "UPDATE theme_settings SET setting_value = '" . 
                       mysqli_real_escape_string($db, $value) . "' WHERE id = " . (int)$id;
        
        return mysqli_query($db, $updateQuery);
    } else {
        // ایجاد رکورد جدید
        $insertQuery = "INSERT INTO theme_settings (setting_key, setting_value";
        $valuesPart = "VALUES ('" . mysqli_real_escape_string($db, $key) . "', '" . 
                      mysqli_real_escape_string($db, $value) . "'";
        
        if ($hasLanguageColumn) {
            $insertQuery .= ", language_id";
            if ($language !== null) {
                $valuesPart .= ", '" . mysqli_real_escape_string($db, $language) . "'";
            } else {
                $valuesPart .= ", NULL";
            }
        }
        
        $insertQuery .= ") " . $valuesPart . ")";
        
        return mysqli_query($db, $insertQuery);
    }
}

/**
 * دریافت مقدار تنظیم با کلید خاص
 * 
 * @param string $key کلید تنظیم
 * @param string $default مقدار پیش‌فرض در صورت عدم وجود
 * @param string|null $language زبان (اختیاری)
 * @return string مقدار تنظیم
 */
function getThemeSetting($key, $default = '', $language = null) {
    global $db;
    
    // بررسی ساختار جدول
    $hasLanguageColumn = false;
    $result = mysqli_query($db, "SHOW COLUMNS FROM theme_settings LIKE 'language_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $hasLanguageColumn = true;
    }
    
    // ساخت کوئری مناسب با ساختار جدول
    $query = "SELECT setting_value FROM theme_settings WHERE setting_key = '" . 
             mysqli_real_escape_string($db, $key) . "'";
    
    if ($hasLanguageColumn && $language !== null) {
        $query .= " AND language_id = '" . mysqli_real_escape_string($db, $language) . "'";
    } elseif ($hasLanguageColumn) {
        $query .= " AND (language_id IS NULL OR language_id = '')";
    }
    
    $result = mysqli_query($db, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        return $default;
    }
    
    $row = mysqli_fetch_assoc($result);
    return $row['setting_value'];
}