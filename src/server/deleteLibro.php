<?php
include('getConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $codigo_libro = $_DELETE['codigo_libro'] ?? null;

    if (!$codigo_libro) {
        echo json_encode(['success' => false, 'message' => 'Código del libro no proporcionado.']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM libro WHERE codigo_libro = ?");
    $stmt->bind_param("i", $codigo_libro);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Libro eliminado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el libro.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
