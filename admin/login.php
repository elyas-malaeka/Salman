<?php
require_once 'config/config.php';

// Check if user is already logged in
if(isset($_SESSION['admin-login'])) {
    header("Location: index.php");
    exit();
}
// Handle login form submission
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = $_POST['password'];
    
    // Get user from database
    $query = "SELECT * FROM users WHERE username='$username' AND status='active'";
    $result = mysqli_query($db, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password with stored hash
        if(password_verify($password, $user['password_hash'])) {
            // Set session
            $_SESSION['admin-login'] = $username;
            $_SESSION['admin_id'] = $user['user_id'];
            $_SESSION['role_id'] = $user['role_id'];
            
            // Log activity
            $log_description = "ورود کاربر به پنل ادمین";
            mysqli_query($db, "INSERT INTO logs (user_id, action, entity, ip_address, user_agent) 
                                VALUES ('".$user['user_id']."', 'login', 'admin_panel', 
                                '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."')");
            
            // Redirect to dashboard
            header("Location: index.php");
            exit();
        } else {
            $error = "نام کاربری یا رمز عبور اشتباه است.";
        }
    } else {
        $error = "نام کاربری یا رمز عبور اشتباه است.";
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به پنل مدیریت - مجتمع آموزشی سلمان فارسی</title>
    <link href="assets/Media/logo/logo.png" rel="shortcut icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @font-face {
            font-family: 'Estedad';
            src: url('assets/Media/font/estedad/Estedad-Regular.ttf') format('truetype');
            font-weight: normal;
        }
        
        @font-face {
            font-family: 'Estedad';
            src: url('assets/Media/font/estedad/Estedad-Bold.ttf') format('truetype');
            font-weight: bold;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Estedad', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url("assets/Media/bg.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            direction: rtl;
            color: #333;
        }
        
        .login-wrapper {
            display: flex;
            width: 900px;
            max-width: 95%;
            height: 550px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }
        
        .login-left {
            width: 50%;
            background-image: linear-gradient(to bottom, rgba(14, 29, 120, 0.8), rgba(28, 107, 238, 0.8)), url('assets/Media/photo-bg/school-pattern.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('assets/Media/photo-bg/pattern-dots.png');
            opacity: 0.1;
        }
        
        .login-logo {
            position: relative;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-logo img {
            width: 350px;
            height: 70px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 5px;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .login-intro {
            position: relative;
            text-align: center;
        }
        
        .login-intro h1 {
            font-size: 26px;
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .login-intro p {
            font-size: 15px;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .login-features {
            position: relative;
            margin-top: 40px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
        }
        
        .feature-text {
            font-size: 14px;
        }
        
        .login-right {
            width: 50%;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-header h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .login-header p {
            font-size: 14px;
            color: #666;
        }
        
        .login-form {
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #6b7280;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
            padding-right: 40px;
            background-color: #f9fafb;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: white;
        }
        
        .password-toggle {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
        }
        
        .btn-login {
            display: block;
            width: 100%;
            padding: 12px;
            background: #1a56db;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 30px;
        }
        
        .btn-login:hover {
            background: #1e429f;
            transform: translateY(-2px);
        }
        
        .login-footer {
            text-align: center;
            margin-top: auto;
        }
        
        .back-to-site {
            display: inline-flex;
            align-items: center;
            color: #4f46e5;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .back-to-site:hover {
            color: #4338ca;
        }
        
        .back-to-site i {
            margin-left: 5px;
        }
        
        .copyright {
            font-size: 12px;
            color: #6b7280;
            margin-top: 10px;
        }
        
        .alert {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }
        
        .alert i {
            margin-left: 10px;
            font-size: 16px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                height: auto;
            }
            
            .login-left, .login-right {
                width: 100%;
            }
            
            .login-left {
                padding: 30px;
                order: 1;
                border-radius: 0 0 20px 20px;
            }
            
            .login-right {
                padding: 30px;
                order: 0;
            }
            
            .login-features {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Side - Brand & Features -->
        <div class="login-left">
            <div class="login-logo">
                <img src="assets/Media/logo/farsi-logo-bg.png" alt="مجتمع آموزشی سلمان">
            </div>
            
            <div class="login-intro">
                <p>سامانه مدیریت یکپارچه برای ارائه خدمات آموزشی با کیفیت</p>
            </div>
            
            <div class="login-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="feature-text">مدیریت دانش‌آموزان و روند ثبت‌نام</div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="feature-text">کنترل کارکنان و سوابق آموزشی</div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="feature-text">انتشار اخبار و مدیریت محتوای وب‌سایت</div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>ورود به پنل مدیریت</h2>
                <p>برای دسترسی به بخش مدیریت وارد شوید</p>
            </div>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo $error; ?></span>
                </div>
            <?php endif; ?>
            
            <form class="login-form" method="POST" action="">
                <div class="form-group">
                    <label for="username" class="form-label">نام کاربری</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" id="username" name="username" placeholder="نام کاربری خود را وارد کنید" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">رمز عبور</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور خود را وارد کنید" required>
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>
                
                <button type="submit" name="login" class="btn-login">
                    <i class="fas fa-sign-in-alt ml-2"></i>
                    ورود به پنل مدیریت
                </button>
            </form>
            
            <div class="login-footer">
                <a href="../index.php" class="back-to-site">
                    <i class="fas fa-home"></i>
                    بازگشت به وب‌سایت
                </a>
                <p class="copyright">&copy; <?php echo date('Y'); ?> - تمامی حقوق برای مجتمع آموزشی سلمان محفوظ است.</p>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("toggleIcon");
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
        
        // Auto hide alerts after 5 seconds
        window.setTimeout(function() {
            var alerts = document.getElementsByClassName('alert');
            if(alerts.length > 0) {
                alerts[0].style.transition = 'opacity 0.5s linear';
                alerts[0].style.opacity = 0;
                setTimeout(function() {
                    alerts[0].style.display = 'none';
                }, 500);
            }
        }, 5000);
    </script>
</body>
</html>