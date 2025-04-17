<?php
/**
 * توابع مورد نیاز برای صفحه ثبت‌نام
 * 
 * شامل کلاس‌های مدیریت فرم، محتوا، زبان، اعتبارسنجی و ذخیره‌سازی
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */

/**
 * کلاس مدیریت زبان و ترجمه
 */
class LanguageManager {
    private $db;
    private $langCode;
    private $langId;
    private $isRtl;
    
    /**
     * سازنده کلاس
     * 
     * @param mysqli $db اتصال دیتابیس
     * @param string $langCode کد زبان (fa, en, ar)
     */
    public function __construct($db, $langCode = 'fa') {
        $this->db = $db;
        $this->setLanguage($langCode);
    }
    
    /**
     * تنظیم زبان فعلی
     * 
     * @param string $langCode کد زبان
     * @return void
     */
    public function setLanguage($langCode) {
        $this->langCode = $langCode;
        
        // تبدیل کد زبان به شناسه زبان برای کوئری‌ها
        switch ($langCode) {
            case 'en':
                $this->langId = 2;
                $this->isRtl = false;
                break;
            case 'ar':
                $this->langId = 3;
                $this->isRtl = true;
                break;
            default: // فارسی به عنوان پیش‌فرض
                $this->langId = 1;
                $this->isRtl = true;
                break;
        }
    }
    
    /**
     * دریافت کد زبان فعلی
     * 
     * @return string
     */
    public function getLangCode() {
        return $this->langCode;
    }
    
    /**
     * دریافت شناسه زبان فعلی
     * 
     * @return int
     */
    public function getLangId() {
        return $this->langId;
    }
    
    /**
     * بررسی RTL بودن زبان فعلی
     * 
     * @return bool
     */
    public function isRtl() {
        return $this->isRtl;
    }
    
    /**
     * دریافت لیست زبان‌های فعال
     * 
     * @return array لیستی از زبان‌های فعال
     */
    public function getActiveLanguages() {
        $languages = [];
        
        $query = "SELECT language_id, code, name, native_name, is_rtl, is_default 
                 FROM languages 
                 WHERE is_active = 1 
                 ORDER BY is_default DESC, language_id ASC";
        
        $result = $this->db->query($query);
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $languages[] = $row;
            }
        }
        
        return $languages;
    }
}

/**
 * کلاس مدیریت محتوای متنی
 */
class ContentManager {
    private $db;
    private $langManager;
    private $contentCache = [];
    
    /**
     * سازنده کلاس
     * 
     * @param mysqli $db اتصال دیتابیس
     * @param LanguageManager $langManager مدیریت زبان
     */
    public function __construct($db, $langManager) {
        $this->db = $db;
        $this->langManager = $langManager;
        $this->initializeCache();
    }
    
    /**
     * مقداردهی اولیه کش محتوا
     * 
     * @return void
     */
    private function initializeCache() {
        $langCode = $this->langManager->getLangCode();
        
        // بارگیری همه محتوای ثابت برای زبان فعلی
        $query = "SELECT field_key, content FROM registration_terms_content 
                  WHERE language_id = ? AND is_repeatable = 0";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in ContentManager::initializeCache: " . $this->db->error);
            return;
        }
        
        $stmt->bind_param("s", $langCode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $this->contentCache[$row['field_key']] = $row['content'];
        }
        
        $stmt->close();
    }
    
    /**
     * دریافت محتوای متنی با کلید مشخص
     * 
     * @param string $key کلید محتوا
     * @param string $default مقدار پیش‌فرض در صورت عدم وجود
     * @return string محتوای متنی
     */
    public function getContent($key, $default = '') {
        // ابتدا بررسی کش
        if (isset($this->contentCache[$key])) {
            return $this->contentCache[$key];
        }
        
        // اگر در کش نبود، از دیتابیس بخوان
        $langCode = $this->langManager->getLangCode();
        
        $query = "SELECT content FROM registration_terms_content 
                  WHERE field_key = ? AND language_id = ? AND is_repeatable = 0 
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in ContentManager::getContent: " . $this->db->error);
            return $default;
        }
        
        $stmt->bind_param("ss", $key, $langCode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // ذخیره در کش
            $this->contentCache[$key] = $row['content'];
            return $row['content'];
        }
        
        // ثبت لاگ برای کلیدهای یافت نشده
        error_log("Missing content for key: $key in language: $langCode");
        
        return $default;
    }
    
    /**
     * دریافت محتوای تکرارشونده با سکشن مشخص
     * 
     * @param string $sectionId شناسه سکشن
     * @return array لیستی از محتواهای تکرارشونده
     */
    public function getRepeatableContent($sectionId) {
        $items = [];
        $langCode = $this->langManager->getLangCode();
        
        $query = "SELECT field_key, content FROM registration_terms_content 
                  WHERE section_id = ? AND language_id = ? AND is_repeatable = 1 
                  ORDER BY sort_order ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in ContentManager::getRepeatableContent: " . $this->db->error);
            return $items;
        }
        
        $stmt->bind_param("ss", $sectionId, $langCode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $content = $row['content'];
            
            // اگر محتوا JSON باشد، آن را تبدیل کن
            if (strpos($content, '{') === 0) {
                $decoded = json_decode($content, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $items[] = $decoded;
                } else {
                    $items[] = ['content' => $content];
                }
            } else {
                $items[] = ['content' => $content];
            }
        }
        
        return $items;
    }
}

/**
 * کلاس مدیریت فرم و فیلدها
 */
class FormManager {
    private $db;
    private $langManager;
    
    /**
     * سازنده کلاس
     * 
     * @param mysqli $db اتصال دیتابیس
     * @param LanguageManager $langManager مدیریت زبان
     */
    public function __construct($db, $langManager) {
        $this->db = $db;
        $this->langManager = $langManager;
    }
    
    /**
     * دریافت بخش‌های فرم
     * 
     * @return array لیستی از بخش‌های فرم با اطلاعات کامل
     */
    public function getFormSections() {
        $langId = $this->langManager->getLangId();
        $sections = [];
        
        $query = "SELECT s.section_id, s.section_key, s.display_order, 
                         t.section_title, t.section_description
                  FROM form_sections s
                  JOIN form_section_translations t ON s.section_id = t.section_id
                  WHERE t.language_id = ? AND s.is_active = 1
                  ORDER BY s.display_order ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::getFormSections: " . $this->db->error);
            return $sections;
        }
        
        $stmt->bind_param("i", $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $sectionId = $row['section_id'];
            $sections[$sectionId] = [
                'id' => $sectionId,
                'key' => $row['section_key'],
                'title' => $row['section_title'],
                'description' => $row['section_description'],
                'display_order' => $row['display_order'],
                'fields' => [] // فیلدها بعداً اضافه می‌شوند
            ];
        }
        
        // اضافه کردن فیلدهای هر بخش
        if (!empty($sections)) {
            $this->addFieldsToSections($sections);
        }
        
        return $sections;
    }
    
    /**
     * اضافه کردن فیلدها به بخش‌های فرم
     * 
     * @param array &$sections لیست بخش‌ها که به صورت مرجع ارسال می‌شود
     * @return void
     */
    private function addFieldsToSections(&$sections) {
        $langId = $this->langManager->getLangId();
        $sectionIds = array_keys($sections);
        
        // تبدیل آرایه به رشته برای استفاده در کوئری
        $sectionIdsStr = implode(',', $sectionIds);
        
        $query = "SELECT f.field_id, f.field_name, f.field_type, f.is_required, 
                         f.validation_rules, f.display_order, f.section_id, 
                         f.parent_field_id, f.conditional_logic, f.allowed_file_types, 
                         f.max_file_size, t.field_label, t.field_placeholder, 
                         t.field_help_text, t.field_error_message
                  FROM form_fields f
                  JOIN form_field_translations t ON f.field_id = t.field_id
                  WHERE f.section_id IN ({$sectionIdsStr}) AND t.language_id = ?
                  ORDER BY f.section_id ASC, f.display_order ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::addFieldsToSections: " . $this->db->error);
            return;
        }
        
        $stmt->bind_param("i", $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $fieldsWithOptions = []; // لیست فیلدهایی که گزینه دارند
        
        while ($row = $result->fetch_assoc()) {
            $fieldId = $row['field_id'];
            $sectionId = $row['section_id'];
            
            // تبدیل conditional_logic از JSON به آرایه
            $conditionalLogic = null;
            if (!empty($row['conditional_logic'])) {
                $conditionalLogic = json_decode($row['conditional_logic'], true);
            }
            
            // بهینه‌سازی منطق شرطی برای فیلدهای خاص
            if ($row['field_name'] === 'nationalIdDoc' || $row['field_name'] === 'birthCertificate') {
                $conditionalLogic = [
                    'show_if' => [
                        'field' => 'nationality',
                        'operator' => '==',
                        'value' => 'IR'
                    ]
                ];
            } else if ($row['field_name'] === 'emiratesId') {
                $conditionalLogic = [
                    'show_if' => [
                        'field' => 'nationality',
                        'operator' => '==',
                        'value' => 'UAE'
                    ]
                ];
            }
            
            $field = [
                'id' => $fieldId,
                'name' => $row['field_name'],
                'type' => $row['field_type'],
                'label' => $row['field_label'],
                'placeholder' => $row['field_placeholder'],
                'help_text' => $row['field_help_text'],
                'error_message' => $row['field_error_message'],
                'is_required' => (bool)$row['is_required'],
                'validation_rules' => $row['validation_rules'],
                'display_order' => $row['display_order'],
                'parent_field_id' => $row['parent_field_id'],
                'conditional_logic' => $conditionalLogic,
                'allowed_file_types' => $row['allowed_file_types'],
                'max_file_size' => $row['max_file_size']
            ];
            
            // اضافه کردن فیلد به بخش مربوطه
            if (isset($sections[$sectionId])) {
                $sections[$sectionId]['fields'][$fieldId] = $field;
            }
            
            // اگر فیلد از نوع select، radio یا checkbox است، گزینه‌ها بعداً اضافه می‌شوند
            if (in_array($row['field_type'], ['select', 'radio', 'checkbox'])) {
                $fieldsWithOptions[] = $fieldId;
            }
        }
        
        // اضافه کردن گزینه‌ها به فیلدهای مربوطه
        if (!empty($fieldsWithOptions)) {
            $this->addOptionsToFields($sections, $fieldsWithOptions);
        }
    }
    
    /**
     * اضافه کردن گزینه‌ها به فیلدهای مربوطه
     * 
     * @param array &$sections لیست بخش‌ها که به صورت مرجع ارسال می‌شود
     * @param array $fieldIds لیست شناسه‌های فیلدهایی که گزینه دارند
     * @return void
     */
    private function addOptionsToFields(&$sections, $fieldIds) {
        $langId = $this->langManager->getLangId();
        $fieldIdsStr = implode(',', $fieldIds);
        
        $query = "SELECT o.option_id, o.field_id, o.option_value, o.display_order, 
                         o.is_default, t.option_label
                  FROM form_options o
                  JOIN form_option_translations t ON o.option_id = t.option_id
                  WHERE o.field_id IN ({$fieldIdsStr}) AND t.language_id = ?
                  ORDER BY o.field_id ASC, o.display_order ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::addOptionsToFields: " . $this->db->error);
            return;
        }
        
        $stmt->bind_param("i", $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // گروه‌بندی گزینه‌ها بر اساس فیلد
        $optionsByField = [];
        while ($row = $result->fetch_assoc()) {
            $fieldId = $row['field_id'];
            if (!isset($optionsByField[$fieldId])) {
                $optionsByField[$fieldId] = [];
            }
            
            $optionsByField[$fieldId][] = [
                'id' => $row['option_id'],
                'value' => $row['option_value'],
                'label' => $row['option_label'],
                'display_order' => $row['display_order'],
                'is_default' => (bool)$row['is_default']
            ];
        }
        
        // اضافه کردن گزینه‌ها به فیلدهای مربوطه
        foreach ($optionsByField as $fieldId => $options) {
            // پیدا کردن بخش و فیلد مربوطه
            foreach ($sections as &$section) {
                if (isset($section['fields'][$fieldId])) {
                    $section['fields'][$fieldId]['options'] = $options;
                    break;
                }
            }
        }
    }
    
    /**
     * دریافت پایه‌های تحصیلی
     * 
     * @return array لیست پایه‌های تحصیلی
     */
    public function getAcademicGrades() {
        $langId = $this->langManager->getLangId();
        $grades = [];
        
        $query = "SELECT ag.grade_id, agt.grade_name 
                  FROM academic_grades ag
                  JOIN academic_grade_translations agt ON ag.grade_id = agt.grade_id
                  WHERE agt.language_id = ?
                  ORDER BY ag.grade_id ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::getAcademicGrades: " . $this->db->error);
            return $grades;
        }
        
        $stmt->bind_param("i", $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $grades[] = [
                'id' => $row['grade_id'],
                'name' => $row['grade_name']
            ];
        }
        
        return $grades;
    }
    
    /**
     * دریافت رشته‌های تحصیلی
     * 
     * @return array لیست رشته‌های تحصیلی
     */
    public function getMajors() {
        $langId = $this->langManager->getLangId();
        $majors = [];
        
        $query = "SELECT m.major_id, mt.major_name 
                  FROM majors m
                  JOIN major_translations mt ON m.major_id = mt.major_id
                  WHERE mt.language_id = ?
                  ORDER BY m.major_id ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::getMajors: " . $this->db->error);
            return $majors;
        }
        
        $stmt->bind_param("i", $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $majors[] = [
                'id' => $row['major_id'],
                'name' => $row['major_name']
            ];
        }
        
        return $majors;
    }
    
    /**
     * دریافت شهرهای مربوط به سرویس حمل و نقل
     * 
     * @return array لیست شهرها
     */
    public function getTransportationCities() {
        $langCode = $this->langManager->getLangCode();
        $cities = [];
        
        $cityKeys = ['dubai', 'sharjah', 'ajman'];
        
        $query = "SELECT field_key, content 
                  FROM registration_terms_content 
                  WHERE field_key IN (?, ?, ?) 
                  AND language_id = ?";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::getTransportationCities: " . $this->db->error);
            return $cities;
        }
        
        $stmt->bind_param("ssss", $cityKeys[0], $cityKeys[1], $cityKeys[2], $langCode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $cityNames = [];
        while ($row = $result->fetch_assoc()) {
            $cityNames[$row['field_key']] = $row['content'];
        }
        
        // ساخت آرایه نهایی شهرها
        foreach ($cityKeys as $key) {
            if (isset($cityNames[$key])) {
                $cities[] = [
                    'id' => $key,
                    'name' => $cityNames[$key]
                ];
            }
        }
        
        return $cities;
    }
    
    /**
     * دریافت مسیرهای مربوط به یک شهر
     * 
     * @param string $city شناسه شهر
     * @return array لیست مسیرها
     */
    public function getRoutesByCity($city) {
        $langId = $this->langManager->getLangId();
        $routes = [];
        
        // تبدیل شناسه شهر
        $cityMap = [
            'dubai' => 'dubai',
            'sharjah' => 'sharjah',
            'ajman' => 'ajman',
            'دبی' => 'dubai',
            'شارجه' => 'sharjah',
            'عجمان' => 'ajman',
            'دبي' => 'dubai',
            'الشارقة' => 'sharjah',
            'عجمان' => 'ajman'
        ];
        
        $cityKey = strtolower(trim($city));
        if (isset($cityMap[$cityKey])) {
            $cityKey = $cityMap[$cityKey];
        }
        
        // بر اساس کلید شهر، route_id های مربوطه را تعیین می‌کنیم
        $routeIds = [];
        switch ($cityKey) {
            case 'dubai':
                $routeIds = [4, 5, 7]; // مسیرهای مربوط به دبی
                break;
            case 'sharjah':
                $routeIds = [1, 6]; // مسیرهای مربوط به شارجه
                break;
            case 'ajman':
                $routeIds = [2, 3]; // مسیرهای مربوط به عجمان
                break;
        }
        
        if (empty($routeIds)) {
            return $routes;
        }
        
        // تبدیل آرایه به رشته برای استفاده در کوئری
        $routeIdsStr = implode(',', $routeIds);
        
        $query = "SELECT br.route_id, brt.route_name, brt.description 
                  FROM bus_routes br
                  JOIN bus_route_translations brt ON br.route_id = brt.route_id
                  WHERE br.route_id IN ({$routeIdsStr}) AND brt.language_id = ?
                  ORDER BY br.route_id ASC";
        
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Database error in FormManager::getRoutesByCity: " . $this->db->error);
            return $routes;
        }
        
        $stmt->bind_param("i", $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $routes[] = [
                'id' => $row['route_id'],
                'name' => $row['route_name'],
                'description' => $row['description']
            ];
        }
        
        return $routes;
    }
}

/**
 * کلاس اعتبارسنجی داده‌های فرم
 */
class ValidationManager {
    private $langManager;
    private $contentManager;
    
    /**
     * سازنده کلاس
     * 
     * @param LanguageManager $langManager مدیریت زبان
     * @param ContentManager $contentManager مدیریت محتوا
     */
    public function __construct($langManager, $contentManager) {
        $this->langManager = $langManager;
        $this->contentManager = $contentManager;
    }
    
    /**
     * اعتبارسنجی داده‌های مرحله اول فرم
     * 
     * @param array $data داده‌های ارسالی
     * @return array خطاهای اعتبارسنجی
     */
    public function validateStudentInfo($data) {
        $errors = [];
        
        // بررسی فیلدهای اجباری
        $requiredFields = ['firstName', 'lastName', 'fatherName', 'birthPlace', 'birthDate', 
                          'religion', 'nationality', 'academicGrade', 'residentialAddress', 'contactNumber',
                          'emergencyContactName', 'emergencyContactNumber'];
        
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        }
        
        // بررسی سیستم شناسایی بر اساس ملیت
        if ($data['nationality'] === 'IR') {
            // برای ایرانی‌ها، کد ملی اجباری است
            if (empty($data['nationalId'])) {
                $errors['nationalId'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            } elseif (strlen($data['nationalId']) !== 10 || !preg_match('/^\d{10}$/', $data['nationalId'])) {
                $errors['nationalId'] = $this->contentManager->getContent('invalid_national_id', 'کد ملی باید 10 رقم باشد.');
            }
        } elseif ($data['nationality']) {
            // برای غیر ایرانی‌ها، شماره پاسپورت اجباری است
            if (empty($data['passportNumber'])) {
                $errors['passportNumber'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        } else {
            // اگر ملیت انتخاب نشده، حداقل یکی از کد ملی یا شماره پاسپورت اجباری است
            if (empty($data['nationalId']) && empty($data['passportNumber'])) {
                $errors['nationalId'] = $this->contentManager->getContent('required_field', 'وارد کردن کد ملی یا شماره پاسپورت الزامی است');
                $errors['passportNumber'] = $this->contentManager->getContent('required_field', 'وارد کردن کد ملی یا شماره پاسپورت الزامی است');
            }
        }
        
        // بررسی رشته تحصیلی (اگر پایه 10 تا 12 باشد)
        if (isset($data['academicGrade']) && in_array($data['academicGrade'], [10, 11, 12])) {
            if (empty($data['major'])) {
                $errors['major'] = $this->contentManager->getContent('required_field', 'انتخاب رشته تحصیلی برای این پایه الزامی است');
            }
        }
        
        // بررسی فرمت شماره تماس
        if (!empty($data['contactNumber']) && !$this->isValidPhone($data['contactNumber'])) {
            $errors['contactNumber'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        if (!empty($data['emergencyContactNumber']) && !$this->isValidPhone($data['emergencyContactNumber'])) {
            $errors['emergencyContactNumber'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        return $errors;
    }
    
    /**
     * اعتبارسنجی داده‌های مرحله دوم فرم
     * 
     * @param array $data داده‌های ارسالی
     * @param array $files فایل‌های ارسالی
     * @return array خطاهای اعتبارسنجی
     */
    public function validateDocuments($data, $files) {
        $errors = [];
        
        // بررسی فایل اجباری برای همه: صفحه اول پاسپورت
        if (empty($files['passportDoc']['name'])) {
            $errors['passportDoc'] = $this->contentManager->getContent('required_field', 'بارگذاری این مدرک الزامی است');
        }
        
        // بررسی مدارک بر اساس ملیت
        if (isset($data['nationality']) && $data['nationality'] === 'IR') {
            // برای اتباع ایرانی، کارت ملی و شناسنامه اجباری است
            if (empty($files['nationalIdDoc']['name'])) {
                $errors['nationalIdDoc'] = $this->contentManager->getContent('required_field', 'بارگذاری کارت ملی برای اتباع ایرانی الزامی است');
            }
            
            if (empty($files['birthCertificate']['name'])) {
                $errors['birthCertificate'] = $this->contentManager->getContent('required_field', 'بارگذاری شناسنامه برای اتباع ایرانی الزامی است');
            }
        }
        
        // برای اتباع امارات، شناسه امارات اجباری است
        if (isset($data['nationality']) && $data['nationality'] === 'UAE') {
            if (empty($files['emiratesId']['name'])) {
                $errors['emiratesId'] = $this->contentManager->getContent('required_field', 'بارگذاری شناسه امارات برای اتباع امارات الزامی است');
            }
        }
        
        // بررسی تیک توافق‌نامه
        if (empty($data['schoolPolicies'])) {
            $errors['schoolPolicies'] = $this->contentManager->getContent('required_field', 'پذیرش سیاست‌های مدرسه الزامی است');
        }
        
        // بررسی فرمت و حجم فایل‌ها
        foreach ($files as $fileKey => $fileInfo) {
            if (!empty($fileInfo['name'])) {
                $fileType = $fileInfo['type'];
                $fileSize = $fileInfo['size'];
                
                // بررسی نوع فایل
                $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                if (!in_array($fileType, $allowedTypes)) {
                    $errors[$fileKey] = $this->contentManager->getContent('file_type_error', 'فرمت فایل مجاز نیست. لطفاً فایل JPEG، PNG یا PDF بارگذاری کنید.');
                }
                
                // بررسی حجم فایل
                $maxSize = ($fileKey == 'profilePhoto') ? 2097152 : 5242880; // 2MB یا 5MB
                if ($fileSize > $maxSize) {
                    $errors[$fileKey] = $this->contentManager->getContent('file_size_error', 'حجم فایل بیش از حد مجاز است.');
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * اعتبارسنجی داده‌های مرحله سوم فرم
     * 
     * @param array $data داده‌های ارسالی
     * @return array خطاهای اعتبارسنجی
     */
    public function validateFatherInfo($data) {
        $errors = [];
        
        // بررسی فیلدهای اجباری
        $requiredFields = [
            'fatherFullName', 'fatherNationality', 'fatherDateOfBirth',
            'fatherEducation', 'fatherOccupation', 'fatherMobile', 'fatherEmail'
        ];
        
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        }
        
        // بررسی سیستم شناسایی پدر بر اساس ملیت
        if ($data['fatherNationality'] === 'IR') {
            // برای ایرانی‌ها، کد ملی اجباری است
            if (empty($data['fatherNationalId'])) {
                $errors['fatherNationalId'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            } elseif (strlen($data['fatherNationalId']) !== 10 || !preg_match('/^\d{10}$/', $data['fatherNationalId'])) {
                $errors['fatherNationalId'] = $this->contentManager->getContent('invalid_national_id', 'کد ملی باید 10 رقم باشد.');
            }
        } elseif ($data['fatherNationality']) {
            // برای غیر ایرانی‌ها، شماره پاسپورت اجباری است
            if (empty($data['fatherPassportNumber'])) {
                $errors['fatherPassportNumber'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        } else {
            // اگر ملیت انتخاب نشده، حداقل یکی از کد ملی یا شماره پاسپورت اجباری است
            if (empty($data['fatherNationalId']) && empty($data['fatherPassportNumber'])) {
                $errors['fatherNationalId'] = $this->contentManager->getContent('required_field', 'وارد کردن کد ملی یا شماره پاسپورت الزامی است');
                $errors['fatherPassportNumber'] = $this->contentManager->getContent('required_field', 'وارد کردن کد ملی یا شماره پاسپورت الزامی است');
            }
        }
        
        // بررسی فرمت ایمیل پدر
        if (!empty($data['fatherEmail']) && !$this->isValidEmail($data['fatherEmail'])) {
            $errors['fatherEmail'] = $this->contentManager->getContent('invalid_email', 'فرمت ایمیل صحیح نیست.');
        }
        
        // بررسی فرمت شماره تماس پدر
        if (!empty($data['fatherMobile']) && !$this->isValidPhone($data['fatherMobile'])) {
            $errors['fatherMobile'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        if (!empty($data['fatherLandline']) && !$this->isValidPhone($data['fatherLandline'])) {
            $errors['fatherLandline'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        if (!empty($data['fatherWhatsapp']) && !$this->isValidPhone($data['fatherWhatsapp'])) {
            $errors['fatherWhatsapp'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        // اگر شرایط پزشکی خاص انتخاب شده، توضیح آن اجباری است
        if (isset($data['fatherMedicalCondition']) && $data['fatherMedicalCondition'] == 'Yes') {
            if (empty($data['fatherMedicalConditionDetails'])) {
                $errors['fatherMedicalConditionDetails'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        }
        
        return $errors;
    }
    
    /**
     * اعتبارسنجی داده‌های مرحله چهارم فرم
     * 
     * @param array $data داده‌های ارسالی
     * @return array خطاهای اعتبارسنجی
     */
    public function validateMotherInfo($data) {
        $errors = [];
        
        // بررسی فیلدهای اجباری
        $requiredFields = [
            'motherFullName', 'motherNationality', 'motherDateOfBirth',
            'motherEducation', 'motherOccupation', 'motherMobile', 'motherEmail'
        ];
        
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        }
        
        // بررسی سیستم شناسایی مادر بر اساس ملیت
        if ($data['motherNationality'] === 'IR') {
            // برای ایرانی‌ها، کد ملی اجباری است
            if (empty($data['motherNationalId'])) {
                $errors['motherNationalId'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            } elseif (strlen($data['motherNationalId']) !== 10 || !preg_match('/^\d{10}$/', $data['motherNationalId'])) {
                $errors['motherNationalId'] = $this->contentManager->getContent('invalid_national_id', 'کد ملی باید 10 رقم باشد.');
            }
        } elseif ($data['motherNationality']) {
            // برای غیر ایرانی‌ها، شماره پاسپورت اجباری است
            if (empty($data['motherPassportNumber'])) {
                $errors['motherPassportNumber'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        } else {
            // اگر ملیت انتخاب نشده، حداقل یکی از کد ملی یا شماره پاسپورت اجباری است
            if (empty($data['motherNationalId']) && empty($data['motherPassportNumber'])) {
                $errors['motherNationalId'] = $this->contentManager->getContent('required_field', 'وارد کردن کد ملی یا شماره پاسپورت الزامی است');
                $errors['motherPassportNumber'] = $this->contentManager->getContent('required_field', 'وارد کردن کد ملی یا شماره پاسپورت الزامی است');
            }
        }
        
        // بررسی فرمت ایمیل مادر
        if (!empty($data['motherEmail']) && !$this->isValidEmail($data['motherEmail'])) {
            $errors['motherEmail'] = $this->contentManager->getContent('invalid_email', 'فرمت ایمیل صحیح نیست.');
        }
        
        // بررسی فرمت شماره تماس مادر
        if (!empty($data['motherMobile']) && !$this->isValidPhone($data['motherMobile'])) {
            $errors['motherMobile'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        if (!empty($data['motherLandline']) && !$this->isValidPhone($data['motherLandline'])) {
            $errors['motherLandline'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        if (!empty($data['motherWhatsapp']) && !$this->isValidPhone($data['motherWhatsapp'])) {
            $errors['motherWhatsapp'] = $this->contentManager->getContent('invalid_phone', 'فرمت شماره تلفن صحیح نیست.');
        }
        
        // اگر شرایط پزشکی خاص انتخاب شده، توضیح آن اجباری است
        if (isset($data['motherMedicalCondition']) && $data['motherMedicalCondition'] == 'Yes') {
            if (empty($data['motherMedicalConditionDetails'])) {
                $errors['motherMedicalConditionDetails'] = $this->contentManager->getContent('required_field', 'این فیلد الزامی است');
            }
        }
        
        return $errors;
    }
    
    /**
     * اعتبارسنجی داده‌های مرحله پنجم فرم
     * 
     * @param array $data داده‌های ارسالی
     * @return array خطاهای اعتبارسنجی
     */
    public function validateFinalStep($data) {
        $errors = [];
        
        // بررسی توافق‌نامه‌ها
        if (empty($data['disciplinaryRules'])) {
            $errors['disciplinaryRules'] = $this->contentManager->getContent('required_field', 'پذیرش قوانین انضباطی مدرسه الزامی است');
        }
        
        if (empty($data['termsConditions'])) {
            $errors['termsConditions'] = $this->contentManager->getContent('required_field', 'پذیرش شرایط و قوانین ثبت‌نام الزامی است');
        }
        
        return $errors;
    }
    
    /**
     * بررسی معتبر بودن فرمت ایمیل
     * 
     * @param string $email آدرس ایمیل
     * @return bool
     */
    private function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * بررسی معتبر بودن فرمت شماره تلفن
     * 
     * @param string $phone شماره تلفن
     * @return bool
     */
    private function isValidPhone($phone) {
        // شماره‌های تلفن معمولاً حداقل 7 رقم هستند و می‌توانند شامل + و - و () و فاصله باشند
        return preg_match('/^[+\d\s\-()]{7,20}$/', $phone);
    }
}

    /**
     * کلاس مدیریت ذخیره‌سازی داده‌ها
     */
    class StorageManager {
        private $db;
        
        /**
         * سازنده کلاس
         * 
         * @param mysqli $db اتصال دیتابیس
         */
        public function __construct($db) {
            $this->db = $db;
        }
        
        /**
         * ایجاد توکن امن برای دسترسی به صفحه نتیجه ثبت‌نام
         * 
         * @param int $registrationId شناسه ثبت‌نام
         * @return string توکن ایجاد شده
         */
        private function createRegistrationToken($registrationId) {
            // ایجاد توکن منحصر به فرد با استفاده از اطلاعات امن
            $token = bin2hex(random_bytes(32)); // 64 کاراکتر هگزادسیمال
            
            // زمان انقضا - 24 ساعت بعد
            $expiresAt = date('Y-m-d H:i:s', strtotime('+24 hours'));
            
            // آدرس IP کاربر
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            
            // ذخیره توکن در دیتابیس
            $query = "INSERT INTO registration_tokens (token_id, registration_id, expires_at, ip_address) 
                    VALUES (?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error in createRegistrationToken: " . $this->db->error);
            }
            
            $stmt->bind_param("siss", $token, $registrationId, $expiresAt, $ipAddress);
            
            if (!$stmt->execute()) {
                throw new Exception("Error creating registration token: " . $stmt->error);
            }
            
            $stmt->close();
            
            return $token;
        }

        /**
         * ذخیره‌سازی اطلاعات ثبت‌نام - نسخه بهبود یافته با توکن امنیتی
         * 
         * @param array $data داده‌های ارسالی
         * @param array $files فایل‌های ارسالی
         * @return array نتیجه ذخیره‌سازی
         */
        public function saveRegistration($data, $files) {
            // ثبت لاگ برای دیباگ
            error_log("Starting saveRegistration for: " . ($data['firstName'] ?? 'Unknown') . " " . ($data['lastName'] ?? 'Unknown'));
            
            // شروع تراکنش برای اطمینان از ثبت صحیح اطلاعات
            $this->db->begin_transaction();
            
            try {
                // 1. ذخیره اطلاعات دانش‌آموز
                $studentId = $this->saveStudentInfo($data);
                error_log("Student info saved. Student ID: {$studentId}");
                
                // 2. ذخیره مدارک آپلود شده
                $this->saveDocuments($studentId, $files);
                error_log("Documents saved for student ID: {$studentId}");
                
                // 3. ذخیره اطلاعات پدر
                $fatherId = $this->saveParentInfo($data, 'father');
                error_log("Father info saved. Father ID: {$fatherId}");
                
                // 4. ذخیره اطلاعات مادر
                $motherId = $this->saveParentInfo($data, 'mother');
                error_log("Mother info saved. Mother ID: {$motherId}");
                
                // 5. ارتباط والدین با دانش‌آموز
                $this->linkParentsToStudent($studentId, $fatherId, $motherId);
                error_log("Parents linked to student ID: {$studentId}");
                
                // 6. ثبت سرویس حمل و نقل (اگر انتخاب شده باشد)
                if (isset($data['needTransportation']) && $data['needTransportation'] === 'Yes' && !empty($data['transportationCity'])) {
                    $this->saveTransportation($studentId, $data);
                    error_log("Transportation info saved for student ID: {$studentId}");
                } else {
                    error_log("No transportation needed or city not selected for student ID: {$studentId}");
                }
                
                // 7. ثبت اطلاعات ثبت‌نام
                $registrationId = $this->saveRegistrationDetails($studentId, $data);
                error_log("Registration details saved. Registration ID: {$registrationId}");
                
                // 8. ایجاد توکن امن برای دسترسی به صفحه نتیجه
                $token = $this->createRegistrationToken($registrationId);
                error_log("Secure token created: " . substr($token, 0, 10) . "...");
                
                // پایان موفقیت‌آمیز تراکنش
                $this->db->commit();
                error_log("Registration completed successfully for student ID: {$studentId}");
                
                return [
                    'success' => true,
                    'student_id' => $studentId,
                    'registration_id' => $registrationId,
                    'token' => $token  // بازگشت توکن به جای ID
                ];
                
            } catch (Exception $e) {
                // برگرداندن تراکنش در صورت بروز خطا
                $this->db->rollback();
                
                // ثبت خطا در لاگ سرور
                error_log("Error in saveRegistration: " . $e->getMessage() . "\n" . $e->getTraceAsString());
                
                return [
                    'success' => false,
                    'error' => $e->getMessage(),
                    'debug_query' => $this->db->error  // اضافه کردن خطای دیتابیس
                ];
            }
        }
        
        /**
         * ذخیره اطلاعات دانش‌آموز
         * 
         * @param array $data داده‌های ارسالی
         * @return int شناسه دانش‌آموز ثبت‌شده
         * @throws Exception در صورت بروز خطا
         */
        private function saveStudentInfo($data) {
            $query = "INSERT INTO students 
                    (first_name, last_name, birth_date, gender, national_id, passport_number, 
                    nationality, religion, academic_grade_id, major_id, address, phone, 
                    emergency_contact_name, emergency_contact_phone, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error in saveStudentInfo: " . $this->db->error);
            }
            
            // تبدیل کلیدهای فرم به کلیدهای جدول
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $birthDate = $data['birthDate'];
            $gender = $data['gender']; // مقدار پیش‌فرض از طریق فیلد مخفی
            $nationalId = isset($data['nationalId']) ? $data['nationalId'] : null;
            $passportNumber = isset($data['passportNumber']) ? $data['passportNumber'] : null;
            $nationality = $data['nationality'];
            $religion = $data['religion'];
            $academicGradeId = $data['academicGrade'];
            $majorId = !empty($data['major']) ? $data['major'] : null;
            $address = $data['residentialAddress'];
            $phone = $data['contactNumber'];
            $emergencyName = $data['emergencyContactName'];
            $emergencyPhone = $data['emergencyContactNumber'];
            
            // اصلاح الگوی تایپ (14 پارامتر = 14 نوع داده)
            $stmt->bind_param("sssssssssissss", 
                $firstName, 
                $lastName, 
                $birthDate, 
                $gender, 
                $nationalId, 
                $passportNumber, 
                $nationality, 
                $religion, 
                $academicGradeId, 
                $majorId, 
                $address, 
                $phone, 
                $emergencyName, 
                $emergencyPhone
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing student insert: " . $stmt->error);
            }
            
            $studentId = $this->db->insert_id;
            $stmt->close();
            
            return $studentId;
        }
        
        /**
         * ذخیره مدارک آپلود شده
         * 
         * @param int $studentId شناسه دانش‌آموز
         * @param array $files فایل‌های ارسالی
         * @return void
         * @throws Exception در صورت بروز خطا
         */
        private function saveDocuments($studentId, $files) {
            $documentTypes = [
                'profilePhoto' => '',
                'emiratesId' => 'emirates_id',
                'passportDoc' => 'passport',
                'nationalIdDoc' => '',
                'birthCertificate' => '',
                'academicCertificate' => 'academic_certificate'
            ];
            
            foreach ($documentTypes as $fileKey => $docType) {
                if (!empty($files[$fileKey]['name'])) {
                    // آپلود فایل و دریافت مسیر
                    $filePath = $this->uploadFile($files[$fileKey], $studentId, $fileKey);
                    
                    // فقط فایل‌های با نوع مشخص در جدول documents ذخیره شوند
                    if ($filePath && !empty($docType)) {
                        $docQuery = "INSERT INTO documents 
                                    (student_id, document_type, file_path, upload_date) 
                                    VALUES (?, ?, ?, NOW())";
                        $stmt = $this->db->prepare($docQuery);
                        if (!$stmt) {
                            throw new Exception("Database error in saveDocuments: " . $this->db->error);
                        }
                        
                        $stmt->bind_param("iss", $studentId, $docType, $filePath);
                        
                        if (!$stmt->execute()) {
                            throw new Exception("Error executing document insert: " . $stmt->error);
                        }
                        
                        $stmt->close();
                    }
                }
            }
        }
        
        /**
         * آپلود فایل با خطایابی بیشتر
         * 
         * @param array $file اطلاعات فایل
         * @param int $studentId شناسه دانش‌آموز
         * @param string $fileType نوع فایل
         * @return string|bool مسیر فایل آپلود شده یا false در صورت خطا
         */
        private function uploadFile($file, $studentId, $fileType) {
            try {
                // مسیر ذخیره‌سازی فایل‌ها - استفاده از مسیر نسبی ساده
                $uploadDir = 'uploads/student_documents/' . $studentId . '/';
                $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $uploadDir;
                
                // ثبت لاگ برای دیباگ
                error_log("Uploading file: {$file['name']} to directory: {$uploadDir} (Absolute: {$absolutePath})");
                
                // ایجاد دایرکتوری اگر وجود نداشته باشد
                if (!file_exists($uploadDir)) {
                    if (!mkdir($uploadDir, 0755, true)) {
                        error_log("Failed to create directory: {$uploadDir}");
                        return false;
                    }
                    error_log("Created directory: {$uploadDir}");
                }
                
                // بررسی دسترسی نوشتن
                if (!is_writable($uploadDir)) {
                    error_log("Directory not writable: {$uploadDir}");
                    return false;
                }
                
                // ایجاد یک نام امن برای فایل
                $fileInfo = pathinfo($file['name']);
                $extension = isset($fileInfo['extension']) ? $fileInfo['extension'] : '';
                $timestamp = time();
                $randomString = bin2hex(random_bytes(8));
                $newFileName = $fileType . '_' . $timestamp . '_' . $randomString . '.' . $extension;
                
                $destination = $uploadDir . $newFileName;
                
                // آپلود فایل
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    error_log("File uploaded successfully to: {$destination}");
                    return $destination;
                } else {
                    error_log("Failed to move uploaded file. PHP Error: " . error_get_last()['message']);
                    return false;
                }
            } catch (Exception $e) {
                error_log("Exception in uploadFile: " . $e->getMessage());
                return false;
            }
        }
        
        /**
         * ذخیره اطلاعات والدین
         * 
         * @param array $data داده‌های ارسالی
         * @param string $type نوع والد (father یا mother)
         * @return int شناسه والد ثبت‌شده
         * @throws Exception در صورت بروز خطا
         */
        private function saveParentInfo($data, $type) {
            $query = "INSERT INTO parents 
                    (first_name, last_name, phone, email, relation) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error in saveParentInfo: " . $this->db->error);
            }
            
            // جداسازی نام و نام خانوادگی
            $nameField = $type . 'FullName';
            $fullName = $data[$nameField];
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
            
            // دریافت شماره تماس و ایمیل
            $phoneField = $type . 'Mobile';
            $emailField = $type . 'Email';
            
            $phone = $data[$phoneField];
            $email = $data[$emailField];
            $relation = $type; // father یا mother
            
            $stmt->bind_param("sssss", 
                $firstName, 
                $lastName, 
                $phone, 
                $email, 
                $relation
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing parent insert: " . $stmt->error);
            }
            
            $parentId = $this->db->insert_id;
            $stmt->close();
            
            return $parentId;
        }
        
        /**
         * ارتباط والدین با دانش‌آموز
         * 
         * @param int $studentId شناسه دانش‌آموز
         * @param int $fatherId شناسه پدر
         * @param int $motherId شناسه مادر
         * @return void
         * @throws Exception در صورت بروز خطا
         */
        private function linkParentsToStudent($studentId, $fatherId, $motherId) {
            $query = "INSERT INTO student_parents 
                    (student_id, parent_id, relationship) 
                    VALUES (?, ?, ?)";
            
            // ارتباط پدر
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error in linkParentsToStudent (father): " . $this->db->error);
            }
            
            $fatherRelation = 'father';
            $stmt->bind_param("iis", $studentId, $fatherId, $fatherRelation);
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing father link: " . $stmt->error);
            }
            
            $stmt->close();
            
            // ارتباط مادر
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error in linkParentsToStudent (mother): " . $this->db->error);
            }
            
            $motherRelation = 'mother';
            $stmt->bind_param("iis", $studentId, $motherId, $motherRelation);
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing mother link: " . $stmt->error);
            }
            
            $stmt->close();
        }
        
        /**
         * ذخیره اطلاعات سرویس حمل و نقل
         * 
         * @param int $studentId شناسه دانش‌آموز
         * @param array $data داده‌های ارسالی
         * @return void
         * @throws Exception در صورت بروز خطا
         */
        private function saveTransportation($studentId, $data) {
            if (!empty($data['transportationCity']) && !empty($data['transportationRoute'])) {
                // ابتدا بررسی می‌کنیم که route_id معتبر باشد
                $checkQuery = "SELECT route_id FROM bus_routes WHERE route_id = ?";
                $stmt = $this->db->prepare($checkQuery);
                if (!$stmt) {
                    throw new Exception("Database error in saveTransportation (check): " . $this->db->error);
                }
                
                $routeId = $data['transportationRoute'];
                $stmt->bind_param("i", $routeId);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $stmt->close();
                    
                    // به‌روزرسانی اطلاعات سرویس برای دانش‌آموز
                    $updateQuery = "UPDATE students SET bus_route_id = ? WHERE student_id = ?";
                    $stmt = $this->db->prepare($updateQuery);
                    if (!$stmt) {
                        throw new Exception("Database error in saveTransportation (update): " . $this->db->error);
                    }
                    
                    $stmt->bind_param("ii", $routeId, $studentId);
                    
                    if (!$stmt->execute()) {
                        throw new Exception("Error executing transportation update: " . $stmt->error);
                    }
                    
                    $stmt->close();
                }
            }
        }
        
        /**
         * ذخیره جزئیات ثبت‌نام
         * 
         * @param int $studentId شناسه دانش‌آموز
         * @param array $data داده‌های ارسالی
         * @return int شناسه ثبت‌نام
         * @throws Exception در صورت بروز خطا
         */
        private function saveRegistrationDetails($studentId, $data) {
            $query = "INSERT INTO registrations 
                    (student_id, special_notes, disciplinary_rules_agreement, 
                    terms_conditions_agreement, registration_date, registration_status) 
                    VALUES (?, ?, ?, ?, NOW(), 'pending')";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Database error in saveRegistrationDetails: " . $this->db->error);
            }
            
            $specialNotes = isset($data['specialNotes']) ? $data['specialNotes'] : '';
            $disciplinaryRules = !empty($data['disciplinaryRules']) ? 1 : 0;
            $termsAgreement = !empty($data['termsConditions']) ? 1 : 0;
            
            $stmt->bind_param("isii", 
                $studentId, 
                $specialNotes, 
                $disciplinaryRules, 
                $termsAgreement
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Error executing registration insert: " . $stmt->error);
            }
            
            $registrationId = $this->db->insert_id;
            $stmt->close();
            
            return $registrationId;
        }
    }

// -------------------- توابع کمکی برای استفاده در صفحه ثبت‌نام --------------------

/**
 * ایجاد و راه‌اندازی مدیریت زبان
 * 
 * @param mysqli $db اتصال دیتابیس
 * @param string $langCode کد زبان
 * @return LanguageManager
 */
function initLanguageManager($db, $langCode = 'fa') {
    return new LanguageManager($db, $langCode);
}

/**
 * ایجاد و راه‌اندازی مدیریت محتوا
 * 
 * @param mysqli $db اتصال دیتابیس
 * @param LanguageManager $langManager مدیریت زبان
 * @return ContentManager
 */
function initContentManager($db, $langManager) {
    return new ContentManager($db, $langManager);
}

/**
 * ایجاد و راه‌اندازی مدیریت فرم
 * 
 * @param mysqli $db اتصال دیتابیس
 * @param LanguageManager $langManager مدیریت زبان
 * @return FormManager
 */
function initFormManager($db, $langManager) {
    return new FormManager($db, $langManager);
}

/**
 * ایجاد و راه‌اندازی مدیریت اعتبارسنجی
 * 
 * @param LanguageManager $langManager مدیریت زبان
 * @param ContentManager $contentManager مدیریت محتوا
 * @return ValidationManager
 */
function initValidationManager($langManager, $contentManager) {
    return new ValidationManager($langManager, $contentManager);
}

/**
 * ایجاد و راه‌اندازی مدیریت ذخیره‌سازی
 * 
 * @param mysqli $db اتصال دیتابیس
 * @return StorageManager
 */
function initStorageManager($db) {
    return new StorageManager($db);
}

/**
 * دریافت محتوای صفحه ثبت‌نام
 * 
 * @param string $key کلید محتوا
 * @param string $lang کد زبان
 * @param string $default مقدار پیش‌فرض
 * @return string محتوای متنی
 */
function getRegistrationContent($key, $lang, $default = '') {
    global $db;
    
    $query = "SELECT content FROM registration_terms_content 
              WHERE field_key = ? AND language_id = ? AND is_repeatable = 0 
              LIMIT 1";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in getRegistrationContent: " . $db->error);
        return $default;
    }
    
    $stmt->bind_param("ss", $key, $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['content'];
    }
    
    return $default;
}

/**
 * دریافت پایه‌های تحصیلی
 * 
 * @param int $langId شناسه زبان
 * @return array لیست پایه‌های تحصیلی
 */
function getAcademicGrades($langId) {
    global $db;
    
    $query = "SELECT ag.grade_id, agt.grade_name 
              FROM academic_grades ag
              JOIN academic_grade_translations agt ON ag.grade_id = agt.grade_id
              WHERE agt.language_id = ?
              ORDER BY ag.grade_id ASC";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in getAcademicGrades: " . $db->error);
        return [];
    }
    
    $stmt->bind_param("i", $langId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $grades = [];
    while ($row = $result->fetch_assoc()) {
        $grades[] = [
            'id' => $row['grade_id'],
            'name' => $row['grade_name']
        ];
    }
    
    return $grades;
}

/**
 * دریافت رشته‌های تحصیلی
 * 
 * @param int $langId شناسه زبان
 * @return array لیست رشته‌های تحصیلی
 */
function getMajors($langId) {
    global $db;
    
    $query = "SELECT m.major_id, mt.major_name 
              FROM majors m
              JOIN major_translations mt ON m.major_id = mt.major_id
              WHERE mt.language_id = ?
              ORDER BY m.major_id ASC";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in getMajors: " . $db->error);
        return [];
    }
    
    $stmt->bind_param("i", $langId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $majors = [];
    while ($row = $result->fetch_assoc()) {
        $majors[] = [
            'id' => $row['major_id'],
            'name' => $row['major_name']
        ];
    }
    
    return $majors;
}

/**
 * دریافت شهرهای مربوط به سرویس حمل و نقل
 * 
 * @param string $lang کد زبان
 * @return array لیست شهرها
 */
function getTransportationCities($lang) {
    global $db;
    
    $cities = [];
    $cityKeys = ['dubai', 'sharjah', 'ajman'];
    
    $query = "SELECT field_key, content 
              FROM registration_terms_content 
              WHERE field_key IN (?, ?, ?) 
              AND language_id = ?";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in getTransportationCities: " . $db->error);
        return $cities;
    }
    
    $stmt->bind_param("ssss", $cityKeys[0], $cityKeys[1], $cityKeys[2], $lang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $cityNames = [];
    while ($row = $result->fetch_assoc()) {
        $cityNames[$row['field_key']] = $row['content'];
    }
    
    // ساخت آرایه نهایی شهرها
    foreach ($cityKeys as $key) {
        if (isset($cityNames[$key])) {
            $cities[] = [
                'id' => $key,
                'name' => $cityNames[$key]
            ];
        }
    }
    
    return $cities;
}

/**
 * دریافت مسیرهای مربوط به یک شهر
 * 
 * @param string $city شناسه شهر
 * @param int $langId شناسه زبان
 * @return array لیست مسیرها
 */
function getRoutesByCity($city, $langId) {
    global $db;
    
    // تبدیل شناسه شهر
    $cityMap = [
        'dubai' => 'dubai',
        'sharjah' => 'sharjah',
        'ajman' => 'ajman',
        'دبی' => 'dubai',
        'شارجه' => 'sharjah',
        'عجمان' => 'ajman',
        'دبي' => 'dubai',
        'الشارقة' => 'sharjah',
        'عجمان' => 'ajman'
    ];
    
    $cityKey = strtolower(trim($city));
    if (isset($cityMap[$cityKey])) {
        $cityKey = $cityMap[$cityKey];
    }
    
    // بر اساس کلید شهر، route_id های مربوطه را تعیین می‌کنیم
    $routeIds = [];
    switch ($cityKey) {
        case 'dubai':
            $routeIds = [4, 5, 7]; // مسیرهای مربوط به دبی
            break;
        case 'sharjah':
            $routeIds = [1, 6]; // مسیرهای مربوط به شارجه
            break;
        case 'ajman':
            $routeIds = [2, 3]; // مسیرهای مربوط به عجمان
            break;
    }
    
    if (empty($routeIds)) {
        return [];
    }
    
    // تبدیل آرایه به رشته برای استفاده در کوئری
    $routeIdsStr = implode(',', $routeIds);
    
    $query = "SELECT br.route_id, brt.route_name, brt.description 
              FROM bus_routes br
              JOIN bus_route_translations brt ON br.route_id = brt.route_id
              WHERE br.route_id IN ({$routeIdsStr}) AND brt.language_id = ?
              ORDER BY br.route_id ASC";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in getRoutesByCity: " . $db->error);
        return [];
    }
    
    $stmt->bind_param("i", $langId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $routes = [];
    while ($row = $result->fetch_assoc()) {
        $routes[] = [
            'id' => $row['route_id'],
            'name' => $row['route_name'],
            'description' => $row['description']
        ];
    }
    
    return $routes;
}

/**
 * ذخیره اطلاعات ثبت‌نام
 * 
 * @param array $data داده‌های ارسالی
 * @param array $files فایل‌های ارسالی
 * @return array نتیجه ذخیره‌سازی
 */
function saveRegistration($data, $files) {
    global $db;
    
    // ایجاد مدیریت ذخیره‌سازی
    $storageManager = new StorageManager($db);
    
    // ذخیره اطلاعات
    return $storageManager->saveRegistration($data, $files);
}