<?php
include 'config.php';

// Check if user is logged in as admin
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin'){
   header('location:admin_login.php');
   exit;
}

// Handle Status Updates
if(isset($_GET['update_status']) && isset($_GET['booking_id'])){
    $new_status = mysqli_real_escape_string($connection, $_GET['update_status']);
    $booking_id = mysqli_real_escape_string($connection, $_GET['booking_id']);
    mysqli_query($connection, "UPDATE `book_forms` SET status = '$new_status' WHERE id = '$booking_id'");
    header('location:admin_dashboard.php#bookings');
}

// Handle Package Deletion
if(isset($_GET['delete_package'])){
    $id = mysqli_real_escape_string($connection, $_GET['delete_package']);
    mysqli_query($connection, "DELETE FROM `packages` WHERE id = '$id'");
    header('location:admin_dashboard.php#packages');
}

// Handle Package Addition
if(isset($_POST['add_package'])){
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $duration = mysqli_real_escape_string($connection, $_POST['duration']);
    $desc = mysqli_real_escape_string($connection, $_POST['description']);
    $image = mysqli_real_escape_string($connection, $_POST['image']); // In a real app, this would be an upload

    mysqli_query($connection, "INSERT INTO `packages`(name, price, duration, description, image) VALUES('$name', '$price', '$duration', '$desc', '$image')");
    header('location:admin_dashboard.php#packages');
}

// Fetch Stats
$total_bookings = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `book_forms`"));
$total_users = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `users` WHERE user_type = 'user'"));
$total_packages = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `packages`"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professional Admin Panel</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="Style2.css">
   <style>
      :root {
          --admin-sidebar-width: 250px;
      }
      .admin-container {
          display: flex;
          min-height: 100vh;
          background: #f4f7f6;
      }
      .sidebar {
          width: var(--admin-sidebar-width);
          background: #2c3e50;
          color: white;
          padding: 2rem;
          position: fixed;
          height: 100vh;
      }
      .sidebar h2 {
          font-size: 2.2rem;
          margin-bottom: 3rem;
          text-align: center;
          border-bottom: 1px solid #555;
          padding-bottom: 1rem;
      }
      .sidebar a {
          display: block;
          color: #bdc3c7;
          font-size: 1.8rem;
          padding: 1.5rem;
          margin-bottom: 1rem;
          border-radius: 5px;
          transition: 0.3s;
      }
      .sidebar a:hover, .sidebar a.active {
          background: var(--main-color);
          color: white;
      }
      .main-content {
          margin-left: var(--admin-sidebar-width);
          flex: 1;
          padding: 3rem;
      }
      .header-stats {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
          gap: 2rem;
          margin-bottom: 4rem;
      }
      .stat-card {
          background: white;
          padding: 2rem;
          border-radius: 10px;
          box-shadow: var(--box-shadow);
          text-align: center;
      }
      .stat-card i {
          font-size: 4rem;
          color: var(--main-color);
          margin-bottom: 1rem;
      }
      .stat-card h3 { font-size: 3rem; }
      .stat-card p { font-size: 1.6rem; color: var(--light-black); }

      .section-card {
          background: white;
          padding: 2rem;
          border-radius: 10px;
          box-shadow: var(--box-shadow);
          margin-bottom: 4rem;
      }
      .section-card h2 {
          font-size: 2.5rem;
          margin-bottom: 2rem;
          color: var(--black);
          border-left: 5px solid var(--main-color);
          padding-left: 1rem;
      }
      table {
          width: 100%;
          border-collapse: collapse;
          font-size: 1.5rem;
      }
      th, td {
          padding: 1.2rem;
          text-align: left;
          border-bottom: 1px solid #eee;
      }
      th { background: #f9f9f9; }
      .status {
          padding: 0.5rem 1rem;
          border-radius: 20px;
          font-size: 1.2rem;
          font-weight: bold;
          text-transform: uppercase;
      }
      .status.pending { background: #ffeaa7; color: #d6a312; }
      .status.approved { background: #55efc4; color: #00b894; }
      .status.rejected { background: #ff7675; color: #d63031; }

      .action-btn {
          padding: 0.5rem 1rem;
          border-radius: 5px;
          color: white;
          font-size: 1.2rem;
          margin-right: 0.5rem;
      }
      .btn-approve { background: #27ae60; }
      .btn-reject { background: #c0392b; }
      .btn-delete { background: #e74c3c; }

      .form-add-package input, .form-add-package textarea {
          width: 100%;
          padding: 1rem;
          margin-bottom: 1rem;
          border: 1px solid #ddd;
          border-radius: 5px;
          font-size: 1.6rem;
      }
   </style>
</head>
<body>

<div class="admin-container">
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="#overview" class="active"><i class="fas fa-chart-line"></i> Overview</a>
        <a href="#bookings"><i class="fas fa-calendar-check"></i> Bookings</a>
        <a href="#packages"><i class="fas fa-map-marked-alt"></i> Packages</a>
        <a href="#users"><i class="fas fa-users"></i> Users</a>
        <a href="logout.php" style="margin-top: 5rem; background: #c0392b; color: white;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main-content">
        <!-- Overview -->
        <div id="overview" class="header-stats">
            <div class="stat-card">
                <i class="fas fa-suitcase-rolling"></i>
                <h3><?php echo $total_bookings; ?></h3>
                <p>Total Bookings</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3><?php echo $total_users; ?></h3>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-box"></i>
                <h3><?php echo $total_packages; ?></h3>
                <p>Active Packages</p>
            </div>
        </div>

        <!-- Bookings Management -->
        <div id="bookings" class="section-card">
            <h2>Manage Bookings</h2>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Location</th>
                        <th>Travel Date</th>
                        <th>Status</th>
                        <th>Booked On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $bookings = mysqli_query($connection, "SELECT * FROM `book_forms` ORDER BY id DESC");
                    while($row = mysqli_fetch_assoc($bookings)){
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['location']."</td>";
                        echo "<td>".$row['arrival']."</td>";
                        echo "<td><span class='status ".$row['status']."'>".$row['status']."</span></td>";
                        echo "<td>".date('d M Y, h:i A', strtotime($row['booking_date']))."</td>";
                        echo "<td>
                                <a href='?update_status=approved&booking_id=".$row['id']."' class='action-btn btn-approve'>Approve</a>
                                <a href='?update_status=rejected&booking_id=".$row['id']."' class='action-btn btn-reject'>Reject</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Package Management -->
        <div id="packages" class="section-card">
            <h2>Manage Packages</h2>
            <form action="" method="post" class="form-add-package">
                <h3>Add New Package</h3>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <input type="text" name="name" placeholder="Package Name" required>
                    <input type="text" name="price" placeholder="Price (e.g. 15,000)" required>
                    <input type="text" name="duration" placeholder="Duration (e.g. 3 Days)" required>
                    <input type="text" name="image" placeholder="Image Name (e.g. qila.jpg)" required>
                </div>
                <textarea name="description" placeholder="Description" rows="3" required></textarea>
                <input type="submit" name="add_package" value="Add Package" class="btn" style="width: auto;">
            </form>
            <hr style="margin: 2rem 0;">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pkgs = mysqli_query($connection, "SELECT * FROM `packages` ORDER BY id DESC");
                    while($row = mysqli_fetch_assoc($pkgs)){
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>PKR ".$row['price']."</td>";
                        echo "<td>".$row['duration']."</td>";
                        echo "<td><a href='?delete_package=".$row['id']."' class='action-btn btn-delete' onclick='return confirm(\"Delete this package?\")'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- User Management -->
        <div id="users" class="section-card">
            <h2>Registered Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = mysqli_query($connection, "SELECT * FROM `users` WHERE user_type = 'user'");
                    while($row = mysqli_fetch_assoc($users)){
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".date('d M Y', strtotime($row['created_at']))."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    // Simple active link handler
    const links = document.querySelectorAll('.sidebar a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });
</script>

</body>
</html>
