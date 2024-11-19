<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id_admin'])) {
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
    <title>Cerrar sesión (admin)</title>
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
                            <a class="nav-link active" href="cerrar_admin.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1 class="display-3 my-5">¿Estas seguro que quieres cerrar sesión de administrador?</h1>
            <form action="cerrar_admin.php" method="post">
                <button type="submit" class="btn btn-secondary">Cerrar sesión</button>
            </form>
        </div>
    </div>
</body>
</html>