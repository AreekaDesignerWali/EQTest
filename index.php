<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Home</title>
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
        .container {
            max-width: 800px;
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
            margin-bottom: 30px;
        }
        .start-btn {
            padding: 15px 30px;
            font-size: 1.2em;
            background: #6e8efb;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.3s, background 0.3s;
        }
        .start-btn:hover {
            background: #a777e3;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 10px;
            }
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Emotional Intelligence (EQ) Test</h1>
        <p>Discover your emotional intelligence by taking our comprehensive EQ test. Learn about your self-awareness, empathy, and emotional regulation skills to unlock your full potential.</p>
        <button class="start-btn" onclick="window.location.href='quiz.php'">Start Test</button>
    </div>
    <script>
        // JavaScript for smooth navigation
        document.querySelector('.start-btn').addEventListener('click', () => {
            window.location.href = 'quiz.php';
        });
    </script>
</body>
</html>
