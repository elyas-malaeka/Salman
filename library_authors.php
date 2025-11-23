<?php
/**
 * صفحه نمایش نویسندگان کتابخانه آنلاین
 * نسخه چندزبانه - بازنویسی شده
 * 
 * @package Salman Educational Complex
 * @subpackage Library
 * @version 6.0
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

// تنظیمات صفحه
$pageTitle = getTranslation('authors_list', 'page_title');
$pageDescription = getTranslation('authors_list', 'page_description');
$isRtl = ($page_dir === 'rtl');

// دریافت و اعتبارسنجی پارامترها
$search = isset($_GET['search']) ? trim(strip_tags($_GET['search'])) : '';
$nationality = isset($_GET['nationality']) ? trim(strip_tags($_GET['nationality'])) : '';
$sort = isset($_GET['sort']) && in_array($_GET['sort'], ['name_asc', 'name_desc', 'books_desc', 'books_asc', 'newest', 'oldest']) ? $_GET['sort'] : 'name_asc';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// ایجاد آرایه فیلترها
$filters = [];
if (!empty($search)) $filters['search'] = $search;
if (!empty($nationality)) $filters['nationality'] = $nationality;

// دریافت داده‌ها
$per_page = 24;
$authors_data = getLibraryAuthors($filters, $page, $per_page, $language_id);
$authors = $authors_data['authors'];
$pagination = $authors_data['pagination'];

// دریافت لیست کشورهای موجود برای فیلتر
$db = getLibraryDatabaseConnection();
$nationality_query = "SELECT DISTINCT a.nationality, COUNT(DISTINCT ba.book_id) as book_count 
                     FROM library_authors a 
                     INNER JOIN library_book_authors ba ON a.author_id = ba.author_id
                     WHERE a.nationality IS NOT NULL AND a.nationality != ''
                     GROUP BY a.nationality 
                     HAVING book_count > 0
                     ORDER BY book_count DESC, a.nationality ASC";
$nationality_result = $db->query($nationality_query);
$available_nationalities = [];
while ($row = $nationality_result->fetch_assoc()) {
    $available_nationalities[$row['nationality']] = $row['book_count'];
}

// مرتب‌سازی نویسندگان
usort($authors, function($a, $b) use ($sort) {
    // اولویت با نویسندگانی که کتاب دارند
    if ($a['book_count'] > 0 && $b['book_count'] == 0) return -1;
    if ($a['book_count'] == 0 && $b['book_count'] > 0) return 1;
    
    switch ($sort) {
        case 'name_desc':
            return strcmp($b['name'], $a['name']);
        case 'books_desc':
            $result = $b['book_count'] - $a['book_count'];
            return $result !== 0 ? $result : strcmp($a['name'], $b['name']);
        case 'books_asc':
            $result = $a['book_count'] - $b['book_count'];
            return $result !== 0 ? $result : strcmp($a['name'], $b['name']);
        case 'newest':
            return 0; // نیاز به پیاده‌سازی
        case 'oldest':
            return 0; // نیاز به پیاده‌سازی
        case 'name_asc':
        default:
            return strcmp($a['name'], $b['name']);
    }
});

// تعداد کل نویسندگان فعال (دارای کتاب)
$active_authors_count = 0;
foreach ($authors as $author) {
    if ($author['book_count'] > 0) {
        $active_authors_count++;
    }
}

// ایجاد عنوان صفحه برای SEO
$seo_title = getTranslation('authors_list', 'page_title');
if (!empty($search)) {
    $seo_title = "$search - " . $seo_title;
} elseif (!empty($nationality)) {
    $seo_title = translateCountry($nationality) . " - " . $seo_title;
}
if ($page > 1) {
    $page_text = getTranslation('authors_list', 'page');
    $seo_title .= " - $page_text " . ($language_id == 1 ? persianizeNumbers($page) : $page);
}

// دریافت نام مجتمع از config
$complex_name_query = "SELECT config_value FROM core_config WHERE config_key = 'complex_name_$lang_code' LIMIT 1";
$complex_name_result = $db->query($complex_name_query);
$complex_name = getComplexName($language_id);
$seo_title .= " | $complex_name";

// ایجاد Canonical URL
$canonical_params = [];
if (!empty($search)) $canonical_params['search'] = $search;
if (!empty($nationality)) $canonical_params['nationality'] = $nationality;
if ($sort !== 'name_asc') $canonical_params['sort'] = $sort;
if ($page > 1) $canonical_params['page'] = $page;
$canonical_url = 'https://salman.ac.ir/library_authors.php' . (!empty($canonical_params) ? '?' . http_build_query($canonical_params) : '');

// Meta description پویا
if (!empty($search)) {
    $search_text = getTranslation('authors_list', 'search_filter');
    $pageDescription = "$search_text «{$search}» - $pageDescription";
} elseif (!empty($nationality)) {
    $country_text = getTranslation('authors_list', 'country_filter');
    $pageDescription = "$country_text " . translateCountry($nationality) . " - $pageDescription";
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
    <meta name="keywords" content="<?php echo getTranslation('authors_list', 'author'); ?>, <?php echo getTranslation('authors_list', 'role_translator'); ?>, <?php echo getTranslation('authors_list', 'library'); ?>, <?php echo !empty($nationality) ? htmlspecialchars(translateCountry($nationality)) . ', ' : ''; ?><?php echo $complex_name; ?>">
    <meta name="author" content="<?php echo $complex_name; ?>">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:image" content="https://salman.ac.ir/assets/images/library/authors-og.jpg">
    <meta property="og:locale" content="<?php echo $locale; ?>">
    <meta property="og:site_name" content="<?php echo $complex_name; ?>">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="twitter:image" content="https://salman.ac.ir/assets/images/library/authors-twitter.jpg">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "<?php echo htmlspecialchars($seo_title); ?>",
        "description": "<?php echo htmlspecialchars($pageDescription); ?>",
        "url": "<?php echo $canonical_url; ?>",
        "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
                <?php 
                $schema_items = [];
                foreach (array_slice($authors, 0, 10) as $index => $author) {
                    if ($author['book_count'] > 0) {
                        $schema_items[] = '{
                            "@type": "ListItem",
                            "position": ' . ($index + 1) . ',
                            "item": {
                                "@type": "Person",
                                "name": "' . htmlspecialchars($author['name']) . '",
                                "url": "https://salman.ac.ir/library_author_detail.php?id=' . $author['author_id'] . '",
                                "nationality": "' . htmlspecialchars($author['nationality'] ?? '') . '"
                            }
                        }';
                    }
                }
                echo implode(',', $schema_items);
                ?>
            ]
        },
        "isPartOf": {
            "@type": "WebSite",
            "name": "<?php echo $complex_name; ?>",
            "url": "https://salman.ac.ir/library.php"
        },
        "breadcrumb": {
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
                        "@id": "<?php echo $canonical_url; ?>",
                        "name": "<?php echo getTranslation('authors_list', 'authors'); ?>"
                    }
                }
            ]
        },
        "numberOfItems": <?php echo $active_authors_count; ?>
    }
    </script>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
    
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/pages.css.php'; ?>

    
</head>
<body>
        <!-- Header & Navigation -->
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
                            line-height: 1.1;" >  <?php echo getTranslation('authors_list', 'page_title'); ?>
                            </h1>
                    <p class="header-subtitle">
                          <?php echo getTranslation('authors_list', 'total_authors_count'); ?>: 
                    <strong><?php echo $language_id == 1 ? persianizeNumbers($pagination['total_count']) : $pagination['total_count']; ?></strong>
                
                    </p>
                </div>
            </div>
        </header>
    <!-- Main Content -->
    <main id="main-content">
        <!-- Filters Section -->
        <section class="filters-section-modern" aria-label="<?php echo getTranslation('authors_list', 'filters'); ?>">
            <div class="container">
                <div class="filters-modern-grid">
                    <!-- Search & Sort Card -->
                    <div class="filters-search-card">
                        <form action="library_authors.php" method="get" role="search" class="search-form-modern glass-card">
                            <?php if (!empty($nationality)): ?>
                            <input type="hidden" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>">
                            <?php endif; ?>
                            <div class="filters-modern-row">
                                <!-- Search -->
                                <div class="filters-form-group search-group">
                                    <label for="search-input" class="form-label-modern">
                                        <i class="fas fa-search"></i>
                                        <?php echo getTranslation('authors_list', 'search_author'); ?>
                                    </label>
                                    <input type="text"
                                        id="search-input"
                                        class="modern-input"
                                        name="search"
                                        placeholder="<?php echo getTranslation('authors_list', 'search_placeholder'); ?>"
                                        value="<?php echo htmlspecialchars($search); ?>"
                                        autocomplete="off"
                                        aria-describedby="search-help">
                                    <small id="search-help" class="input-help">
                                        <?php echo getTranslation('authors_list', 'search_help'); ?>
                                    </small>
                                </div>
                                <!-- Sort -->
                                <div class="filters-form-group sort-group">
                                    <label for="sort-select" class="form-label-modern">
                                        <i class="fas fa-sort"></i>
                                        <?php echo getTranslation('authors_list', 'sort_by'); ?>
                                    </label>
                                    <select id="sort-select"
                                        name="sort"
                                        class="modern-input"
                                        onchange="this.form.submit()">
                                        <option value="name_asc" <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>>
                                            <?php echo getTranslation('authors_list', 'sort_name_asc'); ?>
                                        </option>
                                        <option value="name_desc" <?php echo $sort === 'name_desc' ? 'selected' : ''; ?>>
                                            <?php echo getTranslation('authors_list', 'sort_name_desc'); ?>
                                        </option>
                                        <option value="books_desc" <?php echo $sort === 'books_desc' ? 'selected' : ''; ?>>
                                            <?php echo getTranslation('authors_list', 'sort_books_desc'); ?>
                                        </option>
                                        <option value="books_asc" <?php echo $sort === 'books_asc' ? 'selected' : ''; ?>>
                                            <?php echo getTranslation('authors_list', 'sort_books_asc'); ?>
                                        </option>
                                    </select>
                                </div>
                                <!-- Submit -->
                                <div class="filters-form-group submit-group">
                                    <button type="submit" class="btn-modern btn-primary-glass">
                                        <i class="fas fa-search"></i>
                                        <?php echo getTranslation('authors_list', 'search_button'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Nationality Filter Card -->
                    <div class="filters-nationality-card glass-card">
                        <h2 class="filter-title-modern">
                            <i class="fas fa-globe"></i>
                            <?php echo getTranslation('authors_list', 'filter_country'); ?>
                        </h2>
                        <div class="nationality-filter-modern">
                            <a href="library_authors.php?<?php echo http_build_query(array_merge($_GET, ['nationality' => '', 'page' => ''])); ?>"
                            class="nationality-modern-item <?php echo empty($nationality) ? 'active' : ''; ?>"
                            aria-current="<?php echo empty($nationality) ? 'true' : 'false'; ?>">
                                <span class="nationality-name"><?php echo getTranslation('authors_list', 'all_countries'); ?></span>
                                <span class="nationality-count"><?php echo $language_id == 1 ? persianizeNumbers($active_authors_count) : $active_authors_count; ?></span>
                            </a>
                            <?php
                            $top_nationalities = array_slice($available_nationalities, 0, 5, true);
                            foreach ($top_nationalities as $nat => $count):
                            ?>
                            <a href="library_authors.php?<?php echo http_build_query(array_merge($_GET, ['nationality' => $nat, 'page' => ''])); ?>"
                            class="nationality-modern-item <?php echo $nationality === $nat ? 'active' : ''; ?>"
                            aria-current="<?php echo $nationality === $nat ? 'true' : 'false'; ?>">
                                <span class="nationality-name"><?php echo htmlspecialchars(translateCountry($nat)); ?></span>
                                <span class="nationality-count"><?php echo $language_id == 1 ? persianizeNumbers($count) : $count; ?></span>
                            </a>
                            <?php endforeach; ?>
                            <?php if (count($available_nationalities) > 5): ?>
                            <details class="nationality-more-modern">
                                <summary class="nationality-more-toggle-modern">
                                    <?php echo getTranslation('authors_list', 'show_more'); ?>
                                    <i class="fas fa-chevron-down"></i>
                                </summary>
                                <div class="nationality-more-content-modern">
                                    <?php
                                    $other_nationalities = array_slice($available_nationalities, 5, null, true);
                                    foreach ($other_nationalities as $nat => $count):
                                    ?>
                                    <a href="library_authors.php?<?php echo http_build_query(array_merge($_GET, ['nationality' => $nat, 'page' => ''])); ?>"
                                    class="nationality-modern-item <?php echo $nationality === $nat ? 'active' : ''; ?>"
                                    aria-current="<?php echo $nationality === $nat ? 'true' : 'false'; ?>">
                                        <span class="nationality-name"><?php echo htmlspecialchars(translateCountry($nat)); ?></span>
                                        <span class="nationality-count"><?php echo $language_id == 1 ? persianizeNumbers($count) : $count; ?></span>
                                    </a>
                                    <?php endforeach; ?>
                                </div>
                            </details>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                <?php if (!empty($search) || !empty($nationality) || $sort !== 'name_asc'): ?>
                <div class="active-filters-modern glass-card">
                    <div class="active-filters__summary-modern">
                        <span><?php echo getTranslation('authors_list', 'active_filters'); ?></span>
                        <?php if (!empty($search)): ?>
                        <span class="filter-tag-modern">
                            <?php echo getTranslation('authors_list', 'search_filter'); ?> <?php echo htmlspecialchars($search); ?>
                            <a href="library_authors.php?<?php echo http_build_query(array_merge($_GET, ['search' => '', 'page' => ''])); ?>"
                            class="filter-tag__remove-modern"
                            aria-label="<?php echo getTranslation('authors_list', 'remove_filter'); ?>">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                        <?php endif; ?>
                        <?php if (!empty($nationality)): ?>
                        <span class="filter-tag-modern">
                            <?php echo getTranslation('authors_list', 'country_filter'); ?> <?php echo htmlspecialchars(translateCountry($nationality)); ?>
                            <a href="library_authors.php?<?php echo http_build_query(array_merge($_GET, ['nationality' => '', 'page' => ''])); ?>"
                            class="filter-tag__remove-modern"
                            aria-label="<?php echo getTranslation('authors_list', 'remove_filter'); ?>">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                        <?php endif; ?>
                        <?php if ($sort !== 'name_asc'): ?>
                        <span class="filter-tag-modern">
                            <?php echo getTranslation('authors_list', 'sort_by'); ?>: <?php
                                $sort_labels = [
                                    'name_desc' => getTranslation('authors_list', 'sort_name_desc'),
                                    'books_desc' => getTranslation('authors_list', 'sort_books_desc'),
                                    'books_asc' => getTranslation('authors_list', 'sort_books_asc')
                                ];
                                echo $sort_labels[$sort] ?? $sort;
                            ?>
                            <a href="library_authors.php?<?php echo http_build_query(array_merge($_GET, ['sort' => '', 'page' => ''])); ?>"
                            class="filter-tag__remove-modern"
                            aria-label="<?php echo getTranslation('authors_list', 'remove_filter'); ?>">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                        <?php endif; ?>
                    </div>
                    <a href="library_authors.php" class="btn-modern btn-outline-glass">
                        <i class="fas fa-redo"></i>
                        <span><?php echo getTranslation('authors_list', 'clear_all_filters'); ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Authors Grid -->
        <section class="authors-section-modern" aria-label="<?php echo getTranslation('authors_list', 'authors_list'); ?>">
            <div class="container">
                <?php if (count($authors) > 0): ?>
                <div class="results-summary-modern" role="status">
                    <h2>
                        <span class="results-count-modern">
                            <strong><?php echo $language_id == 1 ? persianizeNumbers($pagination['total_count']) : $pagination['total_count']; ?></strong>
                            <?php echo getTranslation('authors_list', 'author'); ?>
                        </span>
                        <?php if ($pagination['total_pages'] > 1): ?>
                        <span class="page-info-modern">
                            (<?php echo getTranslation('authors_list', 'page'); ?> <?php echo $language_id == 1 ? persianizeNumbers($page) : $page; ?> <?php echo getTranslation('authors_list', 'of'); ?> <?php echo $language_id == 1 ? persianizeNumbers($pagination['total_pages']) : $pagination['total_pages']; ?>)
                        </span>
                        <?php endif; ?>
                    </h2>
                </div>
                <div class="authors-grid-modern">
                    <?php foreach ($authors as $index => $author):
                    $author['featured'] = $author['featured'] ?? 0;
                    ?>
                    <article class="author-card-modern glass-card <?php echo $author['book_count'] == 0 ? 'no-books' : ''; ?>"
                            itemscope itemtype="https://schema.org/Person">
                        <a href="library_author_detail.php?id=<?php echo $author['author_id']; ?>"
                        class="author-card__link-modern"
                        itemprop="url">
                            <!-- Author Image -->
                            <div class="author-card__image-modern">
                                <?php if (!empty($author['image']) && file_exists('assets/images/library/Pictures_authors/' . $author['image'])): ?>
                                <img src="assets/images/library/Pictures_authors/<?php echo htmlspecialchars($author['image']); ?>"
                                    alt="<?php echo htmlspecialchars($author['name']); ?>"
                                    loading="lazy"
                                    width="150"
                                    height="150"
                                    itemprop="image">
                                <?php else: ?>
                                <div class="author-placeholder-modern" role="img" aria-label="<?php echo getTranslation('authors_list', 'default_image'); ?>">
                                    <i class="fas fa-user"></i>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($author['featured']) && $author['featured'] == 1): ?>
                                <span class="author-badge-modern featured" title="<?php echo getTranslation('authors_list', 'featured_author'); ?>">
                                    <i class="fas fa-star"></i>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- Author Info -->
                            <div class="author-card__content-modern">
                                <h3 class="author-card__name-modern" itemprop="name">
                                    <?php echo htmlspecialchars($author['name']); ?>
                                </h3>
                                <?php if (!empty($author['nationality'])): ?>
                                <p class="author-card__nationality-modern">
                                    <i class="fas fa-globe"></i>
                                    <span itemprop="nationality"><?php echo htmlspecialchars(translateCountry($author['nationality'])); ?></span>
                                </p>
                                <?php endif; ?>
                                <p class="author-card__books-modern">
                                    <?php if ($author['book_count'] > 0): ?>
                                    <i class="fas fa-book"></i>
                                    <span class="book-count-modern"><?php echo $language_id == 1 ? persianizeNumbers($author['book_count']) : $author['book_count']; ?> <?php echo getTranslation('authors_list', 'book'); ?></span>
                                    <?php else: ?>
                                    <span class="no-books-label-modern">
                                        <i class="fas fa-hourglass-half"></i>
                                        <?php echo getTranslation('authors_list', 'in_preparation'); ?>
                                    </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <span class="author-card__cta-modern">
                                <?php echo getTranslation('authors_list', 'view_profile'); ?>
                                <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            </span>
                        </a>
                    </article>
                    <?php endforeach; ?>
                </div>
                <!-- Pagination -->
                <?php if ($pagination['total_pages'] > 1): ?>
                <nav class="pagination-modern-wrapper" aria-label="<?php echo getTranslation('authors_list', 'pagination'); ?>">
                    <!-- Use your original pagination code here, but add pagination-modern classes for styling -->
                    <!-- ... -->
                </nav>
                <?php endif; ?>
                <?php else: ?>
                <div class="no-results-modern">
                    <div class="glass-card no-results__card-modern">
                        <div class="no-results__icon-modern">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <h2 class="no-results__title-modern"><?php echo getTranslation('authors_list', 'no_author_found'); ?></h2>
                        <p class="no-results__text-modern">
                            <?php if (!empty($search)): ?>
                            <?php echo getTranslation('authors_list', 'no_results_for_search'); ?> «<strong><?php echo htmlspecialchars($search); ?></strong>» <?php echo getTranslation('authors_list', 'not_found'); ?>.
                            <?php elseif (!empty($nationality)): ?>
                            <?php echo getTranslation('authors_list', 'no_results_for_country'); ?> «<strong><?php echo htmlspecialchars(translateCountry($nationality)); ?></strong>» <?php echo getTranslation('authors_list', 'not_available'); ?>
                            <?php else: ?>
                            <?php echo getTranslation('authors_list', 'no_results_general'); ?>
                            <?php endif; ?>
                        </p>
                        <?php if (!empty($search)): ?>
                        <div class="no-results__suggestions-modern">
                            <h3><?php echo getTranslation('authors_list', 'suggestions'); ?></h3>
                            <ul>
                                <li><?php echo getTranslation('authors_list', 'check_spelling'); ?></li>
                                <li><?php echo getTranslation('authors_list', 'use_different_keywords'); ?></li>
                                <li><?php echo getTranslation('authors_list', 'shorten_search'); ?></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <div class="no-results__actions-modern">
                            <a href="library_authors.php" class="btn-modern btn-primary-glass">
                                <i class="fas fa-users"></i>
                                <span><?php echo getTranslation('authors_list', 'view_all_authors'); ?></span>
                            </a>
                            <a href="library_books.php" class="btn-modern btn-outline-glass">
                                <i class="fas fa-book"></i>
                                <span><?php echo getTranslation('authors_list', 'search_books'); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <?php include_once 'includes/footer.php'; ?>
    
    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- Page Specific Scripts -->
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
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize animations
                if (typeof WOW !== 'undefined') {
                    new WOW().init();
                }
                
                // Enhanced search functionality with debounce
                const searchInput = document.getElementById('search-input');
                if (searchInput) {
                    let searchTimeout;
                    
                    // Focus on search input if empty
                    if (!searchInput.value && !window.location.search.includes('nationality=')) {
                        searchInput.focus();
                    }
                    
                    // Auto-submit on Enter key
                    searchInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.form.submit();
                        }
                    });
                }
                
                // Smooth scroll to results after filter/pagination
                if (window.location.search) {
                    const resultsSection = document.querySelector('.authors-section');
                    if (resultsSection && (window.location.search.includes('page=') || window.location.search.includes('search='))) {
                        setTimeout(() => {
                            const offset = 100;
                            const targetPosition = resultsSection.getBoundingClientRect().top + window.scrollY - offset;
                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        }, 100);
                    }
                }
                
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
                
                // Keyboard navigation for filters
                const filterLinks = document.querySelectorAll('.nationality-item, .filter-tag__remove');
                filterLinks.forEach(link => {
                    link.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            this.click();
                        }
                    });
                });
                
                // Analytics tracking
                if (typeof gtag !== 'undefined') {
                    // Track filter usage
                    document.querySelectorAll('.nationality-item').forEach(item => {
                        item.addEventListener('click', function() {
                            gtag('event', 'filter_nationality', {
                                'event_category': 'library',
                                'event_label': this.querySelector('.nationality-name').textContent
                            });
                        });
                    });
                    
                    // Track search
                    const searchForm = document.querySelector('.search-form');
                    if (searchForm) {
                        searchForm.addEventListener('submit', function() {
                            const searchValue = this.querySelector('[name="search"]').value;
                            if (searchValue) {
                                gtag('event', 'search', {
                                    'event_category': 'library',
                                    'search_term': searchValue
                                });
                            }
                        });
                    }
                }
            });
    </script>
</body>
</html>