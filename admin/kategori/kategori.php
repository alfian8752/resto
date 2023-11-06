<?php
include '../../auth/auth-admin.php';
include '../../db.php';
$kategori = mysqli_query($conn, 'SELECT * FROM kategori');

// die(var_dump($produk));
// function cek_kategori($produkid, $kategori) {
//     global $conn;
//     $produk = mysqli_fetch_assoc(mysqli_query($conn,"SELECT kategori FROM produk WHERE id = $produkid"));
//     for ($i=0; $i < count($kategori); $i++) { 
//             if($kategori[$i] == $produk['kategori']) {
//                 die($produk[$i]);
//             } 
//         var_dump($produk[$i]);
//     }
// }
function cek_kategori($id)
{
    global $conn;
    $produk = mysqli_fetch_row(mysqli_query($conn, "SELECT kategori from produk where kategori = $id"));
    if ($produk == NULL) {
        return true;
    } else {
        return false;
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
    <title>Admin | Kategori</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/"> -->



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
        .kategori-section img {
            width: 50px;
        }

        .kategori-section table td {
            /* display: flex; */
            /* flex-direction: column;
      justify-content: center; */
            align-items: center;
        }

        .kategori-section .action button a {
            color: white;
            text-decoration: none;
        }

        @media (min-width: 300px) {
            .kategori-section .action button {
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
                        <a href="kategori.php" class="btn-close"></a>
                    </div>
                <?php } else if (isset($_GET['failed'])) { ?>
                    <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
                        <strong><?= $_GET['failed']; ?></strong>
                        <a href="kategori.php" class="btn-close"></a>
                    </div>
                <?php } ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Daftar Kategori</h1>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                    Tambah Kategori
                </button>

                <!-- tambah-kategori Modal -->
                <div class="modal fade" id="tambahKategoriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kategori</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="tambah-kategori.php" method="post">
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <input type="text" class="form-control" name="kategori" id="tambah-kategori-input" aria-describedby="emailHelp" required>
                                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                            Kategori sudah terdaftar
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" value="sumbit" class="btn btn-primary" id="tambah-btn">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- edit-kategori modal -->
                <?php if (isset($_GET['edit'])) :
                    $idEdit = $_GET['edit'];
                    $editKategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kategori WHERE id = $idEdit"));
                ?>
                    <div class="modal fade" id="editKategoriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="edit-kategori.php?id=<?= $_GET['edit'] ?>" method="post">
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <input type="text" class="form-control" name="kategori" id="edit-kategori-input" aria-describedby="emailHelp" value="<?= $editKategori['kategori'] ?>">
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                Kategori sudah terdaftar
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" value="sumbit" class="btn btn-primary" id="edit-btn">Edit</button>
                                    </form>
                                </div>
                                <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div> -->
                            </div>
                        </div>
                    </div>
                <?php endif ?>


                <div class="table-responsive kategori-section">
                    <table class="table table-striped table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th class="text-center" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody style="max-height: 80vh; box-sizing: border-box; overflow: auto;">
                            <?php
                            $no = 1;
                            foreach ($kategori as $row) : ?>
                                <tr>
                                    <td>
                                        <p class="align-middle"><?= $no++ ?>.</p>
                                    </td>
                                    <td class="list-kategori"><?= $row['kategori'] ?></td>
                                    <td class="action text-center">
                                        <?php if (cek_kategori($row['id'])) : ?>
                                            <a href="delete-kategori.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Anda ingin menghapus kategori <?= $row['kategori'] ?>')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </a>
                                        <?php else : ?>
                                            <a href="kategori.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Tidak bisa menghapus kategori <?= $row['kategori'] ?> karena masih digunakan oleh menu')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </a>
                                        <?php endif ?>
                                        <a href="kategori.php?edit=<?= $row['id'] ?>" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
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

    <script src="../../dist/js/bootstrap.bundle.js"></script>
    <script src="../../dist/js/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <!-- <script>
        const modal = $('#editKategoriModal');
        console.log(modal);
        modal.modal('show')
    </script> -->
    <?php if (isset($_GET['edit'])) : ?>
        <script>
            $(document).ready(function() {
                $('#editKategoriModal').modal('show');
            });
        </script>
    <?php endif ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script> -->
    <script src="../dashboard.js"></script>

    <script>
        const editKategori = document.getElementById('edit-kategori-input')
        const tambahKategori = document.getElementById('tambah-kategori-input')
        const kategori = document.querySelectorAll('.list-kategori')

        <?php if (isset($_GET['edit'])) : ?>
            editKategori.addEventListener('change', () => {
                for (let i = 0; i < kategori.length; i++) {
                    const element = kategori[i];
                    if (editKategori.value == element.innerHTML) {
                        editKategori.classList.add('is-invalid');
                        document.getElementById('edit-btn').setAttribute('disabled', true)
                        break;
                    } else {
                        document.getElementById('edit-btn').removeAttribute('disabled')
                        editKategori.classList.remove('is-invalid');
                    }
                }
            });
        <?php endif ?>
        tambahKategori.addEventListener('change', () => {
            for (let i = 0; i < kategori.length; i++) {
                const element = kategori[i];
                if (tambahKategori.value == element.innerHTML) {
                    tambahKategori.classList.add('is-invalid');
                    document.getElementById('tambah-btn').setAttribute('disabled', true)
                    break;
                } else {
                    document.getElementById('tambah-btn').removeAttribute('disabled')
                    tambahKategori.classList.remove('is-invalid');
                }
            }
        });
    </script>

    <script>
        // Fungsi ini akan menghentikan tindakan default yang biasanya terjadi saat elemen diklik.
        function handleClick(event) {
            event.preventDefault(); // Menghentikan tindakan default (misalnya mengikuti tautan)
        }

        // Fungsi ini akan mencegah tindakan default yang biasanya terjadi saat formulir dikirim.
        function handleFormSubmit(event) {
            event.preventDefault(); // Menghentikan pengiriman formulir
            alert('Form submission is disabled for this link.');
        }
    </script>

</body>

</html>