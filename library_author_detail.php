<?php
    /**
     * صفحه نمایش جزئیات نویسنده - نسخه چندزبانه بازنویسی شده
     * 
     * @package Salman Educational Complex
     * @subpackage Library
     * @version 8.0
     */

    // شروع session
    session_start();

    // بارگذاری فایل‌های مورد نیاز
    require_once 'includes/config.php';
    require_once 'includes/library_functions.php';
    require_once 'includes/library-helper.php';

    // دریافت زبان فعلی
    $language_id = $_SESSION['language_id'] ?? 1;
    $lang_code = getLanguageCode($language_id);
    $page_dir = getPageDirection($language_id);
    $locale = getLocale($language_id);
    $isRtl = ($page_dir === 'rtl');

    // دریافت و اعتبارسنجی شناسه نویسنده
    $author_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($author_id <= 0) {
        header('Location: library_authors.php');
        exit;
    }

    // دریافت اطلاعات نویسنده
    $author = getAuthorDetails($author_id, $language_id);

    // بررسی وجود نویسنده
    if (!$author) {
        header('HTTP/1.0 404 Not Found');
        include '404.php';
        exit;
    }

    // آماده‌سازی داده‌ها
    $books_by_role = [];
    $total_books_in_library = 0;
    $has_books = false;

    foreach ($author['books'] as $book) {
        $role = $book['role'] ?? 'author';
        if (!isset($books_by_role[$role])) {
            $books_by_role[$role] = [];
        }
        $books_by_role[$role][] = $book;
        $total_books_in_library++;
        $has_books = true;
    }

    // ترتیب و نام‌گذاری نقش‌ها
    $role_order = ['author', 'translator', 'editor', 'illustrator'];
    $role_names = [
        'author' => getTranslation('author_detail', 'role_author'),
        'translator' => getTranslation('author_detail', 'role_translator'),
        'editor' => getTranslation('author_detail', 'role_editor'),
        'illustrator' => getTranslation('author_detail', 'role_illustrator')
    ];

    $role_icons = [
        'author' => 'fa-pen-fancy',
        'translator' => 'fa-language',
        'editor' => 'fa-edit',
        'illustrator' => 'fa-palette'
    ];

    // مرتب‌سازی نقش‌ها
    $sorted_books_by_role = [];
    foreach ($role_order as $role) {
        if (isset($books_by_role[$role])) {
            $sorted_books_by_role[$role] = $books_by_role[$role];
        }
    }

    // محاسبه اطلاعات تاریخی
    $birth_year = !empty($author['birth_date']) ? date('Y', strtotime($author['birth_date'])) : null;
    $death_year = !empty($author['death_date']) ? date('Y', strtotime($author['death_date'])) : null;
    $is_alive = empty($author['death_date']);
    $age = null;

    if ($birth_year) {
        if ($is_alive) {
            $current_year = date('Y');
            $age = $current_year - $birth_year;
        } else if ($death_year) {
            $age = $death_year - $birth_year;
        }
    }

    // پردازش نقل قول‌ها
    $quotes = [];
    if (!empty($author['quotes'])) {
        // جداسازی نقل قول‌ها بر اساس خط جدید یا |
        $raw_quotes = preg_split('/[\n\r]+|\s*\|\s*/', $author['quotes']);
        $quotes = array_filter(array_map('trim', $raw_quotes));
    }

    // ایجاد URL های SEO-friendly
    $canonical_url = 'https://salman.ac.ir/library_author_detail.php?id=' . $author_id;
    $author_slug = urlencode(str_replace(' ', '-', $author['name']));

    // دریافت نام مجتمع از config
    $db = getLibraryDatabaseConnection();
    $complex_name_query = "SELECT config_value FROM core_config WHERE config_key = 'complex_name_$lang_code' LIMIT 1";
    $complex_name_result = $db->query($complex_name_query);
    $complex_name = getComplexName($language_id);
    // تنظیمات SEO
    $pageTitle = $author['name'];
    $seo_title = $author['name'];

    // افزودن نقش اصلی به عنوان
    $primary_role = !empty($sorted_books_by_role) ? array_keys($sorted_books_by_role)[0] : 'author';
    $seo_title .= ' - ' . $role_names[$primary_role];

    if (!empty($author['nationality'])) {
        $seo_title .= ' ' . translateCountry($author['nationality']);
    }

    $seo_title .= ' | ' . $complex_name;

    // Meta Description
    $pageDescription = getTranslation('author_detail', 'biography') . ' ' . $author['name'];
    if (!empty($author['nationality'])) {
        $pageDescription .= "، {$role_names[$primary_role]} " . translateCountry($author['nationality']);
    }
    if ($total_books_in_library > 0) {
        $works_text = getTranslation('author_detail', 'works_in_library');
        $pageDescription .= ". $total_books_in_library $works_text";
    }
    $pageDescription .= " - $complex_name";

    // Open Graph Image
    $og_image = 'https://salman.ac.ir/assets/images/library/author-default-og.jpg';
    if (!empty($author['image']) && file_exists('assets/images/library/Pictures_authors/' . $author['image'])) {
        $og_image = 'https://salman.ac.ir/assets/images/library/Pictures_authors/' . urlencode($author['image']);
    }

?>
<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seo_title); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($author['name']); ?>, <?php echo $role_names[$primary_role]; ?>, <?php echo getTranslation('author_detail', 'book'); ?>, <?php echo getTranslation('author_detail', 'biography'); ?><?php echo !empty($author['nationality']) ? ', ' . htmlspecialchars(translateCountry($author['nationality'])) : ''; ?>, <?php echo $complex_name; ?>">
    <meta name="author" content="<?php echo $complex_name; ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    
    <!-- Dublin Core Metadata -->
    <meta name="DC.Title" content="<?php echo htmlspecialchars($author['name']); ?>">
    <meta name="DC.Creator" content="<?php echo $complex_name; ?>">
    <meta name="DC.Subject" content="<?php echo getTranslation('author_detail', 'biography'); ?>, <?php echo $role_names[$primary_role]; ?>">
    <meta name="DC.Description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="DC.Publisher" content="<?php echo $complex_name; ?>">
    <meta name="DC.Type" content="Text">
    <meta name="DC.Format" content="text/html">
    <meta name="DC.Language" content="<?php echo $lang_code; ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($author['name']); ?> - <?php echo $role_names[$primary_role]; ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:image" content="<?php echo $og_image; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="<?php echo $locale; ?>">
    <meta property="og:site_name" content="<?php echo $complex_name; ?>">
    
    <?php if (!empty($author['birth_date'])): ?>
    <meta property="profile:first_name" content="<?php echo htmlspecialchars(explode(' ', $author['name'])[0] ?? ''); ?>">
    <meta property="profile:last_name" content="<?php echo htmlspecialchars(end(explode(' ', $author['name'])) ?? ''); ?>">
    <?php endif; ?>
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($author['name']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="twitter:image" content="<?php echo $og_image; ?>">
    <meta name="twitter:image:alt" content="<?php echo htmlspecialchars($author['name']); ?>">
    
    <!-- Structured Data (Enhanced) -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "@id": "<?php echo $canonical_url; ?>",
            "name": "<?php echo htmlspecialchars($author['name']); ?>",
            "alternateName": "<?php echo htmlspecialchars($author['name']); ?>",
            <?php if (!empty($author['image'])): ?>
            "image": {
                "@type": "ImageObject",
                "url": "<?php echo $og_image; ?>",
                "width": 500,
                "height": 500
            },
            <?php endif; ?>
            <?php if (!empty($author['birth_date'])): ?>
            "birthDate": "<?php echo $author['birth_date']; ?>",
            "birthPlace": {
                "@type": "Place",
                "name": "<?php echo htmlspecialchars($author['nationality'] ?? 'Unknown'); ?>"
            },
            <?php endif; ?>
            <?php if (!empty($author['death_date'])): ?>
            "deathDate": "<?php echo $author['death_date']; ?>",
            <?php endif; ?>
            <?php if (!empty($author['nationality'])): ?>
            "nationality": {
                "@type": "Country",
                "name": "<?php echo htmlspecialchars($author['nationality']); ?>"
            },
            <?php endif; ?>
            <?php if (!empty($author['website'])): ?>
            "url": "<?php echo htmlspecialchars($author['website']); ?>",
            "sameAs": ["<?php echo htmlspecialchars($author['website']); ?>"],
            <?php endif; ?>
            "jobTitle": [<?php 
                $jobs = [];
                foreach (array_keys($sorted_books_by_role) as $role) {
                    $jobs[] = '"' . $role_names[$role] . '"';
                }
                echo implode(', ', $jobs);
            ?>],
            "description": "<?php echo htmlspecialchars(mb_substr(strip_tags($author['biography'] ?? ''), 0, 200)); ?>...",
            <?php if ($author['gender']): ?>
            "gender": "<?php echo $author['gender'] == 'male' ? 'Male' : 'Female'; ?>",
            <?php endif; ?>
            <?php if ($has_books): ?>
            "workExample": [
                <?php 
                $book_schemas = [];
                foreach (array_slice($author['books'], 0, 5) as $book) {
                    $book_schemas[] = '{
                        "@type": "Book",
                        "name": "' . htmlspecialchars($book['title']) . '",
                        "url": "https://salman.ac.ir/library_book_detail.php?id=' . $book['book_id'] . '"
                    }';
                }
                echo implode(',', $book_schemas);
                ?>
            ],
            <?php endif; ?>
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php echo $canonical_url; ?>"
            }
        }
    </script>
    
    <!-- Breadcrumb Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://salman.ac.ir/",
                        "name": "<?php echo getTranslation('authors_list', 'home'); ?>"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://salman.ac.ir/library.php",
                        "name": "<?php echo getTranslation('authors_list', 'library'); ?>"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "item": {
                        "@id": "https://salman.ac.ir/library_authors.php",
                        "name": "<?php echo getTranslation('authors_list', 'authors'); ?>"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 4,
                    "item": {
                        "@id": "<?php echo $canonical_url; ?>",
                        "name": "<?php echo htmlspecialchars($author['name']); ?>"
                    }
                }
            ]
        }
    </script>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php if (!empty($author['image']) && file_exists('assets/images/library/Pictures_authors/' . $author['image'])): ?>
    <link rel="preload" as="image" href="assets/images/library/Pictures_authors/<?php echo htmlspecialchars($author['image']); ?>">
    <?php endif; ?>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
    
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/pages.css.php'; ?>
    
</head>
<body itemscope itemtype="https://schema.org/WebPage">
    
    <!-- Skip to Content Link -->
    <a href="#main-content" class="skip-link"><?php echo getTranslation('authors_list', 'skip_to_content'); ?></a>
    
    <!-- Header & Navigation -->
    <?php include_once 'includes/menu.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero-section-v2" role="banner">
        <div class="hero-bg-shape shape-1"></div>
        <div class="hero-bg-shape shape-2"></div>
        <div class="floating-particles" aria-hidden="true">
            <?php for ($i = 0; $i < 15; $i++): ?>
            <div class="particle"></div>
            <?php endfor; ?>
        </div>

        <div class="container">
            <nav aria-label="<?php echo getTranslation('authors_list', 'breadcrumb'); ?>" class="hero-breadcrumb">
                <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="index.php" itemprop="item"><span itemprop="name"><?php echo getTranslation('authors_list', 'home'); ?></span></a><meta itemprop="position" content="1">
                    </li>
                    <li><i class="fas fa-chevron-<?php echo $isRtl ? 'left' : 'right'; ?>"></i></li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="library.php" itemprop="item"><span itemprop="name"><?php echo getTranslation('authors_list', 'library'); ?></span></a><meta itemprop="position" content="2">
                    </li>
                    <li><i class="fas fa-chevron-<?php echo $isRtl ? 'left' : 'right'; ?>"></i></li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="library_authors.php" itemprop="item"><span itemprop="name"><?php echo getTranslation('authors_list', 'authors'); ?></span></a><meta itemprop="position" content="3">
                    </li>
                    <li><i class="fas fa-chevron-<?php echo $isRtl ? 'left' : 'right'; ?>"></i></li>
                    <li aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name"><?php echo htmlspecialchars($author['name']); ?></span><meta itemprop="position" content="4">
                    </li>
                </ol>
            </nav>
            
            <div class="hero-layout">
                <div class="hero-image-col animate-scaleIn">
                    <div class="hero-image-wrapper">
                        <?php if (!empty($author['image']) && file_exists('assets/images/library/Pictures_authors/' . $author['image'])): ?>
                            <img src="assets/images/library/Pictures_authors/<?php echo htmlspecialchars($author['image']); ?>" 
                                alt="<?php echo htmlspecialchars($author['name']); ?>" 
                                class="hero-author-image"
                                width="300"
                                height="300">
                        <?php else: ?>
                            <div class="hero-image-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="hero-content-col">
                    <h1 class="hero-title animate-fadeInUp" itemprop="name"><?php echo htmlspecialchars($author['name']); ?></h1>
                    
                    <?php 
                    $subtitle_parts = [];
                    if (!empty($sorted_books_by_role)) {
                        $role_text = [];
                        foreach (array_slice(array_keys($sorted_books_by_role), 0, 2) as $role) {
                            $role_text[] = $role_names[$role] ?? $role;
                        }
                        $subtitle_parts[] = implode(' و ', $role_text);
                    }
                    if (!empty($author['nationality'])) {
                        $subtitle_parts[] = htmlspecialchars(translateCountry($author['nationality']));
                    }
                    ?>
                    <p class="hero-subtitle animate-fadeInUp delay-100">
                        <?php echo implode(' - ', $subtitle_parts); ?>
                    </p>
                    
                    <div class="hero-meta-data animate-fadeInUp delay-200">
                        <?php if (!empty($birth_year)): ?>
                        <div class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>
                                <?php 
                                if ($is_alive) {
                                    echo getTranslation('author_detail', 'born') . " " . ($language_id == 1 ? convertToJalali($author['birth_date'], 'Y') : date('Y', strtotime($author['birth_date'])));
                                    if ($age) echo " (" . ($language_id == 1 ? persianizeNumbers($age) : $age) . " " . getTranslation('author_detail', 'years') . ")";
                                } else {
                                    echo ($language_id == 1 ? convertToJalali($author['birth_date'], 'Y') : date('Y', strtotime($author['birth_date']))) . " - " . ($language_id == 1 ? convertToJalali($author['death_date'], 'Y') : date('Y', strtotime($author['death_date'])));
                                }
                                ?>
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($total_books_in_library > 0): ?>
                        <div class="meta-item">
                            <i class="fas fa-book-open"></i>
                            <span><?php echo $language_id == 1 ? persianizeNumbers($total_books_in_library) : $total_books_in_library; ?> <?php echo getTranslation('author_detail', 'work'); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($author['featured'] == 1): ?>
                        <div class="meta-item featured-author">
                            <i class="fas fa-star"></i>
                            <span><?php echo getTranslation('author_detail', 'featured_author'); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Content -->
    <main id="main-content" class="author-page-main" itemprop="mainEntity" itemscope itemtype="https://schema.org/Person">
        <meta itemprop="name" content="<?php echo htmlspecialchars($author['name']); ?>">
        <?php if (!empty($author['image'])): ?>
        <meta itemprop="image" content="<?php echo $og_image; ?>">
        <?php endif; ?>

        <div class="container">
            <div class="author-layout">
                <aside class="author-sidebar">
                    <div class="author-sidebar__sticky-content">
                        <?php if (!empty($author['birth_date']) || !empty($author['death_date']) || !empty($author['gender'])): ?>
                        <div class="info-card modern-card">
                            <h3 class="info-card__title">
                                <i class="fas fa-info-circle" aria-hidden="true"></i>
                                <?php echo getTranslation('author_detail', 'personal_info'); ?>
                            </h3>
                            <div class="info-card__content">
                                <?php if (!empty($author['birth_date'])): ?>
                                <div class="info-item">
                                    <span class="info-label"><?php echo getTranslation('author_detail', 'birth_date'); ?></span>
                                    <span class="info-value" itemprop="birthDate" content="<?php echo $author['birth_date']; ?>">
                                        <?php echo $language_id == 1 ? convertToJalali($author['birth_date']) : date('F j, Y', strtotime($author['birth_date'])); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($author['death_date'])): ?>
                                <div class="info-item">
                                    <span class="info-label"><?php echo getTranslation('author_detail', 'death_date'); ?></span>
                                    <span class="info-value" itemprop="deathDate" content="<?php echo $author['death_date']; ?>">
                                        <?php echo $language_id == 1 ? convertToJalali($author['death_date']) : date('F j, Y', strtotime($author['death_date'])); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($age): ?>
                                <div class="info-item">
                                    <span class="info-label"><?php echo getTranslation('author_detail', 'age'); ?></span>
                                    <span class="info-value">
                                        <?php echo $language_id == 1 ? persianizeNumbers($age) : $age; ?> <?php echo getTranslation('author_detail', 'years'); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($author['gender'])): ?>
                                <div class="info-item">
                                    <span class="info-label"><?php echo getTranslation('author_detail', 'gender'); ?></span>
                                    <span class="info-value" itemprop="gender" content="<?php echo $author['gender'] == 'male' ? 'Male' : 'Female'; ?>">
                                        <?php echo $author['gender'] == 'male' ? getTranslation('author_detail', 'male') : getTranslation('author_detail', 'female'); ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </aside>

                <div class="author-content-professional">
                    <?php if (!empty($author['biography'])): ?>
                    <section id="biography" class="content-section modern-card">
                        <h2 class="content-section__title">
                            <i class="fas fa-feather-alt"></i>
                            <span><?php echo getTranslation('author_detail', 'biography'); ?></span>
                        </h2>
                        <div class="content-section__body biography-content" itemprop="description">
                            <?php 
                            $paragraphs = array_filter(explode("\n", $author['biography']));
                            foreach ($paragraphs as $paragraph):
                                echo "<p>" . nl2br(htmlspecialchars(trim($paragraph))) . "</p>";
                            endforeach; 
                            ?>
                        </div>
                    </section>
                    <?php endif; ?>

                    <?php if (!empty($quotes)): ?>
                    <section id="quotes" class="content-section modern-card">
                        <h2 class="content-section__title">
                            <i class="fas fa-quote-left"></i>
                            <span><?php echo getTranslation('author_detail', 'selected_quotes'); ?></span>
                        </h2>
                        <div class="content-section__body quotes-container">
                            <?php foreach ($quotes as $index => $quote): ?>
                            <blockquote class="quote-item" data-quote-index="<?php echo $index; ?>">
                                <p class="quote-text"><?php echo htmlspecialchars($quote); ?></p>
                                <footer class="quote-footer">
                                    <cite class="quote-author">— <?php echo htmlspecialchars($author['name']); ?></cite>
                                </footer>
                            </blockquote>
                            <?php endforeach; ?>
                        </div>
                    </section>
                    <?php endif; ?>

                    <?php if ($has_books): ?>
                    <section id="books" class="content-section modern-card">
                        <h2 class="content-section__title">
                            <i class="fas fa-swatchbook"></i>
                            <span><?php echo getTranslation('author_detail', 'works_in_library'); ?></span>
                        </h2>
                        <div class="content-section__body">
                            <?php foreach ($sorted_books_by_role as $role => $books): ?>
                            <div class="books-role-section">
                                <h3 class="role-title">
                                    <i class="fas <?php echo $role_icons[$role] ?? 'fa-book'; ?>"></i>
                                    <span><?php echo $role_names[$role] ?? $role; ?></span>
                                    <span class="role-count"><?php echo $language_id == 1 ? persianizeNumbers(count($books)) : count($books); ?></span>
                                </h3>
                                <div class="professional-books-grid">
                                    <?php foreach ($books as $book): ?>
                                    <article class="book-card-pro" itemscope itemtype="https://schema.org/Book">
                                    <a href="library_book_detail.php?id=<?php echo $book['book_id']; ?>" class="book-card-pro__link" itemprop="url">
                                            <div class="book-card-pro__cover">
                                                <?php if (!empty($book['cover_image']) && file_exists('assets/images/library/photo-book/' . $book['cover_image'])): ?>
                                                <img src="assets/images/library/photo-book/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" loading="lazy" itemprop="image">
                                                <?php else: ?>
                                                <div class="book-cover-placeholder"><span><?php echo htmlspecialchars(mb_substr($book['title'], 0, 30)); ?></span></div>
                                                <?php endif; ?>
                                                <div class="book-card-pro__overlay">
                                                    <i class="fas fa-eye"></i>
                                                    <span><?php echo getTranslation('author_detail', 'view_details'); ?></span>
                                                </div>
                                            </div>
                                            <div class="book-card-pro__body">
                                                <h4 class="book-card-pro__title" itemprop="name"><?php echo htmlspecialchars($book['title']); ?></h4>
                                            </div>
                                    </a>
                                    </article>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
        
    <!-- Footer -->
    <?php include_once 'includes/footer.php'; ?>
    
    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- Quotes Data for JavaScript -->
    <script>
        const quotesData = <?php echo json_encode($quotes, JSON_UNESCAPED_UNICODE); ?>;
        const authorName = <?php echo json_encode($author['name'], JSON_UNESCAPED_UNICODE); ?>;
        const pageUrl = <?php echo json_encode($canonical_url); ?>;
        const translations = {
            linkCopied: <?php echo json_encode(getTranslation('author_detail', 'link_copied')); ?>,
            pageLinkCopied: <?php echo json_encode(getTranslation('author_detail', 'page_link_copied')); ?>,
            quoteCopied: <?php echo json_encode(getTranslation('author_detail', 'quote_copied')); ?>,
            errorCopying: <?php echo json_encode(getTranslation('author_detail', 'error_copying')); ?>
        };
    </script>
    
    <!-- Page Specific Scripts -->
    <script>
        // Share Modal Functions
        function openShareModal() {
            const modal = document.getElementById('shareModal');
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            
            // Focus management
            const firstButton = modal.querySelector('.share-option');
            if (firstButton) firstButton.focus();
        }
        
        function closeShareModal() {
            const modal = document.getElementById('shareModal');
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            
            // Return focus to trigger button
            const shareButton = document.querySelector('[onclick="openShareModal()"]');
            if (shareButton) shareButton.focus();
        }
        
        function closeModalOnBackground(e) {
            if (e.target === e.currentTarget) {
                closeShareModal();
            }
        }
        
        // تابع برای جلوگیری از تداخل با منوی زبان
        document.addEventListener('DOMContentLoaded', function() {
            // اطمینان از اینکه منوی زبان بالاتر از modal باشد
            const languageDropdown = document.querySelector('.language-dropdown');
            if (languageDropdown) {
                languageDropdown.style.zIndex = '10001';
            }
            
            // حل مشکل تداخل event ها
            const modal = document.getElementById('shareModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    // فقط اگر روی background کلیک شد
                    if (e.target === modal) {
                        e.stopPropagation();
                        closeShareModal();
                    }
                });
            }
        });
        
        // Copy Page Link Function
        function copyPageLink() {
            const url = window.location.href;
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    showToast(translations.pageLinkCopied);
                }).catch(() => {
                    fallbackCopy(url);
                });
            } else {
                fallbackCopy(url);
            }
        }
        
        // Fallback copy method
        function fallbackCopy(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.opacity = '0';
            document.body.appendChild(textArea);
            textArea.select();
            
            try {
                document.execCommand('copy');
                showToast(translations.linkCopied);
            } catch (err) {
                showToast(translations.errorCopying);
            }
            
            document.body.removeChild(textArea);
        }
        
        // Copy Share Link
        function copyShareLink() {
            const input = document.getElementById('shareLink');
            input.select();
            input.setSelectionRange(0, 99999); // For mobile
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(input.value).then(() => {
                    showToast(translations.linkCopied);
                }).catch(() => {
                    document.execCommand('copy');
                    showToast(translations.linkCopied);
                });
            } else {
                document.execCommand('copy');
                showToast(translations.linkCopied);
            }
        }
        // Share Quote
        function shareQuote(index) {
            if (!quotesData[index]) return;
            
            const quote = quotesData[index];
            const text = `"${quote}"\n— ${authorName}`;
            
            if (navigator.share) {
                navigator.share({
                    title: `${authorName}`,
                    text: text,
                    url: pageUrl
                }).catch(err => {
                    // Fallback to Twitter if native share fails
                    const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(pageUrl)}`;
                    window.open(twitterUrl, '_blank');
                });
            } else {
                // Fallback to Twitter
                const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(pageUrl)}`;
                window.open(twitterUrl, '_blank');
            }
        }
        
        // Copy Quote
        function copyQuote(index) {
            if (!quotesData[index]) return;
            
            const quote = quotesData[index];
            const text = `"${quote}"\n— ${authorName}`;
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast(translations.quoteCopied);
                }).catch(() => {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }
        
        // Toast Notification
        function showToast(message, duration = 3000) {
            const toast = document.getElementById('toastNotification');
            const toastMessage = document.getElementById('toastMessage');
            
            toastMessage.textContent = message;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, duration);
        }
        
        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize animations
            if (typeof WOW !== 'undefined') {
                new WOW().init();
            }
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offset = 100;
                        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Escape to close modal
                if (e.key === 'Escape') {
                    const modal = document.getElementById('shareModal');
                    if (modal.classList.contains('active')) {
                        closeShareModal();
                    }
                }
                
                // Ctrl/Cmd + C to copy link
                if ((e.ctrlKey || e.metaKey) && e.key === 'c' && window.getSelection().toString() === '') {
                    copyPageLink();
                    e.preventDefault();
                }
            });
            
            // Lazy loading optimization
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                            }
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                    threshold: 0.01
                });
                
                document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
            
            // Analytics tracking
            if (typeof gtag !== 'undefined') {
                // Track quote interactions
                document.querySelectorAll('[onclick^="shareQuote"]').forEach(btn => {
                    btn.addEventListener('click', function() {
                        gtag('event', 'share_quote', {
                            'event_category': 'engagement',
                            'event_label': authorName
                        });
                    });
                });
                
                document.querySelectorAll('[onclick^="copyQuote"]').forEach(btn => {
                    btn.addEventListener('click', function() {
                        gtag('event', 'copy_quote', {
                            'event_category': 'engagement',
                            'event_label': authorName
                        });
                    });
                });
                
                // Track book clicks
                document.querySelectorAll('.book-card__link').forEach(link => {
                    link.addEventListener('click', function() {
                        const bookTitle = this.querySelector('.book-card__title').textContent;
                        gtag('event', 'book_click', {
                            'event_category': 'library',
                            'event_label': bookTitle,
                            'author': authorName
                        });
                    });
                });
            }
            
            // Print-friendly version
            window.addEventListener('beforeprint', function() {
                document.body.classList.add('print-mode');
            });
            
            window.addEventListener('afterprint', function() {
                document.body.classList.remove('print-mode');
            });
        });
    </script>
</body>
</html>