<?php
include("../server/getProductsLibro.php");
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

        <div class="book-author-container">
            <div class="firstline">
                <img class="imagen-book" src="../assets/images/covers/<?php echo $libro["codigo_libro"] ?>.png" />
                <div class="atributos-book-author">
                    <h1 id="titulo"><?php echo mb_strtoupper($libro["titulo"]) ?></h1>
                    <a id="autor" href="autor.php?codigo_autor=<?php echo $autor['codigo_autor']; ?>"><?php echo mb_strtoupper($autor["nombre"]) ?></a>
                    <div id="precioygenero">
                        <p><?php echo ($libro["genero"]) ?></p>
                        <p class="precio€"><?php echo ($libro["precio"]) ?></p>
                    </div>
                    <p class="descripcion"><?php echo ($libro["descripcion_libro"]) ?>
                    </p>
                </div>
            </div>
            <form method="POST" action="carrito.php">
                <input type="hidden" name="product_id" value="<?php echo $libro["codigo_libro"] ?>" />
                <input type="hidden" name="product_name" value="<?php echo mb_strtoupper($libro["titulo"]) ?>" />
                <input type="hidden" name="product_price" value="<?php echo ($libro["precio"]) ?>" />
                <input type="hidden" name="product_author" value="<?php echo mb_strtoupper($autor["nombre"]) ?>" />
                <input type="hidden" name="product_quantity" value="1" />
                <button class="añadircestabutton" type="submit" name="add_product">Añadir a la cesta</button>
            </form>
            <fieldset class="fichatecnica">
                <legend>Ficha técnica</legend>
                <p>Nº de paginas</p>
                <p> <?php echo ($libro["n_pag"]) ?> </p>
                <p>Editorial</p>
                <p> <?php echo ($libro["editorial"]) ?> </p>
                <p>Idioma</p>
                <p> <?php echo ($libro["idioma"]) ?> </p>
                <p>Encuadernación</p>
                <p> <?php echo ($libro["encuadernacion"]) ?> </p>
                <p>Fecha de lanzamiento</p>
                <p> <?php echo ($libro["fecha_publ"]) ?> </p>
                <p>Serie/Saga</p>
                <p> <?php if ($libro["serie"] === null) {
                        echo "No";
                    } else {
                        echo ($libro["serie"]) ?> </p>
                <p>Número</p>
                <p><?php echo ($libro["numero"]) ?> </p>
            </fieldset>
        <?php } ?>
        </div>
        <?php if ($librosGenero_consulta->num_rows != 0) { ?>
            <div class="recomendaciones-container">
                <p class="recomendaciones-text">Similares a <span><?php echo mb_strtoupper($libro["titulo"]) ?></span></p>
                <hr>
                <div class="carrusel">
                    <button class="carruselnext carruselbton-btn">◀</button>
                    <div class="carruselcatalogo catalogo">
                        <?php while ($libro = $librosGenero_consulta->fetch_assoc()) { ?>
                            <a class="book" href=<?php echo "libro.php?codigo_libro=" . $libro["codigo_libro"]; ?>>
                                <img class="portada" src="../assets/images/covers/<?php echo $libro["codigo_libro"] ?>.png">
                                <p class="titulo"><?php echo mb_strtoupper($libro["titulo"]) ?></p>
                                <button class="buttoncarro"><img src="../assets/images/buttoncarro.png" alt="añadir a la cesta" height="35px"></button>
                                <p class="precio"><?php echo $libro["precio"] ?></p>
                            </a>
                        <?php } ?>
                    </div>
                    <button class="carruselprev carruselbton-btn">▶</button>
                </div>
            </div>
        <?php } ?>
        <?php if ($librosAutor_consulta->num_rows != 0) { ?>
            <div class="recomendaciones-container">
                <p class="recomendaciones-text">Otros libros de <span><?php echo mb_strtoupper($autor["nombre"]) ?></span></p>
                <hr>
                <div class="carrusel">
                    <button class="carruselnext carruselbton-btn">◀</button>
                    <div class="catalogo">
                        <?php while ($libro = $librosAutor_consulta->fetch_assoc()) { ?>
                            <a class="book" href=<?php echo "libro.php?codigo_libro=" . $libro["codigo_libro"]; ?>>
                                <img class="portada" src="../assets/images/covers/<?php echo $libro["codigo_libro"] ?>.png">
                                <p class="titulo"><?php echo mb_strtoupper($libro["titulo"]) ?></p>
                                <button class="buttoncarro"><img src="../assets/images/buttoncarro.png" alt="añadir a la cesta" height="35px"></button>
                                <p class="precio"><?php echo $libro["precio"] ?></p>
                            </a>
                        <?php } ?>
                    </div>
                    <button class="carruselprev carruselbton-btn">▶</button>
                </div>
            </div>
        <?php } ?>
    </main>
    <footer>
        <p>Página web realizada por Maria Salar Garcia</p>
        <div class="links">
            <a href="https://github.com/MariD3v" target="_blank" rel="noreferrer">
                <svg height="24" viewBox="0 0 16 16" width="24">
                    <path fill-rule="evenodd"
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z">
                    </path>
                </svg>
            </a>
            <a href="https://es.linkedin.com/in/maria-salar-d3v" class="linkedinlink" target="_blank" rel="noreferrer">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                </svg>
            </a>
            <a href="mailto:mari.d3v@gmail.com" target="_blank" rel="noreferrer" title="Email : mari.d3v@gmail.com" id="enlaceCaca">
                <svg width="28" height="28" viewBox="4 4 48 48">
                    <path
                        d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 13 16 L 37 16 C 37.18 16 37.349766 16.020312 37.509766 16.070312 L 27.679688 25.890625 C 26.199688 27.370625 23.790547 27.370625 22.310547 25.890625 L 12.490234 16.070312 C 12.650234 16.020312 12.82 16 13 16 z M 11.070312 17.490234 L 18.589844 25 L 11.070312 32.509766 C 11.020312 32.349766 11 32.18 11 32 L 11 18 C 11 17.82 11.020312 17.650234 11.070312 17.490234 z M 38.929688 17.490234 C 38.979688 17.650234 39 17.82 39 18 L 39 32 C 39 32.18 38.979687 32.349766 38.929688 32.509766 L 31.400391 25 L 38.929688 17.490234 z M 20 26.410156 L 20.890625 27.310547 C 22.020625 28.440547 23.510234 29 24.990234 29 C 26.480234 29 27.959844 28.440547 29.089844 27.310547 L 29.990234 26.410156 L 37.509766 33.929688 C 37.349766 33.979688 37.18 34 37 34 L 13 34 C 12.82 34 12.650234 33.979687 12.490234 33.929688 L 20 26.410156 z">
                    </path>
                </svg>
            </a>
        </div>
    </footer>
    <script src="../scripts/sliderBooks.js"></script>
    <script src="../scripts/addProduct.js"></script>
</body>

</html>