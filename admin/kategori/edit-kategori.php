<?php
include '../../db.php';
include '../../auth/auth-admin.php';

if (isset($_POST['submit'])) {
    $kategori = $_POST['kategori'];
    $id = $_GET['id'];

    if (mysqli_query($conn, "UPDATE kategori SET kategori = '$kategori' Where id = $id")) {
        $success = "Kategori berhasil diedit";
        header("location: kategori.php?success=$success");
    } else {
        $failed = "Kategori gagal diedit";
        header("location: kategori.php?success=$failed");
    }
}
