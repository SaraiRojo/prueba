<?php
// registro.php

// Inicializar el mensaje como vacío
$mensajeRegistro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Realizar validación y verificación de seguridad

    // Conectar a la base de datos 
    $host = "localhost";
    $db_user = "root";
    $db_password = "itsh2023";
    $db_name = "prueba";

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno != 0) {
        echo "Error de conexión a la base de datos: " . $connection->connect_error;
        exit();
    }

    // Insertar el nuevo usuario en la base de datos SIN hash de contraseña
    $sql = "INSERT INTO users (login, password) VALUES ('$username', '$password')";
    $result = $connection->query($sql);

    if ($result) {
        // Configurar el mensaje de registro exitoso
        $mensajeRegistro = "Registro exitoso. Ahora puedes iniciar sesión con tu nuevo usuario.";
    } else {
        echo "Error al registrar el usuario: " . $connection->error;
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agrega cualquier estilo adicional que desees -->
    <style>
        body {
            background-color: black;
            color: white;
            text-align: center;
            padding: 50px;
        }

        #mensajeRegistro {
            color: green; /* Puedes personalizar el color del mensaje de éxito */
            display: none; /* Inicialmente oculto */
        }
    </style>
</head>
<body>

    <h1>Cuenta Creada</h1>

    <!-- Muestra el mensaje de registro -->
    <div id="mensajeRegistro">
        <?php echo $mensajeRegistro; ?>
    </div>
    <!-- Botón para regresar al inicio de sesión -->
    <a href="login.php" id="regresarInicioSesion">Regresar al inicio de sesión</a>
    


    <!-- Aquí va el formulario -->

    <script>
        // Muestra el mensaje de registro después de un breve retraso
        setTimeout(function() {
            document.getElementById('mensajeRegistro').style.display = 'block';
        }, 100);
    </script>

</body>
</html>
