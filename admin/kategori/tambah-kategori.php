<?php
include '../../db.php';
include '../../auth/auth-admin.php';


if (isset($_POST['submit'])) {
    $kategori = $_POST['kategori'];

    if (mysqli_query($conn, "INSERT INTO kategori VALUES ('', '$kategori')")) {
        $success = "Kategori $kategori berhasil ditambahkan";
        header("location: kategori.php?success=$success");
    } else {
        $failed = "Kategori $kategori gagal ditambahkan";
        header("location: kategori.php?success=$failed");
    }
}
