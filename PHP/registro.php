<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contra'] || empty($_POST['fecha_nacimiento']) || empty($_POST['tarjeta']) || empty($_POST['direccion']))) {
            echo "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
        } else {
            $con=mysqli_connect("localhost", "root", "", "finalppi");
            if (mysqli_connect_errno()) {
                echo "<div class='alert alert-danger'>Error de conexión con MySQL: $mysqli_connect_error().</div>";
            }
            $nombre = mysqli_real_escape_string($con,$_POST['nombre']);
            $correo = mysqli_real_escape_string($con,$_POST['correo']);
            $contra = mysqli_real_escape_string($con,$_POST['contra']);
            $fecha_nacimiento = mysqli_real_escape_string($con,$_POST['fecha_nacimiento']);
            $tarjeta = mysqli_real_escape_string($con,$_POST['tarjeta']);
            $direccion = mysqli_real_escape_string($con,$_POST['direccion']);
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, fecha_nacimiento, num_tarjeta, direccion) VALUES ('$nombre', '$correo', '$contra', '$fecha_nacimiento', '$tarjeta', '$direccion');";

            if (mysqli_query($con, $sql)) {
                $_SESSION['id_usuario'] = mysqli_insert_id($con);
                echo "<div class='alert alert-success'>Registro realizado correctamente</div>"; 
            } else {
                echo "<div class='alert alert-danger'>Error al realizar la inserción: " . mysqli_error($con) . "</div>";
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
    <title>Registro de usuario</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark mb-5 sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.html">
                    <img src="../IMG/control.png" alt="LOGO" style="width:40px;" class="rounded-pill"> 
                </a>
                <div class="container-fluid">
                    <a class="navbar-text h1 text-decoration-none " href="../index.html">TIENDA DE JUEGOS</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="catalogo.php">Catalogo de productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="historial.php">Historial de compras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="carrito.php">Carrito</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="iniciar.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cerrar.php">Cerrar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isset($_SESSION['id_usuario']) ? '' : 'disabled'; ?>" href="informacion.php">Información de usuario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1 class="display-3">Ingrese datos para crear su cuenta</h1>
            <form action="registro.php" method="post">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" id="correo" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>
                <label for="contra" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="contra" id="contra" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>
                <label for="tarjeta" class="form-label">Tarjeta:</label>
                <input type="varchar" class="form-control" name="tarjeta" id="tarjeta" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>
                <label for="correo" class="form-label">Dirección:</label>
                <input type="varchar" class="form-control" name="direccion" id="direccion" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>
                <button type="submit" class="btn btn-primary my-5" <?php echo isset($_SESSION['id_usuario']) ? 'disabled' : ''; ?>>Registrar usuario</button>
            </form>
        </div>

    </div>
</body>
</html>