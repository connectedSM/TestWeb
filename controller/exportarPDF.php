<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Crear instancia de Dompdf
$dompdf = new Dompdf();

$conn = new mysqli('localhost', 'root', '', 'bdconnected');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT idTarea, Descripcion, Estado, FechaAsignacion, FechaFinalizacion FROM tareas WHERE Estado = 'Pendiente'";
$result = $conn->query($sql);

// Generar contenido HTML para el PDF
$html = '<h1>Tareas Pendientes</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="10">';
$html .= '<thead><tr><th>ID</th><th>Descripción</th><th>Estado</th><th>Fecha de Creación</th><th>Fecha de Actualización</th></tr></thead>';
$html .= '<tbody>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['idTarea'] . '</td>';
        $html .= '<td>' . $row['Descripcion'] . '</td>';
        $html .= '<td>' . $row['Estado'] . '</td>';
        $html .= '<td>' . $row['FechaAsignacion'] . '</td>';
        $html .= '<td>' . $row['FechaFinalizacion'] . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="5">No hay tareas pendientes.</td></tr>';
}

$html .= '</tbody></table>';

// Cargar el HTML en dompdf
$dompdf->loadHtml($html);

// Configurar el tamaño y la orientación del papel
$dompdf->setPaper('A4', 'landscape');

// Renderizar el PDF
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream("tareas_pendientes.pdf", array("Attachment" => 1));
