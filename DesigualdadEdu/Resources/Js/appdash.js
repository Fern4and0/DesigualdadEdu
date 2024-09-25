// Variable para almacenar el temporizador de inactividad
var inactivityTimeout; 

// Función para reiniciar el temporizador de inactividad
function resetInactivityTimeout() {
    clearTimeout(inactivityTimeout); // Limpiar el temporizador de inactividad existente
    inactivityTimeout = setTimeout(logout, 60000); // Establecer un nuevo temporizador de 6 segundos para cerrar sesión
}

// Función para cerrar la sesión y redirigir a la página de inicio de sesión
function logout() {
    // Redirigir al usuario a la página de cierre de sesión (ajustamos la ruta)
    window.location.href = "../../Resources/Views/login.html";
}

// Eventos para detectar la interacción del usuario y reiniciar el temporizador
document.addEventListener("mousemove", resetInactivityTimeout); // Detectar movimiento del ratón
document.addEventListener("keydown", resetInactivityTimeout);   // Detectar pulsación de tecla
document.addEventListener("scroll", resetInactivityTimeout);    // Detectar desplazamiento de la página

// Función para editar un usuario basado en el id proporcionado
function editarUsuario(id) {
    // Llamar al servidor para obtener los datos del usuario
    fetch(`ObtenerUsuario.php?id=${id}`)
        .then(response => response.json()) // Convertir la respuesta del servidor a JSON
        .then(data => {
            // Rellenar el formulario de edición con los datos del usuario obtenidos
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_nombre').value = data.nombre;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_rol').value = data.id_rol;

            // Mostrar el modal de edición de usuario
            document.getElementById('modalEditarUsuario').style.display = 'block';
        });
}

// Función para cerrar el modal de edición de usuario
function cerrarModal() {
    // Ocultar el modal de edición de usuario
    document.getElementById('modalEditarUsuario').style.display = 'none';
}

// Función para eliminar un usuario basado en el id proporcionado
function eliminarUsuario(id) {
    // Preguntar al usuario si está seguro de eliminar el registro
    if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
        // Redirigir a la página PHP que maneja la eliminación del usuario
        window.location.href = `EliminarUsuario.php?id=${id}`;
    }
}

// Función duplicada para editar usuario (opcionalmente se podría eliminar la anterior)
function editarUsuario(id) {
    // Encontrar la fila correspondiente al usuario en la tabla de usuarios
    const row = document.querySelector(`tr[data-id='${id}']`);
    
    // Extraer los datos de la fila seleccionada
    const nombre = row.querySelector('.nombre').textContent;
    const email = row.querySelector('.email').textContent;
    const rol = row.querySelector('.rol').textContent;

    // Rellenar el formulario de edición con los datos del usuario seleccionado
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_rol').value = rol;

    // Mostrar el modal de edición de usuario
    document.getElementById('modalEditarUsuario').style.display = 'block';
}

// Función duplicada para cerrar el modal de edición de usuario (se podría consolidar con la anterior)
function cerrarModal() {
    // Ocultar el modal de edición de usuario
    document.getElementById('modalEditarUsuario').style.display = 'none';
}

// Función para alternar la visibilidad de la barra lateral
function toggleSidebar() {
    // Obtener el elemento de la barra lateral
    const sidebar = document.getElementById('sidebar');
    
    // Alternar la clase 'collapsed' para mostrar u ocultar la barra lateral
    sidebar.classList.toggle('collapsed');
}
