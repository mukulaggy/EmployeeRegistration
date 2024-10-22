<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'employee_db');

// Create database connection
function getConnection() {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    if (!mysqli_query($conn, $sql)) {
        die("Error creating database: " . mysqli_error($conn));
    }

    // Select database
    mysqli_select_db($conn, DB_NAME);

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(15),
        department VARCHAR(50),
        position VARCHAR(50),
        hire_date DATE,
        salary DECIMAL(10,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql)) {
        die("Error creating table: " . mysqli_error($conn));
    }

    return $conn;
}
?>