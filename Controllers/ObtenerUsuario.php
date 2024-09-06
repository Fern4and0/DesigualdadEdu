<?php
include '../DB/db.php'; // Conexión a la base de datos

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user); // Convertimos los datos en JSON
} else {
    echo json_encode(["error" => "Usuario no encontrado"]);
}

$conn->close();
?>
