<?php
// Conexión a la base de datos
include '../bd/conn.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['Nombre']);
    $apellidos = $conn->real_escape_string($_POST['Apellidos']);
    $numeroIdentificacion = $conn->real_escape_string($_POST['NumeroIdentificacion']);
    $correo = $conn->real_escape_string($_POST['Correo']);
    $usuario = $conn->real_escape_string($_POST['Usuario']);
    $rol = $_POST['Rol'];
    $contraseña = ($conn->real_escape_string($_POST['Contraseña']));

    // Verificar si el usuario o correo ya existen
    $verificarUsuario = "SELECT * FROM usuarios WHERE Usuario = '$usuario' OR Correo = '$correo' OR NumeroIdentificacion = '$numeroIdentificacion'";
    $resultado = $conn->query($verificarUsuario);

    if ($resultado->num_rows > 0) {
        echo "El usuario, correo o número de identificación ya existen. Por favor, elige otros.";
    } else {
        // Insertar nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (Nombre, Apellidos, NumeroIdentificacion, Correo, Usuario, Contraseña, Rol) 
                VALUES ('$nombre', '$apellidos', '$numeroIdentificacion', '$correo', '$usuario', '$contraseña', '$rol')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../views/indexAdmin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
