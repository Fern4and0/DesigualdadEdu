<?php
// Controllers/dashboard.php

include '../DB/db.php'; // Incluimos la conexión a la base de datos

// Obtener lista de usuarios
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $users = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Resources/Css/Style.css">
    <script src="../Resources/JS/script.js" defer></script>
    <title>Dashboard - Usuarios</title>
</head>
<body>
    <div class="container">
        <h2>Dashboard - Lista de Usuarios</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['nombre'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['id_rol'] ?></td>
                        <td>
                            <button onclick="editarUsuario(<?= $user['id'] ?>)">Editar</button>
                            <button onclick="eliminarUsuario(<?= $user['id'] ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para editar usuario -->
    <div id="modalEditarUsuario" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Editar Usuario</h2>
            <form action="EditarUsuario.php" method="POST">
                <input type="hidden" id="edit_id" name="id">
                <label for="nombre">Nombre:</label>
                <input type="text" id="edit_nombre" name="nombre" required>
                <label for="email">Email:</label>
                <input type="email" id="edit_email" name="email" required>
                <label for="rol">Rol:</label>
                <input type="number" id="edit_rol" name="id_rol" required>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        function editarUsuario(id) {
            // Llamar al archivo PHP para obtener los datos del usuario
            fetch(`ObtenerUsuario.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nombre').value = data.nombre;
                    document.getElementById('edit_email').value = data.email;
                    document.getElementById('edit_rol').value = data.id_rol;

                    document.getElementById('modalEditarUsuario').style.display = 'block';
                });
        }

        function cerrarModal() {
            document.getElementById('modalEditarUsuario').style.display = 'none';
        }

        function eliminarUsuario(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
                window.location.href = `EliminarUsuario.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
