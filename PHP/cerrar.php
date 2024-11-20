<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id_usuario'])) {
        session_unset();
        session_destroy();
        echo "<div class='alert alert-success'>Sesión cerrada correctamente.</div>";
    } else {
        echo "<div class='alert alert-warning'>No hay sesión activa.</div>";
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
    <title>Cerrar sesión</title>
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
                            <a class="nav-link" href="iniciar.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cerrar.php">Cerrar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isset($_SESSION['id_usuario']) ? '' : 'disabled'; ?>" href="informacion.php">Información de usuario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1 class="display-3 my-5">¿Estas seguro que quieres cerrar sesión?</h1>
            <form action="cerrar.php" method="post">
                <button type="submit" class="btn btn-primary">Cerrar sesión</button>
            </form>
        </div>
    </div>
</body>
</html>