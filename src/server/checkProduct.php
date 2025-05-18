<?php
include('getConnection.php');

function checkIfProductoIsActive($codigo_libro)
{
    global $conn;
    $sql = "SELECT activado FROM libro WHERE codigo_libro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_libro);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['activado'] == 1;
    } else {
        return false;
    }
}
