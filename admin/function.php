<?php
session_start();
require_once '../admin/koneksi.php';

function checkLogin() {
    if (!isset($_SESSION['userid'])) {
        header("Location: landingpage.php");
        exit();
    }
}

function getUser($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function getNews($id) {
    global $conn;
    $sql = "SELECT * FROM news WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
?>
