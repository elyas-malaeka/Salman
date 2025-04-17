<?php
ini_set('display_errors', 1); error_reporting(E_ALL);
/**
 * صفحه ثبت‌نام آنلاین مدرسه سلمان فارسی - نسخه ماژولار
 * 
 * فرم چند مرحله‌ای ثبت‌نام دانش‌آموز با طراحی ماژولار و قابل مدیریت از داشبورد
 * 
 * @package Salman Educational Complex
 * @version 4.2
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'includes/config.php';
require_once 'includes/registration-functions.php';
require_once 'includes/form-builder.php'; // فایل جدید برای ساخت فرم‌های ماژولار

// دریافت زبان فعلی
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
if (!in_array($lang, ['fa', 'en', 'ar'])) {
    $lang = 'fa';
}

// تنظیم جهت نمایش بر اساس زبان
$isRtl = ($lang == 'fa' || $lang == 'ar');

// تبدیل کد زبان به شناسه زبان برای کوئری‌ها
$langId = 1; // Default to Persian
if ($lang == 'en') {
    $langId = 2;
} else if ($lang == 'ar') {
    $langId = 3;
}

// ایجاد نمونه از کلاس FormBuilder
$formBuilder = new FormBuilder($db, $langId, $lang);

// دریافت ترجمه‌ها
$translations = $formBuilder->getTranslations();

// دریافت عنوان‌های صفحه
$pageTitle = isset($translations['page_title']) ? $translations['page_title'] : 'ثبت‌نام آنلاین';
$headerTitle = isset($translations['header_title']) ? $translations['header_title'] : 'ثبت‌نام در مجتمع آموزشی سلمان فارسی';
$headerSubtitle = isset($translations['header_subtitle']) ? $translations['header_subtitle'] : 'لطفاً فرم را با دقت تکمیل نمایید. تمامی فیلدهای علامت‌گذاری شده با * الزامی هستند.';

// AJAX برای ثبت فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerSubmit'])) {
    // دریافت داده‌های فرم
    $formData = $_POST;
    $formFiles = $_FILES;
    
    // حذف فیلد جنسیت و تنظیم به مقدار پیش‌فرض پسر
    $formData['gender'] = 'male';
    
    // ذخیره اطلاعات در دیتابیس
    $result = saveRegistration($formData, $formFiles);
    
    // ارسال پاسخ JSON
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}

// دریافت پایه‌های تحصیلی و رشته‌ها برای استفاده در جاوااسکریپت
$academicGrades = $formBuilder->getAcademicGrades();
$majors = $formBuilder->getMajors();

// دریافت شهرهای سرویس
$transportationCities = $formBuilder->getTransportationCities();

// تولید JavaScript برای انتقال داده‌ها به سمت کلاینت
$jsData = "const academicGrades = " . json_encode($academicGrades) . ";\n";
$jsData .= "const majors = " . json_encode($majors) . ";\n";
$jsData .= "const transportationCities = " . json_encode($transportationCities) . ";\n";
$jsData .= "const currentLang = '" . $lang . "';\n";
$jsData .= "const isRtl = " . ($isRtl ? 'true' : 'false') . ";\n";

// تولید JavaScript برای ترجمه‌ها
$translationsJS = [];
$translationKeys = [
    'fileTypeError', 'fileSizeError', 'errorSummary', 'studentInfo', 'fatherInfo', 
    'motherInfo', 'additionalInfo', 'submitting', 'serverError', 'notFilled',
    'yes', 'no', 'agreed', 'notAgreed', 'invalidNationalId', 'invalidEmail', 'invalidPhone',
    'loadingRoutes', 'selectRoute', 'errorLoadingRoutes', 'select_city_first',
    'requiredDocuments', 'agreements'
];

foreach ($translationKeys as $key) {
    if (isset($translations[$key])) {
        $translationsJS[$key] = $translations[$key];
    }
}

// اضافه کردن ترجمه‌های مربوط به بخش سرویس حمل و نقل
$translationsJS['transportation_question'] = isset($translations['need_transportation']) ? $translations['need_transportation'] : 'آیا به سرویس مدرسه نیاز دارید؟';
$translationsJS['yes'] = isset($translations['yes_option']) ? $translations['yes_option'] : 'بله';
$translationsJS['no'] = isset($translations['no_option']) ? $translations['no_option'] : 'خیر';
$translationsJS['no_transportation_needed'] = isset($translations['no_transportation_needed']) ? $translations['no_transportation_needed'] : 'بدون نیاز به سرویس';

$jsData .= "const translations = " . json_encode($translationsJS) . ";\n";
$jsData .= "const requiredText = \"" . (isset($translations['required_field']) ? $translations['required_field'] : 'پر کردن این فیلد الزامی است') . "\";\n";

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
<script>
// مخفی کردن همه خطاهای کنسول از کاربران نهایی
if (window.location.hostname !== 'localhost') {
    console.log = function() {};
    console.error = function() {};
    console.warn = function() {};
}
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | <?php echo SITE_NAME; ?></title>
    
    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>
    
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">

    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/typography.css.php'; ?>
    <?php include_once 'assets/css/rtl-support.css.php'; ?>

    <!-- Page Specific CSS -->
    <?php include_once 'assets/css/pages/registration.css.php'; ?>
    
</head>
<body>
    <!-- Loading Spinner -->
    <div class="spinner-container" id="loadingSpinner">
        <div class="spinner"></div>
    </div>
    
    <div class="page-wrapper">
        <!-- منوی سایت -->
        <?php include_once 'includes/menu.php'; ?>
        
        <!-- هدر صفحه ثبت‌نام (کیهانی) -->
        <section class="cosmic-header text-center">
            <div class="container">
                <h1 class="cosmic-header__title"><?php echo $headerTitle; ?></h1>
                <p class="cosmic-header__subtitle"><?php echo $headerSubtitle; ?></p>
            </div>
            <div class="cosmic-bg">
                <!-- ستاره‌ها و سیارات بصورت پویا با JavaScript اضافه می‌شوند -->
            </div>
        </section>
        
        <!-- فرم ثبت‌نام -->
        <section class="registration-section">
            <div class="container">
                <div class="registration-container">
                    <!-- نوار پیشرفت مراحل -->
                    <?php echo $formBuilder->buildProgressBar(); ?>
                    
                    <!-- فرم ثبت‌نام -->
                    <form id="registrationForm" enctype="multipart/form-data" novalidate>
                        <?php echo $formBuilder->buildMultiStepForm(); ?>
                    </form>
                </div>
            </div>
        </section>
        
        <!-- مودال خلاصه اطلاعات -->
        <div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary text-white">
                        <h5 class="modal-title" id="summaryModalLabel"><?php echo isset($translations['summary_title']) ? $translations['summary_title'] : 'خلاصه اطلاعات ثبت‌نام'; ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="summaryContent">
                        <!-- محتوای مودال توسط جاوااسکریپت پر می‌شود -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo isset($translations['edit_button']) ? $translations['edit_button'] : 'ویرایش اطلاعات'; ?></button>
                        <button type="button" class="btn btn-primary" id="confirmButton"><?php echo isset($translations['confirm_button']) ? $translations['confirm_button'] : 'تأیید و ادامه'; ?></button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- فوتر سایت -->
        <?php include_once 'includes/footer.php'; ?>
    </div><!-- /.page-wrapper -->

    <!-- اسکریپت‌های مورد نیاز -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- دیتا و ترجمه‌ها -->
    <script>
        <?php echo $jsData; ?>
        
        // تنظیم برچسب‌های فیلدها
        const fieldLabels = {
            firstName: '<?php echo isset($translations['first_name']) ? $translations['first_name'] : 'نام'; ?>',
            lastName: '<?php echo isset($translations['last_name']) ? $translations['last_name'] : 'نام خانوادگی'; ?>',
            fatherName: '<?php echo isset($translations['father_name']) ? $translations['father_name'] : 'نام پدر'; ?>',
            nationalId: '<?php echo isset($translations['national_id']) ? $translations['national_id'] : 'کد ملی'; ?>',
            passportNumber: '<?php echo isset($translations['passport_number']) ? $translations['passport_number'] : 'شماره پاسپورت'; ?>',
            birthPlace: '<?php echo isset($translations['birth_place']) ? $translations['birth_place'] : 'محل تولد'; ?>',
            birthDate: '<?php echo isset($translations['birth_date']) ? $translations['birth_date'] : 'تاریخ تولد'; ?>',
            religion: '<?php echo isset($translations['religion']) ? $translations['religion'] : 'دین'; ?>',
            nationality: '<?php echo isset($translations['nationality']) ? $translations['nationality'] : 'ملیت'; ?>',
            academicGrade: '<?php echo isset($translations['academic_grade']) ? $translations['academic_grade'] : 'پایه تحصیلی'; ?>',
            major: '<?php echo isset($translations['major']) ? $translations['major'] : 'رشته تحصیلی'; ?>',
            address: '<?php echo isset($translations['address']) ? $translations['address'] : 'آدرس محل سکونت'; ?>',
            mainPhone: '<?php echo isset($translations['main_phone']) ? $translations['main_phone'] : 'شماره تماس اصلی'; ?>',
            emergencyContact: '<?php echo isset($translations['emergency_contact']) ? $translations['emergency_contact'] : 'نام تماس اضطراری'; ?>',
            emergencyPhone: '<?php echo isset($translations['emergency_phone']) ? $translations['emergency_phone'] : 'شماره تماس اضطراری'; ?>',
            
            profilePhoto: '<?php echo isset($translations['profile_photo']) ? $translations['profile_photo'] : 'عکس پرسنلی'; ?>',
            passportDoc: '<?php echo isset($translations['passport_doc']) ? $translations['passport_doc'] : 'صفحه اول پاسپورت'; ?>',
            nationalIdDoc: '<?php echo isset($translations['national_id_doc']) ? $translations['national_id_doc'] : 'کارت ملی'; ?>',
            birthCertificate: '<?php echo isset($translations['birth_certificate']) ? $translations['birth_certificate'] : 'شناسنامه'; ?>',
            academicCertificate: '<?php echo isset($translations['academic_certificate']) ? $translations['academic_certificate'] : 'مدرک تحصیلی'; ?>',
            emiratesId: '<?php echo isset($translations['emirates_id']) ? $translations['emirates_id'] : 'شناسه امارات'; ?>',
            
            needTransportation: '<?php echo isset($translations['need_transportation']) ? $translations['need_transportation'] : 'آیا به سرویس مدرسه نیاز دارید؟'; ?>',
            transportationCity: '<?php echo isset($translations['transportation_city']) ? $translations['transportation_city'] : 'شهر'; ?>',
            transportationRoute: '<?php echo isset($translations['transportation_route']) ? $translations['transportation_route'] : 'مسیر'; ?>',
            transportationLocation: '<?php echo isset($translations['transportation_stop']) ? $translations['transportation_stop'] : 'محل سوار شدن'; ?>',
            
            fatherFullName: '<?php echo isset($translations['father_full_name']) ? $translations['father_full_name'] : 'نام کامل پدر'; ?>',
            fatherNationality: '<?php echo isset($translations['father_nationality']) ? $translations['father_nationality'] : 'ملیت پدر'; ?>',
            fatherBirthDate: '<?php echo isset($translations['father_birth_date']) ? $translations['father_birth_date'] : 'تاریخ تولد پدر'; ?>',
            fatherNationalId: '<?php echo isset($translations['father_national_id']) ? $translations['father_national_id'] : 'کد ملی پدر'; ?>',
            fatherPassportNumber: '<?php echo isset($translations['father_passport_number']) ? $translations['father_passport_number'] : 'شماره پاسپورت پدر'; ?>',
            fatherEducation: '<?php echo isset($translations['father_education']) ? $translations['father_education'] : 'تحصیلات پدر'; ?>',
            fatherOccupation: '<?php echo isset($translations['father_occupation']) ? $translations['father_occupation'] : 'شغل پدر'; ?>',
            fatherPhone: '<?php echo isset($translations['father_phone']) ? $translations['father_phone'] : 'تلفن ثابت پدر'; ?>',
            fatherMobile: '<?php echo isset($translations['father_mobile']) ? $translations['father_mobile'] : 'تلفن همراه پدر'; ?>',
            fatherWhatsapp: '<?php echo isset($translations['father_whatsapp']) ? $translations['father_whatsapp'] : 'شماره واتساپ پدر'; ?>',
            fatherEmail: '<?php echo isset($translations['father_email']) ? $translations['father_email'] : 'ایمیل پدر'; ?>',
            fatherWorkAddress: '<?php echo isset($translations['father_work_address']) ? $translations['father_work_address'] : 'آدرس محل کار پدر'; ?>',
            fatherEmployeeCode: '<?php echo isset($translations['father_employee_code']) ? $translations['father_employee_code'] : 'کد کارمندی پدر'; ?>',
            
            motherFullName: '<?php echo isset($translations['mother_full_name']) ? $translations['mother_full_name'] : 'نام کامل مادر'; ?>',
            motherNationality: '<?php echo isset($translations['mother_nationality']) ? $translations['mother_nationality'] : 'ملیت مادر'; ?>',
            motherBirthDate: '<?php echo isset($translations['mother_birth_date']) ? $translations['mother_birth_date'] : 'تاریخ تولد مادر'; ?>',
            motherNationalId: '<?php echo isset($translations['mother_national_id']) ? $translations['mother_national_id'] : 'کد ملی مادر'; ?>',
            motherPassportNumber: '<?php echo isset($translations['mother_passport_number']) ? $translations['mother_passport_number'] : 'شماره پاسپورت مادر'; ?>',
            motherEducation: '<?php echo isset($translations['mother_education']) ? $translations['mother_education'] : 'تحصیلات مادر'; ?>',
            motherOccupation: '<?php echo isset($translations['mother_occupation']) ? $translations['mother_occupation'] : 'شغل مادر'; ?>',
            motherPhone: '<?php echo isset($translations['mother_phone']) ? $translations['mother_phone'] : 'تلفن ثابت مادر'; ?>',
            motherMobile: '<?php echo isset($translations['mother_mobile']) ? $translations['mother_mobile'] : 'تلفن همراه مادر'; ?>',
            motherWhatsapp: '<?php echo isset($translations['mother_whatsapp']) ? $translations['mother_whatsapp'] : 'شماره واتساپ مادر'; ?>',
            motherEmail: '<?php echo isset($translations['mother_email']) ? $translations['mother_email'] : 'ایمیل مادر'; ?>',
            motherWorkAddress: '<?php echo isset($translations['mother_work_address']) ? $translations['mother_work_address'] : 'آدرس محل کار مادر'; ?>',
            motherEmployeeCode: '<?php echo isset($translations['mother_employee_code']) ? $translations['mother_employee_code'] : 'کد کارمندی مادر'; ?>',
            
            specialNotes: '<?php echo isset($translations['special_notes']) ? $translations['special_notes'] : 'نکات ویژه / درخواست‌های اضافی'; ?>'
        };
        
        // تنظیم فیلدهای فایل
        const fileFields = [
            'profilePhoto', 
            'passportDoc', 
            'nationalIdDoc', 
            'birthCertificate', 
            'academicCertificate', 
            'emiratesId'
        ];
    </script>
    
    <!-- اسکریپت اختصاصی فرم ثبت‌نام -->
    <script src="assets/js/modular-form-manager.js"></script>
    
    <!-- راه‌اندازی کلاس مدیریت فرم -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new ModularFormManager();
            
            // افزودن کلاس selected به رادیو باتن‌های سرویس هنگام انتخاب
            const transportationRadios = document.querySelectorAll('input[name="needTransportation"]');
            
            transportationRadios.forEach(radio => {
                // بررسی وضعیت اولیه
                if (radio.checked) {
                    radio.closest('.transportation-option').classList.add('selected');
                }
                
                // شنونده رویداد برای تغییرات
                radio.addEventListener('change', function() {
                    // حذف کلاس selected از همه گزینه‌ها
                    document.querySelectorAll('.transportation-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // اضافه کردن کلاس selected به گزینه انتخاب شده
                    if (this.checked) {
                        this.closest('.transportation-option').classList.add('selected');
                    }
                });
            });
        });
    </script>
    
</body>
</html>