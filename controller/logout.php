<?php
session_start();
session_unset();
session_destroy();
header("Location: ../views/indexLogin.html"); // Redirige a la página de inicio de sesión o principal después de cerrar sesión
exit();
?>
