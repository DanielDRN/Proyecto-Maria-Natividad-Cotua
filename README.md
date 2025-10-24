Guía de Instalación
Este proyecto es de código abierto y su uso es completamente libre para cualquier propósito (académico, personal o comercial).🚀 

Inicio Rápido (Requisitos)
Para poder ejecutar esta aplicación en tu entorno local, necesitarás un servidor web local y la gestión de la base de datos $\text{MySQL}$.

Servidor Web Local: Necesitas XAMPP (recomendado) o $\text{WAMP}$ instalado.

⚙️ Configuración del Entorno
Sigue estos pasos para poner el proyecto en funcionamiento:

1. Colocar Archivos del ProyectoLocaliza el directorio de instalación de XAMPP.
2. Copia la carpeta completa de este proyecto (nombre_del_proyecto) dentro del subdirectorio htdocs.
3. Ruta Típica: C:\xampp\htdocs\

Configuración de la Base de Datos
Abre el panel de control de XAMPP e inicia los módulos de Apache y MySQL.
Abre tu navegador web y navega a http://localhost/phpmyadmin.
Crea una nueva base de datos con el nombre que prefieras (ej. mi_proyecto_db).
Selecciona la base de datos recién creada y ve a la pestaña "Importar".
Selecciona el archivo .sql de la base de datos que se incluye en este proyecto (generalmente llamado [nombre_del_proyecto].sql) e impórtalo. 
Esto creará todas las tablas necesarias.

⚠️ IMPORTANTE: Asegúrate de que los detalles de conexión a la base de datos en tus archivos $\text{PHP}$ (ej. conexion.php o similar) coincidan con la base de datos que acabas de crear (root como usuario y contraseña vacía por defecto en $\text{XAMPP}$).3. Acceso a la AplicaciónUna vez completados los pasos anteriores, puedes acceder a la aplicación desde tu navegador:http://localhost/nombre_del_proyecto/index.php
