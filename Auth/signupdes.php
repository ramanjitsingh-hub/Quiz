<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz App - Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="bg-gradient-to-r from-gray-100 to-gray-200 min-h-screen">
    <div class="container flex flex-col items-center justify-center h-screen">

      <section class="bg-white shadow-md rounded-md p-8 w-1/2">
        <h1 class="text-3xl font-bold text-gray-800 text-center">Quiz App - Sign Up</h1>

        <form action="signup.php" method="post">
          <div class="mt-8">
            <label for="name" class="text-gray-700">Full Name</label>
            <input type="text" name="name" id="name" class="bg-gray-100 border-2 border-gray-300 rounded-md w-full p-2 mt-2" required>
          </div>

          <div class="mt-8">
            <label for="email" class="text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-100 border-2 border-gray-300 rounded-md w-full p-2 mt-2" required>
          </div>
            <?php
             $_POST['password'] ="";
            ?>
          <div class="mt-8">
            <label for="password" class="text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-100 border-2 border-gray-300 rounded-md w-full p-2 mt-2" required>
          </div>
          
          <?php


$password = $_POST['password'];



if (isset($password) && strlen($password) < 8) {

  $errorMessage = "Password must be at least 8 characters long.";
} elseif (!preg_match("/[A-Z]/", $password)) {
  
  $errorMessage = "Password must contain at least one uppercase letter.";
} elseif (!preg_match("/[a-z]/", $password)) {

  $errorMessage = "Password must contain at least one lowercase letter.";
} elseif (!preg_match("/[0-9]/", $password)) {

  $errorMessage = "Password must contain at least one number.";
} elseif (!preg_match("/[^A-Za-z0-9]/", $password)) {
  
  $errorMessage = "Password must contain at least one special character.";
}


if (isset($errorMessage)) {
  echo "<p class='text-red-600'>$errorMessage</p>";
}
?>
          <div class="mt-8">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sign Up</button>
          </div>
        </form>

        <div class="mt-8">
          <p class="text-gray-600">Already have an account? <a href="login.html" class="text-blue-600">Log in now.</a></p>
        </div>
      </section>

    </div>
  </div>
</body>
</html>
