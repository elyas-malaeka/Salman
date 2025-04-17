<?php
/**
 * کلاس مدیریت محتوای صفحه ثبت‌نام موفق
 * 
 * این کلاس محتوای صفحه ثبت‌نام موفق را از جداول دیتابیس مدیریت می‌کند
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

class RegistrationSuccessContent {
    /**
     * @var mysqli اتصال به دیتابیس
     */
    private $db;
    
    /**
     * @var array کش محتوا
     */
    private $cache = [];
    
    /**
     * @var string زبان پیش‌فرض
     */
    private $defaultLang = 'fa';
    
    /**
     * @var array تنظیمات سایت
     */
    private $settings = [];
    
    /**
     * سازنده کلاس
     * 
     * @param mysqli $db اتصال به دیتابیس
     * @param string $defaultLang زبان پیش‌فرض
     */
    public function __construct($db, $defaultLang = 'fa') {
        $this->db = $db;
        $this->defaultLang = $defaultLang;
        $this->loadSettings();
    }
    
    /**
     * بارگذاری تنظیمات سایت
     */
    private function loadSettings() {
        $query = "SELECT `key`, `value` FROM site_settings";
        $result = $this->db->query($query);
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $this->settings[$row['key']] = $row['value'];
            }
        }
    }
    
    /**
     * دریافت محتوا برای کلید و زبان مشخص
     * 
     * @param string $key کلید محتوا
     * @param string $lang کد زبان
     * @param string $default مقدار پیش‌فرض در صورت نبود محتوا
     * @return string محتوای درخواستی
     */
    public function get($key, $lang = null, $default = '') {
        $lang = $lang ?: $this->defaultLang;
        
        // بررسی کش
        $cacheKey = "{$key}_{$lang}";
        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }
        
        // دریافت شناسه زبان
        $langId = $this->getLanguageId($lang);
        if (!$langId) {
            return $default;
        }
        
        // استعلام از دیتابیس
        $query = "SELECT t.content_value
                 FROM registration_success_content c
                 JOIN registration_success_translations t ON c.content_id = t.content_id
                 WHERE c.content_key = ? AND t.language_id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $key, $langId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $this->cache[$cacheKey] = $row['content_value'];
            return $row['content_value'];
        }
        
        // اگر در زبان درخواستی پیدا نشد، زبان پیش‌فرض را بررسی کنید
        if ($lang !== $this->defaultLang) {
            return $this->get($key, $this->defaultLang, $default);
        }
        
        return $default;
    }
    
    /**
     * دریافت شناسه زبان براساس کد زبان
     * 
     * @param string $langCode کد زبان
     * @return int|false شناسه زبان یا false در صورت نبود زبان
     */
    private function getLanguageId($langCode) {
        $query = "SELECT language_id FROM languages WHERE code = ? AND is_active = 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $langCode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return $row['language_id'];
        }
        
        return false;
    }
    
    /**
     * دریافت نام سایت برای زبان مشخص
     * 
     * @param string $lang کد زبان
     * @return string نام سایت
     */
    public function getSiteName($lang = 'fa') {
        $key = "site_name_" . $lang;
        return isset($this->settings[$key]) ? $this->settings[$key] : '';
    }
    
    /**
     * دریافت تمام مراحل بعدی
     * 
     * @param string $lang کد زبان
     * @return array آرایه مراحل بعدی
     */
    public function getNextSteps($lang = 'fa') {
        $steps = [];
        for ($i = 1; $i <= 4; $i++) {
            $step = $this->get("next_step_{$i}", $lang);
            if ($step) {
                $steps[] = $step;
            }
        }
        return $steps;
    }
    
    /**
     * دریافت اطلاعات تماس
     * 
     * @param string $lang کد زبان
     * @return array آرایه اطلاعات تماس
     */
    public function getContactInfo($lang = 'fa') {
        $contactTypes = ['phone', 'email', 'address', 'hours'];
        $contacts = [];
        
        foreach ($contactTypes as $type) {
            $value = $this->get("contact_{$type}", $lang);
            $title = $this->get("contact_{$type}_title", $lang);
            
            if ($value) {
                $contacts[] = [
                    'title' => $title,
                    'value' => $value,
                    'type' => $type
                ];
            }
        }
        
        return $contacts;
    }
}