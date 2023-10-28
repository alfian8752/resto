<?php
include '../db.php';
include '../auth/auth-admin.php';

$pesanan = mysqli_query($conn, "SELECT * FROM pesanan INNER JOIN user ON pesanan.user = user.id INNER JOIN produk ON pesanan.produk = produk.id WHERE stat = 'proses'");

$page = $_SERVER['PHP_SELF'];
$sec = "5";
header("Refresh: $sec; url=$page");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesanan</title>
    <link rel="stylesheet" href="..\dist\css\bootstrap.min.css">
    <style>
        * {
            margin: 0;
        }

        .pesanan {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include 'navbar-admin.php' ?>
    <div class="container">
        <table class="pesanan table mt-5" border="1" cellspacing="0" cellpadding="10">
            <thead class="thead-primary">
                <th>No</th>
                <th>Produk</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Tindakan</th>
            </thead>
            <tbody>
                <?php $n = 1;
                foreach ($pesanan as $item) : ?>
                    <tr>
                        <th><?= $n . '.' ?></th>
                        <td><?= $item['produk'] ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['waktu'] ?></td>
                        <td>
                            <a href="pesanan-selesai.php?id=<?= $item['id']?>">
                                <button>Selesai</button>
                            </a>
                        </td>
                    </tr>
                <?php $n++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>