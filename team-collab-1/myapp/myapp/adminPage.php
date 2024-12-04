<?php
// Include database connection
$servername = "localhost";
$username = "root";  // default for XAMPP
$password = "";
$dbname = "music_website";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$sql = "SELECT id, username, email FROM user_music_accounts";
$result = $conn->query($sql);

// Check if there are users in the database
$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    $users = [];
}

// Handle the delete request if the user clicked the remove button
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM user_music_accounts WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "User removed successfully.";
    } else {
        echo "Error removing user: " . $conn->error;
    }
    header("Location: adminPage.php"); // Redirect back to the admin page after deletion
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <link rel="stylesheet" href="Adminpage.css">
</head>
<body>
    <header>
        <h1> Music Emotion Recognition System | Admin Dashboard</h1>
    </header>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="javascript:void(0)" onclick="showSection('dashboard')">Dashboard</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('user-management')">User Management</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('music-management')">Music Management</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('emotion-settings')">Emotion Analysis Settings</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('reports')">Reports</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <!-- User Management Section -->
            <section id="user-management" class="section" style="display: none;">
                <h2>Registered Users</h2>
                <?php if (count($users) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th> <!-- Added column for action -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                        <a href="adminPage.php?delete_id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <button>Remove</button>
                                        </a>
                                    </td> <!-- Add remove button -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No users found.</p>
                <?php endif; ?>
            </section>

            <!-- Other Sections -->
            <section id="dashboard" class="section" style="display: block;">
                <h2>Dashboard</h2>
                <p>Welcome to the Admin Dashboard!</p>
            </section>

            <!-- You can add more sections here as needed -->
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Music Emotion Application</p>
    </footer>

    <script src="admin.js"></script>
</body>
</html>
