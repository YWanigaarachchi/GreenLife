<?php
session_start();
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $role       = isset($_POST['role']) ? $_POST['role'] : "client"; // default client
    $password   = $_POST['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "⚠ Invalid email format!";
    } elseif (strlen($password) < 6) {
        $message = "⚠ Password must be at least 6 characters!";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT username, email FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['username'] === $username) {
                $message = "⚠ Username already taken!";
            } elseif ($row['email'] === $email) {
                $message = "⚠ Email already registered!";
            }
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $first_name, $last_name, $username, $email, $phone, $hashedPassword, $role);

            if ($stmt->execute()) {
                $message = "✅ Registration successful! <a href='login.php'>Login Here</a>";
            } else {
                $message = "❌ Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
        .msg {
            margin: 10px 0;
            text-align: center;
            color: #d9534f;
        }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Register</h2>
    <?php if (!empty($message)) echo "<div class='msg'>$message</div>"; ?>
    <form method="POST">
    
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" pattern="[0-9]{10}" required>
        <input type="password" name="password" placeholder="Password (min 6 chars)" minlength="6" required>

        <!-- Role dropdown (optional) -->
        <select name="role" required>
            <option value="client">Client</option>
            <option value="therapist">Therapist</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Register</button>
    </form>
    <div class="form-box">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
    <p style="text-align:center;margin-top:10px;">Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
