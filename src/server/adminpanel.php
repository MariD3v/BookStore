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

function getUsersForTable()
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM cliente ORDER BY codigo_cliente ASC');
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function getProductsForTable()
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM libro ORDER BY codigo_libro ASC');
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}


function getAuthorsById($id)
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM autor WHERE codigo_autor = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $authors = [];
    while ($row = $result->fetch_assoc()) {
        $authors[] = $row;
    }
    return $authors;
}


function getOrderbyId($id)
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM compra WHERE codigo_compra = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    return $orders;
}
