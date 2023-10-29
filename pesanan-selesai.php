<?php
include 'db.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan = $id");
    header("location: pesanan.php");
}