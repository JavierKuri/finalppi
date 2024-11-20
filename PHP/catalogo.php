<?php
    session_start();
    $con=mysqli_connect("localhost", "root", "", "finalppi");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "SELECT * FROM juegos order by titulo;";
    $result = mysqli_query($con, $sql);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = mysqli_real_escape_string($con, $_SESSION['id_usuario']);
            $id_juego = mysqli_real_escape_string($con, $_POST['id_juego']);
            $sql = "INSERT INTO carrito (id_usuario, id_juego) VALUES ('$id_usuario', '$id_juego')";
            if (mysqli_query($con, $sql)) {
                echo "<div class='alert alert-success'>Juego agregado al carrito.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al agregar el juego al carrito.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Debes iniciar sesión para agregar juegos al carrito.</div>";
        }
    }
    mysqli_close($con);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de juegos</title>
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
                            <a class="nav-link active" href="catalogo.php">Catalogo de productos</a>
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
        <div class="container my-5">
            <div class="row justify-content-center">
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $imageData = base64_encode($row['portada']);
                        echo "
                        <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-4'>
                            <div class='card h-100'>
                                <img class='card-img-top' src='data:image/jpeg;base64,{$imageData}' alt='Portada'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row['titulo'] . "</h5>
                                    <p class='card-text'>" . $row['descripcion'] . "</p>
                                    <p class='card-text'><strong>Precio: </strong>$" . $row['precio'] . "</p>
                                    <p class='card-text'><strong>Desarrollador: </strong>" . $row['desarrollador'] . "</p>
                                    <p class='card-text'><strong>ESRB: </strong>" . $row['ESRB'] . "</p>
                                    <form action='catalogo.php' method='post'>
                                        <input type='hidden' name='id_juego' value='" . $row['id_juego'] . "''/>
                                        <button type='submit' class='btn btn-primary my-5'>Agregar al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>