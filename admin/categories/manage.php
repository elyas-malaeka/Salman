<?php 
require_once '../config/config.php';

// بررسی دسترسی ادمین
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ".admin_url('login.php'));
    exit();  
}

// مقادیر پیش‌فرض
$category_id = 0;
$category_name = '';
$category_name_en = '';
$page_title = 'افزودن دسته‌بندی جدید';
$submit_button = 'افزودن دسته‌بندی';
$is_edit_mode = false;

// بررسی حالت ویرایش
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = intval($_GET['id']);
    $category_query = mysqli_query($db, "SELECT * FROM categories WHERE category_id = $category_id");
    
    if(mysqli_num_rows($category_query) > 0) {
        $category = mysqli_fetch_assoc($category_query);
        $category_name = $category['category_name'];
        $category_name_en = $category['category_name_en'];
        $page_title = 'ویرایش دسته‌بندی';
        $submit_button = 'بروزرسانی دسته‌بندی';
        $is_edit_mode = true;
    } else {
        // اگر دسته‌بندی با این شناسه وجود نداشت، به صفحه لیست برگردد
        header("Location: ".admin_url('categories/list.php'));
        exit();
    }
}

// پیام‌های خطا و موفقیت
$errors = [];
$success = '';

// پردازش فرم
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = mysqli_real_escape_string($db, $_POST['category_name']);
    $category_name_en = mysqli_real_escape_string($db, $_POST['category_name_en']);
    
    // اعتبارسنجی
    if (empty($category_name)) {
        $errors[] = 'نام دسته‌بندی فارسی الزامی است';
    }
    
    if (empty($category_name_en)) {
        $errors[] = 'نام دسته‌بندی انگلیسی الزامی است';
    }
    
    // بررسی تکراری نبودن نام
    $check_query = "SELECT category_id FROM categories WHERE category_name = '$category_name'";
    if ($is_edit_mode) {
        $check_query .= " AND category_id != $category_id";
    }
    
    $check_result = mysqli_query($db, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $errors[] = 'دسته‌بندی با این نام قبلاً ثبت شده است';
    }
    
    // اگر خطایی وجود نداشت، ذخیره در دیتابیس
    if (empty($errors)) {
        if ($is_edit_mode) {
            // بروزرسانی دسته‌بندی موجود
            $update_query = "UPDATE categories SET 
                            category_name = '$category_name', 
                            category_name_en = '$category_name_en' 
                            WHERE category_id = $category_id";
                            
            if (mysqli_query($db, $update_query)) {
                // ثبت فعالیت
                $admin_id = $_SESSION['admin_id'] ?? 0;
                $log_description = "دسته‌بندی با شناسه $category_id بروزرسانی شد";
                mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
                                VALUES ($admin_id, 'category_updated', '$log_description', '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}')");
                
                $success = 'دسته‌بندی با موفقیت بروزرسانی شد';
            } else {
                $errors[] = 'خطا در بروزرسانی دسته‌بندی: ' . mysqli_error($db);
            }
        } else {
            // افزودن دسته‌بندی جدید
            $insert_query = "INSERT INTO categories (category_name, category_name_en) 
                           VALUES ('$category_name', '$category_name_en')";
                           
            if (mysqli_query($db, $insert_query)) {
                $new_category_id = mysqli_insert_id($db);
                
                // ثبت فعالیت
                $admin_id = $_SESSION['admin_id'] ?? 0;
                $log_description = "دسته‌بندی جدید با نام « $category_name » ایجاد شد";
                mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
                                VALUES ($admin_id, 'category_created', '$log_description', '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}')");
                
                $success = 'دسته‌بندی جدید با موفقیت ایجاد شد';
                
                // پاک کردن فرم در حالت افزودن
                $category_name = $category_name_en = '';
            } else {
                $errors[] = 'خطا در ایجاد دسته‌بندی: ' . mysqli_error($db);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .card-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .required-field::after {
            content: ' *';
            color: #f5365c;
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
                        <div class="card-header pb-0">
                            <div class="card-header-content">
                                <div>
                                    <h6><?php echo $page_title; ?></h6>
                                    <p class="text-sm mb-0">
                                        تعریف و مدیریت دسته‌بندی‌های سایت برای طبقه‌بندی مطالب
                                    </p>
                                </div>
                                <a href="<?php echo admin_url('categories/list.php'); ?>" class="btn btn-sm btn-dark">
                                    <i class="fas fa-list-ul me-1"></i> لیست دسته‌بندی‌ها
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_name" class="form-control-label required-field">نام دسته‌بندی (فارسی)</label>
                                            <input class="form-control" type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category_name); ?>" required>
                                            <small class="text-muted">نام دسته‌بندی که در نسخه فارسی سایت نمایش داده می‌شود</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_name_en" class="form-control-label required-field">نام دسته‌بندی (انگلیسی)</label>
                                            <input class="form-control" type="text" id="category_name_en" name="category_name_en" value="<?php echo htmlspecialchars($category_name_en); ?>" required>
                                            <small class="text-muted">نام دسته‌بندی که در نسخه انگلیسی سایت نمایش داده می‌شود</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if($is_edit_mode): ?>
                                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                <?php endif; ?>
                                
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-between">
                                        <a href="<?php echo admin_url('categories/list.php'); ?>" class="btn btn-secondary">
                                            <i class="fas fa-arrow-right me-1"></i> بازگشت به لیست
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> <?php echo $submit_button; ?>
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
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // اسکرولبار سفارشی
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
</body>
</html>