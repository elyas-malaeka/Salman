<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// بررسی ID دانش‌آموز
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: list.php");
    exit();
}

$student_id = $_GET['id'];

// دریافت اطلاعات کامل دانش‌آموز
$query = "SELECT * FROM student_complete_info WHERE student_id = $student_id";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: list.php");
    exit();
}

$student = mysqli_fetch_assoc($result);

// بروزرسانی وضعیت ثبت‌نام
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $new_status = mysqli_real_escape_string($db, $_POST['registration_status']);
    
    $update_query = "UPDATE registrations SET registration_status = '$new_status' WHERE student_id = $student_id";
    $update_result = mysqli_query($db, $update_query);
    
    if ($update_result) {
        // ثبت در لاگ سیستم
        $log_description = "وضعیت ثبت‌نام دانش‌آموز {$student['first_name']} {$student['last_name']} به $new_status تغییر یافت";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
            ('{$_SESSION['admin_id']}', 'update_registration_status', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $success_message = "وضعیت ثبت‌نام با موفقیت بروزرسانی شد.";
        
        // بروزرسانی متغیر دانش‌آموز
        $result = mysqli_query($db, $query);
        $student = mysqli_fetch_assoc($result);
    } else {
        $error_message = "خطا در بروزرسانی وضعیت ثبت‌نام: " . mysqli_error($db);
    }
}

// بروزرسانی اطلاعات دانش‌آموز
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_student'])) {
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $father_name = mysqli_real_escape_string($db, $_POST['father_name']);
    $national_id = mysqli_real_escape_string($db, $_POST['national_id']);
    $passport_number = mysqli_real_escape_string($db, $_POST['passport_number']);
    $birthplace = mysqli_real_escape_string($db, $_POST['birthplace']);
    $birthdate = mysqli_real_escape_string($db, $_POST['birthdate']);
    $religion = mysqli_real_escape_string($db, $_POST['religion']);
    $nationality = mysqli_real_escape_string($db, $_POST['nationality']);
    $academic_grade = (int)$_POST['academic_grade'];
    $major = mysqli_real_escape_string($db, $_POST['major']);
    $residential_address = mysqli_real_escape_string($db, $_POST['residential_address']);
    $contact_number = mysqli_real_escape_string($db, $_POST['contact_number']);
    $emergency_contact_name = mysqli_real_escape_string($db, $_POST['emergency_contact_name']);
    $emergency_contact_number = mysqli_real_escape_string($db, $_POST['emergency_contact_number']);
    
    $update_query = "UPDATE students SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    father_name = '$father_name', 
                    national_id = '$national_id', 
                    passport_number = '$passport_number', 
                    birthplace = '$birthplace', 
                    birthdate = '$birthdate', 
                    religion = '$religion', 
                    nationality = '$nationality', 
                    academic_grade = $academic_grade, 
                    major = '$major', 
                    residential_address = '$residential_address', 
                    contact_number = '$contact_number', 
                    emergency_contact_name = '$emergency_contact_name', 
                    emergency_contact_number = '$emergency_contact_number'
                    WHERE student_id = $student_id";
    
    $update_result = mysqli_query($db, $update_query);
    
    if ($update_result) {
        // ثبت در لاگ سیستم
        $log_description = "اطلاعات دانش‌آموز {$first_name} {$last_name} بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
            ('{$_SESSION['admin_id']}', 'update_student', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $success_message = "اطلاعات دانش‌آموز با موفقیت بروزرسانی شد.";
        
        // بروزرسانی متغیر دانش‌آموز
        $result = mysqli_query($db, $query);
        $student = mysqli_fetch_assoc($result);
    } else {
        $error_message = "خطا در بروزرسانی اطلاعات دانش‌آموز: " . mysqli_error($db);
    }
}

// دریافت لیست پایه‌های تحصیلی
$grades_query = "SELECT * FROM academic_grades ORDER BY grade_number";
$grades = mysqli_query($db, $grades_query);

// دریافت لیست مذاهب
$religions_query = "SELECT option_value FROM form_options WHERE option_type = 'religion'";
$religions = mysqli_query($db, $religions_query);

// دریافت لیست ملیت‌ها
$nationalities_query = "SELECT option_value FROM form_options WHERE option_type = 'nationality'";
$nationalities = mysqli_query($db, $nationalities_query);

// دریافت لیست رشته‌های تحصیلی
$majors_query = "SELECT option_value FROM form_options WHERE option_type = 'major'";
$majors = mysqli_query($db, $majors_query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشاهده دانش‌آموز - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }
        
        .student-info-card {
            border-radius: 15px;
            overflow: hidden;
        }
        
        .info-item {
            margin-bottom: 1rem;
        }
        
        .info-item .label {
            font-weight: bold;
            color: #5e72e4;
        }
        
        .status-badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            border-radius: 0.25rem;
        }
        
        .status-pending {
            background-color: #f5b759;
            color: #212529;
        }
        
        .status-approved {
            background-color: #2dce89;
            color: #fff;
        }
        
        .status-rejected {
            background-color: #f5365c;
            color: #fff;
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
                                <h6 class="mb-0">مشاهده اطلاعات دانش‌آموز</h6>
                                <div>
                                    <a href="list.php" class="btn btn-sm btn-secondary me-2">
                                        <i class="fas fa-arrow-right"></i> بازگشت به لیست
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                        <i class="fas fa-edit"></i> ویرایش اطلاعات
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <?php if(isset($success_message)): ?>
                                <div class="alert alert-success text-white"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                            
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger text-white"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            
                            <div class="row">
                                <!-- اطلاعات اصلی و تصویر دانش‌آموز -->
                                <div class="col-lg-4 mb-4">
                                    <div class="card student-info-card h-100">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0">اطلاعات اصلی</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <?php if(!empty($student['profile_photo_path']) && file_exists("../" . $student['profile_photo_path'])): ?>
                                                <img src="../<?php echo $student['profile_photo_path']; ?>" class="profile-img mb-4" alt="<?php echo $student['first_name'] . ' ' . $student['last_name']; ?>">
                                            <?php else: ?>
                                                <img src="../assets/Media/logo/logo.png" class="profile-img mb-4" alt="Default">
                                            <?php endif; ?>
                                            
                                            <h4><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h4>
                                            <p class="text-muted"><?php echo $student['grade_name']; ?></p>
                                            
                                            <?php 
                                                $status_class = 'status-pending';
                                                $status_text = 'در انتظار بررسی';
                                                
                                                if($student['registration_status'] == 'approved') {
                                                    $status_class = 'status-approved';
                                                    $status_text = 'تأیید شده';
                                                } elseif($student['registration_status'] == 'rejected') {
                                                    $status_class = 'status-rejected';
                                                    $status_text = 'رد شده';
                                                }
                                            ?>
                                            <div class="mb-3">
                                                <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                            </div>
                                            
                                            <form method="post" class="mt-3">
                                                <div class="form-group">
                                                    <label for="registration_status" class="form-control-label">تغییر وضعیت ثبت‌نام</label>
                                                    <select name="registration_status" id="registration_status" class="form-control form-control-sm">
                                                        <option value="pending" <?php echo $student['registration_status'] == 'pending' ? 'selected' : ''; ?>>در انتظار بررسی</option>
                                                        <option value="approved" <?php echo $student['registration_status'] == 'approved' ? 'selected' : ''; ?>>تأیید شده</option>
                                                        <option value="rejected" <?php echo $student['registration_status'] == 'rejected' ? 'selected' : ''; ?>>رد شده</option>
                                                    </select>
                                                </div>
                                                <button type="submit" name="update_status" class="btn btn-sm btn-primary mt-2">بروزرسانی وضعیت</button>
                                            </form>
                                            
                                            <div class="mt-4">
                                                <a href="documents.php?id=<?php echo $student_id; ?>" class="btn btn-sm btn-warning m-1">
                                                    <i class="fas fa-file-alt"></i> مدارک
                                                </a>
                                                <a href="parents.php?id=<?php echo $student_id; ?>" class="btn btn-sm btn-success m-1">
                                                    <i class="fas fa-users"></i> والدین
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- اطلاعات تحصیلی و شخصی -->
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="card student-info-card h-100">
                                                <div class="card-header bg-info text-white">
                                                    <h6 class="mb-0">اطلاعات شخصی</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="info-item">
                                                        <div class="label">نام پدر</div>
                                                        <div><?php echo $student['student_father_name']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">تاریخ تولد</div>
                                                        <div><?php echo date('Y/m/d', strtotime($student['birthdate'])); ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">محل تولد</div>
                                                        <div><?php echo $student['birthplace']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">مذهب</div>
                                                        <div><?php echo $student['religion']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">ملیت</div>
                                                        <div><?php echo $student['nationality']; ?></div>
                                                    </div>
                                                    
                                                    <?php if(!empty($student['student_national_id'])): ?>
                                                        <div class="info-item">
                                                            <div class="label">کد ملی</div>
                                                            <div><?php echo $student['student_national_id']; ?></div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if(!empty($student['student_passport_number'])): ?>
                                                        <div class="info-item">
                                                            <div class="label">شماره پاسپورت</div>
                                                            <div><?php echo $student['student_passport_number']; ?></div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-4">
                                            <div class="card student-info-card h-100">
                                                <div class="card-header bg-success text-white">
                                                    <h6 class="mb-0">اطلاعات تحصیلی و تماس</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="info-item">
                                                        <div class="label">پایه تحصیلی</div>
                                                        <div><?php echo $student['grade_name']; ?></div>
                                                    </div>
                                                    
                                                    <?php if(!empty($student['major'])): ?>
                                                        <div class="info-item">
                                                            <div class="label">رشته تحصیلی</div>
                                                            <div><?php echo $student['major']; ?></div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">آدرس محل سکونت</div>
                                                        <div><?php echo $student['residential_address']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">شماره تماس</div>
                                                        <div><?php echo $student['contact_number']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">نام تماس اضطراری</div>
                                                        <div><?php echo $student['emergency_contact_name']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">شماره تماس اضطراری</div>
                                                        <div><?php echo $student['emergency_contact_number']; ?></div>
                                                    </div>
                                                    
                                                    <div class="info-item">
                                                        <div class="label">تاریخ ثبت‌نام</div>
                                                        <div><?php echo date('Y/m/d H:i', strtotime($student['registration_date'])); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="card student-info-card h-100">
                                                <div class="card-header bg-warning">
                                                    <h6 class="mb-0">اطلاعات پدر</h6>
                                                </div>
                                                <div class="card-body">
                                                    <?php if(!empty($student['father_full_name'])): ?>
                                                        <div class="info-item">
                                                            <div class="label">نام و نام خانوادگی</div>
                                                            <div><?php echo $student['father_full_name']; ?></div>
                                                        </div>
                                                        
                                                        <div class="info-item">
                                                            <div class="label">ملیت</div>
                                                            <div><?php echo $student['father_nationality']; ?></div>
                                                        </div>
                                                        
                                                        <div class="info-item">
                                                            <div class="label">شماره موبایل</div>
                                                            <div><?php echo $student['father_mobile']; ?></div>
                                                        </div>
                                                        
                                                        <div class="info-item">
                                                            <div class="label">ایمیل</div>
                                                            <div><?php echo $student['father_email']; ?></div>
                                                        </div>
                                                        
                                                        <div class="text-center mt-3">
                                                            <a href="parents.php?id=<?php echo $student_id; ?>" class="btn btn-sm btn-warning">مشاهده جزئیات بیشتر</a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="alert alert-warning mb-0">
                                                            اطلاعات پدر ثبت نشده است.
                                                            <div class="mt-2">
                                                                <a href="parents.php?id=<?php echo $student_id; ?>" class="btn btn-sm btn-warning">ثبت اطلاعات پدر</a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-4">
                                            <div class="card student-info-card h-100">
                                                <div class="card-header bg-danger text-white">
                                                    <h6 class="mb-0">اطلاعات مادر</h6>
                                                </div>
                                                <div class="card-body">
                                                    <?php if(!empty($student['mother_full_name'])): ?>
                                                        <div class="info-item">
                                                            <div class="label">نام و نام خانوادگی</div>
                                                            <div><?php echo $student['mother_full_name']; ?></div>
                                                        </div>
                                                        
                                                        <div class="info-item">
                                                            <div class="label">ملیت</div>
                                                            <div><?php echo $student['mother_nationality']; ?></div>
                                                        </div>
                                                        
                                                        <div class="info-item">
                                                            <div class="label">شماره موبایل</div>
                                                            <div><?php echo $student['mother_mobile']; ?></div>
                                                        </div>
                                                        
                                                        <div class="info-item">
                                                            <div class="label">ایمیل</div>
                                                            <div><?php echo $student['mother_email']; ?></div>
                                                        </div>
                                                        
                                                        <div class="text-center mt-3">
                                                            <a href="parents.php?id=<?php echo $student_id; ?>" class="btn btn-sm btn-danger">مشاهده جزئیات بیشتر</a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="alert alert-warning mb-0">
                                                            اطلاعات مادر ثبت نشده است.
                                                            <div class="mt-2">
                                                                <a href="parents.php?id=<?php echo $student_id; ?>" class="btn btn-sm btn-danger">ثبت اطلاعات مادر</a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <!-- Modal ویرایش اطلاعات دانش‌آموز -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">ویرایش اطلاعات دانش‌آموز</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-control-label">نام</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-control-label">نام خانوادگی</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name" class="form-control-label">نام پدر</label>
                                    <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $student['student_father_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birthdate" class="form-control-label">تاریخ تولد</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $student['birthdate']; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="national_id" class="form-control-label">کد ملی</label>
                                    <input type="text" class="form-control" id="national_id" name="national_id" value="<?php echo $student['student_national_id']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_number" class="form-control-label">شماره پاسپورت</label>
                                    <input type="text" class="form-control" id="passport_number" name="passport_number" value="<?php echo $student['student_passport_number']; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birthplace" class="form-control-label">محل تولد</label>
                                    <input type="text" class="form-control" id="birthplace" name="birthplace" value="<?php echo $student['birthplace']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religion" class="form-control-label">مذهب</label>
                                    <select class="form-control" id="religion" name="religion" required>
                                        <option value="">انتخاب کنید</option>
                                        <?php 
                                            mysqli_data_seek($religions, 0);
                                            while($religion = mysqli_fetch_assoc($religions)): 
                                        ?>
                                            <option value="<?php echo $religion['option_value']; ?>" <?php echo ($student['religion'] == $religion['option_value']) ? 'selected' : ''; ?>>
                                                <?php echo $religion['option_value']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nationality" class="form-control-label">ملیت</label>
                                    <select class="form-control" id="nationality" name="nationality" required>
                                        <option value="">انتخاب کنید</option>
                                        <?php 
                                            mysqli_data_seek($nationalities, 0);
                                            while($nationality = mysqli_fetch_assoc($nationalities)): 
                                        ?>
                                            <option value="<?php echo $nationality['option_value']; ?>" <?php echo ($student['nationality'] == $nationality['option_value']) ? 'selected' : ''; ?>>
                                                <?php echo $nationality['option_value']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="academic_grade" class="form-control-label">پایه تحصیلی</label>
                                    <select class="form-control" id="academic_grade" name="academic_grade" required>
                                        <option value="">انتخاب کنید</option>
                                        <?php 
                                            mysqli_data_seek($grades, 0);
                                            while($grade = mysqli_fetch_assoc($grades)): 
                                        ?>
                                            <option value="<?php echo $grade['grade_number']; ?>" <?php echo ($student['academic_grade'] == $grade['grade_number']) ? 'selected' : ''; ?>>
                                                <?php echo $grade['grade_name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="major" class="form-control-label">رشته تحصیلی</label>
                                    <select class="form-control" id="major" name="major">
                                        <option value="">انتخاب کنید</option>
                                        <?php 
                                            mysqli_data_seek($majors, 0);
                                            while($major = mysqli_fetch_assoc($majors)): 
                                        ?>
                                            <option value="<?php echo $major['option_value']; ?>" <?php echo ($student['major'] == $major['option_value']) ? 'selected' : ''; ?>>
                                                <?php echo $major['option_value']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_number" class="form-control-label">شماره تماس</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $student['contact_number']; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_name" class="form-control-label">نام تماس اضطراری</label>
                                    <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="<?php echo $student['emergency_contact_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emergency_contact_number" class="form-control-label">شماره تماس اضطراری</label>
                                    <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" value="<?php echo $student['emergency_contact_number']; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="residential_address" class="form-control-label">آدرس محل سکونت</label>
                                    <textarea class="form-control" id="residential_address" name="residential_address" rows="3" required><?php echo $student['residential_address']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                            <button type="submit" name="update_student" class="btn btn-primary">بروزرسانی</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
</body>
</html>