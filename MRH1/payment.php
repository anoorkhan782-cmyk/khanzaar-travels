<?php
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name   = trim($_POST['name']);
    $card   = trim($_POST['card']);
    $expiry = trim($_POST['expiry']);
    $cvv    = trim($_POST['cvv']);

    // Basic Validations
    if(empty($name) || empty($card) || empty($expiry) || empty($cvv)){
        $error = "All fields are required.";
    }
    else if(!preg_match("/^[0-9]{16}$/", $card)){
        $error = "Card number must be 16 digits.";
    }
    else if(!preg_match("/^[0-9]{3}$/", $cvv)){
        $error = "CVV must be 3 digits.";
    }
    else if(strtotime($expiry . "-01") < strtotime(date("Y-m") . "-01")){
        $error = "Your card is expired.";
    }
    else {
        // Payment success (demo)
        header("Location: payment_success.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Gateway (Demo)</title>
    <style>
        body {
            font-family: Arial;
            background:#f4f4f4;
            padding:40px;
        }
        .pay-box {
            width:350px;
            margin:auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px lightgrey;
        }
        input {
            width:100%;
            padding:10px;
            margin:8px 0;
            border-radius:5px;
            border:1px solid #ccc;
        }
        button {
            width:100%;
            padding:12px;
            background:#28a745;
            color:white;
            border:none;
            border-radius:5px;
        }
        .error {
            background:#ffcccc;
            padding:10px;
            border-left:5px solid red;
            margin-bottom:10px;
        }
    </style>
</head>
<body>

<div class="pay-box">
    <h2>Payment (Demo)</h2>

    <?php if(!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="POST">

        <label>Card Holder Name</label>
        <input type="text" name="name" required>

        <label>Card Number</label>
        <input type="text" name="card" maxlength="16" required>

        <label>Expiry Date</label>
        <input type="month" name="expiry" required>

        <label>CVV</label>
        <input type="password" name="cvv" maxlength="3" required>

        <button type="submit">Pay Now</button>
    </form>
</div>

</body>
</html>

