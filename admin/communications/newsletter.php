<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// Handle subscriber deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($db, "DELETE FROM newsletter_subscribers WHERE id = $delete_id");
    
    // Log activity
    $user_id = $_SESSION['admin_id'] ?? 0;
    $action_description = "مشترک خبرنامه با شناسه $delete_id حذف شد";
    mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_subscriber', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
    
    header("Location: newsletter.php?deleted=1");
    exit();
}

// Handle subscriber status toggle
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $toggle_id = intval($_GET['toggle']);
    $subscriber = mysqli_fetch_assoc(mysqli_query($db, "SELECT status FROM newsletter_subscribers WHERE id = $toggle_id"));
    
    if ($subscriber) {
        $new_status = ($subscriber['status'] == 'active') ? 'inactive' : 'active';
        mysqli_query($db, "UPDATE newsletter_subscribers SET status = '$new_status', updated_at = NOW() WHERE id = $toggle_id");
        
        // Log activity
        $user_id = $_SESSION['admin_id'] ?? 0;
        $status_text = ($new_status == 'active') ? 'فعال' : 'غیرفعال';
        $action_description = "وضعیت مشترک خبرنامه با شناسه $toggle_id به $status_text تغییر کرد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'toggle_subscriber', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        header("Location: newsletter.php?toggled=1");
        exit();
    }
}

// Handle bulk email sending
$send_result = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_newsletter'])) {
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $message = mysqli_real_escape_string($db, $_POST['message']);
    
    if (empty($subject) || empty($message)) {
        $send_result = 'error';
    } else {
        // Get all active subscribers
        $subscribers = mysqli_query($db, "SELECT email FROM newsletter_subscribers WHERE status = 'active'");
        $sent_count = 0;
        
        while ($subscriber = mysqli_fetch_assoc($subscribers)) {
            // In a real application, we'd use a proper email sending library
            // Here we'll just log the emails that would be sent
            $subscriber_email = $subscriber['email'];
            mysqli_query($db, "INSERT INTO sent_emails (recipient, subject, body, status) VALUES ('$subscriber_email', '$subject', '$message', 'sent')");
            $sent_count++;
        }
        
        // Log activity
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "خبرنامه با موضوع '$subject' به $sent_count مشترک ارسال شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'send_newsletter', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $send_result = 'success';
    }
}

// Pagination settings
$limit = 15;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Handle search
$search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
$search_condition = '';
if (!empty($search)) {
    $search_condition = "WHERE email LIKE '%$search%'";
}

// Get subscribers with pagination and search
$query = "SELECT * FROM newsletter_subscribers $search_condition ORDER BY created_at DESC LIMIT $offset, $limit";
$result = mysqli_query($db, $query);

// Count total subscribers for pagination
$total_query = mysqli_query($db, "SELECT COUNT(*) as total FROM newsletter_subscribers $search_condition");
$total_row = mysqli_fetch_assoc($total_query);
$total_pages = ceil($total_row['total'] / $limit);

// Get subscriber stats
$stats = [
    'total' => mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM newsletter_subscribers"))['count'],
    'active' => mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM newsletter_subscribers WHERE status = 'active'"))['count'],
    'inactive' => mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as count FROM newsletter_subscribers WHERE status = 'inactive'"))['count']
];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت خبرنامه - مجتمع آموزشی سلمان</title>
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
            <!-- Notification messages -->
            <?php if(isset($_GET['deleted'])): ?>
            <div class="alert alert-success text-white">
                مشترک مورد نظر با موفقیت حذف شد.
            </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['toggled'])): ?>
            <div class="alert alert-success text-white">
                وضعیت مشترک با موفقیت تغییر کرد.
            </div>
            <?php endif; ?>
            
            <?php if($send_result == 'success'): ?>
            <div class="alert alert-success text-white">
                خبرنامه با موفقیت به مشترکین ارسال شد.
            </div>
            <?php elseif($send_result == 'error'): ?>
            <div class="alert alert-danger text-white">
                لطفاً موضوع و متن خبرنامه را وارد کنید.
            </div>
            <?php endif; ?>
            
            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">کل مشترکین</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['total']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">مشترکین فعال</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['active']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fas fa-user-check text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">مشترکین غیرفعال</p>
                                        <h5 class="font-weight-bolder"><?php echo number_format($stats['inactive']); ?></h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="fas fa-user-times text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Subscribers List -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h6>لیست مشترکین خبرنامه</h6>
                                <form class="d-flex align-items-center" method="get">
                                    <input type="text" name="search" placeholder="جستجو بر اساس ایمیل..." class="form-control form-control-sm ms-2" value="<?php echo htmlspecialchars($search); ?>">
                                    <button type="submit" class="btn btn-sm btn-primary">جستجو</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ایمیل</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاریخ عضویت</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(mysqli_num_rows($result) > 0): ?>
                                            <?php while($subscriber = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($subscriber['email']); ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-sm <?php echo ($subscriber['status'] == 'active') ? 'bg-gradient-success' : 'bg-gradient-secondary'; ?>">
                                                            <?php echo ($subscriber['status'] == 'active') ? 'فعال' : 'غیرفعال'; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo date('Y/m/d H:i', strtotime($subscriber['created_at'])); ?></p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="newsletter.php?toggle=<?php echo $subscriber['id']; ?>" class="btn btn-sm btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            <i class="fas fa-sync-alt"></i> تغییر وضعیت
                                                        </a>
                                                        <a href="newsletter.php?delete=<?php echo $subscriber['id']; ?>" class="btn btn-sm btn-danger font-weight-bold text-xs" onclick="return confirm('آیا از حذف این مشترک اطمینان دارید؟');" data-toggle="tooltip" data-original-title="Delete user">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4">هیچ مشترکی یافت نشد.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <?php if($total_pages > 1): ?>
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php if($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        
                                        <?php if($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" aria-label="Next">
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
                
                <!-- Send Newsletter Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>ارسال خبرنامه</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="subject">موضوع</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="موضوع خبرنامه را وارد کنید">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="message">متن پیام</label>
                                    <textarea class="form-control" id="message" name="message" rows="8" placeholder="متن خبرنامه را وارد کنید"></textarea>
                                </div>
                                <div class="form-group mt-4 d-flex justify-content-between align-items-center">
                                    <span class="text-sm text-muted">به <?php echo number_format($stats['active']); ?> مشترک فعال ارسال خواهد شد.</span>
                                    <button type="submit" name="send_newsletter" class="btn btn-primary">ارسال خبرنامه</button>
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