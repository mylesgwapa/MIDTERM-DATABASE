<?php 
// Database connection
$host = 'localhost';  // Your database host
$dbname = 'midterm';  // Your database name
$username = 'root';  // Your database username
$password = '';  // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to get users
    $stmt = $pdo->query("SELECT * FROM users");  // Assuming 'users' is your users table name
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="dashboard.css">

    <style>
        /* Position the dropdown in the upper right corner */
        .dropdown {
            position: absolute;
            top: 20px; /* Adjust the distance from the top */
            right: 20px; /* Adjust the distance from the right */
            z-index: 1000; /* Make sure it appears above other elements */
            background-color: #fff; /* Optional: Add a background for visibility */
            padding: 10px;
            border-radius: 5px;
        }

        .dropdown select {
            padding: 5px;
            font-size: 14px;
        }
    </style>

    <title>DASHBOARD</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">MRPAdmin</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="#">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="text">Settings</span>
            </a>
        </li>
        <!-- Logout Link Updated -->
        <li>
            <a href="logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>

        <a href="#" class="profile">
            <img src="user.png">
        </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="landpage.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3></h3>
                    <p>Product</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3><?php echo count($users); ?></h3>  <!-- Display the number of users here -->
                    <p>Users</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3></h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </ul>

        <!-- Dropdown for User Selection (Upper Right Corner) -->
        <div class="dropdown">
    <label for="userDropdown">Select User:</label>
    <select id="userDropdown" name="user" onchange="window.location.href=this.value;">
        <option value="">--Select Option--</option>
        <option value="leftjoin.php">LEFT JOIN</option>
        <option value="rightjoin.php">RIGHT JOIN</option>
        <option value="outerjoin.php">OUTER JOIN</option>
        <?php
        foreach ($users as $user) {
            echo "<option value='user_details.php?id=" . htmlspecialchars($user['id']) . "'>" . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']) . "</option>";
        }
        ?>
    </select>
</div>


        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Recent Orders</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date Order</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="script.js"></script>
</body>
</html>
