<?php
require_once '../includes/config.php';
require_once '../includes/theme_helpers.php';


// تعیین زبان فعلی
$currentLanguage = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
$otherLangs = ['fa', 'en', 'ar'];
$isRtl = in_array($currentLanguage, ['fa', 'ar']);

// دریافت دسته‌بندی فعلی
$currentCategory = isset($_GET['category']) ? $_GET['category'] : 'colors';
$categories = [
    'colors' => 'رنگ‌ها',
    'gradients' => 'گرادینت‌ها',
    'typography' => 'تایپوگرافی',
    'spacing' => 'فاصله‌گذاری',
    'radius' => 'گوشه‌ها',
    'shadows' => 'سایه‌ها',
    'animation' => 'انیمیشن‌ها'
];

// دریافت تنظیمات برای زبان فعلی
$settings = getThemeSettings($currentLanguage);

// ذخیره تنظیمات در صورت ارسال فرم
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    // ذخیره تنظیمات
    if (isset($_POST['settings'])) {
        foreach ($_POST['settings'] as $key => $value) {
            saveThemeSetting($key, $value, $currentLanguage);
        }
    }
    
    // پیام موفقیت
    $successMessage = 'تنظیمات تم با موفقیت ذخیره شدند.';
    
    // بازخوانی تنظیمات
    $settings = getThemeSettings($currentLanguage);
}

// ریست تنظیمات به حالت پیش‌فرض
if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    // رنگ‌های پیش‌فرض
    $defaultSettings = [
        'primary' => '#6C63FF',
        'primary_light' => '#9471FF',
        'primary_dark' => '#5451e6',
        'secondary' => '#6C9EFF',
        'accent_pink' => '#FF6B8B',
        'accent_teal' => '#36F1CD',
        'accent_yellow' => '#FFDE59',
        'success' => '#4CAF50',
        'warning' => '#FF9800',
        'danger' => '#F44336',
        // گرادینت‌ها
        'purple_gradient' => 'linear-gradient(135deg, #9471FF 0%, #6C63FF 100%)',
        'sky_gradient' => 'linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%)',
        'sunset_gradient' => 'linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%)',
        // تایپوگرافی
        'body_font' => $currentLanguage == 'fa' || $currentLanguage == 'ar' ? 
                       'Vazirmatn, Estedad, system-ui, sans-serif' : 
                       'Plus Jakarta Sans, Roboto, system-ui, sans-serif',
        'heading_font' => $currentLanguage == 'fa' || $currentLanguage == 'ar' ? 
                         'Vazirmatn, Estedad, system-ui, sans-serif' : 
                         'Plus Jakarta Sans, Roboto, system-ui, sans-serif',
        'base_font_size' => '16px',
        'base_line_height' => '1.7',
        // اندازه‌ها
        'border_radius' => '1rem',
        'border_radius_sm' => '0.625rem',
        'border_radius_lg' => '1.5rem'
    ];
    
    // ذخیره تنظیمات پیش‌فرض
    foreach ($defaultSettings as $key => $value) {
        saveThemeSetting($key, $value, $currentLanguage);
    }
    
    // پیام موفقیت
    $successMessage = 'تنظیمات تم به حالت پیش‌فرض بازگردانده شدند.';
    
    // بازخوانی تنظیمات
    $settings = getThemeSettings($currentLanguage);
    
    // بازگشت به همان صفحه
    header("Location: theme.php?category=$currentCategory&lang=$currentLanguage&reset_success=1");
    exit;
}

// نمونه‌های پیش‌فرض برای نمایش در فرم‌ها
$defaultFonts = [
    'fa' => [
        'Vazirmatn, Estedad, system-ui, sans-serif',
        'Estedad, Vazirmatn, system-ui, sans-serif',
        'Samim, Vazirmatn, system-ui, sans-serif',
        'IRANSans, Vazirmatn, system-ui, sans-serif',
        'Yekan, Vazirmatn, system-ui, sans-serif'
    ],
    'en' => [
        'Plus Jakarta Sans, Roboto, system-ui, sans-serif',
        'Roboto, system-ui, sans-serif',
        'Montserrat, system-ui, sans-serif',
        'Poppins, system-ui, sans-serif',
        'Open Sans, system-ui, sans-serif'
    ],
    'ar' => [
        'Vazirmatn, system-ui, sans-serif',
        'Amiri, Vazirmatn, system-ui, sans-serif',
        'Cairo, Vazirmatn, system-ui, sans-serif',
        'Tajawal, Vazirmatn, system-ui, sans-serif'
    ]
];

// دریافت رنگ‌های تم فعلی برای نمایش در پیش‌نمایش
$themeColors = [
    'primary' => getThemeSetting('primary', '#6C63FF', $currentLanguage),
    'secondary' => getThemeSetting('secondary', '#6C9EFF', $currentLanguage),
    'accent_pink' => getThemeSetting('accent_pink', '#FF6B8B', $currentLanguage),
    'success' => getThemeSetting('success', '#4CAF50', $currentLanguage),
    'warning' => getThemeSetting('warning', '#FF9800', $currentLanguage),
    'danger' => getThemeSetting('danger', '#F44336', $currentLanguage)
];

// دریافت گرادیان‌های تم فعلی برای نمایش در پیش‌نمایش
$themeGradients = [
    'purple_gradient' => getThemeSetting('purple_gradient', 'linear-gradient(135deg, #9471FF 0%, #6C63FF 100%)', $currentLanguage),
    'sky_gradient' => getThemeSetting('sky_gradient', 'linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%)', $currentLanguage),
    'sunset_gradient' => getThemeSetting('sunset_gradient', 'linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%)', $currentLanguage)
];
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLanguage; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت تم سایت</title>
    <!-- لود استایل‌های بوت‌استرپ متناسب با RTL/LTR -->
    <?php if ($isRtl): ?>
    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">
    <?php else: ?>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <?php endif; ?>
    
    <!-- فونت‌آوسام برای آیکون‌ها -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- استایل‌های سفارشی برای داشبورد تم -->
    <style>
        :root {
            --primary: <?php echo $themeColors['primary']; ?>;
            --secondary: <?php echo $themeColors['secondary']; ?>;
            --success: <?php echo $themeColors['success']; ?>;
            --warning: <?php echo $themeColors['warning']; ?>;
            --danger: <?php echo $themeColors['danger']; ?>;
        }
        
        /* استایل‌های کلی */
        body {
            background-color: #f8f9fa;
            <?php if ($isRtl): ?>
            font-family: Vazirmatn, system-ui, sans-serif;
            <?php else: ?>
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            <?php endif; ?>
        }
        
        .theme-header {
            background: <?php echo $themeGradients['purple_gradient']; ?>;
            padding: 2rem 0;
            margin-bottom: 2rem;
            color: white;
            border-radius: 0 0 1rem 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .theme-title {
            font-size: 2rem;
            font-weight: 700;
        }
        
        .theme-subtitle {
            opacity: 0.8;
            font-weight: 300;
        }
        
        /* کارت‌های تنظیمات */
        .settings-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        
        .settings-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
        }
        
        /* منوی دسته‌بندی‌ها */
        .category-nav {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .category-nav .nav-link {
            padding: 1rem 1.5rem;
            color: #555;
            font-weight: 500;
        }
        
        .category-nav .nav-link:hover {
            background-color: #f8f9fa;
        }
        
        .category-nav .nav-link.active {
            background-color: var(--primary);
            color: white;
        }
        
        .category-nav .nav-link i {
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        /* زبان‌ها */
        .lang-switcher {
            display: flex;
            margin-bottom: 1.5rem;
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .lang-switcher a {
            flex: 1;
            padding: 0.75rem;
            text-align: center;
            color: #555;
            text-decoration: none;
            font-weight: 500;
        }
        
        .lang-switcher a.active {
            background-color: var(--primary);
            color: white;
        }
        
        /* فُرم‌های رنگ */
        .color-picker-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .color-picker-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .color-preview {
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 1rem;
            border: 3px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        input[type="color"] {
            -webkit-appearance: none;
            border: none;
            width: 40px;
            height: 40px;
            padding: 0;
            background: none;
            cursor: pointer;
        }
        
        input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }
        
        input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        /* گرادیان‌ها */
        .gradient-preview {
            height: 80px;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        /* پیش‌نمایش تم */
        .theme-preview {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }
        
        .preview-item {
            margin-bottom: 1rem;
        }
        
        .preview-box {
            width: 100%;
            height: 80px;
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .preview-title {
            font-size: 0.875rem;
            font-weight: 500;
            color: #555;
            margin-bottom: 0.25rem;
        }
        
        .preview-value {
            font-size: 0.75rem;
            color: #777;
            font-family: monospace;
        }
        
        /* دکمه‌ها */
        .btn-theme-primary {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(108, 99, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .btn-theme-primary:hover {
            background-color: var(--primary);
            opacity: 0.9;
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-outline-theme {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-theme:hover {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 3px 10px rgba(108, 99, 255, 0.2);
        }
        
        /* بخش تایپوگرافی */
        .font-preview {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        
        .preview-heading {
            margin-bottom: 1rem;
            color: var(--primary);
        }
        
        .preview-paragraph {
            color: #555;
            line-height: 1.7;
        }
        
        /* رسپانسیو */
        @media (max-width: 768px) {
            .category-nav {
                overflow-x: auto;
                white-space: nowrap;
                flex-wrap: nowrap;
            }
            
            .theme-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- هدر صفحه -->
    <header class="theme-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="theme-title">مدیریت تم سایت</h1>
                    <p class="theme-subtitle">تنظیمات ظاهری وب‌سایت را سفارشی کنید</p>
                </div>
                <div class="col-md-6 text-<?php echo $isRtl ? 'start' : 'end'; ?>">
                    <a href="dashboard.php" class="btn btn-outline-light">
                        <i class="fas fa-arrow-<?php echo $isRtl ? 'right' : 'left'; ?>"></i>
                        بازگشت به داشبورد
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <!-- پیام موفقیت -->
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?php echo $successMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['reset_success'])): ?>
            <div class="alert alert-success fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> تنظیمات تم به حالت پیش‌فرض بازگردانده شدند.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-lg-3">
                <!-- سوئیچر زبان -->
                <div class="lang-switcher mb-4">
                    <?php foreach ($otherLangs as $lang): ?>
                        <a href="?category=<?php echo $currentCategory; ?>&lang=<?php echo $lang; ?>" class="<?php echo $lang === $currentLanguage ? 'active' : ''; ?>">
                            <?php
                            switch ($lang) {
                                case 'fa':
                                    echo 'فارسی';
                                    break;
                                case 'en':
                                    echo 'English';
                                    break;
                                case 'ar':
                                    echo 'العربية';
                                    break;
                            }
                            ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                
                <!-- منوی دسته‌بندی‌ها -->
                <div class="card category-nav mb-4">
                    <div class="card-body p-0">
                        <ul class="nav flex-column">
                            <?php foreach ($categories as $catKey => $catLabel): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $catKey === $currentCategory ? 'active' : ''; ?>" 
                                       href="?category=<?php echo $catKey; ?>&lang=<?php echo $currentLanguage; ?>">
                                        <i class="fas fa-<?php
                                            switch ($catKey) {
                                                case 'colors':
                                                    echo 'palette';
                                                    break;
                                                case 'gradients':
                                                    echo 'brush';
                                                    break;
                                                case 'typography':
                                                    echo 'font';
                                                    break;
                                                case 'spacing':
                                                    echo 'arrows-alt';
                                                    break;
                                                case 'radius':
                                                    echo 'border-style';
                                                    break;
                                                case 'shadows':
                                                    echo 'moon';
                                                    break;
                                                case 'animation':
                                                    echo 'film';
                                                    break;
                                                default:
                                                    echo 'sliders-h';
                                            }
                                        ?>"></i>
                                        <?php echo $catLabel; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- پیش‌نمایش تم -->
                <div class="theme-preview">
                    <h5 class="mb-3">پیش‌نمایش تم</h5>
                    
                    <div class="row">
                        <?php foreach ($themeColors as $colorKey => $colorValue): ?>
                            <div class="col-6 preview-item">
                                <div class="preview-box" style="background-color: <?php echo $colorValue; ?>;">
                                    <?php
                                    switch ($colorKey) {
                                        case 'primary':
                                            echo 'اصلی';
                                            break;
                                        case 'secondary':
                                            echo 'فرعی';
                                            break;
                                        case 'accent_pink':
                                            echo 'تاکیدی';
                                            break;
                                        case 'success':
                                            echo 'موفقیت';
                                            break;
                                        case 'warning':
                                            echo 'هشدار';
                                            break;
                                        case 'danger':
                                            echo 'خطر';
                                            break;
                                    }
                                    ?>
                                </div>
                                <div class="preview-title">
                                    <?php
                                    switch ($colorKey) {
                                        case 'primary':
                                            echo 'رنگ اصلی';
                                            break;
                                        case 'secondary':
                                            echo 'رنگ فرعی';
                                            break;
                                        case 'accent_pink':
                                            echo 'رنگ تاکیدی';
                                            break;
                                        case 'success':
                                            echo 'رنگ موفقیت';
                                            break;
                                        case 'warning':
                                            echo 'رنگ هشدار';
                                            break;
                                        case 'danger':
                                            echo 'رنگ خطر';
                                            break;
                                    }
                                    ?>
                                </div>
                                <div class="preview-value"><?php echo $colorValue; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-3">
                        <div class="preview-item">
                            <div class="gradient-preview" style="background: <?php echo $themeGradients['purple_gradient']; ?>"></div>
                            <div class="preview-title">گرادیان بنفش</div>
                        </div>
                    </div>
                    
                    <div class="mt-3 text-center">
                        <a href="?category=<?php echo $currentCategory; ?>&lang=<?php echo $currentLanguage; ?>&reset=1" 
                           class="btn btn-sm btn-outline-secondary" 
                           onclick="return confirm('آیا مطمئن هستید که می‌خواهید تنظیمات را به حالت پیش‌فرض بازگردانید؟');">
                            <i class="fas fa-undo"></i> بازگشت به پیش‌فرض
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <!-- فرم تنظیمات -->
                <div class="card settings-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <?php echo $categories[$currentCategory] ?? 'تنظیمات تم'; ?>
                            <?php if ($currentLanguage !== 'fa'): ?>
                                <small class="text-muted">
                                    (<?php echo $currentLanguage === 'en' ? 'English' : 'العربية'; ?>)
                                </small>
                            <?php endif; ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?category=<?php echo $currentCategory; ?>&lang=<?php echo $currentLanguage; ?>">
                            <?php if ($currentCategory === 'colors'): ?>
                                <!-- تنظیمات رنگ‌ها -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">رنگ اصلی (Primary)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('primary', '#6C63FF', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[primary]" value="<?php echo getThemeSetting('primary', '#6C63FF', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('primary', '#6C63FF', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[primary]')">
                                        </div>
                                        <small class="text-muted">رنگ اصلی برای عناصر و دکمه‌های سایت</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">رنگ اصلی روشن (Primary Light)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('primary_light', '#9471FF', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[primary_light]" value="<?php echo getThemeSetting('primary_light', '#9471FF', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('primary_light', '#9471FF', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[primary_light]')">
                                        </div>
                                        <small class="text-muted">نسخه روشن‌تر رنگ اصلی</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">رنگ اصلی تیره (Primary Dark)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('primary_dark', '#5451e6', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[primary_dark]" value="<?php echo getThemeSetting('primary_dark', '#5451e6', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('primary_dark', '#5451e6', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[primary_dark]')">
                                        </div>
                                        <small class="text-muted">نسخه تیره‌تر رنگ اصلی</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">رنگ فرعی (Secondary)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('secondary', '#6C9EFF', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[secondary]" value="<?php echo getThemeSetting('secondary', '#6C9EFF', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('secondary', '#6C9EFF', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[secondary]')">
                                        </div>
                                        <small class="text-muted">رنگ فرعی برای عناصر و دکمه‌های سایت</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">رنگ تاکیدی صورتی (Accent Pink)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('accent_pink', '#FF6B8B', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[accent_pink]" value="<?php echo getThemeSetting('accent_pink', '#FF6B8B', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('accent_pink', '#FF6B8B', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[accent_pink]')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">رنگ تاکیدی آبی-سبز (Accent Teal)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('accent_teal', '#36F1CD', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[accent_teal]" value="<?php echo getThemeSetting('accent_teal', '#36F1CD', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('accent_teal', '#36F1CD', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[accent_teal]')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">رنگ تاکیدی زرد (Accent Yellow)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('accent_yellow', '#FFDE59', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[accent_yellow]" value="<?php echo getThemeSetting('accent_yellow', '#FFDE59', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('accent_yellow', '#FFDE59', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[accent_yellow]')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">رنگ موفقیت (Success)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('success', '#4CAF50', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[success]" value="<?php echo getThemeSetting('success', '#4CAF50', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('success', '#4CAF50', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[success]')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">رنگ هشدار (Warning)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('warning', '#FF9800', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[warning]" value="<?php echo getThemeSetting('warning', '#FF9800', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('warning', '#FF9800', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[warning]')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">رنگ خطر (Danger)</label>
                                        <div class="input-group">
                                            <div class="color-preview" style="background-color: <?php echo getThemeSetting('danger', '#F44336', $currentLanguage); ?>"></div>
                                            <input type="color" name="settings[danger]" value="<?php echo getThemeSetting('danger', '#F44336', $currentLanguage); ?>" class="form-color-control">
                                            <input type="text" class="form-control" value="<?php echo getThemeSetting('danger', '#F44336', $currentLanguage); ?>" 
                                                   oninput="updateColorPicker(this, 'settings[danger]')">
                                        </div>
                                    </div>
                                </div>
                            
                            <?php elseif ($currentCategory === 'gradients'): ?>
                                <!-- تنظیمات گرادیان‌ها -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">گرادیان بنفش (Purple Gradient)</label>
                                        <div class="gradient-preview" style="background: <?php echo getThemeSetting('purple_gradient', 'linear-gradient(135deg, #9471FF 0%, #6C63FF 100%)', $currentLanguage); ?>"></div>
                                        <input type="text" name="settings[purple_gradient]" class="form-control" 
                                               value="<?php echo getThemeSetting('purple_gradient', 'linear-gradient(135deg, #9471FF 0%, #6C63FF 100%)', $currentLanguage); ?>"
                                               oninput="this.parentNode.querySelector('.gradient-preview').style.background = this.value">
                                        <small class="text-muted">مثال: linear-gradient(135deg, #9471FF 0%, #6C63FF 100%)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">گرادیان آسمانی (Sky Gradient)</label>
                                        <div class="gradient-preview" style="background: <?php echo getThemeSetting('sky_gradient', 'linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%)', $currentLanguage); ?>"></div>
                                        <input type="text" name="settings[sky_gradient]" class="form-control" 
                                               value="<?php echo getThemeSetting('sky_gradient', 'linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%)', $currentLanguage); ?>"
                                               oninput="this.parentNode.querySelector('.gradient-preview').style.background = this.value">
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">گرادیان غروب (Sunset Gradient)</label>
                                        <div class="gradient-preview" style="background: <?php echo getThemeSetting('sunset_gradient', 'linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%)', $currentLanguage); ?>"></div>
                                        <input type="text" name="settings[sunset_gradient]" class="form-control" 
                                               value="<?php echo getThemeSetting('sunset_gradient', 'linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%)', $currentLanguage); ?>"
                                               oninput="this.parentNode.querySelector('.gradient-preview').style.background = this.value">
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">گرادیان کیهانی (Cosmic Gradient)</label>
                                        <div class="gradient-preview" style="background: <?php echo getThemeSetting('cosmic_gradient', 'linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%)', $currentLanguage); ?>"></div>
                                        <input type="text" name="settings[cosmic_gradient]" class="form-control" 
                                               value="<?php echo getThemeSetting('cosmic_gradient', 'linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%)', $currentLanguage); ?>"
                                               oninput="this.parentNode.querySelector('.gradient-preview').style.background = this.value">
                                    </div>
                                </div>
                            
                            <?php elseif ($currentCategory === 'typography'): ?>
                                <!-- تنظیمات تایپوگرافی -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">فونت متن (Body Font)</label>
                                        <select name="settings[body_font]" class="form-select" 
                                                onchange="updateFontPreview(this.value, '.preview-paragraph')">
                                            <?php foreach ($defaultFonts[$currentLanguage] as $font): ?>
                                                <option value="<?php echo $font; ?>" <?php echo getThemeSetting('body_font', '', $currentLanguage) === $font ? 'selected' : ''; ?>>
                                                    <?php echo explode(',', $font)[0]; ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <option value="custom">فونت سفارشی...</option>
                                        </select>
                                        <div class="mt-2 custom-font-input" style="display: none;">
                                            <input type="text" class="form-control" name="custom_body_font" 
                                                   placeholder="نام فونت‌ها با کاما جدا شود: Vazirmatn, system-ui, sans-serif"
                                                   onchange="updateCustomFont(this, 'settings[body_font]', '.preview-paragraph')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">فونت سرتیتر (Heading Font)</label>
                                        <select name="settings[heading_font]" class="form-select"
                                                onchange="updateFontPreview(this.value, '.preview-heading')">
                                            <?php foreach ($defaultFonts[$currentLanguage] as $font): ?>
                                                <option value="<?php echo $font; ?>" <?php echo getThemeSetting('heading_font', '', $currentLanguage) === $font ? 'selected' : ''; ?>>
                                                    <?php echo explode(',', $font)[0]; ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <option value="custom">فونت سفارشی...</option>
                                        </select>
                                        <div class="mt-2 custom-font-input" style="display: none;">
                                            <input type="text" class="form-control" name="custom_heading_font" 
                                                   placeholder="نام فونت‌ها با کاما جدا شود: Vazirmatn, system-ui, sans-serif"
                                                   onchange="updateCustomFont(this, 'settings[heading_font]', '.preview-heading')">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">اندازه پایه فونت (Base Font Size)</label>
                                        <input type="text" name="settings[base_font_size]" class="form-control" 
                                               value="<?php echo getThemeSetting('base_font_size', '16px', $currentLanguage); ?>"
                                               onchange="document.querySelector('.preview-paragraph').style.fontSize = this.value">
                                        <small class="text-muted">مثال: 16px یا 1rem</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">ارتفاع خط پایه (Base Line Height)</label>
                                        <input type="text" name="settings[base_line_height]" class="form-control" 
                                               value="<?php echo getThemeSetting('base_line_height', '1.7', $currentLanguage); ?>"
                                               onchange="document.querySelector('.preview-paragraph').style.lineHeight = this.value">
                                        <small class="text-muted">مثال: 1.7</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">وزن سرتیترها (Heading Weight)</label>
                                        <select name="settings[heading_weight]" class="form-select"
                                                onchange="document.querySelector('.preview-heading').style.fontWeight = this.value">
                                            <option value="400" <?php echo getThemeSetting('heading_weight', '700', $currentLanguage) === '400' ? 'selected' : ''; ?>>معمولی (400)</option>
                                            <option value="500" <?php echo getThemeSetting('heading_weight', '700', $currentLanguage) === '500' ? 'selected' : ''; ?>>متوسط (500)</option>
                                            <option value="600" <?php echo getThemeSetting('heading_weight', '700', $currentLanguage) === '600' ? 'selected' : ''; ?>>نیمه‌ضخیم (600)</option>
                                            <option value="700" <?php echo getThemeSetting('heading_weight', '700', $currentLanguage) === '700' ? 'selected' : ''; ?>>ضخیم (700)</option>
                                            <option value="800" <?php echo getThemeSetting('heading_weight', '700', $currentLanguage) === '800' ? 'selected' : ''; ?>>خیلی ضخیم (800)</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12 mb-4">
                                        <div class="font-preview">
                                            <h3 class="preview-heading" style="font-family: <?php echo getThemeSetting('heading_font', 'Vazirmatn, system-ui, sans-serif', $currentLanguage); ?>; font-weight: <?php echo getThemeSetting('heading_weight', '700', $currentLanguage); ?>;">
                                                <?php
                                                if ($currentLanguage === 'fa') {
                                                    echo 'این یک نمونه سرتیتر با فونت انتخابی است';
                                                } elseif ($currentLanguage === 'en') {
                                                    echo 'This is a sample heading with the selected font';
                                                } else {
                                                    echo 'هذا عنوان نموذجي بالخط المختار';
                                                }
                                                ?>
                                            </h3>
                                            <p class="preview-paragraph" style="font-family: <?php echo getThemeSetting('body_font', 'Vazirmatn, system-ui, sans-serif', $currentLanguage); ?>; font-size: <?php echo getThemeSetting('base_font_size', '16px', $currentLanguage); ?>; line-height: <?php echo getThemeSetting('base_line_height', '1.7', $currentLanguage); ?>;">
                                                <?php
                                                if ($currentLanguage === 'fa') {
                                                    echo 'این متن نمونه‌ای است که با فونت، اندازه و ارتفاع خط انتخابی نمایش داده می‌شود. با تغییر تنظیمات تایپوگرافی، تغییرات را در این متن مشاهده کنید. یک متن خوب با فاصله‌گذاری و ریتم مناسب، خوانایی بهتری دارد و خواندن آن برای کاربران آسان‌تر است.';
                                                } elseif ($currentLanguage === 'en') {
                                                    echo 'This is a sample text displayed with the selected font, size, and line height. As you change typography settings, you will see the changes in this text. A well-spaced and rhythmic text has better readability and is easier for users to read.';
                                                } else {
                                                    echo 'هذا نص عينة يتم عرضه بالخط والحجم والارتفاع المختارين. مع تغيير إعدادات الطباعة، يمكنك رؤية التغييرات في هذا النص. النص المتباعد بشكل جيد وذو الإيقاع المناسب له قابلية أفضل للقراءة ويسهل على المستخدمين قراءته.';
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            
                            <?php elseif ($currentCategory === 'spacing'): ?>
                                <!-- تنظیمات فاصله‌گذاری -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">فاصله بخش‌ها (Section Spacing)</label>
                                        <input type="text" name="settings[section_spacing]" class="form-control" 
                                               value="<?php echo getThemeSetting('section_spacing', '6rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 6rem</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">فاصله بخش‌ها (کوچک)</label>
                                        <input type="text" name="settings[section_spacing_sm]" class="form-control" 
                                               value="<?php echo getThemeSetting('section_spacing_sm', '4rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 4rem</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">فاصله محتوا (Content Spacing)</label>
                                        <input type="text" name="settings[content_spacing]" class="form-control" 
                                               value="<?php echo getThemeSetting('content_spacing', '3rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 3rem</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">فاصله عناصر (Element Spacing)</label>
                                        <input type="text" name="settings[element_spacing]" class="form-control" 
                                               value="<?php echo getThemeSetting('element_spacing', '1.5rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 1.5rem</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">فاصله درونی (Gap Spacing)</label>
                                        <input type="text" name="settings[gap_spacing]" class="form-control" 
                                               value="<?php echo getThemeSetting('gap_spacing', '1rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 1rem</small>
                                    </div>
                                </div>
                            
                            <?php elseif ($currentCategory === 'radius'): ?>
                                <!-- تنظیمات گوشه‌ها -->
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">برادیوس استاندارد (Border Radius)</label>
                                        <input type="text" name="settings[border_radius]" class="form-control" 
                                               value="<?php echo getThemeSetting('border_radius', '1rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 1rem</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">برادیوس کوچک (Border Radius SM)</label>
                                        <input type="text" name="settings[border_radius_sm]" class="form-control" 
                                               value="<?php echo getThemeSetting('border_radius_sm', '0.625rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0.625rem</small>
                                    </div>
                                    
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label">برادیوس بزرگ (Border Radius LG)</label>
                                        <input type="text" name="settings[border_radius_lg]" class="form-control" 
                                               value="<?php echo getThemeSetting('border_radius_lg', '1.5rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 1.5rem</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">برادیوس خیلی بزرگ (Border Radius XL)</label>
                                        <input type="text" name="settings[border_radius_xl]" class="form-control" 
                                               value="<?php echo getThemeSetting('border_radius_xl', '2rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 2rem</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">برادیوس دکمه‌ای (Border Radius Pill)</label>
                                        <input type="text" name="settings[border_radius_pill]" class="form-control" 
                                               value="<?php echo getThemeSetting('border_radius_pill', '6.25rem', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 6.25rem</small>
                                    </div>
                                </div>
                            
                            <?php elseif ($currentCategory === 'shadows'): ?>
                                <!-- تنظیمات سایه‌ها -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">سایه کوچک (Shadow SM)</label>
                                        <input type="text" name="settings[shadow_sm]" class="form-control" 
                                               value="<?php echo getThemeSetting('shadow_sm', '0 4px 10px rgba(0, 0, 0, 0.05)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0 4px 10px rgba(0, 0, 0, 0.05)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">سایه استاندارد (Shadow)</label>
                                        <input type="text" name="settings[shadow]" class="form-control" 
                                               value="<?php echo getThemeSetting('shadow', '0 10px 30px rgba(0, 0, 0, 0.1)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0 10px 30px rgba(0, 0, 0, 0.1)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">سایه بزرگ (Shadow LG)</label>
                                        <input type="text" name="settings[shadow_lg]" class="form-control" 
                                               value="<?php echo getThemeSetting('shadow_lg', '0 20px 40px rgba(0, 0, 0, 0.15)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0 20px 40px rgba(0, 0, 0, 0.15)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">سایه درخشان (Glow Shadow)</label>
                                        <input type="text" name="settings[glow_shadow]" class="form-control" 
                                               value="<?php echo getThemeSetting('glow_shadow', '0 0 20px rgba(108, 99, 255, 0.4)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0 0 20px rgba(108, 99, 255, 0.4)</small>
                                    </div>
                                </div>
                            
                            <?php elseif ($currentCategory === 'animation'): ?>
                                <!-- تنظیمات انیمیشن‌ها -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">انیمیشن سریع (Transition Fast)</label>
                                        <input type="text" name="settings[transition_fast]" class="form-control" 
                                               value="<?php echo getThemeSetting('transition_fast', '0.25s cubic-bezier(0.25, 0.8, 0.25, 1)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0.25s cubic-bezier(0.25, 0.8, 0.25, 1)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">انیمیشن متوسط (Transition Medium)</label>
                                        <input type="text" name="settings[transition_medium]" class="form-control" 
                                               value="<?php echo getThemeSetting('transition_medium', '0.4s cubic-bezier(0.25, 0.8, 0.25, 1)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0.4s cubic-bezier(0.25, 0.8, 0.25, 1)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">انیمیشن آهسته (Transition Slow)</label>
                                        <input type="text" name="settings[transition_slow]" class="form-control" 
                                               value="<?php echo getThemeSetting('transition_slow', '0.7s cubic-bezier(0.25, 0.8, 0.25, 1)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0.7s cubic-bezier(0.25, 0.8, 0.25, 1)</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">انیمیشن جهشی (Transition Bounce)</label>
                                        <input type="text" name="settings[transition_bounce]" class="form-control" 
                                               value="<?php echo getThemeSetting('transition_bounce', '0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)', $currentLanguage); ?>">
                                        <small class="text-muted">مثال: 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)</small>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mt-4 text-center">
                                <button type="submit" name="save_settings" class="btn btn-theme-primary">
                                    <i class="fas fa-save me-2"></i> ذخیره تنظیمات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- اسکریپت‌های جاوااسکریپت -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // به‌روزرسانی پیکر رنگ و پیش‌نمایش
        function updateColorPicker(input, colorPickerName) {
            // به‌روزرسانی انتخابگر رنگ
            document.querySelector(`input[name="${colorPickerName}"]`).value = input.value;
            
            // به‌روزرسانی پیش‌نمایش رنگ
            input.parentNode.querySelector('.color-preview').style.backgroundColor = input.value;
        }
        
        // به‌روزرسانی پیش‌نمایش فونت
        function updateFontPreview(fontValue, selector) {
            if (fontValue === 'custom') {
                // نمایش فیلد ورودی سفارشی
                const customInput = event.target.parentNode.querySelector('.custom-font-input');
                if (customInput) {
                    customInput.style.display = 'block';
                }
            } else {
                // مخفی کردن فیلد ورودی سفارشی
                const customInput = event.target.parentNode.querySelector('.custom-font-input');
                if (customInput) {
                    customInput.style.display = 'none';
                }
                
                // به‌روزرسانی پیش‌نمایش با مقدار انتخاب شده
                document.querySelector(selector).style.fontFamily = fontValue;
            }
        }
        
        // به‌روزرسانی فونت سفارشی
        function updateCustomFont(input, selectName, selector) {
            // به‌روزرسانی مقدار سلکت
            document.querySelector(`select[name="${selectName}"]`).value = input.value;
            
            // به‌روزرسانی پیش‌نمایش
            document.querySelector(selector).style.fontFamily = input.value;
        }
        
        // اتصال رویدادها به عناصر موجود
        document.addEventListener('DOMContentLoaded', function() {
            // به‌روزرسانی همه رنگ‌پیکرها هنگام تغییر مقدار ورودی
            document.querySelectorAll('input[type="color"]').forEach(function(colorPicker) {
                colorPicker.addEventListener('input', function() {
                    // دریافت پدر و پیش‌نمایش
                    const parentNode = this.parentNode;
                    const preview = parentNode.querySelector('.color-preview');
                    const textInput = parentNode.querySelector('input[type="text"]');
                    
                    // به‌روزرسانی مقادیر
                    if (preview) preview.style.backgroundColor = this.value;
                    if (textInput) textInput.value = this.value;
                });
            });
            
            // فعال‌سازی سفارشی‌سازی فونت‌ها
            document.querySelectorAll('select[name="settings[body_font]"], select[name="settings[heading_font]"]').forEach(function(select) {
                if (select.value === 'custom') {
                    select.parentNode.querySelector('.custom-font-input').style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>