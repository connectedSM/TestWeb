<?php
// Conexión a la base de datos
include '../bd/conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'];
    $descripcion = $_POST['Descripcion'];
    $fechaAsignacion = $_POST['FechaAsignacion'];
    $hora = $_POST['Hora'];
    $idCliente = $_POST['idCliente']; // idCliente en lugar de Lugar

    $sql = "INSERT INTO tareas (idUsuario, Descripcion, FechaAsignacion, Hora, idCliente, Estado) VALUES (?, ?, ?, ?, ?, 'Pendiente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $usuario, $descripcion, $fechaAsignacion, $hora, $idCliente);

    if ($stmt->execute()) {
        echo "Tarea asignada exitosamente.";
        header("Location: ../views/indexAdmin.php");
    } else {
        echo "Error al asignar tarea: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
