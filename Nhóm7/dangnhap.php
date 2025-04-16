<?php
// filepath: c:\xampp\htdocs\web\Nhóm7\dangnhap.php

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require_once 'includes/db.php';

// Initialize variables
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        // Check if the user exists
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $success = "Login successful! Redirecting...";
            header("Refresh: 2; url=index.php"); // Redirect to homepage after 2 seconds
            exit;
        } else {
            // Invalid credentials
            $error = "Invalid email or password.";
        }
    } catch (PDOException $e) {
        $error = "An error occurred. Please try again later.";
        error_log("Login error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="stylesdangky+dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="info-box">
            <h1>Join Our Platform</h1>
            <p>You can be one of the <span class="highlight">members</span> of our platform by just adding some necessary information. If you already have an account on our website, you can just hit the <a href="dangnhap.php" class="login-link">Login button</a>.</p>
        </div>
        <div class="form-container">
            <div class="form-header">
                <a href="dangky.php" class="form-header-link">Sign Up</a>
                <a href="dangnhap.php" class="form-header-link active">Login</a>
            </div>

            <!-- Display error or success messages -->
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form action="dangnhap.php" method="post">
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
                </div>
                
                <div class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                
                <button type="submit" class="form-button">Login</button>
            </form>
            <div class="separator">Or</div>
            <button class="google-button">
                <img src="images/google.png" class="google-icon" width="20px" height="20px"/>
                Login With Google
            </button>
        </div>
    </div>
</body>
</html>