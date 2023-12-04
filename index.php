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
?>

<?php include 'header.php'; ?>

<div class="container projectListContainer">
    <h1>Proyectos</h1>
    <div class="lg-6 whoami">
        <?php echo 'Hola <strong>' . $_SESSION['user'] . '</strong> <a href="perfil.php">Perfil</a> | <a href="logout.php">[Cerrar Sesión]</a>'; ?>
    </div>
    <?php if ($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'configuroweb') : ?>
        <div class="lg-6 createBoard">
            <a href="newProject.php" class="btn">Crear Proyecto</a>
        </div>
    <?php endif; ?>

    <div class="lg-12">
        <table class="project-list">
            <thead>
                <tr>
                    <th>Nombre Completo Proyecto</th>
                    <th>Nombre Corto</th>
                    <th>Tareas Pendientes</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM projects";

                if ($result = $connection->query($sql)) {
                    $projectsCount = $result->num_rows;
                    if ($projectsCount > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $shortName = $row['short_name'];  // Cambiado de 'Short name' a 'short_name'
                            $sumSQL = "SELECT count(*) as tasksLeft FROM tasks WHERE project_short_name = '$shortName' AND state != 4";
                            $sumResult = $connection->query($sumSQL);
                            $row2 = $sumResult->fetch_assoc();
                            echo "
                            <tr>
                                <td>" . (isset($row['full_name']) ? $row['full_name'] : '') . "</td>
                                <td>" . (isset($row['short_name']) ? $row['short_name'] : '') . "</td>
                                <td>" . (isset($row2['tasksLeft']) ? $row2['tasksLeft'] : '') . "</td>
                                <td><a href='" . (isset($row['short_name']) ? "board.php?sn=" . $row['short_name'] : "#") . "' class='btn'>Tablero</a></td>
                            </tr>";
                        }
                        $result->free_result();
                    } else {
                        echo "Sin Proyectos Ingresados";
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_SESSION['newProjectSuccess'])) {
            echo $_SESSION['newProjectSuccess'];
            unset($_SESSION['newProjectSuccess']);
        }
        ?>
    </div>
</div>

<?php $connection->close(); ?>
<?php include 'footer.php'; ?>
