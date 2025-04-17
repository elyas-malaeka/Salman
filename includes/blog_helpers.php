<?php
/**
 * توابع کمکی برای سیستم وبلاگ ماژولار
 * 
 * این فایل شامل توابعی است که محتوای ثابت را از دیتابیس بازیابی و ویجت‌ها را مدیریت می‌کند
 * 
 * @package Salman Educational Complex
 * @version 3.0
 * @updated 2025-03-30
 */

/**
 * دریافت محتوای ثابت از جدول blog_content
 * 
 * @param string $field_key کلید فیلد محتوا
 * @param string|null $lang کد زبان (اختیاری)
 * @return string محتوای درخواست شده
 */
function getBlogContent($field_key, $lang = null) {
    global $conn;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($conn, $field_key);
    $lang = mysqli_real_escape_string($conn, $lang);
    
    $query = "SELECT content FROM blog_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = '{$lang}' 
              AND is_repeatable = 0 
              LIMIT 1";
              
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    
    // اگر محتوا در دیتابیس یافت نشد، از جدول ترجمه استفاده می‌کنیم
    // این برای سازگاری با سیستم قبلی است
    return t($field_key, $lang);
}

/**
 * بررسی وضعیت نمایش ویجت در صفحه
 * 
 * @param string $widget_key کلید ویجت
 * @return bool آیا ویجت باید نمایش داده شود
 */
function isWidgetVisible($widget_key) {
    global $conn;
    
    $widget_key = mysqli_real_escape_string($conn, $widget_key);
    
    $query = "SELECT id FROM blog_content 
              WHERE field_key = '{$widget_key}_visible' 
              AND content = '1' 
              LIMIT 1";
              
    $result = mysqli_query($conn, $query);
    
    // اگر تنظیمی برای این ویجت وجود ندارد، پیش‌فرض نمایش داده شود
    if (!$result || mysqli_num_rows($result) == 0) {
        return true;
    }
    
    return mysqli_num_rows($result) > 0;
}

/**
 * دریافت ترتیب نمایش ویجت‌ها
 * 
 * @return array آرایه‌ای از ویجت‌ها به ترتیب نمایش
 */
function getSidebarWidgetsOrder() {
    global $conn;
    
    $query = "SELECT field_key, content FROM blog_content 
              WHERE field_key LIKE '%_order' 
              ORDER BY CAST(content AS UNSIGNED) ASC";
              
    $result = mysqli_query($conn, $query);
    $widgets = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $widget_name = str_replace('_order', '', $row['field_key']);
            $widgets[] = $widget_name;
        }
    } else {
        // ترتیب پیش‌فرض اگر تنظیمی در دیتابیس نباشد
        $widgets = ['search', 'latest_posts', 'categories', 'popular_posts'];
    }
    
    return $widgets;
}

/**
 * نمایش ویجت جستجو
 * 
 * @param string $lang کد زبان
 * @param bool $isRtl آیا زبان راست به چپ است
 * @param int|null $categoryId شناسه دسته‌بندی فعلی
 */
function renderSearchWidget($lang, $isRtl, $categoryId = null) {
    if (!isWidgetVisible('search')) {
        return;
    }
    
    echo '<div class="blog-sidebar__widget blog-sidebar__search wow fadeInUp" data-wow-delay="300ms">';
    echo '<h4 class="blog-sidebar__title">';
    echo getBlogContent('sidebar_search_title', $lang);
    echo '</h4>';
    
    echo '<form action="blog.php" method="GET" class="blog-sidebar__search-form">';
    if ($isRtl) {
        echo '<input type="hidden" name="lang" value="' . $lang . '">';
    }
    
    if ($categoryId) {
        echo '<input type="hidden" name="category" value="' . $categoryId . '">';
    }
    
    echo '<input type="text" name="search" placeholder="' . getBlogContent('search_placeholder', $lang) . '">';
    echo '<button type="submit" aria-label="' . getBlogContent('search_button_text', $lang) . '">';
    echo '<i class="fas fa-search"></i>';
    echo '</button>';
    echo '</form>';
    echo '</div>';
}

/**
 * نمایش ویجت آخرین پست‌ها
 * 
 * @param string $lang کد زبان
 * @param bool $isRtl آیا زبان راست به چپ است
 * @param array $latest_posts آرایه پست‌های اخیر
 */
function renderLatestPostsWidget($lang, $isRtl, $latest_posts) {
    if (!isWidgetVisible('latest_posts') || empty($latest_posts)) {
        return;
    }
    
    echo '<div class="blog-sidebar__widget blog-sidebar__posts wow fadeInUp" data-wow-delay="400ms">';
    echo '<h4 class="blog-sidebar__title">';
    echo getBlogContent('sidebar_latest_title', $lang);
    echo '</h4>';
    
    echo '<ul class="blog-sidebar__post-list">';
    foreach ($latest_posts as $post) {
        echo '<li class="blog-sidebar__post-item">';
        echo '<div class="blog-sidebar__post-image">';
        echo '<img src="assets/images/blog/' . htmlspecialchars($post['main_image']) . '" alt="' . htmlspecialchars($post['title']) . '">';
        echo '</div>';
        
        echo '<div class="blog-sidebar__post-content">';
        echo '<h5 class="blog-sidebar__post-title">';
        echo '<a href="post.php?id=' . $post['post_id'] . ($isRtl ? '&lang=' . $lang : '') . '">';
        echo htmlspecialchars($post['title']);
        echo '</a>';
        echo '</h5>';
        
        echo '<span class="blog-sidebar__post-date">';
        echo formatDate($post['published_at'], $lang);
        echo '</span>';
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
}

/**
 * نمایش ویجت دسته‌بندی‌ها
 * 
 * @param string $lang کد زبان
 * @param bool $isRtl آیا زبان راست به چپ است
 * @param array $categories آرایه دسته‌بندی‌ها
 * @param int|null $currentCategoryId شناسه دسته‌بندی فعلی
 */
function renderCategoriesWidget($lang, $isRtl, $categories, $currentCategoryId = null) {
    if (!isWidgetVisible('categories') || empty($categories)) {
        return;
    }
    
    echo '<div class="blog-sidebar__widget blog-sidebar__categories wow fadeInUp" data-wow-delay="500ms">';
    echo '<h4 class="blog-sidebar__title">';
    echo getBlogContent('sidebar_categories_title', $lang);
    echo '</h4>';
    
    echo '<div class="blog-sidebar__categories-list">';
    foreach ($categories as $category) {
        if ($category['post_count'] > 0) {
            $isActive = ($currentCategoryId == $category['category_id']) ? 'active' : '';
            
            echo '<a href="blog.php?category=' . $category['category_id'] . ($isRtl ? '&lang=' . $lang : '') . '" class="blog-sidebar__category ' . $isActive . '">';
            echo htmlspecialchars($category['name']);
            echo '<span>' . $category['post_count'] . '</span>';
            echo '</a>';
        }
    }
    echo '</div>';
    echo '</div>';
}

/**
 * نمایش ویجت پست‌های محبوب
 * 
 * @param string $lang کد زبان
 * @param bool $isRtl آیا زبان راست به چپ است
 * @param array $popular_posts آرایه پست‌های محبوب
 */
function renderPopularPostsWidget($lang, $isRtl, $popular_posts) {
    if (!isWidgetVisible('popular_posts') || empty($popular_posts)) {
        return;
    }
    
    echo '<div class="blog-sidebar__widget blog-sidebar__popular wow fadeInUp" data-wow-delay="600ms">';
    echo '<h4 class="blog-sidebar__title">';
    echo getBlogContent('sidebar_popular_title', $lang);
    echo '</h4>';
    
    echo '<div class="blog-sidebar__popular-list">';
    foreach ($popular_posts as $post) {
        $category_name = $post['category_name'] ?? getBlogContent('uncategorized', $lang);
        
        echo '<div class="blog-sidebar__popular-item">';
        echo '<div class="blog-sidebar__popular-category">';
        echo htmlspecialchars($category_name);
        echo '</div>';
        
        echo '<h5 class="blog-sidebar__popular-title">';
        echo '<a href="post.php?id=' . $post['post_id'] . ($isRtl ? '&lang=' . $lang : '') . '">';
        echo htmlspecialchars($post['title']);
        echo '</a>';
        echo '</h5>';
        
        echo '<div class="blog-sidebar__popular-meta">';
        echo '<span>' . number_format($post['views']) . ' ' . getBlogContent('views_text', $lang) . '</span>';
        echo '<a href="post.php?id=' . $post['post_id'] . ($isRtl ? '&lang=' . $lang : '') . '" class="blog-sidebar__popular-arrow">';
        echo '<i class="fas fa-arrow-' . ($isRtl ? 'left' : 'right') . '"></i>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}

/**
 * نمایش سایدبار کامل با تمام ویجت‌ها به ترتیب تعیین شده
 * 
 * @param string $lang کد زبان
 * @param bool $isRtl آیا زبان راست به چپ است
 * @param array $data داده‌های مورد نیاز برای ویجت‌ها
 */
function renderSidebar($lang, $isRtl, $data) {
    // دریافت ترتیب ویجت‌ها از دیتابیس
    $widget_order = getSidebarWidgetsOrder();
    
    echo '<div class="blog-sidebar">';
    
    foreach ($widget_order as $widget) {
        switch ($widget) {
            case 'search':
                renderSearchWidget($lang, $isRtl, $data['categoryId'] ?? null);
                break;
                
            case 'latest_posts':
                renderLatestPostsWidget($lang, $isRtl, $data['latest_posts'] ?? []);
                break;
                
            case 'categories':
                renderCategoriesWidget($lang, $isRtl, $data['categories'] ?? [], $data['categoryId'] ?? null);
                break;
                
            case 'popular_posts':
                renderPopularPostsWidget($lang, $isRtl, $data['popular_posts'] ?? []);
                break;
        }
    }
    
    echo '</div>';
}