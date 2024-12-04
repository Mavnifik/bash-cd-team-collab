<?php
// Database connection
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "";  // Default password for XAMPP
$dbname = "music_website";  // The database we're using

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session for login validation
session_start();

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if admin credentials are entered
    if ($user == "admin" && $pass == "admin") {
        header("Location: adminPage.php");
        exit();
    }

    // SQL query to check user credentials
    $sql = "SELECT * FROM user_music_accounts WHERE username = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            // Successful login
            $_SESSION['username'] = $user;  // Store username in session
            header("Location: dashboard.php");  // Redirect to user dashboard
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> <!-- Linking to login.css -->
</head>
<body>
    <header>
        <h1>Music Emotion Recognition System</h1>
        <p>Analyze the emotional essence of your favorite songs!</p>
    </header>
    <main>
        <div class="login-container">
            <h2>Login</h2>
            <!-- The form now sends data to login.php via POST -->
            <form action="login.php" method="POST" class="login-form">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                
                <button type="submit">Login</button>
                <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 Music Emotion Recognition System</p>
    </footer>
</body>
</html>
