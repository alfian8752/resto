<?php
include '../../auth/auth-admin.php';
include '../../db.php';
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori ASC");

$errors = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id"));
    // var_dump($produk);
}
$errors = [];
if (isset($_POST["submit"])) {
    // die(var_dump($_FILES));
    // Upload gambar
    $target_dir = "../../assets/produk-image/";
    $imageFileType = strtolower(pathinfo($_FILES['fileInput']['name'], PATHINFO_EXTENSION));
    $image_name = time() . hash('md5', $_FILES["fileInput"]["name"]);
    $target_file = $target_dir . $image_name . '.' . $imageFileType;


    // die(var_dump($_FILES));


    // upload data
    $uploadOk = 1;
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    //   die(strlen($_FILES['fileInput']['name']) > 0);
    if (strlen($_FILES['fileInput']['name']) > 0) {
        $gambar = $image_name . '.' . $imageFileType;
        unlink('../../assets/produk-image/' . $produk['gambar']);
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            ) {
            $errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    } else {
        $gambar = $produk['gambar'];
    }

    // Allow certain file formats


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        // if everything is ok, try to upload file
        if (empty($errors)) {
            # code...
            if (mysqli_query($conn, "UPDATE produk set gambar = '$gambar', judul = '$nama', harga = '$harga', kategori = '$kategori' where id_produk = $id")) {
                $message['success'] = 'Produk berhasil ditambahkan';
                header("Location: /pkl/onlineshop/admin/produk/produk.php?success=" . $message['success']);
            } else {
                header('Location: /pkl/onlineshop/admin/produk/produk.php');
            }

            move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file);
        }
    }
}
// var_dump($uploadOk);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin | Edit Produk</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">


    <!-- costom css -->


    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

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

        .gambar {
            width: 300px;
        }

        .gambar img {
            max-width: 100%;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../dashboard.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include '../navbar.php'; ?>


            <!-- content utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tambah Produk</h1>
                </div>
                <!-- <a href="uploadProduk.php" class="btn btn-success">Tambah Produk</a> -->
                <div class="tambah-produk">
                    <form class="div" action="" method="post" enctype="multipart/form-data">
                        <div class="gambar mb-3">
                            <label class="form-label" for="fileInput" class="form-label">Nama Produk</label>
                            <input type="file" class="form-control <?= (isset($errors['image'])) ? 'is-iinvalid' : '' ?> " id="fileInput" name="fileInput" accept="image/*">
                            <div class="invalid-feedback">
                                <?= $errors['message'] ?>
                            </div>
                            <img id="previewGambar" src="../../assets/produk-image/<?= $produk['gambar'] ?>" alt="Pratinjau Gambar" style="display: block;" class="mt-2">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="floatingInput">Nama Produk</label>
                            <input type="text" class="form-control " name="nama" placeholder="" value="<?= $produk['judul'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="floatingPassword">Harga</label>
                            <input type="number" class="form-control " name="harga" placeholder="" value="<?= $produk['harga'] ?>" min="1">
                        </div>
                        <!-- <div class="form-floating"> -->
                        <label class="form-label" for="">Kategori</label>
                        <select class="form-select w-fit-content" name="kategori" id="kategori">
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id'] ?>" <?= ($row['id'] == $produk['kategori']) ? 'selected' : '' ?>><?= $row['kategori'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <!-- </div> -->
                        <!-- <div class="input-deskripsi">
              <input id="deskripsi" type="hidden" name="deskripsi">
              <trix-editor input="deskripsi"></trix-editor>
            </div> -->
                        <input class="btn btn-primary mt-5" type="submit" name="submit" value="Upload">
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
    <script src="../dashboard.js"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</body>

</html>