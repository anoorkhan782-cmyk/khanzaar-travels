<?php
include 'config.php';

// If user is logged in, automatically approve their latest pending payment booking
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    mysqli_query($connection, "UPDATE `book_forms` SET status = 'approved' WHERE user_id = '$user_id' AND status = 'Pending Payment' ORDER BY id DESC LIMIT 1");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial;
            background:#eafbea;
            text-align:center;
            padding-top:100px;
        }
        .msg {
            background:white;
            width:400px;
            margin:auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px lightgrey;
        }
        a {
            display:inline-block;
            margin-top:20px;
            padding:10px 20px;
            background:#007bff;
            color:white;
            border-radius:5px;
            text-decoration:none;
        }
    </style>
</head>
<body>

<div class="msg">
    <h2>Payment Successful ✔️</h2>
    <p>Thank you for booking your travel with us!</p>

    <a href="home.php">Return to Home</a>
</div>

</body>
</html>
