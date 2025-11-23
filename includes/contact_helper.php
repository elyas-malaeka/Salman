<?php
/**
 * Contact Page Helper Functions
 * 
 * Functions to fetch content from database for the contact page
 * Updated to use the new system with working hours management
 */

/**
 * Get contact page content by field key and language
 * 
 * @param string $field_key The unique identifier for the content
 * @param string $section_id Optional section identifier
 * @param string $lang Language code (fa, en, ar)
 * @return string The content or empty string if not found
 */
function getContactContent($field_key, $section_id = null, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // Escape input values
    $field_key = mysqli_real_escape_string($db, $field_key);
    
    // Build the query with optional section_id filter
    $query = "SELECT t.content_value 
              FROM temp_contact_content c
              JOIN temp_contact_translations t ON c.content_id = t.content_id
              WHERE c.field_key = '{$field_key}' 
              AND t.language_id = '{$lang}'";
    
    if ($section_id) {
        $section_id = mysqli_real_escape_string($db, $section_id);
        $query .= " AND c.section_id = '{$section_id}'";
    }
    
    $query .= " AND c.is_active = 1 LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content_value'];
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
 * Get configuration values from core_config table
 * 
 * @param string $key Config key to retrieve
 * @param string $default Default value if not found
 * @param string $lang Language code (fa, en, ar)
 * @return string Config value or default if not found
 */
function getConfigValue($key, $default = '', $lang = null) {
    global $db;
    
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    
    // First try with language suffix (except for default language fa)
    if ($lang != 'fa') {
        $config_key = $key . '_' . $lang;
        
        $stmt = $db->prepare("SELECT config_value FROM core_config WHERE config_key = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param('s', $config_key);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stmt->close();
                return $row['config_value'];
            }
            $stmt->close();
        }
    }
    
    // If not found with language suffix or using default language, try without suffix
    $stmt = $db->prepare("SELECT config_value FROM core_config WHERE config_key = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('s', $key);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row['config_value'];
        }
        $stmt->close();
    }
    
    return $default;
}

/**
 * Get content from database by field_key and section_id
 * This function checks temp_contact_* tables for most content,
 * but special cases like working_hours are handled differently
 * 
 * @param string $field_key The unique identifier for the content
 * @param string $section_id Optional section identifier
 * @param string $lang Language code (fa, en, ar)
 * @return string The content or empty string if not found
 */
function getDbContent($field_key, $section_id = null, $lang = null) {
    global $db, $current_lang;
    
    if (!$lang) {
        $lang = isset($current_lang['code']) ? $current_lang['code'] : getCurrentLanguage();
    }
    
    // Special case for working hours
    if ($field_key == 'hours_value') {
        return getWorkingHours($lang);
    }
    
    // Try to get from temp_contact tables
    $content = getContactContent($field_key, $section_id, $lang);
    if (!empty($content)) {
        return $content;
    }
    
    // If not found in temp_contact tables, try core_config
    $possible_keys = [
        // Direct mapping
        $field_key,
        // Try some common mappings
        'contact_' . $field_key,
        'social_' . $field_key
    ];
    
    foreach ($possible_keys as $config_key) {
        $config_value = getConfigValue($config_key, '', $lang);
        if (!empty($config_value)) {
            return $config_value;
        }
    }
    
    // If nothing found, return empty string
    return "";
}

/**
 * Function to get and format working hours based on language
 * This function reads from core_config and formats in appropriate language
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return string Formatted working hours text
 */
function getWorkingHours($lang = 'fa') {
    global $db;
    
    // Get working days and hours from core_config
    $days_start = (int)getConfigValue('working_days_start', '1');
    $days_end = (int)getConfigValue('working_days_end', '4');
    $weekday_start = getConfigValue('working_hours_weekdays_start', '7:00');
    $weekday_end = getConfigValue('working_hours_weekdays_end', '14:00');
    $friday_start = getConfigValue('working_hours_friday_start', '7:00');
    $friday_end = getConfigValue('working_hours_friday_end', '12:00');
    $friday_open = (bool)getConfigValue('working_friday_open', '1');
    $weekend_open = (bool)getConfigValue('working_weekend_open', '0');
    
    // Define day names in different languages
    $days = [
        'fa' => ['یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه'],
        'en' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'ar' => ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت']
    ];
    
    // Time format strings
    $time_formats = [
        'fa' => [
            'from_to' => '%s: %s تا %s',
            'closed' => 'تعطیل'
        ],
        'en' => [
            'from_to' => '%s: %s to %s',
            'closed' => 'Closed'
        ],
        'ar' => [
            'from_to' => '%s: %s إلى %s',
            'closed' => 'مغلق'
        ]
    ];
    
    // Convert time to appropriate format based on language
    $format_time = function($time, $lang) {
        if ($lang == 'fa') {
            // Convert to Persian format
            $parts = explode(':', $time);
            $hour = (int)$parts[0];
            $minute = isset($parts[1]) ? $parts[1] : '00';
            
            return $hour . ':' . $minute;
        } else {
            // Check if AM/PM format is needed (English)
            if ($lang == 'en') {
                $parts = explode(':', $time);
                $hour = (int)$parts[0];
                $minute = isset($parts[1]) ? $parts[1] : '00';
                
                $suffix = ($hour >= 12) ? 'PM' : 'AM';
                $hour = ($hour > 12) ? $hour - 12 : $hour;
                $hour = ($hour == 0) ? 12 : $hour;
                
                return $hour . ':' . $minute . ' ' . $suffix;
            }
            
            // For Arabic, use same format as input
            return $time;
        }
    };
    
    // Build working hours text
    $result = '';
    
    // Weekdays
    if ($days_start <= $days_end) {
        $day_start_name = $days[$lang][$days_start];
        $day_end_name = $days[$lang][$days_end];
        
        if ($lang == 'fa' || $lang == 'ar') {
            $day_range = $day_start_name . ' تا ' . $day_end_name;
        } else {
            $day_range = $day_start_name . ' to ' . $day_end_name;
        }
        
        $formatted_start = $format_time($weekday_start, $lang);
        $formatted_end = $format_time($weekday_end, $lang);
        
        $result .= sprintf($time_formats[$lang]['from_to'], $day_range, $formatted_start, $formatted_end) . "\n";
    }
    
    // Friday
    if ($friday_open) {
        $friday_name = $days[$lang][5]; // Friday is index 5
        $formatted_start = $format_time($friday_start, $lang);
        $formatted_end = $format_time($friday_end, $lang);
        
        $result .= sprintf($time_formats[$lang]['from_to'], $friday_name, $formatted_start, $formatted_end) . "\n";
    } else {
        if ($lang == 'fa' || $lang == 'ar') {
            $result .= $days[$lang][5] . ': ' . $time_formats[$lang]['closed'] . "\n";
        } else {
            $result .= $days[$lang][5] . ': ' . $time_formats[$lang]['closed'] . "\n";
        }
    }
    
    // Weekend (Saturday and Sunday)
    if (!$weekend_open) {
        if ($lang == 'fa' || $lang == 'ar') {
            $result .= $days[$lang][6] . ' و ' . $days[$lang][0] . ': ' . $time_formats[$lang]['closed'];
        } else {
            $result .= $days[$lang][6] . ' & ' . $days[$lang][0] . ': ' . $time_formats[$lang]['closed'];
        }
    }
    
    return trim($result);
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
            $response['message'] = getContactContent('success_message', 'modal', $lang);
            
            // Send notification email (optional)
            $to = getConfigValue('contact_email', 'admin@example.com');
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
        $response['message'] = getContactContent('error_message', 'modal', $lang);
        
        // In development environment, you may want to display the exact error
        // $response['message'] = "Error: " . $e->getMessage();
    }
    
    return $response;
}

