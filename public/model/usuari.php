<?php
// model/userModel.php
// Funciones para interactuar con la tabla 'user'.
require_once __DIR__ . '/connectaBD.php';

// Sección 4.3: Función para registrar un nuevo usuario con seguridad.
function registerUser(array $userData): bool
{
    // 1. Cifrado de Contraseña (password_hash)
    // El campo 'password' debe ser alfanumérico (VARCHAR(255) recomendado).
    $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
    if ($hashedPassword === false) {
        error_log("Fallo al hashear la contraseña.");
        return false;
    }

    $conn = connectaBD();
    
    // 2. Consulta de Inserción Parametrizada
    $sql = 'INSERT INTO "user" (name, email, password, address, city, zip_code) 
            VALUES ($1, $2, $3, $4, $5, $6)';
            
    // Array de parámetros (Consulta Parametrizada, Sección 4.3 y A.1)
    // Usamos el password hasheado
    $params = [
        $userData['name'],
        $userData['email'],
        $hashedPassword,
        $userData['address'] ?? null, // Usamos null si no se proporciona
        $userData['city'] ?? null,
        $userData['zip_code'] ?? null
    ];
    
    $result = pg_query_params($conn, $sql, $params);

    if (!$result) {
        // Error común: email ya existe (violación de la restricción UNIQUE)
        $error = pg_last_error($conn);
        error_log("Error al registrar usuario: " . $error);
        pg_close($conn);
        return false;
    }
    
    pg_close($conn);
    return true; // Registro exitoso
}
?>