<?php
$host = 'localhost';
$dbname = 'dbc649ffxwtucf';
$username = 'uc7ggok7oyoza';
$password = 'gqypavorhbbc';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
