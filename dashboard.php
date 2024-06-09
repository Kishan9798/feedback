<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get user information from session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$user_role = $_SESSION['user_role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .welcome {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .quick-links {
            margin-top: 30px;
        }
        .quick-links h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #4f46e5;
        }
        .quick-links ul {
            list-style-type: none;
            padding-left: 0;
        }
        .quick-links ul li {
            margin-bottom: 10px;
        }
        .quick-links ul li a {
            color: #4f46e5;
            text-decoration: none;
            transition: color 0.3s;
        }
        .quick-links ul li a:hover {
            color: #4338ca;
        }
        .logout-btn {
            margin-top: 30px;
            text-align: center;
        }
        .logout-btn a {
            background-color: #ff6347;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .logout-btn a:hover {
            background-color: #ee4a38;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h1 class="text-3xl font-bold mb-2">Welcome to Your Dashboard, <?= $username ?></h1>
            <p class="mb-4">Role: <?= $user_role ?></p>
        </div>
        <div class="quick-links">
            <h2 class="mb-4">Quick Links</h2>
            <ul>
                <li><a href="view_feedback.php">View Feedback</a></li>
                <!-- Add more quick links here -->
            </ul>
        </div>
        <?php if ($user_role === 'admin'): ?>
            <div class="quick-links">
                <h2 class="mb-4">Admin Tools</h2>
                <ul>
                    <li><a href="#">Manage Users</a></li>
                    <!-- Add more admin tools here -->
                </ul>
            </div>
        <?php endif; ?>
        <div class="logout-btn">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
