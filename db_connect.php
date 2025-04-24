<?php
session_start();

$host = 'localhost'; // Server ipn (lokalt blir detta localhost)
$dbname = 'xioncomputers'; // Namnet p� databasen som �r skapad p� servern
$username = 'root'; // Anv�ndarnamnet (default �r root)
$password = ''; // L�senorder (default �r inget)

// Kopplar upp hemsidan till databasen och kontrollerar s� att allt st�mmer f�r att komma in
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>