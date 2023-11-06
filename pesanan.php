<?php

include 'db.php';
include 'auth/auth.php';
$user_id = $_SESSION['user']['id'];
$pesanan = mysqli_query($conn, "SELECT * FROM pesanan INNER JOIN produk ON pesanan.produk = produk.id_produk WHERE user = $user_id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <style>
        .card img {
            height: 200px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="pesanan">
            <?php if (isset($_GET['message'])) { ?>
                <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
                    <strong><?= $_GET['message']; ?></strong>
                    <a href="pesanan.php" class="btn-close"></a>
                </div>
            <?php } ?>
            <h4>Pesanan Anda</h4>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($pesanan as $data) :
                    // $id_prooduk = $data['id']
                ?>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 700px;">
                            <div class="row g-0">
                                <div class="card-header">
                                    Status <span class="<?php if ($data['stat'] == 'selesai') echo 'text-success';
                                                        else if ($data['stat'] == 'proses') echo 'text-primary';
                                                        else echo 'text-danger' ?>"><?= $data['stat'] ?></span>
                                </div>
                                <div class="col-md-4">
                                    <img src="assets/produk-image/<?= $data['gambar'] ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $data['judul'] ?></h5>
                                        <!-- <p class="card-text">additional content. This content is a little bit longer.</p> -->
                                        <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                                        <p class="card-text harga">Rp. <?= number_format($data['harga'], 2, ',', '.') ?></p>
                                        <p class="card-text">Meja <?= $data['meja'] ?></p>
                                        <!-- <a href="" class="btn btn-danger">Batalkan</a>
                                        <a href="" class="btn btn-primary">Ganti Meja</a> -->
                                        <br>
                                        <a href="pesanan-selesai.php?id=<?= $data['id_pesanan'] . '&&' . 'meja=' . $data['meja'] . '"' ?>" class="btn btn-success <?= ($data['stat'] != 'selesai') ? 'disabled' : '' ?> mt-3">Selesai</a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>

</html>