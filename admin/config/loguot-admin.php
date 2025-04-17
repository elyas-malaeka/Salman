<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require_once 'config.php';

// Log the logout activity if we have admin_id
if(isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $log_description = "خروج کاربر از پنل ادمین";
    mysqli_query($db, "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
                      VALUES ('$admin_id', 'logout', '$log_description', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."')");
}

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: ../login.php");
exit();
?>