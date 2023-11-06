<?php
include '../../auth/auth-admin.php';
include '../../db.php';
$kategori = mysqli_query($conn, "SELECT * FROM kategori") or die(mysqli_error($conn));

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
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $kategori = $_POST['kategori'];
  $gambar = $image_name . '.' . $imageFileType;
  $uploadOk = 1;

  // Allow certain file formats
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  ) {
    $errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 1) {
    // if everything is ok, try to upload file
    if (empty($errors)) {
      # code...
      if (mysqli_query($conn, "INSERT INTO produk VALUES ('', '$gambar', '$nama', '$harga', '$kategori')")) {
        $message['success'] = 'Produk berhasil ditambahkan';
        header("Location: /pkl/onlineshop/admin/produk/produk.php?success=" . $message['success']);
      } else {
        header('Location: /pkl/onlineshop/admin/produk/produk.php');
        // echo "produk gagal ditambahkan";
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
  <title>Admin | Tambah Produk</title>


  <!-- costom css -->


  <!-- Bootstrap core CSS -->
  <link href="/pkl/onlineshop/dist/css/bootstrap.min.css" rel="stylesheet">

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
          <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="gambar mb-3">
              <label for="fileInput">Foto</label>
              <input type="file" class="form-control <?= (isset($errors['image'])) ? 'is-invalid' : '' ?> " id="fileInput" name="fileInput" accept="image/*">
              <div class="invalid-feedback">
                <?= $errors['image'] ?>
              </div>
              <img id="previewGambar" src="#" alt="Pratinjau Gambar" style="display: none;" class="mt-2 w-25">
            </div>
            <div class="mb-3">
              <label for="floatingInput">Nama Produk</label>
              <input type="text" class="form-control " name="nama" placeholder="" required>
            </div>
            <div class="mb-3">
              <label for="floatingPassword">Harga</label>
              <input type="number" class="form-control " name="harga" placeholder="" min="1">
            </div>
            <!-- <div class="form-floating"> -->
            <select class="form-select w-25" name="kategori" id="kategori" required>
              <?php foreach ($kategori as $row) : ?>
                <option value="<?= $row['id'] ?>"><?= $row['kategori'] ?></option>
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
    // Seleksi elemen input gambar dan elemen pratinjau
    var inputGambar = document.getElementById('fileInput');
    var pratinjauGambar = document.getElementById('previewGambar');

    // Tambahkan event listener untuk menghandle perubahan pada input gambar
    inputGambar.addEventListener('change', function() {
      var file = inputGambar.files[0]; // Ambil file gambar yang dipilih
      inputGambar.classList.remove('is-invalid')
      if (file) {
        var reader = new FileReader(); // Buat objek FileReader

        // Saat pembacaan file selesai, tampilkan pratinjau gambar
        reader.onload = function(e) {
          pratinjauGambar.style.display = 'block'; // Tampilkan elemen pratinjau
          pratinjauGambar.src = e.target.result; // Atur sumber pratinjau ke data URL gambar
        };

        reader.readAsDataURL(file); // Membaca file sebagai data URL
      }
    });
  </script>

  <script src="/pkl/onlineshop/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="../dashboard.js"></script>
</body>

</html>