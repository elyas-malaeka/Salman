<?php
/**
 * Footer Admin Panel - Salman Educational Complex
 * This file allows administrators to manage footer content across all languages
 * 
 * @package Salman Educational Complex
 * @version 2.0
 * @updated 2025-03-29
 */

// Include database connection
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

// Set default language for editing
$current_lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
$current_section = isset($_GET['section']) ? $_GET['section'] : 'static';

// Check for error messages in session
$error_message = null;
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

// Check for new item notifications
$new_item_id = isset($_GET['new_item']) ? (int)$_GET['new_item'] : null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error_message'] = "خطای امنیتی: درخواست نامعتبر است.";
        header("Location: ?section={$current_section}&lang={$current_lang}");
        exit;
    }

    if (isset($_POST['update_static'])) {
        // Update static content
        foreach ($_POST['content'] as $field_key => $content) {
            $field_key = mysqli_real_escape_string($db, $field_key);
            $content = mysqli_real_escape_string($db, sanitizeInput($content));
            $lang = mysqli_real_escape_string($db, $current_lang);
            
            // Check if record exists
            $query = "SELECT id FROM footer_content WHERE field_key = '{$field_key}' AND language_id = '{$lang}'";
            $result = mysqli_query($db, $query);
            
            if (mysqli_num_rows($result) > 0) {
                // Update existing record
                $query = "UPDATE footer_content SET content = '{$content}', updated_at = NOW() 
                         WHERE field_key = '{$field_key}' AND language_id = '{$lang}'";
            } else {
                // Insert new record
                $query = "INSERT INTO footer_content (field_key, content, language_id, is_repeatable, section_id) 
                         VALUES ('{$field_key}', '{$content}', '{$lang}', 0, 'static')";
            }
            
            mysqli_query($db, $query);
        }
        
        $success_message = "محتوای ثابت با موفقیت بروزرسانی شد.";
    } 
    elseif (isset($_POST['update_links'])) {
        // Get section ID
        $section_id = mysqli_real_escape_string($db, $_POST['section_id']);
        
        // First, delete all existing links for this section and language
        $lang = mysqli_real_escape_string($db, $current_lang);
        $query = "DELETE FROM footer_content WHERE section_id = '{$section_id}' AND language_id = '{$lang}' AND is_repeatable = 1";
        mysqli_query($db, $query);
        
        // Then insert new links
        if (isset($_POST['link_titles']) && isset($_POST['link_urls'])) {
            foreach ($_POST['link_titles'] as $index => $title) {
                if (empty($title) || empty($_POST['link_urls'][$index])) continue;
                
                $title = mysqli_real_escape_string($db, sanitizeInput($title));
                $url = mysqli_real_escape_string($db, sanitizeInput($_POST['link_urls'][$index]));
                $sort_order = $index + 1;
                
                // Create JSON content
                $content = json_encode(['title' => $title, 'url' => $url]);
                $content = mysqli_real_escape_string($db, $content);
                
                $field_key = $section_id . '_link_' . $sort_order;
                
                $query = "INSERT INTO footer_content (field_key, content, language_id, is_repeatable, section_id, sort_order) 
                         VALUES ('{$field_key}', '{$content}', '{$lang}', 1, '{$section_id}', {$sort_order})";
                
                $result = mysqli_query($db, $query);
                
                // Save the ID of the newly added item
                if ($index === 0 && $result) {
                    $new_item_id = mysqli_insert_id($db);
                }
            }
        }
        
        // Redirect to show success message and scroll to new item
        header("Location: ?section={$section_id}&lang={$current_lang}&new_item={$new_item_id}#item-added");
        exit;
    }
    elseif (isset($_POST['update_social'])) {
        // First, delete all existing social links for this language
        $lang = mysqli_real_escape_string($db, $current_lang);
        $query = "DELETE FROM footer_content WHERE section_id = 'social_links' AND language_id = '{$lang}' AND is_repeatable = 1";
        mysqli_query($db, $query);
        
        // Then insert new social links
        if (isset($_POST['social_names']) && isset($_POST['social_icons']) && isset($_POST['social_urls'])) {
            foreach ($_POST['social_names'] as $index => $name) {
                if (empty($name) || empty($_POST['social_icons'][$index]) || empty($_POST['social_urls'][$index])) continue;
                
                $name = mysqli_real_escape_string($db, sanitizeInput($name));
                $icon = mysqli_real_escape_string($db, sanitizeInput($_POST['social_icons'][$index]));
                $url = mysqli_real_escape_string($db, sanitizeInput($_POST['social_urls'][$index]));
                $sort_order = $index + 1;
                
                // Create JSON content
                $content = json_encode(['name' => $name, 'icon' => $icon, 'url' => $url]);
                $content = mysqli_real_escape_string($db, $content);
                
                $field_key = 'social_link_' . $sort_order;
                
                $query = "INSERT INTO footer_content (field_key, content, language_id, is_repeatable, section_id, sort_order) 
                         VALUES ('{$field_key}', '{$content}', '{$lang}', 1, 'social_links', {$sort_order})";
                
                $result = mysqli_query($db, $query);
                
                // Save the ID of the newly added item
                if ($index === 0 && $result) {
                    $new_item_id = mysqli_insert_id($db);
                }
            }
        }
        
        // Redirect to show success message and scroll to new item
        header("Location: ?section=social&lang={$current_lang}&new_item={$new_item_id}#item-added");
        exit;
    }
    elseif (isset($_POST['update_instagram'])) {
        // First, delete all existing Instagram posts
        $query = "DELETE FROM footer_content WHERE section_id = 'instagram_posts' AND is_repeatable = 1";
        mysqli_query($db, $query);
        
        // Then insert new Instagram posts
        if (isset($_POST['instagram_links'])) {
            foreach ($_POST['instagram_links'] as $index => $link) {
                if (empty($link)) continue;
                
                $link = mysqli_real_escape_string($db, sanitizeInput($link));
                $sort_order = $index + 1;
                
                // Handle image upload or URL
                $image_path = '';
                $upload_error = '';
                
                // Check if a file was uploaded
                if (isset($_FILES['instagram_image_file']['name'][$index]) && !empty($_FILES['instagram_image_file']['name'][$index])) {
                    $file = [
                        'name' => $_FILES['instagram_image_file']['name'][$index],
                        'type' => $_FILES['instagram_image_file']['type'][$index],
                        'tmp_name' => $_FILES['instagram_image_file']['tmp_name'][$index],
                        'error' => $_FILES['instagram_image_file']['error'][$index],
                        'size' => $_FILES['instagram_image_file']['size'][$index]
                    ];
                    
                    $upload_result = uploadImage($file, '../uploads/instagram/');
                    
                    if ($upload_result['status']) {
                        $image_path = $upload_result['file_path'];
                    } else {
                        $upload_error = $upload_result['message'];
                    }
                } 
                // If no file was uploaded or upload failed, check for URL
                elseif (isset($_POST['instagram_images'][$index]) && !empty($_POST['instagram_images'][$index])) {
                    $image_path = mysqli_real_escape_string($db, sanitizeInput($_POST['instagram_images'][$index]));
                }
                
                if (empty($image_path)) {
                    if (!empty($upload_error)) {
                        $_SESSION['error_message'] = "خطا در آپلود تصویر آیتم " . ($index + 1) . ": " . $upload_error;
                    }
                    continue; // Skip if no image
                }
                
                // Create JSON content
                $content = json_encode(['image' => $image_path, 'link' => $link]);
                $content = mysqli_real_escape_string($db, $content);
                
                $field_key = 'instagram_post_' . $sort_order;
                
                $query = "INSERT INTO footer_content (field_key, content, language_id, is_repeatable, section_id, sort_order) 
                         VALUES ('{$field_key}', '{$content}', 'fa', 1, 'instagram_posts', {$sort_order})";
                
                $result = mysqli_query($db, $query);
                
                // Save the ID of the newly added item
                if ($index === 0 && $result) {
                    $new_item_id = mysqli_insert_id($db);
                }
            }
        }
        
        // Redirect to show success message and scroll to new item
        header("Location: ?section=instagram&lang={$current_lang}&new_item={$new_item_id}#item-added");
        exit;
    }
}

// Function to get static content field
function getStaticContent($field_key, $lang) {
    global $db;
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT content FROM footer_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    
    return "";
}

// Function to get link items
function getLinkItems($section_id, $lang) {
    global $db;
    
    $section_id = mysqli_real_escape_string($db, $section_id);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT id, content FROM footer_content 
              WHERE section_id = '{$section_id}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content = json_decode($row['content'], true);
            $content['id'] = $row['id']; // Add ID for highlighting new items
            $items[] = $content;
        }
    }
    
    return $items;
}

// Get social media links
function getSocialLinks($lang) {
    global $db;
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT id, content FROM footer_content 
              WHERE section_id = 'social_links' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $links = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $link = json_decode($row['content'], true);
            $link['id'] = $row['id']; // Add ID for highlighting new items
            $links[] = $link;
        }
    }
    
    return $links;
}

// Get Instagram posts
function getInstagramPosts() {
    global $db;
    
    $query = "SELECT id, content FROM footer_content 
              WHERE section_id = 'instagram_posts' 
              AND is_repeatable = 1 
              ORDER BY sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $posts = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $post = json_decode($row['content'], true);
            $post['id'] = $row['id']; // Add ID for highlighting new items
            $posts[] = $post;
        }
    }
    
    return $posts;
}

// Load data for the current view
$quickLinks = getLinkItems('quick_links', $current_lang);
$curriculumLinks = getLinkItems('curriculum_links', $current_lang);
$socialLinks = getSocialLinks($current_lang);
$instagramPosts = getInstagramPosts();

// Generate CSRF token
$csrf_token = generateCSRFToken();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت فوتر - مجتمع آموزشی سلمان</title>
    
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url('../assets/fonts/Vazir.eot');
            src: url('../assets/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                 url('../assets/fonts/Vazir.woff2') format('woff2'),
                 url('../assets/fonts/Vazir.woff') format('woff'),
                 url('../assets/fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        body {
            font-family: 'Vazir', Tahoma, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, #6941C6, #4E36B1);
            color: white;
            padding: 15px 0;
            margin-bottom: 30px;
        }
        
        .sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            position: sticky;
            top: 20px;
        }
        
        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .nav-pills .nav-link {
            color: #333;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .nav-pills .nav-link:hover {
            background-color: rgba(127, 86, 217, 0.1);
        }
        
        .nav-pills .nav-link.active {
            background-color: #6941C6;
            color: white;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-control:focus {
            border-color: #7F56D9;
            box-shadow: 0 0 0 0.25rem rgba(127, 86, 217, 0.25);
        }
        
        .btn-primary {
            background-color: #6941C6;
            border-color: #6941C6;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #5729b3;
            border-color: #5729b3;
        }
        
        .btn-secondary {
            background-color: #9E77ED;
            border-color: #9E77ED;
        }
        
        .btn-secondary:hover, .btn-secondary:focus {
            background-color: #8a62e8;
            border-color: #8a62e8;
        }
        
        .btn-outline-primary {
            color: #6941C6;
            border-color: #6941C6;
        }
        
        .btn-outline-primary:hover {
            background-color: #6941C6;
            border-color: #6941C6;
        }
        
        .alert-success {
            background-color: rgba(22, 163, 74, 0.1);
            border-color: rgba(22, 163, 74, 0.3);
            color: #16a34a;
        }
        
        .alert-danger {
            background-color: rgba(220, 38, 38, 0.1);
            border-color: rgba(220, 38, 38, 0.3);
            color: #dc2626;
        }
        
        .card {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: rgba(127, 86, 217, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            font-weight: 600;
        }
        
        .language-selector {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .language-btn {
            margin-right: 10px;
        }
        
        .item-row {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
        }
        
        .item-controls {
            margin-top: 10px;
        }
        
        .preview-image {
            max-width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
            margin-top: 10px;
        }
        
        /* Add your custom styles here */
        .item-new {
            animation: highlight-new-item 2s ease-out;
        }
        
        @keyframes highlight-new-item {
            0% { background-color: rgba(105, 65, 198, 0.2); }
            100% { background-color: #f8f9fa; }
        }
        
        .custom-file-upload {
            position: relative;
            width: 100%;
        }
        
        .scroll-target {
            scroll-margin-top: 80px;
        }
        
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
        
        @media (max-width: 767.98px) {
            .sidebar {
                position: static;
                margin-bottom: 20px;
            }
            
            .item-row {
                padding: 10px;
            }
            
            .btn {
                padding: 0.375rem 0.75rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">مدیریت فوتر سایت</h1>
                <a href="../admin/index.php" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-right ml-1"></i> بازگشت به پنل مدیریت
                </a>
            </div>
        </div>
    </header>

    <main class="container pb-5">
        <!-- Language Selector -->
        <div class="language-selector d-flex justify-content-between align-items-center">
            <div>
                <a href="?lang=fa&section=<?php echo $current_section; ?>" class="btn <?php echo $current_lang == 'fa' ? 'btn-primary' : 'btn-outline-primary'; ?> language-btn">فارسی</a>
                <a href="?lang=en&section=<?php echo $current_section; ?>" class="btn <?php echo $current_lang == 'en' ? 'btn-primary' : 'btn-outline-primary'; ?> language-btn">English</a>
                <a href="?lang=ar&section=<?php echo $current_section; ?>" class="btn <?php echo $current_lang == 'ar' ? 'btn-primary' : 'btn-outline-primary'; ?> language-btn">العربية</a>
            </div>
            <div>
                <span class="badge bg-info">زبان فعلی: 
                    <?php 
                    if ($current_lang == 'fa') echo 'فارسی';
                    elseif ($current_lang == 'en') echo 'انگلیسی';
                    else echo 'عربی';
                    ?>
                </span>
            </div>
        </div>
        
        <?php if (isset($success_message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-md-3 mb-4">
                <div class="sidebar">
                    <h5 class="mb-3">بخش‌های فوتر</h5>
                    <div class="nav flex-column nav-pills">
                        <a class="nav-link <?php echo $current_section == 'static' ? 'active' : ''; ?>" href="?lang=<?php echo $current_lang; ?>&section=static">
                            <i class="fas fa-align-left me-2"></i> محتوای ثابت
                        </a>
                        <a class="nav-link <?php echo $current_section == 'quick_links' ? 'active' : ''; ?>" href="?lang=<?php echo $current_lang; ?>&section=quick_links">
                            <i class="fas fa-link me-2"></i> لینک‌های سریع
                        </a>
                        <a class="nav-link <?php echo $current_section == 'curriculum_links' ? 'active' : ''; ?>" href="?lang=<?php echo $current_lang; ?>&section=curriculum_links">
                            <i class="fas fa-book me-2"></i> بخش‌های برنامه درسی
                        </a>
                        <a class="nav-link <?php echo $current_section == 'social' ? 'active' : ''; ?>" href="?lang=<?php echo $current_lang; ?>&section=social">
                            <i class="fas fa-share-alt me-2"></i> شبکه‌های اجتماعی
                        </a>
                        <a class="nav-link <?php echo $current_section == 'instagram' ? 'active' : ''; ?>" href="?lang=<?php echo $current_lang; ?>&section=instagram">
                            <i class="fab fa-instagram me-2"></i> پست‌های اینستاگرام
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="col-md-9">
                <div class="content">
                    <?php if ($current_section == 'static'): ?>
                    <!-- Static Content Form -->
                    <h2 class="mb-4">ویرایش محتوای ثابت فوتر</h2>
                    <form method="post" action="">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="school_description" class="form-label">توضیحات مدرسه:</label>
                                <textarea name="content[school_description]" id="school_description" class="form-control" rows="3"><?php echo getStaticContent('school_description', $current_lang); ?></textarea>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="copyright_text" class="form-label">متن کپی‌رایت:</label>
                                <input type="text" name="content[copyright_text]" id="copyright_text" class="form-control" value="<?php echo getStaticContent('copyright_text', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="subscribe_button" class="form-label">متن دکمه اشتراک:</label>
                                <input type="text" name="content[subscribe_button]" id="subscribe_button" class="form-control" value="<?php echo getStaticContent('subscribe_button', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email_placeholder" class="form-label">متن پیش‌فرض ایمیل:</label>
                                <input type="text" name="content[email_placeholder]" id="email_placeholder" class="form-control" value="<?php echo getStaticContent('email_placeholder', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="quick_links_title" class="form-label">عنوان لینک‌های سریع:</label>
                                <input type="text" name="content[quick_links_title]" id="quick_links_title" class="form-control" value="<?php echo getStaticContent('quick_links_title', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="curriculum_title" class="form-label">عنوان برنامه درسی:</label>
                                <input type="text" name="content[curriculum_title]" id="curriculum_title" class="form-control" value="<?php echo getStaticContent('curriculum_title', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="instagram_title" class="form-label">عنوان بخش اینستاگرام:</label>
                                <input type="text" name="content[instagram_title]" id="instagram_title" class="form-control" value="<?php echo getStaticContent('instagram_title', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="back_to_top" class="form-label">متن دکمه بازگشت به بالا:</label>
                                <input type="text" name="content[back_to_top]" id="back_to_top" class="form-control" value="<?php echo getStaticContent('back_to_top', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="close_button" class="form-label">متن دکمه بستن:</label>
                                <input type="text" name="content[close_button]" id="close_button" class="form-control" value="<?php echo getStaticContent('close_button', $current_lang); ?>">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="site_name" class="form-label">نام سایت:</label>
                                <input type="text" name="content[site_name]" id="site_name" class="form-control" value="<?php echo getStaticContent('site_name', $current_lang); ?>">
                            </div>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" name="update_static" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> ذخیره تغییرات
                            </button>
                        </div>
                    </form>
                    
                    <?php elseif ($current_section == 'quick_links' || $current_section == 'curriculum_links'): ?>
                    <!-- Links Form -->
                    <h2 class="mb-4">
                        <?php echo $current_section == 'quick_links' ? 'ویرایش لینک‌های سریع' : 'ویرایش لینک‌های برنامه درسی'; ?>
                    </h2>
                    
                    <form method="post" action="" id="linksForm">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="hidden" name="section_id" value="<?php echo $current_section; ?>">
                        
                        <div id="linksContainer">
                            <?php
                            $links = $current_section == 'quick_links' ? $quickLinks : $curriculumLinks;
                            
                            if (count($links) > 0) {
                                foreach ($links as $index => $link) {
                                    $isNewItem = isset($new_item_id) && isset($link['id']) && $link['id'] == $new_item_id;
                                    ?>
                                    <div class="item-row <?php echo $isNewItem ? 'item-new scroll-target' : ''; ?>" id="link-item-<?php echo $link['id'] ?? $index; ?>">
                                        <div class="row">
                                            <div class="col-md-5 mb-2">
                                                <label class="form-label">عنوان لینک:</label>
                                                <input type="text" name="link_titles[]" class="form-control" value="<?php echo htmlspecialchars($link['title'] ?? ''); ?>" required>
                                            </div>
                                            <div class="col-md-5 mb-2">
                                                <label class="form-label">آدرس لینک:</label>
                                                <input type="text" name="link_urls[]" class="form-control" value="<?php echo htmlspecialchars($link['url'] ?? ''); ?>" required>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end mb-2">
                                                <button type="button" class="btn btn-danger remove-link w-100">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="item-row">
                                    <div class="row">
                                        <div class="col-md-5 mb-2">
                                            <label class="form-label">عنوان لینک:</label>
                                            <input type="text" name="link_titles[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-5 mb-2">
                                            <label class="form-label">آدرس لینک:</label>
                                            <input type="text" name="link_urls[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end mb-2">
                                            <button type="button" class="btn btn-danger remove-link w-100">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" id="addLinkBtn">
                                <i class="fas fa-plus"></i> افزودن لینک جدید
                            </button>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" name="update_links" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> ذخیره تغییرات
                            </button>
                        </div>
                    </form>
                    
                    <?php elseif ($current_section == 'social'): ?>
                    <!-- Social Links Form -->
                    <h2 class="mb-4">ویرایش شبکه‌های اجتماعی</h2>
                    
                    <form method="post" action="" id="socialForm">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <div id="socialContainer">
                            <?php
                            if (count($socialLinks) > 0) {
                                foreach ($socialLinks as $index => $social) {
                                    $isNewItem = isset($new_item_id) && isset($social['id']) && $social['id'] == $new_item_id;
                                    ?>
                                    <div class="item-row <?php echo $isNewItem ? 'item-new scroll-target' : ''; ?>" id="social-item-<?php echo $social['id'] ?? $index; ?>">
                                        <div class="row">
                                        <div class="col-md-3 mb-2">
                                                <label class="form-label">نام شبکه اجتماعی:</label>
                                                <input type="text" name="social_names[]" class="form-control social-name-input" value="<?php echo htmlspecialchars($social['name'] ?? ''); ?>" required>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label">آیکون (Font Awesome):</label>
                                                <input type="text" name="social_icons[]" class="form-control social-icon-input" value="<?php echo htmlspecialchars($social['icon'] ?? ''); ?>" required>
                                                <small class="form-text text-muted">مثال: instagram, youtube, whatsapp</small>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">آدرس:</label>
                                                <input type="url" name="social_urls[]" class="form-control" value="<?php echo htmlspecialchars($social['url'] ?? ''); ?>" required>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end mb-2">
                                                <button type="button" class="btn btn-danger remove-social w-100">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </div>
                                        </div>
                                        <div class="preview mt-2">
                                            <i class="fab fa-<?php echo htmlspecialchars($social['icon'] ?? ''); ?> fa-2x preview-icon"></i>
                                            <span class="ms-2"><?php echo htmlspecialchars($social['name'] ?? ''); ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="item-row">
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">نام شبکه اجتماعی:</label>
                                            <input type="text" name="social_names[]" class="form-control social-name-input" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">آیکون (Font Awesome):</label>
                                            <input type="text" name="social_icons[]" class="form-control social-icon-input" required>
                                            <small class="form-text text-muted">مثال: instagram, youtube, whatsapp</small>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">آدرس:</label>
                                            <input type="url" name="social_urls[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end mb-2">
                                            <button type="button" class="btn btn-danger remove-social w-100">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </div>
                                    </div>
                                    <div class="preview mt-2">
                                        <i class="fas fa-question-circle fa-2x preview-icon"></i>
                                        <span class="ms-2 preview-name">پیش‌نمایش</span>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" id="addSocialBtn">
                                <i class="fas fa-plus"></i> افزودن شبکه اجتماعی جدید
                            </button>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" name="update_social" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> ذخیره تغییرات
                            </button>
                        </div>
                    </form>
                    
                    <?php elseif ($current_section == 'instagram'): ?>
                    <!-- Instagram Posts Form -->
                    <h2 class="mb-4">ویرایش پست‌های اینستاگرام</h2>
                    <p class="text-muted mb-4">
                        <i class="fas fa-info-circle me-1"></i> پست‌های اینستاگرام برای همه زبان‌ها یکسان نمایش داده می‌شوند.
                    </p>
                    
                    <form method="post" action="" id="instagramForm" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <div id="instagramContainer">
                            <?php
                            if (count($instagramPosts) > 0) {
                                foreach ($instagramPosts as $index => $post) {
                                    $isNewItem = isset($new_item_id) && isset($post['id']) && $post['id'] == $new_item_id;
                                    ?>
                                    <div class="item-row <?php echo $isNewItem ? 'item-new scroll-target' : ''; ?>" id="instagram-item-<?php echo $post['id'] ?? $index; ?>">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label">تصویر پست:</label>
                                                <div class="custom-file-upload">
                                                    <input type="file" name="instagram_image_file[]" class="form-control instagram-image-file mb-2" accept="image/*">
                                                    <div class="text-center text-muted my-2">یا</div>
                                                    <input type="text" name="instagram_images[]" class="form-control instagram-image-input" 
                                                           value="<?php echo htmlspecialchars($post['image'] ?? ''); ?>" 
                                                           placeholder="آدرس URL تصویر (اختیاری)">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">لینک پست:</label>
                                                <input type="url" name="instagram_links[]" class="form-control" value="<?php echo htmlspecialchars($post['link'] ?? ''); ?>" required>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end mb-2">
                                                <button type="button" class="btn btn-danger remove-instagram w-100">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-2 image-preview-container">
                                            <?php if (!empty($post['image'])): ?>
                                                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Instagram Preview" class="preview-image">
                                            <?php else: ?>
                                                <div class="text-center p-4 bg-light rounded">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                    <p class="mt-2 text-muted">پیش‌نمایش تصویر</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="item-row">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">تصویر پست:</label>
                                            <div class="custom-file-upload">
                                                <input type="file" name="instagram_image_file[]" class="form-control instagram-image-file mb-2" accept="image/*">
                                                <div class="text-center text-muted my-2">یا</div>
                                                <input type="text" name="instagram_images[]" class="form-control instagram-image-input" 
                                                       placeholder="آدرس URL تصویر (اختیاری)">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">لینک پست:</label>
                                            <input type="url" name="instagram_links[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end mb-2">
                                            <button type="button" class="btn btn-danger remove-instagram w-100">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-2 image-preview-container">
                                        <div class="text-center p-4 bg-light rounded">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                            <p class="mt-2 text-muted">پیش‌نمایش تصویر</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" id="addInstagramBtn">
                                <i class="fas fa-plus"></i> افزودن پست جدید
                            </button>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="submit" name="update_instagram" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> ذخیره تغییرات
                            </button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">© <?php echo date('Y'); ?> مجتمع آموزشی سلمان. تمامی حقوق محفوظ است.</p>
        </div>
    </footer>

    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // اسکرول به آیتم جدید
            if (window.location.hash === '#item-added') {
                const newItem = $('.item-new');
                if (newItem.length) {
                    $('html, body').animate({
                        scrollTop: newItem.offset().top - 80
                    }, 500);
                }
                
                // حذف هش از URL بعد از اسکرول
                setTimeout(function() {
                    history.replaceState(null, document.title, window.location.pathname + window.location.search);
                }, 1000);
            }
            
            // Add Link Row
            $('#addLinkBtn').click(function() {
                const newRow = `
                    <div class="item-row">
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <label class="form-label">عنوان لینک:</label>
                                <input type="text" name="link_titles[]" class="form-control" required>
                            </div>
                            <div class="col-md-5 mb-2">
                                <label class="form-label">آدرس لینک:</label>
                                <input type="text" name="link_urls[]" class="form-control" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-danger remove-link w-100">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                $('#linksContainer').prepend(newRow);
                
                // اسکرول به آیتم جدید
                $('html, body').animate({
                    scrollTop: $('#linksContainer .item-row:first').offset().top - 80
                }, 300);
            });
            
            // Remove Link Row
            $(document).on('click', '.remove-link', function() {
                if ($('#linksContainer .item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                } else {
                    showFloatAlert('حداقل یک لینک باید وجود داشته باشد.', 'danger');
                }
            });
            
            // Add Social Media Row
            $('#addSocialBtn').click(function() {
                const newRow = `
                    <div class="item-row">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label class="form-label">نام شبکه اجتماعی:</label>
                                <input type="text" name="social_names[]" class="form-control social-name-input" required>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">آیکون (Font Awesome):</label>
                                <input type="text" name="social_icons[]" class="form-control social-icon-input" required>
                                <small class="form-text text-muted">مثال: instagram, youtube, whatsapp</small>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">آدرس:</label>
                                <input type="url" name="social_urls[]" class="form-control" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-danger remove-social w-100">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </div>
                        </div>
                        <div class="preview mt-2">
                            <i class="fas fa-question-circle fa-2x preview-icon"></i>
                            <span class="ms-2 preview-name">پیش‌نمایش</span>
                        </div>
                    </div>
                `;
                $('#socialContainer').prepend(newRow);
                
                // اسکرول به آیتم جدید
                $('html, body').animate({
                    scrollTop: $('#socialContainer .item-row:first').offset().top - 80
                }, 300);
            });
            
            // Remove Social Media Row
            $(document).on('click', '.remove-social', function() {
                if ($('#socialContainer .item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                } else {
                    showFloatAlert('حداقل یک شبکه اجتماعی باید وجود داشته باشد.', 'danger');
                }
            });
            
            // Add Instagram Post Row
            $('#addInstagramBtn').click(function() {
                const newRow = `
                    <div class="item-row">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">تصویر پست:</label>
                                <div class="custom-file-upload">
                                    <input type="file" name="instagram_image_file[]" class="form-control instagram-image-file mb-2" accept="image/*">
                                    <div class="text-center text-muted my-2">یا</div>
                                    <input type="text" name="instagram_images[]" class="form-control instagram-image-input" 
                                           placeholder="آدرس URL تصویر (اختیاری)">
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">لینک پست:</label>
                                <input type="url" name="instagram_links[]" class="form-control" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-danger remove-instagram w-100">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 image-preview-container">
                            <div class="text-center p-4 bg-light rounded">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="mt-2 text-muted">پیش‌نمایش تصویر</p>
                            </div>
                        </div>
                    </div>
                `;
                $('#instagramContainer').prepend(newRow);
                
                // اسکرول به آیتم جدید
                $('html, body').animate({
                    scrollTop: $('#instagramContainer .item-row:first').offset().top - 80
                }, 300);
            });
            
            // Remove Instagram Post Row
            $(document).on('click', '.remove-instagram', function() {
                if ($('#instagramContainer .item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                } else {
                    showFloatAlert('حداقل یک پست اینستاگرام باید وجود داشته باشد.', 'danger');
                }
            });
            
            // Live preview for social icons
            $(document).on('input', '.social-icon-input, .social-name-input', function() {
                const row = $(this).closest('.item-row');
                const icon = row.find('.social-icon-input').val();
                const name = row.find('.social-name-input').val();
                
                if (icon) {
                    row.find('.preview-icon').removeClass().addClass('fab fa-' + icon + ' fa-2x preview-icon');
                }
                
                if (name) {
                    row.find('.preview-name').text(name);
                }
            });
            
            // Live preview for Instagram images (File Upload)
            $(document).on('change', '.instagram-image-file', function() {
                const row = $(this).closest('.item-row');
                const previewContainer = row.find('.image-preview-container');
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewContainer.html(`
                            <img src="${e.target.result}" alt="Instagram Preview" class="preview-image">
                        `);
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                    
                    // پاک کردن URL تصویر هنگام آپلود فایل
                    row.find('.instagram-image-input').val('');
                }
            });
            
            // Live preview for Instagram images (URL)
            $(document).on('input', '.instagram-image-input', function() {
                const row = $(this).closest('.item-row');
                const imageUrl = $(this).val();
                const previewContainer = row.find('.image-preview-container');
                
                if (imageUrl) {
                    // پاک کردن فایل انتخاب شده
                    row.find('.instagram-image-file').val('');
                    
                    const img = $('<img>').attr('src', imageUrl).attr('alt', 'Instagram Preview').addClass('preview-image');
                    previewContainer.html(img);
                } else {
                    previewContainer.html(`
                        <div class="text-center p-4 bg-light rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-2 text-muted">پیش‌نمایش تصویر</p>
                        </div>
                    `);
                }
            });
            
            // نمایش اعلان شناور
            function showFloatAlert(message, type = 'success') {
                // حذف اعلان‌های قبلی
                $('.alert-float').remove();
                
                // ایجاد اعلان جدید
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show alert-float">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                
                $('body').append(alertHtml);
                
                // حذف خودکار بعد از 5 ثانیه
                setTimeout(function() {
                    $('.alert-float').fadeOut('slow', function() {
                        $(this).remove();
                    });
                }, 5000);
            }
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert-dismissible:not(.alert-float)').alert('close');
            }, 5000);
        });
    </script>
</body>
</html>