<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['correo']) || empty($_POST['contra'])) {
            echo "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
        } else {
            $con=mysqli_connect("localhost", "root", "", "finalppi");
            if (mysqli_connect_errno()) {
                echo "<div class='alert alert-danger'>Error de conexión con MySQL: $mysqli_connect_error().</div>";
            }
            $correo = mysqli_real_escape_string($con,$_POST['correo']);
            $contra = mysqli_real_escape_string($con,$_POST['contra']);
            $sql = "SELECT * FROM usuarios WHERE correo='${correo}' AND contrasena='${contra}';";
            $result = mysqli_query($con, $sql);
            mysqli_close($con); 
            if($result->num_rows>0) {
                $result = $result-> fetch_assoc();
                if($result['id_usuario']==99) {
                    $_SESSION['id_admin']=$result['id_usuario'];
                    echo "<div class='alert alert-success'>Inicio de sesión realizado correctamente.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Correo o contraseña incorrectos, volver a intentar.</div>";
                } 
            } else {
                echo "<div class='alert alert-danger'>Correo o contraseña incorrectos, volver a intentar.</div>";
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
    <title>Iniciar sesión (admin)</title>
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
            <h1 class="display-3">Ingrese correo y contraseña de administrador</h1>
            <form action="inicio_admin.php" method="post">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" id="correo" <?php echo isset($_SESSION['id_admin']) ? 'disabled' : ''; ?>>
                <label for="contra" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="contra" id="contra" <?php echo isset($_SESSION['id_admin']) ? 'disabled' : ''; ?>>
                <button type="submit" class="btn btn-secondary my-5" <?php echo isset($_SESSION['id_admin']) ? 'disabled' : ''; ?>>Iniciar sesión como administrador</button>
            </form>
            <a href="../index.html" class="btn btn-primary">Regresar a tienda</a>
        </div>
    </div>
</body>
</html>