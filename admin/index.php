<?php
include '../db.php';
$produk = mysqli_query($conn, "SELECT * FROM produk");
$pesanan = mysqli_query($conn, "SELECT * FROM pesanan");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$ad = mysqli_query($conn, "SELECT * FROM user WHERE role = 'admin'");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors"> -->
  <!-- <meta name="generator" content="Hugo 0.84.0"> -->
  <title>Dashboard</title>

  <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/"> -->



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

    a {
      text-decoration: none;
    }

    .tindakan .row .card {
      width: 20rem;
    }
    .daftar .row .card {
      width: 16rem;
      height: 8rem;
    }
    .daftar .row .card .card-text {
     margin-top: 40px; 
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>

  <?php include 'navbar.php'; ?>

  <div class="container-fluid">
    <div class="row">

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          <!-- <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div> -->
        </div>

        <?php
        // var_dump(mysqli_num_rows($admin));
        // var_dump($admin);
        ?>
        <div class="daftar">

          <div class="row g-4">
            <div class="col">
              <a href="produk/produk.php" class="card shadow rounded" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Produk</h5>
                  <p class="card-text"><?= mysqli_num_rows($produk) ?></p>
                  <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
              </a>
            </div>
            <div class="col">
              <a href="pesanan/pesanan.php" class="card shadow rounded" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Pesanan</h5>
                  <p class="card-text"><?= mysqli_num_rows($pesanan) ?></p>
                  <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
              </a>
            </div>
            <div class="col">
              <a href="kategori/kategori.php" class="card shadow rounded" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Kategori</h5>
                  <p class="card-text"><?= mysqli_num_rows($kategori) ?></p>
                  <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
              </a>
            </div>
            <div class="col">
              <a href="kategori/kategori.php" class="card shadow rounded" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Kategori</h5>
                  <p class="card-text"><?= mysqli_num_rows($ad) ?></p>
                  <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="tindakan">
          <div class="row g-4 mt-5">
            <div class="col">
              <a href="produk/tambah-produk.php" class="card shadow rounded">
                <div class="card-body">
                  <h5 class="card-title">Tambah Produk</h5>
                  <p class="card-text"><?= mysqli_num_rows($produk) ?></p>
                  <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>


  <script src="../../dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>