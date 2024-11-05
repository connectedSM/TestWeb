<?php
    $conn = new mysqli('localhost', 'root', '', 'bdconnected');
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idTarea = $_POST['idTarea'];
        $descripcion = $_POST['descripcion'];

        // Actualizar la tarea con la descripción del motivo pendiente
        $sql = "UPDATE tareas SET Estado = 'Pendiente', Descripcion = ? WHERE idTarea = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $descripcion, $idTarea);

        if ($stmt->execute()) {
            echo "Tarea actualizada correctamente.";
            header("Location: ../views/tableroTareas.php"); // Redirigir a la vista de tareas
        } else {
            echo "Error al actualizar la tarea.";
        }
    }
?>
