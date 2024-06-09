<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles */
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #4338ca;
        }
        .feedback-form {
            margin-top: 40px;
        }
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">Customer Feedback System</h1>

        <?php if(isset($_SESSION['user_id'])):?>
            <a href="view_feedback.php" class="btn">View Feedback</a>
            <a href="logout.php" class="btn ml-4">Logout</a>
            <?php if(($_SESSION['user_role']=='user')):?>

            <div class="feedback-form">
                <h2 class="text-xl font-semibold mb-4">Give Feedback</h2>
                <form action="feedback.php" method="post">
                    <input type="text" name="name" placeholder="Your Name" class="form-input" required>
                    <input type="email" name="email" placeholder="Your Email" class="form-input" required>
                    <textarea name="feedback" placeholder="Your Feedback" class="form-textarea" rows="5" required></textarea>
                    <button type="submit" class="btn">Submit Feedback</button>
                </form>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="flex justify-center items-center h-screen">
                <div class="bg-white p-8 rounded shadow-md w-96">
                    <h2 class="text-2xl font-bold mb-8 text-center">Welcome to Our Website</h2>
                    <div class="mb-4">
                        <a href="register.php" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-2">Register</a>
                        <a href="login.php" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Login</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
