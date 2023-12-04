<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        label {
            font-size: 1.2em;
        }

        input {
            padding: 5px;
            font-size: 1em;
        }

        button {
            padding: 10px;
            font-size: 1em;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Crear Cuenta</h1>
    <form action="registro.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Registrar</button>
    </form>
    <a href="login.php">Volver al Inicio de Sesión</a>
</body>
</html>
