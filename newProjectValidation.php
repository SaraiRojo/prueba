<?php
session_start();
require_once "connect.php";

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno != 0) {
    echo "Error: " . $connection->connect_errno . "<br>";
    echo "Description: " . $connection->connect_error;
} else {
    $fullName = $_POST['full'];
    $shortName = $_POST['short'];

    // Verificar si el nombre corto ya existe
    $checkIfExistsSQL = "SELECT * FROM projects WHERE short_name = '$shortName'";
    $checkResult = $connection->query($checkIfExistsSQL);

    if ($checkResult->num_rows > 0) {
        // El nombre corto ya existe, manejar el error o redirigir
        echo '<span class="error-msg">El nombre corto ya existe. Por favor, elige otro.</span>';
    } else {
        // El nombre corto no existe, proceder con la inserción
        $insertSQL = "INSERT INTO projects (full_name, short_name) VALUES ('$fullName', '$shortName')";

        if ($connection->query($insertSQL)) {
            $_SESSION['newProjectSuccess'] = '<span class="success-msg">Proyecto agregado correctamente.</span>';
            unset($_SESSION['addProjectError']);
            header('Location: index.php');
        } else {
            $_SESSION['addProjectError'] = '<span class="error-msg">Disculpa! El proyecto no pudo ser agregado.</span>';
            // Manejar el error según sea necesario
        }
    }

    $connection->close();
}
?>
