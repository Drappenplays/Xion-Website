<?php
// HEMSIDA SOM VISAR ORDERN EFTER ALLT ÄR INSKRIVET I FÖRSTA SIDAN. Låter kunden fortsätta efter det till personinfo

session_start(); // Startar en session för att kunna lagra användarens val

// Spara användarens val i sessionsvariabler (om de finns, annars sätts standardvärden)
if(isset($_POST['cpu'])){
$_SESSION['cpu'] = $_POST['cpu'];
$_SESSION['gpu'] = $_POST['gpu'];
$_SESSION['motherboard'] = $_POST['motherboard'];
$_SESSION['psu'] = $_POST['psu'];
$_SESSION['cooler'] = $_POST['cooler'];

$_SESSION['chassi'] = $_POST['chassi'] ?? 'Ej angivet';
$_SESSION['ram'] = $_POST['ram'] ?? 'Ej angivet';
$_SESSION['ssd'] = $_POST['ssd'] ?? 'Ej angivet';
$_SESSION['color'] = $_POST['color'] ?? 'Ej angivet';
$_SESSION['cooling'] = $_POST['cooling'] ?? 'Ej angivet';
$_SESSION['wifi'] = $_POST['wifi'] ?? 'Ej angivet';
$_SESSION['thoughts'] = $_POST['thoughts'] ?? 'Inga kommentarer';
$_SESSION['total_price'] = $_POST['total_price'] ?? '8000'; // Standardpris om inget har skickats med
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bekräfta Beställning</title>
    <link href="klar_order.css" rel="stylesheet" />
</head>
<body>

    <div class="confirmation-box">
        <h1>✅ Är detta korrekt?</h1>
        <p>Vänligen kontrollera din beställning innan du bekräftar.</p>

        <div class="order-details">
            <h3>Din beställning:</h3>

            <!-- Här hämtas användarens val och skrivs ut på sidan -->
            <p><strong>CPU:</strong> <?php echo htmlspecialchars($_SESSION['cpu']); ?></p>
            <p><strong>Moderkort:</strong> <?php echo htmlspecialchars($_SESSION['motherboard']); ?></p>
            <p><strong>GPU:</strong> <?php echo htmlspecialchars($_SESSION['gpu']); ?></p>
            <p><strong>PSU:</strong> <?php echo htmlspecialchars($_SESSION['psu']); ?></p>
            <p><strong>Chassi:</strong> <?php echo htmlspecialchars($_SESSION['chassi']); ?></p>
            <p><strong>RAM:</strong> <?php echo htmlspecialchars($_SESSION['ram']); ?></p>
            <p><strong>SSD:</strong> <?php echo htmlspecialchars($_SESSION['ssd']); ?></p>
            <p><strong>Färg:</strong> <?php echo htmlspecialchars($_SESSION['color']); ?></p>
            <p><strong>CPU-kylning:</strong> <?php echo htmlspecialchars($_SESSION['cooling']); ?></p>
            <p><strong>WiFi:</strong> <?php echo htmlspecialchars($_SESSION['wifi']); ?></p>
            <p><strong>Övriga tankar:</strong> <?php echo htmlspecialchars($_SESSION['thoughts']); ?></p>

            <!-- Skriver ut det totala priset -->
            <h2>Pris: <?php echo htmlspecialchars($_SESSION['total_price']); ?> kr</h2>
            <p>(Priset beror på dina övriga tankar)</p>
        </div>

        <div class="button-container">
            <!-- Formulär för att gå vidare till personuppgifter -->
            <form action="personinfo.php" method="POST">
                <input type="hidden" name="cpu" value=$_SESSION['cpu']>
                <button type="submit" class="confirm-button">Ja, bekräfta</button>
            </form>

            <!-- Knapp för att gå tillbaka och göra ändringar -->
                <button onclick="history.back()" class="cancel-button">Nej, ändra</button>
            </a>
        </div>
    </div>

</body>
</html>
