<?php
include 'db.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $meja = $_GET['meja'];
    
    mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = $id");
    mysqli_query($conn, "UPDATE meja SET used = 0 WHERE no_meja = $meja");
    header("location: pesanan.php?message=Pesanan selesai silahkan melakukan pembayaran ke kasir");
}