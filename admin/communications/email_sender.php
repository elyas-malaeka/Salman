<?php 
require_once '../config/config.php';

// Check admin session
if(!isset($_SESSION['admin-login'])){ 
    header("Location: ../login.php");
    exit();  
}

// Email templates
$templates = mysqli_query($db, "SELECT * FROM email_templates ORDER BY name ASC");

// Handle email sending
$send_status = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_email'])) {
    $recipient_type = $_POST['recipient_type'] ?? '';
    $email_template = $_POST['email_template'] ?? '';
    $custom_subject = mysqli_real_escape_string($db, $_POST['custom_subject'] ?? '');
    $custom_body = mysqli_real_escape_string($db, $_POST['custom_body'] ?? '');
    $subject = '';
    $body = '';
    
    // Get recipients
    $recipients = [];
    
    switch ($recipient_type) {
        case 'all_students':
            // Get all students' parent emails
            $query = "SELECT DISTINCT f.email FROM fathers f UNION SELECT DISTINCT m.email FROM mothers m";
            $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $recipients[] = $row['email'];
            }
            break;
            
        case 'all_parents':
            // Same as all_students in this case
            $query = "SELECT DISTINCT f.email FROM fathers f UNION SELECT DISTINCT m.email FROM mothers m";
            $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $recipients[] = $row['email'];
            }
            break;
            
        case 'pending_registrations':
            // Get emails of parents with pending registrations
            $query = "SELECT DISTINCT f.email FROM fathers f 
                      JOIN students s ON f.student_id = s.student_id 
                      JOIN registrations r ON s.student_id = r.student_id 
                      WHERE r.registration_status = 'pending'
                      UNION
                      SELECT DISTINCT m.email FROM mothers m 
                      JOIN students s ON m.student_id = s.student_id 
                      JOIN registrations r ON s.student_id = r.student_id 
                      WHERE r.registration_status = 'pending'";
            $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $recipients[] = $row['email'];
            }
            break;
            
        case 'grade':
            $grade = intval($_POST['grade'] ?? 0);
            if ($grade > 0) {
                // Get parents of students in specific grade
                $query = "SELECT DISTINCT f.email FROM fathers f 
                          JOIN students s ON f.student_id = s.student_id 
                          WHERE s.academic_grade = $grade
                          UNION
                          SELECT DISTINCT m.email FROM mothers m 
                          JOIN students s ON m.student_id = s.student_id 
                          WHERE s.academic_grade = $grade";
                $result = mysqli_query($db, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $recipients[] = $row['email'];
                }
            }
            break;
            
        case 'custom':
            // Custom email addresses
            $custom_emails = $_POST['custom_emails'] ?? '';
            $email_list = explode(',', $custom_emails);
            foreach ($email_list as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $recipients[] = $email;
                }
            }
            break;
    }
    
    // Get email content based on template or custom
    if ($email_template != 'custom' && !empty($email_template)) {
        $template_query = mysqli_query($db, "SELECT * FROM email_templates WHERE id = " . intval($email_template));
        if ($template = mysqli_fetch_assoc($template_query)) {
            $subject = $template['subject'];
            $body = $template['body'];
        }
    } else {
        $subject = $custom_subject;
        $body = $custom_body;
    }
    
    // Send emails
    if (!empty($recipients) && !empty($subject) && !empty($body)) {
        $sent_count = 0;
        foreach ($recipients as $email) {
            // Log emails to be sent (in a real app, you'd use a proper email sending method)
            $recipient_email = mysqli_real_escape_string($db, $email);
            mysqli_query($db, "INSERT INTO sent_emails (recipient, subject, body, status) VALUES ('$recipient_email', '$subject', '$body', 'sent')");
            $sent_count++;
        }
        
        // Log activity
        $user_id = $_SESSION['admin_id'] ?? 0;
        $action_description = "ایمیل با موضوع '$subject' به $sent_count گیرنده ارسال شد";
        mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES ($user_id, 'send_email', '$action_description', '{$_SERVER['REMOTE_ADDR']}')");
        
        $send_status = 'success';
    } else {
        $send_status = 'error';
    }
}

// Get academic grades for dropdown
$grades = mysqli_query($db, "SELECT * FROM academic_grades ORDER BY grade_number");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ارسال ایمیل - مجتمع آموزشی سلمان</title>
    <link href="../assets/Media/logo/logo.png" rel="shortcut icon">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>
<body class="g-sidenav-show rtl bg-gray-100">
    <?php include '../includes/sidebar.php'; ?>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../includes/navbar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php if($send_status == 'success'): ?>
            <div class="alert alert-success text-white">
                ایمیل با موفقیت ارسال شد.
            </div>
            <?php elseif($send_status == 'error'): ?>
            <div class="alert alert-danger text-white">
                خطا در ارسال ایمیل. لطفاً گیرنده، موضوع و متن ایمیل را بررسی کنید.
            </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>ارسال ایمیل</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <!-- Recipients Section -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient_type">گیرندگان</label>
                                            <select class="form-control" id="recipient_type" name="recipient_type" onchange="toggleRecipientOptions()">
                                                <option value="all_students">همه دانش‌آموزان</option>
                                                <option value="all_parents">همه والدین</option>
                                                <option value="pending_registrations">ثبت‌نام‌های در انتظار</option>
                                                <option value="grade">پایه تحصیلی خاص</option>
                                                <option value="custom">ایمیل‌های سفارشی</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Grade selection (hidden by default) -->
                                        <div class="form-group mt-3" id="grade_section" style="display: none;">
                                            <label for="grade">انتخاب پایه تحصیلی</label>
                                            <select class="form-control" id="grade" name="grade">
                                                <?php while($grade = mysqli_fetch_assoc($grades)): ?>
                                                    <option value="<?php echo $grade['grade_number']; ?>"><?php echo $grade['grade_name']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        
                                        <!-- Custom emails (hidden by default) -->
                                        <div class="form-group mt-3" id="custom_emails_section" style="display: none;">
                                            <label for="custom_emails">ایمیل‌ها (با کاما جدا کنید)</label>
                                            <textarea class="form-control" id="custom_emails" name="custom_emails" rows="3" placeholder="example1@example.com, example2@example.com"></textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- Template Section -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_template">قالب ایمیل</label>
                                            <select class="form-control" id="email_template" name="email_template" onchange="toggleCustomTemplate()">
                                                <?php while($template = mysqli_fetch_assoc($templates)): ?>
                                                    <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                                                <?php endwhile; ?>
                                                <option value="custom">قالب سفارشی</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Custom Template (hidden by default) -->
                                <div id="custom_template_section" style="display: none;">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="custom_subject">موضوع</label>
                                                <input type="text" class="form-control" id="custom_subject" name="custom_subject" placeholder="موضوع ایمیل را وارد کنید">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="custom_body">متن ایمیل</label>
                                                <textarea class="form-control" id="custom_body" name="custom_body" rows="10" placeholder="متن ایمیل را وارد کنید"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <button type="submit" name="send_email" class="btn btn-primary">ارسال ایمیل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include '../includes/footer.php'; ?>
        </div>
    </main>
    
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    
    <script>
        // Toggle recipient options based on selection
        function toggleRecipientOptions() {
            const recipientType = document.getElementById('recipient_type').value;
            const gradeSection = document.getElementById('grade_section');
            const customEmailsSection = document.getElementById('custom_emails_section');
            
            gradeSection.style.display = (recipientType === 'grade') ? 'block' : 'none';
            customEmailsSection.style.display = (recipientType === 'custom') ? 'block' : 'none';
        }
        
        // Toggle custom template fields
        function toggleCustomTemplate() {
            const templateType = document.getElementById('email_template').value;
            const customTemplateSection = document.getElementById('custom_template_section');
            
            customTemplateSection.style.display = (templateType === 'custom') ? 'block' : 'none';
        }
    </script>
</body>
</html>