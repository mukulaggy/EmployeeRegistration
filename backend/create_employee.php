<?php
require_once 'db_connection.php';
require_once 'validate.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectDB();
    
    $first_name = validateInput($_POST['first_name']);
    $last_name = validateInput($_POST['last_name']);
    $email = validateInput($_POST['email']);
    $phone = validateInput($_POST['phone']);
    $department = validateInput($_POST['department']);
    $position = validateInput($_POST['position']);
    $hire_date = validateInput($_POST['hire_date']);
    $salary = validateInput($_POST['salary']);

    if (!validateEmail($email)) {
        die("Invalid email format");
    }

    if (!validatePhone($phone)) {
        die("Invalid phone format");
    }

    $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, phone, department, position, hire_date, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssd", $first_name, $last_name, $email, $phone, $department, $position, $hire_date, $salary);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=1");
    } else {
        header("Location: ../index.php?error=1");
    }

    $stmt->close();
    $conn->close();
}
?>
