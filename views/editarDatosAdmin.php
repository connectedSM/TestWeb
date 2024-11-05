<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos Personales</title>
    <link rel="stylesheet" href="../css/editarAdmin.css">
    <script src="../js/nav.js"></script>
    <style>
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
        padding: 5px 10px;
        transition: transform 0.3s ease-in-out;
    }

    .nav-menu ul.active {
        display: flex;
        transform: translateX(0);
    }

    .nav-menu ul li .link {
        padding: 6px 12px;
        margin: 10px 20px;
        width: 100%;
        text-align: left;
    }

    .nav-menu-btn {
        display: flex;
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
                            <li><a href="calendario.php">Calendario</a></li>
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
        <main class="form-container">
            <header>
                <h1>Editar Datos Personales</h1>
            </header>
            <form action="../controller/editarAdmin.php" method="post">
                <div class="input-box">
                    <label for="Nombre">Nombre:</label>
                    <input type="text" id="Nombre" name="Nombre" class="input-field" required>
                </div>

                <div class="input-box">
                    <label for="Apellidos">Apellidos:</label>
                    <input type="text" id="Apellidos" name="Apellidos" class="input-field" required>
                </div>

                <div class="input-box">
                    <label for="Correo">Correo Electrónico:</label>
                    <input type="email" id="Correo" name="Correo" class="input-field" required>
                </div>

                <div class="input-box">
                    <label for="Usuario">Usuario:</label>
                    <input type="text" id="Usuario" name="Usuario" class="input-field" required>
                </div>

                <div class="input-box">
                    <label for="Contraseña">Contraseña:</label>
                    <input type="password" id="Contraseña" name="Contraseña" class="input-field" required>
                </div>
                <button type="submit" class="submit">Guardar Cambios</button>
            </form>
        </main>
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
