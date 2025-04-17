<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// افزودن مسیر جدید
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_route'])) {
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $city_fa = mysqli_real_escape_string($db, $_POST['city_fa']);
    $route_name = mysqli_real_escape_string($db, $_POST['route_name']);
    $route_name_fa = mysqli_real_escape_string($db, $_POST['route_name_fa']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $description_fa = mysqli_real_escape_string($db, $_POST['description_fa']);
    $active = isset($_POST['active']) ? 1 : 0;
    
    $query = "INSERT INTO transportation_routes (city, city_fa, route_name, route_name_fa, description, description_fa, active) 
              VALUES ('$city', '$city_fa', '$route_name', '$route_name_fa', '$description', '$description_fa', $active)";
    
    if (mysqli_query($db, $query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "مسیر سرویس جدید $route_name در شهر $city اضافه شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'add_route', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">مسیر جدید با موفقیت افزوده شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در ثبت مسیر جدید: ' . mysqli_error($db) . '</div>';
    }
}

// ویرایش مسیر
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_route'])) {
    $route_id = intval($_POST['route_id']);
    $city = mysqli_real_escape_string($db, $_POST['edit_city']);
    $city_fa = mysqli_real_escape_string($db, $_POST['edit_city_fa']);
    $route_name = mysqli_real_escape_string($db, $_POST['edit_route_name']);
    $route_name_fa = mysqli_real_escape_string($db, $_POST['edit_route_name_fa']);
    $description = mysqli_real_escape_string($db, $_POST['edit_description']);
    $description_fa = mysqli_real_escape_string($db, $_POST['edit_description_fa']);
    $active = isset($_POST['edit_active']) ? 1 : 0;
    
    $query = "UPDATE transportation_routes SET 
              city = '$city',
              city_fa = '$city_fa',
              route_name = '$route_name',
              route_name_fa = '$route_name_fa',
              description = '$description',
              description_fa = '$description_fa',
              active = $active
              WHERE id = $route_id";
    
    if (mysqli_query($db, $query)) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "مسیر سرویس $route_name در شهر $city بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'update_route', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">مسیر با موفقیت بروزرسانی شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در بروزرسانی مسیر: ' . mysqli_error($db) . '</div>';
    }
}

// حذف مسیر
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $route_id = intval($_GET['delete']);
    
    // ابتدا اطلاعات مسیر را برای ثبت در لاگ دریافت می‌کنیم
    $route = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transportation_routes WHERE id = $route_id"));
    
    if ($route && mysqli_query($db, "DELETE FROM transportation_routes WHERE id = $route_id")) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "مسیر سرویس {$route['route_name']} در شهر {$route['city']} حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_route', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">مسیر مورد نظر با موفقیت حذف شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در حذف مسیر: ' . mysqli_error($db) . '</div>';
    }
}

// دریافت لیست شهرها
$cities_query = mysqli_query($db, "SELECT DISTINCT city, city_fa FROM transportation_routes ORDER BY city");
$cities = [];
while ($city = mysqli_fetch_assoc($cities_query)) {
    $cities[] = $city;
}

// فیلتر بر اساس شهر
$city_filter = '';
$where_clause = '';
if (isset($_GET['city']) && !empty($_GET['city'])) {
    $city_filter = mysqli_real_escape_string($db, $_GET['city']);
    $where_clause = " WHERE city = '$city_filter'";
}

// دریافت لیست مسیرها
$query = "SELECT * FROM transportation_routes $where_clause ORDER BY city, route_name";
$result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت مسیرهای سرویس - مجتمع آموزشی سلمان</title>
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
                            <h6>افزودن مسیر جدید</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">شهر (انگلیسی) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city" required list="cityList">
                                            <datalist id="cityList">
                                                <?php foreach ($cities as $city): ?>
                                                    <option value="<?php echo $city['city']; ?>">
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city_fa">شهر (فارسی) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city_fa" name="city_fa" required list="cityFaList">
                                            <datalist id="cityFaList">
                                                <?php foreach ($cities as $city): ?>
                                                    <option value="<?php echo $city['city_fa']; ?>">
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="route_name">نام مسیر (انگلیسی) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="route_name" name="route_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="route_name_fa">نام مسیر (فارسی) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="route_name_fa" name="route_name_fa" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">توضیحات (انگلیسی)</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description_fa">توضیحات (فارسی)</label>
                                            <textarea class="form-control" id="description_fa" name="description_fa" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" checked>
                                    <label class="form-check-label" for="active">مسیر فعال باشد</label>
                                </div>
                                
                                <div class="text-end mt-4">
                                    <button type="submit" name="add_route" class="btn btn-primary">افزودن مسیر</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>لیست مسیرهای سرویس</h6>
                            <div class="d-flex">
                                <form class="me-2" method="get" action="">
                                    <select class="form-select" name="city" onchange="this.form.submit()">
                                        <option value="">همه شهرها</option>
                                        <?php foreach ($cities as $city): ?>
                                            <option value="<?php echo $city['city']; ?>" <?php echo ($city_filter == $city['city']) ? 'selected' : ''; ?>>
                                                <?php echo $city['city_fa'] . ' (' . $city['city'] . ')'; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">شهر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نام مسیر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">توضیحات</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">وضعیت</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while($route = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?php echo $route['city']; ?></h6>
                                                                <p class="text-xs text-secondary mb-0"><?php echo $route['city_fa']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $route['route_name']; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $route['route_name_fa']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo substr($route['description'], 0, 50) . (strlen($route['description']) > 50 ? '...' : ''); ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo substr($route['description_fa'], 0, 50) . (strlen($route['description_fa']) > 50 ? '...' : ''); ?></p>
                                                    </td>
                                                    <td>
                                                        <?php if ($route['active']): ?>
                                                            <span class="badge badge-sm bg-gradient-success">فعال</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-sm bg-gradient-secondary">غیرفعال</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <button type="button" class="btn btn-sm btn-info edit-route" 
                                                                data-bs-toggle="modal" data-bs-target="#editRouteModal"
                                                                data-id="<?php echo $route['id']; ?>"
                                                                data-city="<?php echo $route['city']; ?>"
                                                                data-city-fa="<?php echo $route['city_fa']; ?>"
                                                                data-route-name="<?php echo $route['route_name']; ?>"
                                                                data-route-name-fa="<?php echo $route['route_name_fa']; ?>"
                                                                data-description="<?php echo $route['description']; ?>"
                                                                data-description-fa="<?php echo $route['description_fa']; ?>"
                                                                data-active="<?php echo $route['active']; ?>">
                                                            <i class="fas fa-edit"></i> ویرایش
                                                        </button>
                                                        <a href="?delete=<?php echo $route['id']; ?><?php echo !empty($city_filter) ? '&city=' . urlencode($city_filter) : ''; ?>" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این مسیر اطمینان دارید؟');">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-4">هیچ مسیری یافت نشد.</td>
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
    
    <!-- مودال ویرایش مسیر -->
    <div class="modal fade" id="editRouteModal" tabindex="-1" aria-labelledby="editRouteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRouteModalLabel">ویرایش مسیر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" id="route_id" name="route_id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_city">شهر (انگلیسی) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_city" name="edit_city" required list="editCityList">
                                    <datalist id="editCityList">
                                        <?php 
                                        mysqli_data_seek($cities_query, 0);
                                        while ($city = mysqli_fetch_assoc($cities_query)): 
                                        ?>
                                            <option value="<?php echo $city['city']; ?>">
                                        <?php endwhile; ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_city_fa">شهر (فارسی) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_city_fa" name="edit_city_fa" required list="editCityFaList">
                                    <datalist id="editCityFaList">
                                        <?php 
                                        mysqli_data_seek($cities_query, 0);
                                        while ($city = mysqli_fetch_assoc($cities_query)): 
                                        ?>
                                            <option value="<?php echo $city['city_fa']; ?>">
                                        <?php endwhile; ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_route_name">نام مسیر (انگلیسی) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_route_name" name="edit_route_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_route_name_fa">نام مسیر (فارسی) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_route_name_fa" name="edit_route_name_fa" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_description">توضیحات (انگلیسی)</label>
                                    <textarea class="form-control" id="edit_description" name="edit_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_description_fa">توضیحات (فارسی)</label>
                                    <textarea class="form-control" id="edit_description_fa" name="edit_description_fa" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="edit_active" name="edit_active">
                            <label class="form-check-label" for="edit_active">مسیر فعال باشد</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" name="edit_route" class="btn btn-primary">ذخیره تغییرات</button>
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
        // مشاهده جزئیات مسیر در مودال
        document.addEventListener('DOMContentLoaded', function() {
            const routeModal = document.getElementById('editRouteModal');
            
            if (routeModal) {
                routeModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    
                    // دریافت اطلاعات مسیر از دکمه
                    const id = button.getAttribute('data-id');
                    const city = button.getAttribute('data-city');
                    const cityFa = button.getAttribute('data-city-fa');
                    const routeName = button.getAttribute('data-route-name');
                    const routeNameFa = button.getAttribute('data-route-name-fa');
                    const description = button.getAttribute('data-description');
                    const descriptionFa = button.getAttribute('data-description-fa');
                    const active = button.getAttribute('data-active') === '1';
                    
                    // نمایش اطلاعات در مودال
                    document.getElementById('route_id').value = id;
                    document.getElementById('edit_city').value = city;
                    document.getElementById('edit_city_fa').value = cityFa;
                    document.getElementById('edit_route_name').value = routeName;
                    document.getElementById('edit_route_name_fa').value = routeNameFa;
                    document.getElementById('edit_description').value = description;
                    document.getElementById('edit_description_fa').value = descriptionFa;
                    document.getElementById('edit_active').checked = active;
                });
            }
        });
    </script>
</body>
</html>