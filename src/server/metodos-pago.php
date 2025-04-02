<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['payment_method'])) {
        $paymentMethod = $_POST['payment_method'];

        $_SESSION['payment_method'] = $paymentMethod;

        header('Location: resumen-pedido.php');
        exit();
    }
}
