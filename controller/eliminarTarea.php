<?php
require_once('../bd/conn.php');

if (isset($_POST['idTarea'])) {
    $idTarea = $_POST['idTarea'];
    
    // Iniciar transacción
    $conn->begin_transaction();
    
    try {
        // Eliminar la tarea
        $sqlDelete = "DELETE FROM tareas WHERE idTarea = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param('i', $idTarea);
        $stmtDelete->execute();

        // Actualizar los IDs de las tareas restantes
        $sqlUpdate = "UPDATE tareas SET idTarea = idTarea - 2 WHERE idTarea = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param('i', $idTarea);
        $stmtUpdate->execute();

        // Confirmar la transacción
        $conn->commit();

        echo json_encode(['message' => 'Tarea eliminada y IDs actualizados', 'idTarea' => $idTarea]);
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        echo json_encode(['message' => 'Error al eliminar la tarea', 'error' => $e->getMessage()]);
    }
}
?>
