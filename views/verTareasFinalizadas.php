<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <title>Tareas Finalizadas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/exportToF.js"></script>
    <link rel="stylesheet" href="../css/verTareasFin.css">
    <style>
                /* Menú desplegable para móviles */
    .nav-menu-btn {
    display: none;
    flex-direction: column;
    cursor: pointer;
}

.nav-menu-btn span {
    background: white;
    width: 25px;
    height: 2px;
    margin: 4px;
}

/* Responsivo */
@media only screen and (max-width: 768px) {
    .nav{
        padding: 35px;
        width: 115%;
    }
    .nav-menu ul {
        display: none;
        flex-direction: column;
        align-items: flex-start;
        background-color: rgba(39, 39, 39, 0.8);
        position: absolute;
        top: 75px;
        left: 35px;
        width: 60%;
        padding: 10px 0;
        transition: transform 0.3s ease-in-out;
    }

    .nav-menu ul.active {
        display: flex;
        transform: translateX(0);
    }

    .nav-menu ul li .link {
        padding: 12px 24px;
        margin: 15px 30px;
        width: 100%;
        text-align: left;
    }

    .nav-menu-btn {
        display: flex;
    }

    .logout-btn {
        width: 100%;
        text-align: center;
        padding: 20px 15px;
        margin-top: 20px;
    }
}
    </style>
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
                    <li><a class="link" href="indexAdmin.php">Inicio</a></li>
                    <li>
                        <a class="link" href="asignacion.php">Asignación de Tareas</a>
                        <ul>
                            <li><a class="link" href="calendario.php">Calendario</a></li>
                        </ul>
                    </li>
                    <li><a class="link" href="verTareasFinalizadas.php">Tareas Finalizadas</a></li>
                    <li><a class="link" href="verTareasPendientes.php">Tareas Pendientes</a></li>
                    <li><a class="link" href="editarDatosAdmin.php">Editar Datos Personales</a></li>
                    <li><a class="link" href="creacion.php">Creación de Clientes</a></li>
                    <li><a class="link" href="crearUsuario.html">Creación de Usuarios</a></li>
                </ul>
            </div>
        </nav>
  
        <header>
            <h1>Tareas Finalizadas</h1>
        </header>
        <section>
            <h2>Lista de Tareas Finalizadas</h2>
            <table id="taskTable" class="task-table">
                <thead>
                    <tr>
                        <th>ID Tarea</th>
                        <th>Descripción</th>
                        <th>Fecha de Asignación</th>
                        <th>Fecha de Finalización</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = new mysqli('localhost', 'root', '', 'bdconnected');
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $sql = "SELECT idTarea, Descripcion, FechaAsignacion, FechaFinalizacion
                            FROM tareas WHERE Estado = 'Finalizada'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["idTarea"]. "</td>
                                    <td>" . $row["Descripcion"]. "</td>
                                    <td>" . $row["FechaAsignacion"]. "</td>
                                    <td>" . $row["FechaFinalizacion"]. "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 tareas finalizadas</td></tr>";
                    }

                    $conn->close();
                ?>
                </tbody>
            </table>
                <button class="export-btn" onclick="generatePDF()">
                    <i class="fa fa-file-pdf-o"></i> Exportar a PDF</button>
                <button class="export-btn" onclick="exportToExcelXLSX()">
                    <i class="fa fa-file-excel-o"></i> Exportar a Excel (.xlsx)</button>
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