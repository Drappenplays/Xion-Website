<?php
session_start();
session_unset(); // Tar bort alla session-variabler
session_destroy(); // Förstör sessionen


// Omdirigerar till inloggningssidan
header("Location: admin_login.php");
exit();
?>
