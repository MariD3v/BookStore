<?php
include_once('getConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo             = $_POST['titulo'] ?? '';
    $genero             = $_POST['genero'] ?? '';
    $editorial          = $_POST['editorial'] ?? '';
    $n_pag              = $_POST['n_pag'] ?? 0;
    $idioma             = $_POST['idioma'] ?? '';
    $fecha_publ         = $_POST['fecha_publ'] ?? '';
    $encuadernacion     = $_POST['encuadernacion'] ?? '';
    $precio             = $_POST['precio'] ?? 0.00;
    $descripcion_libro  = $_POST['descripcion_libro'] ?? '';
    $serie              = $_POST['serie'] ?? null;
    $numero             = $_POST['numero'] ?? null;
    $codigo_autor       = $_POST['codigo_autor'];

    try {
        $sql = "INSERT INTO libro (
                    titulo, genero, editorial, n_pag, idioma, 
                    fecha_publ, encuadernacion, precio, 
                    descripcion_libro, serie, numero, codigo_autor
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssissdsssii",
            $titulo,
            $genero,
            $editorial,
            $n_pag,
            $idioma,
            $fecha_publ,
            $encuadernacion,
            $precio,
            $descripcion_libro,
            $serie,
            $numero,
            $codigo_autor
        );

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Libro insertado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al insertar el libro.']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Excepción: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
