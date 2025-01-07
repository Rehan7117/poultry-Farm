<?php
// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the navbar
include 'navbar.php';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'anzar');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the input to prevent SQL injection
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password']; // Password is not escaped to maintain its original value

    // Check if the username/email exists in the database
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user data in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];

            // Redirect to the home page
            header("Location: home.php");
            exit(); // Stop further script execution
        } else {
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        $error_message = "No user found with that username or email.";
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form for Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="register.css"> <!-- Link to your external CSS file -->
</head>
<body>
    <h2>Login</h2>

    <!-- Display Error Message -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="POST">
        <label for="username">Username or Email:</label>
        <input type="text" id="username" name="username" placeholder="Username or Email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required><br>

        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</body>
</html>
