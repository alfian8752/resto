<?php 
include '../../db.php';
include '../../auth/auth-admin.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if (mysqli_query($conn,"DELETE FROM meja WHERE no_meja = $id")) {
        $success = "Meja-$id berhasil dihapus";
        header("location: meja.php?success=$success");
    } else {
        $failed = "Meja-$id gagal dihapus";
        header("location: meja.php?success=$failed");
    }
}