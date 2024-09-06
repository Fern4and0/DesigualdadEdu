<?php
include '../DB/db.php'; // Conexión a la base de datos

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: dashboard.php');
} else {
    echo "Error eliminando usuario: " . $conn->error;
}

$conn->close();
?>
