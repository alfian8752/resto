<?php
include '../../db.php';
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id"));
    // var_dump($produk);
}
if (isset($_POST["submit"])) {
    // Upload gambar
    $target_dir = "/pkl/onlineshop/assets/produk-image/";
    $target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // upload data
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    // var_dump($_POST);
    // var_dump($nama . "<br>");
    // var_dump($harga);
    // var_dump($gambar . "<br>");
    
    // mysqli_query($conn, "INSERT INTO produk VALUES ('', '$gambar', '$nama', '$deskripsi', '$harga', '$kategori')");
    
    // Check if image file is a actual image or fake image
    if (isset($_FILES['fileToUpload'])) {
            $gambar = '/pkl/onlinesop/assets/' . basename($_FILES["fileInput"]["name"]);
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            // }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }


            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileInput"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } 
        }
        else {
            $gambar= $produk['gambar'];
        }
    if (mysqli_query($conn, "UPDATE produk SET gambar = '$gambar', judul = '$nama', harga = '$harga', kategori = '$kategori' WHERE id_produk = $id")) {
        // move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file);
        echo "produk baru ditambahkan";
        header('Location: /pkl/onlineshop/admin/produk/produk.php');
    } else {
        header('Location: /pkl/onlineshop/admin/dashboard/produk.php');
        echo "produk gagal ditambahkan";
    }
}
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
    <link rel="stylesheet" href="../uploadProduk.css">



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
                        <div class="gambar">
                            <input type="file" id="fileInput" name="fileInput" accept="image/*" value="<?= $produk['gambar'] ?>">
                            <img id="previewGambar" src="<?= $produk['gambar'] ?>" alt="Pratinjau Gambar" style="display: block;">
                        </div>
                        <div class="mb-3">
                            <label for="floatingInput">Nama Produk</label>
                            <input type="text" class="form-control " name="nama" placeholder="" value="<?= $produk['judul'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="floatingPassword">Harga</label>
                            <input type="number" class="form-control " name="harga" placeholder="" value="<?= $produk['harga'] ?>">
                        </div>
                        <!-- <div class="form-floating"> -->
                        <label for="">Kategori</label>
                        <select class="form-select w-fit-content" name="kategori" id="kategori">
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id'] ?>" selected="<?= ($row['id'] == $produk['kategori']) ? 'selected' : '' ?>"><?= $row['kategori'] ?></option>
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