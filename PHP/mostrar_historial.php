<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['id_usuario'])) {
            echo "<div class='alert alert-danger'>Por favor ingresar id por buscar.</div>";
        } else {
            $con=mysqli_connect("localhost", "root", "", "finalppi");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $id_usuario = mysqli_real_escape_string($con,$_POST['id_usuario']);
            $sql = "SELECT * FROM compras, juegos, usuarios WHERE compras.id_usuario = usuarios.id_usuario 
                                                            AND compras.id_juego = juegos.id_juego
                                                            AND usuarios.id_usuario = $id_usuario
                                                            ORDER BY id_compra DESC;";
            $result = mysqli_query($con, $sql);
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
    <title>Mostrar historial</title>
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
                            <a class="nav-link active" href="mostrar_historial.php">Mostrar historial de usuario</a>
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
    </div>
    <div class="container">
        <h1 class="display-3">Ingresar el id del usuario</h1>
        <form action="mostrar_historial.php" method="post">
            <label for="id_usuario" class="form-label">ID del usuario:</label>
            <input type="number" class="form-control" name="id_usuario" id="id_usuario" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>
            <button type="submit" class="btn btn-secondary my-5" <?php echo isset($_SESSION['id_admin']) ? '' : 'disabled'; ?>>Buscar historial de compras</button>
        </form>
    </div>
    <div class="table-responsive container">
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <td>ID de compra</td>
                    <td>Titulo</td>
                    <td>Precio</td>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($result)) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr><td class='table-secondary'>" . $row['id_compra'] . "</td><td>" . $row['titulo'] . "</td><td>" . $row['precio'] . "</td></tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>