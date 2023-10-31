<?php
include 'db.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = $id");
    mysqli_query($conn, "UPDATE meja SET used = 0 WHERE no_meja = $id");
    header("location: pesanan.php?message=Pesanan selesai silahkan melakukan pembayaran ke kasir");
}