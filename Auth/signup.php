<?php

// Connect to the MySQL database
$db = new PDO('mysql:host=localhost;dbname=quiz_app', 'root', '');

// Get the user's input
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password
$password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $password);
$stmt->execute();

// Redirect the user to the login page
header('Location: login.html');

?>
