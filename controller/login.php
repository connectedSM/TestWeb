<?php
// Incluir el archivo de conexión a la base de datos
include('../bd/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'];
    $contraseña = $_POST['Contraseña'];

    // Consulta en la tabla de administradores
    $query_admin = "SELECT * FROM administrador WHERE Usuario = ? AND Contraseña = ?";
    if ($stmt_admin = $conn->prepare($query_admin)) {
        $stmt_admin->bind_param("ss", $usuario, $contraseña);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        if ($result_admin->num_rows == 1) {
            header("Location: ../views/indexAdmin.php");
            exit();
        }
        
        $stmt_admin->close();
    }

    // Consulta en la tabla de usuarios
    $query_user = "SELECT * FROM usuarios WHERE Usuario = ? AND Contraseña = ?";
    if ($stmt_user = $conn->prepare($query_user)) {
        $stmt_user->bind_param("ss", $usuario, $contraseña);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows == 1) {
            header("Location: ../views/indexUser.html");
            exit();
        }

        $stmt_user->close();
    }

    // Si no se encuentra el usuario en ninguna tabla
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>
