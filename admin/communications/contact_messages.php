<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// Pagination settings
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Handle message deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($db, "DELETE FROM contact_us WHERE id = $delete_id");
    
    // Log activity
    $user_id = $_SESSION['admin_id'] ?? 0;
    $log_description = "پیام شماره $delete_id از بخش تماس با ما حذف شد";
    mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_message', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
    
    header("Location: contact_messages.php?deleted=1");
    exit();
}

// Get messages with pagination
$query = "SELECT * FROM contact_us ORDER BY submit_date DESC LIMIT $offset, $limit";
$result = mysqli_query($db, $query);

// Count total messages for pagination
$total_query = mysqli_query($db, "SELECT COUNT(*) as total FROM contact_us");
$total_row = mysqli_fetch_assoc($total_query);
$total_pages = ceil($total_row['total'] / $limit);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پیام‌های تماس با ما - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .message-card {
            transition: all 0.3s ease;
        }
        .message-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .message-meta {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .message-content {
            white-space: pre-line;
        }
        .message-actions {
            margin-top: 15px;
            text-align: left;
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
                            <h6>پیام‌های تماس با ما</h6>
                            <?php if(isset($_GET['deleted'])): ?>
                            <div class="alert alert-success text-white" role="alert">
                                پیام مورد نظر با موفقیت حذف شد.
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <?php if(mysqli_num_rows($result) > 0): ?>
                                <div class="row p-3">
                                    <?php while($message = mysqli_fetch_assoc($result)): ?>
                                        <div class="col-md-6 mb-4">
                                            <div class="card message-card">
                                                <div class="card-body">
                                                    <div class="message-header">
                                                        <h5 class="card-title"><?php echo htmlspecialchars($message['subject'] ?: 'بدون موضوع'); ?></h5>
                                                        <span class="badge bg-primary"><?php echo date('Y/m/d H:i', strtotime($message['submit_date'])); ?></span>
                                                    </div>
                                                    <div class="message-meta">
                                                        <span><i class="fas fa-user ml-1"></i> <?php echo htmlspecialchars($message['name']); ?></span>
                                                        <span class="mx-2">|</span>
                                                        <span><i class="fas fa-envelope ml-1"></i> <?php echo htmlspecialchars($message['email']); ?></span>
                                                        <?php if(!empty($message['phone'])): ?>
                                                            <span class="mx-2">|</span>
                                                            <span><i class="fas fa-phone ml-1"></i> <?php echo htmlspecialchars($message['phone']); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="message-content mt-3">
                                                        <?php echo htmlspecialchars($message['message']); ?>
                                                    </div>
                                                    <div class="message-actions">
                                                        <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-reply"></i> پاسخ
                                                        </a>
                                                        <a href="contact_messages.php?delete=<?php echo $message['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این پیام اطمینان دارید؟');">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                
                                <!-- Pagination -->
                                <?php if($total_pages > 1): ?>
                                <div class="d-flex justify-content-center mt-4">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?php if($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            
                                            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            
                                            <?php if($page < $total_pages): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                                <?php endif; ?>
                                
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                    <p>هیچ پیامی در سیستم ثبت نشده است.</p>
                                </div>
                            <?php endif; ?>
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