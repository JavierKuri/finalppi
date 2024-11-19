<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['modificar_precio'])) {
            if (empty($_POST['id_juego']) || empty($_POST['precio'])) {
                echo "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
            } else {
                $con=mysqli_connect("localhost", "root", "", "finalppi");
                if (mysqli_connect_errno()) {
                    echo "<div class='alert alert-danger'>Error de conexión con MySQL: $mysqli_connect_error().</div>";
                }
                $id_juego = mysqli_real_escape_string($con,$_POST['id_juego']);
                $precio = mysqli_real_escape_string($con,$_POST['precio']);
                $sql = "UPDATE juegos SET precio = $precio WHERE id_juego = $id_juego;";
                if (mysqli_query($con, $sql)) {
                    if (mysqli_affected_rows($con) > 0) {
                        echo "<div class='alert alert-success'>El precio se actualizó correctamente.</div>";
                    } else {
                        echo "<div class='alert alert-warning'>No se encontró ningún juego con ese ID o el precio ya es el mismo.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Error al actualizar el precio: " . mysqli_error($con) . "</div>";
                }
                mysqli_close($con);
            }
        } else if(isset($_POST['modificar_cantidad'])) {
            if (empty($_POST['id_juego']) || empty($_POST['cantidad'])) {
                echo "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
            } else {
                $con=mysqli_connect("localhost", "root", "", "finalppi");
                if (mysqli_connect_errno()) {
                    echo "<div class='alert alert-danger'>Error de conexión con MySQL: $mysqli_connect_error().</div>";
                }
                $id_juego = mysqli_real_escape_string($con,$_POST['id_juego']);
                $cantidad = mysqli_real_escape_string($con,$_POST['cantidad']);
                $sql = "UPDATE juegos SET c_almacen = $cantidad WHERE id_juego = $id_juego;";
                if (mysqli_query($con, $sql)) {
                    if (mysqli_affected_rows($con) > 0) {
                        echo "<div class='alert alert-success'>La cantidad se actualizó correctamente.</div>";
                    } else {
                        echo "<div class='alert alert-warning'>No se encontró ningún juego con ese ID o la cantidad ya es la misma.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Error al actualizar la cantidad: " . mysqli_error($con) . "</div>";
                }
                mysqli_close($con);
            }
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
    <title>Modificar producto</title>
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
                            <a class="nav-link active" href="modificar_producto.php">Modificar producto</a>
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
        <div class="container my-5">
            <h1 class="display-3">Ingrese ID del producto y precio nuevo.</h1>
            <form action="modificar_producto.php" method="post">
                <label for="id_juego" class="form-label">ID:</label>
                <input type="number" class="form-control" name="id_juego" id="id_juego" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" name="precio" id="precio" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <button type="submit" name="modificar_precio" class="btn btn-secondary my-5" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>Modificar producto</button>
            </form>
        </div>
        <div class="container my-5">
            <h1 class="display-3">Ingrese ID del producto y cantidad nueva.</h1>
            <form action="modificar_producto.php" method="post">
                <label for="id_juego" class="form-label">ID:</label>
                <input type="number" class="form-control" name="id_juego" id="id_juego" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
                <button type="submit" name="modificar_cantidad" class="btn btn-secondary my-5" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>Modificar producto</button>
            </form>
        </div>
    </div>
</body>
</html>