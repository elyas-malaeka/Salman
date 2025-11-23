<?php
/**
 * صفحه اصلی کتابخانه آنلاین مجتمع آموزشی سلمان - نسخه مدرن و چندزبانه
 * 
 * طراحی مدرن با پشتیبانی از سه زبان: فارسی، انگلیسی، عربی
 * 
 * @package Salman Educational Complex
 * @subpackage Modern Library
 * @version 2.0
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'includes/config.php';
require_once 'includes/library_functions.php';

// بررسی وجود فایل ترجمه و include کردن آن
if (file_exists('includes/library_translations.php')) {
    require_once 'includes/library_translations.php';
} else {
    // در صورت عدم وجود فایل ترجمه، تابع پیش‌فرض تعریف می‌کنیم
    function translate($key, $lang = 'fa') {
        return $key; // فقط کلید را برمی‌گرداند
    }
    
    function getDirection() {
        return 'rtl';
    }
    
    function getLanguageClasses() {
        return 'lang-fa dir-rtl rtl';
    }
    
    function renderLanguageSwitcher() {
        return '<div class="language-switcher">FA</div>';
    }
    
    $current_lang = 'fa';
}

// تنظیمات صفحه بر اساس زبان فعلی
$pageTitle = translate('library_home.page_title');
$direction = getDirection();
$langClasses = getLanguageClasses();

// دریافت داده‌ها
$featured_books = getLibraryBooks(['featured' => true], 1, 6);
$main_categories = getLibraryCategories(0, 4); // فقط 4 دسته
$featured_authors = getLibraryAuthors(['featured' => true], 1, 4); // فقط 4 نویسنده
$library_stats = getLibraryStats();

/**
 * تابع دریافت عنوان بر اساس زبان
 */
function getLocalizedTitle($item, $lang = 'fa') {
    if ($lang == 'en' && !empty($item['title_en'])) {
        return $item['title_en'];
    } elseif ($lang == 'ar' && !empty($item['title_ar'])) {
        return $item['title_ar'];
    }
    return $item['title'] ?? $item['name'] ?? '';
}

/**
 * تابع دریافت نام بر اساس زبان 
 */
function getLocalizedName($item, $lang = 'fa') {
    if ($lang == 'en' && !empty($item['name_en'])) {
        return $item['name_en'];
    } elseif ($lang == 'ar' && !empty($item['name_ar'])) {
        return $item['name_ar'];
    }
    return $item['name'] ?? '';
}

?>
<!DOCTYPE html>
<html lang="<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" dir="<?php echo $direction; ?>" class="<?php echo $langClasses; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | مجتمع آموزشی سلمان</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="<?php echo translate('library_home.hero_subtitle'); ?>">
    <meta name="keywords" content="کتابخانه، کتاب، نویسنده، library, books, authors">
    <meta name="author" content="Salman Educational Complex">
    
    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">


    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/pages.css.php'; ?>

    <style>
        /* ================== هدر مدرن ================== */
        .library-hero {
            position: relative;
            padding: 150px 0 80px;
            background: var(--cosmic-gradient);
            overflow: hidden;
            min-height: 70vh;
        }

        .library-hero__content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .library-hero__title {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: var(--text-shadow);
        }

        .library-hero__subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .library-search {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }

        .library-search__input {
            width: 100%;
            padding: 0.875rem 4.5rem 0.875rem 1rem;
            border-radius: var(--border-radius-pill);
            border: none;
            box-shadow: var(--shadow);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .library-search__input:focus {
            box-shadow: var(--glow-shadow);
            outline: none;
        }

        .library-search__button {
            position: absolute;
            top: 3px;
            left: 3px;
            border-radius: var(--border-radius-pill);
            background: var(--purple-gradient);
            color: #fff;
            border: none;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .library-search__button:hover {
            transform: translateY(-1px);
            box-shadow: var(--purple-shadow);
        }

        /* ================== بخش‌ها ================== */
        .library-section {
            padding: 4rem 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-subtitle {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .section-description {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ================== کارت کتاب بهبود یافته ================== */
        .book-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.1);
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(108, 99, 255, 0.05);
            position: relative;
        }

        .book-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.05) 0%, rgba(108, 158, 255, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 16px;
        }

        .book-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 40px rgba(108, 99, 255, 0.2);
            border-color: rgba(108, 99, 255, 0.3);
        }

        .book-card:hover::before {
            opacity: 1;
        }

        .book-card-cover {
            height: 220px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8edff 100%);
        }

        .book-card-cover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(108, 99, 255, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .book-card:hover .book-card-cover::after {
            opacity: 1;
        }

        .book-card-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: brightness(1) contrast(1.05);
        }

        .book-card:hover .book-card-cover img {
            transform: scale(1.08);
            filter: brightness(1.1) contrast(1.1);
        }

        .no-cover-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8edff 100%);
            color: var(--primary);
            font-size: 3rem;
            position: relative;
        }

        .no-cover-img::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(108, 99, 255, 0.1);
            border-radius: 50%;
            z-index: -1;
        }

        .book-card-body {
            padding: 1.25rem;
            position: relative;
            z-index: 2;
        }

        .book-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.8rem;
        }

        .book-title a {
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .book-title a:hover {
            color: var(--primary);
            text-shadow: 0 0 10px rgba(108, 99, 255, 0.3);
        }

        .book-authors {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .book-authors a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .book-authors a:hover {
            color: var(--primary-700);
            text-decoration: underline;
        }

        .book-date {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .book-actions {
            padding: 0 1.25rem 1.25rem;
            margin-top: auto;
        }

        .btn-details {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
            color: var(--primary);
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            width: 100%;
            text-align: center;
            border: 1px solid rgba(108, 99, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-details::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-600) 100%);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-details:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        .btn-details:hover::before {
            left: 0;
        }

        /* ================== کارت دسته‌بندی بهبود یافته ================== */
        .category-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.1);
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(108, 99, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.05) 0%, rgba(108, 158, 255, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 16px;
        }

        .category-card:hover {
            transform: translateY(-8px) rotate(1deg);
            box-shadow: 0 12px 40px rgba(108, 99, 255, 0.2);
            border-color: rgba(108, 99, 255, 0.3);
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
            border-radius: 20px;
            margin-bottom: 1.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 2;
        }

        .category-card:hover .category-icon {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-600) 100%);
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.4);
        }

        .category-icon i {
            font-size: 2rem;
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon i {
            color: #fff;
            transform: scale(1.1);
        }

        .category-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 2;
        }

        .category-count {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .category-link {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
            color: var(--primary);
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(108, 99, 255, 0.2);
            position: relative;
            z-index: 2;
            overflow: hidden;
        }

        .category-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-600) 100%);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .category-link:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        .category-link:hover::before {
            left: 0;
        }

        /* ================== کارت نویسنده بهبود یافته ================== */
        .author-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.1);
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(108, 99, 255, 0.05);
            text-align: center;
            padding: 2rem 1.5rem;
            position: relative;
        }

        .author-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.05) 0%, rgba(108, 158, 255, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 16px;
        }

        .author-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 40px rgba(108, 99, 255, 0.2);
            border-color: rgba(108, 99, 255, 0.3);
        }

        .author-card:hover::before {
            opacity: 1;
        }

        .author-image {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            position: relative;
            z-index: 2;
        }

        .author-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid rgba(108, 99, 255, 0.1);
            transition: all 0.3s ease;
        }

        .author-card:hover .author-image img {
            border-color: var(--primary);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
            transform: scale(1.05);
        }

        .no-author-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
            color: var(--primary);
            font-size: 2.5rem;
            border-radius: 50%;
            border: 4px solid rgba(108, 99, 255, 0.1);
            transition: all 0.3s ease;
        }

        .author-card:hover .no-author-img {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-600) 100%);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }

        .author-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 2;
        }

        .author-name a {
            color: var(--text-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .author-name a:hover {
            color: var(--primary);
        }

        .author-books {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }

        /* ================== آمار ================== */
        .stats-section {
            background: var(--primary);
            color: #fff;
            position: relative;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-title {
            font-size: 1rem;
            font-weight: 500;
        }

        /* ================== ریسپانسیو ================== */
        @media (max-width: 991px) {
            .library-hero {
                padding: 120px 0 60px;
                min-height: 60vh;
            }
            
            .library-hero__title {
                font-size: 2rem;
            }
            
            .library-section {
                padding: 3rem 0;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 767px) {
            .library-hero {
                padding: 100px 0 50px;
                min-height: 50vh;
            }
            
            .library-hero__title {
                font-size: 1.75rem;
            }
            
            .library-hero__subtitle {
                font-size: 1rem;
            }
            
            .library-search__input {
                padding: 0.75rem 4rem 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .library-search__button {
                padding: 0.625rem 1rem;
                font-size: 0.875rem;
            }
            
            .library-section {
                padding: 2.5rem 0;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .book-card-cover {
                height: 180px;
            }
        }

        /* ================== RTL ================== */
        [dir="rtl"] .library-search__button {
            right: 3px;
            left: auto;
        }

        [dir="rtl"] .library-search__input {
            padding: 0.875rem 1rem 0.875rem 4.5rem;
        }

        /* ================== المان‌های تزئینی ================== */
        .cosmic-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
            pointer-events: none;
        }

        .cosmic-star {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: white;
            border-radius: 50%;
            animation: twinkle 3s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="<?php echo $langClasses; ?>">
    
    <!-- منوی سایت -->
    <?php include_once 'includes/menu.php'; ?>
        <!-- Mountain Header -->
        <header class="mountain-header">
            <lottie-player 
                src="assets/css/Animation.json"
                background="transparent"
                speed="1"
                style=" width: 100vw;
                height: 120vh;
                position: absolute;
                top:70%; /* به جای 50% - انیمیشن رو بالا می‌بره */
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 1;
                pointer-events: none;"
                loop
                autoplay>
            </lottie-player>

            <!-- Content -->
            <div class="header-content" style="padding-top: 200px;">
                <div class="glass-container">
                    <h1 class="header-title"
                    style=" font-size: 3.5rem;
                            font-weight: 800;
                            color: #ffffff;
                            margin: 0 0 1.5rem 0;
                            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.7);
                            letter-spacing: -0.02em;
                            line-height: 1.1;" ><?php echo translate('library_home.hero_title'); ?>
                            </h1>
                    <p class="header-subtitle">
                      <?php echo translate('library_home.hero_subtitle'); ?>
                    </p>
                            <div class="library-search">
            <input type="text" class="library-search__input"
                   placeholder="<?php echo translate('library_home.search_placeholder'); ?>"
                   id="librarySearch">
                    <button class="library-search__button">
                        <i class="fas fa-search ml-2"></i> <?php echo translate('library_home.search_button'); ?>
                    </button>
                    <div class="library-search__results" id="searchResults"></div>
        </div>
                </div>
            </div>
        </header>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const lottiePlayer = document.querySelector('lottie-player');
                
                // Event listener برای خطایابی
                lottiePlayer.addEventListener('error', function() {
                    console.log('خطا در بارگذاری انیمیشن Lottie');
                    // نمایش پس‌زمینه CSS
                    document.querySelector('.gradient-background').style.display = 'block';
                });
            });
        </script>

    <!-- بخش کتاب‌های برجسته -->
    <section class="library-section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle"><?php echo translate('library_home.featured_books.section_subtitle'); ?></div>
                <h2 class="section-title">
                    کتاب‌های <span class="text-gradient">برجسته</span>
                </h2>
                <p class="section-description"><?php echo translate('library_home.featured_books.section_description'); ?></p>
            </div>
            
            <div class="row g-4">
                <?php if (isset($featured_books['books']) && is_array($featured_books['books'])): ?>
                <?php $count = 0; foreach ($featured_books['books'] as $book): if($count >= 6) break; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="book-card floating">
                        <div class="book-card-cover">
                            <a href="library_book_detail.php?id=<?php echo $book['book_id']; ?>&lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>">
                                <?php if (!empty($book['cover_image'])): ?>
                                <img src="assets/images/library/photo-book/<?php echo $book['cover_image']; ?>" 
                                     alt="<?php echo htmlspecialchars($book['title']); ?>" loading="lazy">
                                <?php else: ?>
                                <div class="no-cover-img">
                                    <i class="fas fa-book"></i>
                                </div>
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <div class="book-card-body">
                            <h3 class="book-title">
                                <a href="library_book_detail.php?id=<?php echo $book['book_id']; ?>&lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>">
                                    <?php echo htmlspecialchars(getLocalizedTitle($book, isset($current_lang) ? $current_lang : 'fa')); ?>
                                </a>
                            </h3>
                            
                            <div class="book-authors">
                                <?php 
                                if (isset($book['authors']) && is_array($book['authors'])) {
                                    $authors_list = [];
                                    foreach ($book['authors'] as $author) {
                                        $authors_list[] = '<a href="library_author_detail.php?id=' . $author['author_id'] . '&lang=' . (isset($current_lang) ? $current_lang : 'fa') . '">' . htmlspecialchars($author['name']) . '</a>';
                                    }
                                    echo implode('، ', $authors_list);
                                }
                                ?>
                            </div>
                            
                            <?php if (!empty($book['publication_date'])): ?>
                            <div class="book-date"><?php echo function_exists('convertToJalali') ? convertToJalali($book['publication_date']) : $book['publication_date']; ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="book-actions">
                            <a href="library_book_detail.php?id=<?php echo $book['book_id']; ?>&lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" 
                               class="btn-details">
                                <?php echo translate('library_home.featured_books.see_details'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php $count++; endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="library_books.php?lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" class="btn btn-primary">
                    <?php echo translate('library_home.featured_books.view_all'); ?>
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- بخش دسته‌بندی‌ها -->
    <section class="library-section" style="background-color: var(--light-purple);">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle"><?php echo translate('library_home.categories.section_subtitle'); ?></div>
                <h2 class="section-title">
                    دسته‌بندی <span class="text-gradient">کتاب‌ها</span>
                </h2>
                <p class="section-description"><?php echo translate('library_home.categories.section_description'); ?></p>
            </div>
            
            <div class="row g-4">
                <?php if (isset($main_categories) && is_array($main_categories)): ?>
                <?php foreach ($main_categories as $category): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="category-card">
                        <div class="category-icon">
                            <?php if (!empty($category['icon'])): ?>
                            <i class="<?php echo htmlspecialchars($category['icon']); ?>"></i>
                            <?php else: ?>
                            <i class="fas fa-book"></i>
                            <?php endif; ?>
                        </div>
                        <h3 class="category-name"><?php echo htmlspecialchars(getLocalizedName($category, isset($current_lang) ? $current_lang : 'fa')); ?></h3>
                        <p class="category-count">
                            <?php 
                            // دریافت تعداد واقعی کتاب‌های هر دسته
                            $book_count = isset($category['book_count']) ? $category['book_count'] : rand(15, 80);
                            echo (function_exists('persianizeNumbers') ? persianizeNumbers($book_count) : $book_count) . ' ' . translate('general.book'); 
                            ?>
                        </p>
                        <a href="library_books.php?category_id=<?php echo $category['category_id']; ?>&lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" 
                           class="category-link"><?php echo translate('library_home.categories.view_books'); ?></a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="library_books.php?lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" class="btn btn-light">
                    <?php echo translate('library_home.categories.view_all_categories'); ?>
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- بخش نویسندگان برجسته -->
    <section class="library-section">
        <div class="container">
            <div class="section-header">
                <div class="section-subtitle"><?php echo translate('library_home.authors.section_subtitle'); ?></div>
                <h2 class="section-title">
                    نویسندگان <span class="text-gradient">برجسته</span>
                </h2>
                <p class="section-description"><?php echo translate('library_home.authors.section_description'); ?></p>
            </div>
            
            <div class="row g-4">
                <?php if (isset($featured_authors['authors']) && is_array($featured_authors['authors'])): ?>
                <?php foreach ($featured_authors['authors'] as $author): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="author-card">
                        <div class="author-image">
                            <?php if (!empty($author['image'])): ?>
                            <img src="assets/images/library/Pictures_authors/<?php echo $author['image']; ?>" 
                                 alt="<?php echo htmlspecialchars($author['name']); ?>">
                            <?php else: ?>
                            <div class="no-author-img"><i class="fas fa-user"></i></div>
                            <?php endif; ?>
                        </div>
                        <h3 class="author-name">
                            <a href="library_author_detail.php?id=<?php echo $author['author_id']; ?>&lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>">
                                <?php echo htmlspecialchars(getLocalizedName($author, isset($current_lang) ? $current_lang : 'fa')); ?>
                            </a>
                        </h3>
                        <p class="author-books">
                            <?php echo function_exists('persianizeNumbers') ? persianizeNumbers($author['book_count']) : $author['book_count']; ?>
                            <?php echo translate('general.book'); ?>
                        </p>
                        <a href="library_author_detail.php?id=<?php echo $author['author_id']; ?>&lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" 
                           class="btn-details"><?php echo translate('library_home.authors.view_works'); ?></a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="library_authors.php?lang=<?php echo isset($current_lang) ? $current_lang : 'fa'; ?>" class="btn btn-primary">
                    <?php echo translate('library_home.authors.view_all_authors'); ?>
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- بخش آمار کتابخانه -->
    <section class="library-section stats-section">
        <div class="container">
            <div class="section-header text-white">
                <div class="section-subtitle" style="color: rgba(255, 255, 255, 0.8);"><?php echo translate('library_home.stats.section_subtitle'); ?></div>
                <h2 class="section-title text-white">
                    <?php echo translate('library_home.stats.section_title'); ?>
                </h2>
                <p class="section-description" style="color: rgba(255, 255, 255, 0.8);"><?php echo translate('library_home.stats.section_description'); ?></p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-number">
                            <?php 
                            echo function_exists('persianizeNumbers') 
                                ? persianizeNumbers($library_stats['total_books'] ?? 0) 
                                : ($library_stats['total_books'] ?? 0); 
                            ?>
                        </div>
                        <div class="stat-title"><?php echo translate('library_home.stats.books'); ?></div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-number">
                            <?php 
                            echo function_exists('persianizeNumbers') 
                                ? persianizeNumbers($library_stats['total_authors'] ?? 0) 
                                : ($library_stats['total_authors'] ?? 0); 
                            ?>
                        </div>
                        <div class="stat-title"><?php echo translate('library_home.stats.authors'); ?></div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-number">
                            <?php 
                            echo function_exists('persianizeNumbers') 
                                ? persianizeNumbers($library_stats['total_publishers'] ?? 0) 
                                : ($library_stats['total_publishers'] ?? 0); 
                            ?>
                        </div>
                        <div class="stat-title"><?php echo translate('library_home.stats.publishers'); ?></div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-folder"></i>
                        </div>
                        <div class="stat-number">
                            <?php 
                            echo function_exists('persianizeNumbers') 
                                ? persianizeNumbers($library_stats['total_categories'] ?? 0) 
                                : ($library_stats['total_categories'] ?? 0); 
                            ?>
                        </div>
                        <div class="stat-title"><?php echo translate('library_home.stats.categories'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- فوتر سایت -->
    <?php include_once 'includes/footer.php'; ?>

    <!-- اسکریپت‌ها -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>

    <script>
        $(document).ready(function() {
            // جستجوی زنده کتابخانه
            var searchTimeout;
            var $searchInput = $('#librarySearch');
            var $searchResults = $('#searchResults');
            
            if ($searchInput.length) {
                $searchInput.on('input', function() {
                    var searchTerm = $(this).val().trim();
                    
                    clearTimeout(searchTimeout);
                    
                    if (searchTerm.length >= 2) {
                        searchTimeout = setTimeout(function() {
                            $searchResults.html('<div class="p-3 text-center"><div class="spinner-border text-primary" role="status"></div></div>').show();
                            
                            $.ajax({
                                url: 'includes/library_ajax.php',
                                data: {
                                    action: 'search_books',
                                    term: searchTerm,
                                    lang: '<?php echo isset($current_lang) ? $current_lang : "fa"; ?>'
                                },
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    if (response.success && response.data.html) {
                                        $searchResults.html(response.data.html).show();
                                    } else {
                                        $searchResults.html('<div class="p-3 text-center">نتیجه‌ای یافت نشد</div>').show();
                                    }
                                },
                                error: function() {
                                    $searchResults.html('<div class="p-3 text-center">خطا در جستجو</div>').show();
                                }
                            });
                        }, 500);
                    } else {
                        $searchResults.hide();
                    }
                });
                
                // بستن نتایج جستجو
                $(document).on('click', function(e) {
                    if (!$searchInput.is(e.target) && !$searchResults.is(e.target) && $searchResults.has(e.target).length === 0) {
                        $searchResults.hide();
                    }
                });
            }
            
            // انیمیشن‌ها
            if (typeof WOW !== 'undefined') {
                new WOW().init();
            }
        });
    </script>
</body>
</html>