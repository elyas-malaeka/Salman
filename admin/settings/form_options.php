<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// پردازش افزودن آیتم جدید
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_option'])) {
    $option_type = mysqli_real_escape_string($db, $_POST['option_type']);
    $option_value = mysqli_real_escape_string($db, $_POST['option_value']);
    $option_value_fa = mysqli_real_escape_string($db, $_POST['option_value_fa']);
    $display_order = intval($_POST['display_order']);
    $is_default = isset($_POST['is_default']) ? 1 : 0;
    
    $query = "INSERT INTO form_options (option_type, option_value, option_value_fa, display_order, is_default) 
              VALUES ('$option_type', '$option_value', '$option_value_fa', $display_order, $is_default)";
    
    if (mysqli_query($db, $query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "گزینه $option_value ($option_value_fa) برای فیلد $option_type اضافه شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'add_form_option', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">گزینه جدید با موفقیت اضافه شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در ثبت گزینه جدید: ' . mysqli_error($db) . '</div>';
    }
}

// پردازش حذف آیتم
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // ابتدا اطلاعات آیتم را برای ثبت در لاگ دریافت می‌کنیم
    $option = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM form_options WHERE id = $id"));
    
    if ($option && mysqli_query($db, "DELETE FROM form_options WHERE id = $id")) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "گزینه {$option['option_value']} ({$option['option_value_fa']}) از فیلد {$option['option_type']} حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_form_option', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">گزینه مورد نظر با موفقیت حذف شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در حذف گزینه: ' . mysqli_error($db) . '</div>';
    }
}

// پردازش ویرایش آیتم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_option'])) {
    $id = intval($_POST['option_id']);
    $option_value = mysqli_real_escape_string($db, $_POST['edit_option_value']);
    $option_value_fa = mysqli_real_escape_string($db, $_POST['edit_option_value_fa']);
    $display_order = intval($_POST['edit_display_order']);
    $is_default = isset($_POST['edit_is_default']) ? 1 : 0;
    
    $query = "UPDATE form_options SET 
                option_value = '$option_value',
                option_value_fa = '$option_value_fa',
                display_order = $display_order,
                is_default = $is_default
              WHERE id = $id";
    
    if (mysqli_query($db, $query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "گزینه با شناسه $id بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_form_option', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">گزینه مورد نظر با موفقیت ویرایش شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در ویرایش گزینه: ' . mysqli_error($db) . '</div>';
    }
}

// تعیین نوع فیلد برای نمایش
$selected_type = isset($_GET['type']) ? $_GET['type'] : 'nationality';

// گرفتن لیست نوع‌های فیلد موجود
$types_query = mysqli_query($db, "SELECT DISTINCT option_type FROM form_options ORDER BY option_type");
$types = [];
while ($row = mysqli_fetch_assoc($types_query)) {
    $types[] = $row['option_type'];
}

// گرفتن گزینه‌های فیلد انتخاب شده
$options_query = mysqli_query($db, "SELECT * FROM form_options WHERE option_type = '$selected_type' ORDER BY display_order, option_value");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنظیمات فرم‌ها - مجتمع آموزشی سلمان</title>
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
                            <h6>افزودن گزینه جدید</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="option_type">نوع فیلد</label>
                                    <select class="form-select" id="option_type" name="option_type" required>
                                        <?php foreach($types as $type): ?>
                                            <option value="<?php echo $type; ?>" <?php echo ($type == $selected_type) ? 'selected' : ''; ?>><?php echo $type; ?></option>
                                        <?php endforeach; ?>
                                        <option value="new">نوع جدید</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mt-3" id="new_type_div" style="display: none;">
                                    <label for="new_type">نام نوع جدید</label>
                                    <input type="text" class="form-control" id="new_type" name="new_type" placeholder="مثال: education">
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="option_value">مقدار (انگلیسی)</label>
                                    <input type="text" class="form-control" id="option_value" name="option_value" required>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="option_value_fa">مقدار (فارسی)</label>
                                    <input type="text" class="form-control" id="option_value_fa" name="option_value_fa" required>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="display_order">ترتیب نمایش</label>
                                    <input type="number" class="form-control" id="display_order" name="display_order" value="0">
                                </div>
                                
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="is_default" name="is_default">
                                    <label class="form-check-label" for="is_default">مقدار پیش‌فرض باشد</label>
                                </div>
                                
                                <div class="text-end mt-4">
                                    <button type="submit" name="add_option" class="btn btn-primary">افزودن گزینه</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>گزینه‌های فیلد: <?php echo $selected_type; ?></h6>
                            <div class="btn-group">
                                <?php foreach($types as $type): ?>
                                    <a href="?type=<?php echo $type; ?>" class="btn btn-sm <?php echo ($type == $selected_type) ? 'btn-primary' : 'btn-outline-primary'; ?>"><?php echo $type; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شناسه</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">مقدار (انگلیسی)</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">مقدار (فارسی)</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ترتیب نمایش</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">پیش‌فرض</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($options_query) > 0): ?>
                                            <?php while($option = mysqli_fetch_assoc($options_query)): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <p class="text-xs font-weight-bold mb-0"><?php echo $option['id']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $option['option_value']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $option['option_value_fa']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $option['display_order']; ?></p>
                                                    </td>
                                                    <td>
                                                        <?php if ($option['is_default']): ?>
                                                            <span class="badge badge-sm bg-gradient-success">بله</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-sm bg-gradient-secondary">خیر</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <button type="button" class="btn btn-sm btn-info edit-option" 
                                                                data-id="<?php echo $option['id']; ?>"
                                                                data-value="<?php echo $option['option_value']; ?>"
                                                                data-value-fa="<?php echo $option['option_value_fa']; ?>"
                                                                data-order="<?php echo $option['display_order']; ?>"
                                                                data-default="<?php echo $option['is_default']; ?>">
                                                            <i class="fas fa-edit"></i> ویرایش
                                                        </button>
                                                        <a href="?type=<?php echo $selected_type; ?>&delete=<?php echo $option['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این گزینه اطمینان دارید؟');">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">هیچ گزینه‌ای برای این فیلد یافت نشد.</td>
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
    
    <!-- مودال ویرایش گزینه -->
    <div class="modal fade" id="editOptionModal" tabindex="-1" role="dialog" aria-labelledby="editOptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOptionModalLabel">ویرایش گزینه</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" id="option_id" name="option_id">
                        
                        <div class="form-group">
                            <label for="edit_option_value">مقدار (انگلیسی)</label>
                            <input type="text" class="form-control" id="edit_option_value" name="edit_option_value" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_option_value_fa">مقدار (فارسی)</label>
                            <input type="text" class="form-control" id="edit_option_value_fa" name="edit_option_value_fa" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="edit_display_order">ترتیب نمایش</label>
                            <input type="number" class="form-control" id="edit_display_order" name="edit_display_order">
                        </div>
                        
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="edit_is_default" name="edit_is_default">
                            <label class="form-check-label" for="edit_is_default">مقدار پیش‌فرض باشد</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" name="edit_option" class="btn btn-primary">ذخیره تغییرات</button>
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
        // نمایش/مخفی کردن فیلد نوع جدید
        document.getElementById('option_type').addEventListener('change', function() {
            var newTypeDiv = document.getElementById('new_type_div');
            newTypeDiv.style.display = (this.value === 'new') ? 'block' : 'none';
        });
        
        // تنظیم مقادیر مودال ویرایش
        var editOptionModal = new bootstrap.Modal(document.getElementById('editOptionModal'));
        
        document.querySelectorAll('.edit-option').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var value = this.getAttribute('data-value');
                var valueFa = this.getAttribute('data-value-fa');
                var order = this.getAttribute('data-order');
                var isDefault = this.getAttribute('data-default') === '1';
                
                document.getElementById('option_id').value = id;
                document.getElementById('edit_option_value').value = value;
                document.getElementById('edit_option_value_fa').value = valueFa;
                document.getElementById('edit_display_order').value = order;
                document.getElementById('edit_is_default').checked = isDefault;
                
                editOptionModal.show();
            });
        });
    </script>
</body>
</html>