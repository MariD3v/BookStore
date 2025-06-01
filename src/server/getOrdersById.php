<?php
include_once('getConnection.php');
include_once('adminpanel.php');

$orderId = intval($_GET['orderId']);

$sql = "
    SELECT 
        c.codigo_compra, 
        c.total, 
        c.estado, 
        c.nombre, 
        c.apellidos, 
        dc.codigo_libro, 
        dc.unidades,
        dc.precio_unitario, 
        l.precio,
        l.titulo
    FROM compra c
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
            'codigo_libro' => $row['codigo_libro'],
            'nombre' => $row['nombre'],
            'estado' => $row['estado'],
            'apellidos' => $row['apellidos'],
            'unidades' => $row['unidades'],
            'precio' => $row['precio'],
            'titulo' => $row['titulo'],
            'precio_unitario' => $row['precio_unitario'],
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
