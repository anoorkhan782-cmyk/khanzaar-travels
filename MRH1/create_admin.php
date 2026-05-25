<?php
include 'config.php';

$name = 'Admin';
$email = 'admin@example.com';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$user_type = 'admin';

// Check if already exists
$check = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email'");

if(mysqli_num_rows($check) > 0){
    // Update existing one just in case
    mysqli_query($connection, "UPDATE `users` SET password = '$password', user_type = 'admin' WHERE email = '$email'");
    echo "<h1>Admin user updated successfully!</h1>";
    echo "<p>You can now login at <a href='login.php'>login.php</a> with:</p>";
    echo "<ul><li><b>Email:</b> admin@example.com</li><li><b>Password:</b> admin123</li></ul>";
} else {
    // Insert new
    mysqli_query($connection, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$password', '$user_type')");
    echo "<h1>Admin user created successfully!</h1>";
    echo "<p>You can now login at <a href='login.php'>login.php</a> with:</p>";
    echo "<ul><li><b>Email:</b> admin@example.com</li><li><b>Password:</b> admin123</li></ul>";
}
?>
