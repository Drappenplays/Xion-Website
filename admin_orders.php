<?php
// Ställer in teckenkodningen för sidan till ISO-8859-1
header('Content-Type: text/html; charset=ISO-8859-1');

// Inkluderar databasanslutningen
require_once 'db_connect.php';

// Kontrollerar om administratören är inloggad, annars omdirigeras de till inloggningssidan
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Hanterar borttagning av en beställning
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Konverterar ID till heltal för att förhindra SQL-injektion
    try {
        $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: admin_orders.php"); // Omdirigerar tillbaka till ordersidan efter borttagning
        exit();
    } catch (PDOException $e) {
        die("Fel vid borttagning av beställning: " . $e->getMessage()); // Visar felmeddelande om något går fel
    }
}

// Hämtar alla beställningar från databasen
try {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fel vid hämtning av beställningar: " . $e->getMessage()); // Visar felmeddelande vid problem
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Beställningar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Förhindrar horisontell scrollning */
        html, body {
            width: 100%;
            overflow-x: auto;
            background-color: #f8f9fa;
            white-space: nowrap;
        }

        .container {
            margin-top: 30px;
            min-width: 1200px; /* Säkerställer att tabellen inte klipps av på mindre skärmar */
        }

        /* Anpassad stil för tabellen */
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        /* Tabellhuvudet får mörk bakgrund och vit text */
        .table th {
            background-color: #343a40;
            color: white;
            text-align: center;
        }

        /* Justerar delarnas storlek och positionering */
        .table td, .table th {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        /* Stil för "Ta bort"-knappen */
        .btn-delete {
            color: white;
            background-color: #dc3545;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<!-- Knapp för att logga ut administratören -->
<div class="text-end">
    <a href="logout_admin.php" class="btn btn-warning">Logga ut</a>
</div>

<div class="container">
    <h2 class="text-center mb-4">Admin - Beställningar</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Förnamn</th>
                    <th>Efternamn</th>
                    <th>E-post</th>
                    <th>Chassi</th>
                    <th>RAM</th>
                    <th>SSD</th>
                    <th>Färg</th>
                    <th>CPU-kylning</th>
                    <th>WiFi</th>
                    <th>Övrigt</th>
                    <th>Pris</th>
                    <th>Frakt</th>
                    <th>Adress</th>
                    <th>Postnummer</th>
                    <th>Postort</th>
                    <th>Datum</th>
                    <th>Ta Bort</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['firstName']) ?></td>
                        <td><?= htmlspecialchars($order['lastName']) ?></td>
                        <td><?= htmlspecialchars($order['email']) ?></td>
                        <td><?= htmlspecialchars($order['chassi']) ?></td>
                        <td><?= htmlspecialchars($order['ram']) ?></td>
                        <td><?= htmlspecialchars($order['ssd']) ?></td>
                        <td><?= htmlspecialchars($order['color']) ?></td>
                        <td><?= htmlspecialchars($order['cooling']) ?></td>
                        <td><?= htmlspecialchars($order['wifi']) ?></td>
                        <td><?= htmlspecialchars($order['thoughts']) ?></td>
                        <td><?= htmlspecialchars($order['totalPrice']) ?> kr</td>
                        <td><?= htmlspecialchars($order['shipping']) ?></td>
                        <td><?= htmlspecialchars($order['address'] ?? 'Ej angivet') ?></td>
                        <td><?= htmlspecialchars($order['postnummer'] ?? 'Ej angivet') ?></td>
                        <td><?= htmlspecialchars($order['postort'] ?? 'Ej angivet') ?></td>
                        <td><?= htmlspecialchars($order['created_at']) ?></td>
                        <td>
                            <a href="?delete=<?= $order['id'] ?>" class="btn-delete" onclick="return confirm('Är du säker på att du vill ta bort denna beställning?');">Ta bort</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
