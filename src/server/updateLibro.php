<?php
include_once('getConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codigo_libro = $_POST['codigo_libro'] ?? null;
    $titulo = $_POST['titulo'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $editorial = $_POST['editorial'] ?? '';
    $n_pag = $_POST['n_pag'] ?? 0;
    $idioma = $_POST['idioma'] ?? '';
    $fecha_publ = $_POST['fecha_publ'] ?? '';
    $encuadernacion = $_POST['encuadernacion'] ?? '';
    $precio = $_POST['precio'] ?? 0.00;
    $descripcion_libro = $_POST['descripcion_libro'] ?? '';
    $serie = $_POST['serie'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $codigo_autor = $_POST['codigo_autor'] ?? null;
    $activado = intval($_POST['activado'] ?? 1);

    if (!$codigo_libro) {
        echo json_encode(['success' => false, 'message' => 'Código del libro no proporcionado.']);
        exit;
    }

    try {
        $sql = "UPDATE libro SET 
                    titulo = ?, 
                    genero = ?, 
                    editorial = ?, 
                    n_pag = ?, 
                    idioma = ?, 
                    fecha_publ = ?, 
                    encuadernacion = ?, 
                    precio = ?, 
                    descripcion_libro = ?, 
                    serie = ?, 
                    numero = ?, 
                    codigo_autor = ?,
                    activado = ?
                WHERE codigo_libro = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssisssdsssiii",
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
            $codigo_autor,
            $activado,
            $codigo_libro
        );


        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Libro actualizado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el libro.']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Excepción: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
