<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if role is therapist
if ($_SESSION['role'] !== 'therapist') {
    echo "❌ Access denied. Therapists only.";
    exit();
}

$therapistName = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }
        .sidebar {
            width: 220px;
            background: #007bff;
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
            background: #0056b3;
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
    <h2>Therapist Panel</h2>
    <a href="#">🏠 Dashboard</a>
    <a href="#">📅 Manage Appointments</a>
    <a href="#">👥 My Clients</a>
    <a href="#">📑 Session Notes</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h1>Welcome, <?php echo htmlspecialchars($therapistName); ?> 👋</h1>
    <div class="card">
        <h2>Today’s Schedule</h2>
        <p>Here you can display therapist’s appointments (we can add queries later).</p>
    </div>
    <div class="card">
        <h2>Client Progress</h2>
        <p>Charts or notes about client progress could go here.</p>
    </div>
</div>

</body>
</html>