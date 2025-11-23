<?php
// controller/registro.php
// Controlador que maneja la lógica de registro de usuario.
require_once __DIR__ . '/../model/usuari.php';

$message = null; // Mensaje de éxito o error

// Si la petición es POST, procesamos el formulario (Sección 4.3)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recoger y Sanear datos (omisión de filtrado por ahora, según la práctica)
    $userData = [
        'name' => $_POST['nombre'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'address' => $_POST['direccion'] ?? '',
        'city' => $_POST['poblacion'] ?? '',
        'zip_code' => $_POST['cp'] ?? ''
    ];

    // 2. Validación básica de campos obligatorios
    if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
        $message = ['type' => 'error', 'text' => 'Error: Faltan campos obligatorios.'];
    } else {
        // 3. Llamar al Modelo para registrar con cifrado y parametrización
        if (registerUser($userData)) {
            $message = ['type' => 'success', 'text' => 'Registro completado con éxito. Ya puedes iniciar sesión.'];
        } else {
            // El error más común es por email duplicado.
            $message = ['type' => 'error', 'text' => 'Error al registrar el usuario. El email podría ya estar en uso.'];
        }
    }
}

// 4. Cargar la vista del formulario de registro
require_once __DIR__ . '/../views/formulari_registre.php';
?>