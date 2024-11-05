<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivo de Tarea Pendiente</title>
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

*{  
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(to right, rgb(4, 84, 170), rgb(104, 233, 250));
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 100px;
}

.nav {
    position: fixed;
    top: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 60px;
    background: linear-gradient(rgba(39,39,39, 0.6), transparent);
    padding: 0 20px;
    z-index: 100;
}

.nav-logo img {
    width: 140px;
    height: 70px;
    margin-top: 15px;
    margin-right: 4px;
}

.nav-menu {
    display: flex;
    align-items: center;
}

.nav-menu ul {
    display: flex;
    margin-right: 20px;
}

.nav-menu ul li {
    list-style-type: none;
}

.nav-menu ul li .link {
    text-decoration: none;
    font-weight: 400;
    color: #fff;
    padding: 8px 13px;
    margin: 0 5px;
    border-radius: 20px;
    transition: background 0.3s;
}

.nav-menu ul li .link:hover, .nav-menu ul li .link.active {
    background: rgba(255, 255, 255, 0.3);
}

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

header {
    color: #fff;
    font-size: 30px;
    text-align: center;
    margin-bottom: 20px;
}

section {
    width: 80%;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

section h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    justify-content: center;
    gap: 20px;
}

form button{
    padding: 10px 20px;
    border-radius: 30px;
    border: none;
    background-color: rgba(4, 84, 170, 0.8);
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: rgba(104, 233, 250, 0.8);
}

@media only screen and (max-width: 786px) {
    .nav-menu ul {
        display: none;
        flex-direction: column;
        align-items: center;
        background-color: rgba(39, 39, 39, 0.8);
        position: absolute;
        top: 60px;
        width: 100%;
        padding: 10px 0;
    }

    .nav-menu ul.active {
        display: flex;
    }

    .nav-menu ul li .link {
        padding: 10px 20px;
        margin: 5px 0;
    }

    .nav-menu-btn {
        display: flex;
    }

    .logout-btn {
        margin-top: 10px;
    }
}
    </style>
    <div class="wrapper">
        <!-- Barra de navegación -->
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
                </ul>
            </div>
        </nav>

        <!-- Encabezado -->
        <header>
            <h1>Motivo de Tarea Pendiente</h1>
        </header>

        <!-- Sección de formulario -->
        <section>
            <form method="post" action="../controller/guardarPendiente.php">
                <input type="hidden" name="idTarea" value="<?php echo $_GET['idTarea']; ?>">

                <label for="descripcion">Descripción del motivo:</label>
                <textarea name="descripcion" id="descripcion" rows="5" required></textarea>
                
                <div class="button-group">
                    <button type="submit">Guardar Descripción</button>
                </div>
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
