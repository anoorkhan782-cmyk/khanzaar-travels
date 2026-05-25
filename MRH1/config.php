<?php

// Database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'book_db';

// Create connection
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$connection) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
