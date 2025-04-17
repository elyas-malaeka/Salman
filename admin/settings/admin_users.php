<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// پردازش افزودن کاربر جدید
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $full_name = mysqli_real_escape_string($db, $_POST['full_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $role_id = intval($_POST['role_id']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    
    // رمزنگاری پسورد
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO admin (username, password, full_name, email, role_id, status) 
              VALUES ('$username', '$hashed_password', '$full_name', '$email', $role_id, '$status')";
    
    if (mysqli_query($db, $query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "کاربر ادمین جدید با نام کاربری $username اضافه شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'add_admin_user', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">کاربر جدید با موفقیت اضافه شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در ثبت کاربر جدید: ' . mysqli_error($db) . '</div>';
    }
}

// پردازش حذف کاربر
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // ابتدا اطلاعات کاربر را برای ثبت در لاگ دریافت می‌کنیم
    $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM admin WHERE id = $id"));
    
    if ($user && mysqli_query($db, "DELETE FROM admin WHERE id = $id")) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "کاربر ادمین {$user['username']} حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_admin_user', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">کاربر مورد نظر با موفقیت حذف شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در حذف کاربر: ' . mysqli_error($db) . '</div>';
    }
}

// پردازش ویرایش کاربر
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_user'])) {
    $id = intval($_POST['user_id']);
    $full_name = mysqli_real_escape_string($db, $_POST['edit_full_name']);
    $email = mysqli_real_escape_string($db, $_POST['edit_email']);
    $role_id = intval($_POST['edit_role_id']);
    $status = mysqli_real_escape_string($db, $_POST['edit_status']);
    
    $update_query = "UPDATE admin SET 
                     full_name = '$full_name',
                     email = '$email',
                     role_id = $role_id,
                     status = '$status',
                     updated_at = NOW()
                     WHERE id = $id";
    
    // اگر پسورد جدید وارد شده باشد، آن را نیز آپدیت کنیم
    if (!empty($_POST['edit_password'])) {
        $password = mysqli_real_escape_string($db, $_POST['edit_password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE admin SET 
                         full_name = '$full_name',
                         email = '$email',
                         password = '$hashed_password',
                         role_id = $role_id,
                         status = '$status',
                         updated_at = NOW()
                         WHERE id = $id";
    }
    
    if (mysqli_query($db, $update_query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "اطلاعات کاربر ادمین با شناسه $id بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_admin_user', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">اطلاعات کاربر با موفقیت بروزرسانی شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در بروزرسانی اطلاعات کاربر: ' . mysqli_error($db) . '</div>';
    }
}

// دریافت لیست کاربران ادمین
$query = "
    SELECT a.*, r.role_name
    FROM admin a
    LEFT JOIN admin_roles r ON a.role_id = r.role_id
    ORDER BY a.id
";
$result = mysqli_query($db, $query);

// دریافت لیست نقش‌ها
$roles_query = mysqli_query($db, "SELECT * FROM admin_roles ORDER BY role_id");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران ادمین - مجتمع آموزشی سلمان</title>
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
            <?php echo $message; ?>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>افزودن کاربر ادمین جدید</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="username">نام کاربری</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="password">رمز عبور</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="full_name">نام و نام خانوادگی</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="email">ایمیل</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="role_id">نقش</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <?php mysqli_data_seek($roles_query, 0); ?>
                                        <?php while($role = mysqli_fetch_assoc($roles_query)): ?>
                                            <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?> (<?php echo $role['role_name_fa']; ?>)</option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="status">وضعیت</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="active">فعال</option>
                                        <option value="inactive">غیرفعال</option>
                                    </select>
                                </div>
                                
                                <div class="text-end mt-4">
                                    <button type="submit" name="add_user" class="btn btn-primary">افزودن کاربر</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>لیست کاربران ادمین</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">کاربر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نقش</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">آخرین ورود</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while($user = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo $user['full_name']; ?></h6>
                                                                <p class="text-xs text-secondary mb-0"><?php echo $user['email']; ?></p>
                                                                <p class="text-xs text-primary mb-0"><?php echo $user['username']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $user['role_name']; ?></p>
                                                    </td>
                                                    <td>
                                                        <?php if ($user['status'] == 'active'): ?>
                                                            <span class="badge badge-sm bg-gradient-success">فعال</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-sm bg-gradient-secondary">غیرفعال</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($user['last_login']): ?>
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo date('Y/m/d H:i', strtotime($user['last_login'])); ?></p>
                                                        <?php else: ?>
                                                            <p class="text-xs text-secondary mb-0">هنوز وارد نشده</p>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <button type="button" class="btn btn-sm btn-info edit-user" 
                                                                data-id="<?php echo $user['id']; ?>"
                                                                data-username="<?php echo $user['username']; ?>"
                                                                data-fullname="<?php echo $user['full_name']; ?>"
                                                                data-email="<?php echo $user['email']; ?>"
                                                                data-role="<?php echo $user['role_id']; ?>"
                                                                data-status="<?php echo $user['status']; ?>">
                                                            <i class="fas fa-edit"></i> ویرایش
                                                        </button>
                                                        <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این کاربر اطمینان دارید؟');">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-4">هیچ کاربری یافت نشد.</td>
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
    
    <!-- مودال ویرایش کاربر -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">ویرایش کاربر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" id="user_id" name="user_id">
                        
                        <div class="form-group">
                            <label for="edit_username">نام کاربری</label>
                            <input type="text" class="form-control" id="edit_username" disabled>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_password">رمز عبور جدید (اگر می‌خواهید تغییر دهید)</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password">
                            <small class="form-text text-muted">اگر نمی‌خواهید رمز عبور را تغییر دهید، این فیلد را خالی بگذارید.</small>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_full_name">نام و نام خانوادگی</label>
                            <input type="text" class="form-control" id="edit_full_name" name="edit_full_name" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_email">ایمیل</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_role_id">نقش</label>
                            <select class="form-select" id="edit_role_id" name="edit_role_id" required>
                                <?php mysqli_data_seek($roles_query, 0); ?>
                                <?php while($role = mysqli_fetch_assoc($roles_query)): ?>
                                    <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?> (<?php echo $role['role_name_fa']; ?>)</option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_status">وضعیت</label>
                            <select class="form-select" id="edit_status" name="edit_status" required>
                                <option value="active">فعال</option>
                                <option value="inactive">غیرفعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" name="edit_user" class="btn btn-primary">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // تنظیم مقادیر مودال ویرایش
        var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
        
        document.querySelectorAll('.edit-user').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var username = this.getAttribute('data-username');
                var fullname = this.getAttribute('data-fullname');
                var email = this.getAttribute('data-email');
                var role = this.getAttribute('data-role');
                var status = this.getAttribute('data-status');
                
                document.getElementById('user_id').value = id;
                document.getElementById('edit_username').value = username;
                document.getElementById('edit_full_name').value = fullname;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role_id').value = role;
                document.getElementById('edit_status').value = status;
                
                editUserModal.show();
            });
        });
    </script>
</body>
</html>