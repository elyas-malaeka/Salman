<?php
/**
 * حذف توکن‌های منقضی شده از دیتابیس
 * این اسکریپت باید به صورت منظم اجرا شود (مثلاً روزانه)
 * 
 * برای اجرای خودکار می‌توانید از cron job استفاده کنید:
 * 0 1 * * * php /path/to/your/site/cron/cleanup-tokens.php
 */

// مسیر فایل config.php را تنظیم کنید
require_once dirname(__DIR__) . '/includes/config.php';

// حذف توکن‌های منقضی شده قدیمی‌تر از یک هفته
$query = "DELETE FROM registration_tokens WHERE expires_at < DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($db->query($query)) {
    $count = $db->affected_rows;
    echo "Deleted {$count} expired tokens.\n";
    error_log("Cleanup tokens: Deleted {$count} expired tokens.");
} else {
    echo "Error deleting expired tokens: " . $db->error . "\n";
    error_log("Cleanup tokens error: " . $db->error);
}

// حذف توکن‌های استفاده شده قدیمی‌تر از 30 روز
$query = "DELETE FROM registration_tokens WHERE is_used = 1 AND last_used_at < DATE_SUB(NOW(), INTERVAL 30 DAY)";

if ($db->query($query)) {
    $count = $db->affected_rows;
    echo "Deleted {$count} used tokens older than 30 days.\n";
    error_log("Cleanup tokens: Deleted {$count} used tokens older than 30 days.");
} else {
    echo "Error deleting used tokens: " . $db->error . "\n";
    error_log("Cleanup tokens error: " . $db->error);
}

// بستن اتصال دیتابیس
$db->close();