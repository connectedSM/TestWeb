<?php
$conn = new mysqli('localhost', 'root', '', 'bdconnected');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idTarea = $_POST['idTarea'];
    $nuevoEstado = $_POST['estado'];

    $sql = "UPDATE tareas SET Estado = ?, FechaFinalizacion = NOW() WHERE idTarea = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevoEstado, $idTarea);

    if ($stmt->execute()) {
        header("Location: ../views/indexUser.html");
        exit();
    } else {
        echo "Error al actualizar el estado de la tarea: " . $conn->error;
    }
}

$conn->close();
?>
