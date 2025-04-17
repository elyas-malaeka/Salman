<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// پردازش فرم بروزرسانی اطلاعات
$update_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_school_info'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $name_en = mysqli_real_escape_string($db, $_POST['name_en']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $address_en = mysqli_real_escape_string($db, $_POST['address_en']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $website = mysqli_real_escape_string($db, $_POST['website']);
    $facebook = mysqli_real_escape_string($db, $_POST['facebook']);
    $twitter = mysqli_real_escape_string($db, $_POST['twitter']);
    $instagram = mysqli_real_escape_string($db, $_POST['instagram']);
    $youtube = mysqli_real_escape_string($db, $_POST['youtube']);
    $linkedin = mysqli_real_escape_string($db, $_POST['linkedin']);
    $about = mysqli_real_escape_string($db, $_POST['about']);
    $about_en = mysqli_real_escape_string($db, $_POST['about_en']);
    $location_map = mysqli_real_escape_string($db, $_POST['location_map']);
    
    // آپلود لوگو
    $logo_url = $_POST['current_logo_url'];
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['logo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = 'school_logo_' . time() . '.' . $ext;
            $upload_dir = '../assets/Media/logo/';
            $upload_path = $upload_dir . $new_name;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path)) {
                $logo_url = $new_name;
            }
        }
    }
    
    // آپلود فاویکون
    $favicon_url = $_POST['current_favicon_url'];
    if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] == 0) {
        $allowed = ['ico', 'png'];
        $filename = $_FILES['favicon']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = 'favicon_' . time() . '.' . $ext;
            $upload_dir = '../assets/Media/logo/';
            $upload_path = $upload_dir . $new_name;
            
            if (move_uploaded_file($_FILES['favicon']['tmp_name'], $upload_path)) {
                $favicon_url = $new_name;
            }
        }
    }
    
    // بروزرسانی اطلاعات در دیتابیس
    $update_query = "
        UPDATE school_info SET 
            name = '$name', 
            name_en = '$name_en', 
            address = '$address', 
            address_en = '$address_en', 
            phone = '$phone', 
            email = '$email', 
            website = '$website', 
            facebook = '$facebook', 
            twitter = '$twitter', 
            instagram = '$instagram', 
            youtube = '$youtube', 
            linkedin = '$linkedin', 
            about = '$about', 
            about_en = '$about_en', 
            location_map = '$location_map', 
            logo_url = '$logo_url', 
            favicon_url = '$favicon_url',
            updated_at = NOW()
        WHERE id = 1
    ";
    
    if (mysqli_query($db, $update_query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "اطلاعات مدرسه بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_school_info', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $update_message = '<div class="alert alert-success">اطلاعات مدرسه با موفقیت بروزرسانی شد.</div>';
    } else {
        $update_message = '<div class="alert alert-danger">خطا در بروزرسانی اطلاعات: ' . mysqli_error($db) . '</div>';
    }
}

// پردازش فرم تنظیمات سیستم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_system_settings'])) {
    $max_file_size = intval($_POST['max_file_size']);
    $allowed_file_types = mysqli_real_escape_string($db, $_POST['allowed_file_types']);
    $default_language = mysqli_real_escape_string($db, $_POST['default_language']);
    $registration_open = isset($_POST['registration_open']) ? 'true' : 'false';
    
    // بروزرسانی تنظیمات در دیتابیس
    $update_max_file_size = mysqli_query($db, "UPDATE system_settings SET setting_value = '$max_file_size' WHERE setting_name = 'max_file_size'");
    $update_allowed_file_types = mysqli_query($db, "UPDATE system_settings SET setting_value = '$allowed_file_types' WHERE setting_name = 'allowed_file_types'");
    $update_default_language = mysqli_query($db, "UPDATE system_settings SET setting_value = '$default_language' WHERE setting_name = 'default_language'");
    $update_registration_open = mysqli_query($db, "UPDATE system_settings SET setting_value = '$registration_open' WHERE setting_name = 'registration_open'");
    
    if ($update_max_file_size && $update_allowed_file_types && $update_default_language && $update_registration_open) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "تنظیمات سیستم بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_system_settings', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $update_message = '<div class="alert alert-success">تنظیمات سیستم با موفقیت بروزرسانی شد.</div>';
    } else {
        $update_message = '<div class="alert alert-danger">خطا در بروزرسانی تنظیمات سیستم: ' . mysqli_error($db) . '</div>';
    }
}

// دریافت اطلاعات مدرسه
$school_info_query = mysqli_query($db, "SELECT * FROM school_info WHERE id = 1");
$school_info = mysqli_fetch_assoc($school_info_query);

// دریافت تنظیمات سیستم
$settings = [];
$settings_query = mysqli_query($db, "SELECT * FROM system_settings");
while ($row = mysqli_fetch_assoc($settings_query)) {
    $settings[$row['setting_name']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنظیمات عمومی - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php echo $update_message; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>اطلاعات مدرسه</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">نام مدرسه (فارسی)</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($school_info['name']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_en">نام مدرسه (انگلیسی)</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" value="<?php echo htmlspecialchars($school_info['name_en']); ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">آدرس (فارسی)</label>
                                            <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($school_info['address']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_en">آدرس (انگلیسی)</label>
                                            <textarea class="form-control" id="address_en" name="address_en" rows="3"><?php echo htmlspecialchars($school_info['address_en']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">شماره تلفن</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($school_info['phone']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">ایمیل</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($school_info['email']); ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website">وب‌سایت</label>
                                            <input type="text" class="form-control" id="website" name="website" value="<?php echo htmlspecialchars($school_info['website']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location_map">کد Google Maps</label>
                                            <textarea class="form-control" id="location_map" name="location_map" rows="3"><?php echo htmlspecialchars($school_info['location_map']); ?></textarea>
                                            <small class="form-text text-muted">کد iframe نقشه Google Maps را در اینجا قرار دهید.</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="facebook">فیسبوک</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo htmlspecialchars($school_info['facebook']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="twitter">توییتر</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo htmlspecialchars($school_info['twitter']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="instagram">اینستاگرام</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo htmlspecialchars($school_info['instagram']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="youtube">یوتیوب</label>
                                            <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo htmlspecialchars($school_info['youtube']); ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="linkedin">لینکدین</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($school_info['linkedin']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="logo">لوگو</label>
                                            <input type="file" class="form-control" id="logo" name="logo">
                                            <input type="hidden" name="current_logo_url" value="<?php echo htmlspecialchars($school_info['logo_url']); ?>">
                                            <?php if (!empty($school_info['logo_url'])): ?>
                                                <div class="mt-2">
                                                    <img src="../assets/Media/logo/<?php echo $school_info['logo_url']; ?>" alt="School Logo" style="max-height: 50px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="favicon">فاویکون</label>
                                            <input type="file" class="form-control" id="favicon" name="favicon">
                                            <input type="hidden" name="current_favicon_url" value="<?php echo htmlspecialchars($school_info['favicon_url']); ?>">
                                            <?php if (!empty($school_info['favicon_url'])): ?>
                                                <div class="mt-2">
                                                    <img src="../assets/Media/logo/<?php echo $school_info['favicon_url']; ?>" alt="Favicon" style="max-height: 30px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="about">درباره ما (فارسی)</label>
                                            <textarea class="form-control" id="about" name="about" rows="5"><?php echo htmlspecialchars($school_info['about']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="about_en">درباره ما (انگلیسی)</label>
                                            <textarea class="form-control" id="about_en" name="about_en" rows="5"><?php echo htmlspecialchars($school_info['about_en']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" name="update_school_info" class="btn btn-primary">ذخیره تغییرات</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>تنظیمات سیستم</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="max_file_size">حداکثر اندازه فایل (مگابایت)</label>
                                            <input type="number" class="form-control" id="max_file_size" name="max_file_size" value="<?php echo htmlspecialchars($settings['max_file_size']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="allowed_file_types">پسوندهای مجاز (با کاما جدا کنید)</label>
                                            <input type="text" class="form-control" id="allowed_file_types" name="allowed_file_types" value="<?php echo htmlspecialchars($settings['allowed_file_types']); ?>">
                                            <small class="form-text text-muted">مثال: jpeg,jpg,png,pdf</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="default_language">زبان پیش‌فرض</label>
                                            <select class="form-select" id="default_language" name="default_language">
                                                <option value="fa" <?php echo ($settings['default_language'] == 'fa') ? 'selected' : ''; ?>>فارسی</option>
                                                <option value="en" <?php echo ($settings['default_language'] == 'en') ? 'selected' : ''; ?>>انگلیسی</option>
                                                <option value="ar" <?php echo ($settings['default_language'] == 'ar') ? 'selected' : ''; ?>>عربی</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-check-label">وضعیت ثبت‌نام</label>
                                            <div class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" id="registration_open" name="registration_open" <?php echo ($settings['registration_open'] == 'true') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="registration_open">ثبت‌نام فعال است</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" name="update_system_settings" class="btn btn-primary">ذخیره تنظیمات</button>
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
</body>
</html>