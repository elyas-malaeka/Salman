<?php
/**
 * پنل مدیریت محتوای وبلاگ
 * 
 * امکان تغییر متون ثابت و تنظیمات ویجت‌ها
 * 
 * @package Salman Educational Complex
 * @version 3.0
 * @updated 2025-03-30
 */

// لود کردن فایل کانفیگ و بررسی دسترسی مدیر
require_once '../../includes/config.php';


// اتصال به دیتابیس
$conn = connectDB();

// دریافت زبان فعلی
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
if (!in_array($lang, ['fa', 'en', 'ar'])) {
    $lang = 'fa';
}

// پردازش فرم در صورت ارسال
$message = '';
$messageType = '';

if (isset($_POST['save_content'])) {
    // آپدیت محتوای متنی
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'content_') === 0) {
            $field_key = substr($key, 8); // حذف پیشوند 'content_'
            
            $stmt = $conn->prepare("UPDATE blog_content SET content = ? WHERE field_key = ? AND language_id = ?");
            $stmt->bind_param("sss", $value, $field_key, $lang);
            $stmt->execute();
        }
    }
    
    // آپدیت وضعیت نمایش ویجت‌ها
    $widgets = ['search', 'latest_posts', 'categories', 'popular_posts'];
    
    foreach ($widgets as $widget) {
        $visible = isset($_POST['widget_' . $widget]) ? 1 : 0;
        $order = isset($_POST['order_' . $widget]) ? intval($_POST['order_' . $widget]) : 999;
        
        // آپدیت وضعیت نمایش
        $stmt = $conn->prepare("UPDATE blog_content SET content = ? WHERE field_key = ? AND language_id = 'fa'");
        $visibleStr = (string)$visible;
        $visibleKey = $widget . '_visible';
        $stmt->bind_param("ss", $visibleStr, $visibleKey);
        $stmt->execute();
        
        // آپدیت ترتیب نمایش
        $stmt = $conn->prepare("UPDATE blog_content SET content = ? WHERE field_key = ? AND language_id = 'fa'");
        $orderStr = (string)$order;
        $orderKey = $widget . '_order';
        $stmt->bind_param("ss", $orderStr, $orderKey);
        $stmt->execute();
    }
    
    $message = 'تغییرات با موفقیت ذخیره شد.';
    $messageType = 'success';
}

// دریافت محتوای فعلی
$query = "SELECT field_key, content FROM blog_content WHERE language_id = ? ORDER BY section_id, sort_order";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();

$content = [];
while ($row = $result->fetch_assoc()) {
    $content[$row['field_key']] = $row['content'];
}

// دریافت وضعیت نمایش ویجت‌ها
$widgets_query = "SELECT field_key, content FROM blog_content WHERE field_key LIKE '%_visible' OR field_key LIKE '%_order'";
$widgets_result = mysqli_query($conn, $widgets_query);

$widget_settings = [];
while ($row = mysqli_fetch_assoc($widgets_result)) {
    $widget_settings[$row['field_key']] = $row['content'];
}

// بستن اتصال دیتابیس
closeDB($conn);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo ($lang == 'fa' || $lang == 'ar') ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت محتوای وبلاگ - مجتمع آموزشی سلمان</title>
    
    <!-- Bootstrap RTL for Persian/Arabic -->
    <?php if ($lang == 'fa' || $lang == 'ar'): ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css">
    <?php else: ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <?php endif; ?>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom Admin Styles -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    
    <?php if ($lang == 'fa'): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
    <?php elseif ($lang == 'ar'): ?>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    <?php endif; ?>
</head>
<body>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">مدیریت محتوای وبلاگ</h1>
                    <div class="btn-toolbar">
                        <div class="btn-group me-2">
                            <a href="?lang=fa" class="btn btn-sm btn-outline-secondary <?php echo $lang == 'fa' ? 'active' : ''; ?>">فارسی</a>
                            <a href="?lang=en" class="btn btn-sm btn-outline-secondary <?php echo $lang == 'en' ? 'active' : ''; ?>">English</a>
                            <a href="?lang=ar" class="btn btn-sm btn-outline-secondary <?php echo $lang == 'ar' ? 'active' : ''; ?>">العربية</a>
                        </div>
                    </div>
                </div>
                
                <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <form method="post" action="">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">تنظیمات ویجت‌ها</h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#widgetsCollapse">
                                <i class="fas fa-cog"></i> نمایش/مخفی
                            </button>
                        </div>
                        <div class="collapse show" id="widgetsCollapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ویجت</th>
                                                <th>نمایش</th>
                                                <th>ترتیب</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>جستجو</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="widget_search" id="widget_search" 
                                                            <?php echo isset($widget_settings['search_visible']) && $widget_settings['search_visible'] == '1' ? 'checked' : ''; ?>>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" name="order_search" min="1" max="10" 
                                                        value="<?php echo $widget_settings['search_order'] ?? '1'; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>آخرین مطالب</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="widget_latest_posts" id="widget_latest_posts" 
                                                            <?php echo isset($widget_settings['latest_posts_visible']) && $widget_settings['latest_posts_visible'] == '1' ? 'checked' : ''; ?>>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" name="order_latest_posts" min="1" max="10" 
                                                        value="<?php echo $widget_settings['latest_posts_order'] ?? '2'; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>دسته‌بندی‌ها</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="widget_categories" id="widget_categories" 
                                                            <?php echo isset($widget_settings['categories_visible']) && $widget_settings['categories_visible'] == '1' ? 'checked' : ''; ?>>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" name="order_categories" min="1" max="10" 
                                                        value="<?php echo $widget_settings['categories_order'] ?? '3'; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>مطالب محبوب</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="widget_popular_posts" id="widget_popular_posts" 
                                                            <?php echo isset($widget_settings['popular_posts_visible']) && $widget_settings['popular_posts_visible'] == '1' ? 'checked' : ''; ?>>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" name="order_popular_posts" min="1" max="10" 
                                                        value="<?php echo $widget_settings['popular_posts_order'] ?? '4'; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- محتوای سربرگ -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">سربرگ صفحه</h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#headerCollapse">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="collapse show" id="headerCollapse">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="content_header_title" class="form-label">عنوان اصلی</label>
                                    <input type="text" class="form-control" id="content_header_title" name="content_header_title" 
                                           value="<?php echo htmlspecialchars($content['header_title'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="content_header_subtitle" class="form-label">زیرعنوان</label>
                                    <input type="text" class="form-control" id="content_header_subtitle" name="content_header_subtitle" 
                                           value="<?php echo htmlspecialchars($content['header_subtitle'] ?? ''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- محتوای ویجت‌ها -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">عناوین ویجت‌ها</h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#widgetTitlesCollapse">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="collapse show" id="widgetTitlesCollapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="content_sidebar_search_title" class="form-label">عنوان ویجت جستجو</label>
                                        <input type="text" class="form-control" id="content_sidebar_search_title" name="content_sidebar_search_title" 
                                               value="<?php echo htmlspecialchars($content['sidebar_search_title'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_sidebar_latest_title" class="form-label">عنوان ویجت آخرین مطالب</label>
                                        <input type="text" class="form-control" id="content_sidebar_latest_title" name="content_sidebar_latest_title" 
                                               value="<?php echo htmlspecialchars($content['sidebar_latest_title'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_sidebar_categories_title" class="form-label">عنوان ویجت دسته‌بندی‌ها</label>
                                        <input type="text" class="form-control" id="content_sidebar_categories_title" name="content_sidebar_categories_title" 
                                               value="<?php echo htmlspecialchars($content['sidebar_categories_title'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_sidebar_popular_title" class="form-label">عنوان ویجت مطالب محبوب</label>
                                        <input type="text" class="form-control" id="content_sidebar_popular_title" name="content_sidebar_popular_title" 
                                               value="<?php echo htmlspecialchars($content['sidebar_popular_title'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- متن دکمه‌ها -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">متن دکمه‌ها</h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#buttonsCollapse">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="collapse show" id="buttonsCollapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="content_read_more_text" class="form-label">دکمه ادامه مطلب</label>
                                        <input type="text" class="form-control" id="content_read_more_text" name="content_read_more_text" 
                                               value="<?php echo htmlspecialchars($content['read_more_text'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="content_search_button_text" class="form-label">دکمه جستجو</label>
                                        <input type="text" class="form-control" id="content_search_button_text" name="content_search_button_text" 
                                               value="<?php echo htmlspecialchars($content['search_button_text'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="content_view_all_button" class="form-label">دکمه مشاهده همه</label>
                                        <input type="text" class="form-control" id="content_view_all_button" name="content_view_all_button" 
                                               value="<?php echo htmlspecialchars($content['view_all_button'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- متن‌های جستجو و پیام‌های خالی -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">پیام‌های جستجو و صفحات خالی</h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#searchCollapse">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="collapse show" id="searchCollapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="content_search_placeholder" class="form-label">متن Placeholder جستجو</label>
                                        <input type="text" class="form-control" id="content_search_placeholder" name="content_search_placeholder" 
                                               value="<?php echo htmlspecialchars($content['search_placeholder'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_category_posts" class="form-label">متن عنوان دسته‌بندی</label>
                                        <input type="text" class="form-control" id="content_category_posts" name="content_category_posts" 
                                               value="<?php echo htmlspecialchars($content['category_posts'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_search_results" class="form-label">متن عنوان نتایج جستجو</label>
                                        <input type="text" class="form-control" id="content_search_results" name="content_search_results" 
                                               value="<?php echo htmlspecialchars($content['search_results'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_no_posts" class="form-label">عنوان صفحه بدون نتیجه</label>
                                        <input type="text" class="form-control" id="content_no_posts" name="content_no_posts" 
                                               value="<?php echo htmlspecialchars($content['no_posts'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_no_posts_yet" class="form-label">پیام "هنوز مطلبی منتشر نشده"</label>
                                        <input type="text" class="form-control" id="content_no_posts_yet" name="content_no_posts_yet" 
                                               value="<?php echo htmlspecialchars($content['no_posts_yet'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="content_no_search_results" class="form-label">پیام "نتیجه‌ای یافت نشد"</label>
                                        <input type="text" class="form-control" id="content_no_search_results" name="content_no_search_results" 
                                               value="<?php echo htmlspecialchars($content['no_search_results'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                        <button type="submit" name="save_content" class="btn btn-primary">
                            <i class="fas fa-save"></i> ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // تنظیمات کلاپس و توگل‌ها
            $('.btn-toggle').click(function() {
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
            });
        });
    </script>
</body>
</html>