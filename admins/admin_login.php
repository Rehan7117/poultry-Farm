<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'anzar'); // Changed to 'anzar'

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_name = $conn->real_escape_string($_POST['admin_name']);
    $password = $_POST['password'];

    // Query to fetch admin data
    $sql = "SELECT * FROM admins WHERE admin_name='$admin_name' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Check if the password matches
        if (password_verify($password, $admin['password'])) {
            // Store admin data in session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['admin_name'];

            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No admin found with that name.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="adminregister.css"> <!-- Link to your external CSS file -->
</head>
<body>
    <!-- Display error message if any -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Admin Login Form -->
    <form method="POST">
        <label for="admin_name">Admin Name:</label>
        <input type="text" id="admin_name" name="admin_name" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
