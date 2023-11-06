<?php
include '../../db.php';
include '../navbar.php';
$id_user = $_SESSION['user']['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE user.id = $id_user"));
// die(var_dump($_POST));

$errors = [];
if (isset($_POST["submit"]) && isset($_POST["edit"])) {
    // var_dump($_POST);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user_id = $user['id'];
    if (mysqli_query($conn, "UPDATE user SET username = '$username', email = '$email' WHERE id = $user_id")) {
        $message = 'Data berhasil di Edit';
        header('location: ' . $_SERVER['REQUEST_URI']);
    }
}
$editPassword = 1;
if (isset($_POST["submit"]) && isset($_POST["editPass"])) {
    if ($_POST['oldPass'] != $user['pass']) {
        $errors['oldPass'] = 'Password tidak sesuai';
        $editPassword = 0;
        // die(json_encode($errors));
    }

    if (strlen($_POST['curentPass']) < 8) {
        $errors['curentPass'] = 'Minimal 8 karakter';
        $editPassword = 0;
        // die(json_encode($errors));
    }
    if ($editPassword == 1) {
        $id = $user['id'];
        $password = $_POST['curentPass'];
        mysqli_query($conn, "UPDATE user SET pass = '$password' WHERE id = $id");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil Admin</title>
    <script src="../../dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .profile-container {
            /* max-width: 600px; */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ccc;
            margin: auto;
        }

        .profile-details {
            margin-top: 20px;
        }

        input {
            outline: none;
            border: none;
            background: none;
        }

        .profile-info {
            font-size: large;
        }

        .action .btn {
            width: fit-content;
        }
    </style>
</head>

<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php if (isset($message)) { ?>
            <div class="alert alert-success alert-dismissible <?= (isset($_GET['success'])) ? 'show' : '' ?>" role="alert">
                <strong><?= $message; ?></strong>
                <a data-bs-dismiss="alert" class="btn-close"></a>
            </div>
        <?php } ?>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="profile-container container mt-5">
                <div class="row g-4">
                    <div class="col">
                        <div class="profile-info mt-5">
                            <h1><?= $user['username'] ?></h1>
                            <!-- <p class="m-0">Username: <?= $user['username'] ?></p> -->
                            <p class="m-0">Email: <?= $user['email'] ?></p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex flex-column">
                            <!-- <img src="<?= $user['foto'] ?>" alt="" class="profile-picture object-fit-cover"> -->
                            <!-- <button class="btn">Ubah foto</button> -->
                            <div class="mt-5"></div>
                            <div class="action">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit Data</button>
                                <div class="mt-2"></div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPassword">Ganti Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <!-- Modal edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" method="post" class="modal-content">
                <input type="hidden" name="edit">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputPassword1" value="<?= $user['username'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?= $user['email'] ?>" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal password -->
    <div class="modal fade" id="editPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="" method="post" class="modal-content">
                <input type="hidden" name="editPass">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password Lama</label>
                        <input type="password" name="oldPass" class="form-control <?= (isset($errors['oldPass'])) ? 'is-invalid' : '' ?> " id="exampleInputPassword1">
                        <div class="invalid-feedback">
                            <?= (isset($errors['oldPass'])) ? $errors['oldPass'] : ''; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password Baru</label>
                        <input type="password" name="curentPass" class="form-control <?= (isset($errors['curentPass'])) ? 'is-invalid' : '' ?>" id="exampleInputEmail1">
                        <div class="invalid-feedback">
                            <?= (isset($errors['curentPass'])) ? $errors['curentPass'] : ''; ?>
                        </div>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../../dist/js/jquery.min.js"></script>
    <?php if (isset($errors['oldPass']) || isset($errors['curentPass'])) { ?>
        <script>
            $(document).ready(function() {
                $('#editPassword').modal('show');
            });
        </script>
    <?php } ?>
</body>

</html>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-email">
Launch demo modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="edit-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" method="post" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" autofocus >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
    </form>
    </div>
</div> -->