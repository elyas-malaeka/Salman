<?php 
require_once '../config/config.php';
require_once '../includes/image_helper.php'; 
// بررسی دسترسی ادمین
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ".admin_url('login.php'));
    exit();  
}

// بررسی آیدی پست
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ".admin_url('posts/list.php'));
    exit();
}

$post_id = intval($_GET['id']);

// دریافت اطلاعات پست
$post_query = mysqli_query($db, "SELECT * FROM post WHERE id = $post_id");

if(mysqli_num_rows($post_query) == 0) {
    header("Location: ".admin_url('posts/list.php'));
    exit();
}

$post = mysqli_fetch_assoc($post_query);

// تنظیمات آپلود تصویر
$upload_dir = '../../assets/images/blog/';
$extra_upload_dir = '../../assets/images/blog/Extra_Post_Images/';

// اطمینان از وجود مسیر آپلود تصاویر
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}
if (!file_exists($extra_upload_dir)) {
    mkdir($extra_upload_dir, 0755, true);
}

$allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$max_size = 5 * 1024 * 1024; // 5MB

// پیام‌های خطا و موفقیت
$errors = [];
$success = '';

// اگر فرم ارسال شده باشد
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت داده‌های فرم
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $title_en = mysqli_real_escape_string($db, $_POST['title_en']);
    $content1 = mysqli_real_escape_string($db, $_POST['content1']);
    $content1_en = mysqli_real_escape_string($db, $_POST['content1_en']);
    $content2 = isset($_POST['content2']) ? mysqli_real_escape_string($db, $_POST['content2']) : null;
    $content2_en = isset($_POST['content2_en']) ? mysqli_real_escape_string($db, $_POST['content2_en']) : null;
    $category_id = intval($_POST['category_id']);
    $publish_date = mysqli_real_escape_string($db, $_POST['publish_date']);
    
    // بررسی اگر عنوان انگلیسی تغییر کرده است، slug جدید ایجاد شود
    if ($title_en != $post['title_en']) {
        $slug = createSlug($title_en);
        
        // بررسی تکراری نبودن slug
        $check_slug = mysqli_query($db, "SELECT id FROM post WHERE slug = '$slug' AND id != $post_id");
        if (mysqli_num_rows($check_slug) > 0) {
            $slug = $slug . '-' . time();
        }
    } else {
        $slug = $post['slug'];
    }
    
    // اعتبارسنجی‌های اساسی
    if (empty($title)) {
        $errors[] = 'عنوان فارسی الزامی است';
    }
    
    if (empty($title_en)) {
        $errors[] = 'عنوان انگلیسی الزامی است';
    }
    
    if (empty($content1)) {
        $errors[] = 'محتوای اصلی فارسی الزامی است';
    }
    
    if (empty($content1_en)) {
        $errors[] = 'محتوای اصلی انگلیسی الزامی است';
    }
    
    if (empty($category_id)) {
        $errors[] = 'انتخاب دسته‌بندی الزامی است';
    }
    
    if (empty($publish_date)) {
        $errors[] = 'تاریخ انتشار الزامی است';
    }
    
    // مقادیر پیش‌فرض برای تصاویر
    $main_image_path = $post['main_image'];
    $image1_path = $post['image1'];
    $image2_path = $post['image2'];
    
    // پردازش و آپلود تصویر اصلی
    if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] != UPLOAD_ERR_NO_FILE) {
        $main_image = uploadImage('main_image', $upload_dir, $allowed_types, $max_size);
        
        if (!empty($main_image['error'])) {
            $errors[] = $main_image['error'];
        } else {
            // حذف تصویر قبلی
            if (!empty($post['main_image'])) {
                $full_path = $upload_dir . $post['main_image'];
                if(file_exists($full_path)) {
                    unlink($full_path);
                }
            }
            $main_image_path = $main_image['path'];
        }
    }
    
    // پردازش و آپلود تصویر اول
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE) {
        $image1 = uploadImage('image1', $extra_upload_dir, $allowed_types, $max_size);
        
        if (!empty($image1['error'])) {
            $errors[] = $image1['error'];
        } else {
            // حذف تصویر قبلی
            if (!empty($post['image1'])) {
                $full_path = $extra_upload_dir . $post['image1'];
                if(file_exists($full_path)) {
                    unlink($full_path);
                }
            }
            $image1_path = $image1['path'];
        }
    }
    
    // پردازش و آپلود تصویر دوم
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] != UPLOAD_ERR_NO_FILE) {
        $image2 = uploadImage('image2', $extra_upload_dir, $allowed_types, $max_size);
        
        if (!empty($image2['error'])) {
            $errors[] = $image2['error'];
        } else {
            // حذف تصویر قبلی
            if (!empty($post['image2'])) {
                $full_path = $extra_upload_dir . $post['image2'];
                if(file_exists($full_path)) {
                    unlink($full_path);
                }
            }
            $image2_path = $image2['path'];
        }
    }
    
    // اگر خطایی وجود نداشت، بروزرسانی در دیتابیس
    if (empty($errors)) {
        $query = "UPDATE post SET 
                    slug = '$slug',
                    title = '$title',
                    title_en = '$title_en',
                    main_image = '$main_image_path',
                    content1 = '$content1',
                    content1_en = '$content1_en',
                    image1 = '$image1_path',
                    image2 = '$image2_path',
                    content2 = '$content2',
                    content2_en = '$content2_en',
                    category_id = $category_id,
                    publish_date = '$publish_date'
                  WHERE id = $post_id";
        
        if (mysqli_query($db, $query)) {
            // ثبت فعالیت
            $admin_id = $_SESSION['admin_id'] ?? 0;
            $log_description = "پست با عنوان «$title » ویرایش شد";
            mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
                             VALUES ($admin_id, 'post_updated', '$log_description', '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}')");
            
            $success = 'پست با موفقیت بروزرسانی شد';
            
            // بروزرسانی اطلاعات پست
            $post_query = mysqli_query($db, "SELECT * FROM post WHERE id = $post_id");
            $post = mysqli_fetch_assoc($post_query);
        } else {
            $errors[] = 'خطا در بروزرسانی پست: ' . mysqli_error($db);
        }
    }
}

// دریافت لیست دسته‌بندی‌ها
$categories = mysqli_query($db, "SELECT * FROM categories ORDER BY category_name");

// تابع کمکی برای ایجاد slug
function createSlug($string){
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

// تابع کمکی برای آپلود تصویر
function uploadImage($input_name, $upload_dir, $allowed_types, $max_size) {
    $result = ['path' => '', 'error' => ''];
    
    // بررسی خطاهای آپلود
    if ($_FILES[$input_name]['error'] !== UPLOAD_ERR_OK) {
        $result['error'] = 'خطا در آپلود فایل: ' . $_FILES[$input_name]['error'];
        return $result;
    }
    
    // بررسی سایز فایل
    if ($_FILES[$input_name]['size'] > $max_size) {
        $result['error'] = 'سایز فایل بیش از حد مجاز است (حداکثر 5 مگابایت)';
        return $result;
    }
    
    // بررسی نوع فایل
    $file_type = strtolower(pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION));
    if (!in_array($file_type, $allowed_types)) {
        $result['error'] = 'فرمت فایل مجاز نیست. فرمت‌های مجاز: ' . implode(', ', $allowed_types);
        return $result;
    }
    
    // ایجاد نام یکتا برای فایل
    $new_filename = uniqid('post_', true) . '.' . $file_type;
    $upload_path = $upload_dir . $new_filename;
    
    // آپلود فایل
    if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $upload_path)) {
        $result['path'] = $new_filename;
    } else {
        $result['error'] = 'خطا در ذخیره‌سازی فایل. لطفاً مطمئن شوید که مسیر ' . $upload_dir . ' وجود دارد و قابل نوشتن است.';
    }
    
    return $result;
}

// تبدیل datetime به فرمت مناسب برای input
$publish_date_formatted = str_replace(' ', 'T', substr($post['publish_date'], 0, 16));
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش پست - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .image-preview {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
            margin-top: 0.5rem;
            border: 2px dashed #dee2e6;
            position: relative;
            overflow: hidden;
        }
        
        .image-preview.filled {
            border: none;
            box-shadow: 0 0.25rem 0.375rem rgba(0, 0, 0, 0.05);
        }
        
        .image-preview-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #adb5bd;
        }
        
        .image-preview-placeholder i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .image-preview-text {
            font-size: 0.875rem;
            text-align: center;
        }
        
        .input-file-container {
            position: relative;
        }
        
        .input-file-trigger {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            cursor: pointer;
        }
        
        .input-file {
            position: absolute;
            top: 0;
            right: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 1;
        }
        
        .file-return {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .alert-float {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            z-index: 9999;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            border: none;
            padding: 1rem;
        }
        
        .tab-content {
            padding-top: 1.5rem;
        }
        
        .lang-tab.active {
            background-color: #5e72e4;
            color: white;
        }
        
        .actions-container {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        
        .content-tab-container {
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1rem;
            background-color: #f8f9fa;
        }
        
        /* Custom design for file inputs */
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .file-input-button {
            display: inline-block;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            width: 100%;
            text-align: center;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .file-input-button:hover {
            background-color: #e9ecef;
        }
        
        .file-input-text {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #6c757d;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }
        
        /* Required fields */
        .required-field::after {
            content: ' *';
            color: #f5365c;
        }
        
        /* Image Controls */
        .image-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        
        .image-control-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .image-control-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }
        
        .image-control-btn.remove {
            background-color: rgba(220, 53, 69, 0.6);
        }
        
        .image-control-btn.remove:hover {
            background-color: rgba(220, 53, 69, 0.8);
        }
    </style>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Alerts -->
                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($success)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center pb-0">
                            <div>
                                <h6>ویرایش پست</h6>
                                <p class="text-sm mb-0">
                                    در این بخش می‌توانید پست را ویرایش کنید. فیلدهای ستاره‌دار الزامی هستند.
                                </p>
                            </div>
                            <div>
                                <a href="<?php echo site_url('post.php?id=' . $post['id']); ?>" target="_blank" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-external-link-alt me-1"></i> مشاهده در سایت
                                </a>
                                <a href="<?php echo admin_url('posts/list.php'); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-list me-1"></i> لیست پست‌ها
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="form-control-label required-field">عنوان فارسی</label>
                                            <input class="form-control" type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_en" class="form-control-label required-field">عنوان انگلیسی</label>
                                            <input class="form-control" type="text" id="title_en" name="title_en" value="<?php echo htmlspecialchars($post['title_en']); ?>" required>
                                            <small class="text-muted">برای ساخت لینک (slug) از عنوان انگلیسی استفاده می‌شود</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id" class="form-control-label required-field">دسته‌بندی</label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                <option value="" disabled>انتخاب دسته‌بندی</option>
                                                <?php mysqli_data_seek($categories, 0); ?>
                                                <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                                                <option value="<?php echo $category['category_id']; ?>" <?php echo ($post['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($category['category_name']); ?>
                                                </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="publish_date" class="form-control-label required-field">تاریخ انتشار</label>
                                            <input class="form-control" type="datetime-local" id="publish_date" name="publish_date" value="<?php echo htmlspecialchars($publish_date_formatted); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="main_image" class="form-control-label required-field">تصویر اصلی</label>
                                            <div class="input-file-container">
                                                <div class="file-input-wrapper">
                                                    <input type="file" class="input-file" id="main_image" name="main_image" accept="image/*">
                                                    <div class="file-input-button">
                                                        <i class="fas fa-upload me-1"></i> تغییر تصویر اصلی
                                                    </div>
                                                </div>
                                                <div class="file-input-text" id="main_image_name">
                                                    <?php echo !empty($post['main_image']) ? $post['main_image'] : 'فایلی انتخاب نشده است'; ?>
                                                </div>
                                            </div>
                                            <div class="image-preview <?php echo !empty($post['main_image']) ? 'filled' : ''; ?>" id="main_image_preview" style="<?php echo !empty($post['main_image']) ? 'background-image: url(../../assets/images/blog/' . $post['main_image'] . ');' : ''; ?>">
                                                <?php if (empty($post['main_image'])): ?>
                                                <div class="image-preview-placeholder">
                                                    <div class="text-center">
                                                        <i class="fas fa-image"></i>
                                                        <div class="image-preview-text">تصویر اصلی</div>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="image-preview-placeholder" style="display: none;"></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image1" class="form-control-label">تصویر اول (اختیاری)</label>
                                            <div class="input-file-container">
                                                <div class="file-input-wrapper">
                                                    <input type="file" class="input-file" id="image1" name="image1" accept="image/*">
                                                    <div class="file-input-button">
                                                        <i class="fas fa-upload me-1"></i> تغییر تصویر اول
                                                    </div>
                                                </div>
                                                <div class="file-input-text" id="image1_name">
                                                    <?php echo !empty($post['image1']) ? $post['image1'] : 'فایلی انتخاب نشده است'; ?>
                                                </div>
                                            </div>
                                            <div class="image-preview <?php echo !empty($post['image1']) ? 'filled' : ''; ?>" id="image1_preview" style="<?php echo !empty($post['image1']) ? 'background-image: url(../../assets/images/blog/Extra_Post_Images/' . $post['image1'] . ');' : ''; ?>">
                                                <?php if (empty($post['image1'])): ?>
                                                <div class="image-preview-placeholder">
                                                    <div class="text-center">
                                                        <i class="fas fa-image"></i>
                                                        <div class="image-preview-text">تصویر اول</div>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="image-preview-placeholder" style="display: none;"></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image2" class="form-control-label">تصویر دوم (اختیاری)</label>
                                            <div class="input-file-container">
                                                <div class="file-input-wrapper">
                                                    <input type="file" class="input-file" id="image2" name="image2" accept="image/*">
                                                    <div class="file-input-button">
                                                        <i class="fas fa-upload me-1"></i> تغییر تصویر دوم
                                                    </div>
                                                </div>
                                                <div class="file-input-text" id="image2_name">
                                                    <?php echo !empty($post['image2']) ? $post['image2'] : 'فایلی انتخاب نشده است'; ?>
                                                </div>
                                            </div>
                                            <div class="image-preview <?php echo !empty($post['image2']) ? 'filled' : ''; ?>" id="image2_preview" style="<?php echo !empty($post['image2']) ? 'background-image: url(../../assets/images/blog/Extra_Post_Images/' . $post['image2'] . ');' : ''; ?>">
                                                <?php if (empty($post['image2'])): ?>
                                                <div class="image-preview-placeholder">
                                                    <div class="text-center">
                                                        <i class="fas fa-image"></i>
                                                        <div class="image-preview-text">تصویر دوم</div>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                    <div class="image-preview-placeholder" style="display: none;"></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Content Tabs -->
                                <div class="content-tab-container mt-4">
                                    <ul class="nav nav-tabs" id="contentTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link lang-tab active" id="content1-tab" data-bs-toggle="tab" data-bs-target="#content1-pane" type="button" role="tab" aria-controls="content1-pane" aria-selected="true">محتوای اصلی</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link lang-tab" id="content2-tab" data-bs-toggle="tab" data-bs-target="#content2-pane" type="button" role="tab" aria-controls="content2-pane" aria-selected="false">محتوای دوم (اختیاری)</button>
                                        </li>
                                    </ul>
                                    
                                    <div class="tab-content" id="contentTabsContent">
                                        <!-- Content 1 Tab -->
                                        <div class="tab-pane fade show active" id="content1-pane" role="tabpanel" aria-labelledby="content1-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <ul class="nav nav-pills mb-3" id="content1-lang-tabs" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="content1-fa-tab" data-bs-toggle="pill" data-bs-target="#content1-fa" type="button" role="tab" aria-controls="content1-fa" aria-selected="true">محتوای فارسی</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="content1-en-tab" data-bs-toggle="pill" data-bs-target="#content1-en" type="button" role="tab" aria-controls="content1-en" aria-selected="false">محتوای انگلیسی</button>
                                                        </li>
                                                    </ul>
                                                    
                                                    <div class="tab-content" id="content1-lang-tabContent">
                                                        <div class="tab-pane fade show active" id="content1-fa" role="tabpanel" aria-labelledby="content1-fa-tab">
                                                            <div class="form-group">
                                                                <label for="content1" class="form-control-label required-field">محتوای اصلی فارسی</label>
                                                                <textarea class="form-control" id="content1" name="content1" rows="5" required><?php echo htmlspecialchars($post['content1']); ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="content1-en" role="tabpanel" aria-labelledby="content1-en-tab">
                                                            <div class="form-group">
                                                                <label for="content1_en" class="form-control-label required-field">محتوای اصلی انگلیسی</label>
                                                                <textarea class="form-control" id="content1_en" name="content1_en" rows="5" required><?php echo htmlspecialchars($post['content1_en']); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Content 2 Tab -->
                                        <div class="tab-pane fade" id="content2-pane" role="tabpanel" aria-labelledby="content2-tab" tabindex="0">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <ul class="nav nav-pills mb-3" id="content2-lang-tabs" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="content2-fa-tab" data-bs-toggle="pill" data-bs-target="#content2-fa" type="button" role="tab" aria-controls="content2-fa" aria-selected="true">محتوای دوم فارسی</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="content2-en-tab" data-bs-toggle="pill" data-bs-target="#content2-en" type="button" role="tab" aria-controls="content2-en" aria-selected="false">محتوای دوم انگلیسی</button>
                                                        </li>
                                                    </ul>
                                                    
                                                    <div class="tab-content" id="content2-lang-tabContent">
                                                        <div class="tab-pane fade show active" id="content2-fa" role="tabpanel" aria-labelledby="content2-fa-tab">
                                                            <div class="form-group">
                                                                <label for="content2" class="form-control-label">محتوای دوم فارسی (اختیاری)</label>
                                                                <textarea class="form-control" id="content2" name="content2" rows="5"><?php echo htmlspecialchars($post['content2']); ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="content2-en" role="tabpanel" aria-labelledby="content2-en-tab">
                                                            <div class="form-group">
                                                                <label for="content2_en" class="form-control-label">محتوای دوم انگلیسی (اختیاری)</label>
                                                                <textarea class="form-control" id="content2_en" name="content2_en" rows="5"><?php echo htmlspecialchars($post['content2_en']); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-between">
                                        <a href="<?php echo admin_url('posts/list.php'); ?>" class="btn btn-secondary">
                                            <i class="fas fa-arrow-right me-1"></i> بازگشت به لیست
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> ذخیره تغییرات
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteImageModalLabel">تأیید حذف تصویر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف این تصویر اطمینان دارید؟</p>
                    <p class="text-muted small">توجه: این عملیات غیرقابل بازگشت است.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <a href="#" id="confirmDeleteImageBtn" class="btn btn-danger">بله، حذف شود</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // پیش‌نمایش تصاویر آپلودی
            function previewImage(input, previewId, nameId) {
                const preview = document.getElementById(previewId);
                const fileName = document.getElementById(nameId);
                
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.style.backgroundImage = `url('${e.target.result}')`;
                        preview.classList.add('filled');
                        preview.querySelector('.image-preview-placeholder').style.display = 'none';
                        
                        fileName.textContent = input.files[0].name;
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.style.backgroundImage = '';
                    preview.classList.remove('filled');
                    preview.querySelector('.image-preview-placeholder').style.display = 'flex';
                    
                    fileName.textContent = 'فایلی انتخاب نشده است';
                }
            }
            
            // رویدادهای پیش‌نمایش تصاویر
            document.getElementById('main_image').addEventListener('change', function() {
                previewImage(this, 'main_image_preview', 'main_image_name');
            });
            
            document.getElementById('image1').addEventListener('change', function() {
                previewImage(this, 'image1_preview', 'image1_name');
            });
            
            document.getElementById('image2').addEventListener('change', function() {
                previewImage(this, 'image2_preview', 'image2_name');
            });
            
            // اسکرولبار سفارشی
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        });
    </script>
</body>
</html>