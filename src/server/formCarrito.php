<?php
include("getConnection.php");

session_start();

if (isset($_POST['do_compra'])) { //Si pulsamos el botón realizar compra
    if (empty($_SESSION['cart'])) {
        header('location: ../index.php'); //Si el carro esta vacio, nos devuelve a index.php
        exit();
    } else if (!isset($_SESSION['logged_in'])) { //Si no esta iniciada la sesion
        header('location: iniciar-sesion.php'); //Si no esta iniciada la sesion, nos manda a iniciar sesion
        exit();
    }
}
