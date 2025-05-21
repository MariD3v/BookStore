<?php
include("getConnection.php");

session_start();

if (isset($_POST['do_compra'])) {
    if (empty($_SESSION['cart'])) {
        header('location: ../index.php');
        exit();
    } else if (!isset($_SESSION['logged_in'])) {
        header('location: iniciar-sesion.php');
        exit();
    }
}
