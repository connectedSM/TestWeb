<?php
include '../bd/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $usuario = $_POST['Usuario'];
    $rol = $_POST['Rol'];
    $contraseña = $_POST['Contraseña'];

    if ($rol === 'Administrador') {
        $sql = "INSERT INTO administrador (Nombre, Apellidos, Correo, Usuario, Contraseña, Rol) VALUES (?, ?, ?, ?, ?, ?)";
    } else {
        $sql = "INSERT INTO usuarios (Nombre, Apellidos, Correo, Usuario, Contraseña, Rol) VALUES (?, ?, ?, ?, ?, ?)";
    }


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellidos, $correo, $usuario, $contraseña, $rol );

    if ($stmt->execute()) {
        // Redirigir según el rol
        if ($rol === 'Administrador') {
            header("Location: ../views/indexAdmin.php");
        } else {
            header("Location: ../views/indexUser.html");
        }
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>


