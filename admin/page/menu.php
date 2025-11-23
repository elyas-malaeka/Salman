<?php
/**
 * Menu Dashboard - Enhanced Admin Panel for Menu Management
 * 
 * Features:
 * - Modern UI with responsive design
 * - Live preview for menu structure
 * - Enhanced form controls
 * - Improved navigation and user experience
 * - Drag and drop menu ordering
 * - Image upload capability
 * - Enhanced security
 * 
 * @package Salman Educational Complex
 * @version 2.1
 * @updated 2025-03-29
 */

// Include config and authentication
require_once '../../includes/config.php';

// Include helper functions for security and image upload
require_once '../../includes/functions.php';

// If functions.php doesn't exist, create these essential functions
if (!function_exists('uploadImage')) {
    /**
     * Upload Image Function
     * @param array $file $_FILES array element
     * @param string $destination Directory to save uploaded file
     * @param array $allowed_types Array of allowed mime types
     * @param int $max_size Maximum file size in bytes
     * @return array Result with status and message/filepath
     */
    function uploadImage($file, $destination = '../uploads/images/', $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], $max_size = 2097152) {
        // Check if file was uploaded properly
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return [
                'status' => false,
                'message' => 'خطا در آپلود فایل: ' . getUploadErrorMessage($file['error'])
            ];
        }
        
        // Create directory if it doesn't exist
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        // Validate file size
        if ($file['size'] > $max_size) {
            return [
                'status' => false,
                'message' => 'حجم فایل بیشتر از حد مجاز است (حداکثر ' . formatBytes($max_size) . ')'
            ];
        }

        // Validate file type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $file_type = $finfo->file($file['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            return [
                'status' => false,
                'message' => 'نوع فایل مجاز نیست. فقط فرمت‌های تصویر مجاز هستند.'
            ];
        }

        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid('img_') . '.' . $file_extension;
        $upload_path = $destination . $new_filename;

        // Move the uploaded file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            return [
                'status' => true,
                'file_path' => $upload_path,
                'file_name' => $new_filename
            ];
        } else {
            return [
                'status' => false,
                'message' => 'خطا در ذخیره فایل، لطفا دسترسی‌های پوشه را بررسی کنید.'
            ];
        }
    }

    /**
     * Get readable error message for upload errors
     */
    function getUploadErrorMessage($error_code) {
        switch ($error_code) {
            case UPLOAD_ERR_INI_SIZE:
                return 'فایل آپلود شده بزرگتر از مقدار مجاز در php.ini است';
            case UPLOAD_ERR_FORM_SIZE:
                return 'فایل آپلود شده بزرگتر از مقدار مجاز در فرم HTML است';
            case UPLOAD_ERR_PARTIAL:
                return 'فایل فقط به صورت جزئی آپلود شده است';
            case UPLOAD_ERR_NO_FILE:
                return 'هیچ فایلی آپلود نشده است';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'پوشه موقت موجود نیست';
            case UPLOAD_ERR_CANT_WRITE:
                return 'شکست در نوشتن فایل روی دیسک';
            case UPLOAD_ERR_EXTENSION:
                return 'یک افزونه PHP آپلود فایل را متوقف کرد';
            default:
                return 'خطای ناشناخته در آپلود';
        }
    }

    /**
     * Format bytes to human readable format
     */
    function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Sanitize input data
     */
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Generate CSRF token
     */
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validate CSRF token
     */
    function validateCSRFToken($token) {
        if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
            return false;
        }
        return true;
    }
}


// Define action and language
$action = isset($_GET['action']) ? $_GET['action'] : '';
$currentLang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';

// Check for new item notifications
$new_item_id = isset($_GET['new_item']) ? (int)$_GET['new_item'] : null;

// Check for error or success messages in session
$error_message = null;
$success_message = null;

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Generate CSRF token
$csrf_token = generateCSRFToken();

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Skip CSRF check for AJAX reordering
    if (isset($_POST['action']) && $_POST['action'] !== 'reorder_menu') {
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error_message'] = "خطای امنیتی: درخواست نامعتبر است.";
            header("Location: ?lang={$currentLang}");
            exit;
        }
    }

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_menu':
                // Sanitize and validate input
                $title = mysqli_real_escape_string($db, sanitizeInput($_POST['title']));
                $url = mysqli_real_escape_string($db, sanitizeInput($_POST['url']));
                $parent_id = !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : 'NULL';
                $language_id = mysqli_real_escape_string($db, $_POST['language_id']);
                $order = (int)$_POST['order'];
                
                // Upload icon if provided
                $icon_path = '';
                
                if (isset($_FILES['menu_icon']) && $_FILES['menu_icon']['error'] !== UPLOAD_ERR_NO_FILE) {
                    $upload_result = uploadImage($_FILES['menu_icon'], '../uploads/menu_icons/');
                    
                    if ($upload_result['status']) {
                        $icon_path = mysqli_real_escape_string($db, $upload_result['file_path']);
                    } else {
                        $_SESSION['error_message'] = "خطا در آپلود آیکون: " . $upload_result['message'];
                        header("Location: ?action=add_menu&lang={$language_id}");
                        exit;
                    }
                }
                
                // Validate required fields
                if (empty($title)) {
                    $_SESSION['error_message'] = "لطفاً عنوان منو را وارد کنید.";
                    header("Location: ?action=add_menu&lang={$language_id}");
                    exit;
                }
                
                $query = "INSERT INTO menu_items (title, url, parent_id, language_id, `order`, is_active, icon_path) 
                          VALUES ('{$title}', '{$url}', {$parent_id}, '{$language_id}', {$order}, 1, '{$icon_path}')";
                
                if (mysqli_query($db, $query)) {
                    $new_id = mysqli_insert_id($db);
                    $_SESSION['success_message'] = "منوی جدید با موفقیت اضافه شد.";
                    header("Location: ?lang={$language_id}&new_item={$new_id}#item-added");
                    exit;
                } else {
                    $_SESSION['error_message'] = "خطا در افزودن منو: " . mysqli_error($db);
                    header("Location: ?action=add_menu&lang={$language_id}");
                    exit;
                }
                break;
                
            case 'edit_menu':
                // Sanitize and validate input
                $id = (int)$_POST['id'];
                $title = mysqli_real_escape_string($db, sanitizeInput($_POST['title']));
                $url = mysqli_real_escape_string($db, sanitizeInput($_POST['url']));
                $parent_id = !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : 'NULL';
                $order = (int)$_POST['order'];
                $is_active = isset($_POST['is_active']) ? 1 : 0;
                
                // Check if a new icon is uploaded
                $icon_sql = "";
                
                if (isset($_FILES['menu_icon']) && $_FILES['menu_icon']['error'] !== UPLOAD_ERR_NO_FILE) {
                    $upload_result = uploadImage($_FILES['menu_icon'], '../uploads/menu_icons/');
                    
                    if ($upload_result['status']) {
                        $icon_path = mysqli_real_escape_string($db, $upload_result['file_path']);
                        $icon_sql = ", icon_path = '{$icon_path}'";
                        
                        // Delete old icon if exists
                        $query = "SELECT icon_path FROM menu_items WHERE id = {$id}";
                        $result = mysqli_query($db, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            if (!empty($row['icon_path']) && file_exists($row['icon_path'])) {
                                @unlink($row['icon_path']);
                            }
                        }
                    } else {
                        $_SESSION['error_message'] = "خطا در آپلود آیکون: " . $upload_result['message'];
                        header("Location: ?action=edit_menu&id={$id}&lang={$currentLang}");
                        exit;
                    }
                }
                
                // Validate required fields
                if (empty($title)) {
                    $_SESSION['error_message'] = "لطفاً عنوان منو را وارد کنید.";
                    header("Location: ?action=edit_menu&id={$id}&lang={$currentLang}");
                    exit;
                }
                
                $query = "UPDATE menu_items SET 
                          title = '{$title}', 
                          url = '{$url}', 
                          parent_id = {$parent_id}, 
                          `order` = {$order},
                          is_active = {$is_active}
                          {$icon_sql}
                          WHERE id = {$id}";
                
                if (mysqli_query($db, $query)) {
                    $_SESSION['success_message'] = "منو با موفقیت ویرایش شد.";
                    header("Location: ?lang={$currentLang}&updated_item={$id}#item-updated");
                    exit;
                } else {
                    $_SESSION['error_message'] = "خطا در ویرایش منو: " . mysqli_error($db);
                    header("Location: ?action=edit_menu&id={$id}&lang={$currentLang}");
                    exit;
                }
                break;
                
            case 'delete_menu':
                // Delete menu item with proper validation
                $id = (int)$_POST['id'];
                
                // Check if this menu exists
                $check_query = "SELECT id, icon_path FROM menu_items WHERE id = {$id}";
                $check_result = mysqli_query($db, $check_query);
                
                if (mysqli_num_rows($check_result) === 0) {
                    $_SESSION['error_message'] = "منوی مورد نظر یافت نشد.";
                    header("Location: ?lang={$currentLang}");
                    exit;
                }
                
                // Get icon path for deletion
                $icon_path = mysqli_fetch_assoc($check_result)['icon_path'];
                
                // First, check if this has children and update or delete them
                $query = "SELECT id FROM menu_items WHERE parent_id = {$id}";
                $result = mysqli_query($db, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    // Has children - set their parent_id to NULL
                    $query = "UPDATE menu_items SET parent_id = NULL WHERE parent_id = {$id}";
                    mysqli_query($db, $query);
                }
                
                // Now delete the menu item
                $query = "DELETE FROM menu_items WHERE id = {$id}";
                if (mysqli_query($db, $query)) {
                    // Delete icon file if exists
                    if (!empty($icon_path) && file_exists($icon_path)) {
                        @unlink($icon_path);
                    }
                    
                    $_SESSION['success_message'] = "منو با موفقیت حذف شد.";
                } else {
                    $_SESSION['error_message'] = "خطا در حذف منو: " . mysqli_error($db);
                }
                
                header("Location: ?lang={$currentLang}");
                exit;
                break;
                
            case 'add_social':
                // Sanitize and validate input
                $platform = mysqli_real_escape_string($db, sanitizeInput($_POST['platform']));
                $icon_class = mysqli_real_escape_string($db, sanitizeInput($_POST['icon_class']));
                $url = mysqli_real_escape_string($db, sanitizeInput($_POST['url']));
                $order = (int)$_POST['order'];
                
                // Validate required fields
                if (empty($platform) || empty($icon_class) || empty($url)) {
                    $_SESSION['error_message'] = "تمام فیلدهای الزامی را تکمیل کنید.";
                    header("Location: ?action=add_social&lang={$currentLang}");
                    exit;
                }
                
                $query = "INSERT INTO social_media (platform, icon_class, url, `order`, is_active) 
                          VALUES ('{$platform}', '{$icon_class}', '{$url}', {$order}, 1)";
                
                if (mysqli_query($db, $query)) {
                    $new_id = mysqli_insert_id($db);
                    $_SESSION['success_message'] = "شبکه اجتماعی جدید با موفقیت اضافه شد.";
                    header("Location: ?lang={$currentLang}&new_item={$new_id}#social-added");
                    exit;
                } else {
                    $_SESSION['error_message'] = "خطا در افزودن شبکه اجتماعی: " . mysqli_error($db);
                    header("Location: ?action=add_social&lang={$currentLang}");
                    exit;
                }
                break;
                
            case 'edit_social':
                // Sanitize and validate input
                $id = (int)$_POST['id'];
                $platform = mysqli_real_escape_string($db, sanitizeInput($_POST['platform']));
                $icon_class = mysqli_real_escape_string($db, sanitizeInput($_POST['icon_class']));
                $url = mysqli_real_escape_string($db, sanitizeInput($_POST['url']));
                $order = (int)$_POST['order'];
                $is_active = isset($_POST['is_active']) ? 1 : 0;
                
                // Validate required fields
                if (empty($platform) || empty($icon_class) || empty($url)) {
                    $_SESSION['error_message'] = "تمام فیلدهای الزامی را تکمیل کنید.";
                    header("Location: ?action=edit_social&id={$id}&lang={$currentLang}");
                    exit;
                }
                
                $query = "UPDATE social_media SET 
                          platform = '{$platform}', 
                          icon_class = '{$icon_class}', 
                          url = '{$url}', 
                          `order` = {$order},
                          is_active = {$is_active}
                          WHERE id = {$id}";
                
                if (mysqli_query($db, $query)) {
                    $_SESSION['success_message'] = "شبکه اجتماعی با موفقیت ویرایش شد.";
                    header("Location: ?lang={$currentLang}&updated_item={$id}#social-updated");
                    exit;
                } else {
                    $_SESSION['error_message'] = "خطا در ویرایش شبکه اجتماعی: " . mysqli_error($db);
                    header("Location: ?action=edit_social&id={$id}&lang={$currentLang}");
                    exit;
                }
                break;
                
            case 'delete_social':
                // Delete social media link
                $id = (int)$_POST['id'];
                
                // Check if this social media exists
                $check_query = "SELECT id FROM social_media WHERE id = {$id}";
                $check_result = mysqli_query($db, $check_query);
                
                if (mysqli_num_rows($check_result) === 0) {
                    $_SESSION['error_message'] = "شبکه اجتماعی مورد نظر یافت نشد.";
                    header("Location: ?lang={$currentLang}");
                    exit;
                }
                
                $query = "DELETE FROM social_media WHERE id = {$id}";
                if (mysqli_query($db, $query)) {
                    $_SESSION['success_message'] = "شبکه اجتماعی با موفقیت حذف شد.";
                } else {
                    $_SESSION['error_message'] = "خطا در حذف شبکه اجتماعی: " . mysqli_error($db);
                }
                
                header("Location: ?lang={$currentLang}");
                exit;
                break;
                
            case 'add_contact':
                // Sanitize and validate input
                $type = mysqli_real_escape_string($db, sanitizeInput($_POST['type']));
                $value = mysqli_real_escape_string($db, sanitizeInput($_POST['value']));
                $icon_class = mysqli_real_escape_string($db, sanitizeInput($_POST['icon_class']));
                $language_id = mysqli_real_escape_string($db, $_POST['language_id']);
                
                // Validate required fields
                if (empty($type) || empty($value) || empty($icon_class)) {
                    $_SESSION['error_message'] = "تمام فیلدهای الزامی را تکمیل کنید.";
                    header("Location: ?action=add_contact&lang={$language_id}");
                    exit;
                }
                
                $query = "INSERT INTO contact_info (type, value, icon_class, language_id, is_active) 
                          VALUES ('{$type}', '{$value}', '{$icon_class}', '{$language_id}', 1)";
                
                if (mysqli_query($db, $query)) {
                    $new_id = mysqli_insert_id($db);
                    $_SESSION['success_message'] = "اطلاعات تماس جدید با موفقیت اضافه شد.";
                    header("Location: ?lang={$language_id}&new_item={$new_id}#contact-added");
                    exit;
                } else {
                    $_SESSION['error_message'] = "خطا در افزودن اطلاعات تماس: " . mysqli_error($db);
                    header("Location: ?action=add_contact&lang={$language_id}");
                    exit;
                }
                break;
                
            case 'edit_contact':
                // Sanitize and validate input
                $id = (int)$_POST['id'];
                $type = mysqli_real_escape_string($db, sanitizeInput($_POST['type']));
                $value = mysqli_real_escape_string($db, sanitizeInput($_POST['value']));
                $icon_class = mysqli_real_escape_string($db, sanitizeInput($_POST['icon_class']));
                $is_active = isset($_POST['is_active']) ? 1 : 0;
                
                // Validate required fields
                if (empty($type) || empty($value) || empty($icon_class)) {
                    $_SESSION['error_message'] = "تمام فیلدهای الزامی را تکمیل کنید.";
                    header("Location: ?action=edit_contact&id={$id}&lang={$currentLang}");
                    exit;
                }
                
                $query = "UPDATE contact_info SET 
                          type = '{$type}', 
                          value = '{$value}', 
                          icon_class = '{$icon_class}', 
                          is_active = {$is_active}
                          WHERE id = {$id}";
                
                if (mysqli_query($db, $query)) {
                    $_SESSION['success_message'] = "اطلاعات تماس با موفقیت ویرایش شد.";
                    header("Location: ?lang={$currentLang}&updated_item={$id}#contact-updated");
                    exit;
                } else {
                    $_SESSION['error_message'] = "خطا در ویرایش اطلاعات تماس: " . mysqli_error($db);
                    header("Location: ?action=edit_contact&id={$id}&lang={$currentLang}");
                    exit;
                }
                break;
                
            case 'delete_contact':
                // Delete contact info
                $id = (int)$_POST['id'];
                
                // Check if this contact info exists
                $check_query = "SELECT id FROM contact_info WHERE id = {$id}";
                $check_result = mysqli_query($db, $check_query);
                
                if (mysqli_num_rows($check_result) === 0) {
                    $_SESSION['error_message'] = "اطلاعات تماس مورد نظر یافت نشد.";
                    header("Location: ?lang={$currentLang}");
                    exit;
                }
                
                $query = "DELETE FROM contact_info WHERE id = {$id}";
                if (mysqli_query($db, $query)) {
                    $_SESSION['success_message'] = "اطلاعات تماس با موفقیت حذف شد.";
                } else {
                    $_SESSION['error_message'] = "خطا در حذف اطلاعات تماس: " . mysqli_error($db);
                }
                
                header("Location: ?lang={$currentLang}");
                exit;
                break;
                
            case 'edit_setting':
                // Edit site setting
                $key = mysqli_real_escape_string($db, $_POST['key']);
                $value = mysqli_real_escape_string($db, sanitizeInput($_POST['value']));
                
                $query = "UPDATE site_settings SET 
                          value = '{$value}'
                          WHERE `key` = '{$key}'";
                
                if (mysqli_query($db, $query)) {
                    // Use floating notification instead of redirect
                    $success_message = "تنظیمات با موفقیت ویرایش شد.";
                } else {
                    $error_message = "خطا در ویرایش تنظیمات: " . mysqli_error($db);
                }
                break;
                
            case 'reorder_menu':
                // Update menu order via AJAX
                $items = json_decode($_POST['items'], true);
                
                if (is_array($items)) {
                    foreach ($items as $item) {
                        $id = (int)$item['id'];
                        $order = (int)$item['order'];
                        $parent_id = $item['parent_id'] === '' ? 'NULL' : (int)$item['parent_id'];
                        
                        $query = "UPDATE menu_items SET `order` = {$order}, parent_id = {$parent_id} WHERE id = {$id}";
                        mysqli_query($db, $query);
                    }
                    
                    // This is AJAX request, so just return success
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'ترتیب منوها با موفقیت بروزرسانی شد.']);
                    exit;
                }
                
                // If we get here, something went wrong
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'خطا در بروزرسانی ترتیب منوها.']);
                exit;
                break;
        }
    }
}

// Function to get menu item by ID
function getMenuItem($db, $id) {
    $id = (int)$id;
    $query = "SELECT * FROM menu_items WHERE id = {$id}";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

// Function to get social media item by ID
function getSocialMediaItem($db, $id) {
    $id = (int)$id;
    $query = "SELECT * FROM social_media WHERE id = {$id}";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

// Function to get contact info item by ID
function getContactInfoItem($db, $id) {
    $id = (int)$id;
    $query = "SELECT * FROM contact_info WHERE id = {$id}";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return null;
}

// Function to get parent menu options
function getParentMenuOptions($db, $language, $selected_id = null, $exclude_id = null) {
    $language = mysqli_real_escape_string($db, $language);
    $query = "SELECT id, title FROM menu_items 
              WHERE language_id = '{$language}' 
              AND parent_id IS NULL";
    
    if ($exclude_id) {
        $exclude_id = (int)$exclude_id;
        $query .= " AND id != {$exclude_id}";
    }
    
    $query .= " ORDER BY `order` ASC";
    
    $result = mysqli_query($db, $query);
    $options = '<option value="">-- بدون والد (منوی اصلی) --</option>';
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $selected = $selected_id == $row['id'] ? 'selected' : '';
            $options .= "<option value='{$row['id']}' {$selected}>{$row['title']}</option>";
            
            // Also get children for this parent
            $childOptions = getChildMenuOptions($db, $row['id'], $language, $selected_id, $exclude_id);
            if ($childOptions) {
                $options .= $childOptions;
            }
        }
    }
    
    return $options;
}

// Function to get child menu options (for multi-level dropdown)
function getChildMenuOptions($db, $parent_id, $language, $selected_id = null, $exclude_id = null, $level = 1) {
    $parent_id = (int)$parent_id;
    $language = mysqli_real_escape_string($db, $language);
    $query = "SELECT id, title FROM menu_items 
              WHERE language_id = '{$language}' 
              AND parent_id = {$parent_id}";
    
    if ($exclude_id) {
        $exclude_id = (int)$exclude_id;
        $query .= " AND id != {$exclude_id}";
    }
    
    $query .= " ORDER BY `order` ASC";
    
    $result = mysqli_query($db, $query);
    $options = '';
    
    if ($result && mysqli_num_rows($result) > 0) {
        $prefix = str_repeat('&nbsp;&nbsp;', $level) . '└─ ';
        
        while ($row = mysqli_fetch_assoc($result)) {
            $selected = $selected_id == $row['id'] ? 'selected' : '';
            $options .= "<option value='{$row['id']}' {$selected}>{$prefix}{$row['title']}</option>";
            
            // Recursively get children of this child
            $childOptions = getChildMenuOptions($db, $row['id'], $language, $selected_id, $exclude_id, $level + 1);
            if ($childOptions) {
                $options .= $childOptions;
            }
        }
    }
    
    return $options;
}

// Function to build menu tree for nested display
function buildMenuTree($db, $language, $parent_id = null) {
    $language = mysqli_real_escape_string($db, $language);
    $where = $parent_id === null ? "parent_id IS NULL" : "parent_id = " . (int)$parent_id;
    $query = "SELECT * FROM menu_items WHERE language_id = '{$language}' AND {$where} ORDER BY `order` ASC";
    $result = mysqli_query($db, $query);
    
    $output = '<ul class="menu-tree-list">';
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
            $statusClass = $item['is_active'] ? 'item-active' : 'item-inactive';
            $statusText = $item['is_active'] ? 'فعال' : 'غیرفعال';
            $statusIcon = $item['is_active'] ? 'check-circle' : 'times-circle';
            $isNewItem = isset($new_item_id) && $item['id'] == $new_item_id;
            $hasIcon = !empty($item['icon_path']);
            
            $output .= '<li class="menu-tree-item' . ($isNewItem ? ' item-new scroll-target' : '') . '" data-id="' . $item['id'] . '" id="menu-item-' . $item['id'] . '">';
            $output .= '<div class="menu-tree-item-header ' . $statusClass . '">';
            $output .= '<span class="menu-tree-handle"><i class="fas fa-grip-vertical"></i></span>';
            
            // Show icon if exists
            if ($hasIcon) {
                $output .= '<span class="menu-tree-icon"><img src="' . htmlspecialchars($item['icon_path']) . '" alt="Icon" class="menu-icon-preview"></span>';
            }
            
            $output .= '<span class="menu-tree-title">' . htmlspecialchars($item['title']) . '</span>';
            $output .= '<span class="menu-tree-url">' . htmlspecialchars($item['url']) . '</span>';
            $output .= '<span class="menu-tree-status"><i class="fas fa-' . $statusIcon . '"></i> ' . $statusText . '</span>';
            $output .= '<div class="menu-tree-actions">';
            $output .= '<a href="?action=edit_menu&id=' . $item['id'] . '&lang=' . $language . '" class="menu-tree-action menu-tree-edit"><i class="fas fa-edit"></i></a>';
            $output .= '<button type="button" class="menu-tree-action menu-tree-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' . $item['id'] . '" data-type="menu"><i class="fas fa-trash"></i></button>';
            $output .= '</div>';
            $output .= '</div>';
            
            // Check for children
            $childQuery = "SELECT COUNT(*) as count FROM menu_items WHERE parent_id = " . (int)$item['id'];
            $childResult = mysqli_query($db, $childQuery);
            $childRow = mysqli_fetch_assoc($childResult);
            
            if ($childRow['count'] > 0) {
                $output .= buildMenuTree($db, $language, $item['id']);
            }
            
            $output .= '</li>';
        }
    } else {
        $output .= '<li class="menu-tree-empty">هیچ موردی یافت نشد.</li>';
    }
    
    $output .= '</ul>';
    return $output;
}

// Get data for display
$languages = ['fa' => 'فارسی', 'en' => 'انگلیسی', 'ar' => 'عربی'];

// Get menu items for current language
$query = "SELECT m1.*, m2.title as parent_title 
          FROM menu_items m1
          LEFT JOIN menu_items m2 ON m1.parent_id = m2.id
          WHERE m1.language_id = '{$currentLang}'
          ORDER BY m1.parent_id IS NULL DESC, m1.parent_id, m1.`order`";
$menuItems = mysqli_query($db, $query);

// Get social media links
$query = "SELECT * FROM social_media ORDER BY `order`";
$socialMediaLinks = mysqli_query($db, $query);

// Get contact info for current language
$query = "SELECT * FROM contact_info WHERE language_id = '{$currentLang}'";
$contactInfo = mysqli_query($db, $query);

// Get site settings
$query = "SELECT * FROM site_settings";
$siteSettings = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت منو - مجتمع آموزشی سلمان فارسی</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #6941C6;
            --primary-hover: #5729b3;
            --secondary: #9E77ED;
            --accent: #7F56D9;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
            --info: #0ea5e9;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --border: #e2e8f0;
            --shadow: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --radius: 0.5rem;
        }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f8fafc;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath fill='%23ffffff' fill-opacity='0.05' d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z'%3E%3C/path%3E%3C/svg%3E");
        }
        
        .header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        .page-title {
            position: relative;
            z-index: 1;
        }
        
        .container {
            max-width: 1200px;
            padding: 0 1rem;
        }
        
        .card {
            background-color: white;
            border-radius: var(--radius);
            border: none;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }
        
        .card:hover {
            box-shadow: var(--shadow-lg);
        }
        
        .card-header {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 1rem 1.25rem;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header.bg-light {
            background-color: #f8fafc !important;
            color: var(--dark);
            border-bottom: 1px solid var(--border);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }
        
        .btn-success:hover {
            background-color: #15803d;
            border-color: #15803d;
        }
        
        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
        }
        
        .btn-danger:hover {
            background-color: #b91c1c;
            border-color: #b91c1c;
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .nav-tabs {
            border-bottom: 2px solid var(--border);
            margin-bottom: 1.5rem;
        }
        
        .nav-tabs .nav-link {
            margin-bottom: -2px;
            border: none;
            color: var(--gray);
            font-weight: 500;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }
        
        .nav-tabs .nav-link:hover {
            color: var(--primary);
            border-color: transparent;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
            background-color: transparent;
        }
        
        .form-label {
            color: var(--gray-dark);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 0.375rem;
            border-color: var(--border);
            padding: 0.625rem 0.875rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(105, 65, 198, 0.25);
        }
        
        .form-select {
            border-radius: 0.375rem;
            border-color: var(--border);
            padding: 0.625rem 2.5rem 0.625rem 0.875rem;
            font-size: 0.95rem;
            background-position: left 0.75rem center;
            transition: all 0.2s;
        }
        
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(105, 65, 198, 0.25);
        }
        
        .form-check-input {
            width: 1.25em;
            height: 1.25em;
            margin-top: 0.125em;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(105, 65, 198, 0.25);
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .table th {
            font-weight: 600;
            color: var(--gray-dark);
            background-color: rgba(241, 245, 249, 0.5);
            border-top: none;
            border-bottom: 2px solid var(--border);
            padding: 0.75rem 1rem;
        }
        
        .table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        .table tr:hover td {
            background-color: rgba(105, 65, 198, 0.05);
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 50rem;
        }
        
        .badge.bg-success {
            background-color: rgba(22, 163, 74, 0.1) !important;
            color: var(--success) !important;
        }
        
        .badge.bg-secondary {
            background-color: rgba(100, 116, 139, 0.1) !important;
            color: var(--gray) !important;
        }
        
        .alert {
            border-radius: var(--radius);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
        }
        
        .alert-success {
            color: var(--success);
            background-color: rgba(22, 163, 74, 0.1);
            border-color: rgba(22, 163, 74, 0.2);
        }
        
        .alert-danger {
            color: var(--danger);
            background-color: rgba(220, 38, 38, 0.1);
            border-color: rgba(220, 38, 38, 0.2);
        }
        
        .modal-content {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
        }
        
        .modal-header {
            background-color: var(--primary);
            color: white;
            border-bottom: none;
            border-top-left-radius: var(--radius);
            border-top-right-radius: var(--radius);
            padding: 1rem 1.5rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            border-top: 1px solid var(--border);
            padding: 1rem 1.5rem;
        }
        
        .accordion-item {
            border: 1px solid var(--border);
            margin-bottom: 0.5rem;
            border-radius: var(--radius);
            overflow: hidden;
        }
        
        .accordion-header {
            margin-bottom: 0;
        }
        
        .accordion-button {
            padding: 1rem 1.25rem;
            font-weight: 500;
            color: var(--dark);
            background-color: white;
            transition: all 0.2s;
        }
        
        .accordion-button:not(.collapsed) {
            color: var(--primary);
            background-color: rgba(105, 65, 198, 0.05);
            box-shadow: none;
        }
        
        .accordion-button:focus {
            box-shadow: none;
            border-color: var(--primary);
        }
        
        .accordion-body {
            padding: 1.25rem;
            background-color: rgba(248, 250, 252, 0.5);
        }
        
        /* Menu Tree Styles */
        .menu-tree {
            margin-bottom: 2rem;
        }
        
        .menu-tree-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .menu-tree-list .menu-tree-list {
            padding-right: 1.5rem;
            margin-top: 0.5rem;
            border-right: 1px dashed var(--border);
        }
        
        .menu-tree-item {
            margin-bottom: 0.5rem;
        }
        
        .menu-tree-item-header {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background-color: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: all 0.2s;
        }
        
        .menu-tree-item-header:hover {
            background-color: rgba(105, 65, 198, 0.05);
        }
        
        .menu-tree-item-header.item-active {
            border-left: 3px solid var(--success);
        }
        
        .menu-tree-item-header.item-inactive {
            border-left: 3px solid var(--gray);
            opacity: 0.75;
        }
        
        .menu-tree-handle {
            cursor: move;
            margin-left: 0.5rem;
            color: var(--gray);
            opacity: 0.5;
            transition: opacity 0.2s;
        }
        
        .menu-tree-item-header:hover .menu-tree-handle {
            opacity: 1;
        }
        
        .menu-tree-icon {
            margin-left: 0.75rem;
        }
        
        .menu-icon-preview {
            width: 24px;
            height: 24px;
            object-fit: contain;
            border-radius: 4px;
        }
        
        .menu-tree-title {
            font-weight: 500;
            flex: 1;
        }
        
        .menu-tree-url {
            font-size: 0.875rem;
            color: var(--gray);
            margin: 0 1rem;
        }
        
        .menu-tree-status {
            font-size: 0.875rem;
            width: 4rem;
            text-align: center;
        }
        
        .menu-tree-item-header.item-active .menu-tree-status {
            color: var(--success);
        }
        
        .menu-tree-item-header.item-inactive .menu-tree-status {
            color: var(--gray);
        }
        
        .menu-tree-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .menu-tree-action {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .menu-tree-edit {
            background-color: var(--primary);
        }
        
        .menu-tree-edit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .menu-tree-delete {
            background-color: var(--danger);
            border: none;
        }
        
        .menu-tree-delete:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
        }
        
        .menu-tree-empty {
            padding: 1rem;
            color: var(--gray);
            text-align: center;
            font-style: italic;
            background-color: rgba(248, 250, 252, 0.7);
            border-radius: var(--radius);
            border: 1px dashed var(--border);
        }
        
        /* Social Icons Preview */
        .social-icon-preview {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding: 1rem;
            background-color: rgba(248, 250, 252, 0.7);
            border-radius: var(--radius);
            border: 1px dashed var(--border);
        }
        
        .social-icon-demo {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            font-size: 1.25rem;
        }
        
        /* Contact Info Cards */
        .contact-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            margin-bottom: 1rem;
            background-color: white;
            transition: all 0.2s;
        }
        
        .contact-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }
        
        .contact-icon {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            font-size: 1.25rem;
        }
        
        .contact-info {
            flex: 1;
        }
        
        .contact-type {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .contact-value {
            font-size: 0.875rem;
            color: var(--gray);
        }
        
        .contact-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        /* Settings Styles */
        .setting-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            margin-bottom: 1rem;
            background-color: white;
        }
        
        .setting-key {
            width: 10rem;
            font-weight: 500;
        }
        
        .setting-value {
            flex: 1;
        }
        
        .setting-value input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 0.25rem;
        }
        
        .setting-actions {
            margin-right: 1rem;
        }
        
        /* Custom styles for file uploads */
        .custom-file-upload {
            border: 1px dashed var(--border);
            border-radius: var(--radius);
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
            background-color: rgba(248, 250, 252, 0.5);
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .custom-file-upload:hover {
            background-color: rgba(248, 250, 252, 0.8);
        }
        
        .upload-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .upload-text {
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .current-image-preview {
            max-width: 100%;
            max-height: 150px;
            border-radius: var(--radius);
            margin-bottom: 1rem;
            box-shadow: var(--shadow);
        }
        
        /* Animation for new items */
        .item-new {
            animation: highlight-new-item 2s ease-out;
        }
        
        @keyframes highlight-new-item {
            0% { background-color: rgba(105, 65, 198, 0.2); }
            100% { background-color: #f8f9fa; }
        }
        
        /* Floating notifications */
        .alert-float {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            min-width: 300px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            opacity: 0;
            animation: fade-in-out 5s ease-in-out forwards;
        }
        
        @keyframes fade-in-out {
            0% { opacity: 0; transform: translate(-50%, -20px); }
            10% { opacity: 1; transform: translate(-50%, 0); }
            90% { opacity: 1; transform: translate(-50%, 0); }
            100% { opacity: 0; transform: translate(-50%, -20px); }
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 1.5rem 0;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .card-header .btn {
                align-self: flex-start;
            }
            
            .menu-tree-item-header {
                flex-wrap: wrap;
            }
            
            .menu-tree-url {
                width: 100%;
                margin: 0.25rem 0;
            }
            
            .menu-tree-actions {
                margin-top: 0.5rem;
            }
            
            .contact-card {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .contact-actions {
                margin-top: 1rem;
                width: 100%;
                justify-content: flex-end;
            }
            
            .setting-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .setting-key {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .setting-actions {
                margin-top: 1rem;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h1>مدیریت ناوبری و محتوای سایت</h1>
                        <p class="mb-0">مدیریت منوها، شبکه‌های اجتماعی و اطلاعات تماس در یک مکان</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <!-- Top Nav Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <ul class="nav nav-tabs flex-grow-1">
                <?php foreach ($languages as $code => $name): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentLang == $code ? 'active' : ''; ?>" href="?lang=<?php echo $code; ?>">
                            <?php echo $name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="admin.php" class="btn btn-outline-primary ms-3">
                <i class="fas fa-arrow-right ms-1"></i> بازگشت به پنل مدیریت
            </a>
        </div>
        
        <!-- Success Message -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Error Message -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Main Content -->
        <div class="row">
            <!-- Left Column - 2/3 width -->
            <div class="col-lg-8">
                <!-- Menu Items Management -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">مدیریت آیتم‌های منو</h5>
                        <a href="?action=add_menu&lang=<?php echo $currentLang; ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> افزودن منوی جدید
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if ($action === 'add_menu'): ?>
                            <!-- Add Menu Form -->
                            <form method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                <input type="hidden" name="action" value="add_menu">
                                <input type="hidden" name="language_id" value="<?php echo $currentLang; ?>">
                                
                                <div class="mb-3">
                                    <label for="title" class="form-label">عنوان منو</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="url" class="form-label">آدرس URL</label>
                                    <input type="text" class="form-control" id="url" name="url" required>
                                    <div class="form-text">برای منوهای دارای زیرمنو از # استفاده کنید.</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">منوی والد</label>
                                    <select class="form-select" id="parent_id" name="parent_id">
                                        <?php echo getParentMenuOptions($db, $currentLang); ?>
                                    </select>
                                    <div class="form-text">اگر این یک منوی اصلی است، خالی بگذارید.</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="menu_icon" class="form-label">آیکون منو (اختیاری)</label>
                                    <input type="file" class="form-control" id="menu_icon" name="menu_icon" accept="image/*">
                                    <div class="form-text">تصویر کوچک برای نمایش در کنار منو (حداکثر ۲۰۰ کیلوبایت)</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="order" class="form-label">ترتیب نمایش</label>
                                    <input type="number" class="form-control" id="order" name="order" value="0" min="0">
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> ذخیره
                                    </button>
                                    <a href="?lang=<?php echo $currentLang; ?>" class="btn btn-outline-secondary">انصراف</a>
                                </div>
                            </form>
                            
                        <?php elseif ($action === 'edit_menu' && isset($_GET['id'])): ?>
                            <!-- Edit Menu Form -->
                            <?php 
                                $menu = getMenuItem($db, $_GET['id']);
                                if ($menu):
                            ?>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                    <input type="hidden" name="action" value="edit_menu">
                                    <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="title" class="form-label">عنوان منو</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($menu['title']); ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="url" class="form-label">آدرس URL</label>
                                        <input type="text" class="form-control" id="url" name="url" value="<?php echo htmlspecialchars($menu['url']); ?>" required>
                                        <div class="form-text">برای منوهای دارای زیرمنو از # استفاده کنید.</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="parent_id" class="form-label">منوی والد</label>
                                        <select class="form-select" id="parent_id" name="parent_id">
                                            <?php echo getParentMenuOptions($db, $currentLang, $menu['parent_id'], $menu['id']); ?>
                                        </select>
                                        <div class="form-text">اگر این یک منوی اصلی است، خالی بگذارید.</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="menu_icon" class="form-label">آیکون منو (اختیاری)</label>
                                        <?php if (!empty($menu['icon_path']) && file_exists($menu['icon_path'])): ?>
                                            <div class="mb-2">
                                                <img src="<?php echo htmlspecialchars($menu['icon_path']); ?>" class="current-image-preview" alt="Icon Preview">
                                                <div class="form-text">آیکون فعلی. برای تغییر، فایل جدید انتخاب کنید.</div>
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" class="form-control" id="menu_icon" name="menu_icon" accept="image/*">
                                        <div class="form-text">تصویر کوچک برای نمایش در کنار منو (حداکثر ۲۰۰ کیلوبایت)</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="order" class="form-label">ترتیب نمایش</label>
                                        <input type="number" class="form-control" id="order" name="order" value="<?php echo $menu['order']; ?>" min="0">
                                    </div>
                                    
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" <?php echo $menu['is_active'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_active">فعال</label>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> بروزرسانی
                                        </button>
                                        <a href="?lang=<?php echo $currentLang; ?>" class="btn btn-outline-secondary">انصراف</a>
                                    </div>
                                </form>
                            <?php else: ?>
                                <div class="alert alert-danger">منوی مورد نظر یافت نشد.</div>
                            <?php endif; ?>
                        
                        <?php else: ?>
                            <!-- Menu Tree View -->
                            <div class="menu-tree">
                                <p class="text-muted mb-3">
                                    <i class="fas fa-info-circle me-1"></i>
                                    منوهای سایت را با کشیدن و رها کردن (<i class="fas fa-grip-vertical"></i>) مرتب کنید.
                                </p>
                                
                                <?php echo buildMenuTree($db, $currentLang); ?>
                            </div>
                            
                            <!-- Menu Items Table (Alternative View) -->
                            <div class="card mb-0">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">نمایش جدولی منوها</h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>عنوان</th>
                                                    <th>URL</th>
                                                    <th>والد</th>
                                                    <th>ترتیب</th>
                                                    <th>وضعیت</th>
                                                    <th>عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                // Reset to the beginning
                                                mysqli_data_seek($menuItems, 0);
                                                
                                                if (mysqli_num_rows($menuItems) > 0): 
                                                    while ($item = mysqli_fetch_assoc($menuItems)): 
                                                        $isNewItem = isset($new_item_id) && $item['id'] == $new_item_id;
                                                ?>
                                                    <tr class="<?php echo $isNewItem ? 'item-new' : ''; ?>" id="menu-table-<?php echo $item['id']; ?>">
                                                        <td>
                                                            <?php if (!empty($item['icon_path']) && file_exists($item['icon_path'])): ?>
                                                                <img src="<?php echo htmlspecialchars($item['icon_path']); ?>" class="menu-icon-preview me-1" alt="Icon">
                                                            <?php endif; ?>
                                                            <?php echo htmlspecialchars($item['title']); ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($item['url']); ?></td>
                                                        <td><?php echo $item['parent_id'] ? htmlspecialchars($item['parent_title']) : '<span class="text-muted">-</span>'; ?></td>
                                                        <td><?php echo $item['order']; ?></td>
                                                        <td>
                                                            <?php if ($item['is_active']): ?>
                                                                <span class="badge bg-success">فعال</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary">غیرفعال</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <a href="?action=edit_menu&id=<?php echo $item['id']; ?>&lang=<?php echo $currentLang; ?>" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $item['id']; ?>" data-type="menu">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php 
                                                    endwhile; 
                                                else: 
                                                ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center py-4 text-muted">هیچ منویی یافت نشد.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Social Media Management -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">مدیریت شبکه‌های اجتماعی</h5>
                        <a href="?action=add_social&lang=<?php echo $currentLang; ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> افزودن شبکه اجتماعی
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if ($action === 'add_social'): ?>
                            <!-- Add Social Media Form -->
                            <form method="post" action="">
                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                <input type="hidden" name="action" value="add_social">
                                
                                <div class="mb-3">
                                    <label for="platform" class="form-label">نام پلتفرم</label>
                                    <input type="text" class="form-control" id="platform" name="platform" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="icon_class" class="form-label">کلاس آیکون</label>
                                    <input type="text" class="form-control" id="icon_class" name="icon_class" required>
                                    <div class="form-text">برای سازگاری با نسخه‌های مختلف Font Awesome، از کلاس کامل استفاده کنید. مثال: fab fa-instagram</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="url" class="form-label">آدرس URL</label>
                                    <input type="text" class="form-control" id="url" name="url" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="order" class="form-label">ترتیب نمایش</label>
                                    <input type="number" class="form-control" id="order" name="order" value="0" min="0">
                                </div>
                                
                                <!-- Icon Preview -->
                                <div class="social-icon-preview">
                                    <div class="social-icon-demo">
                                        <i class="fab fa-instagram" id="icon_preview"></i>
                                    </div>
                                    <div>
                                        <strong id="platform_preview">اینستاگرام</strong>
                                        <p class="mb-0 text-muted" id="icon_class_preview">fab fa-instagram</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> ذخیره
                                    </button>
                                    <a href="?lang=<?php echo $currentLang; ?>" class="btn btn-outline-secondary">انصراف</a>
                                </div>
                            </form>
                            
                        <?php elseif ($action === 'edit_social' && isset($_GET['id'])): ?>
                            <!-- Edit Social Media Form -->
                            <?php 
                                $social = getSocialMediaItem($db, $_GET['id']);
                                if ($social):
                            ?>
                                <form method="post" action="">
                                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                    <input type="hidden" name="action" value="edit_social">
                                    <input type="hidden" name="id" value="<?php echo $social['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="platform" class="form-label">نام پلتفرم</label>
                                        <input type="text" class="form-control" id="platform" name="platform" value="<?php echo htmlspecialchars($social['platform']); ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="icon_class" class="form-label">کلاس آیکون</label>
                                        <input type="text" class="form-control" id="icon_class" name="icon_class" value="<?php echo htmlspecialchars($social['icon_class']); ?>" required>
                                        <div class="form-text">برای سازگاری با نسخه‌های مختلف Font Awesome، از کلاس کامل استفاده کنید. مثال: fab fa-instagram</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="url" class="form-label">آدرس URL</label>
                                        <input type="text" class="form-control" id="url" name="url" value="<?php echo htmlspecialchars($social['url']); ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="order" class="form-label">ترتیب نمایش</label>
                                        <input type="number" class="form-control" id="order" name="order" value="<?php echo $social['order']; ?>" min="0">
                                    </div>
                                    
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" <?php echo $social['is_active'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_active">فعال</label>
                                    </div>
                                    
                                    <!-- Icon Preview -->
                                    <div class="social-icon-preview">
                                        <div class="social-icon-demo">
                                            <i class="<?php echo htmlspecialchars($social['icon_class']); ?>" id="icon_preview"></i>
                                        </div>
                                        <div>
                                            <strong id="platform_preview"><?php echo htmlspecialchars($social['platform']); ?></strong>
                                            <p class="mb-0 text-muted" id="icon_class_preview"><?php echo htmlspecialchars($social['icon_class']); ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> بروزرسانی
                                        </button>
                                        <a href="?lang=<?php echo $currentLang; ?>" class="btn btn-outline-secondary">انصراف</a>
                                    </div>
                                </form>
                            <?php else: ?>
                                <div class="alert alert-danger">شبکه اجتماعی مورد نظر یافت نشد.</div>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <!-- Social Media List -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>پلتفرم</th>
                                            <th>آیکون</th>
                                            <th>URL</th>
                                            <th>ترتیب</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        mysqli_data_seek($socialMediaLinks, 0);
                                        if (mysqli_num_rows($socialMediaLinks) > 0): 
                                            while ($item = mysqli_fetch_assoc($socialMediaLinks)): 
                                                $isNewItem = isset($new_item_id) && $item['id'] == $new_item_id;
                                        ?>
                                                <tr class="<?php echo $isNewItem ? 'item-new' : ''; ?>" id="social-item-<?php echo $item['id']; ?>">
                                                    <td><?php echo htmlspecialchars($item['platform']); ?></td>
                                                    <td><i class="<?php echo htmlspecialchars($item['icon_class']); ?>"></i> <?php echo htmlspecialchars($item['icon_class']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['url']); ?></td>
                                                    <td><?php echo $item['order']; ?></td>
                                                    <td>
                                                        <?php if ($item['is_active']): ?>
                                                            <span class="badge bg-success">فعال</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary">غیرفعال</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="?action=edit_social&id=<?php echo $item['id']; ?>&lang=<?php echo $currentLang; ?>" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $item['id']; ?>" data-type="social">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">هیچ شبکه اجتماعی یافت نشد.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Social Media Grid View -->
                            <div class="mt-4">
                                <h6 class="mb-3">پیش‌نمایش آیکون‌ها</h6>
                                <div class="row row-cols-2 row-cols-md-4 g-3">
                                    <?php 
                                    // Reset to the beginning
                                    mysqli_data_seek($socialMediaLinks, 0);
                                    
                                    if (mysqli_num_rows($socialMediaLinks) > 0): 
                                        while ($item = mysqli_fetch_assoc($socialMediaLinks)): 
                                    ?>
                                        <div class="col">
                                            <div class="card h-100 <?php echo $item['is_active'] ? '' : 'opacity-50'; ?>">
                                                <div class="card-body text-center">
                                                    <div class="mb-3">
                                                        <i class="<?php echo htmlspecialchars($item['icon_class']); ?> fa-3x text-primary"></i>
                                                    </div>
                                                    <h6 class="card-title"><?php echo htmlspecialchars($item['platform']); ?></h6>
                                                    <p class="card-text small text-muted"><?php echo htmlspecialchars($item['icon_class']); ?></p>
                                                    <a href="<?php echo htmlspecialchars($item['url']); ?>" class="btn btn-sm btn-outline-primary" target="_blank">مشاهده</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                        endwhile; 
                                    endif; 
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - 1/3 width -->
            <div class="col-lg-4">
                <!-- Contact Information Management -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">اطلاعات تماس</h5>
                        <a href="?action=add_contact&lang=<?php echo $currentLang; ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> افزودن
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if ($action === 'add_contact'): ?>
                            <!-- Add Contact Form -->
                            <form method="post" action="">
                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                <input type="hidden" name="action" value="add_contact">
                                <input type="hidden" name="language_id" value="<?php echo $currentLang; ?>">
                                
                                <div class="mb-3">
                                    <label for="type" class="form-label">نوع</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="email">ایمیل</option>
                                        <option value="phone">تلفن</option>
                                        <option value="address">آدرس</option>
                                        <option value="working_hours">ساعات کاری</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="value" class="form-label">مقدار</label>
                                    <input type="text" class="form-control" id="value" name="value" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="icon_class" class="form-label">کلاس آیکون</label>
                                    <input type="text" class="form-control" id="icon_class" name="icon_class" value="fas fa-envelope" required>
                                    <div class="form-text">مثال: fas fa-envelope برای ایمیل، fas fa-phone برای تلفن</div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> ذخیره
                                    </button>
                                    <a href="?lang=<?php echo $currentLang; ?>" class="btn btn-outline-secondary">انصراف</a>
                                </div>
                            </form>
                            
                        <?php elseif ($action === 'edit_contact' && isset($_GET['id'])): ?>
                            <!-- Edit Contact Form -->
                            <?php 
                                $contact = getContactInfoItem($db, $_GET['id']);
                                if ($contact):
                            ?>
                                <form method="post" action="">
                                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                    <input type="hidden" name="action" value="edit_contact">
                                    <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="type" class="form-label">نوع</label>
                                        <select class="form-select" id="type" name="type">
                                            <option value="email" <?php echo $contact['type'] == 'email' ? 'selected' : ''; ?>>ایمیل</option>
                                            <option value="phone" <?php echo $contact['type'] == 'phone' ? 'selected' : ''; ?>>تلفن</option>
                                            <option value="address" <?php echo $contact['type'] == 'address' ? 'selected' : ''; ?>>آدرس</option>
                                            <option value="working_hours" <?php echo $contact['type'] == 'working_hours' ? 'selected' : ''; ?>>ساعات کاری</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="value" class="form-label">مقدار</label>
                                        <input type="text" class="form-control" id="value" name="value" value="<?php echo htmlspecialchars($contact['value']); ?>" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="icon_class" class="form-label">کلاس آیکون</label>
                                        <input type="text" class="form-control" id="icon_class" name="icon_class" value="<?php echo htmlspecialchars($contact['icon_class']); ?>" required>
                                        <div class="form-text">مثال: fas fa-envelope برای ایمیل، fas fa-phone برای تلفن</div>
                                    </div>
                                    
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" <?php echo $contact['is_active'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_active">فعال</label>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> بروزرسانی
                                        </button>
                                        <a href="?lang=<?php echo $currentLang; ?>" class="btn btn-outline-secondary">انصراف</a>
                                    </div>
                                </form>
                            <?php else: ?>
                                <div class="alert alert-danger">اطلاعات تماس مورد نظر یافت نشد.</div>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <!-- Contact Info Cards View -->
                            <?php
                            mysqli_data_seek($contactInfo, 0);
                            if (mysqli_num_rows($contactInfo) > 0): 
                                while ($item = mysqli_fetch_assoc($contactInfo)): 
                                    $isNewItem = isset($new_item_id) && $item['id'] == $new_item_id;
                            ?>
                                    <div class="contact-card <?php echo $item['is_active'] ? '' : 'opacity-50'; ?> <?php echo $isNewItem ? 'item-new scroll-target' : ''; ?>" id="contact-item-<?php echo $item['id']; ?>">
                                        <div class="contact-icon">
                                            <i class="<?php echo htmlspecialchars($item['icon_class']); ?>"></i>
                                        </div>
                                        <div class="contact-info">
                                            <div class="contact-type"><?php 
                                                switch($item['type']) {
                                                    case 'email': echo 'ایمیل'; break;
                                                    case 'phone': echo 'تلفن'; break;
                                                    case 'address': echo 'آدرس'; break;
                                                    case 'working_hours': echo 'ساعات کاری'; break;
                                                    default: echo htmlspecialchars($item['type']);
                                                }
                                            ?></div>
                                            <div class="contact-value"><?php echo htmlspecialchars($item['value']); ?></div>
                                        </div>
                                        <div class="contact-actions">
                                            <a href="?action=edit_contact&id=<?php echo $item['id']; ?>&lang=<?php echo $currentLang; ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $item['id']; ?>" data-type="contact">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-info-circle mb-2 fa-2x"></i>
                                    <p>هیچ اطلاعات تماسی یافت نشد.</p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Site Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">تنظیمات سایت</h5>
                    </div>
                    <div class="card-body">
                        <?php 
                        mysqli_data_seek($siteSettings, 0);
                        if (mysqli_num_rows($siteSettings) > 0): 
                            while ($setting = mysqli_fetch_assoc($siteSettings)): 
                        ?>
                                <div class="setting-item">
                                    <div class="setting-key"><?php echo htmlspecialchars($setting['key']); ?></div>
                                    <div class="setting-value">
                                        <form method="post" action="" class="d-flex setting-form">
                                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                            <input type="hidden" name="action" value="edit_setting">
                                            <input type="hidden" name="key" value="<?php echo htmlspecialchars($setting['key']); ?>">
                                            <input type="text" name="value" value="<?php echo htmlspecialchars($setting['value']); ?>" class="form-control form-control-sm setting-input">
                                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2 save-setting-btn">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle mb-2 fa-2x"></i>
                                <p>هیچ تنظیماتی یافت نشد.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Help Card -->
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-question-circle me-2 text-primary"></i>
                            راهنمای مدیریت منو
                        </h5>
                        <div class="card-text">
                            <p>از این قسمت می‌توانید منوهای سایت، شبکه‌های اجتماعی و اطلاعات تماس را مدیریت کنید.</p>
                            
                            <h6 class="mt-3 mb-2">امکانات اصلی:</h6>
                            <ul class="mb-0">
                                <li>افزودن، ویرایش و حذف آیتم‌های منو</li>
                                <li>مرتب‌سازی منوها با کشیدن و رها کردن</li>
                                <li>ایجاد منوهای چند سطحی (منو و زیرمنو)</li>
                                <li>مدیریت آیکون‌های شبکه‌های اجتماعی</li>
                                <li>مدیریت اطلاعات تماس در هر زبان</li>
                                <li>آپلود و مدیریت تصاویر آیکون برای منوها</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأیید حذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف این مورد اطمینان دارید؟</p>
                    <p class="text-danger mb-0"><strong>توجه:</strong> این عملیات قابل بازگشت نیست.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">انصراف</button>
                    <form method="post" action="" id="deleteForm">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="hidden" name="action" id="deleteAction" value="">
                        <input type="hidden" name="id" id="deleteId" value="">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-1">© <?php echo date('Y'); ?> مجتمع آموزشی سلمان فارسی</p>
            <p class="mb-0 text-white-50">تمامی حقوق محفوظ است.</p>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // اسکرول به آیتم جدید
        document.addEventListener('DOMContentLoaded', function() {
            // اسکرول به آیتم جدید
            if (window.location.hash === '#item-added' || window.location.hash === '#item-updated' || 
                window.location.hash === '#social-added' || window.location.hash === '#contact-added' || 
                window.location.hash === '#social-updated' || window.location.hash === '#contact-updated') {
                const newItem = document.querySelector('.item-new');
                if (newItem) {
                    newItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // حذف کلاس بعد از مدتی
                    setTimeout(function() {
                        newItem.classList.remove('item-new');
                    }, 3000);
                }
                
                // حذف هش از URL بعد از اسکرول
                setTimeout(function() {
                    history.replaceState(null, document.title, window.location.pathname + window.location.search);
                }, 1000);
            }
            
            // Delete modal setup
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const type = button.getAttribute('data-type');
                    
                    document.getElementById('deleteId').value = id;
                    document.getElementById('deleteAction').value = 'delete_' + type;
                });
            }
            
            // Icon preview for social media forms
            const iconClass = document.getElementById('icon_class');
            const platform = document.getElementById('platform');
            const iconPreview = document.getElementById('icon_preview');
            const platformPreview = document.getElementById('platform_preview');
            const iconClassPreview = document.getElementById('icon_class_preview');
            
            if (iconClass && iconPreview) {
                iconClass.addEventListener('input', function() {
                    // Update icon preview
                    iconPreview.className = this.value;
                    iconClassPreview.textContent = this.value;
                });
            }
            
            if (platform && platformPreview) {
                platform.addEventListener('input', function() {
                    // Update platform name preview
                    platformPreview.textContent = this.value;
                });
            }
            
            // Initialize Sortable for menu tree
            const menuLists = document.querySelectorAll('.menu-tree-list');
            const menuSortables = [];
            
            menuLists.forEach(function(list) {
                menuSortables.push(new Sortable(list, {
                    group: 'nested',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    handle: '.menu-tree-handle',
                    onEnd: function() {
                        updateMenuOrder();
                    }
                }));
            });
            
            function updateMenuOrder() {
                // Collect all menu items with their new order and parent
                const items = [];
                const topLevelItems = document.querySelectorAll('.menu-tree > .menu-tree-list > .menu-tree-item');
                
                let order = 0;
                topLevelItems.forEach(function(item) {
                    const id = item.getAttribute('data-id');
                    items.push({
                        id: id,
                        order: order++,
                        parent_id: ''
                    });
                    
                    // Process children
                    processChildren(item, id, items);
                });
                
                // Send updated order to server via fetch
                fetch('?action=reorder_menu&lang=<?php echo $currentLang; ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=reorder_menu&items=' + encodeURIComponent(JSON.stringify(items))
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show a temporary floating success message
                        showFloatAlert(data.message || "ترتیب منوها با موفقیت بروزرسانی شد.");
                    } else {
                        showFloatAlert(data.message || "خطا در بروزرسانی ترتیب منوها.", "danger");
                    }
                })
                .catch(error => {
                    console.error('Error updating menu order:', error);
                    showFloatAlert("خطا در برقراری ارتباط با سرور.", "danger");
                });
            }
            
            function processChildren(parentItem, parentId, items) {
                const childList = parentItem.querySelector(':scope > .menu-tree-list');
                if (!childList) return;
                
                let childOrder = 0;
                const children = childList.querySelectorAll(':scope > .menu-tree-item');
                
                children.forEach(function(child) {
                    const id = child.getAttribute('data-id');
                    items.push({
                        id: id,
                        order: childOrder++,
                        parent_id: parentId
                    });
                    
                    // Process grandchildren
                    processChildren(child, id, items);
                });
            }
            
            // AJAX for site settings
            document.querySelectorAll('.setting-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    
                    fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        showFloatAlert("تنظیمات با موفقیت ذخیره شد.");
                    })
                    .catch(error => {
                        showFloatAlert("خطا در ذخیره تنظیمات.", "danger");
                    });
                });
            });
            
            // نمایش اعلان شناور
            function showFloatAlert(message, type = 'success') {
                // حذف اعلان‌های قبلی
                document.querySelectorAll('.alert-float').forEach(alert => {
                    alert.remove();
                });
                
                // ایجاد اعلان جدید
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show alert-float`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                document.body.appendChild(alertDiv);
                
                // حذف خودکار بعد از 5 ثانیه
                setTimeout(function() {
                    alertDiv.style.opacity = '0';
                    setTimeout(() => alertDiv.remove(), 300);
                }, 5000);
            }
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert-dismissible:not(.alert-float)').forEach(alert => {
                    const closeBtn = alert.querySelector('.btn-close');
                    if (closeBtn) closeBtn.click();
                });
            }, 5000);
        });
    </script>
</body>
</html>