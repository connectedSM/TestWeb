<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Clientes</title>
    <script src="../js/nav.js"></script>   
    <link rel="stylesheet" href="../css/creacion.css">
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
    .nav-menu ul {
        display: none;
        flex-direction: column;
        align-items: flex-start;
        background-color: rgba(39, 39, 39, 0.8);
        position: absolute;
        top: 75px;
        left: 0;
        width: 75%;
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
        <main class="form-container">
            <header>
                <h1>Creación de Clientes</h1>
            </header>
            <form action="../controller/crearCliente.php" method="post">
                <div class="input-box">
                    <label for="Lugar">Nombre del Lugar:</label>
                    <input type="text" id="Lugar" name="Lugar" class="input-field" required>
                </div>
                <div class="input-box">
                    <label for="Nit">NIT:</label>
                    <input type="text" id="Nit" name="Nit" class="input-field" required>
                </div>
                <div class="input-box">
                    <label for="NumeroContacto">Numero del Contacto:</label>
                    <input type="text" id="NumeroContacto" name="NumeroContacto" class="input-field" required>
                </div>
                <div class="input-box">
                    <label for="CorreoContacto">Correo de Contacto:</label>
                    <input type="text" id="CorreoContacto" name="CorreoContacto" class="input-field" required>
                </div>
                

                <button type="submit" class="submit">Crear Cliente</button>
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
