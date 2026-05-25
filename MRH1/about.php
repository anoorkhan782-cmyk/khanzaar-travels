<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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
    <h1>About Us</h1>
</div>
<section class="about">
    <div class="image">
        <img src="about23.jpg" alt="">
    </div>
    <div class="content">
        <h3>WHy choose us?</h3>
        <p>Experience the best of Pakistan with our carefully crafted tours. Enjoy comfortable travel, expert local guides, 
            and handpicked hotels while exploring scenic landscapes, cultural landmarks, and exciting adventures.
             Our flexible packages and 24/7 support ensure a smooth, memorable, and worry-free journey every time.</p>
        <p>Discover Pakistan’s beauty with expert guides, comfy travel, and unforgettable experiences.</p>    
        <div class="icons-container">
            <div class="icons">
                <i class="fa fa-map"></i>
                <span>Top destinations</span>
            </div>
            <div class="icons">
                <i class="fa fa-hand-holding-usd"></i>
                <span>Affordable price</span>
            </div>
            <div class="icons">
                <i class="fa fa-headset"></i>
                <span>24/7 guide service</span>
            </div>
        </div>    
    </div>
</section>

<!--review section start -->
<section class="reviews">
    <h1 class="heading-title">Clients review</h1>
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slider slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>“Our trip was absolutely amazing! The itinerary was perfectly planned, the guides were knowledgeable, 
                    and every detail was taken care of. We felt safe, comfortable, and truly enjoyed every moment of the journey.”</p>
                <h3>Ayesha</h3>
                <span>Traveller</span>
                <img src="reviews.jpg" alt="">
            </div>
            <div class="swiper-slider slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>“This travel service exceeded our expectations. The hotels were clean and cozy, transportation was smooth, 
                    and the local guides gave us fascinating insights about each city.
                    Highly recommend for anyone looking to explore Pakistan hassle-free.”</p>
                <h3>Noor</h3>
                <span>Traveller</span>
                <img src="reviews.jpg" alt="">
            </div>
            <div class="swiper-slider slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>“From start to finish, the tour was fantastic. Scenic views, cultural experiences,
                    and adventure activities were all included. The staff were friendly and helpful,
                    making the entire trip stress-free and memorable.”</p>
                <h3>Laiba</h3>
                <span>Traveller</span>
                <img src="reviews.jpg" alt="">
            </div>
            <div class="swiper-slider slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>“I loved how well-organized the entire journey was. Each city had its own charm, and the guides ensured 
                    we didn’t miss any highlights. Comfortable travel, good food,
                    and excellent support made this an unforgettable experience.”</p>
                <h3>ALi</h3>
                <span>Traveller</span>
                <img src="reviews.jpg" alt="">
            </div>
            <div class="swiper-slider slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>“A wonderful travel experience! The blend of sightseeing, cultural exploration,
                    and relaxation was perfect. Everything from hotel stays to local transport was handled professionally,
                    and the team’s dedication really stood out.”</p>
                <h3>Abd-ul-Rehman</h3>
                <span>Traveller</span>
                <img src="reviews.jpg" alt="">
            </div>
        </div>
    </div>
</section>

    <?php include 'footer.php'; ?>

    <!-- custom js link  -->
    <script src="script.js"></script>

    <!-- Swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>