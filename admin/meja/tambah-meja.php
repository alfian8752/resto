<?php
include '../../db.php';
include '../../auth/auth-admin.php';


if (isset($_POST['submit'])) {
    $meja = $_POST['meja'];

    if (mysqli_query($conn, "INSERT INTO meja VALUES ('$meja', 0)")) {
        $success = "Kategori $kategori berhasil ditambahkan";
        header("location: meja.php?success=$success");
    } else {
        $failed = "Kategori $kategori gagal ditambahkan";
        header("location: meja.php?success=$failed");
    }
}
