<?php
    include("acciones/registro.php");
    session_start();
    if (empty($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="icon" type="image/png" href="img/logo.ico">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Natividad Cotua</h2>
                <button class="sidebar-toggle" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="nav-item active">
                    <i class="fas fa-user-tie"></i>
                    <span class="nav-text">Representantes</span>
                </a>
                <a href="gestion.php" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Registrados</span>
                </a>
                <a href="index.php" class="nav-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Cerrar Sesión</span>
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <h1 class="page-title">Registro de Representantes y Estudiantes</h1>
            </header>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Información del Representante</h2>
                </div>
                <form id="registroCompleto" method="post" action="">
                    <div class="registroCompleto">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Cédula:</label>
                            <input type="text" class="form-control"  placeholder="Ingrese su Cedula" name="cedula" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form-control" placeholder="Ingrese su Nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Apellido:</label>
                            <input type="text" class="form-control" placeholder="Ingrese su Apellido" name="apellido" required>
                        </div>
                            <div class="form-group">
                                <label class="form-label">Genero</label>
                                <select class="form-control" name="genero" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" placeholder="Ingrese su Telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Correo:</label>
                            <input type="email" class="form-control" placeholder="Ingrese su Email" name="correo">
                        </div>
                        <div class="form-group">
                            <label class="form-label">direccion</label>
                            <input type="text" class="form-control" placeholder="Ingrese su direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Parentesco:</label>
                                <select class="form-control" name="parentesco" required>
                                    <option   option value="">Seleccione...</option>
                                    <option value="Padre">Padre</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Abuelo/a">Abuelo/a</option>
                                    <option value="Tío/a">Tío/a</option>
                                    <option value="Hermano/a">Hermano/a</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3>Estudiantes</h3>
                    <div id="estudiantes">
                        <div class="estudiante">
                            <div class="form-group">
                                <label class="form-label">Cédula:</label>
                                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Cedula" name="cedula_estudiante[]" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre_estudiante[]" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Apellido:</label>
                                <input type="text" class="form-control" placeholder="Apellido" name="apellido_estudiante[]" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">direccion:</label>
                                <input type="text" class="form-control" placeholder="direccion" name="direccion_estudiante[]" required>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Grado:</label>
                            <select class="form-control" name="grado_estudiante[]" required>
                            <option value="">Seleccione</option>
                            <option value="1er año Seccion A">1er Año Seccion A</option>
                            <option value="1er año Seccion B">1er Año Seccion B</option>
                            <option value="1er año Seccion C">1er Año Seccion C</option>
                            <option value="2er año Seccion A">2er Año Seccion A</option>
                            <option value="2er año Seccion C">2er Año Seccion C</option>
                            <option value="2er año Seccion B">2er Año Seccion A</option>
                            <option value="3er año Seccion A">3er Año Seccion A</option>
                            <option value="3er año Seccion B">3er Año Seccion B</option>
                            <option value="3er año Seccion C">3er Año Seccion C</option>
                            <option value="4to año Seccion A">4to Año Seccion A</option>
                            <option value="4to año Seccion B">4to Año Seccion B</option>
                            <option value="4to año Seccion C">4to Año Seccion C</option>
                            <option value="5to año Seccion A">5to Año Seccion A</option>
                            <option value="5to año Seccion B">5to Año Seccion B</option>
                            <option value="5to año Seccion C">5to Año Seccion C</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="agregarEstudiante()"><i class="fas fa-plus"></i> Agregar otro estudiante</button>
                    <br><br>
                    <button type="submit" name="registrar_todo" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Registrar</button>
                </form>
            </div>
        </main>
    </div>
    <script src="js/app.js"></script>
</body>
</html>