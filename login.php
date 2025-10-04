<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            
          if ($_SESSION['role'] == "client") {
            header("Location: Client_Dashboard.php"); // redirect to a common dashboard
          }else if ($_SESSION['role'] == "admin") {
            header("Location: admin_Dashboard.php"); // redirect to a common dashboard
          }else if($_SESSION['role'] == "therapist"){
            header("Location: Therapist_Dashboard.php"); // redirect to a common dashboard
          }
           
            //$clientName = $_SESSION['first_name'] . " " . $_SESSION['last_name'];//
            exit();
        } else {
            $message = "❌ Invalid password!";
        }
    } else {
        $message = "❌ No user found with that username/email!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        .msg {
            margin: 10px 0;
            text-align: center;
            color: #d9534f;
        }
        a { color: #28a745; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Login</h2>
    <?php if (!empty($message)) echo "<div class='msg'>$message</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p style="text-align:center;margin-top:10px;">Don’t have an account? <a href="Registration.php">Register</a></p>
</div>
</body>
</html>