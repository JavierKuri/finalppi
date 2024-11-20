<?php
    session_start();
    if(isset($_SESSION['id_usuario'])) {
        $con=mysqli_connect("localhost", "root", "", "finalppi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $id_usuario = mysqli_real_escape_string($con,$_SESSION['id_usuario']);
        $sql = "SELECT * FROM usuarios WHERE usuarios.id_usuario = $id_usuario;";
        $result = mysqli_query($con, $sql);
        $result = mysqli_fetch_assoc($result);
        mysqli_close($con); 
    } else {
        header("Location: iniciar.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de usuario</title>
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
                        <li class="nav-item">
                            <a class="nav-link active" href="informacion.php">Información de usuario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container my-5">
            <div class="row my-3">
                <div class="col">
                    <strong>Nombre:</strong>
                </div>
                <div class="col">
                    <?php echo $result['nombre']; ?>
                </div>
            </div>

            <div class="row my-3">
                <div class="col">
                    <strong>Correo:</strong>
                </div>
                <div class="col">
                    <?php echo $result['correo']; ?>
                </div>
            </div>

            <div class="row my-3">
                <div class="col">
                    <strong>Fecha de Nacimiento:</strong>
                </div>
                <div class="col">
                    <?php echo $result['fecha_nacimiento']; ?>
                </div>
            </div>

            <div class="row my-3">
                <div class="col">
                    <strong>Dirección:</strong>
                </div>
                <div class="col">
                    <?php echo $result['direccion']; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
