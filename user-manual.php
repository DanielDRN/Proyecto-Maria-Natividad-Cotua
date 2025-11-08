<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manual</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>
    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip"><i class="fas fa-history"></i> Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="registro_gestion.php"><i class="fas fa-user-plus"></i> Registro</a>
                <a href="gestion.php"><i class="fas fa-cogs"></i> Gestion</a>
                <a href="acciones/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Session</a>
                <a class="usuario"><i class="fas fa-user-circle"></i> Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></a>
            <?php else: ?>
                <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <section class="carousel" aria-label="Carrusel de imágenes del manual" id="manualCarousel">
            <div class="carousel-track">
                <div class="slide"><img src="img/userManual/Paso 1.png" alt="Manual paso 1"></div>
                <div class="slide"><img src="img/userManual/Paso 1 (1).png" alt="Manual paso 2"></div>
                <div class="slide"><img src="img/userManual/Paso 1 (2).png" alt="Manual paso 3"></div>
                <div class="slide"><img src="img/userManual/Paso 1 (3).png" alt="Manual paso 4"></div>
                <div class="slide"><img src="img/userManual/Paso 1 (4).png" alt="Manual paso 5"></div>
            </div>

            <button class="carousel-btn prev" aria-label="Anterior"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="carousel-btn next" aria-label="Siguiente"><i class="fa-solid fa-arrow-right"></i></button>

            <div class="carousel-dots" aria-hidden="false"></div>
        </section>
    </main>
    <footer>
        <i class="fas fa-copyright"></i> 2025. Software de Registro y Gestión de Representantes. Diseñado y desarrollado por los estudiantes de la Universidad Francisco Tamayo. Todos los derechos reservados.
    </footer>
    <script src="js/carrusel.js"></script>
</body>
</html>