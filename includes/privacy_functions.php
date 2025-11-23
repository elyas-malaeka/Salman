<?php
/**
 * توابع کمکی برای صفحه حریم خصوصی
 * 
 * این فایل شامل توابعی است که محتوا را از جدول temp_privacy_content و temp_privacy_translations در دیتابیس دریافت می‌کنند.
 * نسخه بازنویسی شده با تمرکز بر کارکرد صحیح و قابلیت اطمینان
 * 
 * @package Salman Educational Complex
 * @version 4.0
 */

/**
 * دریافت محتوای ثابت از جدول temp_privacy_content
 *
 * @param string $field_key کلید فیلد
 * @param string $lang زبان مورد نظر (اختیاری)
 * @param string $default مقدار پیش‌فرض در صورت عدم وجود
 * @return string محتوای فیلد
 */
function getPrivacyContent($field_key, $lang = null, $default = '') {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    if (empty($field_key)) {
        error_log('Empty field_key passed to getPrivacyContent');
        return $default;
    }
    
    try {
        $field_key = mysqli_real_escape_string($db, $field_key);
        $lang = mysqli_real_escape_string($db, $lang);
        
        $query = "SELECT t.content_value 
                FROM temp_privacy_content c
                JOIN temp_privacy_translations t ON c.content_id = t.content_id
                WHERE c.field_key = '{$field_key}' 
                AND t.language_id = '{$lang}' 
                AND c.is_active = 1
                LIMIT 1";
                
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            error_log("Database error in getPrivacyContent: " . mysqli_error($db));
            return $default;
        }
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['content_value'] === null || $row['content_value'] === '') {
                return $default;
            }
            return formatPrivacyContent($row['content_value']);
        } else {
            // لگاردهی و استفاده از مقدار پیش‌فرض
            error_log("Privacy content not found for key: {$field_key}, language: {$lang}");
            return $default;
        }
    } catch (Exception $e) {
        error_log("Error in getPrivacyContent: " . $e->getMessage());
        return $default;
    }
}

/**
 * فرمت‌دهی محتوای متنی برای بهبود نمایش
 *
 * @param string $content محتوای اصلی
 * @return string محتوای فرمت‌شده
 */
function formatPrivacyContent($content) {
    if (empty($content)) {
        return '';
    }
    
    try {
        // تبدیل URLs به لینک
        $content = preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $content);
        
        // برجسته کردن عبارت‌های مهم
        $highlightTerms = [
            'fa' => ['حریم خصوصی', 'داده‌های شخصی', 'اطلاعات شخصی', 'کوکی‌ها'],
            'en' => ['Privacy', 'Personal Data', 'Personal Information', 'Cookies'],
            'ar' => ['الخصوصية', 'البيانات الشخصية', 'المعلومات الشخصية', 'ملفات تعريف الارتباط']
        ];
        
        $lang = getCurrentLanguage();
        if (isset($highlightTerms[$lang])) {
            foreach ($highlightTerms[$lang] as $term) {
                // استفاده از عبارت منظم برای جلوگیری از جایگزینی تکراری
                $pattern = '/(?<!<strong>)(' . preg_quote($term, '/') . ')(?!<\/strong>)/i';
                $content = preg_replace($pattern, '<strong>$1</strong>', $content);
            }
        }
        
        return $content;
    } catch (Exception $e) {
        error_log("Error in formatPrivacyContent: " . $e->getMessage());
        return $content; // برگرداندن محتوای اصلی در صورت خطا
    }
}

/**
 * دریافت آخرین تاریخ به‌روزرسانی محتوای حریم خصوصی
 *
 * @param string $format فرمت تاریخ (در صورت نیاز به فرمت خاص)
 * @return string تاریخ آخرین به‌روزرسانی
 */
function getPrivacyLastUpdateDate($format = 'Y-m-d') {
    global $db;
    
    try {
        $query = "SELECT MAX(updated_at) as last_update 
                FROM temp_privacy_translations";
                
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            error_log("Database error in getPrivacyLastUpdateDate: " . mysqli_error($db));
            return date($format); // تاریخ فعلی به عنوان پیش‌فرض
        }
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['last_update']) {
                return date($format, strtotime($row['last_update']));
            }
        }
        
        return date($format); // تاریخ فعلی به عنوان پیش‌فرض
    } catch (Exception $e) {
        error_log("Error in getPrivacyLastUpdateDate: " . $e->getMessage());
        return date($format); // تاریخ فعلی به عنوان پیش‌فرض
    }
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
    
    if (empty($section_id)) {
        error_log('Empty section_id passed to getPrivacyRepeatableItems');
        return [];
    }
    
    $items = [];
    
    try {
        $section_id = mysqli_real_escape_string($db, $section_id);
        $lang = mysqli_real_escape_string($db, $lang);
        
        $query = "SELECT c.field_key, t.content_value, c.content_id
                FROM temp_privacy_content c
                JOIN temp_privacy_translations t ON c.content_id = t.content_id
                WHERE c.section_id = '{$section_id}' 
                AND t.language_id = '{$lang}' 
                AND c.is_repeatable = 1 
                AND c.is_active = 1
                ORDER BY c.sort_order ASC";
                
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            error_log("Database error in getPrivacyRepeatableItems: " . mysqli_error($db));
            return $items;
        }
        
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = [
                'field_key' => $row['field_key'],
                'content' => formatPrivacyContent($row['content_value']),
                'content_id' => $row['content_id']
            ];
        }
        
        return $items;
    } catch (Exception $e) {
        error_log("Error in getPrivacyRepeatableItems: " . $e->getMessage());
        return $items;
    }
}

/**
 * دریافت آیتم‌های جفتی (عنوان و متن) از یک بخش
 * 
 * این تابع برای بخش‌هایی استفاده می‌شود که در آنها هر آیتم دارای یک عنوان و یک متن است
 * مانند بخش کوکی‌ها و اشتراک‌گذاری
 *
 * @param string $section_id شناسه بخش
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از جفت‌های عنوان و متن
 */
function getPrivacyPairedItems($section_id, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    if (empty($section_id)) {
        error_log('Empty section_id passed to getPrivacyPairedItems');
        return [];
    }
    
    $items = [];
    
    try {
        $section_id = mysqli_real_escape_string($db, $section_id);
        $lang = mysqli_real_escape_string($db, $lang);
        
        $query = "SELECT c.field_key, t.content_value, c.sort_order
                FROM temp_privacy_content c
                JOIN temp_privacy_translations t ON c.content_id = t.content_id
                WHERE c.section_id = '{$section_id}' 
                AND t.language_id = '{$lang}' 
                AND c.is_repeatable = 1 
                AND c.is_active = 1
                ORDER BY c.sort_order ASC";
                
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            error_log("Database error in getPrivacyPairedItems: " . mysqli_error($db));
            return $items;
        }
        
        $current_pair = [];
        $pair_index = -1;
        
        while ($row = mysqli_fetch_assoc($result)) {
            if (strpos($row['field_key'], 'title') !== false || strpos($row['field_key'], 'question') !== false) {
                // این یک عنوان جدید است
                $pair_index++;
                $items[$pair_index] = [
                    'title' => formatPrivacyContent($row['content_value']),
                    'text' => '' // مقدار پیش‌فرض برای متن
                ];
            } elseif ((strpos($row['field_key'], 'text') !== false || strpos($row['field_key'], 'answer') !== false) && $pair_index >= 0) {
                // این متن مربوط به عنوان قبلی است
                $items[$pair_index]['text'] = formatPrivacyContent($row['content_value']);
            }
        }
        
        return $items;
    } catch (Exception $e) {
        error_log("Error in getPrivacyPairedItems: " . $e->getMessage());
        return $items;
    }
}

/**
 * دریافت سوالات متداول
 * روش اصلاح شده با استفاده از پرس‌وجوی ساده‌تر
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array آرایه‌ای از سوالات و پاسخ‌ها
 */
function getPrivacyFaqItems($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $items = [];
    
    try {
        $lang = mysqli_real_escape_string($db, $lang);
        
        // روش ساده‌تر: استفاده از زیرپرس‌وجو
        $query = "SELECT 
                q.content_value as question, 
                a.content_value as answer
            FROM 
                (SELECT c.content_id, c.sort_order, t.content_value 
                FROM temp_privacy_content c
                JOIN temp_privacy_translations t ON c.content_id = t.content_id
                WHERE c.section_id = 'faq_items'
                AND c.field_key = 'faq_item_question'
                AND t.language_id = '{$lang}'
                AND c.is_active = 1) q
            LEFT JOIN
                (SELECT c.sort_order, t.content_value 
                FROM temp_privacy_content c
                JOIN temp_privacy_translations t ON c.content_id = t.content_id
                WHERE c.section_id = 'faq_items'
                AND c.field_key = 'faq_item_answer'
                AND t.language_id = '{$lang}'
                AND c.is_active = 1) a
            ON a.sort_order = q.sort_order + 1
            ORDER BY q.sort_order ASC";
        
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            error_log("Database error in getPrivacyFaqItems: " . mysqli_error($db));
            return $items;
        }
        
        while ($row = mysqli_fetch_assoc($result)) {
            if (!empty($row['question']) && !empty($row['answer'])) {
                $items[] = [
                    'question' => formatPrivacyContent($row['question']),
                    'answer' => formatPrivacyContent($row['answer'])
                ];
            }
        }
        
        return $items;
    } catch (Exception $e) {
        error_log("Error in getPrivacyFaqItems: " . $e->getMessage());
        return $items;
    }
}

/**
 * دریافت دیتا برای بخش کوکی‌ها
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش کوکی‌ها
 */
function getCookiesData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('cookies_title', $lang),
            'text_1' => getPrivacyContent('cookies_text_1', $lang),
            'text_2' => getPrivacyContent('cookies_text_2', $lang),
            'text_3' => getPrivacyContent('cookies_text_3', $lang),
            'items' => getPrivacyPairedItems('cookies_items', $lang),
            'settings' => [
                'title' => getPrivacyContent('cookie_settings_title', $lang),
                'description' => getPrivacyContent('cookie_settings_description', $lang),
                'essential_title' => getPrivacyContent('cookie_essential_title', $lang),
                'essential_description' => getPrivacyContent('cookie_essential_description', $lang),
                'preference_title' => getPrivacyContent('cookie_preference_title', $lang),
                'preference_description' => getPrivacyContent('cookie_preference_description', $lang),
                'analytics_title' => getPrivacyContent('cookie_analytics_title', $lang),
                'analytics_description' => getPrivacyContent('cookie_analytics_description', $lang),
                'save' => getPrivacyContent('cookie_settings_save', $lang),
                'reject' => getPrivacyContent('cookie_settings_reject', $lang),
                'accept' => getPrivacyContent('cookie_settings_accept', $lang)
            ]
        ];
    } catch (Exception $e) {
        error_log("Error in getCookiesData: " . $e->getMessage());
        
        // مقادیر پیش‌فرض در صورت خطا
        return [
            'title' => 'Cookies',
            'text_1' => '',
            'text_2' => '',
            'text_3' => '',
            'items' => [],
            'settings' => [
                'title' => 'Cookie Settings',
                'description' => '',
                'essential_title' => 'Essential Cookies',
                'essential_description' => '',
                'preference_title' => 'Preference Cookies',
                'preference_description' => '',
                'analytics_title' => 'Analytics Cookies',
                'analytics_description' => '',
                'save' => 'Save Settings',
                'reject' => 'Reject All',
                'accept' => 'Accept All'
            ]
        ];
    }
}

/**
 * دریافت دیتا برای بخش اشتراک‌گذاری
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش اشتراک‌گذاری
 */
function getSharingData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('sharing_title', $lang),
            'text' => getPrivacyContent('sharing_text', $lang),
            'items' => getPrivacyPairedItems('sharing_items', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getSharingData: " . $e->getMessage());
        return [
            'title' => 'Information Sharing',
            'text' => '',
            'items' => []
        ];
    }
}

/**
 * دریافت دیتا برای بخش امنیت
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش امنیت
 */
function getSecurityData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('security_title', $lang),
            'text_1' => getPrivacyContent('security_text_1', $lang),
            'text_2' => getPrivacyContent('security_text_2', $lang),
            'items' => getPrivacyRepeatableItems('security_items', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getSecurityData: " . $e->getMessage());
        return [
            'title' => 'Data Security',
            'text_1' => '',
            'text_2' => '',
            'items' => []
        ];
    }
}

/**
 * دریافت دیتا برای بخش حقوق کاربران
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش حقوق کاربران
 */
function getRightsData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('rights_title', $lang),
            'text' => getPrivacyContent('rights_text', $lang),
            'contact' => getPrivacyContent('rights_contact', $lang),
            'items' => getPrivacyRepeatableItems('rights_items', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getRightsData: " . $e->getMessage());
        return [
            'title' => 'Your Privacy Rights',
            'text' => '',
            'contact' => '',
            'items' => []
        ];
    }
}

/**
 * دریافت دیتا برای بخش حریم خصوصی کودکان
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش حریم خصوصی کودکان
 */
function getChildrenData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('children_title', $lang),
            'text' => getPrivacyContent('children_text', $lang),
            'callout' => getPrivacyContent('children_callout', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getChildrenData: " . $e->getMessage());
        return [
            'title' => 'Children\'s Privacy',
            'text' => '',
            'callout' => ''
        ];
    }
}

/**
 * دریافت دیتا برای بخش جمع‌آوری اطلاعات
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش جمع‌آوری اطلاعات
 */
function getCollectionData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('collection_title', $lang),
            'text_1' => getPrivacyContent('collection_text_1', $lang),
            'text_2' => getPrivacyContent('collection_text_2', $lang),
            'subtitle_1' => getPrivacyContent('collection_subtitle_1', $lang),
            'subtitle_2' => getPrivacyContent('collection_subtitle_2', $lang),
            'text_3' => getPrivacyContent('collection_text_3', $lang),
            'student_items' => getPrivacyRepeatableItems('collection_items_1', $lang),
            'online_items' => getPrivacyRepeatableItems('collection_items_2', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getCollectionData: " . $e->getMessage());
        return [
            'title' => 'Information We Collect',
            'text_1' => '',
            'text_2' => '',
            'subtitle_1' => '',
            'subtitle_2' => '',
            'text_3' => '',
            'student_items' => [],
            'online_items' => []
        ];
    }
}

/**
 * دریافت دیتا برای بخش استفاده از اطلاعات
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش استفاده از اطلاعات
 */
function getUsageData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('usage_title', $lang),
            'text' => getPrivacyContent('usage_text', $lang),
            'items' => getPrivacyRepeatableItems('usage_items', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getUsageData: " . $e->getMessage());
        return [
            'title' => 'How We Use Your Information',
            'text' => '',
            'items' => []
        ];
    }
}

/**
 * دریافت دیتا برای بخش مقدمه
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش مقدمه
 */
function getIntroductionData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('intro_title', $lang),
            'text_1' => getPrivacyContent('intro_text_1', $lang),
            'text_2' => getPrivacyContent('intro_text_2', $lang),
            'callout' => getPrivacyContent('intro_callout', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getIntroductionData: " . $e->getMessage());
        return [
            'title' => 'Introduction',
            'text_1' => '',
            'text_2' => '',
            'callout' => ''
        ];
    }
}

/**
 * دریافت دیتا برای بخش سوالات متداول
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش سوالات متداول
 */
function getFaqData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('faq_title', $lang),
            'description' => getPrivacyContent('faq_description', $lang),
            'items' => getPrivacyFaqItems($lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getFaqData: " . $e->getMessage());
        return [
            'title' => 'Frequently Asked Questions',
            'description' => '',
            'items' => []
        ];
    }
}

/**
 * دریافت دیتا برای بخش تماس سریع
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش تماس سریع
 */
function getQuickContactData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('quick_contact_title', $lang),
            'description' => getPrivacyContent('quick_contact_description', $lang),
            'button' => getPrivacyContent('quick_contact_button', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getQuickContactData: " . $e->getMessage());
        $defaultText = $lang == 'fa' ? 'سؤالات مربوط به حریم خصوصی' : 
                      ($lang == 'en' ? 'Questions About Privacy Policy' : 'أسئلة حول سياسة الخصوصية');
        
        $defaultDesc = $lang == 'fa' ? 'برای پرسش‌های مربوط به نحوه حفاظت از اطلاعات شخصی، لطفاً با دفتر مجتمع آموزشی سلمان فارسی تماس بگیرید.' : 
                      ($lang == 'en' ? 'For questions regarding how we protect your personal information, please contact Salman Farsi Educational Complex office.' : 
                      'للاستفسارات المتعلقة بكيفية حماية معلوماتك الشخصية، يرجى الاتصال بمكتب مجمع سلمان الفارسي التعليمي.');
        
        $defaultBtn = $lang == 'fa' ? 'صفحه تماس با ما' : 
                     ($lang == 'en' ? 'Contact Us Page' : 'صفحة اتصل بنا');
        
        return [
            'title' => $defaultText,
            'description' => $defaultDesc,
            'button' => $defaultBtn
        ];
    }
}

/**
 * دریافت دیتا برای بخش تغییرات سیاست
 *
 * @param string $lang زبان مورد نظر (اختیاری)
 * @return array دیتای کامل بخش تغییرات سیاست
 */
function getChangesData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        return [
            'title' => getPrivacyContent('changes_title', $lang),
            'text_1' => getPrivacyContent('changes_text_1', $lang),
            'text_2' => getPrivacyContent('changes_text_2', $lang)
        ];
    } catch (Exception $e) {
        error_log("Error in getChangesData: " . $e->getMessage());
        return [
            'title' => 'Changes to This Privacy Policy',
            'text_1' => '',
            'text_2' => ''
        ];
    }
}

/**
 * دریافت اطلاعات بخش تماس با ما
 * بازنویسی شده برای اطمینان از دریافت برچسب‌ها از دیتابیس
 * 
 * @param string $lang کد زبان
 * @return array آرایه حاوی اطلاعات تماس
 */
function getContactData($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    try {
        // عنوان و توضیحات
        $title = getPrivacyContent('contact_title', $lang);
        $text = getPrivacyContent('contact_text', $lang);
        
        // برچسب‌های تماس
        $emailLabel = getPrivacyContent('contact_email_label', $lang);
        $addressLabel = getPrivacyContent('contact_address_label', $lang);
        $phoneLabel = getPrivacyContent('contact_phone_label', $lang);
        
        // اگر برچسب‌ها موجود نیستند، استفاده از مقادیر پیش‌فرض
        if (empty($emailLabel)) {
            $emailLabel = $lang == 'fa' ? 'ایمیل' : ($lang == 'en' ? 'Email' : 'البريد الإلكتروني');
        }
        
        if (empty($addressLabel)) {
            $addressLabel = $lang == 'fa' ? 'آدرس' : ($lang == 'en' ? 'Address' : 'العنوان');
        }
        
        if (empty($phoneLabel)) {
            $phoneLabel = $lang == 'fa' ? 'تلفن' : ($lang == 'en' ? 'Phone' : 'الهاتف');
        }
        
        // اطلاعات تماس از جدول core_config
        $email = getSiteConfig('contact_email');
        
        // آدرس متناسب با زبان
        $address_key = ($lang != 'fa') ? "contact_address_$lang" : "contact_address";
        $address = getSiteConfig($address_key);
        
        // شماره تلفن
        $phone = getSiteConfig('contact_phone');
        
        // تاریخ آخرین به‌روزرسانی
        $lastUpdated = getPrivacyContent('last_updated', $lang);
        
        // گزارش‌دهی
        error_log("Contact data retrieved - Email: $email, Address Key: $address_key, Address: $address, Phone: $phone");
        
        return [
            'title' => $title,
            'text' => $text,
            'email' => $email,
            'labels' => [
                'email' => $emailLabel,
                'address' => $addressLabel,
                'phone' => $phoneLabel
            ],
            'site_contact' => [
                'address' => $address,
                'phone' => $phone
            ],
            'last_updated' => $lastUpdated
        ];
    } catch (Exception $e) {
        error_log("Error in getContactData: " . $e->getMessage());
        
        // مقادیر پیش‌فرض در صورت خطا
        return [
            'title' => $lang == 'fa' ? 'تماس با ما' : ($lang == 'en' ? 'Contact Us' : 'اتصل بنا'),
            'text' => '',
            'email' => 'info@ir-salmanfarsi.com',
            'labels' => [
                'email' => $lang == 'fa' ? 'ایمیل' : ($lang == 'en' ? 'Email' : 'البريد الإلكتروني'),
                'address' => $lang == 'fa' ? 'آدرس' : ($lang == 'en' ? 'Address' : 'العنوان'),
                'phone' => $lang == 'fa' ? 'تلفن' : ($lang == 'en' ? 'Phone' : 'الهاتف')
            ],
            'site_contact' => [
                'address' => $lang == 'fa' ? 'امارات متحده عربی - دبی - القصیص - القصیص ۱' : 
                    ($lang == 'en' ? 'Al Qusais 1, Al Qusais, Dubai, United Arab Emirates' : 
                    'الإمارات العربية المتحدة - دبي - القصيص - القصيص ١'),
                'phone' => '+971 4 298 8116'
            ],
            'last_updated' => $lang == 'fa' ? 'آخرین به‌روزرسانی:' : ($lang == 'en' ? 'Last Updated:' : 'آخر تحديث:')
        ];
    }
}

/**
 * دریافت تنظیمات وب‌سایت از جدول core_config
 * بازنویسی شده برای اطمینان از عملکرد صحیح و مدیریت خطا
 *
 * @param string $key کلید تنظیمات
 * @param string $default مقدار پیش‌فرض در صورت عدم وجود
 * @return string مقدار تنظیمات
 */
function getSiteConfig($key, $default = '') {
    global $db;
    
    if (empty($key)) {
        error_log('Empty key passed to getSiteConfig');
        return $default;
    }
    
    try {
        $key = mysqli_real_escape_string($db, $key);
        
        $query = "SELECT config_value FROM core_config WHERE config_key = '{$key}' LIMIT 1";
        $result = mysqli_query($db, $query);
        
        if (!$result) {
            error_log("Database error in getSiteConfig: " . mysqli_error($db));
            return $default;
        }
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['config_value'];
        } else {
            error_log("Site config not found for key: {$key}, using default");
            return $default;
        }
    } catch (Exception $e) {
        error_log("Error in getSiteConfig: " . $e->getMessage());
        return $default;
    }
}

/**
 * دریافت آیکون مناسب برای بخش‌های امنیت
 *
 * @param int $index اندیس آیتم
 * @return string کلاس آیکون FontAwesome
 */
function getSecurityIcon($index) {
    $icons = [
        'fa-lock',
        'fa-user-lock',
        'fa-shield-alt',
        'fa-users-cog'
    ];
    
    return isset($icons[$index]) ? $icons[$index] : 'fa-shield-alt';
}

/**
 * دریافت آیکون مناسب برای بخش حقوق کاربران
 *
 * @param int $index اندیس آیتم
 * @return string کلاس آیکون FontAwesome
 */
function getRightsIcon($index) {
    $icons = [
        'fa-eye',
        'fa-edit',
        'fa-trash-alt',
        'fa-ban',
        'fa-exchange-alt',
        'fa-exclamation-circle'
    ];
    
    return isset($icons[$index]) ? $icons[$index] : 'fa-user-shield';
}