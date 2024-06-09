<?php
session_start();

require_once('db_connection.php');

// Get user's email from session (assuming it's stored there)
$user_id = $_SESSION['user_id'] ?? '';
// Fetch feedback for the logged-in user from the database
if(isset($_SESSION['user_role']) && $_SESSION['user_role']=="admin"){
    $sql = "SELECT name, email, feedback, created_at FROM feedback";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} else {
    $sql = "SELECT name, email, feedback, created_at FROM feedback WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

$result = $stmt->get_result();
$feedbacks = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Feedback</title>
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
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .feedback-card {
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">Your Feedback</h1>
        <?php if (!empty($feedbacks)): ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback-card">
                    <h2 class="text-xl font-bold mb-2"><?= $feedback["name"] ?></h2>
                    <p><?= $feedback["feedback"] ?></p>
                    <p class="text-sm text-gray-500 mt-2">Submitted on <?= $feedback["created_at"] ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No feedback submitted yet.</p>
        <?php endif; ?>
        <a href="index.php" class="btn mt-4">Go Back</a>
    </div>
</body>
</html>
