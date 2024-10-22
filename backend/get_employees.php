<?php
require_once __DIR__ . '/db_connection.php';  // Fix path to db_connection.php

function getEmployees() {
    $conn = connectDB();
    $sql = "SELECT * FROM employees ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $employees = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
    
    mysqli_close($conn);
    return $employees;
}
?>
