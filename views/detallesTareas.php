<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Tarea</title>
    <link rel="stylesheet" href="../css/detalles.css">
</head>
<body>
    <div class="wrapper">
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
        <header>
            <h1>Detalles de Tarea</h1>
        </header>
        <section>
            <?php
                $conn = new mysqli('localhost', 'root', '', 'bdconnected');
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $idTarea = isset($_GET['idTarea']) ? $_GET['idTarea'] : null; // Obtener el ID de la tarea
                if ($idTarea) {
                    $sql = "SELECT Descripcion, Estado FROM tareas WHERE idTarea = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $idTarea);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $tarea = $result->fetch_assoc();

                    if ($tarea) {
                        echo "<h2>" . $tarea['Descripcion'] . "</h2>";
                        echo "<p>Estado: " . $tarea['Estado'] . "</p>";
                    } else {
                        echo "<p>Tarea no encontrada.</p>";
                    }
                } else {
                    echo "<p>ID de tarea no proporcionado.</p>";
                }
            ?>
            <form method="post" action="../controller/actualizarEstado.php">
                <input type="hidden" name="idTarea" value="<?php echo $idTarea; ?>">
                <button type="submit" name="estado" value="Finalizada">Marcar como Finalizada</button>
                <button type="button" onclick="redirigirPendiente(<?php echo $idTarea; ?>)">Marcar como Pendiente</button>
            </form>
        </section>
    </div>
    <script>
        function toggleMenu() {
            var navList = document.getElementById('nav-list');
            navList.classList.toggle('active');
        }

        function logout() {
            window.location.href = 'indexLogin.html';
        }

        function redirigirPendiente(idTarea) {
        window.location.href = "motivoPendiente.php?idTarea=" + idTarea;
    }
    </script>
</body>
</html>
