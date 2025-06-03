<?php
include_once('getConnection.php');
include_once('adminpanel.php');

$orderId = intval($_GET['orderId']);

$sql = "
    SELECT 
        cl.nombre AS nombre_cliente,
        cl.apellidos AS apellidos_cliente,
        cl.email AS email_cliente,
        c.codigo_compra, 
        c.total, 
        c.estado, 
        c.nombre, 
        c.telefono, 
        c.direccion,
        c.codigo_postal,
        c.poblacion,
        c.provincia, 
        c.direccion_adicional,
        c.apellidos, 
        dc.codigo_libro, 
        dc.unidades,
        dc.precio_unitario, 
        l.precio,
        l.titulo
    FROM cliente cl INNER JOIN compra c ON cl.codigo_cliente = c.codigo_cliente
    LEFT JOIN detalle_compra dc ON c.codigo_compra = dc.codigo_compra
    LEFT JOIN libro l ON dc.codigo_libro = l.codigo_libro
    WHERE c.codigo_compra = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $orderId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $orderDetails = [];
    $totalCompra = 0;

    while ($row = $result->fetch_assoc()) {
        $totalProducto = $row['unidades'] * $row['precio_unitario'];

        $orderDetails[] = [
            'datos_cliente' => $row['nombre_cliente'] . ' ' . $row['apellidos_cliente'],
            'email_cliente' => $row['email_cliente'],
            'codigo_libro' => $row['codigo_libro'],
            'nombre_completo' => $row['nombre'] . ' ' . $row['apellidos'],
            'apellidos' => $row['apellidos'],
            'unidades' => $row['unidades'],
            'precio' => $row['precio'],
            'titulo' => $row['titulo'],
            'precio_unitario' => $row['precio_unitario'],
            'direccion_envio' => ucfirst($row['direccion']),
            'codigo_postal' => $row['codigo_postal'],
            'poblacion' => $row['poblacion'],
            'provincia' => $row['provincia'],
            'direccion_adicional' => $row['direccion_adicional'] ?? '',
            'telefono' => $row['telefono'],
            'codigo_compra' => $row['codigo_compra'],
            'estado' => $row['estado'],
            'total_producto' => $totalProducto
        ];

        $totalCompra += $totalProducto;
    }

    echo json_encode([
        'success' => true,
        'orderDetails' => $orderDetails,
        'total' => number_format($totalCompra, 2)
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontraron detalles de la compra.']);
}
