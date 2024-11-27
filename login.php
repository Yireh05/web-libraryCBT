<?php
session_start(); 

// Credenciales estáticas
$usuario_valido = "admin";
$contrasena_valida = "admin";

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar las credenciales
    if ($usuario == $usuario_valido && $contrasena == $contrasena_valida) {
        $_SESSION['usuario'] = $usuario;  // Guardar usuario en la sesión
        
        // Redirigir a la página de edición o agregar libro según la opción seleccionada
        if (isset($_POST['redirect_to'])) {
            if ($_POST['redirect_to'] == 'editar') {
                header("Location: editar.php");
            } elseif ($_POST['redirect_to'] == 'newBook') {
                header("Location: newBook.php");
            }
            exit();
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de sesión</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Contenedor del formulario */
        .login-container {
            background-color: #4CAF50;
            color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        input, select {
            width: 100%;
            padding: 0.8rem;
            margin: 0.8rem 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 1rem;
            background-color: #388E3C;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1rem;
        }

        button:hover {
            background-color: #2C6B32;
        }

        .error {
            color: red;
            font-size: 1rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        label {
            font-size: 1rem;
        }

    </style>
</head>
<body>

<!-- Contenedor principal del formulario de login -->
<div class="login-container">
    <h2>Iniciar sesión</h2>

    <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Formulario de inicio de sesión -->
    <form method="POST">
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required placeholder="Ingrese el usuario">
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required placeholder="Ingrese la contraseña">
        </div>

        <div class="form-group">
            <label for="redirect_to">¿Qué acción deseas realizar?</label>
            <select name="redirect_to">
                <option value="editar">Editar libro</option>
                <option value="newBook">Agregar nuevo libro</option>
            </select>
        </div>

        <button type="submit">Iniciar sesión</button>
        <button type="button" onclick="window.location.href='home.php'">Cancelar</button>
    </form>
</div>

</body>
</html>
