<?php
session_start();

$host = 'localhost'; // Server ipn (lokalt blir detta localhost)
$dbname = 'xioncomputers'; // Namnet på databasen som är skapad på servern
$username = 'root'; // Användarnamnet (default är root)
$password = ''; // Lösenorder (default är inget)

// Kopplar upp hemsidan till databasen och kontrollerar så att allt stämmer för att komma in
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>