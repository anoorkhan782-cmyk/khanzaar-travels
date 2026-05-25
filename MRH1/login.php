<?php
include 'config.php';

$message = [];

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $password = $_POST['password'];

   $select = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email' AND user_type = 'user'") or die('Query Failed: ' . mysqli_error($connection));

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      if(password_verify($password, $row['password'])){
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_type'] = $row['user_type'];
         header('location:user_dashboard.php');
      }else{
         $message[] = 'Incorrect password!';
      }
   }else{
      $message[] = 'User account not found!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
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
      <h3>Login Now</h3>
      <?php
      if(!empty($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="password" name="password" placeholder="Enter password" class="box" required>
      <input type="submit" name="submit" value="Login Now" class="btn">
      <p>Don't have an account? <a href="register.php">Register now</a></p>
   </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
