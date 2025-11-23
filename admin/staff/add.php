<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// پردازش فرم افزودن کارمند
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name_fa = mysqli_real_escape_string($db, $_POST['name_fa']);
    $name_en = mysqli_real_escape_string($db, $_POST['name_en']);
    $position_fa = mysqli_real_escape_string($db, $_POST['position_fa']);
    $position_en = mysqli_real_escape_string($db, $_POST['position_en']);
    $education_fa = mysqli_real_escape_string($db, $_POST['education_fa']);
    $education_en = mysqli_real_escape_string($db, $_POST['education_en']);
    $bio = mysqli_real_escape_string($db, $_POST['bio']);
    
    // آپلود تصویر
    $photo_url = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['photo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = 'staff_' . time() . '.' . $ext;
            $upload_dir = '../assets/images/Staff/';
            
            // اطمینان از وجود دایرکتوری
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $upload_path = $upload_dir . $new_name;
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                $photo_url = $new_name;
            }
        }
    }
    
    // درج اطلاعات در دیتابیس
    $query = "INSERT INTO staff (name_fa, name_en, position_fa, position_en, education_fa, education_en, bio, photo_url) 
              VALUES ('$name_fa', '$name_en', '$position_fa', '$position_en', '$education_fa', '$education_en', '$bio', '$photo_url')";
    
    if (mysqli_query($db, $query)) {
        $staff_id = mysqli_insert_id($db);
        
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "کارمند جدید $name_fa با سمت $position_fa اضافه شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'add_staff', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">کارمند جدید با موفقیت افزوده شد.</div>';
        
        // هدایت به صفحه لیست کارکنان پس از چند ثانیه
        header("refresh:2;url=list.php");
    } else {
        $message = '<div class="alert alert-danger">خطا در ثبت اطلاعات: ' . mysqli_error($db) . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن کارمند جدید - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .photo-preview {
            width: 200px;
            height: 200px;
            border-radius: 5px;
            overflow: hidden;
            margin: 10px auto;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .photo-preview .placeholder {
            font-size: 36px;
            color: #aaa;
        }
    </style>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php echo $message; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6>افزودن کارمند جدید</h6>
                                <a href="list.php" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-right me-2"></i> بازگشت به لیست
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_fa">نام (فارسی) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name_fa" name="name_fa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_en">نام (انگلیسی)</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position_fa">سمت (فارسی) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="position_fa" name="position_fa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position_en">سمت (انگلیسی)</label>
                                            <input type="text" class="form-control" id="position_en" name="position_en">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_fa">تحصیلات (فارسی)</label>
                                            <input type="text" class="form-control" id="education_fa" name="education_fa">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_en">تحصیلات (انگلیسی)</label>
                                            <input type="text" class="form-control" id="education_en" name="education_en">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bio">بیوگرافی</label>
                                            <textarea class="form-control" id="bio" name="bio" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo">تصویر</label>
                                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(this);">
                                            <small class="form-text text-muted">حداکثر حجم فایل: 2 مگابایت - فرمت‌های مجاز: jpg, jpeg, png, gif</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <div class="photo-preview" id="photoPreview">
                                            <span class="placeholder"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">ثبت کارمند</button>
                                        <a href="list.php" class="btn btn-secondary">انصراف</a>
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
        // پیش‌نمایش تصویر
        function previewImage(input) {
            const preview = document.getElementById('photoPreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = `<span class="placeholder"><i class="fas fa-user-tie"></i></span>`;
            }
        }
    </script>
</body>
</html>