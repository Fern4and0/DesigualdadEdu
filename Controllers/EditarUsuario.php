<?php
include '../DB/db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $id_rol = $_POST['id_rol'];

    $sql = "UPDATE users SET nombre='$nombre', email='$email', id_rol='$id_rol' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error actualizando usuario: " . $conn->error;
    }

    $conn->close();
}
?>
