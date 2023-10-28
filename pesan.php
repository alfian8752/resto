<?php 
include 'db.php';
include 'auth/auth.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = $id"));
$user = $_SESSION['user']['id'];
$produk = $data['id'];
$meja = $_POST['meja'];

$timestamp = time();
$date = date("Y-m-d H:i:s", $timestamp);
// var_dump($data);
mysqli_query($conn, "INSERT INTO pesanan VALUES ('', '$produk', '$user', '$meja', '$date', 'menunggu')");

header('Location: index.php');