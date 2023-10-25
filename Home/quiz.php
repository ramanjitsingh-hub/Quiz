<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quiz App</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
.container {
  border-radius: 10px;
}

.bg-white {
  background-color: white;
}

.rounded-lg {
  border-radius: 10px;
}

.shadow-md {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.hover:shadow-lg {
  box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.2);
}

.p-4 {
  padding: 1rem;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body>
    <a href="home.php" class="absolute top-0 left-0 p-4">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    
<div class="container mx-auto flex flex-col items-center justify-center min-h-screen bg-gray-100">
  <h1 class="text-center text-3xl font-bold mt-8">Quiz Question</h1>

  <div class="grid grid-cols-2 gap-4 mt-8">
    <button id="answer-1" class="bg-white rounded-lg shadow-md hover:shadow-lg p-4">Answer 1</button>
    <button id="answer-2" class="bg-white rounded-lg shadow-md hover:shadow-lg p-4">Answer 2</button>
    <button id="answer-3" class="bg-white rounded-lg shadow-md hover:shadow-lg p-4">Answer 3</button>
    <button id="answer-4" class="bg-white rounded-lg shadow-md hover:shadow-lg p-4">Answer 4</button>
  </div>
</div>

<script>
const url = 'https://opentdb.com/api.php?amount=1&type=multiple';


async function fetchQuizQuestion() {
  const response = await fetch(url);
  const data = await response.json();

  // Set the quiz question and answer elements
  const quizQuestionEl = document.querySelector('.text-center');
  quizQuestionEl.textContent = data.results[0].question;

  const answerEls = document.querySelectorAll('.grid button');
  for (let i = 0; i < answerEls.length; i++) {
    answerEls[i].textContent = data.results[0].incorrect_answers[i];
  }

  // Set the correct answer element
  const correctAnswerEl = answerEls[Math.floor(Math.random() * answerEls.length)];
  correctAnswerEl.textContent = data.results[0].correct_answer;

  // Add an event listener to each answer button
  answerEls.forEach((button) => {
    button.addEventListener('click', () => {
      // Check if the user's answer is correct
      if (button.textContent === correctAnswerEl.textContent) {
        // Highlight the correct answer button in green
        button.classList.add('bg-green-500');
        submitAnswer(1); 
      } else {
        // Highlight the incorrect answer button in red
        button.classList.add('bg-red-500');
        submitAnswer(0); 
        // Highlight the correct answer button in green
        correctAnswerEl.classList.add('bg-green-500');
      }
      setTimeout(() => {
      // Enable clicking on answer buttons
      answerEls.forEach((btn) => {
        btn.disabled = false;
      });

      // Fetch a new question
      location.reload();
    }, 2000);
    });
  });
}
function submitAnswer(value) {
  fetch('submit_answer.php', {
    method: 'POST',
    body: JSON.stringify({answer :value}),
    headers: {
      'Content-Type': 'application/json',
    },
  });
}
// Fetch the quiz question and answers on page load
fetchQuizQuestion();
</script>
</body>
</html>

