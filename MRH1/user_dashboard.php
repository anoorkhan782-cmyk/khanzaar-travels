<?php
include 'config.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];
$bookings_query = mysqli_query($connection, "SELECT * FROM `book_forms` WHERE user_id = '$user_id' ORDER BY id DESC") or die('Query Failed: ' . mysqli_error($connection));
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Profile - Khanzaar Travels</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="Style2.css">
   <style>
      .dashboard {
         padding: 5rem 10%;
         background: var(--light-bg);
         min-height: 80vh;
      }
      .user-header {
         background: var(--white);
         padding: 3rem;
         border-radius: 10px;
         box-shadow: var(--box-shadow);
         margin-bottom: 3rem;
         display: flex;
         align-items: center;
         gap: 2rem;
      }
      .user-header .avatar {
         height: 10rem;
         width: 10rem;
         background: var(--main-color);
         color: white;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 5rem;
         border-radius: 50%;
      }
      .user-header h1 { font-size: 3rem; color: var(--black); }
      .user-header p { font-size: 1.6rem; color: var(--light-black); }

      .table-container {
         background: var(--white);
         padding: 2rem;
         border-radius: 10px;
         box-shadow: var(--box-shadow);
         overflow-x: auto;
      }
      table { width: 100%; border-collapse: collapse; font-size: 1.6rem; }
      th, td { padding: 1.5rem; text-align: left; border-bottom: 1px solid #eee; }
      th { background: #f9f9f9; color: var(--black); }

      .status {
          padding: 0.5rem 1rem;
          border-radius: 20px;
          font-size: 1.2rem;
          font-weight: bold;
          text-transform: uppercase;
      }
      .status.pending { background: #ffeaa7; color: #d6a312; }
      .status.pending-payment { background: #fab1a0; color: #e17055; }
      .status.approved { background: #55efc4; color: #00b894; }
      .status.rejected { background: #ff7675; color: #d63031; }

      .pay-btn {
          display: inline-block;
          padding: 0.5rem 1rem;
          background: #27ae60;
          color: white;
          border-radius: 5px;
          margin-left: 1rem;
          font-size: 1.2rem;
          text-decoration: none;
      }
      .pay-btn:hover { background: #219150; }
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
      <a href="logout.php">Logout</a>
   </nav>
</section>

<section class="dashboard">
   <div class="user-header">
      <div class="avatar"><?php echo substr($_SESSION['user_name'], 0, 1); ?></div>
      <div>
         <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
         <p>Manage your bookings and travel plans here.</p>
      </div>
   </div>

   <div class="table-container">
      <h2 style="font-size: 2.2rem; margin-bottom: 2rem;">My Bookings</h2>
      <table>
         <thead>
            <tr>
               <th>Location</th>
               <th>Travel Date</th>
               <th>Guests</th>
               <th>Status</th>
               <th>Booked On</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if(mysqli_num_rows($bookings_query) > 0){
               while($row = mysqli_fetch_assoc($bookings_query)){
                  $status_class = strtolower(str_replace(' ', '-', $row['status']));
                  echo "<tr>";
                  echo "<td>".$row['location']."</td>";
                  echo "<td>".date('d M Y', strtotime($row['arrival']))."</td>";
                  echo "<td>".$row['guests']."</td>";
                  echo "<td>";
                  echo "<span class='status ".$status_class."'>".$row['status']."</span>";
                  if($row['status'] == 'Pending Payment'){
                      echo "<a href='payment.php' class='pay-btn'>Pay Now</a>";
                  }
                  echo "</td>";
                  echo "<td>".date('d M Y, h:i A', strtotime($row['booking_date']))."</td>";
                  echo "</tr>";
               }
            }else{
               echo "<tr><td colspan='4' style='text-align:center;'>No bookings found. <a href='book.php' style='color:var(--main-color);'>Book your first trip now!</a></td></tr>";
            }
            ?>
         </tbody>
      </table>
   </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
