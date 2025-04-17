<?php
/**
 * صفحه وبلاگ و اخبار (نسخه ماژولار)
 * 
 * نمایش پست‌های وبلاگ با قابلیت جستجو، فیلتر دسته‌بندی و پیجینیشن
 * محتوای ثابت از دیتابیس خوانده می‌شود برای مدیریت آسان‌تر
 * ویجت‌ها قابل فعال/غیرفعال کردن و تغییر ترتیب هستند
 * 
 * @package Salman Educational Complex
 * @version 3.0
 * @updated 2025-03-30
 */

// لود کردن فایل کانفیگ
require_once 'includes/config.php';
// لود کردن توابع کمکی وبلاگ
require_once 'includes/blog_helpers.php';

// دریافت زبان فعلی
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa' || $lang == 'ar');

// دریافت شماره صفحه
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) $page = 1;

// دریافت شناسه دسته‌بندی (اگر تنظیم شده باشد)
$categoryId = isset($_GET['category']) ? intval($_GET['category']) : null;

// دریافت عبارت جستجو (اگر تنظیم شده باشد)
$search = isset($_GET['search']) ? clean($_GET['search']) : null;

// اتصال به دیتابیس
$conn = connectDB();

// تعداد پست‌ها در هر صفحه
$postsPerPage = 6;
$offset = ($page - 1) * $postsPerPage;

// ساخت کوئری SQL منطبق با ساختار جدید دیتابیس
$sql = "SELECT p.post_id, p.category_id, p.published_at, p.views, 
               pt.title, pt.content, pt.excerpt,
               c.category_id, ct.name as category_name, m.file_path as image_path
        FROM posts p
        INNER JOIN post_translations pt ON p.post_id = pt.post_id AND pt.language_id = (
            SELECT language_id FROM languages WHERE code = ?
        )
        LEFT JOIN categories c ON p.category_id = c.category_id
        LEFT JOIN category_translations ct ON c.category_id = ct.category_id AND ct.language_id = (
            SELECT language_id FROM languages WHERE code = ?
        )
        LEFT JOIN media m ON p.main_media_id = m.media_id
        WHERE p.status = 'published'";

$bindParams = [$lang, $lang];
$bindTypes = "ss";

// اضافه کردن فیلتر دسته‌بندی
if ($categoryId) {
    $sql .= " AND p.category_id = ?";
    $bindParams[] = $categoryId;
    $bindTypes .= "i";
}

// اضافه کردن فیلتر جستجو
if ($search) {
    $sql .= " AND (pt.title LIKE ? OR pt.content LIKE ? OR pt.excerpt LIKE ?)";
    $searchParam = "%$search%";
    $bindParams[] = $searchParam;
    $bindParams[] = $searchParam;
    $bindParams[] = $searchParam;
    $bindTypes .= "sss";
}

// مرتب‌سازی و محدود کردن نتایج
$sql .= " ORDER BY p.published_at DESC LIMIT ?, ?";
$bindParams[] = $offset;
$bindParams[] = $postsPerPage;
$bindTypes .= "ii";

// آماده‌سازی و اجرای کوئری با استفاده از prepared statements
$stmt = $conn->prepare($sql);
if ($stmt) {
    // Dynamically bind parameters
    if (!empty($bindParams)) {
        $stmt->bind_param($bindTypes, ...$bindParams);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $posts = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // تبدیل آدرس تصویر به مسیر کامل
            if (!empty($row['image_path'])) {
                if (strpos($row['image_path'], 'http') !== 0) {
                    // اگر آدرس نسبی است، مسیر کامل را بسازیم
                    $row['main_image'] = basename($row['image_path']);
                } else {
                    // اگر آدرس کامل است، آن را استفاده کنیم
                    $row['main_image'] = $row['image_path'];
                }
            } else {
                // اگر تصویری وجود ندارد، تصویر پیش‌فرض استفاده کنیم
                $row['main_image'] = 'default-post.jpg';
            }
            
            // برای سازگاری با کد قبلی، فیلدهای معادل را اضافه می‌کنیم
            $row['id'] = $row['post_id'];
            
            $posts[] = $row;
        }
    }
    $stmt->close();
}

// محاسبه‌ی تعداد کل پست‌ها برای صفحه‌بندی
$count_sql = "SELECT COUNT(*) as total 
              FROM posts p
              INNER JOIN post_translations pt ON p.post_id = pt.post_id AND pt.language_id = (
                  SELECT language_id FROM languages WHERE code = ?
              )
              WHERE p.status = 'published'";

$count_params = [$lang];
$count_types = "s";

if ($categoryId) {
    $count_sql .= " AND p.category_id = ?";
    $count_params[] = $categoryId;
    $count_types .= "i";
}

if ($search) {
    $count_sql .= " AND (pt.title LIKE ? OR pt.content LIKE ? OR pt.excerpt LIKE ?)";
    $searchParam = "%$search%";
    $count_params[] = $searchParam;
    $count_params[] = $searchParam;
    $count_params[] = $searchParam;
    $count_types .= "sss";
}

$count_stmt = $conn->prepare($count_sql);
$total_posts = 0;
$total_pages = 0;

if ($count_stmt) {
    // Dynamically bind parameters
    if (!empty($count_params)) {
        $count_stmt->bind_param($count_types, ...$count_params);
    }
    
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    
    if ($count_result && $count_row = $count_result->fetch_assoc()) {
        $total_posts = $count_row['total'];
        $total_pages = ceil($total_posts / $postsPerPage);
    }
    $count_stmt->close();
}

// گرفتن دسته‌بندی‌ها
$categories_sql = "SELECT c.category_id, ct.name, COUNT(p.post_id) as post_count 
                   FROM categories c
                   LEFT JOIN category_translations ct ON c.category_id = ct.category_id AND ct.language_id = (
                       SELECT language_id FROM languages WHERE code = ?
                   )
                   LEFT JOIN posts p ON c.category_id = p.category_id AND p.status = 'published'
                   GROUP BY c.category_id, ct.name
                   HAVING post_count > 0
                   ORDER BY ct.name";

$categories_stmt = $conn->prepare($categories_sql);
$categories = [];

if ($categories_stmt) {
    $categories_stmt->bind_param("s", $lang);
    $categories_stmt->execute();
    $categories_result = $categories_stmt->get_result();
    
    if ($categories_result->num_rows > 0) {
        while ($row = $categories_result->fetch_assoc()) {
            // برای سازگاری با کد قبلی، فیلد معادل را اضافه می‌کنیم
            $row['category_name'] = $row['name'];
            $row['category_name_en'] = $row['name']; // در این نسخه، ما از جدول ترجمه‌ها استفاده می‌کنیم
            
            $categories[] = $row;
        }
    }
    $categories_stmt->close();
}

// گرفتن پست‌های محبوب
$popular_sql = "SELECT p.post_id, p.views, pt.title, pt.content,
                       m.file_path as image_path, c.category_id, ct.name as category_name
                FROM posts p
                INNER JOIN post_translations pt ON p.post_id = pt.post_id AND pt.language_id = (
                    SELECT language_id FROM languages WHERE code = ?
                )
                LEFT JOIN categories c ON p.category_id = c.category_id
                LEFT JOIN category_translations ct ON c.category_id = ct.category_id AND ct.language_id = (
                    SELECT language_id FROM languages WHERE code = ?
                )
                LEFT JOIN media m ON p.main_media_id = m.media_id
                WHERE p.status = 'published'
                ORDER BY p.views DESC
                LIMIT 3";

$popular_stmt = $conn->prepare($popular_sql);
$popular_posts = [];

if ($popular_stmt) {
    $popular_stmt->bind_param("ss", $lang, $lang);
    $popular_stmt->execute();
    $popular_result = $popular_stmt->get_result();
    
    if ($popular_result->num_rows > 0) {
        while ($row = $popular_result->fetch_assoc()) {
            // تبدیل آدرس تصویر به مسیر کامل
            if (!empty($row['image_path'])) {
                if (strpos($row['image_path'], 'http') !== 0) {
                    $row['main_image'] = basename($row['image_path']);
                } else {
                    $row['main_image'] = $row['image_path'];
                }
            } else {
                $row['main_image'] = 'default-post.jpg';
            }
            
            // برای سازگاری با کد قبلی، فیلدهای معادل را اضافه می‌کنیم
            $row['id'] = $row['post_id'];
            $row['category_name_en'] = $row['category_name']; // در این نسخه، ما از جدول ترجمه‌ها استفاده می‌کنیم
            
            $popular_posts[] = $row;
        }
    }
    $popular_stmt->close();
}

// گرفتن آخرین پست‌ها
$latest_sql = "SELECT p.post_id, p.published_at, pt.title,
                      m.file_path as image_path
               FROM posts p
               INNER JOIN post_translations pt ON p.post_id = pt.post_id AND pt.language_id = (
                   SELECT language_id FROM languages WHERE code = ?
               )
               LEFT JOIN media m ON p.main_media_id = m.media_id
               WHERE p.status = 'published'
               ORDER BY p.published_at DESC
               LIMIT 3";

$latest_stmt = $conn->prepare($latest_sql);
$latest_posts = [];

if ($latest_stmt) {
    $latest_stmt->bind_param("s", $lang);
    $latest_stmt->execute();
    $latest_result = $latest_stmt->get_result();
    
    if ($latest_result->num_rows > 0) {
        while ($row = $latest_result->fetch_assoc()) {
            // تبدیل آدرس تصویر به مسیر کامل
            if (!empty($row['image_path'])) {
                if (strpos($row['image_path'], 'http') !== 0) {
                    $row['main_image'] = basename($row['image_path']);
                } else {
                    $row['main_image'] = $row['image_path'];
                }
            } else {
                $row['main_image'] = 'default-post.jpg';
            }
            
            // برای سازگاری با کد قبلی، فیلدهای معادل را اضافه می‌کنیم
            $row['id'] = $row['post_id'];
            
            $latest_posts[] = $row;
        }
    }
    $latest_stmt->close();
}


// تعیین عنوان صفحه - از دیتابیس خوانده می‌شود
$pageTitle = getBlogContent('header_title', $lang);

if ($search) {
    $pageTitle = getBlogContent('search_results', $lang) . ': ' . htmlspecialchars($search);
} elseif ($categoryId) {
    foreach ($categories as $category) {
        if ($category['category_id'] == $categoryId) {
            $pageTitle = getBlogContent('category_posts', $lang) . ': ' . htmlspecialchars($category['name']);
            break;
        }
    }
}

// آماده‌سازی داده‌ها برای ویجت‌ها
$sidebar_data = [
    'categoryId' => $categoryId,
    'latest_posts' => $latest_posts,
    'popular_posts' => $popular_posts,
    'categories' => $categories
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageTitle; ?> - <?php echo SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    
    <!-- Custom Styles for Blog Page -->
    <?php include_once 'assets/css/pages/blog.css.php'; ?>   
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <section class="terms-header">
            <div class="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <!-- Random stars created with CSS -->
            </div>
            
            <div class="container">
            <div class="blog-header__content wow fadeIn" data-wow-delay="100ms">
            <h1 class="blog-header__title">
                <?php echo $pageTitle; ?>
            </h1>
            <?php if ($search || $categoryId): ?>
            <p class="blog-header__subtitle">
                <?php if ($search): ?>
                    <?php echo getBlogContent('search_results', $lang); ?>: "<?php echo htmlspecialchars($search); ?>"
                <?php elseif ($categoryId): ?>
                    <?php echo getBlogContent('category_posts', $lang); ?>: 
                    <?php 
                    foreach ($categories as $category) {
                        if ($category['category_id'] == $categoryId) {
                            echo htmlspecialchars($category['name']);
                            break;
                        }
                    }
                    ?>
                <?php endif; ?>
            </p>
            <?php else: ?>
                <p class="blog-header__subtitle">
                <?php echo getBlogContent('header_subtitle', $lang); ?>
            </p>
            <?php endif; ?>
          </div>

            </div>
        </section>

        <!-- Blog Main Content -->
        <section class="blog-section">
            <div class="container">
                <div class="row">
                    <!-- Main Content Column -->
                    <div class="col-lg-8">
                        <?php if (count($posts) > 0): ?>
                            <!-- Featured Blog Post (first post) -->
                            <div class="featured-post wow fadeInUp" data-wow-delay="300ms">
                                <div class="featured-post__image">
                                    <img src="assets/images/blog/<?php echo $posts[0]['main_image']; ?>" alt="<?php echo htmlspecialchars($posts[0]['title']); ?>">
                                    <a href="post.php?id=<?php echo $posts[0]['post_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>" class="featured-post__link"></a>
                                    <div class="featured-post__date">
                                        <?php if ($lang == 'en'): ?>
                                            <span><?php echo date('d', strtotime($posts[0]['published_at'])); ?></span>
                                            <?php echo date('M', strtotime($posts[0]['published_at'])); ?>
                                        <?php else: ?>
                                            <?php 
                                            $jalali_date = gregorianToJalali($posts[0]['published_at']);
                                            $jalali_parts = explode(' ', $jalali_date);
                                            ?>
                                            <span><?php echo $jalali_parts[0]; ?></span>
                                            <?php echo $jalali_parts[1]; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="featured-post__content">
                                    <div class="featured-post__category">
                                        <a href="blog.php?category=<?php echo $posts[0]['category_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>">
                                            <?php echo htmlspecialchars($posts[0]['category_name']); ?>
                                        </a>
                                    </div>
                                    
                                    <h3 class="featured-post__title">
                                        <a href="post.php?id=<?php echo $posts[0]['post_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>">
                                            <?php echo htmlspecialchars($posts[0]['title']); ?>
                                        </a>
                                    </h3>
                                    
                                    <p class="featured-post__text">
                                        <?php 
                                        if (!empty($posts[0]['excerpt'])) {
                                            echo htmlspecialchars($posts[0]['excerpt']);
                                        } else {
                                            echo truncateText(strip_tags($posts[0]['content']), 200);
                                        }
                                        ?>
                                    </p>
                                    
                                    <a href="post.php?id=<?php echo $posts[0]['post_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>" class="featured-post__more">
                                        <?php echo getBlogContent('read_more_text', $lang); ?>
                                        <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Blog Posts Grid -->
                            <div class="blog-grid wow fadeInUp" data-wow-delay="400ms">
                                <div class="row">
                                    <?php for ($i = 1; $i < count($posts); $i++): ?>
                                        <div class="col-md-6">
                                            <div class="blog-card">
                                            <div class="blog-card__image">
                                                <a href="post.php?id=<?php echo $posts[$i]['post_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>">
                                                    <img src="assets/images/blog/<?php echo $posts[$i]['main_image']; ?>" alt="<?php echo htmlspecialchars($posts[$i]['title']); ?>">
                                                    <img src="assets/images/blog/<?php echo $posts[$i]['main_image']; ?>" alt="<?php echo htmlspecialchars($posts[$i]['title']); ?>">
                                                </a>
                                                <div class="blog-card__date">
                                                    <?php 
                                                    if ($lang == 'en') {
                                                        echo date('d M', strtotime($posts[$i]['published_at']));
                                                    } else {
                                                        $jalali_date = gregorianToJalali($posts[$i]['published_at']);
                                                        $jalali_parts = explode(' ', $jalali_date);
                                                        echo $jalali_parts[0] . ' ' . $jalali_parts[1];
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                                
                                                <div class="blog-card__content">
                                                    <div class="blog-card__category">
                                                        <a href="blog.php?category=<?php echo $posts[$i]['category_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>">
                                                            <?php echo htmlspecialchars($posts[$i]['category_name']); ?>
                                                        </a>
                                                    </div>
                                                    
                                                    <h4 class="blog-card__title">
                                                        <a href="post.php?id=<?php echo $posts[$i]['post_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>">
                                                            <?php echo htmlspecialchars($posts[$i]['title']); ?>
                                                        </a>
                                                    </h4>
                                                    
                                                    <p class="blog-card__text">
                                                        <?php 
                                                        if (!empty($posts[$i]['excerpt'])) {
                                                            echo htmlspecialchars($posts[$i]['excerpt']); 
                                                        } else {
                                                            echo truncateText(strip_tags($posts[$i]['content']), 100);
                                                        }
                                                        ?>
                                                    </p>
                                                    
                                                    <a href="post.php?id=<?php echo $posts[$i]['post_id']; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>" class="blog-card__more">
                                                        <?php echo getBlogContent('read_more_text', $lang); ?>
                                                        <i class="fas fa-arrow-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            
                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                            <div class="blog-pagination">
                                <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?><?php echo $categoryId ? '&category=' . $categoryId : ''; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>" class="blog-pagination__arrow">
                                    <i class="fas fa-angle-<?php echo $isRtl ? 'right' : 'left'; ?>"></i>
                                </a>
                                <?php endif; ?>
                                
                                <?php 
                                // Calculate range of page numbers to display
                                $start_page = max(1, $page - 2);
                                $end_page = min($total_pages, $page + 2);
                                
                                for ($i = $start_page; $i <= $end_page; $i++): 
                                ?>
                                <a href="?page=<?php echo $i; ?><?php echo $categoryId ? '&category=' . $categoryId : ''; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>" class="blog-pagination__page <?php echo $i == $page ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                                <?php endfor; ?>
                                
                                <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?><?php echo $categoryId ? '&category=' . $categoryId : ''; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?><?php echo $isRtl ? '&lang=' . $lang : ''; ?>" class="blog-pagination__arrow">
                                    <i class="fas fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <div class="no-posts wow fadeInUp" data-wow-delay="300ms">
                                <div class="no-posts__icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h3 class="no-posts__title"><?php echo getBlogContent('no_results_title', $lang); ?></h3>
                                <p class="no-posts__text">
                                    <?php echo $search 
                                        ? getBlogContent('no_results_text', $lang) . ' "' . htmlspecialchars($search) . '"'
                                        : getBlogContent('no_posts_yet', $lang); ?>
                                </p>
                                <a href="blog.php<?php echo $isRtl ? '?lang=' . $lang : ''; ?>" class="no-posts__button">
                                    <?php echo getBlogContent('view_all_button', $lang); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Sidebar Column -->
                    <div class="col-lg-4">
                        <?php renderSidebar($lang, $isRtl, $sidebar_data); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div><!-- /.page-wrapper -->

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- Blog Specific Scripts -->
    <script src="assets/js/blog.js"></script>
    <!-- Cosmic Background JS -->
    <script src="assets/js/cosmic-bg.js"></script>
    
    <?php
    // بستن اتصال دیتابیس در انتهای صفحه
    closeDB($conn);
    ?>
</body>
</html>
<!-- فاصله مناسب بین پست‌ها با اضافه کردن استایل زیر در بخش <head> صفحه بعد از لینک‌های CSS دیگر -->
<style>
    /* افزایش فاصله بین پست‌ها */
    .blog-card {
        margin-bottom: 40px; /* افزایش فاصله عمودی بین پست‌ها */
    }
    
    /* افزایش فاصله بین ردیف‌های پست‌ها */
    .blog-grid .row {
        row-gap: 30px;
    }
    
    /* افزایش فاصله بین پست ویژه (فیچرد) و پست‌های بعدی */
    .featured-post {
        margin-bottom: 60px;
    }
    
    /* اطمینان از اینکه کارت‌های بلاگ ارتفاع یکسانی ندارند و متن‌های بلندتر به خوبی نمایش داده می‌شوند */
    .blog-card__content {
        height: auto;
        min-height: 250px;
        display: flex;
        flex-direction: column;
    }
    
    /* قرار دادن دکمه ادامه مطلب در پایین کارت */
    .blog-card__more {
        margin-top: auto;
    }
</style>
