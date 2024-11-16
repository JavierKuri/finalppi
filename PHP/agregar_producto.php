<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['titulo']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['c_almacen']) || empty($_POST['desarrollador']) || empty($_POST['ESRB'])) {
            echo "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
        } else {
            $con=mysqli_connect("localhost", "root", "", "finalppi");
            if (mysqli_connect_errno()) {
                echo "<div class='alert alert-danger'>Error de conexión con MySQL: $mysqli_connect_error().</div>";
            }
            $titulo = mysqli_real_escape_string($con,$_POST['titulo']);
            $descripcion = mysqli_real_escape_string($con,$_POST['descripcion']);
            $portada = file_get_contents($_FILES['portada']['tmp_name']);
            $precio = mysqli_real_escape_string($con,$_POST['precio']);
            $c_almacen = mysqli_real_escape_string($con,$_POST['c_almacen']);
            $desarrollador = mysqli_real_escape_string($con,$_POST['desarrollador']);
            $ESRB = mysqli_real_escape_string($con,$_POST['ESRB']);
            $sql = "INSERT INTO juegos (titulo, descripcion, portada, precio, c_almacen, desarrollador, ESRB) VALUES ('$titulo', '$descripcion', ?, '$precio', '$c_almacen', '$desarrollador', '$ESRB')";
            if ($stmt = mysqli_prepare($con, $sql)) {
                mysqli_stmt_bind_param($stmt, 's', $portada);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<div class='alert alert-success'>Producto agregado correctamente</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error al realizar la inserción: " . mysqli_error($con) . "</div>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<div class='alert alert-danger'>Error en la preparación de la consulta: " . mysqli_error($con) . "</div>";
            }
            mysqli_close($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar producto</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-5 sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio_admin.php">
                    <img src="../IMG/control.png" alt="LOGO" style="width:40px;" class="rounded-pill"> 
                </a>
                <div class="container-fluid">
                    <a class="navbar-text h1 text-decoration-none active" href="inicio_admin.php">Página de administrador</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="agregar_producto.php">Agregar producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="modificar_producto.php">Modificar producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="mostrar_historial.php">Mostrar historial de usuario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inicio_admin.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cerrar_admin.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1 class="display-3">Ingrese información del producto por agregar</h1>
            <form action="agregar_producto.php" method="post" enctype="multipart/form-data">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="portada" class="form-label">Portada:</label>
                <input type="file" class="form-control" name="portada" id="portada" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" name="precio" id="precio" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="c_almacen" class="form-label">Cantidad en almacen:</label>
                <input type="number" class="form-control" name="c_almacen" id="c_almacen" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="desarrollador" class="form-label">Desarrollador:</label>
                <input type="text" class="form-control" name="desarrollador" id="desarrollador" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="ESRB" class="form-label">ESRB:</label>
                <input type="text" class="form-control" name="ESRB" id="ESRB" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <button type="submit" class="btn btn-secondary my-5" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>Agregar producto</button>
            </form>
        </div>
    </div>
</body>
</html>