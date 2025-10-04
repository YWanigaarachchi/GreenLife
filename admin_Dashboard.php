<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if role is admin
if ($_SESSION['role'] !== 'admin') {
    echo "❌ Access denied. Admins only.";
    exit();
}

$adminName = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }
        .sidebar {
            width: 220px;
            background: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffc107;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .main {
            margin-left: 220px;
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="#">📊 Dashboard</a>
    <a href="#">👥 Manage Clients</a>
    <a href="#">🧑‍⚕ Manage Therapists</a>
    <a href="#">🛠 Manage Users</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h1>Welcome, <?php echo htmlspecialchars($adminName); ?> 👋</h1>
    <div class="card">
        <h2>Quick Stats</h2>
        <p>Here you can show total clients, therapists, and users count (we can add queries later).</p>
    </div>
    <div class="card">
        <h2>Recent Activity</h2>
        <p>List of recent logins, registrations, etc.</p>
    </div>
</div>

</body>
</html>