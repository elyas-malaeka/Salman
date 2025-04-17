<?php
/**
 * Staff Helper Functions
 * 
 * This file contains helper functions for the staff page
 * to retrieve data from the new database structure.
 * 
 * @package Salman Educational Complex
 * @version 3.0
 */

/**
 * Get Language ID from language code
 * 
 * @param string $lang_code Language code (fa, en, ar)
 * @return int Language ID
 */
function getLanguageId($lang_code) {
    // ایجاد اتصال به دیتابیس اگر موجود نیست
    $conn = connectDB();
    
    $lang_code = mysqli_real_escape_string($conn, $lang_code);
    $query = "SELECT language_id FROM languages WHERE code = '{$lang_code}' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['language_id'];
    }
    
    // Default to 1 (assumed to be Persian) if not found
    return 1;
}

/**
 * Get all static content for the staff page from database
 * 
 * @param int $language_id Language ID
 * @return array Page content
 */
function getStaffPageContent($language_id) {
    // ایجاد اتصال به دیتابیس اگر موجود نیست
    $conn = connectDB();
    
    $language_id = mysqli_real_escape_string($conn, $language_id);
    $content = [];
    
    // Default values in case database doesn't have entries yet
    $defaults = [
        'fa' => [
            'page_title' => 'کارکنان مجتمع',
            'header_title' => 'کارکنان مجتمع',
            'header_subtitle' => 'آشنایی با اعضای هیئت علمی و کارکنان مجتمع آموزشی سلمان فارسی',
            'search_placeholder' => 'جستجوی نام یا سمت...',
            'filter_all' => 'همه',
            'filter_management' => 'مدیریت',
            'filter_teaching' => 'آموزشی',
            'filter_support' => 'پشتیبانی',
            'no_staff_found' => 'هیچ عضوی یافت نشد',
            'no_results_title' => 'نتیجه‌ای یافت نشد',
            'no_results_message' => 'هیچ اعضایی با معیارهای جستجوی شما یافت نشد. لطفاً معیارهای جستجو را تغییر دهید.',
            'reset_button' => 'بازنشانی',
            'email_title' => 'ایمیل',
            'profile_title' => 'مشاهده پروفایل',
            'management_title' => 'کادر مدیریتی',
            'management_desc' => 'مدیران مجتمع با تجربه و دانش کافی در زمینه مدیریت آموزشی',
            'teaching_title' => 'کادر آموزشی',
            'teaching_desc' => 'معلمان متخصص با تجربه تدریس در زمینه‌های مختلف آموزشی',
            'support_title' => 'کادر پشتیبانی',
            'support_desc' => 'همکاران پشتیبانی که در ارائه خدمات آموزشی با کیفیت به دانش‌آموزان یاری می‌رسانند',
            'profile_modal_title' => 'اطلاعات کامل',
            'close_button' => 'بستن',
            'profile_error' => 'خطا در بارگذاری اطلاعات',
            'management_positions' => 'مدیر,معاون,حسابدار,معاون اجرایی,معاون آموزشی,معاون پرورشی',
            'teaching_positions' => 'دبیر,آموزگار,مربی زبان,هنرآموز'
        ],
        'en' => [
            'page_title' => 'Our Team',
            'header_title' => 'Our Team',
            'header_subtitle' => 'Meet the academic staff and personnel of Salman Farsi Educational Complex',
            'search_placeholder' => 'Search by name or position...',
            'filter_all' => 'All',
            'filter_management' => 'Management',
            'filter_teaching' => 'Teaching',
            'filter_support' => 'Support',
            'no_staff_found' => 'No staff members found',
            'no_results_title' => 'No Results Found',
            'no_results_message' => 'No staff members match your search criteria. Please try different search terms.',
            'reset_button' => 'Reset',
            'email_title' => 'Email',
            'profile_title' => 'View Profile',
            'management_title' => 'Management Team',
            'management_desc' => 'Experienced managers with expertise in educational administration',
            'teaching_title' => 'Teaching Staff',
            'teaching_desc' => 'Qualified teachers with extensive experience in various educational fields',
            'support_title' => 'Support Staff',
            'support_desc' => 'Support personnel assisting in providing quality educational services to students',
            'profile_modal_title' => 'Staff Profile',
            'close_button' => 'Close',
            'profile_error' => 'Error loading profile data',
            'management_positions' => 'Management,Deputy,Accountant,Deputy manager,Educational Assistant',
            'teaching_positions' => 'Teacher,language instructor'
        ],
        'ar' => [
            'page_title' => 'فريقنا',
            'header_title' => 'فريقنا',
            'header_subtitle' => 'تعرف على الكادر الأكاديمي والموظفين بمجمع سلمان الفارسي التعليمي',
            'search_placeholder' => 'البحث عن طريق الاسم أو المنصب...',
            'filter_all' => 'الكل',
            'filter_management' => 'الإدارة',
            'filter_teaching' => 'التدريس',
            'filter_support' => 'الدعم',
            'no_staff_found' => 'لم يتم العثور على أعضاء',
            'no_results_title' => 'لم يتم العثور على نتائج',
            'no_results_message' => 'لا يوجد موظفين يطابقون معايير البحث الخاصة بك. يرجى تجربة عبارات بحث مختلفة.',
            'reset_button' => 'إعادة تعيين',
            'email_title' => 'البريد الإلكتروني',
            'profile_title' => 'عرض الملف الشخصي',
            'management_title' => 'فريق الإدارة',
            'management_desc' => 'مديرون ذوو خبرة واسعة في مجال الإدارة التعليمية',
            'teaching_title' => 'هيئة التدريس',
            'teaching_desc' => 'معلمون مؤهلون ذوو خبرة واسعة في مختلف المجالات التعليمية',
            'support_title' => 'فريق الدعم',
            'support_desc' => 'موظفو الدعم المساعدون في تقديم خدمات تعليمية ذات جودة عالية للطلاب',
            'profile_modal_title' => 'الملف الشخصي للموظف',
            'close_button' => 'إغلاق',
            'profile_error' => 'خطأ في تحميل بيانات الملف الشخصي',
            'management_positions' => 'مدير,نائب,محاسب,نائب المدير,مساعد تعليمي',
            'teaching_positions' => 'معلم,مدرس لغة'
        ]
    ];
    
    // Get the language code for fallback
    $query = "SELECT code FROM languages WHERE language_id = {$language_id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $lang_code = 'fa'; // Default
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lang_code = $row['code'];
    }
    
    // Try to get content from the database
    $query = "SELECT field_key, content FROM staff_content 
              WHERE language_id = {$language_id}";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content[$row['field_key']] = $row['content'];
        }
    }
    
    // Fill in any missing values with defaults
    foreach ($defaults[$lang_code] as $key => $value) {
        if (!isset($content[$key])) {
            $content[$key] = $value;
        }
    }
    
    return $content;
}

/**
 * Get all staff members from database
 * 
 * @param int $language_id Language ID
 * @return array Staff members
 */
function getStaffMembers($language_id) {
    // ایجاد اتصال به دیتابیس اگر موجود نیست
    $conn = connectDB();
    
    $language_id = mysqli_real_escape_string($conn, $language_id);
    $staff = [];
    
    $query = "SELECT s.id, s.photo_url, t.name, t.position, t.education, t.bio 
              FROM staff s
              LEFT JOIN staff_translations t ON s.id = t.staff_id AND t.language_id = {$language_id}
              ORDER BY t.name ASC";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Add email and linkedin placeholders - these could be added to the staff table
            // or retrieved from a different table if needed
            $row['email'] = '';  // Placeholder - could be added to the staff table
            $row['linkedin'] = ''; // Placeholder - could be added to the staff table
            
            $staff[] = $row;
        }
    }
    
    return $staff;
}

/**
 * Get staff profile data for the modal
 * 
 * @param int $staff_id Staff ID
 * @param int $language_id Language ID
 * @return array Staff profile data
 */
function getStaffProfile($staff_id, $language_id) {
    // ایجاد اتصال به دیتابیس اگر موجود نیست
    $conn = connectDB();
    
    $staff_id = mysqli_real_escape_string($conn, $staff_id);
    $language_id = mysqli_real_escape_string($conn, $language_id);
    
    $query = "SELECT s.id, s.photo_url, t.name, t.position, t.education, t.bio 
              FROM staff s
              LEFT JOIN staff_translations t ON s.id = t.staff_id AND t.language_id = {$language_id}
              WHERE s.id = {$staff_id}
              LIMIT 1";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}