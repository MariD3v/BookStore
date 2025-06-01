<?php

include('../src/server/getConnection.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido'], JSON_UNESCAPED_UNICODE);
    exit;
} else if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Se ha proporcionado un ID inválido'], JSON_UNESCAPED_UNICODE);
    exit;

} else {
    $stmt =  $conn->prepare("SELECT * FROM libro WHERE codigo_libro = ? ORDER BY codigo_libro ASC");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();


    if ($result === null) {
        http_response_code(404);
        echo json_encode(['error' => 'Producto no encontrado'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $result['url_imagen'] = "src/assets/images/covers/" . $result['codigo_libro'] . ".png";
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
$stmt->close();