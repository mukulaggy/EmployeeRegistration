<?php
require_once __DIR__ . '/../config/database.php';  // Use __DIR__ for reliable path resolution

function connectDB() {
    return getConnection();
}
?>