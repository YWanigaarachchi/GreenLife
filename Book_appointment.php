<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    
</head>
<body>
<div class="sidebar">
    <h2>Client Panel</h2>
    <a href="Client_Dashboard.php">Dashboard</a>
    <a href="Book_appointment.php">Book Appointment</a>
    <a href="my_therapists.php">My Therapists</a>
    <a href="my_profile.php">My Profile</a>
    <a href="logout.php" onclick="return confirmLogout()">Logout</a>
    
</div>

<div class="content">
    <h1>Book an Appointment</h1>
    <form method="post" action="">
        <label>Choose Service:</label>
        <input type="text" name="service" required><br><br>
        
        <label>Preferred Date:</label>
        <input type="date" name="date" required><br><br>
        
        <label>Preferred Time:</label>
        <input type="time" name="time" required><br><br>
        
        <button type="submit">Book Appointment</button>
    </form>
</div>
</body>
</html>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book_appointment</title>
    
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
}

.sidebar {
    width: 220px;
    background: #28a745;
    color: white;
    position: fixed;
    top: 0;
    bottom: 0;
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 20px;
    font-size: 22px;
}

.sidebar a {
    display: block;
    padding: 10px;
    margin: 5px 0;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.sidebar a:hover {
    background: #218838;
}

.content {
    margin-left: 240px;
    padding: 20px;
    
}

</style>
</head>
<body>
    


