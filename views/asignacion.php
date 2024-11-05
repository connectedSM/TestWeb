<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Tareas</title>
    <script src="../js/nav.js"></script>
    <link rel="stylesheet" href="../css/asignacion.css">
    <style>
        /*  */
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
    .nav-menu ul {
        display: none;
        flex-direction: column;
        align-items: flex-start;
        background-color: rgba(39, 39, 39, 0.8);
        position: absolute;
        top: 75px;
        left: 0;
        width: 75%;
        padding: 10px 0px 5px;
        transition: transform 0.3s ease-in-out;
    }

    .nav-menu ul.active {
        display: flex;
        transform: translateX(0);
    }

    .nav-menu ul li .link {
        padding: 12px 24px 30px;
        margin: 0px;
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
        <section>
            <header>
                <h1>Asignación de Tareas</h1>
            </header>
            <form action="../controller/asignarTarea.php" method="post">
                <label for="Usuario">Usuario:</label>
                <select name="Usuario" id="Usuario">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'bdconnected');
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }
                    $sql = "SELECT idUsuario, Usuario FROM usuarios";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["idUsuario"] . "'>" . $row["Usuario"] . "</option>";
                        }
                    } else {
                        echo "<option>No hay usuarios</option>";
                    }
                    $conn->close();
                    ?>
                </select><br>

                <label for="Descripcion">Descripción:</label>
                <textarea name="Descripcion" id="Descripcion"></textarea><br>

                <label for="FechaAsignacion">Fecha:</label>
                <input type="date" name="FechaAsignacion" id="FechaAsignacion"><br>

                <label for="Hora">Hora:</label>
                <input type="time" name="Hora" id="Hora"><br>

                <label for="Lugar">Lugar:</label>
                <select name="idCliente" id="Lugar">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'bdconnected');
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }
                    $sql = "SELECT idCliente, Lugar FROM clientes";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["idCliente"] . "'>" . $row["Lugar"] . "</option>";
                        }
                    } else {
                        echo "<option>No hay lugares</option>";
                    }
                    $conn->close();
                    ?>
                </select><br>

                <button type="submit">Asignar Tarea</button>
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
    </script>
</body>
</html>
