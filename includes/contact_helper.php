<?php
/**
 * Contact Page Helper Functions
 * 
 * Functions to fetch content from database for the contact page
 */

/**
 * Get contact page content by field key and language
 * 
 * @param string $field_key The unique identifier for the content
 * @param string $lang Language code (fa, en, ar)
 * @return string The content or empty string if not found
 */
function getContactContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // Convert language code to language_id
    $lang_id = getLanguageId($lang);
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    
    $query = "SELECT content FROM contact_content 
              WHERE field_key = '{$field_key}' 
              AND language_id = {$lang_id} 
              AND is_repeatable = 0 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    
    return "";
}

/**
 * Get contact page info with icon by type and language
 * (Renamed to avoid conflict with existing getContactInfo)
 * 
 * @param string $type Information type (email, phone, address, etc.)
 * @param string $lang Language code (fa, en, ar)
 * @return array Associative array with value and icon_class
 */
function getContactPageInfoWithIcon($type, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $type = mysqli_real_escape_string($db, $type);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT value, icon_class FROM contact_info 
              WHERE type = '{$type}' 
              AND language_id = '{$lang}' 
              AND is_active = 1 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    
    return ['value' => '', 'icon_class' => ''];
}

/**
 * Get language ID from language code
 * 
 * @param string $lang_code Language code (fa, en, ar)
 * @return int Language ID
 */
function getLanguageId($lang_code) {
    switch ($lang_code) {
        case 'fa':
            return 1;
        case 'en':
            return 2;
        case 'ar':
            return 3;
        default:
            return 1; // Default to Persian
    }
}

/**
 * Insert contact form data into database
 * 
 * @param array $data Form data
 * @return array Response with status and message
 */
function saveContactForm($data) {
    global $db;
    
    $response = ['status' => 'error', 'message' => 'An error occurred. Please try again.'];
    
    try {
        // Validate input values
        $name = isset($data['name']) ? trim($data['name']) : '';
        $email = isset($data['email']) ? trim($data['email']) : '';
        $phone = isset($data['phone']) ? trim($data['phone']) : '';
        $subject = isset($data['subject']) ? trim($data['subject']) : '';
        $message = isset($data['message']) ? trim($data['message']) : '';
        $language = isset($data['language']) ? trim($data['language']) : getCurrentLanguage();
        
        // Check required fields
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            throw new Exception("Please fill in all required fields.");
        }
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }
        
        // Set character set
        $db->set_charset("utf8mb4");
        
        // Use prepared statement for security
        $stmt = $db->prepare("INSERT INTO contact_us (name, email, phone, subject, message, language, ip_address, user_agent, submit_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $db->error);
        }
        
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $submit_date = date('Y-m-d H:i:s');
        
        $stmt->bind_param("sssssssss", 
            $name, 
            $email, 
            $phone, 
            $subject, 
            $message, 
            $language,
            $ip_address,
            $user_agent,
            $submit_date
        );
        
        // Execute query
        if ($stmt->execute()) {
            $lang = getCurrentLanguage();
            $response['status'] = 'success';
            $response['message'] = getContactContent('success_message', $lang);
            
            // Send notification email (optional)
            $to = "admin@example.com"; // Site admin email
            $email_subject = "New Contact Form Submission: $subject";
            $email_body = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\n\nMessage:\n$message";
            $headers = "From: $email";
            
            @mail($to, $email_subject, $email_body, $headers);
        } else {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        // Close statement
        $stmt->close();
        
    } catch (Exception $e) {
        // Log error to server log
        error_log("Contact form error: " . $e->getMessage());
        
        // Return user-friendly error message
        $lang = getCurrentLanguage();
        $response['message'] = getContactContent('error_message', $lang);
        
        // In development environment, you may want to display the exact error
        // $response['message'] = "Error: " . $e->getMessage();
    }
    
    return $response;
}