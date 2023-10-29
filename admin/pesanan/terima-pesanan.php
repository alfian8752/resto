<?php 
include '../../db.php';
include '../../auth/auth-admin.php';

$id = $_GET['id'];
// var_dump($id);
mysqli_query($conn, "UPDATE pesanan SET stat = 'proses' WHERE id_pesanan = $id") or die(mysqli_error($conn));

// header('Location: pesanan.php');
