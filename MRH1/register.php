<?php
include 'config.php';

$message = [];

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($connection, $_POST['name']);
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $user_type = 'user'; // Default to user

   $select = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email'") or die('Query Failed (Select): ' . mysqli_error($connection));

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   }else{
      mysqli_query($connection, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')") or die('Query Failed (Insert): ' . mysqli_error($connection));
      $message[] = 'Registered successfully! <a href="login.php">Login now</a>';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="Style2.css">
   <style>
      .form-container {
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         background: var(--light-bg);
         padding: 2rem;
      }
      .form-container form {
         width: 50rem;
         background: var(--white);
         padding: 2rem;
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         text-align: center;
      }
      .form-container form h3 {
         font-size: 2.5rem;
         margin-bottom: 1rem;
         color: var(--black);
         text-transform: uppercase;
      }
      .form-container form .box {
         width: 100%;
         margin: 1rem 0;
         padding: 1.2rem 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
         border: var(--border);
         text-transform: none;
      }
      .form-container form p {
         font-size: 1.8rem;
         margin-top: 1.5rem;
         color: var(--light-black);
      }
      .form-container form p a {
         color: var(--main-color);
      }
      .message {
         margin: 1rem 0;
         padding: 1rem;
         background: var(--main-color);
         color: var(--white);
         font-size: 1.8rem;
         border-radius: .5rem;
      }
   </style>
</head>
<body>

<section class="header">
   <a href="home.php" class="Logo">Khanzaar Travels</a>
   <nav class="Navbar">
      <a href="home.php">Home</a>
      <a href="about.php">About</a>
      <a href="pakage.php">Package</a>
      <a href="book.php">Book</a>
   </nav>
</section>

<div class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(!empty($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="Enter name" class="box" required>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="password" name="password" placeholder="Enter password" class="box" required>
      <input type="submit" name="submit" value="Register Now" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>
</div>

<?php include 'footer.php'; // I should check if footer.php exists or just copy the footer code ?>

</body>
</html>
