<?php
include '../../db.php';
include '../../auth/auth-admin.php';


if (isset($_POST['submit'])) {
    $meja = $_POST['meja'];
    $id = $_GET['id'];

    mysqli_query($conn, "UPDATE meja SET meja.no_meja = '$meja' Where no_meja = $id") or mysqli_error($conn);

    if (mysqli_query($conn, "UPDATE meja SET meja.no_meja = '$meja' Where no_meja = $id")) {
        $success = "Meja berhasil diedit";
        header("location: Meja.php?success=$success");
    } else {
        $failed = "Meja gagal diedit";
        header("location: meja.php?success=$failed");
    }
}
