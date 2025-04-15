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

function getTotalUsersNumber()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM cliente");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['total'];
}

function getTotalOrdersNumber()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM compra");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['total'];
}

function ViewVisitsNumeber()
{

    global $conn;
    $stmt = $conn->prepare("SELECT visitas FROM visitas");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['visitas'];
}
