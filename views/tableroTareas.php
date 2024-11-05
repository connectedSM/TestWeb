<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tableroTareas.css">
    <title>Tablero de Tareas</title>
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
            <h1>Tablero de Tareas</h1>
        </header>
        <section>
            <h2>Tareas asignadas</h2>
            <table class="task-table">
                <thead>
                    <tr>
                        <th>ID Tarea</th>
                        <th>Descripción</th>
                        <th>Fecha de Asignación</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'bdconnected');
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $sql = "SELECT tareas.idTarea, tareas.Descripcion, tareas.FechaAsignacion, tareas.Hora, Clientes.Lugar, tareas.Estado 
                            FROM tareas 
                            INNER JOIN Clientes ON tareas.idCliente = Clientes.idCliente 
                            WHERE tareas.idUsuario = tareas.idUsuario"; // Cambia por la variable de sesión del usuario

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["idTarea"]. "</td>
                                    <td>" . $row["Descripcion"]. "</td>
                                    <td>" . $row["FechaAsignacion"]. "</td>
                                    <td>" . $row["Hora"]. "</td>
                                    <td>" . $row["Lugar"]. "</td>
                                    <td>" . $row["Estado"]. "</td>
                                    <td><a href='detallesTareas.php?idTarea=" . $row["idTarea"] . "'>Ver</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 tareas</td></tr>";
                    }

                    $conn->close();
                ?>
                </tbody>
            </table>
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
    </script>
</body>
</html>
