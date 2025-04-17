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

// آپلود مدرک جدید
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $document_type = mysqli_real_escape_string($db, $_POST['document_type']);
    
    // بررسی آپلود فایل
    if(isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        $filename = $_FILES['document']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if(in_array(strtolower($ext), $allowed)) {
            // ایجاد نام منحصر به فرد برای فایل
            $new_filename = uniqid() . '_' . time() . '.' . $ext;
            $upload_dir = "../Registration/uploads/documents/";
            
            // ایجاد پوشه در صورت نیاز
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $upload_path = $upload_dir . $new_filename;
            
            if(move_uploaded_file($_FILES['document']['tmp_name'], $upload_path)) {
                $file_path = "Registration/uploads/documents/" . $new_filename;
                
                $insert_query = "INSERT INTO documents (student_id, document_type, file_path, upload_date) 
                               VALUES ($student_id, '$document_type', '$file_path', NOW())";
                $insert_result = mysqli_query($db, $insert_query);
                
                if($insert_result) {
                    // ثبت در لاگ سیستم
                    $log_description = "مدرک جدید برای دانش‌آموز {$student['first_name']} {$student['last_name']} آپلود شد";
                    mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
                        ('{$_SESSION['admin_id']}', 'upload_document', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
                    
                    $success_message = "مدرک با موفقیت آپلود شد.";
                } else {
                    $error_message = "خطا در ثبت اطلاعات مدرک: " . mysqli_error($db);
                }
            } else {
                $error_message = "خطا در آپلود فایل!";
            }
        } else {
            $error_message = "فقط فایل‌های با پسوند jpg, jpeg, png و pdf مجاز هستند.";
        }
    } else {
        $error_message = "لطفاً یک فایل انتخاب کنید.";
    }
}

// حذف مدرک
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $document_id = $_GET['delete'];
    
    // دریافت اطلاعات مدرک قبل از حذف
    $doc_query = "SELECT * FROM documents WHERE document_id = $document_id AND student_id = $student_id";
    $doc_result = mysqli_query($db, $doc_query);
    
    if(mysqli_num_rows($doc_result) > 0) {
        $document = mysqli_fetch_assoc($doc_result);
        
        // حذف فایل از سرور
        if(file_exists("../" . $document['file_path'])) {
            unlink("../" . $document['file_path']);
        }
        
        // حذف رکورد از دیتابیس
        $delete_query = "DELETE FROM documents WHERE document_id = $document_id";
        $delete_result = mysqli_query($db, $delete_query);
        
        if($delete_result) {
            // ثبت در لاگ سیستم
            $log_description = "مدرک با شناسه $document_id برای دانش‌آموز {$student['first_name']} {$student['last_name']} حذف شد";
            mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES 
                ('{$_SESSION['admin_id']}', 'delete_document', '$log_description', '{$_SERVER['REMOTE_ADDR']}')");
            
            $success_message = "مدرک با موفقیت حذف شد.";
        } else {
            $error_message = "خطا در حذف مدرک: " . mysqli_error($db);
        }
    } else {
        $error_message = "مدرک مورد نظر یافت نشد.";
    }
}

// دریافت لیست مدارک دانش‌آموز
$documents_query = "SELECT * FROM documents WHERE student_id = $student_id ORDER BY upload_date DESC";
$documents = mysqli_query($db, $documents_query);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت مدارک دانش‌آموز - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .document-preview {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        
        .document-card {
            border: 1px solid #e9ecef;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        
        .document-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .document-actions {
            position: absolute;
            top: 10px;
            right: 10px;
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
                                <h6 class="mb-0">مدیریت مدارک دانش‌آموز: <?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h6>
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
                            
                            <!-- فرم آپلود مدرک جدید -->
                            <div class="card mb-4">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">آپلود مدرک جدید</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="document_type" class="form-control-label">نوع مدرک</label>
                                                    <select name="document_type" id="document_type" class="form-control" required>
                                                        <option value="">انتخاب کنید</option>
                                                        <option value="emirates_id">شناسایی اماراتی</option>
                                                        <option value="passport">پاسپورت</option>
                                                        <option value="national_id">کارت ملی</option>
                                                        <option value="birth_certificate">شناسنامه</option>
                                                        <option value="academic_certificate">مدرک تحصیلی</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="document" class="form-control-label">فایل</label>
                                                    <input type="file" class="form-control" id="document" name="document" required>
                                                    <small class="form-text text-muted">فایل‌های jpg, jpeg, png و pdf با حداکثر حجم 5MB مجاز هستند.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="submit" name="upload" class="btn btn-primary">آپلود</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- نمایش مدارک موجود -->
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h6>مدارک آپلود شده</h6>
                                </div>
                                
                                <?php if(mysqli_num_rows($documents) > 0): ?>
                                    <?php while($document = mysqli_fetch_assoc($documents)): ?>
                                        <div class="col-md-3 col-sm-6 mb-4">
                                            <div class="card document-card position-relative">
                                                <div class="document-actions">
                                                    <a href="documents.php?id=<?php echo $student_id; ?>&delete=<?php echo $document['document_id']; ?>" 
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('آیا از حذف این مدرک اطمینان دارید؟')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                                <div class="card-body text-center">
                                                    <?php 
                                                        // نمایش پیش‌نمایش بر اساس نوع فایل
                                                        $file_ext = pathinfo($document['file_path'], PATHINFO_EXTENSION);
                                                        if(in_array(strtolower($file_ext), ['jpg', 'jpeg', 'png'])):
                                                    ?>
                                                        <a href="../<?php echo $document['file_path']; ?>" target="_blank">
                                                            <img src="../<?php echo $document['file_path']; ?>" class="document-preview mb-3" alt="Preview">
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="../<?php echo $document['file_path']; ?>" target="_blank">
                                                            <i class="fas fa-file-pdf fa-3x mb-3 text-danger"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <h6 class="mb-0">
                                                        <?php 
                                                            switch($document['document_type']) {
                                                                case 'emirates_id':
                                                                    echo 'شناسایی اماراتی';
                                                                    break;
                                                                case 'passport':
                                                                    echo 'پاسپورت';
                                                                    break;
                                                                case 'national_id':
                                                                    echo 'کارت ملی';
                                                                    break;
                                                                case 'birth_certificate':
                                                                    echo 'شناسنامه';
                                                                    break;
                                                                case 'academic_certificate':
                                                                    echo 'مدرک تحصیلی';
                                                                    break;
                                                                default:
                                                                    echo 'سایر';
                                                            }
                                                        ?>
                                                    </h6>
                                                    <small class="text-muted">
                                                        <?php echo date('Y/m/d H:i', strtotime($document['upload_date'])); ?>
                                                    </small>
                                                    <div class="mt-2">
                                                        <a href="../<?php echo $document['file_path']; ?>" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> مشاهده
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <div class="alert alert-warning">
                                            هیچ مدرکی برای این دانش‌آموز آپلود نشده است.
                                        </div>
                                    </div>
                                <?php endif; ?>
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
</body>
</html>