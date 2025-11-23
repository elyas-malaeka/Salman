<?php 
require_once '../config/config.php';

// بررسی دسترسی ادمین
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ".admin_url('login.php'));
    exit();  
}

// حذف دسته‌بندی
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $category_id = intval($_GET['delete']);
    
    // بررسی آیا پستی با این دسته‌بندی وجود دارد
    $check_posts = mysqli_query($db, "SELECT COUNT(*) as post_count FROM post WHERE category_id = $category_id");
    $posts_count = mysqli_fetch_assoc($check_posts)['post_count'];
    
    if($posts_count > 0) {
        $error_message = "این دسته‌بندی دارای $posts_count مطلب است و نمی‌توان آن را حذف کرد.";
    } else {
        // حذف دسته‌بندی
        mysqli_query($db, "DELETE FROM categories WHERE category_id = $category_id");
        
        // ثبت فعالیت
        $admin_id = $_SESSION['admin_id'] ?? 0;
        $log_description = "دسته‌بندی با شناسه $category_id حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
                        VALUES ($admin_id, 'category_deleted', '$log_description', '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}')");
        
        $success_message = "دسته‌بندی با موفقیت حذف شد";
    }
}

// جستجو
$search = '';
$where_clause = "1=1";

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    $where_clause .= " AND (category_name LIKE '%$search%' OR category_name_en LIKE '%$search%')";
}

// دریافت لیست دسته‌بندی‌ها
$categories_query = mysqli_query($db, "
    SELECT c.*, COUNT(p.id) as post_count 
    FROM categories c
    LEFT JOIN post p ON c.category_id = p.category_id
    WHERE $where_clause
    GROUP BY c.category_id
    ORDER BY c.category_name
");

// دریافت تعداد کل دسته‌بندی‌ها
$total_query = mysqli_query($db, "SELECT COUNT(*) as total FROM categories WHERE $where_clause");
$total_categories = mysqli_fetch_assoc($total_query)['total'];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته‌بندی‌ها - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        .filter-card {
            border-radius: 10px;
            background: #f8f9fa;
            border: none;
            box-shadow: 0 0.25rem 0.375rem rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .category-badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.7rem;
            border-radius: 30px;
        }
        
        .posts-count {
            display: inline-block;
            min-width: 28px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            background-color: #e9ecef;
            color: #495057;
            font-size: 0.75rem;
            border-radius: 30px;
        }
        
        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.85rem;
        }
        
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        
        .custom-toast {
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            padding: 15px;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }
        
        .custom-toast.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .toast-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            flex-shrink: 0;
        }
        
        .success-toast .toast-icon {
            background-color: #2cc997;
        }
        
        .error-toast .toast-icon {
            background-color: #f5365c;
        }
        
        .toast-icon i {
            color: white;
            font-size: 16px;
        }
        
        .toast-content {
            flex: 1;
        }
        
        .toast-title {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
            margin-bottom: 5px;
        }
        
        .toast-text {
            font-size: 0.875rem;
            color: #666;
        }
        
        .no-data-message {
            text-align: center;
            padding: 40px 0;
        }
        
        .no-data-message i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <!-- Toast Notifications -->
            <?php if(isset($success_message)): ?>
            <div class="toast-container">
                <div class="custom-toast success-toast show">
                    <div class="toast-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">عملیات موفق</div>
                        <div class="toast-text"><?php echo $success_message; ?></div>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('.custom-toast').classList.remove('show');
                }, 4000);
            </script>
            <?php endif; ?>
            
            <?php if(isset($error_message)): ?>
            <div class="toast-container">
                <div class="custom-toast error-toast show">
                    <div class="toast-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">خطا</div>
                        <div class="toast-text"><?php echo $error_message; ?></div>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('.custom-toast').classList.remove('show');
                }, 4000);
            </script>
            <?php endif; ?>
            
            <!-- Filter Card -->
            <div class="card filter-card">
                <div class="card-body p-3">
                    <form method="GET" action="">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label mb-1">جستجو</label>
                                <input type="text" class="form-control" name="search" placeholder="جستجو در نام دسته‌بندی..." value="<?php echo htmlspecialchars($search); ?>">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-3">
                                        <i class="fas fa-search me-1"></i> جستجو
                                    </button>
                                    <a href="<?php echo admin_url('categories/list.php'); ?>" class="btn btn-outline-secondary px-3">
                                        <i class="fas fa-redo me-1"></i> بازنشانی
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-end justify-content-end">
                                <a href="<?php echo admin_url('categories/manage.php'); ?>" class="btn btn-sm bg-gradient-dark mb-0">
                                    <i class="fas fa-plus-circle me-1" aria-hidden="true"></i> افزودن دسته‌بندی جدید
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Main Content Card -->
            <div class="card">
                <div class="card-header p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-0">مدیریت دسته‌بندی‌ها</h5>
                            <p class="text-sm mb-0">
                                مدیریت دسته‌بندی‌های سایت برای مطالب و اخبار
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="text-sm text-muted">تعداد کل: <?php echo $total_categories; ?> دسته‌بندی</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <?php if(mysqli_num_rows($categories_query) > 0): ?>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شناسه</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام دسته‌بندی</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام انگلیسی</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تعداد مطالب</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($category = mysqli_fetch_assoc($categories_query)): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?php echo $category['category_id']; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <span class="category-badge bg-light text-dark">
                                                    <?php echo htmlspecialchars($category['category_name']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php echo htmlspecialchars($category['category_name_en']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="posts-count">
                                            <?php echo $category['post_count']; ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="<?php echo admin_url('categories/manage.php?id=' . $category['category_id']); ?>" class="btn btn-sm btn-info action-btn">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <?php if($category['post_count'] == 0): ?>
                                        <a href="#" class="btn btn-sm btn-danger action-btn delete-category" data-id="<?php echo $category['category_id']; ?>" data-name="<?php echo htmlspecialchars($category['category_name']); ?>">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </a>
                                        <?php else: ?>
                                        <button class="btn btn-sm btn-danger action-btn" disabled title="دسته‌بندی دارای مطلب است و قابل حذف نیست">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="no-data-message">
                        <i class="fas fa-tag"></i>
                        <h5>هیچ دسته‌بندی یافت نشد</h5>
                        <p class="text-muted">می‌توانید با کلیک بر روی دکمه «افزودن دسته‌بندی جدید» اولین دسته‌بندی خود را ایجاد کنید.</p>
                        <a href="<?php echo admin_url('categories/manage.php'); ?>" class="btn btn-sm bg-gradient-dark mt-2">
                            <i class="fas fa-plus-circle me-1" aria-hidden="true"></i> افزودن دسته‌بندی جدید
                        </a>
                        <?php if(!empty($search)): ?>
                        <div class="mt-3">
                            <a href="<?php echo admin_url('categories/list.php'); ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-redo me-1"></i> پاک کردن جستجو
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأیید حذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف این دسته‌بندی اطمینان دارید؟</p>
                    <p class="text-danger">نام دسته‌بندی: <span id="categoryNameToDelete"></span></p>
                    <p class="text-muted small">توجه: این عملیات غیرقابل بازگشت است.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">بله، حذف شود</a>
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
        // اسکریپت مدال حذف
        $('.delete-category').on('click', function(e) {
            e.preventDefault();
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');
            
            $('#categoryNameToDelete').text(categoryName);
            $('#confirmDeleteBtn').attr('href', 'list.php?delete=' + categoryId);
            
            $('#deleteModal').modal('show');
        });
        
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