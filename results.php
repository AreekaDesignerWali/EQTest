<?php
session_start();
require_once 'db.php';

// Calculate score
$score = 0;
$max_score = 0;
try {
    $stmt = $pdo->query("SELECT * FROM questions");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $max_score = count($questions) * 4; // Max 4 points per question
    foreach ($_SESSION['responses'] as $question_id => $answer) {
        $score += (int)$answer;
    }
} catch (PDOException $e) {
    die("Error fetching questions: " . $e->getMessage());
}

// Determine feedback
$percentage = ($score / $max_score) * 100;
$feedback = '';
if ($percentage >= 80) {
    $feedback = "Excellent! You have a high level of emotional intelligence, with strong self-awareness, empathy, and emotional regulation.";
} elseif ($percentage >= 60) {
    $feedback = "Good job! You have a solid foundation in emotional intelligence. Focus on improving your empathy and self-regulation for even better results.";
} else {
 Hobbies:
    $feedback = "There's room for improvement in your emotional intelligence. Practice self-awareness exercises and seek feedback to enhance your skills.";
}

// Clear session for retake
if (isset($_POST['retake'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Results</title>
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
        .results-container {
            max-width: 700px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #333;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #6e8efb;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .btn {
            padding: 15px 30px;
            font-size: 1.2em;
            background: #6e8efb;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin: 10px;
            transition: transform 0.3s, background 0.3s;
        }
        .btn:hover {
            background: #a777e3;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .results-container {
                padding: 20px;
                margin: 10px;
            }
            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="results-container">
        <h1>Your EQ Test Results</h1>
        <p>Your Emotional Intelligence Score: <?php echo $score; ?> / <?php echo $max_score; ?> (<?php echo round($percentage, 2); ?>%)</p>
        <p><?php echo htmlspecialchars($feedback); ?></p>
        <form method="POST">
            <button type="submit" name="retake" class="btn">Retake Test</button>
        </form>
        <button class="btn" onclick="shareResults()">Share Results</button>
    </div>
    <script>
        function shareResults() {
            const text = `I scored <?php echo $score; ?> out of <?php echo $max_score; ?> on the EQ Test! <?php echo addslashes($feedback); ?>`;
            navigator.clipboard.write(text).then(() => {
                alert('Results copied to clipboard!');
            });
        }
    </script>
</body>
</html>
