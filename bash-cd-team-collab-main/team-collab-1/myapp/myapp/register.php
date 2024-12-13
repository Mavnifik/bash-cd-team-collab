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

// Initialize error variables
$email_error = "";
$password_error = "";
$email_valid = true;
$password_valid = true;

// Process registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm-password'];

    // Validate email domain
    $allowed_domains = ['gmail.com', 'yahoo.com', 'student.fatima.edu.ph'];
    $email_domain = strtolower(substr(strrchr($email, "@"), 1)); // Extract domain and convert to lowercase

    if (!in_array($email_domain, $allowed_domains)) {
        $email_error = "Error: Invalid email enter a valid email";
        $email_valid = false;
    }
    
    // Validate password match
    if ($pass !== $confirm_pass) {
        $password_error = "Error: Passwords do not match.";
        $password_valid = false;
    }

    // If email and password are valid, proceed with registration
    if ($email_valid && $password_valid) {
        // Hash the password before storing it
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO user_music_accounts (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $email, $hashed_pass);

        if ($stmt->execute()) {
            header("Location: login.php"); // Redirect to a success page or login
            exit;
        } else {
            $email_error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css"> <!-- Linking to register.css -->
</head>
<body>
    <header>
        <a href="index.php" style="text-decoration: none; color: inherit;">
            <h1>Music Emotion Recognition System</h1>
        </a>
    </header>
    <main>
        <div class="register-container">
            <h2>Register</h2>

            <!-- Registration Form -->
            <form class="register-form" action="register.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>
                
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email" 
                    required
                    pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|student\.fatima\.edu\.ph)$" 
                    title="Only emails from gmail.com, yahoo.com, or student.fatima.edu.ph are allowed."
                >
                <?php if (!empty($email_error)): ?>
                    <span class="error"><?= $email_error; ?></span>
                <?php endif; ?>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
                
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                <?php if (!empty($password_error)): ?>
                    <span class="error"><?= $password_error; ?></span>
                <?php endif; ?>
                
                <button type="submit">Register</button>
                <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </main>
    <footer>
        <p>© 2024 Music Emotion Recognition System</p>
    </footer>
</body>
</html>

