<?php
// Controllers/Registro.php

include '../DB/DB.php'; // Incluimos la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hasheamos la contraseña

    // Asignar id_rol por defecto
    $id_rol = 2; // Por ejemplo, rol de usuario común

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO users (nombre, email, password, id_rol) VALUES ('$nombre', '$email', '$password', '$id_rol')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso!";
        // Redirigir a otra página si es necesario
        // header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
