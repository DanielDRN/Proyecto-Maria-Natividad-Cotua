<?php
    include("acciones/conexion.php");
    include("acciones/accIndex.php");
    include("acciones/acclogin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Maria Natividad Cotua</title>
    
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>
    <div id="modalerror" class="modal">
    <div class="modal-content">
        <span id="cerrarModal">&times;</span> 
        <h2><i class="fas fa-exclamation-triangle"></i> Error de inicio de sesión</h2>
        <p id="mensajeError"></p>
    </div>
</div>

    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip"><i class="fas fa-history"></i> Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="user-manual.php" ><i class="fas fa-book"></i> User Manual</a>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="login-container">
            <h1 id="loginTitle"><i class="fas fa-lock"></i> INICIA SESIÓN<br>EN TU CUENTA</h1>
            <form method="POST" action="">
                <br>
                <div class="input-group">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="usuario" placeholder="Username: " oninput="this.value = this.value.replace(/[.,@]/g, '')" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-key icon"></i>
                    <input type="password" name="clave" placeholder="Password :" oninput="this.value = this.value.replace(/[.,@]/g, '')" required>
                </div>
                <button id="submitBtn" class="login" type="submit" name="login"><i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN</button>
            </form>
            <div class="link-registro-container">
                <span class="link-registro" id="Registrarse"><i class="fas fa-user-plus"></i> Registrarse</span>
            </div>
        </div>
        <div class="card-grid">
            <div class="card fade-in" style="animation-delay: 0.1s;">
                <div class="card-image">
                    <img src="img/Estudiantes.jpeg" alt="Biblioteca">
                </div>
                <div class="card-content">
                    <h3><i class="fas fa-graduation-cap"></i> Estudiantes</h3>
                    <p>Estudiantes de primero a tercer año de la Maria Natividad Cotua</p>
                </div>
            </div>
            <div class="card fade-in" style="animation-delay: 0.2s;">
                <div class="card-image">
                    <img src="img/salon_computacion.jpeg" alt="Calendario">
                </div>
                <div class="card-content">
                    <h3><i class="fas fa-desktop"></i> Salon de Computación</h3>
                    <p>Salon donde los Estudiantes obtienen conocimiento sobre el mundo informatico</p>
                </div>
            </div>
            <div class="card fade-in" style="animation-delay: 0.3s;">
                <div class="card-image">
                    <img src="img/directivo.jpeg" alt="Directivo">
                </div>
                <div class="card-content">
                    <h3><i class="fas fa-user-tie"></i> Directivo</h3>
                    <p>Directora Del Maria Natividad Cotua</p>
                </div>
            </div>
            <div class="card fade-in" style="animation-delay: 0.4s;">
                <div class="card-image">
                    <img src="img/comunidad.jpeg" alt="Comunidad">
                </div>
                <div class="card-content">
                    <h3><i class="fas fa-users"></i> Comunidad</h3>
                    <p>Más que un liceo, una familia educativa.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/app_index.js"></script>
    <script src="js/Modal_Manager.js"></script>
    <footer>
        <i class="fas fa-copyright"></i> 2025. Software de Registro y Gestión de Representantes. Diseñado y desarrollado por los estudiantes de la Universidad Francisco Tamayo. Todos los derechos reservados.
    </footer>
</body>
</html>