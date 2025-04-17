<?php
/**
 * کلاس سازنده فرم ماژولار چندزبانه
 * 
 * این کلاس برای ساخت و مدیریت فرم‌های ماژولار با قابلیت تنظیم از دیتابیس طراحی شده است.
 * پشتیبانی کامل از چندزبانگی (فارسی، انگلیسی، عربی)
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

class FormBuilder {
    private $db;
    private $langId;
    private $lang;
    private $translations = [];
    
    /**
     * سازنده کلاس
     * 
     * @param mysqli $db اتصال دیتابیس
     * @param int $langId شناسه زبان
     * @param string $lang کد زبان (fa, en, ar)
     */
    public function __construct($db, $langId, $lang = 'fa') {
        $this->db = $db;
        $this->langId = $langId;
        $this->lang = $lang;
        
        // بارگذاری ترجمه‌ها در هنگام ایجاد نمونه
        $this->loadTranslations();
    }
    
    /**
     * بارگذاری ترجمه‌ها از دیتابیس
     */
    private function loadTranslations() {
        $query = "SELECT field_key, content FROM registration_terms_content 
                  WHERE language_id = ? AND is_repeatable = 0";
        
        try {
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("s", $this->lang);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $this->translations[$row['field_key']] = $row['content'];
            }
            
            $stmt->close();
        } catch (Exception $e) {
            error_log("Error loading translations: " . $e->getMessage());
        }
    }
    
    /**
     * دریافت ترجمه‌های بارگذاری شده
     * 
     * @return array آرایه‌ای از ترجمه‌ها
     */
    public function getTranslations() {
        return $this->translations;
    }
    
    /**
     * دریافت ترجمه با کلید مشخص
     * 
     * @param string $key کلید ترجمه
     * @param string $default مقدار پیش‌فرض در صورت عدم وجود ترجمه
     * @return string متن ترجمه شده
     */
    public function getTranslation($key, $default = '') {
        return isset($this->translations[$key]) ? $this->translations[$key] : $default;
    }
    
    /**
     * بارگذاری بخش‌های فرم از دیتابیس
     * 
     * @return array آرایه‌ای از بخش‌های فرم
     */
    public function getSections() {
        $sections = [];
        
        $query = "SELECT s.section_id, s.section_key, s.display_order, 
                         t.section_title, t.section_description
                  FROM form_sections s
                  LEFT JOIN form_section_translations t ON s.section_id = t.section_id
                  WHERE t.language_id = ? AND s.is_active = 1
                  ORDER BY s.display_order";
        
        try {
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("i", $this->langId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $sections[$row['section_id']] = [
                    'id' => $row['section_id'],
                    'key' => $row['section_key'],
                    'title' => $row['section_title'],
                    'description' => $row['section_description'],
                    'display_order' => $row['display_order'],
                    'fields' => $this->getFieldsBySection($row['section_id'])
                ];
            }
            
            $stmt->close();
            
            return $sections;
        } catch (Exception $e) {
            error_log("Error loading form sections: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * بارگذاری فیلدهای یک بخش خاص
     * 
     * @param int $sectionId شناسه بخش
     * @return array آرایه‌ای از فیلدهای بخش
     */
    public function getFieldsBySection($sectionId) {
        $fields = [];
        
        $query = "SELECT f.field_id, f.field_name, f.field_type, f.is_required, 
                         f.validation_rules, f.display_order, f.conditional_logic,
                         f.allowed_file_types, f.max_file_size, 
                         t.field_label, t.field_placeholder, t.field_help_text, t.field_error_message
                  FROM form_fields f
                  LEFT JOIN form_field_translations t ON f.field_id = t.field_id
                  WHERE f.section_id = ? AND t.language_id = ?
                  ORDER BY f.display_order";
        
        try {
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("ii", $sectionId, $this->langId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $fields[$row['field_id']] = [
                    'id' => $row['field_id'],
                    'name' => $row['field_name'],
                    'type' => $row['field_type'],
                    'required' => (bool)$row['is_required'],
                    'label' => $row['field_label'],
                    'placeholder' => $row['field_placeholder'],
                    'help_text' => $row['field_help_text'],
                    'error_message' => $row['field_error_message'],
                    'validation_rules' => $row['validation_rules'],
                    'conditional_logic' => !empty($row['conditional_logic']) ? json_decode($row['conditional_logic'], true) : null,
                    'allowed_file_types' => $row['allowed_file_types'],
                    'max_file_size' => $row['max_file_size'],
                    'options' => $this->getFieldOptions($row['field_id'])
                ];
            }
            
            $stmt->close();
            
            return $fields;
        } catch (Exception $e) {
            error_log("Error loading form fields: " . $e->getMessage());
            return [];
        }
    }
    
    /**
 * دریافت کشورها از جدول گزینه‌های فرم
 * 
 * @return array آرایه‌ای از کشورها
 */
public function getCountriesFromOptions() {
    $countries = [];
    
    $query = "SELECT fo.option_value as value, fot.option_label as label, fo.is_default
              FROM form_options fo
              JOIN form_option_translations fot ON fo.option_id = fot.option_id
              WHERE fo.field_id = 10 
              AND fot.language_id = ?
              ORDER BY fo.display_order";
    
    try {
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->db->error);
        }
        
        $stmt->bind_param("i", $this->langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $countries[] = [
                'value' => $row['value'],
                'label' => $row['label'],
                'is_default' => (bool)$row['is_default']
            ];
        }
        
        $stmt->close();
        
        // If no countries found in database, use hardcoded defaults as fallback
        if (empty($countries)) {
            $countries = [
                ['value' => 'IR', 'label' => $this->getTranslation('iran', 'Iran'), 'is_default' => true],
                ['value' => 'AE', 'label' => $this->getTranslation('uae', 'United Arab Emirates'), 'is_default' => false],
                ['value' => 'AF', 'label' => $this->getTranslation('afghanistan', 'Afghanistan'), 'is_default' => false],
                ['value' => 'PK', 'label' => $this->getTranslation('pakistan', 'Pakistan'), 'is_default' => false],
                ['value' => 'TR', 'label' => $this->getTranslation('turkey', 'Turkey'), 'is_default' => false],
                ['value' => 'IQ', 'label' => $this->getTranslation('iraq', 'Iraq'), 'is_default' => false],
                ['value' => 'KW', 'label' => $this->getTranslation('kuwait', 'Kuwait'), 'is_default' => false],
                ['value' => 'OTHER', 'label' => $this->getTranslation('other_countries', 'Other Countries'), 'is_default' => false]
            ];
        }
        
        return $countries;
    } catch (Exception $e) {
        error_log("Error loading countries from options: " . $e->getMessage());
        
        // Return hardcoded values as fallback
        return [
            ['value' => 'IR', 'label' => $this->getTranslation('iran', 'Iran'), 'is_default' => true],
            ['value' => 'AE', 'label' => $this->getTranslation('uae', 'United Arab Emirates'), 'is_default' => false],
            ['value' => 'AF', 'label' => $this->getTranslation('afghanistan', 'Afghanistan'), 'is_default' => false],
            ['value' => 'PK', 'label' => $this->getTranslation('pakistan', 'Pakistan'), 'is_default' => false],
            ['value' => 'TR', 'label' => $this->getTranslation('turkey', 'Turkey'), 'is_default' => false],
            ['value' => 'IQ', 'label' => $this->getTranslation('iraq', 'Iraq'), 'is_default' => false],
            ['value' => 'KW', 'label' => $this->getTranslation('kuwait', 'Kuwait'), 'is_default' => false],
            ['value' => 'OTHER', 'label' => $this->getTranslation('other_countries', 'Other Countries'), 'is_default' => false]
        ];
    }
}
    /**
     * بارگذاری گزینه‌های یک فیلد انتخابی
     * 
     * @param int $fieldId شناسه فیلد
     * @return array آرایه‌ای از گزینه‌های فیلد
     */
    public function getFieldOptions($fieldId) {
        $options = [];
        
        $query = "SELECT o.option_id, o.option_value, o.display_order, o.is_default, 
                         t.option_label
                  FROM form_options o
                  LEFT JOIN form_option_translations t ON o.option_id = t.option_id
                  WHERE o.field_id = ? AND t.language_id = ?
                  ORDER BY o.display_order";
        
        try {
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("ii", $fieldId, $this->langId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $options[] = [
                    'id' => $row['option_id'],
                    'value' => $row['option_value'],
                    'label' => $row['option_label'],
                    'is_default' => (bool)$row['is_default']
                ];
            }
            
            $stmt->close();
            
            return $options;
        } catch (Exception $e) {
            error_log("Error loading field options: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * تولید کد HTML برای یک فیلد خاص
     * نسخه بهبود یافته با منطق صحیح نمایش مدارک و نیازهای سرویس
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML فیلد
     */
    /**
 * تولید کد HTML برای یک فیلد خاص
 */
public function renderField($field) {
    $output = '';
    
    // کلاس‌های مشترک و ویژگی‌های شرطی
    $containerClass = 'mb-3 form-group';
    $conditionalAttrs = '';
    
    // تعیین کلاس‌های مناسب براساس نوع فیلد
    if (in_array($field['type'], ['textarea']) || 
        stripos($field['name'], 'address') !== false || 
        stripos($field['name'], 'notes') !== false) {
        $containerClass .= ' full-width';
    } else if ($field['type'] === 'file') {
        // افزودن کلاس خاص برای فیلدهای آپلود فایل
        $containerClass .= ' file-field';
    }
        
        // بررسی منطق شرطی
        if (!empty($field['conditional_logic'])) {
            $containerClass .= ' d-none';
            
            if (isset($field['conditional_logic']['show_if'])) {
                $condition = $field['conditional_logic']['show_if'];
                $conditionalAttrs = ' data-condition-field="' . $condition['field'] . '"';
                $conditionalAttrs .= ' data-condition-operator="' . $condition['operator'] . '"';
                $conditionalAttrs .= ' data-condition-value="' . $condition['value'] . '"';
            }
        }
        
        // بهینه‌سازی منطق شرطی برای فیلدهای خاص
        if ($field['name'] === 'nationalIdDoc' || $field['name'] === 'birthCertificate') {
            $conditionalAttrs = ' data-condition-field="nationality" data-condition-operator="==" data-condition-value="IR"';
            $containerClass .= ' d-none'; // پنهان به صورت پیش‌فرض
        } else if ($field['name'] === 'emiratesId') {
            // شناسه امارات برای همه ملیت‌ها نمایش داده می‌شود (بدون شرط)
            $conditionalAttrs = '';
            $containerClass = str_replace('d-none', '', $containerClass);
        } else if ($field['name'] === 'academicCertificate') {
            // مدرک تحصیلی برای همه ملیت‌ها نمایش داده می‌شود (بدون شرط)
            $conditionalAttrs = '';
            $containerClass = str_replace('d-none', '', $containerClass);
        } else if ($field['name'] === 'passportDoc') {
            // پاسپورت برای همه ملیت‌ها نمایش داده می‌شود (بدون شرط)
            $conditionalAttrs = '';
            $containerClass = str_replace('d-none', '', $containerClass);
        } else if ($field['name'] === 'transportationCity' || $field['name'] === 'transportationRoute' || $field['name'] === 'transportationLocation') {
            // فیلدهای سرویس حمل و نقل فقط زمانی نمایش داده می‌شوند که نیاز به سرویس انتخاب شده باشد
            $conditionalAttrs = ' data-condition-field="needTransportation" data-condition-operator="==" data-condition-value="Yes"';
            $containerClass .= ' d-none'; // پنهان به صورت پیش‌فرض
        }
        
        // ایجاد ID کانتینر برای فیلدهای شناسایی و مدارک
        $containerId = '';
        if ($field['name'] === 'nationalId') {
            $containerId = ' id="nationalIdContainer"';
        } else if ($field['name'] === 'passportNumber') {
            $containerId = ' id="passportContainer"';
        } else if ($field['name'] === 'fatherNationalId') {
            $containerId = ' id="fatherNationalIdContainer"';
        } else if ($field['name'] === 'fatherPassportNumber') {
            $containerId = ' id="fatherPassportContainer"';
        } else if ($field['name'] === 'motherNationalId') {
            $containerId = ' id="motherNationalIdContainer"';
        } else if ($field['name'] === 'motherPassportNumber') {
            $containerId = ' id="motherPassportContainer"';
        } else if ($field['name'] === 'emiratesId') {
            $containerId = ' id="emiratesIdContainer"';
        } else if (in_array($field['name'], ['nationalIdDoc', 'birthCertificate'])) {
            if ($field['name'] === 'nationalIdDoc') {
                $containerId = ' id="iranianDocuments"';
            }
            $containerClass .= ' iranian-document';
        } else if ($field['name'] === 'major') {
            $containerId = ' id="majorContainer"';
            $containerClass .= ' d-none'; // پنهان به صورت پیش‌فرض
        } else if ($field['name'] === 'fatherMedicalConditionDetails') {
            $containerId = ' id="fatherMedicalConditionDetailsContainer"';
            $containerClass .= ' d-none'; // پنهان به صورت پیش‌فرض
        } else if ($field['name'] === 'motherMedicalConditionDetails') {
            $containerId = ' id="motherMedicalConditionDetailsContainer"';
            $containerClass .= ' d-none'; // پنهان به صورت پیش‌فرض
        } else if ($field['name'] === 'transportationCity') {
            $containerId = ' id="transportationCityContainer"';
        } else if ($field['name'] === 'transportationRoute') {
            $containerId = ' id="transportationRouteContainer"';
        } else if ($field['name'] === 'transportationLocation') {
            $containerId = ' id="transportationLocationContainer"';
        }
        
        // شروع کانتینر فیلد
        $output .= '<div class="' . $containerClass . '"' . $conditionalAttrs . $containerId . '>';
        
        // نمایش برچسب برای همه به جز checkbox و radio
        if (!in_array($field['type'], ['checkbox', 'radio', 'hidden'])) {
            $requiredClass = $field['required'] ? ' required-field' : '';
            $output .= '<label for="' . $field['name'] . '" class="form-label' . $requiredClass . '">';
            $output .= htmlspecialchars($field['label']);        
            $output .= '</label>';
            
            // افزودن متن راهنما
            if (!empty($field['help_text'])) {
                $output .= '<div class="field-hint mb-2">' . htmlspecialchars($field['help_text']) . '</div>';
            }
        }
        
        // تولید المان مناسب براساس نوع فیلد
        switch ($field['type']) {
            case 'text':
            case 'email':
            case 'tel':
            case 'number':
                $output .= $this->renderInputField($field);
                break;
                
            case 'textarea':
                $output .= $this->renderTextareaField($field);
                break;
                
            case 'select':
                $output .= $this->renderSelectField($field);
                break;
                
            case 'checkbox':
                $output .= $this->renderCheckboxField($field);
                break;
                
            case 'radio':
                $output .= $this->renderRadioField($field);
                break;
                
            case 'file':
                $output .= $this->renderFileField($field);
                break;
                
            case 'date':
                $output .= $this->renderDateField($field);
                break;
                
            case 'hidden':
                $output .= '<input type="hidden" id="' . $field['name'] . '" name="' . $field['name'] . '">';
                break;
        }
        
        // پایان کانتینر فیلد
        $output .= '</div>';
        
        return $output;
    }
    
    /**
     * تولید المان input
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML المان input
     */
    private function renderInputField($field) {
        $required = $field['required'] ? ' required' : '';
        $placeholder = !empty($field['placeholder']) ? ' placeholder="' . htmlspecialchars($field['placeholder']) . '"' : '';
        $validationAttr = '';
        
        if (!empty($field['validation_rules'])) {
            $validationAttr = ' data-validation="' . $field['validation_rules'] . '"';
        }
        
        $output = '<input type="' . $field['type'] . '" class="form-control" id="' . $field['name'] . '" name="' . $field['name'] . '"' . $required . $placeholder . $validationAttr . '>';
        $output .= '<div class="invalid-feedback">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
        
        return $output;
    }
    
    /**
     * تولید المان textarea
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML المان textarea
     */
    private function renderTextareaField($field) {
        $required = $field['required'] ? ' required' : '';
        $placeholder = !empty($field['placeholder']) ? ' placeholder="' . htmlspecialchars($field['placeholder']) . '"' : '';
        
        $output = '<textarea class="form-control" id="' . $field['name'] . '" name="' . $field['name'] . '" rows="3"' . $required . $placeholder . '></textarea>';
        $output .= '<div class="invalid-feedback">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
        
        return $output;
    }
    
    /**
     * تولید المان select
     * نسخه بهبودیافته با افزودن گزینه "بدون نیاز به سرویس"
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML المان select
     */
    private function renderSelectField($field) {
        $required = $field['required'] ? ' required' : '';
        
        $output = '<select class="form-select" id="' . $field['name'] . '" name="' . $field['name'] . '"' . $required . '>';
        $output .= '<option value="" selected disabled>' . $this->getTranslation('select_placeholder', 'Select') . '</option>';
        
        // افزودن گزینه‌ها
        if (!empty($field['options'])) {
            foreach ($field['options'] as $option) {
                $selected = $option['is_default'] ? ' selected' : '';
                $output .= '<option value="' . htmlspecialchars($option['value']) . '"' . $selected . '>';
                $output .= htmlspecialchars($option['label']);
                $output .= '</option>';
            }
        }
        // اگر این فیلد آکادمیک گرید است، پایه‌های تحصیلی را از دیتابیس بارگذاری کن
        else if ($field['name'] === 'academicGrade') {
            $grades = $this->getAcademicGrades();
            foreach ($grades as $grade) {
                $output .= '<option value="' . $grade['id'] . '">';
                $output .= htmlspecialchars($grade['name']);
                $output .= '</option>';
            }
        }
        // اگر این فیلد رشته تحصیلی است، رشته‌ها را از دیتابیس بارگذاری کن
        else if ($field['name'] === 'major') {
            $majors = $this->getMajors();
            foreach ($majors as $major) {
                $output .= '<option value="' . $major['id'] . '">';
                $output .= htmlspecialchars($major['name']);
                $output .= '</option>';
            }
        }
                    // اگر این فیلد ملیت است یا فیلد ملیت والدین، گزینه‌های ملیت را نمایش بده
    else if (strpos($field['name'], 'nationality') !== false || $field['name'] === 'fatherNationality' || $field['name'] === 'motherNationality') {
        $countries = $this->getCountriesFromOptions();
        
        foreach ($countries as $country) {
            $selected = $country['is_default'] ? ' selected' : '';
            $output .= '<option value="' . htmlspecialchars($country['value']) . '"' . $selected . '>';
            $output .= htmlspecialchars($country['label']);
            $output .= '</option>';
        }
    }
        // اگر این فیلد شهر است، گزینه‌های شهر را نمایش بده
        else if ($field['name'] === 'transportationCity') {
            $cities = $this->getTransportationCities();
            foreach ($cities as $city) {
                $output .= '<option value="' . $city['id'] . '">';
                $output .= htmlspecialchars($city['name']);
                $output .= '</option>';
            }
        }
        
        $output .= '</select>';
        $output .= '<div class="invalid-feedback">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
        
        // اضافه کردن المان توضیحات مسیر برای فیلد مسیر
        if ($field['name'] === 'transportationRoute') {
            $output .= '<div id="routeDescription" class="mt-2 small text-muted d-none"></div>';
        }
        
        return $output;
    }
    
    /**
     * تولید المان checkbox
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML المان checkbox
     */
    private function renderCheckboxField($field) {
        $required = $field['required'] ? ' required' : '';
        
        $output = '<div class="form-check">';
        $output .= '<input class="form-check-input" type="checkbox" id="' . $field['name'] . '" name="' . $field['name'] . '"' . $required . '>';
        $output .= '<label class="form-check-label" for="' . $field['name'] . '">' . htmlspecialchars($field['label']) . '</label>';
        $output .= '<div class="invalid-feedback" id="' . $field['name'] . 'Error">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    /**
     * تولید المان input radio
     * نسخه بهبود یافته برای نمایش بهتر گزینه‌های نیاز به سرویس
     * با یکسان‌سازی مقادیر در همه زبان‌ها
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML المان radio
     */
    private function renderRadioField($field) {
        $required = $field['required'] ? ' required' : '';
        
        $output = '<div class="mb-3">';
        
        // برچسب برای رادیو باتن‌ها
        $requiredClass = $field['required'] ? ' required-field' : '';
        $output .= '<label class="form-label' . $requiredClass . '">' . htmlspecialchars($field['label']) . '</label>';
        
        // افزودن کلاس‌های مناسب برای گروه رادیو باتن‌ها
        $radioGroupClass = '';
        if ($field['name'] === 'needTransportation') {
            $radioGroupClass = ' radio-group transportation-radio-group';
        }
        
        $output .= '<div class="radio-options' . $radioGroupClass . '">';
        
        // افزودن گزینه‌ها
        if (!empty($field['options'])) {
            foreach ($field['options'] as $option) {
                $checked = $option['is_default'] ? ' checked' : '';
                $optionClass = '';
                
                // کلاس‌های خاص برای گزینه‌های سرویس
                if ($field['name'] === 'needTransportation') {
                    $optionClass = ' transportation-option';
                    if($option['is_default']) {
                        $optionClass .= ' selected';
                    }
                    
                    // مهم: یکسان‌سازی مقادیر برای سرویس حمل و نقل در همه زبان‌ها
                    // این بخش کلیدی برای حل مشکل است
                    if (strtolower($option['value']) === 'yes' || 
                        $option['value'] === 'بله' || 
                        $option['value'] === 'نعم') {
                        $option['value'] = 'Yes'; // استاندارد کردن مقدار به Yes
                    } else {
                        $option['value'] = 'No'; // استاندارد کردن مقدار به No
                    }
                }
                
                $output .= '<div class="form-check' . $optionClass . '">';
                $output .= '<input class="form-check-input" type="radio" name="' . $field['name'] . '" id="' . $field['name'] . '_' . $option['value'] . '" value="' . htmlspecialchars($option['value']) . '"' . $checked . $required . ' data-field-name="' . $field['name'] . '">';
                $output .= '<label class="form-check-label" for="' . $field['name'] . '_' . $option['value'] . '">' . htmlspecialchars($option['label']) . '</label>';
                $output .= '</div>';
            }
        }
        
        $output .= '</div>'; // radio-options
        
        $output .= '<div class="invalid-feedback">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
        $output .= '</div>';
        
        return $output;
    }
    
    /**
 * تولید المان آپلود فایل - نسخه کاملاً بازنویسی شده
 * 
 * @param array $field اطلاعات فیلد
 * @return string کد HTML المان آپلود فایل
 */
private function renderFileField($field) {
    $required = $field['required'] ? ' required' : '';
    $allowedTypes = !empty($field['allowed_file_types']) ? $field['allowed_file_types'] : 'image/jpeg,image/png,application/pdf';
    $maxSize = !empty($field['max_file_size']) ? $field['max_file_size'] : 2097152; // 2MB default
    
    // تعیین آیکون مناسب
    $icon = 'fa-file-upload';
    if (strpos($field['name'], 'photo') !== false || strpos($field['name'], 'image') !== false) {
        $icon = 'fa-user-plus';
    } else if (strpos($field['name'], 'card') !== false || strpos($field['name'], 'id') !== false) {
        $icon = 'fa-id-card';
    } else if (strpos($field['name'], 'passport') !== false) {
        $icon = 'fa-passport';
    } else if (strpos($field['name'], 'certificate') !== false) {
        $icon = 'fa-graduation-cap';
    }
    
    $output = '';
    
    // کانتینر آپلود فایل - طراحی بهبود یافته
    $output .= '<div class="file-upload-container" id="' . $field['name'] . 'Upload" data-field="' . $field['name'] . '" data-max-size="' . $maxSize . '" data-allowed-types="' . $allowedTypes . '">';
    $output .= '<div class="file-upload-icon"><i class="fas ' . $icon . '"></i></div>';
    $output .= '<div class="file-upload-text">JPEG/PNG/PDF, max size: 5MB</div>';
    $output .= '<div class="file-upload-hint">Click to upload or drag and drop a file here</div>';
    $output .= '<input type="file" class="file-upload-input" name="' . $field['name'] . '" id="' . $field['name'] . '" accept="' . $allowedTypes . '"' . $required . '>';
    $output .= '</div>';
    
    // کانتینر پیش‌نمایش فایل - ساختار جدید با سه بخش مجزا
    $output .= '<div class="file-preview" id="' . $field['name'] . 'Preview" data-field="' . $field['name'] . '">';
    
    // بخش بالایی: تصویر یا آیکون
    $output .= '<div class="preview-top">';
    // اگر فیلد عکس است
    if (strpos($allowedTypes, 'image/') !== false) {
        $output .= '<img src="" alt="' . htmlspecialchars($field['label']) . '" class="file-preview-image">';
    }
    $output .= '<div class="file-preview-icon"><i class="fas fa-file-alt"></i></div>';
    $output .= '</div>';
    
    // بخش میانی: نام و حجم فایل
    $output .= '<div class="preview-middle">';
    $output .= '<div class="file-preview-name"></div>';
    $output .= '<div class="file-preview-size"></div>';
    $output .= '</div>';
    
    // بخش پایینی: دکمه حذف
    $output .= '<div class="preview-bottom">';
    $output .= '<button type="button" class="file-preview-remove"><i class="fas fa-trash-alt"></i> ' . $this->getTranslation('delete_file', 'Remove') . '</button>';
    $output .= '</div>';
    
    $output .= '</div>'; // پایان کانتینر پیش‌نمایش
    
    $output .= '<div class="invalid-feedback" id="' . $field['name'] . 'Error">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
    
    return $output;
}
    
    /**
     * تولید المان date
     * 
     * @param array $field اطلاعات فیلد
     * @return string کد HTML المان date
     */
    private function renderDateField($field) {
        $required = $field['required'] ? ' required' : '';
        
        $output = '<input type="date" class="form-control" id="' . $field['name'] . '" name="' . $field['name'] . '"' . $required . '>';
        $output .= '<div class="invalid-feedback">' . (!empty($field['error_message']) ? htmlspecialchars($field['error_message']) : $this->getTranslation('validation_required', 'This field is required')) . '</div>';
        
        return $output;
    }
    
    /**
     * تبدیل اندازه فایل به فرمت خوانا
     * 
     * @param int $bytes حجم فایل به بایت
     * @return string حجم فایل به فرمت خوانا
     */
    private function formatFileSize($bytes) {
        if ($bytes >= 1024 * 1024) {
            return round($bytes / (1024 * 1024), 2) . ' MB';
        } else if ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' Bytes';
        }
    }
    
    /**
     * ایجاد فرم کامل
     * 
     * @return string کد HTML فرم کامل
     */
    public function buildMultiStepForm() {
        $sections = $this->getSections();
        
        // تعیین مراحل فرم
        $steps = [
            1 => ['student_info'], // مرحله 1: اطلاعات دانش‌آموز
            2 => ['document_uploads'], // مرحله 2: بارگذاری مدارک
            3 => ['father_info'], // مرحله 3: اطلاعات پدر
            4 => ['mother_info'], // مرحله 4: اطلاعات مادر
            5 => ['confirmation'] // مرحله 5: تأیید نهایی
        ];
        
        $output = '';
        
        // اضافه کردن اسکریپت برای تزریق آرایه fileFields و fieldLabels به JavaScript
        $output .= '<script>
            // تزریق آرایه fileFields برای تمام زبان‌ها
            var fileFields = ["profilePhoto", "passportDoc", "nationalIdDoc", "birthCertificate", "academicCertificate", "emiratesId"];
            
            // آماده‌سازی برچسب‌های فیلدها برای استفاده در JavaScript
            var fieldLabels = {};';
        
        // استخراج تمام فیلدها برای تعریف fieldLabels
        $allFields = [];
        foreach ($sections as $section) {
            if (!empty($section['fields'])) {
                foreach ($section['fields'] as $field) {
                    if (!empty($field['name']) && !empty($field['label'])) {
                        $jsFieldName = addslashes($field['name']);
                        $jsFieldLabel = addslashes($field['label']);
                        $output .= "\n            fieldLabels['{$jsFieldName}'] = '{$jsFieldLabel}';";
                    }
                }
            }
        }
        
        // یادداشت در مورد زبان فعلی
        $output .= "\n            // زبان فعلی فرم
            currentLang = '{$this->lang}';
        </script>";
        
        // هشدار خطا
        $output .= '<div class="alert alert-danger d-none" id="formErrors" role="alert"></div>';
        
        // ایجاد مراحل فرم
        foreach ($steps as $stepNumber => $sectionKeys) {
            $isActive = $stepNumber === 1 ? ' active' : '';
            $stepTitle = $this->getTranslation("step{$stepNumber}_title", "Step {$stepNumber}");
            $stepDescription = $this->getTranslation("step{$stepNumber}_description", "");
            
            $output .= '<div class="registration-step' . $isActive . '" id="step' . $stepNumber . '">';
            $output .= '<h2 class="step-title">' . htmlspecialchars($stepTitle) . '</h2>';
            $output .= '<p class="step-description">' . htmlspecialchars($stepDescription) . '</p>';
            
            // یافتن بخش‌های این مرحله
            foreach ($sectionKeys as $sectionKey) {
                foreach ($sections as $section) {
                    if ($section['key'] === $sectionKey) {
                        // ایجاد کارت‌ها و گروه‌بندی فیلدها
                        $this->buildSectionCards($section, $output);
                    }
                }
            }
            
           // دکمه‌های پیمایش با چینش درست برای RTL و LTR
$prevBtnText = $this->getTranslation('prev_button', 'Previous');
$nextBtnText = $this->getTranslation('next_button', 'Next');
$submitBtnText = $this->getTranslation('submit_button', 'Submit');
$reviewBtnText = $this->getTranslation('review_button', 'Review');

// تشخیص جهت زبان
$isRtl = ($this->lang == 'fa' || $this->lang == 'ar');

// دکمه‌های قبلی و بعدی را براساس جهت زبان تنظیم می‌کنیم
$prevButton = '';
$nextButton = '';
$finalButtons = '';

// ساخت دکمه قبلی (به جز مرحله اول)
if ($stepNumber > 1) {
    // آیکون مناسب برای دکمه قبلی در هر جهت
    $prevIcon = $isRtl ? 'arrow-right' : 'arrow-left';
    $prevMargin = $isRtl ? 'ms-2' : 'me-2';
    
    $prevButton = '<button type="button" class="btn btn-prev" data-step="' . $stepNumber . '">';
    $prevButton .= '<i class="fas fa-' . $prevIcon . ' ' . $prevMargin . '"></i>' . $prevBtnText;
    $prevButton .= '</button>';
} else {
    $prevButton = '<div></div>'; // فاصله خالی
}

// ساخت دکمه بعدی
if ($stepNumber < 5) {
    // آیکون مناسب برای دکمه بعدی در هر جهت
    $nextIcon = $isRtl ? 'arrow-left' : 'arrow-right';
    $nextMargin = $isRtl ? 'me-2' : 'ms-2';
    
    $nextButton = '<button type="button" class="btn btn-next" data-step="' . $stepNumber . '">';
    $nextButton .= $nextBtnText . ' <i class="fas fa-' . $nextIcon . ' ' . $nextMargin . '"></i>';
    $nextButton .= '</button>';
} else {
    // دکمه‌های مرحله آخر
    $marginClass = $isRtl ? 'ms-2' : 'me-2';
    
    $finalButtons = '<div>';
    $finalButtons .= '<button type="button" class="btn btn-secondary ' . $marginClass . '" id="reviewButton">';
    $finalButtons .= '<i class="fas fa-eye me-1"></i>' . $reviewBtnText;
    $finalButtons .= '</button>';
    $finalButtons .= '<button type="submit" class="btn btn-primary btn-submit" id="submitButton" disabled>';
    $finalButtons .= '<i class="fas fa-paper-plane me-1"></i>' . $submitBtnText;
    $finalButtons .= '</button>';
    $finalButtons .= '</div>';
}

// ساخت کانتینر دکمه‌ها با ترتیب مناسب براساس جهت
$buttonsHtml = '';

if ($stepNumber < 5) {
    // در مرحله عادی، فقط دکمه‌های قبلی و بعدی
    if ($isRtl) {
        // RTL: ابتدا دکمه بعدی (چپ)، سپس دکمه قبلی (راست)
        $buttonsHtml = '<div class="step-buttons d-flex justify-content-between mt-4">' . $nextButton . $prevButton . '</div>';
    } else {
        // LTR: ابتدا دکمه قبلی (چپ)، سپس دکمه بعدی (راست)
        $buttonsHtml = '<div class="step-buttons d-flex justify-content-between mt-4">' . $prevButton . $nextButton . '</div>';
    }
} else {
    // در مرحله آخر، دکمه‌های خاص مرحله آخر
    if ($isRtl) {
        // RTL: دکمه‌های نهایی در چپ
        $buttonsHtml = '<div class="step-buttons d-flex justify-content-between mt-4">' . $finalButtons . '<div></div></div>';
    } else {
        // LTR: دکمه‌های نهایی در راست
        $buttonsHtml = '<div class="step-buttons d-flex justify-content-between mt-4"><div></div>' . $finalButtons . '</div>';
    }
}

$output .= $buttonsHtml;
            $output .= '</div>'; // پایان مرحله
        }
        
        // فیلدهای مخفی
        $output .= '<input type="hidden" name="currentLang" value="' . $this->lang . '">';
        $output .= '<input type="hidden" name="registerSubmit" value="1">';
        
        return $output;
    }
    
    /**
     * ایجاد کارت‌ها و گروه‌بندی فیلدها در یک بخش
     * 
     * @param array $section اطلاعات بخش
     * @param string &$output متغیر مرجع برای اضافه کردن خروجی HTML
     */
    private function buildSectionCards($section, &$output) {
        if (empty($section['fields'])) {
            return;
        }
        
        // گروه‌بندی فیلدها براساس نوع
        $fieldGroups = $this->groupFieldsByType($section['fields']);
        
        // ترتیب دلخواه برای نمایش کارت‌ها
        $cardOrder = [
            'required_documents_title', // اول مدارک مورد نیاز (عکس پرسنلی)
            'student_photo_title',      // عکس پرسنلی
            'personal_info_title',      // سپس اطلاعات شخصی
            'emergency_contact_title',  // و بعد اطلاعات تماس اضطراری
            'father_personal_info_title',
            'father_contact_info_title',
            'medical_info_title',
            'mother_personal_info_title',
            'mother_contact_info_title',
            'transportation_title',
            'agreement_title',
            'additional_notes_title'
        ];
        
        // ایجاد آرایه ترجمه‌ها برای گروه‌ها
        $cardTranslationKeys = [
            'student_photo_title' => $this->getTranslation('student_photo_title', 'Profile Photo'),
            'personal_info_title' => $this->getTranslation('personal_info_title', 'Personal Information'),
            'emergency_contact_title' => $this->getTranslation('emergency_contact_title', 'Emergency Contact Information'),
            'required_documents_title' => $this->getTranslation('required_documents_title', 'Required Documents'),
            'transportation_title' => $this->getTranslation('transportation_title', 'School Transportation Information'),
            'agreement_title' => $this->getTranslation('agreement_title', 'Rules and Agreements'),
            'father_personal_info_title' => $this->getTranslation('father_personal_info_title', 'Father\'s Personal Information'),
            'father_contact_info_title' => $this->getTranslation('father_contact_info_title', 'Father\'s Contact Information'),
            'medical_info_title' => $this->getTranslation('medical_info_title', 'Medical Information'),
            'mother_personal_info_title' => $this->getTranslation('mother_personal_info_title', 'Mother\'s Personal Information'),
            'mother_contact_info_title' => $this->getTranslation('mother_contact_info_title', 'Mother\'s Contact Information'),
            'additional_notes_title' => $this->getTranslation('additional_notes_title', 'Additional Notes')
        ];
        
        // ترتیب‌بندی گروه‌ها
        $orderedGroups = [];
        foreach ($cardOrder as $cardKey) {
            $cardTitle = $cardTranslationKeys[$cardKey];
            if (isset($fieldGroups[$cardTitle])) {
                $orderedGroups[$cardTitle] = $fieldGroups[$cardTitle];
            }
        }
        
        // اضافه کردن هر گروهی که در ترتیب مشخص نشده است
        foreach ($fieldGroups as $title => $fields) {
            if (!isset($orderedGroups[$title])) {
                $orderedGroups[$title] = $fields;
            }
        }
        
        // ایجاد کارت‌ها با ترتیب تعیین شده
        foreach ($orderedGroups as $groupTitle => $fields) {
            $cardContent = '';
            
            // تشخیص اگر این کارت مربوط به مدارک است
            $isDocumentCard = (strpos($groupTitle, 'Required Documents') !== false || 
                            strpos($groupTitle, 'مدارک مورد نیاز') !== false || 
                            strpos($groupTitle, 'المستندات المطلوبة') !== false);
            
            // کلاس اضافی برای کارت مدارک
            $cardClass = $isDocumentCard ? ' document-card' : '';
            
            // شروع ردیف فرم برای نمایش چند ستونه
            $cardContent .= '<div class="form-row' . ($isDocumentCard ? ' document-form-row' : '') . '">';
            
            // افزودن فیلدها به کارت
            foreach ($fields as $field) {
                $cardContent .= $this->renderField($field);
            }
            
            // پایان ردیف فرم
            $cardContent .= '</div>';
            
            if (!empty($cardContent)) {
                $output .= '<div class="registration-card' . $cardClass . '">';
                $output .= '<h3 class="card-title">' . htmlspecialchars($groupTitle) . '</h3>';
                $output .= $cardContent;
                $output .= '</div>';
            }
        }
    }
    
    /**
     * گروه‌بندی فیلدها براساس نوع برای نمایش در کارت‌ها
     * 
     * @param array $fields آرایه‌ای از فیلدها
     * @return array فیلدهای گروه‌بندی شده
     */
    private function groupFieldsByType($fields) {
        $groups = [];
        
        foreach ($fields as $field) {
            $groupTitle = $this->determineFieldGroup($field);
            
            if (!isset($groups[$groupTitle])) {
                $groups[$groupTitle] = [];
            }
            
            $groups[$groupTitle][] = $field;
        }
        
        return $groups;
    }
    
    /**
     * تعیین گروه مناسب برای هر فیلد
     * 
     * @param array $field اطلاعات فیلد
     * @return string عنوان گروه
     */
    private function determineFieldGroup($field) {
        // تعیین عنوان کارت بر اساس نوع فیلد
        
        // خاص برای فیلد نام پدر - انتقال به اطلاعات شخصی
        if ($field['name'] === 'fatherName') {
            return $this->getTranslation('personal_info_title', 'Personal Information');
        }
        
        if ($field['type'] === 'file') {
            if ($field['name'] === 'profilePhoto') {
                return $this->getTranslation('student_photo_title', 'Profile Photo');
            } else {
                return $this->getTranslation('required_documents_title', 'Required Documents');
            }
        } else if (strpos($field['name'], 'emergency') !== false) {
            return $this->getTranslation('emergency_contact_title', 'Emergency Contact Information');
        } else if (strpos($field['name'], 'transportation') !== false || $field['name'] === 'needTransportation') {
            return $this->getTranslation('transportation_title', 'School Transportation Information');
        } else if (strpos($field['name'], 'agreement') !== false || strpos($field['name'], 'terms') !== false) {
            return $this->getTranslation('agreement_title', 'Rules and Agreements');
        } else if (strpos($field['name'], 'father') !== false) {
            if (strpos($field['name'], 'mobile') !== false || strpos($field['name'], 'email') !== false || 
                strpos($field['name'], 'whatsapp') !== false || strpos($field['name'], 'landline') !== false) {
                return $this->getTranslation('father_contact_info_title', 'Father\'s Contact Information');
            } else {
                return $this->getTranslation('father_personal_info_title', 'Father\'s Personal Information');
            }
        } else if (strpos($field['name'], 'mother') !== false) {
            if (strpos($field['name'], 'mobile') !== false || strpos($field['name'], 'email') !== false || 
                strpos($field['name'], 'whatsapp') !== false || strpos($field['name'], 'landline') !== false) {
                return $this->getTranslation('mother_contact_info_title', 'Mother\'s Contact Information');
            } else {
                return $this->getTranslation('mother_personal_info_title', 'Mother\'s Personal Information');
            }
        } else if (strpos($field['name'], 'medical') !== false) {
            return $this->getTranslation('medical_info_title', 'Medical Information');
        } else if (strpos($field['name'], 'special') !== false || strpos($field['name'], 'notes') !== false) {
            return $this->getTranslation('additional_notes_title', 'Additional Notes');
        }
        
        // پیش‌فرض
        return $this->getTranslation('personal_info_title', 'Personal Information');
    }
    
    /**
     * ایجاد نوار پیشرفت مراحل فرم
     * 
     * @return string کد HTML نوار پیشرفت
     */
    public function buildProgressBar() {
        $output = '<div class="registration-progress">';
        $output .= '<div class="progress-line" id="progressLine"></div>';
        
        for ($step = 1; $step <= 5; $step++) {
            $stepTitle = $this->getTranslation("step{$step}_title", "Step {$step}");
            $activeClass = $step === 1 ? ' active clickable' : '';
            
            $output .= '<div class="progress-step' . $activeClass . '" data-step="' . $step . '">';
            $output .= '<div class="progress-step-icon">' . $step . '</div>';
            $output .= '<div class="progress-step-text">' . htmlspecialchars($stepTitle) . '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        
        return $output;
    }
    
    /**
     * دریافت پایه‌های تحصیلی از دیتابیس
     * 
     * @return array آرایه‌ای از پایه‌های تحصیلی
     */
    public function getAcademicGrades() {
        $grades = [];
        
        $query = "SELECT ag.grade_id, agt.grade_name 
                  FROM academic_grades ag
                  JOIN academic_grade_translations agt ON ag.grade_id = agt.grade_id
                  WHERE agt.language_id = ?
                  ORDER BY ag.grade_id ASC";
        
        try {
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("i", $this->langId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $grades[] = [
                    'id' => $row['grade_id'],
                    'name' => $row['grade_name']
                ];
            }
            
            $stmt->close();
            
            return $grades;
        } catch (Exception $e) {
            error_log("Error loading academic grades: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * دریافت رشته‌های تحصیلی از دیتابیس
     * 
     * @return array آرایه‌ای از رشته‌های تحصیلی
     */
    public function getMajors() {
        $majors = [];
        
        $query = "SELECT m.major_id, mt.major_name 
                  FROM majors m
                  JOIN major_translations mt ON m.major_id = mt.major_id
                  WHERE mt.language_id = ?
                  ORDER BY m.major_id ASC";
        
        try {
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("i", $this->langId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $majors[] = [
                    'id' => $row['major_id'],
                    'name' => $row['major_name']
                ];
            }
            
            $stmt->close();
            
            return $majors;
        } catch (Exception $e) {
            error_log("Error loading majors: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * دریافت شهرهای مربوط به سرویس حمل و نقل
     * 
     * @return array آرایه‌ای از شهرها
     */
    public function getTransportationCities() {
        $cities = [];
        
        $cityKeys = ['dubai', 'sharjah', 'ajman'];
        
        try {
            // روش اول: استفاده از جدول translation با مقادیر کلید/مقدار
            $query = "SELECT field_key, content 
                      FROM registration_terms_content 
                      WHERE field_key IN ('dubai', 'sharjah', 'ajman') 
                      AND language_id = ?";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error: " . $this->db->error);
            }
            
            $stmt->bind_param("s", $this->lang);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $cityNames = [];
            while ($row = $result->fetch_assoc()) {
                $cityNames[$row['field_key']] = $row['content'];
            }
            
            $stmt->close();
            
            // ساخت آرایه نهایی شهرها
            foreach ($cityKeys as $key) {
                if (isset($cityNames[$key])) {
                    $cities[] = [
                        'id' => $key,
                        'name' => $cityNames[$key]
                    ];
                } else {
                    // اگر ترجمه نیافتیم، از نام پیش‌فرض استفاده می‌کنیم
                    $cities[] = [
                        'id' => $key,
                        'name' => ucfirst($key) // تبدیل حرف اول به بزرگ
                    ];
                }
            }
            
            return $cities;
        } catch (Exception $e) {
            error_log("Error loading transportation cities: " . $e->getMessage());
            
            // در صورت بروز خطا، مقادیر پیش‌فرض را برمی‌گردانیم
            return [
                ['id' => 'dubai', 'name' => 'Dubai'],
                ['id' => 'sharjah', 'name' => 'Sharjah'],
                ['id' => 'ajman', 'name' => 'Ajman']
            ];
        }
    }
}
