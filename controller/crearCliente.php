<?php
// Conexión a la base de datos
include '../bd/conn.php';

// Capturar datos del formulario
$nombreLugar = $_POST['Lugar'];
$nit = $_POST['Nit'];
$numeroContacto = $_POST['NumeroContacto'];
$correoContacto = $_POST['CorreoContacto'];

// Validar y sanitizar datos
$nombreLugar = $conn->real_escape_string($nombreLugar);
$nit = $conn->real_escape_string($nit);
$numeroContacto = $conn->real_escape_string($numeroContacto);
$correoContacto = $conn->real_escape_string($correoContacto);

// Insertar datos en la base de datos
$sql = "INSERT INTO clientes (Lugar, Nit, NumeroContacto, CorreoContacto) 
        VALUES ('$nombreLugar', '$nit', '$numeroContacto', '$correoContacto')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo cliente creado exitosamente";
    header("Location: ../views/indexAdmin.php");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
