<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sammanfattning</title>
</head>
<body>

    <h1>Beställning Sammanfattning</h1>
    <p><strong>Förnamn:</strong> <?php echo htmlspecialchars($_POST['firstName']); ?></p>
    <p><strong>Efternamn:</strong> <?php echo htmlspecialchars($_POST['lastName']); ?></p>
    <p><strong>E-post:</strong> <?php echo htmlspecialchars($_POST['email']); ?></p>
    <p><strong>Frakt:</strong> <?php echo htmlspecialchars($_POST['shipping']); ?></p>
    <?php if ($_POST['shipping'] === "Ja"): ?>
        <p><strong>Adress:</strong> <?php echo htmlspecialchars($_POST['address']); ?></p>
        <p><strong>Postnummer:</strong> <?php echo htmlspecialchars($_POST['postnummer']); ?></p>
        <p><strong>Postort:</strong> <?php echo htmlspecialchars($_POST['postort']); ?></p>
    <?php endif; ?>

    <p><strong>Chassi:</strong> <?php echo htmlspecialchars($_POST['chassi']); ?></p>
    <p><strong>RAM:</strong> <?php echo htmlspecialchars($_POST['ram']); ?></p>
    <p><strong>SSD:</strong> <?php echo htmlspecialchars($_POST['ssd']); ?></p>
    <p><strong>Färg:</strong> <?php echo htmlspecialchars($_POST['color']); ?></p>
    <p><strong>CPU-Kylning:</strong> <?php echo htmlspecialchars($_POST['cooling']); ?></p>
    <p><strong>WiFi:</strong> <?php echo htmlspecialchars($_POST['wifi']); ?></p>
    <p><strong>Övriga tankar:</strong> <?php echo htmlspecialchars($_POST['thoughts']); ?></p>
    <p><strong>Pris:</strong> <?php echo htmlspecialchars($_POST['totalPrice']); ?> kr</p>

    <form action="order_info.php" method="POST">
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($_POST['firstName']); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($_POST['lastName']); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
        <input type="hidden" name="shipping" value="<?php echo htmlspecialchars($_POST['shipping']); ?>">
        <input type="hidden" name="address" value="<?php echo htmlspecialchars($_POST['address']); ?>">
        <input type="hidden" name="postnummer" value="<?php echo htmlspecialchars($_POST['postnummer']); ?>">
        <input type="hidden" name="postort" value="<?php echo htmlspecialchars($_POST['postort']); ?>">
        <input type="hidden" name="chassi" value="<?php echo htmlspecialchars($_POST['chassi']); ?>">
        <input type="hidden" name="ram" value="<?php echo htmlspecialchars($_POST['ram']); ?>">
        <input type="hidden" name="ssd" value="<?php echo htmlspecialchars($_POST['ssd']); ?>">
        <input type="hidden" name="color" value="<?php echo htmlspecialchars($_POST['color']); ?>">
        <input type="hidden" name="cooling" value="<?php echo htmlspecialchars($_POST['cooling']); ?>">
        <input type="hidden" name="wifi" value="<?php echo htmlspecialchars($_POST['wifi']); ?>">
        <input type="hidden" name="thoughts" value="<?php echo htmlspecialchars($_POST['thoughts']); ?>">
        <input type="hidden" name="totalPrice" value="<?php echo htmlspecialchars($_POST['totalPrice']); ?>">
        <button type="submit">Skicka beställning</button>
    </form>

</body>
</html>
