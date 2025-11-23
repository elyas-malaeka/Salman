<?php
/**
 * اعتبارسنجی توکن ثبت‌نام و دریافت اطلاعات مرتبط
 * 
 * @param string $token توکن ثبت‌نام
 * @return array|null اطلاعات ثبت‌نام یا null در صورت عدم اعتبار توکن
 */
function validateRegistrationToken($token) {
    global $db;
    
    // اعتبارسنجی ابتدایی
    if (empty($token) || strlen($token) !== 64 || !ctype_xdigit($token)) {
        error_log("Invalid token format: " . substr($token, 0, 10) . "...");
        return null;
    }
    
    // بررسی توکن در دیتابیس
    $query = "SELECT rt.registration_id, rt.is_used, rt.expires_at, 
                     r.student_id, s.first_name, s.last_name 
              FROM registration_tokens rt
              JOIN registrations r ON rt.registration_id = r.registration_id
              JOIN students s ON r.student_id = s.student_id
              WHERE rt.token_id = ? AND rt.expires_at > NOW()
              LIMIT 1";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in validateRegistrationToken: " . $db->error);
        return null;
    }
    
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        error_log("Token not found or expired: " . substr($token, 0, 10) . "...");
        return null;
    }
    
    $data = $result->fetch_assoc();
    $stmt->close();
    
    // بررسی اگر توکن قبلاً استفاده شده است
    if ($data['is_used']) {
        error_log("Token already used: " . substr($token, 0, 10) . "...");
        // توجه: می‌توان در اینجا همچنان اطلاعات را برگرداند،
        // اما می‌توان محدودیت اعمال کرد که توکن فقط یکبار قابل استفاده باشد
        
        // به‌روزرسانی زمان آخرین استفاده
        $updateQuery = "UPDATE registration_tokens SET last_used_at = NOW() WHERE token_id = ?";
        $updateStmt = $db->prepare($updateQuery);
        if ($updateStmt) {
            $updateStmt->bind_param("s", $token);
            $updateStmt->execute();
            $updateStmt->close();
        }
    } else {
        // نشانه‌گذاری توکن به عنوان استفاده شده
        $updateQuery = "UPDATE registration_tokens SET is_used = 1, last_used_at = NOW() WHERE token_id = ?";
        $updateStmt = $db->prepare($updateQuery);
        if ($updateStmt) {
            $updateStmt->bind_param("s", $token);
            $updateStmt->execute();
            $updateStmt->close();
        }
    }
    
    return $data;
}
/**
 * دریافت اطلاعات ثبت‌نام از دیتابیس
 * 
 * @param int $registrationId شناسه ثبت‌نام
 * @return array|bool آرایه اطلاعات ثبت‌نام یا false در صورت عدم وجود
 */
function getRegistrationInfo($registrationId) {
    global $db;
    
    $query = "SELECT r.registration_id, r.registration_date, r.registration_status,
              s.first_name, s.last_name, s.student_id
              FROM registrations r
              JOIN students s ON r.student_id = s.student_id
              WHERE r.registration_id = ?";
    
    $stmt = $db->prepare($query);
    if (!$stmt) {
        error_log("Database error in getRegistrationInfo: " . $db->error);
        return false;
    }
    
    $stmt->bind_param("i", $registrationId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row;
    }
    
    return false;
}