<?php

include('../src/server/getConnection.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido'], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $stmt =  $conn->prepare("SELECT * FROM libro ORDER BY codigo_libro ASC");
    $stmt->execute();
    $result = $stmt->get_result();

    $products = array();
    while ($row = $result->fetch_assoc()) {
        $row['url_imagen'] = "src/assets/images/covers/" . $row['codigo_libro'] . ".png";
        $products[] = $row;
    }
}

echo json_encode($products, JSON_UNESCAPED_UNICODE);
$stmt->close();