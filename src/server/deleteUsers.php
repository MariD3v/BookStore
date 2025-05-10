<?php
include('getConnection.php');

// Capturamos DELETE "manual"
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);

    if (isset($_GET['action']) && $_GET['action'] === 'deleteUser' && isset($_GET['userId']) && isset($_GET['email'])) {
        $userId = intval($_GET['userId']);
        $userEmail = $_GET['email'];

        // Ojo, en deleteUser() también necesita el nombre, pero aquí solo tenemos ID y Email
        // Si quieres, podrías hacer primero una consulta para traer el nombre antes de eliminar

        // Para ahora, vamos a asumir que no necesitamos nombre para borrar por ID + Email
        if (deleteUserByIdAndEmail($userId, $userEmail)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el usuario']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Parámetros incorrectos']);
    }
    exit();
}

// FUNCIONES
function deleteUserByIdAndEmail($userId, $userEmail)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM cliente WHERE codigo_cliente = ? AND email = ?");
    $stmt->bind_param("is", $userId, $userEmail);
    return $stmt->execute();
}
