<?php
// funciones para interactuar con la tabla 'user'
require_once __DIR__ . '/connectaBD.php';

// función para registrar un nuevo usuario con seguridad
function registerUser(array $userData): bool
{
    // cifrado de la contraseña (password_hash)
    $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
    if ($hashedPassword === false) {
        error_log("Error al hashear la contraseña.");
        return false;
    }

    $conn = connectaBD();
    
    // consulta de la inserción por parametros
    $sql = 'INSERT INTO "user" (name, email, password, address, city, zip_code) 
            VALUES ($1, $2, $3, $4, $5, $6)';
            
    // array de parámetros (consulta por parametros)
    // utilizamos el password hasheado
    $params = [
        $userData['name'],
        $userData['email'],
        $hashedPassword,
        $userData['address'] ?? null, // null si en las opcionales no se da nada
        $userData['city'] ?? null,
        $userData['zip_code'] ?? null
    ];
    
    $result = pg_query_params($conn, $sql, $params);

    if (!$result) {
        // error email ya existe
        $error = pg_last_error($conn);
        error_log("Error al registrar usuario: " . $error);
        pg_close($conn);
        return false;
    }
    
    pg_close($conn);
    return true; // registro con exito
}
?>