<?php
    $con=mysqli_connect("localhost", "root", "", "finalppi");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "SELECT * FROM juegos order by titulo;";
    $result = mysqli_query($con, $sql);
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
        <nav class="navbar navbar-expand-sm bg-primary navbar-light mb-5 sticky-top">
            <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">
                <img src="../IMG/control.png" alt="LOGO" style="width:40px;" class="rounded-pill"> 
            </a>
            <div class="container-fluid">
                <a class="navbar-text h1 text-decoration-none" href="../index.html">TIENDA DE JUEGOS</a>
            </div>
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
        </nav>
        <div class="container">
            <div class="table-responsive"> 
                <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <td>Titulo</td>
                            <td>Descripción</td>
                            <td></td>
                            <td>Precio</td>
                            <td>Desarrollador</td>
                            <td>ESRB</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $imageData = base64_encode($row['portada']);
                                echo "<tr>
                                        <td class='table-secondary h5'>" . $row['titulo'] . "</td>
                                        <td>" . $row['descripcion'] . "</td>
                                        <td><img class='rounded' src='data:image/jpeg;base64,{$imageData}' alt='Portada' style='width:200px;height:auto;'/></td>
                                        <td>$" . $row['precio'] . "</td>
                                        <td>" . $row['desarrollador'] . "</td>
                                        <td>" . $row['ESRB'] . "</td>
                                        <td>
                                            <form action='' method='post'>
                                                <input type='hidden' name='id_juego'/>
                                                <button type='submit' class='btn btn-primary'>Agregar al carrito</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>