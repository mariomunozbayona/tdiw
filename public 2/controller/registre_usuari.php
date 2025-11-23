<?php
// controller que maneja la lógica de registro de usuario
require_once __DIR__ . '/../model/usuari.php';

$message = null; // mensaje de exito/error

// si la petición es POST, procesamos el formulario 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userData = [
        'name' => $_POST['nombre'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'address' => $_POST['direccion'] ?? '',
        'city' => $_POST['poblacion'] ?? '',
        'zip_code' => $_POST['cp'] ?? ''
    ];

    // validación de los campos obligatorios
    if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
        $message = ['type' => 'error', 'text' => 'Error: Faltan campos obligatorios.'];
    } else {
        // llamar a model para registrar con cifrado y por parametros
        if (registerUser($userData)) {
            $message = ['type' => 'success', 'text' => 'Registro completado con éxito. Ya puedes iniciar sesión.'];
        } else {
            // Error email ya en uso
            $message = ['type' => 'error', 'text' => 'Error al registrar el usuario. El email podría ya estar en uso.'];
        }
    }
}

// cargar la vista del formulario de registro
require_once __DIR__ . '/../views/formulari_registre.php';
?>