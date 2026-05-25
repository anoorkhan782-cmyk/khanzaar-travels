<?php
include 'config.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
   header('location:login.php');
   exit;
}

$user_name = $_SESSION['user_name'];
// Note: We might want to fetch email from DB if not in session, 
// but for now I'll just let them fill it or I can update login.php to store it.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <!-- Swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css link -->
    <link rel="stylesheet" href="Style2.css">
</head>
<body>
    <section class="header">
        <a href="home.php" class="Logo">Khanzaar Travels</a>

        <nav class="Navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="pakage.php">Package</a>
            <a href="book.php">Book</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if($_SESSION['user_type'] == 'admin'): ?>
                    <a href="admin_dashboard.php">Dashboard</a>
                <?php else: ?>
                    <a href="user_dashboard.php">Dashboard</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>

        <menu id="menu-btn" class="fas fa-bars"></menu>
    </section>

<div class="heading" Style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url('about.jpg') no-repeat">
    <h1>Book Now</h1>
</div>

<section class="booking">
    <h1 class="heading-title">Book your trip!</h1>

<form action="book_forms.php" method="post" class="book-form">
    <div class="flex">
        <div class="inputBox">
            <span>Name</span>
            <input type="text" placeholder="enter your name" name="name" value="<?php echo $user_name; ?>">
        </div>
        <div class="inputBox">
            <span>email</span>
            <input type="text" placeholder="enter your email" name="email">
        </div>
        <div class="inputBox">
            <span>Phone</span>
            <input type="number" placeholder="enter your number" name="phone">
        </div>
        <div class="inputBox">
            <span>Address</span>
            <input type="text" placeholder="enter your Address" name="address">
        </div>
        <div class="inputBox">
            <span>Where to</span>
            <input type="text" placeholder="Place you want to visit" name="location">
        </div>
        <div class="inputBox">
            <span>How many persons/guests</span>
            <input type="text" placeholder="No of guests" name="guests">
        </div>
        <div class="inputBox">
            <span>Arrival</span>
            <input type="date"  name="arrival">
        </div>
        <div class="inputBox">
            <span>Leaving</span>
            <input type="date"  name="leaving">
        </div>
    </div>
    <input type="submit" value="submit" class="btn" name="send">
</form>
</section>

    <?php include 'footer.php'; ?>

    <!-- custom js link  -->
    <script src="script.js"></script>

    <!-- Swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>