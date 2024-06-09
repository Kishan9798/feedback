<?php
session_start();

require_once('db_connection.php');

$feedback_submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $user_id =  $_SESSION['user_id']??'';
    $email =  $_POST["email"];
    $feedback = $_POST["feedback"];
    
    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO feedback (name, user_id,email, feedback) VALUES (?, ?, ?,?)");
    $stmt->bind_param("siss", $name, $user_id,$email, $feedback);

    // Execute the statement
    if ($stmt->execute()) {
        $feedback_submitted = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Submitted</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">Thank You!</h1>
        <?php if ($feedback_submitted): ?>
            <p class="mb-4">Your feedback has been submitted successfully.</p>
            <a href="view_feedback.php" class="btn">View Feedback</a>
        <?php else: ?>
            <p class="mb-4">There was an error submitting your feedback. Please try again later.</p>
            <a href="index.php" class="btn">Go Back</a>
        <?php endif; ?>
    </div>
</body>
</html>
