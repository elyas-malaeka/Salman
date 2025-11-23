<?php
/**
 * توابع دریافت محتوای صفحه FAQ از دیتابیس
 * این فایل با ساختار جداول جدید ماژولار به‌روزرسانی شده است
 */

/**
 * دریافت محتوای متنی ثابت صفحه FAQ
 *
 * @param string $field_key کلید فیلد محتوا
 * @param string $lang کد زبان (fa, en, ar)
 * @return string محتوای متنی یا مقدار پیش‌فرض
 */
function getFaqStaticContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // استفاده از prepared statements برای امنیت بیشتر
    $query = "SELECT t.content_value 
              FROM temp_faq_content c
              JOIN temp_faq_translations t ON c.content_id = t.content_id
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
    
    // اگر در دیتابیس یافت نشد، از ترجمه‌های آرایه استفاده کن
    return t($field_key, $lang);
}

/**
 * دریافت دسته‌بندی‌های سوالات متداول
 *
 * @param string $lang کد زبان
 * @return array دسته‌بندی‌ها
 */
function getFaqCategories($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $query = "SELECT c.content_id, c.field_key, t.content_value
              FROM temp_faq_content c
              JOIN temp_faq_translations t ON c.content_id = t.content_id
              WHERE c.field_key = 'category' 
              AND t.language_id = ? 
              AND c.is_repeatable = 1 
              ORDER BY c.sort_order ASC";
              
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category = json_decode($row['content_value'], true);
            if ($category === null) {
                // اگر محتوا JSON نیست، تلاش برای استخراج اطلاعات از محتوای خام
                $categoryData = array(
                    'title' => $row['content_value'],
                    'icon' => 'fa-info-circle', // آیکون پیش‌فرض
                    'color' => '#6941C6'        // رنگ پیش‌فرض
                );
                $category = $categoryData;
            }
            
            if ($category && isset($category['id'])) {
                $categories[$category['id']] = [
                    'title' => $category['title'],
                    'icon' => $category['icon'],
                    'color' => $category['color'],
                    'questions' => [] // برای ذخیره سوالات
                ];
            }
        }
    }
    
    // اگر هیچ دسته‌بندی از دیتابیس بازیابی نشد، از آرایه‌های پیش‌فرض استفاده کن
    if (empty($categories)) {
        $categories = [
            'general' => [
                'title' => t('general', $lang),
                'icon' => 'fa-info-circle',
                'color' => '#6941C6',
                'questions' => []
            ],
            'admissions' => [
                'title' => t('admissions', $lang),
                'icon' => 'fa-user-plus',
                'color' => '#9E77ED',
                'questions' => []
            ],
            'services' => [
                'title' => t('services', $lang),
                'icon' => 'fa-hands-helping',
                'color' => '#7F56D9',
                'questions' => []
            ],
            'academics' => [
                'title' => t('academics', $lang),
                'icon' => 'fa-graduation-cap',
                'color' => '#4E36B1',
                'questions' => []
            ]
        ];
    }
    
    return $categories;
}

/**
 * دریافت سوالات متداول برای دسته‌بندی‌ها
 *
 * @param array $categories آرایه دسته‌بندی‌ها
 * @param string $lang کد زبان
 * @return array دسته‌بندی‌ها به همراه سوالات
 */
function getFaqItems($categories, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // تهیه لیست دسته‌بندی‌ها برای استفاده در WHERE IN
    $categoryIds = array_keys($categories);
    
    if (empty($categoryIds)) {
        return $categories;
    }
    
    // استفاده از prepared statements با پارامترهای متعدد
    $placeholders = str_repeat('?,', count($categoryIds) - 1) . '?';
    $types = str_repeat('s', count($categoryIds));
    
    $query = "SELECT c.content_id, c.section_id AS category_id, t.content_value
              FROM temp_faq_content c
              JOIN temp_faq_translations t ON c.content_id = t.content_id
              WHERE c.field_key = 'faq_item' 
              AND t.language_id = ? 
              AND c.is_repeatable = 1 
              AND c.section_id IN ({$placeholders})
              ORDER BY c.section_id, c.sort_order ASC";
              
    $stmt = $db->prepare($query);
    
    // آرایه پارامترها را آماده‌سازی می‌کنیم
    $params = array_merge([$lang], $categoryIds);
    $types = "s" . str_repeat('s', count($categoryIds));
    
    // فراخوانی bind_param با آرایه پارامترها
    $stmt->bind_param($types, ...$params);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categoryId = $row['category_id'];
            $item = json_decode($row['content_value'], true);
            
            // اگر محتوا JSON نیست، تلاش می‌کنیم آن را از ساختار محتوا استخراج کنیم
            if ($item === null) {
                // فرض می‌کنیم که محتوا می‌تواند سؤال یا پاسخ باشد
                // در یک بررسی واقعی، نیاز به منطق بیشتری داریم
                $item = [
                    'question' => $row['content_value'],
                    'answer' => '' // پاسخ خالی
                ];
            }
            
            if (isset($categories[$categoryId]) && isset($item['question']) && isset($item['answer'])) {
                $categories[$categoryId]['questions'][] = [
                    'question' => $item['question'],
                    'answer' => $item['answer']
                ];
            }
        }
    }
    
    // اگر هیچ سوالی برای یک دسته‌بندی بازیابی نشد، از آرایه‌های پیش‌فرض استفاده کن
    foreach ($categories as $categoryId => &$category) {
        if (empty($category['questions'])) {
            switch ($categoryId) {
                case 'general':
                    $category['questions'] = [
                        ['question' => t('faq_language_title', $lang), 'answer' => t('faq_language_answer', $lang)],
                        ['question' => t('faq_hours_title', $lang), 'answer' => t('faq_hours_answer', $lang)],
                        ['question' => t('faq_curriculum_title', $lang), 'answer' => t('faq_curriculum_answer', $lang)],
                        ['question' => t('faq_extracurricular_title', $lang), 'answer' => t('faq_extracurricular_answer', $lang)]
                    ];
                    break;
                case 'admissions':
                    $category['questions'] = [
                        ['question' => t('faq_registration_title', $lang), 'answer' => t('faq_registration_answer', $lang)],
                        ['question' => t('faq_tuition_title', $lang), 'answer' => t('faq_tuition_answer', $lang)],
                        ['question' => t('faq_documents_title', $lang), 'answer' => t('faq_documents_answer', $lang)],
                        ['question' => t('faq_age_requirements_title', $lang), 'answer' => t('faq_age_requirements_answer', $lang)]
                    ];
                    break;
                case 'services':
                    $category['questions'] = [
                        ['question' => t('faq_transportation_title', $lang), 'answer' => t('faq_transportation_answer', $lang)],
                        ['question' => t('faq_special_support_title', $lang), 'answer' => t('faq_special_support_answer', $lang)],
                        ['question' => t('faq_cafeteria_title', $lang), 'answer' => t('faq_cafeteria_answer', $lang)],
                        ['question' => t('faq_healthcare_title', $lang), 'answer' => t('faq_healthcare_answer', $lang)]
                    ];
                    break;
                case 'academics':
                    $category['questions'] = [
                        ['question' => t('faq_assessment_title', $lang), 'answer' => t('faq_assessment_answer', $lang)],
                        ['question' => t('faq_international_exams_title', $lang), 'answer' => t('faq_international_exams_answer', $lang)],
                        ['question' => t('faq_homework_title', $lang), 'answer' => t('faq_homework_answer', $lang)],
                        ['question' => t('faq_counseling_title', $lang), 'answer' => t('faq_counseling_answer', $lang)]
                    ];
                    break;
            }
        }
    }
    
    return $categories;
}