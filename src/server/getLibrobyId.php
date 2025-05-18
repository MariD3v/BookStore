<?php
include_once('getConnection.php');
include_once('adminpanel.php');

$libroId = intval($_GET['libroId']);

$sql = "
    SELECT *
    from libro
    where codigo_libro = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $libroId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $libro = $result->fetch_assoc();


    echo json_encode([
        'success' => true,
        'libroDetails' => $libro
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontraron detalles de la compra.']);
}
