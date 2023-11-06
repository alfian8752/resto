<?php
include '../../auth/auth-admin.php';
include '../../db.php';




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $image = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar from produk where id_produk = $id"));
    function cek_pesanan($id)
    {
        global $conn;
        $produk = mysqli_fetch_row(mysqli_query($conn, "SELECT produk from pesanan where produk = $id"));
        if ($produk == NULL) {
            return true;
        } else {
            return false;
        }
    }

    if (cek_pesanan($id)) {
        if (mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id")) {
            $success = "Produk $produk berhasil dihapus";
            unlink('../../assets/produk-image/' . $image['gambar']);
            header("location: produk.php?success=$success");
        }
    } else {
        $failed = "Produk $produk tidak bisa dihapus karena masih dipesan";
        header("location: produk.php?failed=$failed");
    }
}
