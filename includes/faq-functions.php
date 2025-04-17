<?php
/**
 * توابع دریافت محتوای صفحه FAQ از دیتابیس
 * این فایل باید در مسیر includes/faq-functions.php ذخیره شود
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
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM faq_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 0 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
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
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM faq_content 
              WHERE field_key = 'category' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $categories = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $category = json_decode($row['content'], true);
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
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    // تهیه لیست دسته‌بندی‌ها برای استفاده در WHERE IN
    $categoryIds = array_keys($categories);
    $categoryIdsString = "'" . implode("','", $categoryIds) . "'";
    
    $query = "SELECT content, category_id FROM faq_content 
              WHERE field_key = 'faq_item' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              AND category_id IN ({$categoryIdsString})
              ORDER BY category_id, sort_order ASC";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item = json_decode($row['content'], true);
            $categoryId = $row['category_id'];
            
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