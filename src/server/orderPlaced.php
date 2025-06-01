<?php
include("getConnection.php");

session_start();

if (isset($_POST['docompraformulariodefinitiva']) && isset($_SESSION['logged_in'])) {
    $datos = $_SESSION['datos_pago'];

    $order_date = date('Y-m-d H:i:s');
    $order_name = $datos['order_name'];
    $order_surname = $datos['order_surname'];
    $order_phone = $datos['order_phone'];
    $order_direction = $datos['order_address'];
    $order_direction_adicional = $datos['order_address_adicional'];
    $order_postal_code = $datos['order_postalcode'];
    $order_town = $datos['order_city'];
    $order_city = $datos['order_province'];
    $client_id = $_SESSION['user_id'];
    $order_total = $_SESSION['total'];

    $stmt = $conn->prepare("INSERT INTO compra (estado, fecha, nombre, apellidos, telefono, direccion, direccion_adicional, codigo_postal, poblacion, provincia, codigo_cliente, total) VALUES ('Pagado', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param('sssississid', $order_date, $order_name, $order_surname, $order_phone, $order_direction, $order_direction_adicional, $order_postal_code, $order_town, $order_city, $client_id, $order_total);
    $stmt->execute();

    $order_id = $stmt->insert_id;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_quantity = $product['product_quantity'];
        $product_price = $product['product_price'];

        $stmt = $conn->prepare("INSERT INTO detalle_compra (codigo_compra, codigo_libro, unidades, precio_unitario) VALUES (?, ?, ?, ?);");
        $stmt->bind_param('iiid', $order_id, $product_id, $product_quantity, $product_price);
        $stmt->execute();
    }
    unset($_SESSION['cart']);

    exit();
}
