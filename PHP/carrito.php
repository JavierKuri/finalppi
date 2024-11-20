<?php
    session_start();
    if(isset($_SESSION['id_usuario'])) {
        $con=mysqli_connect("localhost", "root", "", "finalppi");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $id_usuario = mysqli_real_escape_string($con,$_SESSION['id_usuario']);
        $sql = "SELECT * FROM carrito, juegos, usuarios WHERE carrito.id_usuario = usuarios.id_usuario 
                                                        AND carrito.id_juego = juegos.id_juego
                                                        AND usuarios.id_usuario = $id_usuario
                                                        ORDER BY id_carrito DESC;";
        $result = mysqli_query($con, $sql);
        mysqli_close($con); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras</title>
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
                            <a class="nav-link active" href="carrito.php">Carrito</a>
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
            <h1 class="display-3 my-5">Carrito de compras</h1>
            <table class="table table-primary table-striped">
                <thead>
                    <tr>
                        <td>ID de carrito</td>
                        <td>Titulo</td>
                        <td>Precio</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($result)) {
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr><td class='table-secondary'>" . $row['id_carrito'] . "</td><td>" . $row['titulo'] . "</td><td>" . $row['precio'] . "</td></tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
            <button class ="btn btn-primary my-5" onclick="window.location.href='pago.php'" <?php echo (isset($_SESSION['id_usuario']) && $result->num_rows > 0) ? '' : 'disabled'; ?>>Proceder al pago</a>
        </div>
    </div>
</body>
</html>