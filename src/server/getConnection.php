<?php
$conn = new mysqli("localhost", "root", "");
$crearBase = false;

if ($crearBase) {
    $sql = "DROP DATABASE IF EXISTS biblioteca";
    $conn->query($sql);

    $sql = "CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci";
    $conn->query($sql);

    $conn->select_db('biblioteca');
    $sql = "USE biblioteca";

    $sqlFile = file_get_contents('./database/database.sql');

    if ($conn->multi_query($sqlFile)) {
        while ($conn->next_result());
    }
} else {
    $conn->select_db('biblioteca');
}
