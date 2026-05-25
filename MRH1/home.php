<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- custom css link -->
    <link rel="stylesheet" href="Style2.css">
</head>

<body>

    <!-- Header section -->
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

    <!-- Home section -->
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide" style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url('1.jpg');">
                    <div class="content">
                        <span>Explore, discover, travel</span>
                        <h3>Travel around Pakistan</h3>
                        <a href="pakage.php" class="btn">Discover more</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url('2.jpg');">
                    <div class="content">
                        <span>Explore, discover, travel</span>
                        <h3>Travel around the world</h3>
                        <a href="pakage.php" class="btn">Discover more</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url('3.jpg');">
                    <div class="content">
                        <span>Explore, discover, travel</span>
                        <h3>Travel around the world</h3>
                        <a href="pakage.php" class="btn">Discover more</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url('4.jpg');">
                    <div class="content">
                        <span>Explore, discover, travel</span>
                        <h3>Travel around the world</h3>
                        <a href="pakage.php" class="btn">Discover more</a>
                    </div>
                </div>

            </div>

            <!-- Swiper arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>
    </section>

    <!-- BDS Section -->
    <section class="services" style="text-align:center;">
        <h1 class="heading-title">Beidou Navigation System (BDS)</h1>
        <p style="font-size:1.8rem; color:var(--light-black); margin-bottom: 2rem;">Get your precise location using the global BDS network.</p>
        
        <button id="locationButton" onclick="getLocation()" 
        style="padding:15px 30px; background:var(--main-color); color:white; border:none; border-radius:5px; font-size:1.8rem; cursor:pointer;">
            <i class="fas fa-map-marker-alt"></i> Use BDS Location
        </button>

        <p id="output" style="margin-top:15px; font-size:1.6rem;"></p>

        <div id="map" style="width:100%; height:300px; margin-top:10px; border:1px solid #ccc; border-radius:10px; overflow:hidden;"></div>
    </section>

    <script src="gps.js"></script>


    <!-- Packages section -->
    <section class="home-package">
        <h1 class="heading-title">Our Packages</h1>

        <div class="box-container">
            <?php
                $select_home_packages = mysqli_query($connection, "SELECT * FROM `packages` ORDER BY id DESC LIMIT 3");
                while($row = mysqli_fetch_assoc($select_home_packages)){
            ?>
            <div class="box">
                <div class="image">
                    <img src="<?php echo $row['image']; ?>" alt="">
                </div>
                <div class="content">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo substr($row['description'], 0, 100); ?>...</p>
                    <a href="book.php" class="btn">Book now</a>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="load-more"><a href="pakage.php" class="btn">Load more</a></div>
    </section>

   <!-- Services Section -->
<section class="services" id="services">
    <h1 class="heading-title">Our Services</h1>

    <div class="box-container">

        <div class="box">
            <div class="img-wrapper">
                <img src="adventure.jpg" alt="Adventure Service">
            </div>
            <h3>Adventure</h3>
        </div>

        <div class="box">
            <div class="img-wrapper">
                <img src="tour guide.jpg" alt="Tour Guide">
            </div>
            <h3>Tour Guide</h3>
        </div>

        <div class="box">
            <div class="img-wrapper">
                <img src="tracking.jpg" alt="Tracking">
            </div>
            <h3>Tracking</h3>
        </div>

        <div class="box">
            <div class="img-wrapper">
                <img src="fire.jpg" alt="Camp Fire">
            </div>
            <h3>Camp Fire</h3>
        </div>

        <div class="box">
            <div class="img-wrapper">
                <img src="off road.jpg" alt="Off Road"> 
            </div>
            <h3>Off Road</h3>
        </div>

        <div class="box">
            <div class="img-wrapper">
                <img src="camping.jpg" alt="Camping">
            </div>
            <h3>Camping</h3>
        </div>

    </div>
</section>

    <!-- Home about section -->
    <section class="home-about">
        <div class="image">
            <img src="travel6.jpg" alt="">
        </div>

        <div class="content">
            <h3>About Us</h3>
            <p>“We are a trusted travel platform dedicated to making journeys simple, 
                comfortable, and affordable. Our goal is to provide reliable travel services with the best deals,
                helping customers explore more while spending less</p>

            <a href="about.php" class="btn">Read more</a>
        </div>
    </section>

    <!-- Offer section -->
    <section class="home-offer">
        <div class="content">
            <h3>Up to 50% off</h3>
            <p>“To make travel more accessible and budget-friendly, 
                we are offering an exclusive 50% discount as part of our promotional campaign. Book now and enjoy reliable,
                comfortable travel at an affordable price for a limited time.”</p>

            <a href="book.php" class="btn">Book now</a>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Swiper JS MUST be before your script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- custom js -->
    <script src="script.js"></script>

</body>
</html>
/html>