<?php
include("../server/getProductsCarrito.php");
include("../server/checkProduct.php");

function checkProductosInactivos()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $product) {
            if (!checkStatus($product['product_id'])) {
                unset($_SESSION['cart'][$key]);
                calculateTotal();
            }
        }
    }
}

checkProductosInactivos();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css" />

</head>

<body>
    <main>
        <nav>
            <ul class="nav">
                <li><a id="inicio" href="../index.php"><img src="../assets/images/logo3.png" alt="logo"></a></li>
                <li id="barra-buscar">
                    <form method="get" action="../index.php" class="buscar-container">
                        <input type="search" value="<?= isset($_GET['searchBar']) ? $_GET['searchBar'] : '' ?>" class="buscar" name="searchBar" placeholder="Buscar por autor, título..." />
                        <button type="submit" name="buscarbutton" class="buscarbutton"><img src="../assets/images/buttonbuscar.png" alt="lupa"></button>
                    </form>
                </li>
                <li style="display:flex; gap:10px">
                    <a id="navButton" href="registro.php"><img src="../assets/images/user.png" alt="Perfil" height="35px"></a>
                    <a id="navButton" href="carrito.php"><img src="../assets/images/carro.png" alt="Cesta" height="35px"></a>
                </li>
            </ul>
            <div id="barra-buscar-hide">
                <form method="get" action="../index.php" class="buscar-container">
                    <input type="search" value="<?= isset($_GET['searchBar']) ? $_GET['searchBar'] : '' ?>" class="buscar" name="searchBar" placeholder="Buscar por autor, título..." />
                    <button type="submit" name="buscarbutton" class="buscarbutton"><img src="../assets/images/buttonbuscar.png" alt="lupa"></button>
                </form>
            </div>
        </nav>

        <div class="carritocontainer">
            <div id="articuloscarrito">
                <?php if (!isset($_SESSION['cart'])) {
                    echo "<div style=\"text-align:center; margin:10%\"><h1 style=\"color:white; font-size:30px\">Tu cesta está vacía</h1><p style=\"color:white\">Explora multitud de libros a buen precio desde nuestra página principal</p></div>";
                } else if (count($_SESSION['cart']) == 0) {
                    echo "<div style=\"text-align:center; margin:10%\"><h1 style=\"color:white; font-size:30px\">Tu cesta está vacía</h1><p style=\"color:white\">Explora multitud de libros a buen precio desde nuestra página principal</p></div>";
                } else {
                    foreach ($_SESSION['cart'] as $key => $value) {
                        $codigo_libro = $value['product_id'];
                        $ruta_imagen = "../assets/images/covers/" . $codigo_libro . ".png";
                        $imagen = file_exists($ruta_imagen) ? $ruta_imagen : "../assets/images/covers/sin_portada.png";
                ?>
                        <div class="articulocarrito">
                            <a href="<?php echo "libro.php?codigo_libro=" . $codigo_libro; ?>">
                                <img class="portada" src="<?php echo $imagen; ?>">
                            </a>
                            <p class="tituloCarro"><?php echo $value['product_name'] ?></p>
                            <p class="autorCarro"><?php echo $value['product_author'] ?></p>
                            <form method="POST" action="carrito.php">
                                <div class="buttonunidadescont">
                                    <input type="hidden" name="product_id" value="<?php echo $codigo_libro ?>">
                                    <input type="hidden" name="product_quantity" value="<?php echo $value['product_quantity'] ?>">
                                    <button class="buttonunidades" name="more_product">+</button>
                                    <p class="unidadesCarro"><?php echo $value['product_quantity'] ?></p>
                                    <button class="buttonunidades" name="less_product">-</button>
                                    <button class="buttonunidades" name="remove_product">
                                        <svg x="0px" y="0px" width="28" height="28" viewBox="0,0,256,256">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="none" stroke-linecap="none" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                    <g transform="scale(5.33333,5.33333)">
                                                        <path d="M41.5,13h-9c0,-2.5 -9,-2.5 -9,0h-9c-0.8,0 -1.5,0.7 -1.5,1.5c0,0.8 0.7,1.5 1.5,1.5h1v26.5c0,2.2 1.8,4 4,4h17c2.2,0 4,-1.8 4,-4v-26.5h1c0.8,0 1.5,-0.7 1.5,-1.5c0,-0.8 -0.7,-1.5 -1.5,-1.5z" fill="#ffe9c3" stroke="none" stroke-width="1" stroke-linecap="butt"></path>
                                                        <path d="M19.5,11.5v-1.5c0,-2.5 2,-4.5 4.5,-4.5c2.5,0 4.5,2 4.5,4.5v1.5" fill="none" stroke="#18193f" stroke-width="3" stroke-linecap="butt"></path>
                                                        <path d="M8.5,11.5h31" fill="none" stroke="#18193f" stroke-width="3" stroke-linecap="round"></path>
                                                        <path d="M36.5,23.5v-12" fill="none" stroke="#18193f" stroke-width="3" stroke-linecap="round"></path>
                                                        <path d="M11.5,18.7v19.8c0,2.2 1.8,4 4,4h17c2.2,0 4,-1.8 4,-4v-7.5" fill="none" stroke="#18193f" stroke-width="3" stroke-linecap="round"></path>
                                                        <path d="M20.5,19.5v15" fill="none" stroke="#18193f" stroke-width="3" stroke-linecap="round"></path>
                                                        <path d="M27.5,19.5v15" fill="none" stroke="#18193f" stroke-width="3" stroke-linecap="round"></path>
                                                    </g>
                                                </g>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            <p class="precioCarro"><?php echo $value['product_price'] * $value['product_quantity'] . '€' ?></p>
                        </div>
                <?php }
                } ?>
            </div>
            <div class="containerbuttonrealizarcompra">
                <p id="doCompraText">Total = <b><em><?php if (isset($_SESSION['cart'])) {
                                                        echo $_SESSION['total'] . '€';
                                                    } else {
                                                        echo 0;
                                                    } ?></em></b></p>
                <form method="POST" action="formulario-compra.php">
                    <div style="display:flex; justify-content:center;">
                        <button name="do_compra" id="doCompraBton">Realizar pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="links">
            <a href="https://github.com/IAmRiven" target="_blank" rel="noreferrer">
                <svg height="24" viewBox="0 0 16 16" width="24">
                    <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                </svg>
            </a>
            <a href="https://www.linkedin.com/in/juan-antonio-rodr%C3%ADguez-toral-03696224b/" class="linkedinlink" target="_blank" rel="noreferrer">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                </svg>
            </a>
            <a href="mailto:imrivenbot@gmail.com" target="_blank" rel="noreferrer" title="Email : mari.d3v@gmail.com" id="enlaceCaca">
                <svg width="28" height="28" viewBox="4 4 48 48">
                    <path d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 13 16 L 37 16 C 37.18 16 37.349766 16.020312 37.509766 16.070312 L 27.679688 25.890625 C 26.199688 27.370625 23.790547 27.370625 22.310547 25.890625 L 12.490234 16.070312 C 12.650234 16.020312 12.82 16 13 16 z M 11.070312 17.490234 L 18.589844 25 L 11.070312 32.509766 C 11.020312 32.349766 11 32.18 11 32 L 11 18 C 11 17.82 11.020312 17.650234 11.070312 17.490234 z M 38.929688 17.490234 C 38.979688 17.650234 39 17.82 39 18 L 39 32 C 39 32.18 38.979687 32.349766 38.929688 32.509766 L 31.400391 25 L 38.929688 17.490234 z M 20 26.410156 L 20.890625 27.310547 C 22.020625 28.440547 23.510234 29 24.990234 29 C 26.480234 29 27.959844 28.440547 29.089844 27.310547 L 29.990234 26.410156 L 37.509766 33.929688 C 37.349766 33.979688 37.18 34 37 34 L 13 34 C 12.82 34 12.650234 33.979687 12.490234 33.929688 L 20 26.410156 z"></path>
                </svg>
            </a>
        </div>
        <p> &copy; <?php echo (date("Y")) ?> Bookstore. Todos los derechos reservados</p>
        <div class="links">
            <a href="https://github.com/MariD3v" target="_blank" rel="noreferrer">
                <svg height="24" viewBox="0 0 16 16" width="24">
                    <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                </svg>
            </a>
            <a href="https://es.linkedin.com/in/maria-salar-d3v" class="linkedinlink" target="_blank" rel="noreferrer">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                </svg>
            </a>
            <a href="mailto:mari.d3v@gmail.com" target="_blank" rel="noreferrer" title="Email : mari.d3v@gmail.com" id="enlaceCaca">
                <svg width="28" height="28" viewBox="4 4 48 48">
                    <path d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 13 16 L 37 16 C 37.18 16 37.349766 16.020312 37.509766 16.070312 L 27.679688 25.890625 C 26.199688 27.370625 23.790547 27.370625 22.310547 25.890625 L 12.490234 16.070312 C 12.650234 16.020312 12.82 16 13 16 z M 11.070312 17.490234 L 18.589844 25 L 11.070312 32.509766 C 11.020312 32.349766 11 32.18 11 32 L 11 18 C 11 17.82 11.020312 17.650234 11.070312 17.490234 z M 38.929688 17.490234 C 38.979688 17.650234 39 17.82 39 18 L 39 32 C 39 32.18 38.979687 32.349766 38.929688 32.509766 L 31.400391 25 L 38.929688 17.490234 z M 20 26.410156 L 20.890625 27.310547 C 22.020625 28.440547 23.510234 29 24.990234 29 C 26.480234 29 27.959844 28.440547 29.089844 27.310547 L 29.990234 26.410156 L 37.509766 33.929688 C 37.349766 33.979688 37.18 34 37 34 L 13 34 C 12.82 34 12.650234 33.979687 12.490234 33.929688 L 20 26.410156 z"></path>
                </svg>
            </a>
        </div>
    </footer>
</body>

</html>