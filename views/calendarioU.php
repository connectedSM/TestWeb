<?php require_once('../bd/conn.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="../css/calendario.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../fullcalendar/lib/main.min.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/es.js"></script>
    <script src="../js/script.js"></script>    
</head>
<body class="bg-light">
    <nav class="nav">
        <div class="nav-logo">
            <img src="../img/LogoEmp.jpeg" alt="Logo de la empresa">
        </div>
        <div class="nav-menu-btn" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-menu">
            <ul id="nav-list">
                <li><a class="link" href="indexUser.html">Inicio</a></li>
                <li><a class="link" href="detallesTareas.php">Detalles</a></li>
                <li><a class="link" href="tableroTareas.php">Mis Tareas</a></li>
                <li><a class="link" href="calendarioU.php">Calendario</a></li>
            </ul>
        </div>
    </nav>

    <div class="container py-5" id="page-container">
        <div id="calendar"></div>
    </div>

<!-- Modal para visualizar detalles de la tarea -->
<div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header rounded-0">
                <h5 class="modal-title">Detalles de la Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body rounded-0">
                <div class="container-fluid">
                    <dl>
                        <dt class="text-muted">Usuario</dt>
                        <dd id="usuario" class="fw-bold fs-4"></dd>
                        <dt class="text-muted">Descripción</dt>
                        <dd id="descripcion" class=""></dd>
                        <dt class="text-muted">Inicio</dt>
                        <dd id="start" class=""></dd>
                        <dt class="text-muted">Fin</dt>
                        <dd id="end" class=""></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php 
    // Modificar la consulta para obtener las tareas
    $tareas = $conn->query("SELECT t.*, u.Usuario FROM tareas t JOIN usuarios u ON t.idUsuario = u.idUsuario");
    $tareas_res = [];
    foreach($tareas->fetch_all(MYSQLI_ASSOC) as $row){
        $row['sdate'] = date("Y-m-d H:i", strtotime($row['FechaAsignacion'].' '.$row['Hora']));
        $tareas_res[$row['idTarea']] = $row;
    }
    ?>
    <script>
        var tasks = $.parseJSON('<?= json_encode($tareas_res) ?>');


//Elementos del modal

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: Object.values(tasks).map(task => ({
            title: task.Usuario + ": " + task.Descripcion,
            start: task.sdate,
            end: task.edate,
            id: task.idTarea  // Aseguramos que el ID de la tarea esté disponible
        })),
        eventClick: function(info) {
            var task = tasks[info.event.id];
            $('#usuario').text(task.Usuario);
            $('#descripcion').text(task.Descripcion);
            $('#start').text(task.sdate);
            $('#end').text(task.edate); 
            $('#event-details-modal').modal('show');

            // Manejar la eliminación de la tarea
            $('#delete-task-btn').off('click').on('click', function() {
                // Confirmar la eliminación
                if (confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
                    // Eliminar la tarea del calendario
                    info.event.remove();

                    // Hacer la petición AJAX para eliminar la tarea de la base de datos
                    $.ajax({
                        url: '../controller/eliminarTarea.php',  // Ruta al archivo que eliminará la tarea
                        method: 'POST',
                        data: { idTarea: task.idTarea },
                        success: function(response) {
                            alert('Tarea eliminada exitosamente.');
                            $('#event-details-modal').modal('hide');
                        },
                        error: function() {
                            alert('Ocurrió un error al eliminar la tarea.');
                        }
                    });
                }
            });
        }
    });
    calendar.render();
});

function toggleMenu() {
            var navList = document.getElementById('nav-list');
            navList.classList.toggle('active');
        }

        function logout() {
            window.location.href = 'indexLogin.html';
        }
    </script>
</body>
</html>
