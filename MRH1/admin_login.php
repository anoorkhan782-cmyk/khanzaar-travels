<?php
include 'config.php';

$message = [];

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $password = $_POST['password'];

   $select = mysqli_query($connection, "SELECT * FROM `users` WHERE email = '$email' AND user_type = 'admin'") or die('Query Failed: ' . mysqli_error($connection));

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      if(password_verify($password, $row['password'])){
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_type'] = $row['user_type'];
         header('location:admin_dashboard.php');
      }else{
         $message[] = 'Incorrect password!';
      }
   }else{
      $message[] = 'Admin account not found!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="Style2.css">
   <style>
      .form-container {
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         background: #222;
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
      .message {
         margin: 1rem 0;
         padding: 1rem;
         background: #e74c3c;
         color: var(--white);
         font-size: 1.8rem;
         border-radius: .5rem;
      }
   </style>
</head>
<body>

<div class="form-container">
   <form action="" method="post">
      <i class="fas fa-user-shield" style="font-size: 5rem; color: var(--main-color);"></i>
      <h3>Admin Private Login</h3>
      <?php
      if(!empty($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Admin Email" class="box" required>
      <input type="password" name="password" placeholder="Admin Password" class="box" required>
      <input type="submit" name="submit" value="Login as Admin" class="btn">
      <p style="font-size: 1.6rem; margin-top: 2rem;"><a href="home.php">Back to Website</a></p>
   </form>
</div>

</body>
</html>
