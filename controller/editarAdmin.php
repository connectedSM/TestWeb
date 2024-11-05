<?php
// Conexión a la base de datos
include '../bd/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $usuario = $_POST['Usuario'];
    $contraseña = $_POST['Contraseña'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE administrador SET Nombre = ?, Apellidos = ?, Correo = ?, Usuario = ?, Contraseña = ? WHERE idAdmin = idAdmin";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $nombre, $apellidos, $correo, $usuario, $contraseña);

    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
        header("Location: ../views/indexAdmin.php");
    } else {
        echo "Error al actualizar los datos: " . $stmt->error;
        header("Location: ../views/editarDatosAdmin.php");
    }

    $stmt->close();
    $conn->close();
}
?>
