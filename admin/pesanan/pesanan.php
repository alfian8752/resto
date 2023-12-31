<?php
// require '../../php/delete_pesanan.php';
include '../../db.php';
include '../../auth/auth-admin.php';
$pesanan = mysqli_query($conn, 'SELECT * FROM pesanan INNER JOIN produk ON pesanan.produk = produk.id_produk INNER JOIN user ON pesanan.user = user.id');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Admin | Pesanan</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



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




    /* style table pesanan */
    .pesanan-section img {
      width: 50px;
    }

    .pesanan-section table td {
      /* display: flex; */
      /* flex-direction: column;
      justify-content: center; */
      align-items: center;
    }

    .pesanan-section .action button a {
      color: white;
      text-decoration: none;
    }

    @media (min-width: 300px) {
      .pesanan-section .action button {
        padding: 5px;
        font-size: 12px;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="../dashboard.css" rel="stylesheet">
</head>

<body>
  <?php include '../navbar.php'; ?>

  <div class="container-fluid">
    <div class="row">

      <!-- Main section  -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
                        <strong><?= $_GET['success']; ?></strong>
                        <a href="pesanan.php" class="btn-close"></a>
                    </div>
                <?php } else if (isset($_GET['failed'])) { ?>
                    <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
                        <strong><?= $_GET['failed']; ?></strong>
                        <a href="pesanan.php" class="btn-close"></a>
                    </div>
                <?php } ?>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Pesanan</h1>
          <!-- <div class="btn-toolbar mb-2 mb-md-0"> -->
          <!-- <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div> -->
          <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button> -->
          <!-- </div> -->
        </div>
        <div class="table-responsive pesanan-section">
          <table class="table table-striped table-sm text-center">
            <thead class="thead-primary">
              <th>No</th>
              <th>Produk</th>
              <th>Pemesan</th>
              <th>Nomor Meja</th>
              <th>Status</th>
              <th>Tindakan</th>
            </thead>
            <tbody>
              <?php $n = 1;
              foreach ($pesanan as $item) : ?>
                <tr>
                  <th><?= $n++; ?>.</th>
                  <td><?= $item['judul'] ?></td>
                  <td><?= $item['username'] ?></td>
                  <td><?= $item['meja'] ?></td>
                  <td><?= $item['stat'] ?></td>
                  <td>
                    <?php if($item['stat'] == 'proses') { ?>
                      <a href="pesanan-selesai.php?id=<?= $item['id_pesanan'] ?>" class="btn btn-success">Selesai</a>
                    <?php } else echo '' ?>
                  </td>
                </tr>
              <?php 
              endforeach ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <script src="../../dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="../dashboard.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
    // function delete_pesanan(id) {
    //   $.ajax({
    //     type: "POST", // atau "DELETE" tergantung pada tindakan yang diinginkan
    //     url: "../../php/delete_pesanan.php", // Gantilah ini dengan URL endpoint penghapusan Anda
    //     data: {
    //       id: id // Gantilah ini dengan data yang ingin Anda hapus
    //     },
    //     success: function(response) {
    //       // Sukses: Lakukan sesuatu setelah penghapusan berhasil
    //       console.log("Data berhasil dihapus");
    //     },
    //     error: function(xhr, status, error) {
    //       // Kesalahan: Tangani kesalahan yang terjadi selama permintaan
    //       console.error("Terjadi kesalahan: " + error);
    //     }
    //   });
    // }
  </script>

</body>

</html>