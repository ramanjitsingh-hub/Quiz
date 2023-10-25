<?php
// Start the session (if not already started)
session_start();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace 'your_db_host', 'your_db_user', 'your_db_password', and 'your_db_name' with your actual database credentials
    $connection = mysqli_connect("localhost", "root", "", "quiz_app");

    // Check for a successful database connection
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Get the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials and fetch user data from the database using prepared statements
    $query = "SELECT user_id FROM users WHERE email = ? AND password = ?";
    
    // Prepare the SQL statement
    $statement = mysqli_prepare($connection, $query);

    if (!$statement) {
        die("Query preparation failed: " . mysqli_error($connection));
    }

    // Bind parameters to the statement
    mysqli_stmt_bind_param($statement, 'ss', $email, $password);

    // Execute the statement
    mysqli_stmt_execute($statement);

    // Store the result
    mysqli_stmt_store_result($statement);

    if (mysqli_stmt_num_rows($statement) === 1) {
        mysqli_stmt_bind_result($statement, $userId);
        mysqli_stmt_fetch($statement);

        // Successful login: Store the user ID in the session
        $_SESSION['user_id'] = $userId;
        $_SESSION['email'] = $email;

        // Redirect the user to the dashboard or any other desired page
        header("Location: ../Home/home.php");
        exit;
    } else {
        // Invalid credentials, redirect back to the login page with an error message
        echo "Invalid credentials";
        exit;
    }

    mysqli_stmt_close($statement);
    mysqli_close($connection);
}
?>
