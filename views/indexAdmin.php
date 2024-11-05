<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal del Administrador</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <script src="../js/nav.js"></script>
</head>
<body>
    <style>

    </style>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-menu-btn" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-logo">
                <img src="../img/LogoEmp.jpeg" alt="Logo de la empresa">
            </div>
            <div class="nav-menu">
                <ul id="nav-list">
                    <li><a class="link" href="asignacion.php">Asignación de Tareas</a>
                        <ul>
                            <li><a href="calendario.php">Calendario</a></li>
                        </ul>
                    </li>
                    <li><a class="link" href="verTareasFinalizadas.php">Tareas Finalizadas</a></li>
                    <li><a class="link" href="verTareasPendientes.php">Tareas Pendientes</a></li>
                    <li><a class="link" href="editarDatosAdmin.php">Editar Datos Personales</a></li>
                    <li><a class="link" href="creacion.php">Creación de Clientes</a></li>
                    <li><a class="link" href="crearUsuario.html">Creación de Usuarios</a></li>
                </ul>
                <button class="logout-btn" onclick="logout()">Cerrar Sesión</button>
            </div>
        </nav>

        <header>
            <h1>Bienvenido Administrador</h1>
        </header>
        <section>
            <h2>Usuarios a su cargo</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ejemplo de conexión a la base de datos y consulta de usuarios
                    $conn = new mysqli('localhost', 'root', '', 'bdconnected');
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }
                    $sql = "SELECT idUsuario, Nombre, Apellidos, Usuario FROM usuarios";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["idUsuario"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Apellidos"]. "</td><td>" . $row["Usuario"]. "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 usuarios</td></tr>";
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
