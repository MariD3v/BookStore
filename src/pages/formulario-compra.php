<?php
include("../server/formCarrito.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="../styles/style.css" type="text/css" />
    <script
        src="https://www.paypal.com/sdk/js?client-id=ARnrqAjjIJCC1jhi9mGZ-pGxSlOQ8VQDhMnFIpdMo0n-Pziw7iGpLMKka7OaODPP8-36IeDl6WndGN2R&currency=EUR&components=buttons&enable-funding=venmo,paylater,card"
        data-sdk-integration-source="developer-studio">
    </script>

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
        <h1 id="tituloFormulario">Datos de Compra</h1>
        <form method="POST" name="formulario" id="formularioCompra">
            <input type="hidden" name="docompraformulariodefinitiva" value="1">
            <div id="formulariocontainer">
                <div>
                    <label>Nombre</label>
                    <input type="text" name="order_name" placeholder=" Nombre" value="">
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Apellidos</label>
                    <input type="text" name="order_surname" placeholder=" Apellidos" value="">
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Correo electrónico</label>
                    <input type="text" name="order_email" placeholder=" Correo electrónico" value="">
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Teléfono</label>
                    <input type="text" name="order_phone" placeholder=" Teléfono" value="">
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Dirección</label>
                    <input type="text" name="order_direction" placeholder=" Dirección" value="" />
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Datos adicionales</label>
                    <input type="text" name="order_direction_adicional" placeholder=" Datos adicionales (piso,puerta,barrio...)" value="" />
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Código postal</label>
                    <input type="text" name="order_postal_code" placeholder=" Código postal" value="" />
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Población</label>
                    <input type="text" name="order_town" placeholder=" Población" value="" />
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Provincia</label>
                    <input type="text" name="order_city" placeholder=" Provincia" value="" />
                    <p class="pError"></p>
                </div>
                <div>
                    <label>Metodo de pago</label>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </form>
    </main>

    <footer>
        <p>Página web realizada por Maria Salar Garcia</p>
        <div class="links">
            <a href="https://github.com/LittleMari" target="_blank" rel="noreferrer">
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
    <script>
        paypal.Buttons({
            style: {
                layout: 'horizontal',
                color: 'blue',
                shape: 'rect',
                label: 'pay',
                tagline: false,
                height: 40
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?= $_SESSION['total'] ?>'
                        }
                    }]
                });
            },
            onCancel: function(data) {
                console.log('Pago cancelado', data);
            },
            onApprove: async function(data, actions) {
                try {
                    const details = await actions.order.capture();

                    let formu = document.getElementById('formularioCompra');

                    if (!formu) {
                        console.error('No se encontró el formulario.');
                        return;
                    }

                    let formulario = new FormData(formu);

                    const response = await fetch('./compra-realizada.php', {
                        method: 'POST',
                        body: formulario
                    });

                    if (response.ok) {
                        console.log(formulario)
                        console.log(response);
                        window.location.href = 'compra-realizada.php?order_status=Compra realizada con éxito';
                    } else {
                        console.error('Error en la respuesta del servidor');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            },
            onError: function(err) {
                console.error('An error occurred during the transaction', err);
                alert('Ocurrió un error durante la transacción. Por favor, inténtelo de nuevo.');
            }
        }).render('#paypal-button-container');
    </script>
    <script src="../scripts/orderFormValidation.js"></script>
</body>

</html>