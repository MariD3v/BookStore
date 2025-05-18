<?php

if (isset($_POST["actualizarDatosPago"]) && isset($_SESSION['logged_in'])) {
    $order_date = date('Y-m-d H:i:s');
    $order_name = $_POST['order_name'];
    $order_surname = $_POST['order_surname'];
    $order_phone = $_POST['order_phone'];
    $order_direction = $_POST['order_direction'];
    $order_direction_adicional = $_POST['order_direction_adicional'];
    $order_postal_code = $_POST['order_postal_code'];
    $order_town = $_POST['order_town'];
    $order_city = $_POST['order_city'];

    $order_email = $_POST['order_email'];

    $_SESSION['datos_pago'] = array(
        'order_name' => $order_name,
        'order_surname' => $order_surname,
        'order_email' => $order_email,
        'order_phone' => $order_phone,
        'order_address' => $order_direction,
        'order_address_adicional' => $order_direction_adicional,
        'order_postalcode' => $order_postal_code,
        'order_city' => $order_town,
        'order_province' => $order_city,
    );
}
