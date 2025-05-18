<?php
include('getConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    if (isset($_GET['action']) && $_GET['action'] === 'deleteUser' && isset($_GET['userId']) && isset($_GET['email'])) {
        $userId = intval($_GET['userId']);
        $userEmail = $_GET['email'];

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

function deleteUserByIdAndEmail($userId, $userEmail)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM cliente WHERE codigo_cliente = ? AND email = ?");
    $stmt->bind_param("is", $userId, $userEmail);
    return $stmt->execute();
}
