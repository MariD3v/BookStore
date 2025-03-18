<?php
include("getConnection.php");

session_start();

if (isset($_POST['docompradefinitiva']) && isset($_SESSION['logged_in'])) {

    // obtener datos de compra y meterla en db
    $order_date = date('Y-m-d H:i:s');
    $order_name = $_POST['order_name'];
    $order_surname = $_POST['order_surname'];
    $order_phone = $_POST['order_phone'];
    $order_direction = $_POST['order_direction'];
    $order_direction_adicional = $_POST['order_direction_adicional'];
    $order_postal_code = $_POST['order_postal_code'];
    $order_town = $_POST['order_town'];
    $order_city = $_POST['order_city'];
    $order_total = $_SESSION['total'];

    $order_email = $_POST['order_email'];
    $client_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO compra (estado, fecha, nombre, apellidos, telefono, direccion, direccion_adicional, codigo_postal, poblacion, provincia, codigo_cliente, total) VALUES ('Pendiente de pago', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param('sssississii', $order_date, $order_name, $order_surname, $order_phone, $order_direction, $order_direction_adicional, $order_postal_code, $order_town, $order_city, $client_id, $order_total);
    $stmt->execute();

    //obtener detalles de la compra y meterla en db
    $order_id = $stmt->insert_id;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_quantity = $product['product_quantity'];

        $stmt = $conn->prepare("INSERT INTO detalle_compra (codigo_compra,codigo_libro,unidades) VALUES (?,?,?);");
        $stmt->bind_param('iii', $order_id, $product_id, $product_quantity);
        $stmt->execute();
    }
    //vaciar el carrito
    unset($_SESSION['cart']);

    //Informar que la compra ha sido realizada con exito o ha habido un error
    header('location: compra-realizada.php?order_status=Compra realizada con exito');
    exit();
}
