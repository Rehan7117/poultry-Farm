<?php
// Start session
session_start();
include 'navbar.php'; // Include navigation bar

// Database connection
$conn = new mysqli('localhost', 'root', '','anzar');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poultry Farm</title>
    <link rel="stylesheet" href="home.css">
    <style>
        /* Add basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .hero {
            background: url('bike-banner.jpg') no-repeat center center/cover;
            height: 300px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1.2em;
        }

        .featured-bikes {
            padding: 20px;
            text-align: center;
        }

        .bike-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .bike-item {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            max-width: 250px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .bike-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .bike-item h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .bike-item p {
            font-size: 0.9em;
            color: #555;
        }

        .contact {
            padding: 20px;
            background: #333;
            color: white;
            text-align: center;
        }

        .contact a {
            color: #FFD700;
            text-decoration: none;
        }

        footer {
            text-align: center;
            padding: 10px;
            background: #222;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Welcome to Poultry Farm</h1>
            <p>Your Trusted Platform for Certified Secondhand Bikes</p>
        </div>
    </div>

    <!-- Featured Bikes Section -->
   
    <!-- Contact Section -->
    <div id="contact" class="contact">
        <h2>Contact Us</h2>
        <p>Email: <a href="mailto:support@bikebazaar.com">support@bikebazaar.com</a></p>
        <p>Phone: +1 (800) 123-4567</p>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Poultry Farm. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
