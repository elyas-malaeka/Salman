<?php
// process-newsletter.php
header('Content-Type: text/html; charset=utf-8');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salman";

// Get the email from form
$email = filter_var($_POST['EMAIL'], FILTER_SANITIZE_EMAIL);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<span class='error'>Invalid email format. Please enter a valid email address.</span>";
    exit;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<span class='error'>Connection failed. Please try again later.</span>";
    exit;
}

// Set UTF-8 connection
$conn->set_charset("utf8mb4");

// Check if email already exists
$stmt = $conn->prepare("SELECT * FROM newsletter_subscribers WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists
    $subscriber = $result->fetch_assoc();
    
    if ($subscriber['status'] == 'active') {
        echo "<span class='info'>You are already subscribed to our newsletter!</span>";
    } else {
        // Reactivate subscription if it was inactive
        $updateStmt = $conn->prepare("UPDATE newsletter_subscribers SET status = 'active' WHERE id = ?");
        $updateStmt->bind_param("i", $subscriber['id']);
        
        if ($updateStmt->execute()) {
            echo "<span class='success'>Your subscription has been reactivated successfully!</span>";
        } else {
            echo "<span class='error'>Error updating subscription. Please try again later.</span>";
        }
        
        $updateStmt->close();
    }
} else {
    // Insert new subscriber
    $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        echo "<span class='success'>Thank you for subscribing to our newsletter!</span>";
    } else {
        echo "<span class='error'>Error: " . $stmt->error . "</span>";
    }
}

$stmt->close();
$conn->close();
?>