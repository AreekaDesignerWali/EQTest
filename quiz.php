<?php
session_start();
require_once 'db.php';

// Initialize session for responses
if (!isset($_SESSION['responses'])) {
    $_SESSION['responses'] = [];
}

// Fetch questions from database
try {
    $stmt = $pdo->query("SELECT * FROM questions");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching questions: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_id = $_POST['question_id'];
    $answer = $_POST['answer'];
    $_SESSION['responses'][$question_id] = $answer;
    if (count($_SESSION['responses']) >= count($questions)) {
        header('Location: results.php');
        exit;
    }
}
$current_question = count($_SESSION['responses']);
$question = isset($questions[$current_question]) ? $questions[$current_question] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Quiz</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .quiz-container {
            max-width: 700px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #6e8efb;
        }
        .option {
            display: block;
            padding: 15px;
            margin: 10px 0;
            background: #f4f4f4;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .option:hover {
            background: #e0e0e0;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        .submit-btn {
            padding: 15px 30px;
            font-size: 1.2em;
            background: #6e8efb;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.3s, background 0.3s;
        }
        .submit-btn:hover {
            background: #a777e3;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .quiz-container {
                padding: 20px;
                margin: 10px;
            }
            h2 {
                font-size: 1.5em;
            }
            .option {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <?php if ($question): ?>
            <h2>Question <?php echo $current_question + 1; ?>:</h2>
            <p><?php echo htmlspecialchars($question['question_text']); ?></p>
            <form method="POST" id="quizForm">
                <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <label class="option">
                        <input type="radio" name="answer" value="<?php echo $i; ?>" required>
                        <?php echo htmlspecialchars($question['option' . $i]); ?>
                    </label>
                <?php endfor; ?>
                <button type="submit" class="submit-btn">Next</button>
            </form>
        <?php else: ?>
            <p>No more questions available.</p>
            <button class="submit-btn" onclick="window.location.href='results.php'">View Results</button>
        <?php endif; ?>
    </div>
    <script>
        // Prevent form resubmission and handle navigation
        document.getElementById('quizForm')?.addEventListener('submit', (e) => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            }).then(() => {
                window.location.href = 'quiz.php';
            });
        });
    </script>
</body>
</html>
