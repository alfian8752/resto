<?php
include '../../db.php';
$kategori = mysqli_query($conn, "SELECT * FROM kategori") or die(mysqli_error($conn));
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">


    <!-- costom css -->
    <link rel="stylesheet" href="uploadProduk.css">



    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">RestoKU</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <?php include 'navbar.php'; ?>


            <!-- content utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tambah Produk</h1>
                </div>
                <!-- <a href="uploadProduk.php" class="btn btn-success">Tambah Produk</a> -->
                <div class="tambah-produk">
                    <form class="div" action="../../php/upload_produk.php" method="post" enctype="multipart/form-data">
                        <div class="gambar">
                            <input type="file" id="fileInput" name="fileInput" accept="image/*">
                            <img id="previewGambar" src="#" alt="Pratinjau Gambar" style="display: none;">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control " name="nama" placeholder="">
                            <label for="floatingInput">Nama Produk</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control " name="harga" placeholder="">
                            <label for="floatingPassword">Harga</label>
                        </div>
                        <!-- <div class="form-floating"> -->
                        <select class="form-select w-fit-content" name="kategori" id="kategori">
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['kategori'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <!-- </div> -->
                        <!-- <div class="input-deskripsi">
              <input id="deskripsi" type="hidden" name="deskripsi">
              <trix-editor input="deskripsi"></trix-editor>
            </div> -->
                        <input class="btn btn-primary mt-5" type="submit" value="Upload">
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        var inputGambar = document.getElementById('fileInput');
        var pratinjauGambar = document.getElementById('previewGambar');

        inputGambar.addEventListener('change', function() {
            var file = inputGambar.files[0]; 
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    pratinjauGambar.style.display = 'block';
                    pratinjauGambar.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>

    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</body>

</html>