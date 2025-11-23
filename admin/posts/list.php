<?php 
require_once '../config/config.php';

// بررسی دسترسی ادمین
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ".admin_url('login.php'));
    exit();  
}

// حذف پست اگر درخواست شده باشد
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $post_id = intval($_GET['delete']);
    
    // ابتدا بررسی کنید آیا این پست وجود دارد
    $check_post = mysqli_query($db, "SELECT main_image, image1, image2 FROM post WHERE id = $post_id");
    
    if(mysqli_num_rows($check_post) > 0) {
        $post_data = mysqli_fetch_assoc($check_post);
        
        // حذف تصاویر مرتبط با پست
        $image_paths = [
            $post_data['main_image'],
            $post_data['image1'],
            $post_data['image2']
        ];
        
        foreach($image_paths as $path) {
            if(!empty($path)) {
                $full_path = '../../assets/images/blog/' . $path;
                if(file_exists($full_path)) {
                    unlink($full_path);
                }
            }
        }
        
        // حذف پست از دیتابیس
        mysqli_query($db, "DELETE FROM post WHERE id = $post_id");
        
        // ثبت فعالیت
        $admin_id = $_SESSION['admin_id'] ?? 0;
        $log_description = "پست با شناسه $post_id حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
                         VALUES ($admin_id, 'post_deleted', '$log_description', '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}')");
        
        // نمایش پیام موفقیت
        $success_message = "پست با موفقیت حذف شد";
    }
}

// مدیریت فیلترها و جستجو
$where_clause = "1=1";
$search_term = '';
$category_filter = '';
$date_from = '';
$date_to = '';

// جستجو
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = mysqli_real_escape_string($db, $_GET['search']);
    $where_clause .= " AND (p.title LIKE '%$search_term%' OR p.title_en LIKE '%$search_term%' OR p.content1 LIKE '%$search_term%')";
}

// فیلتر دسته‌بندی
if(isset($_GET['category']) && is_numeric($_GET['category'])) {
    $category_filter = intval($_GET['category']);
    $where_clause .= " AND p.category_id = $category_filter";
}

// فیلتر تاریخ
if(isset($_GET['date_from']) && !empty($_GET['date_from'])) {
    $date_from = mysqli_real_escape_string($db, $_GET['date_from']);
    $where_clause .= " AND p.publish_date >= '$date_from 00:00:00'";
}

if(isset($_GET['date_to']) && !empty($_GET['date_to'])) {
    $date_to = mysqli_real_escape_string($db, $_GET['date_to']);
    $where_clause .= " AND p.publish_date <= '$date_to 23:59:59'";
}

// صفحه‌بندی
$items_per_page = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $items_per_page;

// دریافت تعداد کل پست‌ها برای صفحه‌بندی
$total_query = mysqli_query($db, "SELECT COUNT(*) as total FROM post p WHERE $where_clause");
$total_items = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_items / $items_per_page);

// دریافت پست‌ها با صفحه‌بندی
$posts_query = mysqli_query($db, "
    SELECT p.*, c.category_name 
    FROM post p
    LEFT JOIN categories c ON p.category_id = c.category_id
    WHERE $where_clause
    ORDER BY p.publish_date DESC
    LIMIT $offset, $items_per_page
");

// دریافت تمام دسته‌بندی‌ها برای فیلتر
$categories_query = mysqli_query($db, "SELECT * FROM categories ORDER BY category_name");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت اخبار و مقالات - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <style>
        .post-thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .filter-card {
            border-radius: 10px;
            background: #f8f9fa;
            border: none;
            box-shadow: 0 0.25rem 0.375rem rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.85rem;
        }
        
        .content-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .badge-views {
            background-color: #e9ecef;
            color: #495057;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 30px;
        }
        
        .table thead th {
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .table tbody td {
            vertical-align: middle;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
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
            background-color: #2cc997;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            flex-shrink: 0;
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
        
        .truncate-text {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-active {
            background-color: rgba(46, 196, 182, 0.1);
            color: #2ec4b6;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-row {
                flex-direction: column;
                width: 100%;
            }
            
            .filter-row > div {
                margin-bottom: 10px;
                width: 100%;
            }
            
            .truncate-text {
                max-width: 100px;
            }
        }
    </style>
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <!-- Toast Notification -->
            <?php if(isset($success_message)): ?>
            <div class="toast-container">
                <div class="custom-toast show">
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
            
            <!-- Filter Card -->
            <div class="card filter-card">
                <div class="card-body p-3">
                    <form method="GET" action="">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label mb-1">جستجو</label>
                                <input type="text" class="form-control" name="search" placeholder="جستجو..." value="<?php echo htmlspecialchars($search_term); ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">دسته‌بندی</label>
                                <select class="form-select" name="category" style="font-family:'estedad';font-size: 75%;">
                                    <option value="">همه دسته‌بندی‌ها</option>
                                    <?php mysqli_data_seek($categories_query, 0); ?>
                                    <?php while($category = mysqli_fetch_assoc($categories_query)): ?>
                                    <option value="<?php echo $category['category_id']; ?>" <?php echo ($category_filter == $category['category_id']) ? 'selected' : ''; ?>>
                                        <?php echo $category['category_name']; ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">از تاریخ</label>
                                <input type="date" class="form-control" name="date_from" value="<?php echo $date_from; ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label mb-1">تا تاریخ</label>
                                <input type="date" class="form-control" name="date_to" value="<?php echo $date_to; ?>">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-3">
                                        <i class="fas fa-search me-1"></i> فیلتر
                                    </button>
                                    <a href="<?php echo admin_url('posts/list.php'); ?>" class="btn btn-outline-secondary px-3">
                                        <i class="fas fa-redo me-1"></i> بازنشانی
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Main Content Card -->
            <div class="card">
                <div class="card-header p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">مدیریت اخبار و مقالات</h5>
                        <p class="text-sm mb-0">
                            مدیریت و ویرایش تمام پست‌ها، اخبار و مقالات سایت
                        </p>
                    </div>
                    <a href="<?php echo admin_url('posts/add.php'); ?>" class="btn btn-sm bg-gradient-dark mb-0">
                        <i class="fas fa-plus-circle me-1" aria-hidden="true"></i> افزودن مطلب جدید
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if (mysqli_num_rows($posts_query) > 0): ?>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" id="postsTable">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تصویر</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عنوان</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">دسته‌بندی</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاریخ انتشار</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">بازدید</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($post = mysqli_fetch_assoc($posts_query)): ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if(!empty($post['main_image']) && file_exists('../../assets/images/blog/' . $post['main_image'])): ?>
                                            <img src="../../assets/images/blog/<?php echo $post['main_image']; ?>" class="post-thumbnail" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                        <?php else: ?>
                                            <div class="avatar avatar-sm rounded-circle bg-gradient-secondary">
                                                <i class="fas fa-image text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm truncate-text" title="<?php echo htmlspecialchars($post['title']); ?>">
                                                <?php echo htmlspecialchars($post['title']); ?>
                                            </h6>
                                            <p class="text-xs text-secondary mb-0 truncate-text" title="<?php echo htmlspecialchars($post['title_en']); ?>">
                                                <?php echo htmlspecialchars($post['title_en']); ?>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <?php echo htmlspecialchars($post['category_name'] ?? 'بدون دسته‌بندی'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php echo date('Y/m/d H:i', strtotime($post['publish_date'])); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-views">
                                            <i class="far fa-eye me-1"></i>
                                            <?php echo number_format($post['views']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo admin_url('posts/edit.php?id=' . $post['id']); ?>" class="btn btn-sm btn-info action-btn">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger action-btn delete-post" data-id="<?php echo $post['id']; ?>" data-title="<?php echo htmlspecialchars($post['title']); ?>">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </a>
                                        <a href="<?php echo site_url('post.php?id=' . $post['id']); ?>" target="_blank" class="btn btn-sm btn-secondary action-btn">
                                            <i class="fas fa-external-link-alt"></i> نمایش
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <?php if($total_pages > 1): ?>
                    <div class="row mt-4">
                        <div class="col d-flex justify-content-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <?php if($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search_term); ?>&category=<?php echo $category_filter; ?>&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    
                                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_term); ?>&category=<?php echo $category_filter; ?>&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                    <?php endfor; ?>
                                    
                                    <?php if($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search_term); ?>&category=<?php echo $category_filter; ?>&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-newspaper text-muted fa-4x"></i>
                        </div>
                        <h5>هیچ پستی یافت نشد</h5>
                        <p class="text-muted">می‌توانید با کلیک بر روی دکمه «افزودن مطلب جدید» اولین پست خود را ایجاد کنید.</p>
                        <a href="<?php echo admin_url('posts/add.php'); ?>" class="btn btn-sm bg-gradient-dark mt-2">
                            <i class="fas fa-plus-circle me-1" aria-hidden="true"></i> افزودن مطلب جدید
                        </a>
                        <?php if(!empty($search_term) || !empty($category_filter) || !empty($date_from) || !empty($date_to)): ?>
                        <div class="mt-3">
                            <a href="<?php echo admin_url('posts/list.php'); ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-redo me-1"></i> پاک کردن فیلترها
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
                    <p>آیا از حذف این پست اطمینان دارید؟</p>
                    <p class="text-danger">عنوان: <span id="postTitleToDelete"></span></p>
                    <p class="text-muted small">توجه: این عملیات غیرقابل بازگشت است و تمام داده‌ها و تصاویر مرتبط با این پست حذف خواهند شد.</p>
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
        $('.delete-post').on('click', function(e) {
            e.preventDefault();
            var postId = $(this).data('id');
            var postTitle = $(this).data('title');
            
            $('#postTitleToDelete').text(postTitle);
            $('#confirmDeleteBtn').attr('href', 'list.php?delete=' + postId);
            
            $('#deleteModal').modal('show');
        });
        
        // اینیشیالایز دیتاتیبل
        $(document).ready(function() {
            $('.custom-toast').addClass('show');
            setTimeout(function() {
                $('.custom-toast').removeClass('show');
            }, 4000);
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