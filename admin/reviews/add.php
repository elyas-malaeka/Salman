<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// اضافه کردن نظر جدید
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_fa = mysqli_real_escape_string($db, $_POST['name_fa']);
    $name_en = mysqli_real_escape_string($db, $_POST['name_en']);
    $position_fa = mysqli_real_escape_string($db, $_POST['position_fa']);
    $position_en = mysqli_real_escape_string($db, $_POST['position_en']);
    $review_fa = mysqli_real_escape_string($db, $_POST['review_fa']);
    $review_en = mysqli_real_escape_string($db, $_POST['review_en']);
    
    $image_url = null;
    
    // آپلود تصویر
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png');
        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if(in_array(strtolower($ext), $allowed)) {
            $new_filename = time() . '_' . $filename;
            $upload_path = "../assets/images/Staff/" . $new_filename;
            
            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_url = $new_filename;
            } else {
                $error_message = "خطا در آپلود تصویر!";
            }
        } else {
            $error_message = "فقط فایل‌های با پسوند jpg, jpeg و png مجاز هستند.";
        }
    }
    
    if(!isset($error_message)) {
        $query = "INSERT INTO reviews (name_fa, name_en, position_fa, position_en, review_fa, review_en, image_url) 
                  VALUES ('$name_fa', '$name_en', '$position_fa', '$position_en', '$review_fa', '$review_en', " . 
                  ($image_url ? "'$image_url'" : "NULL") . ")";
        
        $result = mysqli_query($db, $query);
        
        if($result) {
            // ثبت در لاگ سیستم
            $log_description = "نظر جدید با نام $name_fa اضافه شد";
            mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
                ('{$_SESSION['admin_id']}', 'add_review', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
            
            header("Location: list.php");
            exit();
        } else {
            $error_message = "خطا در ثبت اطلاعات: " . mysqli_error($db);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن نظر جدید - مجتمع آموزشی سلمان</title>
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
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">افزودن نظر جدید</h6>
                                <a href="list.php" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-right"></i> بازگشت به لیست
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger text-white"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_fa" class="form-control-label">نام (فارسی)</label>
                                            <input type="text" class="form-control" id="name_fa" name="name_fa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_en" class="form-control-label">نام (انگلیسی)</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position_fa" class="form-control-label">سمت (فارسی)</label>
                                            <input type="text" class="form-control" id="position_fa" name="position_fa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position_en" class="form-control-label">سمت (انگلیسی)</label>
                                            <input type="text" class="form-control" id="position_en" name="position_en" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="review_fa" class="form-control-label">متن نظر (فارسی)</label>
                                            <textarea class="form-control" id="review_fa" name="review_fa" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="review_en" class="form-control-label">متن نظر (انگلیسی)</label>
                                            <textarea class="form-control" id="review_en" name="review_en" rows="4" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="form-control-label">تصویر</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <small class="form-text text-muted">فایل‌های jpg, jpeg و png با حداکثر حجم 2MB مجاز هستند.</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary">ثبت نظر</button>
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
</body>
</html>