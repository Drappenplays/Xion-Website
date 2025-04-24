<?php
require_once 'db_connect.php';

// Tar alla olika komponenter genom sessionsvariabler
$components = [
    'chassi' => $_SESSION['chassi'] ?? 'Ej angivet',
    'ram' => $_SESSION['ram'] ?? 'Ej angivet',
    'ssd' => $_SESSION['ssd'] ?? 'Ej angivet',
    'color' => $_SESSION['color'] ?? 'Ej angivet',
    'cooling' => $_SESSION['cooling'] ?? 'Ej angivet',
    'wifi' => $_SESSION['wifi'] ?? 'Ej angivet',
    'thoughts' => $_SESSION['thoughts'] ?? 'Inga kommentarer',
    'totalPrice' => $_SESSION['totalPrice'] ?? '8000'
];

// Tar den personliga informationen genom post från förra sidan
$personInfo = [
    'firstName' => $_POST['firstName'] ?? '',
    'lastName' => $_POST['lastName'] ?? '',
    'email' => $_POST['email'] ?? '',
    'shipping' => $_POST['shipping'] ?? 'Nej',
    'address' => $_POST['address'] ?? null,
    'postnummer' => $_POST['postnummer'] ?? null,
    'postort' => $_POST['postort'] ?? null
];

// Kombinerar alla data och lägger det som en och samma lista
$orderData = array_merge($components, $personInfo);

// Skickar alla värden till databasen
try {
    $sql = "INSERT INTO orders (chassi, ram, ssd, color, cooling, wifi, thoughts, totalPrice, firstName, lastName, email, shipping, address, postnummer, postort)
            VALUES (:chassi, :ram, :ssd, :color, :cooling, :wifi, :thoughts, :totalPrice, :firstName, :lastName, :email, :shipping, :address, :postnummer, :postort)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($orderData);
    
    echo "Beställningen har sparats!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>