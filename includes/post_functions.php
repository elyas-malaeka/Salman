<?php
/**
 * توابع مدیریت پست‌های وبلاگ - بازنویسی شده برای ساختار جدید دیتابیس
 * 
 * این فایل شامل توابع مورد نیاز برای نمایش پست‌های بلاگ می‌باشد
 * با استفاده از ساختار مدیریت محتوای نیمه‌ماژولار
 * 
 * @version 4.2
 * @updated 2025-05-21
 */

/**
 * تبدیل کد زبان به شناسه زبان در دیتابیس
 * 
 * @param string $lang کد زبان (fa, en, ar)
 * @return int شناسه زبان
 */
function getLanguageId($lang) {
    global $db;
    
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT language_id FROM core_languages WHERE code = '{$lang}' LIMIT 1";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['language_id'];
    }
    
    // پیش‌فرض به زبان فارسی
    return 1;
}

/**
 * افزایش تعداد بازدید پست
 * 
 * @param int $postId شناسه پست
 * @return bool نتیجه عملیات
 */
function incrementPostViews($postId) {
    global $db;
    
    $postId = intval($postId);
    
    $query = "UPDATE cms_posts SET views = views + 1 WHERE post_id = {$postId}";
    return mysqli_query($db, $query);
}

/**
 * دریافت اطلاعات پست براساس شناسه
 * 
 * @param int $postId شناسه پست
 * @param int $langId شناسه زبان
 * @return array|false اطلاعات پست یا false در صورت عدم وجود
 */
function getPostById($postId, $langId) {
    global $db;
    
    $postId = intval($postId);
    $langId = intval($langId);
    
    $query = "SELECT p.post_id, p.views, p.published_at, p.main_media_id, 
                    pt.title, pt.content, 
                    c.category_id, ct.name AS category_name,
                    u.full_name AS author_name,
                    m.filepath AS main_image_path
              FROM cms_posts p
              JOIN cms_post_translations pt ON p.post_id = pt.post_id AND pt.language_id = {$langId}
              JOIN cms_categories c ON p.category_id = c.category_id
              JOIN cms_category_translations ct ON c.category_id = ct.category_id AND ct.language_id = {$langId}
              LEFT JOIN core_users u ON p.author_id = u.user_id
              LEFT JOIN media_files m ON p.main_media_id = m.id
              WHERE p.post_id = {$postId} AND p.status = 'published'
              LIMIT 1";
    
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return false;
}

/**
 * دریافت تصاویر مرتبط با پست
 * 
 * @param int $postId شناسه پست
 * @return array آرایه‌ای از تصاویر پست
 */
function getPostImages($postId) {
    global $db;
    
    $postId = intval($postId);
    
    // استفاده از جدول temp_post_content برای دریافت تصاویر مرتبط با پست
    $query = "SELECT pc.content, pc.field_key
              FROM temp_post_content pc
              WHERE pc.post_id = {$postId}
              AND pc.field_key LIKE 'image%'
              AND pc.is_active = 1
              ORDER BY pc.sort_order ASC";
    
    $result = mysqli_query($db, $query);
    $images = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // اگر محتوا یک مسیر تصویر است
            if (!empty($row['content'])) {
                $images[] = [
                    'image_path' => 'assets/images/blog/' . $row['content'],
                    'alt_text' => '',
                    'caption' => ''
                ];
            }
        }
    }
    
    // اگر از جدول temp_post_content تصویری پیدا نشد، از روش جایگزین استفاده می‌کنیم
    if (empty($images)) {
        // استفاده از جدول media_files برای دریافت تصاویر مرتبط با پست
        $query = "SELECT m.filepath, m.alt_text, m.caption
                  FROM media_files m
                  JOIN temp_post_content pc ON pc.content = CAST(m.id AS CHAR)
                  WHERE pc.post_id = {$postId}
                  AND pc.field_key LIKE 'gallery_image%'
                  AND pc.is_active = 1
                  ORDER BY pc.sort_order ASC";
        
        $result = mysqli_query($db, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (!empty($row['filepath'])) {
                    $images[] = [
                        'image_path' => $row['filepath'],
                        'alt_text' => $row['alt_text'] ?? '',
                        'caption' => $row['caption'] ?? ''
                    ];
                }
            }
        }
    }
    
    return $images;
}

/**
 * دریافت دسته‌بندی‌های وبلاگ با تعداد پست‌ها
 * 
 * @param int $langId شناسه زبان
 * @return array آرایه‌ای از دسته‌بندی‌ها
 */
function getCategories($langId) {
    global $db;
    
    $langId = intval($langId);
    
    $query = "SELECT c.category_id, ct.name, COUNT(p.post_id) as post_count
              FROM cms_categories c
              JOIN cms_category_translations ct ON c.category_id = ct.category_id AND ct.language_id = {$langId}
              LEFT JOIN cms_posts p ON c.category_id = p.category_id AND p.status = 'published'
              GROUP BY c.category_id
              ORDER BY ct.name";
    
    $result = mysqli_query($db, $query);
    $categories = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }
    
    return $categories;
}

/**
 * دریافت پست‌های مرتبط (از همان دسته‌بندی)
 * 
 * @param int $postId شناسه پست فعلی (برای حذف از نتایج)
 * @param int $categoryId شناسه دسته‌بندی
 * @param int $langId شناسه زبان
 * @param int $limit تعداد پست‌های مورد نیاز
 * @return array آرایه‌ای از پست‌های مرتبط
 */
function getRelatedPosts($postId, $categoryId, $langId, $limit = 3) {
    global $db;
    
    $postId = intval($postId);
    $categoryId = intval($categoryId);
    $langId = intval($langId);
    $limit = intval($limit);
    
    $query = "SELECT p.post_id, p.published_at, p.views, 
                     pt.title, pt.content,
                     m.filepath AS main_image_path
              FROM cms_posts p
              JOIN cms_post_translations pt ON p.post_id = pt.post_id AND pt.language_id = {$langId}
              LEFT JOIN media_files m ON p.main_media_id = m.id
              WHERE p.category_id = {$categoryId} 
                AND p.post_id != {$postId}
                AND p.status = 'published'
              ORDER BY p.published_at DESC
              LIMIT {$limit}";
    
    $result = mysqli_query($db, $query);
    $posts = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
    }
    
    return $posts;
}

/**
 * دریافت آخرین پست‌ها
 * 
 * @param int $postId شناسه پست فعلی (برای حذف از نتایج)
 * @param int $langId شناسه زبان
 * @param int $limit تعداد پست‌های مورد نیاز
 * @return array آرایه‌ای از آخرین پست‌ها
 */
function getLatestPosts($postId, $langId, $limit = 4) {
    global $db;
    
    $postId = intval($postId);
    $langId = intval($langId);
    $limit = intval($limit);
    
    $query = "SELECT p.post_id, p.published_at, p.views, 
                     pt.title, pt.content,
                     m.filepath AS main_image_path
              FROM cms_posts p
              JOIN cms_post_translations pt ON p.post_id = pt.post_id AND pt.language_id = {$langId}
              LEFT JOIN media_files m ON p.main_media_id = m.id
              WHERE p.post_id != {$postId}
                AND p.status = 'published'
              ORDER BY p.published_at DESC
              LIMIT {$limit}";
    
    $result = mysqli_query($db, $query);
    $posts = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
    }
    
    return $posts;
}

/**
 * دریافت محبوب‌ترین پست‌ها
 * 
 * @param int $postId شناسه پست فعلی (برای حذف از نتایج)
 * @param int $langId شناسه زبان
 * @param int $limit تعداد پست‌های مورد نیاز
 * @return array آرایه‌ای از محبوب‌ترین پست‌ها
 */
function getPopularPosts($postId, $langId, $limit = 3) {
    global $db;
    
    $postId = intval($postId);
    $langId = intval($langId);
    $limit = intval($limit);
    
    $query = "SELECT p.post_id, p.published_at, p.views, 
                     pt.title, pt.content,
                     m.filepath AS main_image_path
              FROM cms_posts p
              JOIN cms_post_translations pt ON p.post_id = pt.post_id AND pt.language_id = {$langId}
              LEFT JOIN media_files m ON p.main_media_id = m.id
              WHERE p.post_id != {$postId}
                AND p.status = 'published'
              ORDER BY p.views DESC
              LIMIT {$limit}";
    
    $result = mysqli_query($db, $query);
    $posts = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
    }
    
    return $posts;
}