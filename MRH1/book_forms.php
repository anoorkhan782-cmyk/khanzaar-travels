<?php
include 'config.php';

// FORM SUBMISSION
if(isset($_POST['send'])){

    // Receive input
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $address  = trim($_POST['address']);
    $location = trim($_POST['location']);
    $guests   = trim($_POST['guests']);
    $arrival  = trim($_POST['arrival']);
    $leaving  = trim($_POST['leaving']);
    $user_id  = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // ---------------------------
    // VALIDATION
    // ---------------------------

    $errors = [];

    // Empty field check
    if(empty($name) || empty($email) || empty($phone) || empty($address) || 
       empty($location) || empty($guests) || empty($arrival) || empty($leaving)){
        $errors[] = "All fields are required.";
    }

    // Email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }

    // Phone must be numeric
    if(!is_numeric($phone)){
        $errors[] = "Phone number must be numeric.";
    }

    // Guests must be numeric
    if(!is_numeric($guests)){
        $errors[] = "Guests field must be a number.";
    }

    // Date validation
    if(strtotime($arrival) === false || strtotime($leaving) === false){
        $errors[] = "Invalid date format.";
    }

    // Arrival cannot be after leaving
    if(strtotime($arrival) > strtotime($leaving)){
        $errors[] = "Arrival date cannot be greater than leaving date.";
    }

    // ---------------------------
    // If validation errors found
    // ---------------------------
    if(!empty($errors)){
        echo "<h3 style='color:red;'>Errors Found:</h3><ul>";
        foreach($errors as $error){
            echo "<li>$error</li>";
        }
        echo "</ul>";
        exit;
    }

    // ----------------------------------
    // INSERT DATA USING PREPARED STATEMENT
    // ----------------------------------
    $stmt = mysqli_prepare(
        $connection,
        "INSERT INTO book_forms(user_id, name, email, phone, address, location, guests, arrival, leaving, status) 
         VALUES (?,?,?,?,?,?,?,?,?, 'Pending Payment')"
    );

    mysqli_stmt_bind_param($stmt, "issssssss",
        $user_id, $name, $email, $phone, $address, $location, $guests, $arrival, $leaving
    );

    if(mysqli_stmt_execute($stmt)){
        echo "<h2>Booking Successful!</h2>";
        echo "<p>Your booking information has been saved.</p>";
        echo '<a href="payment.php" 
                style="
                    display:inline-block;
                    margin-top:20px;
                    padding:12px 20px;
                    background:#ff6600;
                    color:white;
                    text-decoration:none;
                    border-radius:5px;
                    font-size:18px;">
                Proceed to Payment
              </a>';
    } else {
        echo "<h3 style='color:red;'>Error saving booking:</h3> " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
}
else {
    echo "Something went wrong, try again.";
}

?>

