<?php
/**
 * سیستم لایک پست‌ها
 * ajax/like-post.php
 * 
 * @package Salman Educational Complex
 * @version 5.0
 */

// لود کردن فایل‌های مورد نیاز
require_once '../includes/config.php';
require_once '../includes/functions.php';

// بررسی درخواست AJAX
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    http_response_code(403);
    die('Access Denied');
}

// بررسی فیلدهای ارسالی
if (!isset($_POST['post_id']) || empty($_POST['post_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid post ID'
    ]);
    exit;
}

$postId = intval($_POST['post_id']);

// اتصال به دیتابیس
$conn = connectDB();

// شناسایی کاربر
$userId = '';
if (isset($_SESSION['user_id'])) {
    // کاربر لاگین کرده
    $userId = $_SESSION['user_id'];
} else {
    // کاربر مهمان
    if (!isset($_COOKIE['guest_id'])) {
        // ایجاد شناسه جدید برای مهمان
        $guestId = 'guest_' . uniqid();
        setcookie('guest_id', $guestId, time() + (86400 * 30), '/'); // ۳۰ روز
        $userId = $guestId;
    } else {
        $userId = $_COOKIE['guest_id'];
    }
}

// بررسی وضعیت لایک فعلی
$sql = "SELECT * FROM post_likes WHERE post_id = ? AND user_identifier = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $postId, $userId);
$stmt->execute();
$result = $stmt->get_result();

$isLiked = false;

if ($result->num_rows > 0) {
    // قبلاً لایک شده، پس آن را حذف می‌کنیم
    $sql = "DELETE FROM post_likes WHERE post_id = ? AND user_identifier = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $postId, $userId);
    $stmt->execute();
    $isLiked = false;
} else {
    // لایک نشده، پس آن را اضافه می‌کنیم
    $sql = "INSERT INTO post_likes (post_id, user_identifier, ip_address, liked_at) VALUES (?, ?, ?, NOW())";
    $ipAddress = getClientIP();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $postId, $userId, $ipAddress);
    $stmt->execute();
    $isLiked = true;
}

// دریافت تعداد لایک‌ها
$likeCount = getPostLikesCount($conn, $postId);

// بستن اتصال دیتابیس
closeDB($conn);

// ارسال پاسخ
echo json_encode([
    'success' => true,
    'liked' => $isLiked,
    'likes' => $likeCount
]);