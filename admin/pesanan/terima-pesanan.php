<?php 
include '../../db.php';
include '../../auth/auth-admin.php';

$id = $_GET['id'];
// var_dump($id);

if (mysqli_query($conn, "UPDATE pesanan SET stat = 'proses' WHERE id_pesanan = $id")) {
    $success = "Pesanan Diterima";
    header("location: pesanan.php?success=$success");
} else {
    $failed = "gagal";
    header("location: pesanan.php?success=$failed");
}
header('Location: pesanan.php');
