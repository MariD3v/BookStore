<?php

include('getConnection.php');

$stmt = $conn->prepare("SELECT * FROM compra ORDER BY fecha DESC");
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}
