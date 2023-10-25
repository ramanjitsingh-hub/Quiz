<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questions Attempted Per Day</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
  <!-- Navigation Bar -->
  <nav class="bg-blue-500 p-4">
    <ul class="flex justify-center">
      <li class="mr-4"><a href="#">Dashboard</a></li>
      <li class="mr-4"><a href="quiz.php">Take Test</a></li>
      
      
    </ul>
  </nav>

  <div class="flex items-center justify-center min-h-screen">
    <div class="w-1/2 bg-white rounded-lg shadow-lg p-4">
      <h1 class="text-2xl font-bold mb-4">Questions Attempted Per Day</h1>
      <canvas id="questionAttemptsChart"></canvas>
    </div>
  </div>

  <script>
    // Fetch data from the database using PHP
    <?php
    // Connect to the database (replace with your actual database credentials)
    $connection = mysqli_connect("localhost", "root", "", "quiz_app");

    if (!$connection) {
      die("Database connection failed: " . mysqli_connect_error());
    }

    // Query to get the number of questions attempted per day
    $query = "SELECT DATE(timestamp) AS day, COUNT(*) AS attempts FROM records WHERE user_id = 1 GROUP BY day";
    $result = mysqli_query($connection, $query);

    // Initialize arrays to store the data
    $labels = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
      $labels[] = $row['day'];
      $data[] = $row['attempts'];
    }

    // Close the database connection
    mysqli_close($connection);
    ?>

    // Define the JavaScript data using PHP-generated values
    const data = {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
        label: 'Questions Attempted',
        data: <?php echo json_encode($data); ?>,
        backgroundColor: 'rgba(156, 163, 175, 0.7)', // Light tone
        borderColor: 'rgba(156, 163, 175, 1)',
        borderWidth: 1,
        borderRadius: 10, // Rounded corners
      }]
    };

    const ctx = document.getElementById('questionAttemptsChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true,
            max: Math.max(...<?php echo json_encode($data); ?>),
          }
        },
        plugins: {
          legend: {
            display: false,
          }
        }
      }
    });
  </script>
</body>
</html>
