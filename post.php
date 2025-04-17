<?php
/**
 * صفحه نمایش پست تکی با قابلیت‌های پیشرفته و محتوای ماژولار
 *
 * نمایش پست تکی با طراحی مدرن، پاسخگو و انعطاف‌پذیر
 * با پشتیبانی از نمایش هوشمند تصاویر، ویدیو و صوت
 *
 * @package Salman Educational Complex
 * @version 4.1
 */

// لود کردن فایل کانفیگ
require_once 'includes/config.php';

// دریافت زبان فعلی
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');

// دریافت شناسه پست
$postId = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$postId) {
    header('Location: blog.php' . ($isRtl ? '?lang=fa' : '')); 
    exit;
}

// اتصال به دیتابیس
$conn = connectDB();

// تابع دریافت محتوای ثابت از دیتابیس
function getPostContent($key, $lang, $conn) {
    // اول بررسی می‌کنیم آیا در دیتابیس موجود است
    $sql = "SELECT content FROM post_content 
            WHERE field_key = '$key' 
            AND language_id = '$lang' 
            AND is_visible = 1 
            LIMIT 1";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['content'];
    }
    
    // اگر در دیتابیس نبود، از تابع ترجمه عمومی استفاده می‌کنیم
    return t($key, $lang);
}

// استخراج همه متن‌های ثابت که نیاز داریم (قبل از بستن اتصال)
$staticTexts = [
    'views' => getPostContent('views', $lang, $conn),
    'min_read' => getPostContent('min_read', $lang, $conn),
    'home' => getPostContent('home', $lang, $conn),
    'blog_title' => getPostContent('blog_title', $lang, $conn),
    'categories' => getPostContent('categories', $lang, $conn),
    'share_title' => getPostContent('share_title', $lang, $conn),
    'related_posts_title' => getPostContent('related_posts_title', $lang, $conn),
    'search_here' => getPostContent('search_here', $lang, $conn),
    'search_button' => getPostContent('search_button', $lang, $conn),
    'latest_posts' => getPostContent('latest_posts', $lang, $conn),
    'back_to_blog' => getPostContent('back_to_blog', $lang, $conn)
];

// افزایش تعداد بازدید
$conn->query("UPDATE posts SET views = views + 1 WHERE post_id = $postId");

// دریافت اطلاعات پست
$sql = "SELECT p.post_id, p.category_id, p.published_at, p.views, 
               pt.title, pt.content,
               c.category_id, ct.name as category_name,
               m.file_path as main_image
        FROM posts p
        INNER JOIN post_translations pt ON p.post_id = pt.post_id AND pt.language_id = (
            SELECT language_id FROM languages WHERE code = '$lang'
        )
        LEFT JOIN categories c ON p.category_id = c.category_id
        LEFT JOIN category_translations ct ON c.category_id = ct.category_id AND ct.language_id = (
            SELECT language_id FROM languages WHERE code = '$lang'
        )
        LEFT JOIN media m ON p.main_media_id = m.media_id
        WHERE p.post_id = $postId";

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header('Location: blog.php' . ($isRtl ? '?lang=fa' : '')); 
    exit;
}
$post = $result->fetch_assoc();

// استاندارد کردن مسیر تصویر اصلی
if (!empty($post['main_image'])) {
    // اگر مسیر تصویر نسبی است، آن را به مسیر کامل تبدیل می‌کنیم
    if (strpos($post['main_image'], 'http') !== 0) {
        $post['main_image'] = basename($post['main_image']);
    }
} else {
    // اگر تصویری وجود ندارد، تصویر پیش‌فرض استفاده می‌کنیم
    $post['main_image'] = 'default-post.jpg';
}

// پردازش هوشمند محتوا برای تشخیص و سازماندهی تصاویر، ویدیوها و صوت
function processContent($content) {
    $processedContent = $content;
    
    // تشخیص بلوک‌های تصاویر و تبدیل به اسلایدر در صورت وجود بیش از دو تصویر
    $pattern = '/<div\s+class="post-images">(.*?)<\/div>/s';
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        $imageBlock = $match[0];
        $imageContent = $match[1];
        
        // شمارش تعداد تصاویر
        $imagePattern = '/<img.*?>/s';
        preg_match_all($imagePattern, $imageContent, $imageMatches);
        $imageCount = count($imageMatches[0]);
        
        if ($imageCount > 2) {
            // ساخت اسلایدر برای بیش از دو تصویر
            $sliderHtml = '<div class="post-images-slider swiper-container">
                <div class="swiper-wrapper">';
            
            foreach ($imageMatches[0] as $img) {
                // استخراج src تصویر
                preg_match('/src="([^"]+)"/', $img, $srcMatch);
                $src = isset($srcMatch[1]) ? $srcMatch[1] : '';
                
                // استخراج alt تصویر
                preg_match('/alt="([^"]*)"/', $img, $altMatch);
                $alt = isset($altMatch[1]) ? $altMatch[1] : '';
                
                $sliderHtml .= '<div class="swiper-slide">
                    <a href="'.$src.'" class="post-gallery-link">
                        <img src="'.$src.'" alt="'.$alt.'" class="img-fluid">
                    </a>
                </div>';
            }
            
            $sliderHtml .= '</div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>';
            
            // جایگزینی بلوک تصاویر با اسلایدر
            $processedContent = str_replace($imageBlock, $sliderHtml, $processedContent);
        } 
        else if ($imageCount == 2) {
            // دو تصویر کنار هم در یک ردیف
            $twoImagesHtml = '<div class="post-images-row">
                <div class="row">';
            
            foreach ($imageMatches[0] as $img) {
                // استخراج src تصویر
                preg_match('/src="([^"]+)"/', $img, $srcMatch);
                $src = isset($srcMatch[1]) ? $srcMatch[1] : '';
                
                // استخراج alt تصویر
                preg_match('/alt="([^"]*)"/', $img, $altMatch);
                $alt = isset($altMatch[1]) ? $altMatch[1] : '';
                
                $twoImagesHtml .= '<div class="col-md-6">
                    <div class="post-image-item">
                        <a href="'.$src.'" class="post-gallery-link">
                            <img src="'.$src.'" alt="'.$alt.'" class="img-fluid">
                        </a>
                    </div>
                </div>';
            }
            
            $twoImagesHtml .= '</div>
            </div>';
            
            // جایگزینی بلوک تصاویر با نمایش دو ستونه
            $processedContent = str_replace($imageBlock, $twoImagesHtml, $processedContent);
        }
        else if ($imageCount == 1) {
            // یک تصویر تمام عرض
            $oneImageHtml = '<div class="post-image-full">';
            
            // استخراج src تصویر
            preg_match('/src="([^"]+)"/', $imageMatches[0][0], $srcMatch);
            $src = isset($srcMatch[1]) ? $srcMatch[1] : '';
            
            // استخراج alt تصویر
            preg_match('/alt="([^"]*)"/', $imageMatches[0][0], $altMatch);
            $alt = isset($altMatch[1]) ? $altMatch[1] : '';
            
            $oneImageHtml .= '<a href="'.$src.'" class="post-gallery-link">
                <img src="'.$src.'" alt="'.$alt.'" class="img-fluid">
            </a>
            </div>';
            
            // جایگزینی بلوک تصویر با نمایش تمام عرض
            $processedContent = str_replace($imageBlock, $oneImageHtml, $processedContent);
        }
    }
    
    // بهینه‌سازی ویدیوها با پلیر سفارشی
    $videoPattern = '/<video.*?>(.*?)<\/video>/s';
    preg_match_all($videoPattern, $processedContent, $videoMatches, PREG_SET_ORDER);
    
    foreach ($videoMatches as $match) {
        $videoBlock = $match[0];
        $videoContent = $match[1];
        
        // استخراج src ویدیو
        preg_match('/src="([^"]+)"/', $videoContent, $srcMatch);
        $src = isset($srcMatch[1]) ? $srcMatch[1] : '';
        
        // استخراج poster اگر وجود داشته باشد
        preg_match('/poster="([^"]+)"/', $videoBlock, $posterMatch);
        $poster = isset($posterMatch[1]) ? $posterMatch[1] : '';
        $posterAttr = !empty($poster) ? 'data-poster="'.$poster.'"' : '';
        
        if (!empty($src)) {
            // ایجاد شناسه یکتا برای ویدیو
            $videoId = 'custom-video-' . md5($src . time());
            
            $enhancedVideo = '<div class="post-video-container">
                <div class="custom-player-wrapper">
                    <video id="'.$videoId.'" class="custom-video-player" playsinline controls '.$posterAttr.'>
                        <source src="'.$src.'" type="video/mp4">
                        <p>Your browser does not support HTML5 video.</p>
                    </video>
                </div>
            </div>';
            
            // جایگزینی ویدیو با نسخه سفارشی
            $processedContent = str_replace($videoBlock, $enhancedVideo, $processedContent);
        }
    }
    
    // بهینه‌سازی فایل‌های صوتی با پلیر سفارشی سبک
    $audioPattern = '/<audio.*?>(.*?)<\/audio>/s';
    preg_match_all($audioPattern, $processedContent, $audioMatches, PREG_SET_ORDER);
    
    foreach ($audioMatches as $match) {
        $audioBlock = $match[0];
        $audioContent = $match[1];
        
        // استخراج src صوت
        preg_match('/src="([^"]+)"/', $audioContent, $srcMatch);
        $src = isset($srcMatch[1]) ? $srcMatch[1] : '';
        
        if (!empty($src)) {
            // ایجاد شناسه یکتا برای صوت
            $audioId = 'custom-audio-' . md5($src . time());
            
            // استخراج عنوان فایل از آدرس
            $fileName = basename($src);
            
            $enhancedAudio = '<div class="post-audio-container">
                <div class="lightweight-audio-player" id="'.$audioId.'-container">
                    <div class="audio-player-header">
                        <div class="audio-title">'.$fileName.'</div>
                        <div class="audio-controls">
                            <a href="'.$src.'" class="audio-download-btn" download aria-label="دانلود">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="audio-player-body">
                        <div class="audio-play-controls">
                            <button class="audio-play-button" id="play-'.$audioId.'" aria-label="پخش">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                        <div class="audio-progress-container">
                            <div class="audio-progress-bar-container">
                                <div class="audio-progress-bar" id="progress-'.$audioId.'">
                                    <div class="audio-progress-bar-fill" id="fill-'.$audioId.'"></div>
                                </div>
                                <div class="audio-progress-handle" id="handle-'.$audioId.'"></div>
                            </div>
                            <div class="audio-time-display">
                                <span class="audio-current-time" id="current-'.$audioId.'">00:00</span>
                                <span class="audio-duration" id="duration-'.$audioId.'">00:00</span>
                            </div>
                        </div>
                        <div class="audio-volume-controls">
                            <button class="audio-volume-button" id="volume-'.$audioId.'" aria-label="صدا">
                                <i class="fas fa-volume-up"></i>
                            </button>
                            <div class="audio-volume-slider-container">
                                <input type="range" class="audio-volume-slider" id="volume-slider-'.$audioId.'" min="0" max="100" value="100">
                            </div>
                        </div>
                    </div>
                    <audio id="source-'.$audioId.'" src="'.$src.'" preload="metadata"></audio>
                </div>
            </div>';
            
            // جایگزینی صوت با نسخه سفارشی
            $processedContent = str_replace($audioBlock, $enhancedAudio, $processedContent);
        }
    }
    
    // بهینه‌سازی iframe (برای ویدیوهای YouTube، آپارات و غیره)
    $iframePattern = '/<iframe.*?><\/iframe>/s';
    preg_match_all($iframePattern, $processedContent, $iframeMatches, PREG_SET_ORDER);
    
    foreach ($iframeMatches as $match) {
        $iframeBlock = $match[0];
        
        $enhancedIframe = '<div class="post-embed-container">
            <div class="ratio ratio-16x9">
                '.$iframeBlock.'
            </div>
        </div>';
        
        // جایگزینی iframe با نسخه بهینه
        $processedContent = str_replace($iframeBlock, $enhancedIframe, $processedContent);
    }
    
    return $processedContent;
}

// پردازش محتوا
$processedContent = processContent($post['content']);

// گرفتن دسته‌بندی‌ها
$categories_sql = "SELECT c.category_id, ct.name as category_name, COUNT(p.post_id) as post_count
                   FROM categories c
                   LEFT JOIN category_translations ct ON c.category_id = ct.category_id
                   LEFT JOIN posts p ON c.category_id = p.category_id AND p.status = 'published'
                   WHERE ct.language_id = (SELECT language_id FROM languages WHERE code = '$lang')
                   GROUP BY c.category_id, ct.name
                   HAVING post_count > 0
                   ORDER BY ct.name";
                   
$categories_result = $conn->query($categories_sql);
$categories = [];
if ($categories_result->num_rows > 0) {
    while ($row = $categories_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// گرفتن پست‌های مرتبط (از همان دسته‌بندی)
$related_sql = "SELECT p.post_id, pt.title, m.file_path as main_image, p.published_at
                FROM posts p
                INNER JOIN post_translations pt ON p.post_id = pt.post_id
                LEFT JOIN media m ON p.main_media_id = m.media_id
                WHERE p.category_id = {$post['category_id']} 
                AND p.post_id != $postId 
                AND pt.language_id = (SELECT language_id FROM languages WHERE code = '$lang')
                AND p.status = 'published'
                ORDER BY p.published_at DESC LIMIT 3";
                
$related_result = $conn->query($related_sql);
$related_posts = [];
if ($related_result->num_rows > 0) {
    while ($row = $related_result->fetch_assoc()) {
        // استاندارد کردن مسیر تصویر
        if (!empty($row['main_image'])) {
            $row['main_image'] = basename($row['main_image']);
        } else {
            $row['main_image'] = 'default-post.jpg';
        }
        $related_posts[] = $row;
    }
}

// گرفتن آخرین پست‌ها
$latest_sql = "SELECT p.post_id, pt.title, m.file_path as main_image, p.published_at
               FROM posts p
               INNER JOIN post_translations pt ON p.post_id = pt.post_id
               LEFT JOIN media m ON p.main_media_id = m.media_id
               WHERE p.post_id != $postId 
               AND pt.language_id = (SELECT language_id FROM languages WHERE code = '$lang')
               AND p.status = 'published'
               ORDER BY p.published_at DESC LIMIT 4";
                
$latest_result = $conn->query($latest_sql);
$latest_posts = [];
if ($latest_result->num_rows > 0) {
    while ($row = $latest_result->fetch_assoc()) {
        // استاندارد کردن مسیر تصویر
        if (!empty($row['main_image'])) {
            $row['main_image'] = basename($row['main_image']);
        } else {
            $row['main_image'] = 'default-post.jpg';
        }
        $latest_posts[] = $row;
    }
}

// بستن اتصال دیتابیس
closeDB($conn);

// تعیین عنوان صفحه
$pageTitle = $post['title'];

// تعیین تاریخ پست
$postDate = formatDate($post['published_at'], $lang);

// تعیین زمان خواندن تقریبی پست
$contentLength = strlen(strip_tags($post['content']));
$readingTime = max(1, ceil($contentLength / 2000)); // تقریباً 2000 کاراکتر برای 1 دقیقه خواندن
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo htmlspecialchars(truncateText(strip_tags($post['content']), 150)); ?>" />


    <!-- اضافه کردن تگ‌های متا بیشتر برای SEO در بخش head -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="<?php echo SITE_NAME_EN; ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($post['category_name'] . ', ' . $pageTitle); ?>">
    
    <title><?php echo htmlspecialchars($pageTitle); ?> - <?php echo SITE_NAME_EN; ?></title>
    
    <!-- Open Graph Tags for Social Media -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars(truncateText(strip_tags($post['content']), 150)); ?>" />
    <meta property="og:image" content="<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/blog/{$post['main_image']}"; ?>" />
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="<?php echo SITE_NAME_EN; ?>" />
    
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars(truncateText(strip_tags($post['content']), 150)); ?>">
    <meta name="twitter:image" content="<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/blog/{$post['main_image']}"; ?>">
    
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "<?php echo htmlspecialchars($pageTitle); ?>",
      "image": "<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/blog/{$post['main_image']}"; ?>",
      "datePublished": "<?php echo date('c', strtotime($post['published_at'])); ?>",
      "dateModified": "<?php echo date('c', strtotime($post['published_at'])); ?>",
      "author": {
        "@type": "Organization",
        "name": "<?php echo SITE_NAME_EN; ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "<?php echo SITE_NAME_EN; ?>",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo "https://$_SERVER[HTTP_HOST]/assets/images/general/school-logo.png"; ?>"
        }
      },
      "description": "<?php echo htmlspecialchars(truncateText(strip_tags($post['content']), 150)); ?>"
    }
    </script>
    
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
    <link rel="stylesheet" href="assets/vendors/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/swiper/swiper-bundle.min.css" />
    
    <!-- کتابخانه‌های مورد نیاز برای پلیرهای سفارشی -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css">
    
    <!-- Template Styles -->
    <link rel="stylesheet" href="assets/css/salman.css" />
    
    <!-- Main CSS -->
    <?php include_once 'assets/css/pages/post.css.php'; ?>

    
</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Hero Header for Post -->
        <section class="post-hero">
            <div class="post-hero__bg" style="background-image: url('assets/images/blog/<?php echo htmlspecialchars($post['main_image']); ?>')">
                <div class="post-hero__overlay"></div>
            </div>

            <div class="container">
                <div class="post-hero__content wow fadeIn" data-wow-delay="200ms">
                    <!-- Category Badge -->
                    <div class="post-hero__category">
                        <a href="blog.php?category=<?php echo $post['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                            <?php echo htmlspecialchars($post['category_name']); ?>
                        </a>
                    </div>
                    
                    <!-- Post Title -->
                    <h1 class="post-hero__title">
                        <?php echo htmlspecialchars($post['title']); ?>
                    </h1>
                    
                    <!-- Post Meta -->
                    <div class="post-hero__meta">
                        <div class="post-hero__date">
                            <i class="far fa-calendar-alt"></i>
                            <span><?php echo $postDate; ?></span>
                        </div>
                        
                        <div class="post-hero__views">
                            <i class="far fa-eye"></i>
                            <span><?php echo number_format($post['views']); ?> <?php echo $staticTexts['views']; ?></span>
                        </div>
                        
                        <div class="post-hero__reading-time">
                            <i class="far fa-clock"></i>
                            <span><?php echo $readingTime; ?> <?php echo $staticTexts['min_read']; ?></span>
                        </div>
                    </div>
                    
                    <!-- Breadcrumbs -->
                    <div class="post-hero__breadcrumbs">
                        <a href="index.php<?php echo $isRtl ? '?lang=fa' : ''; ?>"><?php echo $staticTexts['home']; ?></a>
                        <i class="fas fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        <a href="blog.php<?php echo $isRtl ? '?lang=fa' : ''; ?>"><?php echo $staticTexts['blog_title']; ?></a>
                        <i class="fas fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                        <span><?php echo htmlspecialchars($pageTitle); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Area -->
        <section class="post-content">
            <div class="container">
                <div class="row">
                    <!-- Main Content Column -->
                    <div class="col-lg-8">
                        <div class="post-content__main wow fadeInUp" data-wow-delay="300ms">
                            <!-- نمایش محتوای پردازش شده -->
                            <div class="post-content__text">
                                <?php echo $processedContent; ?>
                            </div>
                            
                            <!-- Post Footer -->
                            <div class="post-content__footer">
                                <!-- Categories -->
                                <div class="post-content__categories">
                                    <span class="post-content__categories-title"><?php echo $staticTexts['categories']; ?>:</span>
                                    <a href="blog.php?category=<?php echo $post['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="post-content__category-link">
                                        <?php echo htmlspecialchars($post['category_name']); ?>
                                    </a>
                                </div>
                                
                                <!-- Social Share Buttons -->
                                <div class="post-content__share">
                                    <span class="post-content__share-title"><?php echo $staticTexts['share_title']; ?>:</span>
                                    <div class="post-content__share-buttons">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" rel="noopener" class="post-content__share-link facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?php echo urlencode($pageTitle); ?>" target="_blank" rel="noopener" class="post-content__share-link twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://wa.me/?text=<?php echo urlencode($pageTitle . " - https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" rel="noopener" class="post-content__share-link whatsapp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="https://t.me/share/url?url=<?php echo urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?php echo urlencode($pageTitle); ?>" target="_blank" rel="noopener" class="post-content__share-link telegram">
                                            <i class="fab fa-telegram-plane"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Related Posts Section -->
                        <?php if (!empty($related_posts)): ?>
                        <div class="post-related wow fadeInUp" data-wow-delay="400ms">
                            <h3 class="post-related__title"><?php echo $staticTexts['related_posts_title']; ?></h3>
                            
                            <div class="row">
                                <?php foreach ($related_posts as $rpost): ?>
                                <div class="col-md-4">
                                    <div class="post-related__item">
                                        <div class="post-related__image">
                                            <img src="assets/images/blog/<?php echo htmlspecialchars($rpost['main_image']); ?>" alt="<?php echo htmlspecialchars($rpost['title']); ?>">
                                            <a href="post.php?id=<?php echo $rpost['post_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="post-related__link"></a>
                                        </div>
                                        
                                        <div class="post-related__content">
                                            <div class="post-related__date"><?php echo formatDate($rpost['published_at'], $lang); ?></div>
                                            <h4 class="post-related__item-title">
                                                <a href="post.php?id=<?php echo $rpost['post_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                    <?php echo htmlspecialchars($rpost['title']); ?>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Sidebar Column -->
                    <div class="col-lg-4">
                        <div class="post-sidebar">
                            <!-- Search Widget -->
                            <div class="post-sidebar__widget post-sidebar__search wow fadeInUp" data-wow-delay="400ms">
                                <h4 class="post-sidebar__title">
                                    <?php echo $staticTexts['search_here']; ?>
                                </h4>
                                
                                <form action="blog.php" method="GET" class="post-sidebar__search-form">
                                    <?php if ($isRtl): ?>
                                    <input type="hidden" name="lang" value="fa">
                                    <?php endif; ?>
                                    <input type="text" name="search" placeholder="<?php echo $staticTexts['search_here']; ?>">
                                    <button type="submit" aria-label="<?php echo $staticTexts['search_button']; ?>">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Latest Posts Widget -->
                            <div class="post-sidebar__widget post-sidebar__latest wow fadeInUp" data-wow-delay="500ms">
                                <h4 class="post-sidebar__title">
                                    <?php echo $staticTexts['latest_posts']; ?>
                                </h4>
                                
                                <ul class="post-sidebar__latest-list">
                                    <?php foreach ($latest_posts as $lpost): ?>
                                    <li class="post-sidebar__latest-item">
                                        <div class="post-sidebar__latest-image">
                                            <img src="assets/images/blog/<?php echo htmlspecialchars($lpost['main_image']); ?>" alt="<?php echo htmlspecialchars($lpost['title']); ?>">
                                        </div>
                                        
                                        <div class="post-sidebar__latest-content">
                                            <h5 class="post-sidebar__latest-title">
                                                <a href="post.php?id=<?php echo $lpost['post_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>">
                                                    <?php echo htmlspecialchars($lpost['title']); ?>
                                                </a>
                                            </h5>
                                            <span class="post-sidebar__latest-date">
                                                <?php echo formatDate($lpost['published_at'], $lang); ?>
                                            </span>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            
                            <!-- Categories Widget -->
                            <div class="post-sidebar__widget post-sidebar__categories wow fadeInUp" data-wow-delay="600ms">
                                <h4 class="post-sidebar__title">
                                    <?php echo $staticTexts['categories']; ?>
                                </h4>
                                
                                <div class="post-sidebar__categories-list">
                                    <?php foreach ($categories as $category): ?>
                                        <?php if ($category['post_count'] > 0): ?>
                                            <a href="blog.php?category=<?php echo $category['category_id']; ?><?php echo $isRtl ? '&lang=fa' : ''; ?>" class="post-sidebar__category-item <?php echo ($category['category_id'] == $post['category_id']) ? 'active' : ''; ?>">
                                                <?php echo htmlspecialchars($category['category_name']); ?>
                                                <span><?php echo $category['post_count']; ?></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- Back to Blog Button -->
                            <div class="post-sidebar__widget post-sidebar__back-btn wow fadeInUp" data-wow-delay="700ms">
                                <a href="blog.php<?php echo $isRtl ? '?lang=fa' : ''; ?>" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-arrow-<?php echo $isRtl ? 'right' : 'left'; ?> me-2"></i>
                                    <?php echo $staticTexts['back_to_blog']; ?>
                                </a>
                            </div>
                        </div>
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
    <script src="assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <!-- کتابخانه‌های مورد نیاز برای پلیرهای سفارشی -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    
    <!-- Post Specific Scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // راه‌اندازی اسلایدر تصاویر
        initImageSliders();
        
        // راه‌اندازی پلیر ویدیویی سفارشی
        initCustomVideoPlayers();
        
        // راه‌اندازی پلیر صوتی سبک و سریع
        initLightweightAudioPlayers();
        
        // فعال‌سازی MagnificPopup برای تصاویر
        initMagnificPopup();
        
        // اضافه کردن ویژگی lazy loading به تصاویر برای بهبود کارایی
        document.querySelectorAll('img').forEach(function(img) {
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }
        });
    });

    // راه‌اندازی اسلایدر تصاویر
    function initImageSliders() {
        // اسلایدر اصلی تصاویر
        const imageSliders = document.querySelectorAll('.post-images-slider');
        
        if (imageSliders.length > 0) {
            imageSliders.forEach(function(slider) {
                new Swiper(slider, {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: true,
                    autoHeight: false,
                    grabCursor: true,
                    keyboard: {
                        enabled: true,
                    },
                    navigation: {
                        nextEl: slider.querySelector('.swiper-button-next'),
                        prevEl: slider.querySelector('.swiper-button-prev'),
                    },
                    pagination: {
                        el: slider.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    speed: 500,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true
                    }
                });
            });
        }
    }

    // راه‌اندازی پلیر ویدیویی سفارشی
    function initCustomVideoPlayers() {
        if (typeof Plyr !== 'undefined') {
            const videoPlayers = document.querySelectorAll('.custom-video-player');
            
            if (videoPlayers.length > 0) {
                // راه‌اندازی Plyr برای تمام ویدیوها
                const players = Array.from(videoPlayers).map(player => {
                    return new Plyr(player, {
                        controls: [
                            'play-large', 'play', 'progress', 'current-time', 'mute', 
                            'volume', 'captions', 'settings', 'pip', 'fullscreen'
                        ],
                        hideControls: true,
                        keyboard: { focused: true, global: false },
                        tooltips: { controls: true, seek: true },
                        disableContextMenu: true
                    });
                });
                
                // غیرفعال کردن امکان دانلود با جلوگیری از راست‌کلیک
                players.forEach(player => {
                    const media = player.elements.container;
                    
                    // جلوگیری از راست‌کلیک روی ویدیو
                    media.addEventListener('contextmenu', function(e) {
                        e.preventDefault();
                        return false;
                    });
                    
                    // غیرفعال کردن قابلیت drag & drop ویدیو
                    media.addEventListener('dragstart', function(e) {
                        e.preventDefault();
                        return false;
                    });
                });
            }
        }
    }

    // راه‌اندازی پلیر صوتی سبک و سریع
    function initLightweightAudioPlayers() {
        const audioPlayers = document.querySelectorAll('.lightweight-audio-player');
        
        if (audioPlayers.length > 0) {
            audioPlayers.forEach(player => {
                const playerId = player.id.replace('-container', '');
                const audioElement = document.getElementById('source-' + playerId);
                const playButton = document.getElementById('play-' + playerId);
                const progressBar = document.getElementById('progress-' + playerId);
                const progressFill = document.getElementById('fill-' + playerId);
                const progressHandle = document.getElementById('handle-' + playerId);
                const currentTimeDisplay = document.getElementById('current-' + playerId);
                const durationDisplay = document.getElementById('duration-' + playerId);
                const volumeButton = document.getElementById('volume-' + playerId);
                const volumeSlider = document.getElementById('volume-slider-' + playerId);
                
                // متغیرهای پلیر
                let isPlaying = false;
                let isMuted = false;
                let lastVolume = 1;
                
                // اضافه کردن آیکون‌های پخش/توقف
                playButton.innerHTML = '<i class="fas fa-play"></i><i class="fas fa-pause" style="display:none;"></i>';
                
                // رویداد بارگذاری متادیتا (زمان کل فایل)
                audioElement.addEventListener('loadedmetadata', function() {
                    durationDisplay.textContent = formatTime(audioElement.duration);
                });
                
                // رویداد به‌روزرسانی زمان پخش
                audioElement.addEventListener('timeupdate', function() {
                    // به‌روزرسانی نمایش زمان
                    currentTimeDisplay.textContent = formatTime(audioElement.currentTime);
                    
                    // به‌روزرسانی نوار پیشرفت
                    const progress = (audioElement.currentTime / audioElement.duration) * 100;
                    progressFill.style.width = progress + '%';
                    progressHandle.style.left = progress + '%';
                });
                
                // رویداد اتمام پخش
                audioElement.addEventListener('ended', function() {
                    isPlaying = false;
                    playButton.classList.remove('playing');
                    playButton.querySelector('.fa-play').style.display = 'block';
                    playButton.querySelector('.fa-pause').style.display = 'none';
                });
                
                // رویداد کلیک دکمه پخش/توقف
                playButton.addEventListener('click', function() {
                    if (isPlaying) {
                        audioElement.pause();
                        isPlaying = false;
                        playButton.classList.remove('playing');
                        playButton.querySelector('.fa-play').style.display = 'block';
                        playButton.querySelector('.fa-pause').style.display = 'none';
                    } else {
                        audioElement.play();
                        isPlaying = true;
                        playButton.classList.add('playing');
                        playButton.querySelector('.fa-play').style.display = 'none';
                        playButton.querySelector('.fa-pause').style.display = 'block';
                    }
                });
                
                // رویداد کلیک روی نوار پیشرفت
                progressBar.addEventListener('click', function(e) {
                    const rect = progressBar.getBoundingClientRect();
                    const pos = (e.clientX - rect.left) / rect.width;
                    audioElement.currentTime = pos * audioElement.duration;
                });
                
                // رویداد کشیدن نوار پیشرفت
                let isDragging = false;
                
                progressBar.addEventListener('mousedown', function(e) {
                    isDragging = true;
                    progressBar.parentElement.classList.add('active');
                    updateProgressFromMouse(e);
                });
                
                document.addEventListener('mousemove', function(e) {
                    if (isDragging) {
                        updateProgressFromMouse(e);
                    }
                });
                
                document.addEventListener('mouseup', function() {
                    if (isDragging) {
                        isDragging = false;
                        progressBar.parentElement.classList.remove('active');
                    }
                });
                
                function updateProgressFromMouse(e) {
                    const rect = progressBar.getBoundingClientRect();
                    let pos = (e.clientX - rect.left) / rect.width;
                    pos = Math.max(0, Math.min(1, pos));
                    
                    audioElement.currentTime = pos * audioElement.duration;
                }
                
                // رویداد تغییر حجم صدا
                volumeSlider.addEventListener('input', function() {
                    const volume = this.value / 100;
                    audioElement.volume = volume;
                    
                    // به‌روزرسانی آیکون صدا
                    updateVolumeIcon(volume);
                    
                    // ذخیره آخرین وضعیت صدا
                    if (volume > 0) {
                        lastVolume = volume;
                    }
                    
                    // به‌روزرسانی وضعیت قطع صدا
                    isMuted = volume === 0;
                });
                
                // رویداد کلیک دکمه صدا
                volumeButton.addEventListener('click', function() {
                    if (isMuted) {
                        // وصل کردن صدا
                        audioElement.volume = lastVolume;
                        volumeSlider.value = lastVolume * 100;
                        isMuted = false;
                    } else {
                        // قطع صدا
                        audioElement.volume = 0;
                        volumeSlider.value = 0;
                        isMuted = true;
                    }
                    
                    // به‌روزرسانی آیکون صدا
                    updateVolumeIcon(audioElement.volume);
                });
                
                // تابع به‌روزرسانی آیکون صدا
                function updateVolumeIcon(volume) {
                    let iconClass = 'fas ';
                    
                    if (volume === 0) {
                        iconClass += 'fa-volume-mute';
                    } else if (volume < 0.5) {
                        iconClass += 'fa-volume-down';
                    } else {
                        iconClass += 'fa-volume-up';
                    }
                    
                    volumeButton.innerHTML = `<i class="${iconClass}"></i>`;
                }
                
                // پیش‌بارگیری و آماده‌سازی اولیه
                audioElement.load();
                updateVolumeIcon(audioElement.volume);
            });
        }
    }

    // فعال‌سازی MagnificPopup برای تصاویر
    function initMagnificPopup() {
        if (typeof $.fn.magnificPopup !== 'undefined') {
            $('.post-gallery-link').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                },
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });
        }
    }

    // فرمت‌بندی زمان به صورت MM:SS
    function formatTime(timeInSeconds) {
        if (isNaN(timeInSeconds)) return "00:00";
        const minutes = Math.floor(timeInSeconds / 60);
        const seconds = Math.floor(timeInSeconds % 60);
        return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    </script>
    
</body>
</html> 