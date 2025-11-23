<?php
/**
 * مدیریت محتوای صفحه ثبت‌نام موفق - نسخه ساده
 * 
 * این صفحه به مدیر سایت امکان مدیریت محتوای صفحه ثبت‌نام موفق را می‌دهد
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

// تنظیمات پایه
$SCHOOL_NAME = "مجتمع آموزشی سلمان فارسی";
$ADMIN_TITLE = "پنل مدیریت " . $SCHOOL_NAME;

// شامل‌سازی فایل‌های مورد نیاز
require_once '../includes/config.php';



// دریافت پارامترها
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$content_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';

// پیغام‌ها
$message = '';
$error = '';

// دریافت زبان‌های فعال
$languages = [];
$query = "SELECT * FROM languages WHERE is_active = 1 ORDER BY is_default DESC, name ASC";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
    $languages[$row['language_id']] = $row;
}

// پردازش فرم‌ها
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_content'])) {
        $content_id = isset($_POST['content_id']) ? intval($_POST['content_id']) : 0;
        $lang_id = isset($_POST['lang_id']) ? intval($_POST['lang_id']) : 0;
        $content_value = isset($_POST['content_value']) ? $_POST['content_value'] : '';
        
        if ($content_id && $lang_id) {
            // بررسی وجود ترجمه قبلی
            $check_query = "SELECT translation_id FROM registration_success_translations 
                           WHERE content_id = ? AND language_id = ?";
            $check_stmt = $db->prepare($check_query);
            $check_stmt->bind_param("ii", $content_id, $lang_id);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows > 0) {
                // بروزرسانی ترجمه موجود
                $query = "UPDATE registration_success_translations 
                          SET content_value = ? 
                          WHERE content_id = ? AND language_id = ?";
                
                $stmt = $db->prepare($query);
                $stmt->bind_param("sii", $content_value, $content_id, $lang_id);
            } else {
                // ایجاد ترجمه جدید
                $query = "INSERT INTO registration_success_translations 
                         (content_id, language_id, content_value) 
                         VALUES (?, ?, ?)";
                         
                $stmt = $db->prepare($query);
                $stmt->bind_param("iis", $content_id, $lang_id, $content_value);
            }
            
            if ($stmt->execute()) {
                $message = 'محتوا با موفقیت ذخیره شد.';
            } else {
                $error = 'خطا در ذخیره محتوا: ' . $db->error;
            }
        }
    }
}

// دریافت لیست محتوا
$contents = [];
if ($action === 'list') {
    $lang_id = 0;
    foreach ($languages as $language) {
        if ($language['code'] === $lang) {
            $lang_id = $language['language_id'];
            break;
        }
    }
    
    $query = "SELECT c.content_id, c.content_key, t.content_value, t.language_id 
              FROM registration_success_content c
              LEFT JOIN registration_success_translations t ON c.content_id = t.content_id AND t.language_id = ?
              ORDER BY c.content_key";
    
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $lang_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $contents[] = $row;
    }
}

// دریافت محتوا برای ویرایش
$content_item = null;
$translations = [];

if ($action === 'edit' && $content_id) {
    // دریافت اطلاعات محتوا
    $query = "SELECT * FROM registration_success_content WHERE content_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $content_id);
    $stmt->execute();
    $content_item = $stmt->get_result()->fetch_assoc();
    
    if ($content_item) {
        // دریافت ترجمه‌ها
        $query = "SELECT t.*, l.code, l.name as language_name, l.native_name, l.is_rtl 
                  FROM registration_success_translations t
                  JOIN languages l ON t.language_id = l.language_id
                  WHERE t.content_id = ?";
        
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $content_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $translations[$row['language_id']] = $row;
        }
        
        // اضافه کردن زبان‌های بدون ترجمه
        foreach ($languages as $language_id => $language) {
            if (!isset($translations[$language_id])) {
                $translations[$language_id] = [
                    'translation_id' => 0,
                    'content_id' => $content_id,
                    'language_id' => $language_id,
                    'content_value' => '',
                    'code' => $language['code'],
                    'language_name' => $language['name'],
                    'native_name' => $language['native_name'],
                    'is_rtl' => $language['is_rtl']
                ];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت محتوای صفحه ثبت‌نام موفق | <?php echo $ADMIN_TITLE; ?></title>
    
    <!-- استایل‌ها -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @font-face {
            font-family: Vazir;
            src: url('../assets/fonts/Vazir.eot');
            src: url('../assets/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                 url('../assets/fonts/Vazir.woff2') format('woff2'),
                 url('../assets/fonts/Vazir.woff') format('woff'),
                 url('../assets/fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        body {
            font-family: 'Vazir', tahoma, Arial;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        
        .btn-back {
            margin-bottom: 20px;
        }
        
        .content-key {
            font-weight: bold;
            color: #0056b3;
        }
        
        .tab-content {
            padding-top: 20px;
        }
        
        .text-truncate-custom {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>مدیریت محتوای صفحه ثبت‌نام موفق</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-right ml-1"></i> بازگشت به داشبورد
                </a>
            </div>
        </div>
        
        <?php if ($message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if ($action === 'list'): ?>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>محتوای صفحه ثبت‌نام موفق</h3>
                
                <div class="d-flex align-items-center">
                    <label class="me-2">زبان:</label>
                    <select class="form-select" id="language-selector" style="width: auto;">
                        <?php foreach ($languages as $language): ?>
                        <option value="<?php echo $language['code']; ?>" <?php echo ($lang === $language['code']) ? 'selected' : ''; ?>>
                            <?php echo $language['name']; ?> 
                            <?php if ($language['native_name']): ?>
                            (<?php echo $language['native_name']; ?>)
                            <?php endif; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>کلید محتوا</th>
                                <th>محتوا</th>
                                <th style="width: 120px;">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contents as $content): ?>
                            <tr>
                                <td class="content-key"><?php echo $content['content_key']; ?></td>
                                <td>
                                    <?php 
                                    if (isset($content['content_value'])) {
                                        echo '<span class="text-truncate-custom">' . 
                                             htmlspecialchars($content['content_value']) . 
                                             '</span>';
                                    } else {
                                        echo '<span class="badge bg-warning text-dark">ترجمه نشده</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="registration-success-content.php?action=edit&id=<?php echo $content['content_id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> ویرایش
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <?php elseif ($action === 'edit' && $content_item): ?>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>ویرایش محتوا: <?php echo $content_item['content_key']; ?></h3>
                    <a href="registration-success-content.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> بازگشت به لیست
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="alert alert-info">
                    <p>در این بخش می‌توانید محتوای "<strong><?php echo $content_item['content_key']; ?></strong>" را در زبان‌های مختلف ویرایش کنید.</p>
                </div>
                
                <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                    <?php foreach ($translations as $index => $translation): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo ($index === key($translations)) ? 'active' : ''; ?>" 
                               id="lang-<?php echo $translation['code']; ?>-tab" 
                               data-bs-toggle="tab" 
                               data-bs-target="#lang-<?php echo $translation['code']; ?>" 
                               type="button"
                               role="tab"
                               aria-selected="<?php echo ($index === key($translations)) ? 'true' : 'false'; ?>">
                            <?php echo $translation['language_name']; ?> 
                            <?php if ($translation['native_name']): ?>
                            (<?php echo $translation['native_name']; ?>)
                            <?php endif; ?>
                        </button>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="tab-content mt-4" id="languageTabsContent">
                    <?php foreach ($translations as $index => $translation): ?>
                    <div class="tab-pane fade <?php echo ($index === key($translations)) ? 'show active' : ''; ?>" 
                         id="lang-<?php echo $translation['code']; ?>" 
                         role="tabpanel">
                        
                        <form action="registration-success-content.php?action=edit&id=<?php echo $content_id; ?>" method="post">
                            <input type="hidden" name="content_id" value="<?php echo $content_item['content_id']; ?>">
                            <input type="hidden" name="lang_id" value="<?php echo $translation['language_id']; ?>">
                            
                            <div class="mb-3">
                                <label for="content_value_<?php echo $translation['code']; ?>" class="form-label">
                                    محتوا (<?php echo $translation['language_name']; ?>)
                                </label>
                                <textarea class="form-control" 
                                          id="content_value_<?php echo $translation['code']; ?>" 
                                          name="content_value" 
                                          rows="5"
                                          dir="<?php echo $translation['is_rtl'] ? 'rtl' : 'ltr'; ?>"><?php echo htmlspecialchars($translation['content_value']); ?></textarea>
                            </div>
                            
                            <button type="submit" name="save_content" class="btn btn-primary">
                                <i class="fas fa-save"></i> ذخیره ترجمه <?php echo $translation['language_name']; ?>
                            </button>
                        </form>
                        
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- اسکریپت‌ها -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // زمانی که زبان تغییر می‌کند، صفحه را به‌روزرسانی کنید
    document.getElementById('language-selector').addEventListener('change', function() {
        window.location.href = 'registration-success-content.php?lang=' + this.value;
    });
    </script>
</body>
</html>