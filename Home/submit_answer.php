<?php
// Start the session (if not already started)
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace 'your_db_host', 'your_db_user', 'your_db_password', and 'your_db_name' with your actual database credentials
    $connection = mysqli_connect("localhost", "root", "", "quiz_app");

    // Get the submitted user ID, answer result, and timestamp
    $data = json_decode(file_get_contents('php://input'), true);
$answer_result = $data['answer'];
    $timestamp = date("Y-m-d H:i:s");
$user = $_SESSION["user_id"];
    // Insert the answer data into the 'records' table
    $query = "INSERT INTO records (user_id, answer_result, timestamp) VALUES (?, ?, ?)";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'iss', $user, $answer_result, $timestamp);
    
    if (mysqli_stmt_execute($statement)) {
        echo "Answer submitted successfully";
    } else {
        echo "Error submitting answer";
    }

    mysqli_stmt_close($statement);
    mysqli_close($connection);
    session_destroy();
}
?>