<?php
// Database configuration
$host = 'localhost';
$dbname = 'MeandYou';
$username = 'root';
$password = '';

// PDO connection options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
    
    // Remove debug output in production
    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        echo "Database connection successful!";
        
        // Debug: Check table structure
        $stmt = $pdo->query("DESCRIBE music");
        echo "<pre>";
        while ($row = $stmt->fetch()) {
            print_r($row);
        }
        echo "</pre>";
    }
} catch (PDOException $e) {
    // Log error (in production, don't display detailed error messages)
    error_log("Database connection failed: " . $e->getMessage());
    die("Could not connect to the database. Please try again later.");

}
?>