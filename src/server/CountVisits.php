<?php
include('getConnection.php');

function countAndUpdateVisits()
{
    global $conn;

    if (!isset($_COOKIE['visito'])) {
        $stmt = $conn->prepare("SELECT visitas FROM visitas WHERE id = 0");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $visitas = $row['visitas'] + 1;

        $stmt = $conn->prepare("UPDATE visitas SET visitas = ? WHERE id = 0");
        $stmt->bind_param("i", $visitas);
        $stmt->execute();

        setcookie('visito', 'true', time() + 86400, "/");

        return $visitas;
    }

    $stmt = $conn->prepare("SELECT visitas FROM visitas WHERE id = 0");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['visitas'];
}

countAndUpdateVisits();
