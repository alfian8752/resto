<?php 
include '../../db.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // mysqli_query($conn,"DELETE FROM kategori WHERE id = $id") or var_dump(mysqli_error($conn));
    if (mysqli_query($conn,"DELETE FROM kategori WHERE id = $id")) {
        $success = "Kategori $kategori berhasil dihapus";
        header("location: kategori.php?success=$success");
    } else {
        $failed = "Kategori $kategori gagal dihapus";
        header("location: kategori.php?success=$failed");
    }
}