<?php
header('Content-Type: text/html; charset=ISO-8859-1');
session_start();

// Hantera inloggning
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Väljer användarnamn och lösenord
    if ($username === 'Nils' && $password === 'Love') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_orders.php");
        exit();
    } else {
        $error = "Fel!";
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Admin Login</h2>

        <?php if (isset($error)): ?>
            <div class="error text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?> 

        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Användarnamn</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Lösenord</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Logga in</button>
        </form>
    </div>
</body>
</html>