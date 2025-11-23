<?php
// views/formulario_registro.php
// Esta vista recibe $message del controlador (si existe).
?>
<div class="form-container">
    <h2>Crear Cuenta</h2>
    
    <?php if (isset($message)): ?>
        <div class="message <?php echo $message['type']; ?>">
            <?php echo htmlspecialchars($message['text']); ?>
        </div>
        <style>
            .message { padding: 10px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
            .message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
            .message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        </style>
    <?php endif; ?>

    <!-- La acción apunta al router con accio=registro, el controlador se auto-gestiona -->
    <form action="index.php?accio=registro" method="POST">
        <!-- Campo: Nombre (Obligatorio, solo caracteres y espacios) -->
        <div class="form-group">
            <label for="reg_nombre">Nombre *</label>
            <input type="text" id="reg_nombre" name="nombre" required
                   pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo caracteres y espacios.">
        </div>

        <!-- Campo: Email (Obligatorio, email válido) -->
        <div class="form-group">
            <label for="reg_email">Correo Electrónico *</label>
            <input type="email" id="reg_email" name="email" required>
        </div>

        <!-- Campo: Contraseña (Alfanumérico, guardado hasheado) -->
        <div class="form-group">
            <label for="reg_password">Contraseña *</label>
            <input type="password" id="reg_password" name="password" required minlength="6" maxlength="30"
                   pattern="[A-Za-z0-9\s]+" title="Alfanumérico (máx. 30 caracteres y espacios).">
        </div>

        <!-- Campos opcionales (Dirección, Población, CP) -->
        <div class="form-group">
            <label for="reg_direccion">Dirección</label>
            <input type="text" id="reg_direccion" name="direccion" maxlength="30" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s]*">
        </div>
        <div class="form-group">
            <label for="reg_poblacion">Población</label>
            <input type="text" id="reg_poblacion" name="poblacion" maxlength="30" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*">
        </div>
        <div class="form-group">
            <label for="reg_cp">Código Postal</label>
            <input type="text" id="reg_cp" name="cp" pattern="\d{5}" title="Debe contener exactamente 5 dígitos.">
        </div>

        <button type="submit" class="btn-primary">Registrarse</button>
    </form>
</div>