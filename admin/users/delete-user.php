<?php
include '../../auth/auth-admin.php';
include '../../db.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM user WHERE id = $id");

    header('location: user.php?success=User Berhasil dihapus');
}