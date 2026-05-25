<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package</title>
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
    <h1>Packages</h1>
</div>

<!-- packages section start -->
<section class="packages">
    <h1 class="heading-title">Top destinations</h1>
    <div class="box-container">
        <?php
            $select_packages = mysqli_query($connection, "SELECT * FROM `packages` ORDER BY id DESC");
            if(mysqli_num_rows($select_packages) > 0){
                while($row = mysqli_fetch_assoc($select_packages)){
        ?>
        <div class="box">
            <div class="image">
                <img src="<?php echo $row['image']; ?>" alt="">
            </div>
            <div class="content">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?><br>
                   <b>Duration:</b> <?php echo $row['duration']; ?><br>
                   <b>Price:</b> PKR <?php echo $row['price']; ?></p>
                <a href="book.php" class="btn">Book now</a>
            </div>
        </div>
        <?php
                }
            } else {
                echo '<p class="empty" style="font-size:2rem; text-align:center; width:100%;">No packages available yet!</p>';
            }
        ?>
    </div>
    <!-- <div class="load-more"><span class="btn">Load more</span></div> -->
</section>
<!-- packages section end -->

    <?php include 'footer.php'; ?>

    <!-- custom js link  -->
    <script src="script.js"></script>

    <!-- Swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>