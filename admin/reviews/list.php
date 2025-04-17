<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// حذف نظر
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $review_id = $_GET['delete'];
    
    // ثبت در لاگ سیستم
    $log_description = "نظر با شناسه $review_id حذف شد";
    mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
        ('{$_SESSION['admin_id']}', 'delete_review', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
    
    $delete_query = mysqli_query($db, "DELETE FROM reviews WHERE id = $review_id");
    
    if ($delete_query) {
        $success_message = "نظر با موفقیت حذف شد.";
    } else {
        $error_message = "خطا در حذف نظر: " . mysqli_error($db);
    }
}

// دریافت لیست نظرات
$query = "SELECT * FROM reviews ORDER BY id DESC";
$reviews = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت نظرات - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .review-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        
        .review-preview {
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .action-btn {
            margin: 0 3px;
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
                                <h6 class="mb-0">مدیریت نظرات و تجربیات</h6>
                                <a href="add.php" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> افزودن نظر جدید
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body px-0 pt-0 pb-2">
                            <?php if(isset($success_message)): ?>
                                <div class="alert alert-success text-white m-3"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                            
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger text-white m-3"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شناسه</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تصویر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">سمت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">متن نظر</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(mysqli_num_rows($reviews) > 0): ?>
                                            <?php while($review = mysqli_fetch_assoc($reviews)): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $review['id']; ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if(!empty($review['image_url']) && file_exists("../assets/images/Staff/" . $review['image_url'])): ?>
                                                            <img src="../assets/images/Staff/<?php echo $review['image_url']; ?>" class="review-image" alt="<?php echo $review['name_fa']; ?>">
                                                        <?php else: ?>
                                                            <img src="../assets/Media/logo/logo.png" class="review-image" alt="تصویر پیش‌فرض">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo $review['name_fa']; ?></h6>
                                                                <p class="text-xs text-secondary mb-0"><?php echo $review['name_en']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $review['position_fa']; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $review['position_en']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0 review-preview"><?php echo $review['review_fa']; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="edit.php?id=<?php echo $review['id']; ?>" class="btn btn-sm btn-info action-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="list.php?delete=<?php echo $review['id']; ?>" 
                                                           class="btn btn-sm btn-danger action-btn" 
                                                           onclick="return confirm('آیا از حذف این نظر اطمینان دارید؟')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">هیچ نظری یافت نشد</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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