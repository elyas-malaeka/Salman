<?php
// یک مقدار برای سادگی
$response = ['status' => 'error', 'message' => 'An error occurred. Please try again.'];

// بررسی متد درخواست
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // اطلاعات اتصال به پایگاه داده - بهتر است این مقادیر در یک فایل کانفیگ جداگانه باشند
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'salman';
        
        // تایید مقادیر ورودی
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        
        // بررسی فیلدهای اجباری
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            throw new Exception("Please fill in all required fields.");
        }
        
        // بررسی فرمت ایمیل
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }
        
        // اتصال به پایگاه داده
        $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
        
        // بررسی خطای اتصال
        if ($db->connect_error) {
            throw new Exception("Connection failed: " . $db->connect_error);
        }
        
        // تنظیم کاراکتر ست
        $db->set_charset("utf8mb4");
        
        // استفاده از prepared statement برای امنیت بیشتر
        $stmt = $db->prepare("INSERT INTO contact_us (name, email, phone, subject, message, submit_date) VALUES (?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $db->error);
        }
        
        $submit_date = date('Y-m-d H:i:s');
        $stmt->bind_param("ssssss", $name, $email, $phone, $subject, $message, $submit_date);
        
        // اجرای query
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Your message has been sent successfully. We will contact you soon.';
            
            // ارسال ایمیل اطلاع‌رسانی (اختیاری)
            $to = "admin@example.com"; // ایمیل مدیر سایت
            $email_subject = "New Contact Form Submission: $subject";
            $email_body = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\n\nMessage:\n$message";
            $headers = "From: $email";
            
            @mail($to, $email_subject, $email_body, $headers);
        } else {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        // بستن statement و اتصال
        $stmt->close();
        $db->close();
        
    } catch (Exception $e) {
        // ثبت خطا در فایل لاگ سرور
        error_log("Contact form error: " . $e->getMessage());
        
        // برگرداندن پیام خطای کاربرپسند (بدون جزئیات فنی)
        $response['message'] = "We're sorry, but there was an error processing your request. Please try again later.";
        
        // در محیط توسعه می‌توانید خطای دقیق را نمایش دهید
        // $response['message'] = "Error: " . $e->getMessage();
    }
}

// ارسال پاسخ JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>