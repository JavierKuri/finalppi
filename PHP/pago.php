<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['nombre']) || empty($_POST['fecha_nacimiento']) || empty($_POST['num_tarjeta'])) {
            echo "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
        } else {
            $con=mysqli_connect("localhost", "root", "", "finalppi");
            if (mysqli_connect_errno()) {
                echo "<div class='alert alert-danger'>Error de conexión con MySQL: $mysqli_connect_error().</div>";
            }
            $nombre = mysqli_real_escape_string($con,$_POST['nombre']);
            $fecha_nacimiento = mysqli_real_escape_string($con,$_POST['fecha_nacimiento']);
            $num_tarjeta = mysqli_real_escape_string($con, $_POST['num_tarjeta']);
            $sql = "SELECT * FROM usuarios WHERE nombre='${nombre}' AND fecha_nacimiento='${fecha_nacimiento}' AND num_tarjeta = '$num_tarjeta';";
            $result = mysqli_query($con, $sql);
            
            if($result->num_rows>0) {
                $result = $result-> fetch_assoc();
                $sql = "INSERT INTO compras (id_usuario, id_juego) SELECT id_usuario, id_juego FROM carrito WHERE id_usuario = " . $result['id_usuario'] . ";";
                if(mysqli_query($con, $sql)) {
                    $sql = "DELETE FROM carrito WHERE id_usuario = " . $result['id_usuario'] . ";";
                    if (mysqli_query($con, $sql)) {
                        echo "<div class='alert alert-success'>Pago realizado correctamente, regresando a catálogo.</div>";
                        echo "<meta http-equiv='refresh' content='5;url=catalogo.php'>";
                        header("Location: catalogo.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Error en inserción en tabla de compras." . mysqli_error($con) . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Error en eliminación en tabla de carrito." . mysqli_error($con) . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Datos incorrectos, volver a intentar.</div>";
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
    <title>Realizar pago</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark mb-5 sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.html">
                    <img src="../IMG/control.png" alt="LOGO" style="width:40px;" class="rounded-pill"> 
                </a>
                <div class="container-fluid">
                    <a class="navbar-text h1 text-decoration-none" href="../index.html">TIENDA DE JUEGOS</a>
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
                            <a class="nav-link" href="iniciar.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cerrar.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="table-responsive container">
            <h1 class="display-3 my-5">Ingresar dator para confirmar transacción.</h1>
            <form action="pago.php" method="post" enctype="multipart/form-data">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" <?php echo isset($_SESSION['id_usuario']) ? '' : 'disabled'; ?>>
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" <?php echo isset($_SESSION['id_usuario']) ? '' : 'disabled'; ?>>
                <label for="num_tarjeta" class="form-label">Numero de Tarjeta:</label>
                <input type="number" class="form-control" name="num_tarjeta" id="num_tarjeta" <?php echo isset($_SESSION['id_usuario']) ? '' : 'disabled'; ?>>
                <button type="submit" class="btn btn-primary my-5" <?php echo isset($_SESSION['id_usuario']) ? '' : 'disabled'; ?>>Realizar pago</button>
            </form>
        </div>
    </div>
</body>
</html>