<?php

include('getConnection.php');

function getOrders()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM compra ORDER BY fecha DESC LIMIT 7");
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    return $orders;
}
