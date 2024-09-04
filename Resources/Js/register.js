document.getElementById('registerForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden.');
        event.preventDefault(); // Evita el envío del formulario
    }
});
