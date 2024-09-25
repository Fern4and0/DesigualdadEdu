<?php
// Controllers/Beneficiarios.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Consulta para obtener los beneficiarios registrados
$sqlBeneficiarios = "
    SELECT b.id, b.nombre, b.fecha_nacimiento, b.direccion, b.nivel_edu, b.situacion_eco, p.nombre AS programa_asig, b.fecha_de_ingr
    FROM beneficiarios b
    JOIN programs p ON b.programa_asig = p.id
";
$resultBeneficiarios = $conn->query($sqlBeneficiarios); // Ejecuta la consulta

// Verifica si hay resultados
$beneficiarios = [];
if ($resultBeneficiarios->num_rows > 0) {
    while ($row = $resultBeneficiarios->fetch_assoc()) { // Recorre los resultados
        $beneficiarios[] = $row; // Almacena cada fila en el array $beneficiarios
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Beneficiarios Registrados</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../../Resources/css/Style.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/appdash.js" defer></script> <!-- Incluye el script JS -->
</head>
<body>
    <div class="sidebar" id="sidebar"> <!-- Barra lateral -->
        <div class="toggle-btn" onclick="toggleSidebar()">&#9776;</div> <!-- Botón para mostrar/ocultar la barra lateral -->
        <div class="menu"> <!-- Menú de navegación -->
            <a href="Dashboard.php">Inicio</a> <!-- Enlace a la página de inicio -->
            <a href="usuarios.php">Usuarios</a> <!-- Enlace a la página de usuarios -->
            <a href="Programas.php">Programas</a> <!-- Enlace a la página de programas -->
            <a href="Beneficiarios.php">Beneficiarios</a> <!-- Enlace a la página de beneficiarios -->
            <a href="Donaciones.php">Donaciones</a> <!-- Enlace a la página de donaciones -->
            <a href="../Login/Logout.php" class="logout-btn">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
        </div>
    </div>

    <div class="main-content"> <!-- Contenido principal -->
        <div class="header">
            <h1>Beneficiarios Registrados</h1> <!-- Título de la sección -->
        </div>

        <div class="beneficiarios-table"> <!-- Tabla de beneficiarios -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Dirección</th>
                        <th>Nivel Educativo</th>
                        <th>Situación Económica</th>
                        <th>Programa Asignado</th>
                        <th>Fecha de Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($beneficiarios) > 0): ?> <!-- Verifica si hay beneficiarios -->
                        <?php foreach ($beneficiarios as $beneficiario): ?> <!-- Recorre cada beneficiario -->
                            <tr>
                                <td><?= $beneficiario['id']; ?></td> <!-- Muestra el ID del beneficiario -->
                                <td><?= htmlspecialchars($beneficiario['nombre']); ?></td> <!-- Muestra el nombre del beneficiario -->
                                <td><?= date('d/m/Y', strtotime($beneficiario['fecha_nacimiento'])); ?></td> <!-- Muestra la fecha de nacimiento -->
                                <td><?= htmlspecialchars($beneficiario['direccion']); ?></td> <!-- Muestra la dirección -->
                                <td><?= htmlspecialchars($beneficiario['nivel_edu']); ?></td> <!-- Muestra el nivel educativo -->
                                <td><?= htmlspecialchars($beneficiario['situacion_eco']); ?></td> <!-- Muestra la situación económica -->
                                <td><?= htmlspecialchars($beneficiario['programa_asig']); ?></td> <!-- Muestra el programa asignado -->
                                <td><?= date('d/m/Y H:i', strtotime($beneficiario['fecha_de_ingr'])); ?></td> <!-- Muestra la fecha de ingreso -->
                                <td>
                                    <button class="edit-btn">Editar</button> <!-- Botón para editar -->
                                    <button class="delete-btn">Eliminar</button> <!-- Botón para eliminar -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No hay beneficiarios registrados.</td> <!-- Mensaje si no hay beneficiarios -->
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
