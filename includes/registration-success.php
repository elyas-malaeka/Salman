<?php
/**
 * کلاس مدیریت محتوای صفحات
 * 
 * کلاس مدیریت محتوا برای دریافت داده‌ها از جداول محتوا و ترجمه
 * 
 * @package Salman Educational Complex
 * @version 2.0
 */
class PageContentManager {
    private $db;
    private $pageKey;
    private $lang;
    private $contentTable;
    private $translationTable;
    
    /**
     * سازنده کلاس مدیریت محتوا
     * 
     * @param mysqli $db اتصال به دیتابیس
     * @param string $pageKey کلید صفحه
     * @param string $lang زبان فعلی
     */
    public function __construct($db, $pageKey, $lang = 'fa') {
        $this->db = $db;
        $this->pageKey = $pageKey;
        $this->lang = $lang;
        
        // استفاده از backticks برای امن کردن نام جداول
        $this->contentTable = "`temp_{$pageKey}_content`";
        $this->translationTable = "`temp_{$pageKey}_translations`";
    }
    
    /**
     * دریافت محتوا با کلید مشخص
     * 
     * @param string $fieldKey کلید فیلد محتوا
     * @param bool $rawContent آیا محتوای اصلی بدون ترجمه برگردانده شود
     * @return string|null محتوای درخواستی
     */
    public function getContent($fieldKey, $rawContent = false) {
        try {
            // ابتدا محتوای اصلی را پیدا می‌کنیم
            $query = "SELECT content_id, content FROM {$this->contentTable} 
                      WHERE field_key = ? AND is_active = 1 
                      LIMIT 1";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception($this->db->error);
            }
            
            $stmt->bind_param("s", $fieldKey);
            $stmt->execute();
            $result = $stmt->get_result();
            $content = $result->fetch_assoc();
            $stmt->close();
            
            if (!$content) {
                return null;
            }
            
            // اگر محتوای اصلی خواسته شده، آن را برمی‌گردانیم
            if ($rawContent) {
                return $content['content'];
            }
            
            // در غیر این صورت ترجمه را پیدا می‌کنیم
            $query = "SELECT content_value FROM {$this->translationTable} 
                      WHERE content_id = ? AND language_id = ? 
                      LIMIT 1";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception($this->db->error);
            }
            
            $stmt->bind_param("is", $content['content_id'], $this->lang);
            $stmt->execute();
            $result = $stmt->get_result();
            $translation = $result->fetch_assoc();
            $stmt->close();
            
            if ($translation && !empty($translation['content_value'])) {
                return $translation['content_value'];
            }
            
            // اگر ترجمه پیدا نشد، محتوای اصلی را برمی‌گردانیم
            return $content['content'];
            
        } catch (Exception $e) {
            // در صورت خطا می‌توانید لاگ بگیرید
            error_log("Error fetching content: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * دریافت محتوای تکرارشونده
     * 
     * @param string $fieldKey کلید فیلد محتوا
     * @param string $sectionId شناسه بخش (اختیاری)
     * @return array آرایه‌ای از محتواهای تکرارشونده
     */
    public function getRepeatableContent($fieldKey, $sectionId = null) {
        try {
            $query = "SELECT c.content_id, c.content, c.sort_order, c.image_path, t.content_value 
                      FROM {$this->contentTable} c
                      LEFT JOIN {$this->translationTable} t ON c.content_id = t.content_id AND t.language_id = ?
                      WHERE c.field_key LIKE ? AND c.is_active = 1 AND c.is_repeatable = 1";
            
            $types = "ss";  // دو پارامتر استرینگ
            $fieldKeyPattern = $fieldKey . "%";
            $params = array($this->lang, $fieldKeyPattern);
            
            if ($sectionId) {
                $query .= " AND c.section_id = ?";
                $types .= "s";  // یک پارامتر استرینگ دیگر
                $params[] = $sectionId;
            }
            
            $query .= " ORDER BY c.sort_order ASC";
            
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception($this->db->error);
            }
            
            // اتصال پارامترها به استیتمنت با استفاده از call_user_func_array
            $bindParams = array($types);
            foreach ($params as $key => $value) {
                $bindParams[] = &$params[$key];
            }
            
            call_user_func_array(array($stmt, 'bind_param'), $bindParams);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $items = array();
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            
            $stmt->close();
            return $items;
            
        } catch (Exception $e) {
            error_log("Error fetching repeatable content: " . $e->getMessage());
            return array();
        }
    }
    
    /**
     * دریافت نام سایت
     * 
     * @return string نام سایت
     */
    public function getSiteName() {
        // این متد می‌تواند از یک جدول تنظیمات یا از جدول footer محتوا را بخواند
        return "مجتمع آموزشی سلمان فارسی";
    }
}