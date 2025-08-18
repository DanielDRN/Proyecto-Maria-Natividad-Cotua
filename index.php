<?php
    include("acciones/conexion.php");
    include("acciones/accIndex.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Maria Natividad Cotua</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/png" href="img/logo.ico">
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>
    <div id="modalerror" class="modal">
        <div class="modal-content">
            <span id="cerrarModal">&times;</span>
            <h2>Error de inicio de sesión</h2>
            <p id="mensajeError"></p>
        </div>
    </div>

    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip">Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Documentation</a>
            <a href="#" download="ManualdeUsuario.pdf">User Manual</a>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="login-container">
            <h1>INICIA SESIÓN<br>EN TU CUENTA</h1>
            <form method="POST" action="">
                <div class="input-group">
                    <input type="text" name="usuario" placeholder="Username: " oninput="this.value = this.value.replace(/[.,@]/g, '')" required>
                </div>
                <div class="input-group">
                    <input type="password" name="clave" placeholder="Password :" oninput="this.value = this.value.replace(/[.,@]/g, '')" required>
                </div>
                <button class="login" type="submit" name="login">LOGIN</button>
                <br>
                <br>
                <button class="login" type="submit" name="registro">REGISTER</button>
            </form>
        </div>
        <div class="card-grid">
            <div class="card fade-in" style="animation-delay: 0.1s;">
                <div class="card-image">
                    <img src="img/Estudiantes.jpeg" alt="Biblioteca">
                </div>
                <div class="card-content">
                    <h3>Estudiantes</h3>
                    <p>Estudiantes de primero a tercer año de la Maria Natividad Cotua</p>
                </div>
            </div>
            <div class="card fade-in" style="animation-delay: 0.2s;">
                <div class="card-image">
                    <img src="img/salon_computacion.jpeg" alt="Calendario">
                </div>
                <div class="card-content">
                    <h3>Salon de Computación</h3>
                    <p>Salon donde los Estudiantes obtienen conocimiento sobre el mundo informatico</p>
                </div>
            </div>
            <div class="card fade-in" style="animation-delay: 0.3s;">
                <div class="card-image">
                    <img src="img/directivo.jpeg" alt="Directivo">
                </div>
                <div class="card-content">
                    <h3>Directivo</h3>
                    <p>Directora Del Maria Natividad Cotua</p>
                </div>
            </div>
            <div class="card fade-in" style="animation-delay: 0.4s;">
                <div class="card-image">
                    <img src="img/comunidad.jpeg" alt="Comunidad">
                </div>
                <div class="card-content">
                    <h3>Comunidad</h3>
                    <p>Más que un liceo, una familia educativa.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/app_index.js"></script>
    <footer>
        © 2025. Software de Registro y Gestión de Representantes. Diseñado y desarrollado por los estudiantes de la Universidad Francisco Tamayo. Todos los derechos reservados.
    </footer>
</body>
</html>
