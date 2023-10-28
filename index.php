<?php
include 'db.php';
include 'auth/auth.php';
if (isset($_GET['kategori'])) {
    $id = $_GET['kategori'];
    $produk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = $id");
} else {
    $produk = mysqli_query($conn, "SELECT * FROM produk ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="dist\css\bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/home.css"> -->
    <style>
        a {
            text-decoration: none;
        }

        .card {
            height: 450px;
        }

        .card img {
            height: 200px;
        }

        .products {
            height: 550px;
            max-width: 70%;
            box-sizing: border-box;
        }

        .kategori {
            min-width: 25%;
            min-height: 200px;
            border-radius: 10px;
            min-height: 100px;
        }

        .popup {
            width: 100%;
            height: 100vh;
            /* background-color: skyblue; */
            position: fixed;
            top: 0;
            z-index: 5;
            margin: auto;
            display: none;
        }

        .popup .content {
            margin-top: 100px;
            width: 60%;
            /* background-color: white; */
        }

        .popup .cancel-icon {
            width: 30px;
            height: auto;
            /* position: absolute; */
        }

        .show {
            display: block !important;
        }

        .card {
            height: fit-content;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <div class="search mt-5">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="d-flex flex-row justify-content-between overflow-auto mt-5">
            <div class="kategori">
                <ul class="list-group list-group-flush">
                    <a href="index.php">
                        <li class="list-group-item <?= (!isset($_GET['kategori'])) ? 'active' : '' ?>">Semua</li>
                    </a>
                    <?php
                    foreach (mysqli_query($conn, "SELECT * FROM kategori") as $kategori) : ?>
                        <a href="?kategori=<?= $kategori['id'] ?>">
                            <li class="list-group-item <?= (isset($_GET['kategori']) && $_GET['kategori'] == $kategori['id']) ? 'active' : '' ?>"><?= $kategori['kategori'] ?></li>
                        </a>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="products col-6-sm-3 overflow-auto overflow-x-hidden">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($produk as $data) :
                        $id_prooduk = $data['id']
                    ?>
                        <div class="pesan col">
                            <div class="card w-fit-content">
                                <img src="<?= $data['gambar'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <form action="pesan.php" method="post">
                                        <h5 class="card-title"><?= $data['judul'] ?></h5>
                                        <p class="card-text"><?= $data['deskripsi'] ?></p>
                                        <p class="card-text harga">Rp. <?= number_format($data['harga'], 2, ',', '.') ?></p>
                                        <a href="?id=<?= $data['id'] ?>" class="btn-pesan btn btn-primary">Pesan</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['id'])) :
        $id = $_GET['id'];
        $pesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = $id"));

        $judul = $pesanan['judul'];
        $harga = $pesanan['harga'];
        $gambar = $pesanan['gambar'];
        $deskripsi = $pesanan['deskripsi'];
        $id = $pesanan['id'];
    ?>
        <div class="popup container-fluid show" id="popup">
            <div class="d-flex justify-content-center align-items-center">
                <div class="content">
                    <div class="card">
                        <h5 class="card-header">Pesan</h5>
                        <div class="row">
                            <img src="<?= $gambar ?>" class="col-4" alt="">
                            <div class="card-body col-6">
                                <h5 class="card-title"><?= $judul ?></h5>
                                <p class="card-text">Harga <?= $harga ?></p>
                                <form action="pesan.php?id=<?= $id ?>" method="post">
                                    <select class="form-select" name="meja" id="">
                                        <?php
                                        $meja = mysqli_query($conn, 'SELECT * FROM meja');
                                        for ($i = 1; $i <= 10; $i++) : ?>
                                            <option value="<?= $i ?>">Meja <?= $i ?></option>
                                        <?php endfor ?>
                                    </select>
                            </div>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <div class="row">
                                <div class="col-9"></div>
                                <div class="col-1">
                                    <button type="submit" name="submit" class="btn btn-primary">Pesan</button>
                                </div>
                                </form>
                                <div class="col-1">
                                    <button href="#" class="btn btn-danger" onclick="togglePopup()">cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    <?php endif ?>
    <script>
        const popup = document.getElementById('popup');
        const button = document.querySelectorAll('.btn-pesan');

        function togglePopup() {
            popup.classList.toggle('show');
            console.log(popup);
        }
    </script>
</body>

</html>