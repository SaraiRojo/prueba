<?php
session_start();
if (!(isset($_SESSION['logged-in']))) {
    header('Location: login.php');
    exit();
}

require_once "connect.php";

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno != 0) {
    echo "Error: " . $connection->connect_errno . "<br>";
    echo "Description: " . $connection->connect_error;
    exit();
}

// Obtener los datos del usuario para prellenar el formulario
$username = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE login = '$username'";
$userData = $connection->query($sql)->fetch_assoc();
?>

<?php include 'header.php'; ?>

<div class="container profileContainer">
    <h1>Perfil</h1>

    <div class="profileForm">
        <form action="actualizar_perfil.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $userData['login']; ?>" required>
            </div>
            <h3></h3>

            <div class="form-group">
                <label for="nueva_contrasena">Nueva Contraseña:</label>
                <input type="password" id="nueva_contrasena" name="nueva_contrasena">
            </div>
            <h3></h3>

            <div class="form-group">
                <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena">
            </div>
            <h1></h1>

            <div class="form-group">
                <button type="submit" class="btn">Actualizar Perfil</button>
            </div>
        </form>

        <?php
        if (isset($_SESSION['updateProfileSuccess'])) {
            echo $_SESSION['updateProfileSuccess'];
            unset($_SESSION['updateProfileSuccess']);
        }
        ?>
    </div>
</div>

<?php $connection->close(); ?>
<?php include 'footer.php'; ?>
