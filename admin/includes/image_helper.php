<?php
// فایل: includes/image_helper.php

/**
 * بهینه‌سازی و تبدیل تصویر
 * 
 * @param string $source_path مسیر فایل منبع
 * @param string $dest_path مسیر فایل مقصد
 * @param string $format فرمت مقصد ('webp' یا 'jpg')
 * @param int $quality کیفیت تصویر (0-100)
 * @param array $resize ابعاد جدید برای تغییر اندازه (اختیاری) - مثال: ['width' => 800, 'height' => 600]
 * @return bool وضعیت موفقیت عملیات
 */
function optimize_image($source_path, $dest_path, $format = 'webp', $quality = 85, $resize = null) {
    // بررسی وجود کتابخانه GD
    if (!extension_loaded('gd')) {
        return false;
    }
    
    // تشخیص نوع تصویر
    $image_info = getimagesize($source_path);
    if ($image_info === false) {
        return false;
    }
    
    // ایجاد تصویر منبع براساس نوع آن
    switch ($image_info[2]) {
        case IMAGETYPE_JPEG:
            $source_image = imagecreatefromjpeg($source_path);
            break;
        case IMAGETYPE_PNG:
            $source_image = imagecreatefrompng($source_path);
            // حفظ شفافیت
            imagepalettetotruecolor($source_image);
            imagealphablending($source_image, true);
            imagesavealpha($source_image, true);
            break;
        case IMAGETYPE_GIF:
            $source_image = imagecreatefromgif($source_path);
            break;
        case IMAGETYPE_WEBP:
            $source_image = imagecreatefromwebp($source_path);
            break;
        default:
            return false;
    }
    
    if ($source_image === false) {
        return false;
    }
    
    // تعیین ابعاد تصویر
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    
    // بررسی نیاز به تغییر اندازه
    if ($resize !== null && isset($resize['width']) && isset($resize['height'])) {
        $new_width = $resize['width'];
        $new_height = $resize['height'];
        
        // حفظ تناسب ابعاد اگر فقط یکی از ابعاد تعیین شده باشد
        if ($new_width === 0) {
            $new_width = intval($width * ($new_height / $height));
        } elseif ($new_height === 0) {
            $new_height = intval($height * ($new_width / $width));
        }
    } else {
        $new_width = $width;
        $new_height = $height;
    }
    
    // ایجاد تصویر مقصد
    $dest_image = imagecreatetruecolor($new_width, $new_height);
    
    // حفظ شفافیت برای فرمت‌های PNG و WebP
    if ($image_info[2] === IMAGETYPE_PNG || $format === 'webp') {
        imagepalettetotruecolor($dest_image);
        imagealphablending($dest_image, false);
        imagesavealpha($dest_image, true);
    }
    
    // کپی تصویر منبع به مقصد با تغییر اندازه
    imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
    // ایجاد پوشه در صورت نیاز
    $dir = dirname($dest_path);
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
    
    // ذخیره تصویر در فرمت مورد نظر
    $result = false;
    switch ($format) {
        case 'webp':
            $result = imagewebp($dest_image, $dest_path, $quality);
            break;
        case 'jpg':
        case 'jpeg':
            $result = imagejpeg($dest_image, $dest_path, $quality);
            break;
        case 'png':
            // تنظیم کیفیت PNG (0-9)
            $png_quality = floor((100 - $quality) / 10);
            $result = imagepng($dest_image, $dest_path, $png_quality);
            break;
        case 'gif':
            $result = imagegif($dest_image, $dest_path);
            break;
    }
    
    // آزادسازی حافظه
    imagedestroy($source_image);
    imagedestroy($dest_image);
    
    return $result;
}

/**
 * آپلود، بهینه‌سازی و ذخیره تصویر
 *
 * @param array $file اطلاعات فایل (معمولاً $_FILES['field_name'])
 * @param string $upload_dir پوشه آپلود (مسیر نسبی از روت سایت)
 * @param string $format فرمت مقصد ('webp' یا 'jpg')
 * @param int $quality کیفیت تصویر (0-100)
 * @param array $resize ابعاد جدید برای تغییر اندازه (اختیاری)
 * @return string|false مسیر نسبی فایل یا false در صورت خطا
 */
function upload_optimized_image($file, $upload_dir, $format = 'webp', $quality = 85, $resize = null) {
    // بررسی آپلود فایل
    if (!isset($file) || $file['error'] !== 0) {
        return false;
    }
    
    // بررسی فرمت فایل
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    $filename = $file['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($ext, $allowed)) {
        return false;
    }
    
    // ایجاد نام منحصر به فرد برای فایل
    $new_filename = time() . '_' . uniqid() . '.' . $format;
    
    // اطمینان از اینکه مسیر آپلود با / شروع نمی‌شود
    $upload_dir = ltrim($upload_dir, '/');
    
    // اطمینان از اینکه مسیر آپلود با / تمام می‌شود
    if (substr($upload_dir, -1) !== '/') {
        $upload_dir .= '/';
    }
    
    // ایجاد مسیر کامل
    $full_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $upload_dir;
    
    // ایجاد پوشه در صورت نیاز
    if (!file_exists($full_upload_dir)) {
        mkdir($full_upload_dir, 0777, true);
    }
    
    $source_path = $file['tmp_name'];
    $dest_path = $full_upload_dir . $new_filename;
    
    // بهینه‌سازی و ذخیره تصویر
    if (optimize_image($source_path, $dest_path, $format, $quality, $resize)) {
        return $upload_dir . $new_filename;
    }
    
    return false;
}
?>