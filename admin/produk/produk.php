<?php
include '../../auth/auth-admin.php';
include '../../db.php';
$produk = mysqli_query($conn, 'SELECT * FROM produk INNER JOIN kategori ON produk.kategori = kategori.id');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Admin | Menu</title>

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

    /* style table produk */
    .produk-section img {
      width: 50px;
    }

    .produk-section table td {
      /* display: flex; */
      /* flex-direction: column;
      justify-content: center; */
      align-items: center;
    }

    .produk-section .action button a {
      color: white;
      text-decoration: none;
    }

    @media (min-width: 300px) {
      .produk-section .action button {
        padding: 5px;
        font-size: 12px;
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

      <!-- Main section  -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
            <strong><?= $_GET['success']; ?></strong>
            <a href="produk.php" class="btn-close"></a>
          </div>
        <?php } else if (isset($_GET['failed'])) { ?>
          <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
            <strong><?= $_GET['failed']; ?></strong>
            <a href="produk.php" class="btn-close"></a>
          </div>
        <?php } ?>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Daftar Menu</h1>
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
        <a href="tambah-produk.php" class="btn btn-success" style="max-height: 50px;">
          <!-- <img src="../assets/bootstrap-icons/icons/plus-square.svg" class="col" alt=""> -->
          <i class="bi bi-plus"></i>Tambah Menu
        </a>
        <div class="table-responsive produk-section">
          <table class="table table-striped table-sm text-center">
            <thead>
              <tr>
                <th scope="col">No. </th>
                <th scope="col">Gambar</th>
                <th scope="col">Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th class="text-center" scope="col">Tindakan</th>
              </tr>
            </thead>
            <tbody class="w-100" style="max-height: 80vh; box-sizing: border-box; overflow: auto;">
              <?php $i=1; foreach ($produk as $row) : ?>
                <tr d-flex flex-column justify-content-center>
                  <td>
                    <p class="align-middle"><?= $i++ ?></p>
                  </td>
                  <td><img src="<?= $row['gambar'] ?>"></td>
                  <td><?= $row['judul'] ?></td>
                  <td><?= $row['kategori'] ?></td>
                  <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                  <td class="action text-center">
                    <a href="delete-produk.php?id=<?= $row['id_produk'] ?>" type="submit" class="btn btn-danger" onclick="return confirm('Anda ingin menghapus produk <?= $row['judul'] ?>')">
                      <div class="row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                          <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                      </div>
                    </a>
                    <a href="edit-produk.php?id=<?= $row['id_produk'] ?>" class="btn btn-primary">
                      <div class="row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                      </div>
                    </a>
                  </td>
                </tr>
              <?php endforeach ?>
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
    // function delete_produk(id) {
    //   $.ajax({
    //     type: "POST", // atau "DELETE" tergantung pada tindakan yang diinginkan
    //     url: "../../php/delete_produk.php", // Gantilah ini dengan URL endpoint penghapusan Anda
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