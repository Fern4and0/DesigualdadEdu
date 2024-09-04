<?php
// Controllers/register.php
include '../configuracion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Las contraseñas no coinciden.");
    }

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nombre, email, password, id_rol) VALUES (?, ?, ?, 2)"; // Asignar id_rol por defecto

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $full_name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes <a href='../resources/views/login.html'>iniciar sesión</a>.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
