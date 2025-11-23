<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// حذف کارمند
$message = '';
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $staff_id = intval($_GET['delete']);
    
    // ابتدا اطلاعات کارمند را برای ثبت در لاگ دریافت می‌کنیم
    $staff = mysqli_fetch_assoc(mysqli_query($db, "SELECT name_fa, name_en, position_fa FROM staff WHERE id = $staff_id"));
    
    if ($staff && mysqli_query($db, "DELETE FROM staff WHERE id = $staff_id")) {
        // ثبت فعالیت در لاگ
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "کارمند {$staff['name_fa']} ({$staff['position_fa']}) حذف شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'delete_staff', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $message = '<div class="alert alert-success">کارمند مورد نظر با موفقیت حذف شد.</div>';
    } else {
        $message = '<div class="alert alert-danger">خطا در حذف کارمند: ' . mysqli_error($db) . '</div>';
    }
}

// فیلترینگ
$where_clause = '';
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    $where_clause = " WHERE name_fa LIKE '%$search%' OR name_en LIKE '%$search%' OR position_fa LIKE '%$search%' OR position_en LIKE '%$search%'";
}

// پیجینیشن
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// کوئری لیست کارکنان
$query = "SELECT * FROM staff $where_clause ORDER BY id DESC LIMIT $offset, $limit";
$result = mysqli_query($db, $query);

// محاسبه تعداد کل رکوردها برای پیجینیشن
$count_query = mysqli_query($db, "SELECT COUNT(*) as total FROM staff $where_clause");
$count_row = mysqli_fetch_assoc($count_query);
$total_pages = ceil($count_row['total'] / $limit);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست کارکنان - مجتمع آموزشی سلمان</title>
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
            
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>لیست کارکنان</h6>
                            <div class="d-flex">
                                <form class="me-2" method="get" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="جستجو..." value="<?php echo htmlspecialchars($search); ?>">
                                        <button class="input-group-text" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <a href="add.php" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> افزودن کارمند جدید
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تصویر</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">سمت</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تحصیلات</th>
                                            <th class="text-secondary opacity-7">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0): ?>
                                            <?php while($staff = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td>
                                                        <div class="px-3 py-1">
                                                            <?php if (!empty($staff['photo_url'])): ?>
                                                                <img src="<?php echo '../assets/images/Staff/' . $staff['photo_url']; ?>" class="avatar avatar-md me-3" alt="staff image">
                                                            <?php else: ?>
                                                                <div class="avatar avatar-md bg-gradient-primary me-3">
                                                                    <i class="fas fa-user-tie"></i>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?php echo $staff['name_fa']; ?></h6>
                                                            <p class="text-xs text-secondary mb-0"><?php echo $staff['name_en']; ?></p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $staff['position_fa']; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $staff['position_en']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?php echo $staff['education_fa']; ?></p>
                                                        <p class="text-xs text-secondary mb-0"><?php echo $staff['education_en']; ?></p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="edit.php?id=<?php echo $staff['id']; ?>" class="btn btn-sm btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit staff">
                                                            <i class="fas fa-edit"></i> ویرایش
                                                        </a>
                                                        <a href="?delete=<?php echo $staff['id']; ?>" class="btn btn-sm btn-danger font-weight-bold text-xs" onclick="return confirm('آیا از حذف این کارمند اطمینان دارید؟');">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-primary font-weight-bold text-xs view-staff" 
                                                                data-bs-toggle="modal" data-bs-target="#viewStaffModal"
                                                                data-id="<?php echo $staff['id']; ?>"
                                                                data-name-fa="<?php echo $staff['name_fa']; ?>"
                                                                data-name-en="<?php echo $staff['name_en']; ?>"
                                                                data-position-fa="<?php echo $staff['position_fa']; ?>"
                                                                data-position-en="<?php echo $staff['position_en']; ?>"
                                                                data-education-fa="<?php echo $staff['education_fa']; ?>"
                                                                data-education-en="<?php echo $staff['education_en']; ?>"
                                                                data-bio="<?php echo $staff['bio']; ?>"
                                                                data-photo="<?php echo $staff['photo_url']; ?>">
                                                            <i class="fas fa-eye"></i> مشاهده
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-4">هیچ کارمندی یافت نشد.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- پیجینیشن -->
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
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <!-- Modal for staff details -->
    <div class="modal fade" id="viewStaffModal" tabindex="-1" aria-labelledby="viewStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStaffModalLabel">مشاهده اطلاعات کارمند</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div id="staffPhoto" class="mb-3">
                                <!-- تصویر کارمند اینجا نمایش داده می‌شود -->
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6>نام (فارسی):</h6>
                                    <p id="staffNameFa"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6>نام (انگلیسی):</h6>
                                    <p id="staffNameEn"></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6>سمت (فارسی):</h6>
                                    <p id="staffPositionFa"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6>سمت (انگلیسی):</h6>
                                    <p id="staffPositionEn"></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6>تحصیلات (فارسی):</h6>
                                    <p id="staffEducationFa"></p>
                                </div>
                                <div class="col-md-6">
                                    <h6>تحصیلات (انگلیسی):</h6>
                                    <p id="staffEducationEn"></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h6>بیوگرافی:</h6>
                                    <p id="staffBio"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <a id="editStaffLink" href="#" class="btn btn-primary">ویرایش</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // مشاهده جزئیات کارمند در مودال
        document.addEventListener('DOMContentLoaded', function() {
            const staffModal = document.getElementById('viewStaffModal');
            
            if (staffModal) {
                staffModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    
                    // دریافت اطلاعات کارمند از دکمه
                    const id = button.getAttribute('data-id');
                    const nameFa = button.getAttribute('data-name-fa');
                    const nameEn = button.getAttribute('data-name-en');
                    const positionFa = button.getAttribute('data-position-fa');
                    const positionEn = button.getAttribute('data-position-en');
                    const educationFa = button.getAttribute('data-education-fa');
                    const educationEn = button.getAttribute('data-education-en');
                    const bio = button.getAttribute('data-bio');
                    const photo = button.getAttribute('data-photo');
                    
                    // نمایش اطلاعات در مودال
                    document.getElementById('staffNameFa').textContent = nameFa || '-';
                    document.getElementById('staffNameEn').textContent = nameEn || '-';
                    document.getElementById('staffPositionFa').textContent = positionFa || '-';
                    document.getElementById('staffPositionEn').textContent = positionEn || '-';
                    document.getElementById('staffEducationFa').textContent = educationFa || '-';
                    document.getElementById('staffEducationEn').textContent = educationEn || '-';
                    document.getElementById('staffBio').textContent = bio || 'بدون بیوگرافی';
                    
                    // تنظیم لینک ویرایش
                    document.getElementById('editStaffLink').href = 'edit.php?id=' + id;
                    
                    // تنظیم تصویر
                    const photoContainer = document.getElementById('staffPhoto');
                    if (photo && photo !== 'null') {
                        photoContainer.innerHTML = `<img src="../assets/images/Staff/${photo}" class="img-fluid rounded" alt="${nameFa}">`;
                    } else {
                        photoContainer.innerHTML = `
                            <div class="avatar avatar-xxl bg-gradient-primary mx-auto">
                                <i class="fas fa-user-tie fa-3x"></i>
                            </div>
                        `;
                    }
                });
            }
        });
    </script>
</body>
</html>