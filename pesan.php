<?php 
include 'db.php';
include 'auth/auth.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id"));
$user = $_SESSION['user']['id'];
$produk = $data['id_produk'];
$meja = $_POST['meja'];

$timestamp = time();
$date = date("Y-m-d H:i:s", $timestamp);
// var_dump($data);
mysqli_query($conn, "INSERT INTO pesanan VALUES ('', '$produk', '$user', '$meja', '$date', 'menunggu')");
mysqli_query($conn,"UPDATE meja SET used = 1 WHERE no_meja = $meja");

header('Location: index.php');