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

// دریافت اطلاعات دانش‌آموز
$student_query = "SELECT * FROM students WHERE student_id = $student_id";
$student_result = mysqli_query($db, $student_query);

if (mysqli_num_rows($student_result) == 0) {
    header("Location: list.php");
    exit();
}

$student = mysqli_fetch_assoc($student_result);

// دریافت اطلاعات پدر
$father_query = "SELECT * FROM fathers WHERE student_id = $student_id";
$father_result = mysqli_query($db, $father_query);
$father = mysqli_num_rows($father_result) > 0 ? mysqli_fetch_assoc($father_result) : null;

// دریافت اطلاعات مادر
$mother_query = "SELECT * FROM mothers WHERE student_id = $student_id";
$mother_result = mysqli_query($db, $mother_query);
$mother = mysqli_num_rows($mother_result) > 0 ? mysqli_fetch_assoc($mother_result) : null;

// ویرایش اطلاعات پدر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_father'])) {
    $full_name = mysqli_real_escape_string($db, $_POST['father_full_name']);
    $nationality = mysqli_real_escape_string($db, $_POST['father_nationality']);
    $birthdate = mysqli_real_escape_string($db, $_POST['father_birthdate']);
    $national_id = mysqli_real_escape_string($db, $_POST['father_national_id']);
    $passport_number = mysqli_real_escape_string($db, $_POST['father_passport_number']);
    $education = mysqli_real_escape_string($db, $_POST['father_education']);
    $occupation = mysqli_real_escape_string($db, $_POST['father_occupation']);
    $landline = mysqli_real_escape_string($db, $_POST['father_landline']);
    $mobile_number = mysqli_real_escape_string($db, $_POST['father_mobile_number']);
    $whatsapp_number = mysqli_real_escape_string($db, $_POST['father_whatsapp_number']);
    $email = mysqli_real_escape_string($db, $_POST['father_email']);
    $work_address = mysqli_real_escape_string($db, $_POST['father_work_address']);
    $employee_code = mysqli_real_escape_string($db, $_POST['father_employee_code']);
    $has_medical_condition = isset($_POST['father_has_medical_condition']) ? 1 : 0;
    $medical_condition_details = mysqli_real_escape_string($db, $_POST['father_medical_condition_details']);
    
    if ($father) {
        // بروزرسانی اطلاعات پدر
        $update_query = "UPDATE fathers SET 
                        full_name = '$full_name', 
                        nationality = '$nationality', 
                        birthdate = '$birthdate', 
                        national_id = '$national_id', 
                        passport_number = '$passport_number', 
                        education = '$education', 
                        occupation = '$occupation', 
                        landline = '$landline', 
                        mobile_number = '$mobile_number', 
                        whatsapp_number = '$whatsapp_number', 
                        email = '$email', 
                        work_address = '$work_address', 
                        employee_code = '$employee_code', 
                        has_medical_condition = $has_medical_condition, 
                        medical_condition_details = '$medical_condition_details' 
                        WHERE student_id = $student_id";
    } else {
        // ایجاد رکورد جدید برای پدر
        $update_query = "INSERT INTO fathers 
                        (student_id, full_name, nationality, birthdate, national_id, passport_number, education, 
                        occupation, landline, mobile_number, whatsapp_number, email, work_address, 
                        employee_code, has_medical_condition, medical_condition_details) 
                        VALUES 
                        ($student_id, '$full_name', '$nationality', '$birthdate', '$national_id', '$passport_number', 
                        '$education', '$occupation', '$landline', '$mobile_number', '$whatsapp_number', '$email', 
                        '$work_address', '$employee_code', $has_medical_condition, '$medical_condition_details')";
    }
    
    $update_result = mysqli_query($db, $update_query);
    
    if ($update_result) {
        // ثبت در لاگ سیستم
        $log_description = "اطلاعات پدر دانش‌آموز {$student['first_name']} {$student['last_name']} بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
            ('{$_SESSION['admin_id']}', 'update_father', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $success_message = "اطلاعات پدر با موفقیت بروزرسانی شد.";
        
        // بروزرسانی متغیر پدر
        $father_result = mysqli_query($db, "SELECT * FROM fathers WHERE student_id = $student_id");
        $father = mysqli_fetch_assoc($father_result);
    } else {
        $error_message = "خطا در بروزرسانی اطلاعات پدر: " . mysqli_error($db);
    }
}

// ویرایش اطلاعات مادر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_mother'])) {
    $full_name = mysqli_real_escape_string($db, $_POST['mother_full_name']);
    $nationality = mysqli_real_escape_string($db, $_POST['mother_nationality']);
    $birthdate = mysqli_real_escape_string($db, $_POST['mother_birthdate']);
    $national_id = mysqli_real_escape_string($db, $_POST['mother_national_id']);
    $passport_number = mysqli_real_escape_string($db, $_POST['mother_passport_number']);
    $education = mysqli_real_escape_string($db, $_POST['mother_education']);
    $occupation = mysqli_real_escape_string($db, $_POST['mother_occupation']);
    $landline = mysqli_real_escape_string($db, $_POST['mother_landline']);
    $mobile_number = mysqli_real_escape_string($db, $_POST['mother_mobile_number']);
    $whatsapp_number = mysqli_real_escape_string($db, $_POST['mother_whatsapp_number']);
    $email = mysqli_real_escape_string($db, $_POST['mother_email']);
    $work_address = mysqli_real_escape_string($db, $_POST['mother_work_address']);
    $employee_code = mysqli_real_escape_string($db, $_POST['mother_employee_code']);
    $has_medical_condition = isset($_POST['mother_has_medical_condition']) ? 1 : 0;
    $medical_condition_details = mysqli_real_escape_string($db, $_POST['mother_medical_condition_details']);
    
    if ($mother) {
        // بروزرسانی اطلاعات مادر
        $update_query = "UPDATE mothers SET 
                        full_name = '$full_name', 
                        nationality = '$nationality', 
                        birthdate = '$birthdate', 
                        national_id = '$national_id', 
                        passport_number = '$passport_number', 
                        education = '$education', 
                        occupation = '$occupation', 
                        landline = '$landline', 
                        mobile_number = '$mobile_number', 
                        whatsapp_number = '$whatsapp_number', 
                        email = '$email', 
                        work_address = '$work_address', 
                        employee_code = '$employee_code', 
                        has_medical_condition = $has_medical_condition, 
                        medical_condition_details = '$medical_condition_details' 
                        WHERE student_id = $student_id";
    } else {
        // ایجاد رکورد جدید برای مادر
        $update_query = "INSERT INTO mothers 
                        (student_id, full_name, nationality, birthdate, national_id, passport_number, education, 
                        occupation, landline, mobile_number, whatsapp_number, email, work_address, 
                        employee_code, has_medical_condition, medical_condition_details) 
                        VALUES 
                        ($student_id, '$full_name', '$nationality', '$birthdate', '$national_id', '$passport_number', 
                        '$education', '$occupation', '$landline', '$mobile_number', '$whatsapp_number', '$email', 
                        '$work_address', '$employee_code', $has_medical_condition, '$medical_condition_details')";
    }
    
    $update_result = mysqli_query($db, $update_query);
    
    if ($update_result) {
        // ثبت در لاگ سیستم
        $log_description = "اطلاعات مادر دانش‌آموز {$student['first_name']} {$student['last_name']} بروزرسانی شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
            ('{$_SESSION['admin_id']}', 'update_mother', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $success_message = "اطلاعات مادر با موفقیت بروزرسانی شد.";
        
        // بروزرسانی متغیر مادر
        $mother_result = mysqli_query($db, "SELECT * FROM mothers WHERE student_id = $student_id");
        $mother = mysqli_fetch_assoc($mother_result);
    } else {
        $error_message = "خطا در بروزرسانی اطلاعات مادر: " . mysqli_error($db);
    }
}

// دریافت لیست ملیت‌ها برای دراپ‌داون
$nationalities_query = "SELECT option_value FROM form_options WHERE option_type = 'nationality' ORDER BY display_order";
$nationalities = mysqli_query($db, $nationalities_query);

// دریافت لیست تحصیلات برای دراپ‌داون
$educations_query = "SELECT option_value FROM form_options WHERE option_type = 'education' ORDER BY display_order";
$educations = mysqli_query($db, $educations_query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت اطلاعات والدین - مجتمع آموزشی سلمان</title>
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
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">مدیریت اطلاعات والدین دانش‌آموز: <?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h6>
                                <a href="list.php" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-right"></i> بازگشت به لیست دانش‌آموزان
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <?php if(isset($success_message)): ?>
                                <div class="alert alert-success text-white"><?php echo $success_message; ?></div>
                            <?php endif; ?>
                            
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger text-white"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            
                            <ul class="nav nav-tabs" id="parentsTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="father-tab" data-bs-toggle="tab" data-bs-target="#father" type="button" role="tab" aria-controls="father" aria-selected="true">اطلاعات پدر</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="mother-tab" data-bs-toggle="tab" data-bs-target="#mother" type="button" role="tab" aria-controls="mother" aria-selected="false">اطلاعات مادر</button>
                                </li>
                            </ul>
                            
                            <div class="tab-content mt-4" id="parentsTabContent">
                                <!-- اطلاعات پدر -->
                                <div class="tab-pane fade show active" id="father" role="tabpanel" aria-labelledby="father-tab">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_full_name" class="form-control-label">نام و نام خانوادگی</label>
                                                    <input type="text" class="form-control" id="father_full_name" name="father_full_name" value="<?php echo $father ? $father['full_name'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_nationality" class="form-control-label">ملیت</label>
                                                    <select class="form-control" id="father_nationality" name="father_nationality" required>
                                                        <option value="">انتخاب کنید</option>
                                                        <?php 
                                                            mysqli_data_seek($nationalities, 0);
                                                            while($nationality = mysqli_fetch_assoc($nationalities)): 
                                                        ?>
                                                            <option value="<?php echo $nationality['option_value']; ?>" <?php echo ($father && $father['nationality'] == $nationality['option_value']) ? 'selected' : ''; ?>>
                                                                <?php echo $nationality['option_value']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_birthdate" class="form-control-label">تاریخ تولد</label>
                                                    <input type="date" class="form-control" id="father_birthdate" name="father_birthdate" value="<?php echo $father ? $father['birthdate'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_education" class="form-control-label">تحصیلات</label>
                                                    <select class="form-control" id="father_education" name="father_education" required>
                                                        <option value="">انتخاب کنید</option>
                                                        <?php 
                                                            mysqli_data_seek($educations, 0);
                                                            while($education = mysqli_fetch_assoc($educations)): 
                                                        ?>
                                                            <option value="<?php echo $education['option_value']; ?>" <?php echo ($father && $father['education'] == $education['option_value']) ? 'selected' : ''; ?>>
                                                                <?php echo $education['option_value']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_national_id" class="form-control-label">کد ملی</label>
                                                    <input type="text" class="form-control" id="father_national_id" name="father_national_id" value="<?php echo $father ? $father['national_id'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_passport_number" class="form-control-label">شماره پاسپورت</label>
                                                    <input type="text" class="form-control" id="father_passport_number" name="father_passport_number" value="<?php echo $father ? $father['passport_number'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_occupation" class="form-control-label">شغل</label>
                                                    <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="<?php echo $father ? $father['occupation'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_landline" class="form-control-label">تلفن ثابت</label>
                                                    <input type="text" class="form-control" id="father_landline" name="father_landline" value="<?php echo $father ? $father['landline'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_mobile_number" class="form-control-label">تلفن همراه</label>
                                                    <input type="text" class="form-control" id="father_mobile_number" name="father_mobile_number" value="<?php echo $father ? $father['mobile_number'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_whatsapp_number" class="form-control-label">شماره واتس‌اپ</label>
                                                    <input type="text" class="form-control" id="father_whatsapp_number" name="father_whatsapp_number" value="<?php echo $father ? $father['whatsapp_number'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="father_email" class="form-control-label">ایمیل</label>
                                                    <input type="email" class="form-control" id="father_email" name="father_email" value="<?php echo $father ? $father['email'] : ''; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="father_work_address" class="form-control-label">آدرس محل کار</label>
                                                    <textarea class="form-control" id="father_work_address" name="father_work_address" rows="3"><?php echo $father ? $father['work_address'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="father_employee_code" class="form-control-label">کد کارمندی</label>
                                                    <input type="text" class="form-control" id="father_employee_code" name="father_employee_code" value="<?php echo $father ? $father['employee_code'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="father_has_medical_condition" name="father_has_medical_condition" <?php echo ($father && $father['has_medical_condition']) ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="father_has_medical_condition">دارای شرایط پزشکی خاص</label>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="father_medical_details_div" style="<?php echo ($father && $father['has_medical_condition']) ? '' : 'display: none;'; ?>">
                                                    <label for="father_medical_condition_details" class="form-control-label">جزئیات شرایط پزشکی</label>
                                                    <textarea class="form-control" id="father_medical_condition_details" name="father_medical_condition_details" rows="3"><?php echo $father ? $father['medical_condition_details'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <button type="submit" name="update_father" class="btn btn-primary">بروزرسانی اطلاعات پدر</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- اطلاعات مادر -->
                                <div class="tab-pane fade" id="mother" role="tabpanel" aria-labelledby="mother-tab">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_full_name" class="form-control-label">نام و نام خانوادگی</label>
                                                    <input type="text" class="form-control" id="mother_full_name" name="mother_full_name" value="<?php echo $mother ? $mother['full_name'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_nationality" class="form-control-label">ملیت</label>
                                                    <select class="form-control" id="mother_nationality" name="mother_nationality" required>
                                                        <option value="">انتخاب کنید</option>
                                                        <?php 
                                                            mysqli_data_seek($nationalities, 0);
                                                            while($nationality = mysqli_fetch_assoc($nationalities)): 
                                                        ?>
                                                            <option value="<?php echo $nationality['option_value']; ?>" <?php echo ($mother && $mother['nationality'] == $nationality['option_value']) ? 'selected' : ''; ?>>
                                                                <?php echo $nationality['option_value']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_birthdate" class="form-control-label">تاریخ تولد</label>
                                                    <input type="date" class="form-control" id="mother_birthdate" name="mother_birthdate" value="<?php echo $mother ? $mother['birthdate'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_education" class="form-control-label">تحصیلات</label>
                                                    <select class="form-control" id="mother_education" name="mother_education" required>
                                                        <option value="">انتخاب کنید</option>
                                                        <?php 
                                                            mysqli_data_seek($educations, 0);
                                                            while($education = mysqli_fetch_assoc($educations)): 
                                                        ?>
                                                            <option value="<?php echo $education['option_value']; ?>" <?php echo ($mother && $mother['education'] == $education['option_value']) ? 'selected' : ''; ?>>
                                                                <?php echo $education['option_value']; ?>
                                                            </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_national_id" class="form-control-label">کد ملی</label>
                                                    <input type="text" class="form-control" id="mother_national_id" name="mother_national_id" value="<?php echo $mother ? $mother['national_id'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_passport_number" class="form-control-label">شماره پاسپورت</label>
                                                    <input type="text" class="form-control" id="mother_passport_number" name="mother_passport_number" value="<?php echo $mother ? $mother['passport_number'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_occupation" class="form-control-label">شغل</label>
                                                    <input type="text" class="form-control" id="mother_occupation" name="mother_occupation" value="<?php echo $mother ? $mother['occupation'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_landline" class="form-control-label">تلفن ثابت</label>
                                                    <input type="text" class="form-control" id="mother_landline" name="mother_landline" value="<?php echo $mother ? $mother['landline'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_mobile_number" class="form-control-label">تلفن همراه</label>
                                                    <input type="text" class="form-control" id="mother_mobile_number" name="mother_mobile_number" value="<?php echo $mother ? $mother['mobile_number'] : ''; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_whatsapp_number" class="form-control-label">شماره واتس‌اپ</label>
                                                    <input type="text" class="form-control" id="mother_whatsapp_number" name="mother_whatsapp_number" value="<?php echo $mother ? $mother['whatsapp_number'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mother_email" class="form-control-label">ایمیل</label>
                                                    <input type="email" class="form-control" id="mother_email" name="mother_email" value="<?php echo $mother ? $mother['email'] : ''; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mother_work_address" class="form-control-label">آدرس محل کار</label>
                                                    <textarea class="form-control" id="mother_work_address" name="mother_work_address" rows="3"><?php echo $mother ? $mother['work_address'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mother_employee_code" class="form-control-label">کد کارمندی</label>
                                                    <input type="text" class="form-control" id="mother_employee_code" name="mother_employee_code" value="<?php echo $mother ? $mother['employee_code'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="mother_has_medical_condition" name="mother_has_medical_condition" <?php echo ($mother && $mother['has_medical_condition']) ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="mother_has_medical_condition">دارای شرایط پزشکی خاص</label>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="mother_medical_details_div" style="<?php echo ($mother && $mother['has_medical_condition']) ? '' : 'display: none;'; ?>">
                                                    <label for="mother_medical_condition_details" class="form-control-label">جزئیات شرایط پزشکی</label>
                                                    <textarea class="form-control" id="mother_medical_condition_details" name="mother_medical_condition_details" rows="3"><?php echo $mother ? $mother['medical_condition_details'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <button type="submit" name="update_mother" class="btn btn-primary">بروزرسانی اطلاعات مادر</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    
    <script>
        // نمایش/پنهان کردن فیلد جزئیات شرایط پزشکی پدر
        document.getElementById('father_has_medical_condition').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('father_medical_details_div').style.display = 'block';
            } else {
                document.getElementById('father_medical_details_div').style.display = 'none';
            }
        });
        
        // نمایش/پنهان کردن فیلد جزئیات شرایط پزشکی مادر
        document.getElementById('mother_has_medical_condition').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('mother_medical_details_div').style.display = 'block';
            } else {
                document.getElementById('mother_medical_details_div').style.display = 'none';
            }
        });
    </script>
</body>
</html>