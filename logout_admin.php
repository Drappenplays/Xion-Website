<?php
session_start();
session_unset(); // Tar bort alla session-variabler
session_destroy(); // F�rst�r sessionen


// Omdirigerar till inloggningssidan
header("Location: admin_login.php");
exit();
?>
