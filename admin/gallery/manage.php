<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// تنظیمات صفحه‌بندی
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// فیلتر براساس بخش سایت
$section_filter = isset($_GET['section']) ? mysqli_real_escape_string($db, $_GET['section']) : '';

// دریافت لیست بخش‌های سایت برای فیلتر
$sections_query = "SELECT DISTINCT section FROM gallery ORDER BY section";
$sections = mysqli_query($db, $sections_query);

// ساختن بخش WHERE برای کوئری
$where_clause = "WHERE 1=1";
if (!empty($section_filter)) {
    $where_clause .= " AND section = '$section_filter'";
}

// دریافت تعداد کل تصاویر با فیلترها
$count_query = "SELECT COUNT(*) as total FROM gallery $where_clause";
$count_result = mysqli_query($db, $count_query);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $records_per_page);

// دریافت لیست تصاویر
$query = "SELECT * FROM gallery $where_clause ORDER BY section, display_order, id DESC LIMIT $offset, $records_per_page";
$gallery_items = mysqli_query($db, $query);

// آپلود تصویر جدید
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $title_en = mysqli_real_escape_string($db, $_POST['title_en']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $description_en = mysqli_real_escape_string($db, $_POST['description_en']);
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $section = mysqli_real_escape_string($db, $_POST['section']);
    $display_order = (int)$_POST['display_order'];
    
    // بررسی آپلود تصویر
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if(in_array($ext, $allowed)) {
            // ایجاد نام منحصر به فرد برای فایل
            $new_filename = time() . '_' . uniqid();
            $upload_dir = "../assets/images/gallery/";
            
            // ایجاد پوشه در صورت نیاز
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // مسیر فایل اصلی آپلود شده
            $temp_path = $_FILES['image']['tmp_name'];
            
            // تبدیل و بهینه‌سازی تصویر
            $target_format = 'webp'; // یا 'jpg' بسته به نیاز شما
            $optimized_filename = $new_filename . '.' . $target_format;
            $upload_path = $upload_dir . $optimized_filename;
            
            // بهینه‌سازی و تبدیل تصویر
            if(optimize_and_convert_image($temp_path, $upload_path, $target_format, 85)) { // 85 کیفیت تصویر (درصد)
                $image_url = "assets/images/gallery/" . $optimized_filename;
                
                $insert_query = "INSERT INTO gallery (title, title_en, description, description_en, image_url, category, section, display_order, created_at) 
                                VALUES ('$title', '$title_en', '$description', '$description_en', '$image_url', '$category', '$section', $display_order, NOW())";
                $insert_result = mysqli_query($db, $insert_query);
                
                if($insert_result) {
                    // ثبت در لاگ سیستم
                    $log_description = "تصویر جدید با عنوان '$title' به بخش '$section' گالری اضافه شد";
                    mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
                        ('{$_SESSION['admin_id']}', 'add_gallery', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
                    
                    $success_message = "تصویر با موفقیت آپلود و بهینه‌سازی شد.";
                    
                    // بروزرسانی لیست تصاویر
                    $gallery_items = mysqli_query($db, $query);
                } else {
                    $error_message = "خطا در ثبت اطلاعات تصویر: " . mysqli_error($db);
                }
            } else {
                $error_message = "خطا در بهینه‌سازی تصویر!";
            }
        } else {
            $error_message = "فقط فایل‌های با پسوند jpg, jpeg, png, gif و webp مجاز هستند.";
        }
    } else {
        $error_message = "لطفاً یک تصویر انتخاب کنید.";
    }
}

// حذف تصویر
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $image_id = $_GET['delete'];
    
    // دریافت اطلاعات تصویر قبل از حذف
    $img_query = "SELECT * FROM gallery WHERE id = $image_id";
    $img_result = mysqli_query($db, $img_query);
    
    if(mysqli_num_rows($img_result) > 0) {
        $image = mysqli_fetch_assoc($img_result);
        
        // حذف فایل تصویر از سرور
        if(file_exists("../" . $image['image_url'])) {
            unlink("../" . $image['image_url']);
        }
        
        // حذف رکورد از دیتابیس
        $delete_query = "DELETE FROM gallery WHERE id = $image_id";
        $delete_result = mysqli_query($db, $delete_query);
        
        if($delete_result) {
            // ثبت در لاگ سیستم
            $log_description = "تصویر با شناسه $image_id از گالری حذف شد";
            mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
                ('{$_SESSION['admin_id']}', 'delete_gallery', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
            
            $success_message = "تصویر با موفقیت حذف شد.";
            
            // بروزرسانی لیست تصاویر
            $gallery_items = mysqli_query($db, $query);
        } else {
            $error_message = "خطا در حذف تصویر: " . mysqli_error($db);
        }
    } else {
        $error_message = "تصویر مورد نظر یافت نشد.";
    }
}

// ویرایش تصویر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $image_id = (int)$_POST['image_id'];
    $title = mysqli_real_escape_string($db, $_POST['edit_title']);
    $title_en = mysqli_real_escape_string($db, $_POST['edit_title_en']);
    $description = mysqli_real_escape_string($db, $_POST['edit_description']);
    $description_en = mysqli_real_escape_string($db, $_POST['edit_description_en']);
    $category = mysqli_real_escape_string($db, $_POST['edit_category']);
    $section = mysqli_real_escape_string($db, $_POST['edit_section']);
    $display_order = (int)$_POST['edit_display_order'];
    
    // دریافت اطلاعات تصویر قبلی
    $img_query = "SELECT * FROM gallery WHERE id = $image_id";
    $img_result = mysqli_query($db, $img_query);
    
    if(mysqli_num_rows($img_result) > 0) {
        $image = mysqli_fetch_assoc($img_result);
        $image_url = $image['image_url']; // استفاده از تصویر قبلی به صورت پیش‌فرض
        
        // بررسی آپلود تصویر جدید
        if(isset($_FILES['edit_image']) && $_FILES['edit_image']['error'] == 0) {
            $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            $filename = $_FILES['edit_image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if(in_array($ext, $allowed)) {
                // ایجاد نام منحصر به فرد برای فایل
                $new_filename = time() . '_' . uniqid();
                $upload_dir = "../assets/images/gallery/";
                
                // ایجاد پوشه در صورت نیاز
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // مسیر فایل اصلی آپلود شده
                $temp_path = $_FILES['edit_image']['tmp_name'];
                
                // تبدیل و بهینه‌سازی تصویر
                $target_format = 'webp'; // یا 'jpg' بسته به نیاز شما
                $optimized_filename = $new_filename . '.' . $target_format;
                $upload_path = $upload_dir . $optimized_filename;
                
                // بهینه‌سازی و تبدیل تصویر
                if(optimize_and_convert_image($temp_path, $upload_path, $target_format, 85)) {
                    // حذف تصویر قبلی
                    if(file_exists("../" . $image_url)) {
                        unlink("../" . $image_url);
                    }
                    
                    $image_url = "assets/images/gallery/" . $optimized_filename;
                } else {
                    $error_message = "خطا در بهینه‌سازی تصویر!";
                }
            } else {
                $error_message = "فقط فایل‌های با پسوند jpg, jpeg, png, gif و webp مجاز هستند.";
            }
        }
        
        if(!isset($error_message)) {
            $update_query = "UPDATE gallery SET 
                            title = '$title', 
                            title_en = '$title_en', 
                            description = '$description', 
                            description_en = '$description_en', 
                            image_url = '$image_url', 
                            category = '$category', 
                            section = '$section', 
                            display_order = $display_order, 
                            updated_at = NOW() 
                            WHERE id = $image_id";
            
            $update_result = mysqli_query($db, $update_query);
            
            if($update_result) {
                // ثبت در لاگ سیستم
                $log_description = "تصویر با شناسه $image_id در گالری ویرایش شد";
                mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
                    ('{$_SESSION['admin_id']}', 'edit_gallery', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
                
                $success_message = "اطلاعات تصویر با موفقیت بروزرسانی شد.";
                
                // بروزرسانی لیست تصاویر
                $gallery_items = mysqli_query($db, $query);
            } else {
                $error_message = "خطا در بروزرسانی اطلاعات تصویر: " . mysqli_error($db);
            }
        }
    } else {
        $error_message = "تصویر مورد نظر یافت نشد.";
    }
}

/**
 * تابع بهینه‌سازی و تبدیل تصویر
 * 
 * @param string $source_path مسیر فایل منبع
 * @param string $dest_path مسیر فایل مقصد
 * @param string $format فرمت مقصد ('webp' یا 'jpg')
 * @param int $quality کیفیت تصویر (0-100)
 * @return bool وضعیت موفقیت عملیات
 */
function optimize_and_convert_image($source_path, $dest_path, $format = 'webp', $quality = 85) {
    // بررسی وجود کتابخانه GD
    if (!extension_loaded('gd')) {
        return false;
    }
    
    // تشخیص نوع تصویر
    $image_info = getimagesize($source_path);
    if ($image_info === false) {
        return false;
    }
    
    // ایجاد تصویر منبع براساس نوع آن
    switch ($image_info[2]) {
        case IMAGETYPE_JPEG:
            $source_image = imagecreatefromjpeg($source_path);
            break;
        case IMAGETYPE_PNG:
            $source_image = imagecreatefrompng($source_path);
            // حفظ شفافیت
            imagepalettetotruecolor($source_image);
            imagealphablending($source_image, true);
            imagesavealpha($source_image, true);
            break;
        case IMAGETYPE_GIF:
            $source_image = imagecreatefromgif($source_path);
            break;
        case IMAGETYPE_WEBP:
            $source_image = imagecreatefromwebp($source_path);
            break;
        default:
            return false;
    }
    
    if ($source_image === false) {
        return false;
    }
    
    // تعیین ابعاد تصویر (می‌توانید برای تغییر اندازه تصویر این بخش را تغییر دهید)
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    
    // ایجاد تصویر مقصد
    $dest_image = imagecreatetruecolor($width, $height);
    
    // حفظ شفافیت برای فرمت‌های PNG و WebP
    if ($image_info[2] === IMAGETYPE_PNG || $format === 'webp') {
        imagepalettetotruecolor($dest_image);
        imagealphablending($dest_image, false);
        imagesavealpha($dest_image, true);
    }
    
    // کپی تصویر منبع به مقصد
    imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $width, $height, $width, $height);
    
    // ذخیره تصویر در فرمت مورد نظر
    $result = false;
    switch ($format) {
        case 'webp':
            $result = imagewebp($dest_image, $dest_path, $quality);
            break;
        case 'jpg':
        case 'jpeg':
            $result = imagejpeg($dest_image, $dest_path, $quality);
            break;
        case 'png':
            // تنظیم کیفیت PNG (0-9)
            $png_quality = floor((100 - $quality) / 10);
            $result = imagepng($dest_image, $dest_path, $png_quality);
            break;
        case 'gif':
            $result = imagegif($dest_image, $dest_path);
            break;
    }
    
    // آزادسازی حافظه
    imagedestroy($source_image);
    imagedestroy($dest_image);
    
    return $result;
}

// لیست بخش‌های سایت
$site_sections = array(
    'carousel' => 'اسلایدر اصلی',
    'homepage_banner' => 'بنر صفحه اصلی',
    'about_us' => 'تصاویر درباره ما',
    'staff' => 'تصاویر کارکنان',
    'testimonials' => 'تصاویر نظرات',
    'gallery' => 'گالری تصاویر',
    'other' => 'سایر'
);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت گالری تصاویر - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .gallery-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .gallery-card {
            transition: all 0.3s;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .gallery-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .gallery-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .gallery-card .card-body {
            padding: 15px;
        }
        
        .gallery-card .card-title {
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .gallery-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        
        .pagination {
            justify-content: center;
            margin-top: 1rem;
        }
        
        .section-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 3px 10px;
            border-radius: 30px;
            font-size: 0.7rem;
            z-index: 10;
        }
        
        .filter-bar {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
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
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">مدیریت گالری تصاویر</h6>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">
                                    <i class="fas fa-plus"></i> افزودن تصویر
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <?php if(isset($success_message)): ?>
                                <div class="alert alert-success text-white"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                            
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger text-white"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            
                            <!-- فیلترها -->
                            <div class="filter-bar">
                                <form method="get" class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="form-control-label">فیلتر براساس بخش سایت:</label>
                                            <select name="section" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">همه بخش‌ها</option>
                                                <?php foreach($site_sections as $key => $value): ?>
                                                    <option value="<?php echo $key; ?>" <?php echo ($section_filter == $key) ? 'selected' : ''; ?>>
                                                        <?php echo $value; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-md-0 mt-3">
                                        <a href="manage.php" class="btn btn-sm btn-secondary w-100">حذف فیلتر</a>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="row">
                                <?php if(mysqli_num_rows($gallery_items) > 0): ?>
                                    <?php while($item = mysqli_fetch_assoc($gallery_items)): ?>
                                        <div class="col-md-4 col-sm-6 mb-4">
                                            <div class="card gallery-card position-relative">
                                                <div class="gallery-actions">
                                                    <button class="btn btn-sm btn-info edit-btn" 
                                                            data-id="<?php echo $item['id']; ?>"
                                                            data-title="<?php echo $item['title']; ?>"
                                                            data-title-en="<?php echo $item['title_en']; ?>"
                                                            data-description="<?php echo $item['description']; ?>"
                                                            data-description-en="<?php echo $item['description_en']; ?>"
                                                            data-category="<?php echo $item['category']; ?>"
                                                            data-section="<?php echo $item['section']; ?>"
                                                            data-order="<?php echo $item['display_order']; ?>"
                                                            data-bs-toggle="modal" data-bs-target="#editImageModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="manage.php?delete=<?php echo $item['id']; ?>" 
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('آیا از حذف این تصویر اطمینان دارید؟')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                                
                                                <?php if(!empty($item['section'])): ?>
                                                    <span class="section-badge bg-primary text-white">
                                                        <?php echo isset($site_sections[$item['section']]) ? $site_sections[$item['section']] : $item['section']; ?>
                                                    </span>
                                                <?php endif; ?>
                                                
                                                <img src="../<?php echo $item['image_url']; ?>" class="card-img-top" alt="<?php echo $item['title']; ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $item['title']; ?></h5>
                                                    <h6 class="text-muted"><?php echo $item['title_en']; ?></h6>
                                                    <?php if(!empty($item['category'])): ?>
                                                        <span class="badge bg-info text-white mb-2"><?php echo $item['category']; ?></span>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['description'])): ?>
                                                        <p class="card-text small"><?php echo mb_substr($item['description'], 0, 100) . (mb_strlen($item['description']) > 100 ? '...' : ''); ?></p>
                                                    <?php endif; ?>
                                                    <div class="text-muted small mt-2">
                                                        <div>اولویت نمایش: <?php echo $item['display_order']; ?></div>
                                                        <div>تاریخ آپلود: <?php echo date('Y/m/d H:i', strtotime($item['created_at'])); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <div class="alert alert-warning">
                                            هیچ تصویری در گالری <?php echo !empty($section_filter) ? "برای بخش \"" . $site_sections[$section_filter] . "\"" : ""; ?> یافت نشد.
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- صفحه‌بندی -->
                            <?php if($total_pages > 1): ?>
                                <div class="mt-4">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination rtl">
                                            <?php if($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=1<?php echo !empty($section_filter) ? '&section='.$section_filter : ''; ?>" aria-label="First">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page-1; ?><?php echo !empty($section_filter) ? '&section='.$section_filter : ''; ?>">قبلی</a>
                                                </li>
                                            <?php endif; ?>
                                            
                                            <?php
                                                $start_page = max(1, $page - 2);
                                                $end_page = min($total_pages, $page + 2);
                                                
                                                for($i = $start_page; $i <= $end_page; $i++):
                                            ?>
                                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?><?php echo !empty($section_filter) ? '&section='.$section_filter : ''; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            
                                            <?php if($page < $total_pages): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page+1; ?><?php echo !empty($section_filter) ? '&section='.$section_filter : ''; ?>">بعدی</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $total_pages; ?><?php echo !empty($section_filter) ? '&section='.$section_filter : ''; ?>" aria-label="Last">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <!-- Modal افزودن تصویر -->
    <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">افزودن تصویر جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-control-label">عنوان (فارسی)</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en" class="form-control-label">عنوان (انگلیسی)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section" class="form-control-label">بخش سایت</label>
                                    <select class="form-control" id="section" name="section" required>
                                        <?php foreach($site_sections as $key => $value): ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-muted">مشخص کنید این تصویر برای کدام بخش سایت است.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="form-control-label">دسته‌بندی</label>
                                    <input type="text" class="form-control" id="category" name="category">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">توضیحات (فارسی)</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description_en" class="form-control-label">توضیحات (انگلیسی)</label>
                                    <textarea class="form-control" id="description_en" name="description_en" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="display_order" class="form-control-label">اولویت نمایش</label>
                                    <input type="number" class="form-control" id="display_order" name="display_order" value="0" min="0">
                                    <small class="form-text text-muted">اعداد کوچکتر، اولویت بالاتر (0 بالاترین اولویت)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">تصویر</label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                    <small class="form-text text-muted">فایل‌های jpg, jpeg, png, gif و webp با حداکثر حجم 5MB مجاز هستند.</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-1"></i>
                            تصویر آپلود شده به صورت خودکار به فرمت WebP تبدیل و بهینه‌سازی می‌شود تا حجم کمتری داشته باشد.
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                            <button type="submit" name="upload" class="btn btn-primary">آپلود</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal ویرایش تصویر -->
    <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editImageModalLabel">ویرایش تصویر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" id="image_id" name="image_id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_title" class="form-control-label">عنوان (فارسی)</label>
                                    <input type="text" class="form-control" id="edit_title" name="edit_title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_title_en" class="form-control-label">عنوان (انگلیسی)</label>
                                    <input type="text" class="form-control" id="edit_title_en" name="edit_title_en" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_section" class="form-control-label">بخش سایت</label>
                                    <select class="form-control" id="edit_section" name="edit_section" required>
                                        <?php foreach($site_sections as $key => $value): ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_category" class="form-control-label">دسته‌بندی</label>
                                    <input type="text" class="form-control" id="edit_category" name="edit_category">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_description" class="form-control-label">توضیحات (فارسی)</label>
                                    <textarea class="form-control" id="edit_description" name="edit_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_description_en" class="form-control-label">توضیحات (انگلیسی)</label>
                                    <textarea class="form-control" id="edit_description_en" name="edit_description_en" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_display_order" class="form-control-label">اولویت نمایش</label>
                                    <input type="number" class="form-control" id="edit_display_order" name="edit_display_order" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_image" class="form-control-label">تصویر جدید (اختیاری)</label>
                                    <input type="file" class="form-control" id="edit_image" name="edit_image">
                                    <small class="form-text text-muted">در صورت عدم انتخاب، از تصویر قبلی استفاده می‌شود.</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-1"></i>
                            تصویر جدید به صورت خودکار به فرمت WebP تبدیل و بهینه‌سازی می‌شود.
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                            <button type="submit" name="edit" class="btn btn-primary">بروزرسانی</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // مقداردهی فیلدهای ویرایش
        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('image_id').value = this.getAttribute('data-id');
                document.getElementById('edit_title').value = this.getAttribute('data-title');
                document.getElementById('edit_title_en').value = this.getAttribute('data-title-en');
                document.getElementById('edit_description').value = this.getAttribute('data-description');
                document.getElementById('edit_description_en').value = this.getAttribute('data-description-en');
                document.getElementById('edit_category').value = this.getAttribute('data-category');
                document.getElementById('edit_section').value = this.getAttribute('data-section') || 'other';
                document.getElementById('edit_display_order').value = this.getAttribute('data-order');
            });
        });
    </script>
</body>
</html>