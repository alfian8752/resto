<?php 
include 'db.php';
include '../auth/auth-admin.php';

$id = $_GET['id'];
mysqli_query($conn, "UPDATE pesanan SET stat='selesai' WHERE id = $id");

header('Location: ' . $_SERVER['HTTP_REFERER']);
