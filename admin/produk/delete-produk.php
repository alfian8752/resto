<?php 
include '../../auth/auth-admin.php';
include '../../db.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if (mysqli_query($conn,"DELETE FROM produk WHERE id_produk = $id")) {
        $success = "Produk $produk berhasil dihapus";
        header("location: produk.php?success=$success");
    } else {
        $failed = "Produk $produk gagal dihapus";
        header("location: produk.php?success=$failed");
    }
}