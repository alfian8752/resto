<?php
include '../db.php';

// if (session_status() == PHP_SESSION_NONE) session_start();

//     $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND pass = '$password'"));
//     $_SESSION['user'] = $user;

//     if (isset($_SESSION['user'])) {
    //         if ($_SESSION['user']['role'] == 'admin') {
        //             header('location: ../admin');
//         } else if ($_SESSION['user']['role'] == 'user') {
//             header('location: ../index.php');
//         }
//     }
//     if (!$user) {
    //         $error = true;
//     }
// echo $_SERVER['REQUEST_METHOD'] . "<br>";
// var_dump($user);
if (isset($_POST['submit'])) {
    $errors = [];
    $username = $_POST['username'];
    // $email = $_POST['email'];
    $password = $_POST['password'];
    
    // cek username sudah digunakan atau belum
    $user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT username FROM user where username = '$username'"));
    if($user != null) {
        $errors['username'] = "Username sudah digunakan";
    }

    if (strlen($username) < 3) {
        $errors['username'] = 'username minimal memiliki 3 karakter';
    } else {
        $users = mysqli_fetch_row(mysqli_query($conn, "SELECT username FROM user"));
        // var_dump(count($users));
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i] == $username) {
                $errors['username'] = "Username sudah digunakan";
                break;
            }
        }
    }

    if (strlen($password) < 8) {
        $errors['password'] = 'Password minimal memiliki 8 karakter';
    }

    if (empty($errors)) {
        // die(true);
        mysqli_query($conn, "INSERT INTO user VALUES ('', null, '$username', null, '$password', 'user')");
        $message = "Anda berhasil Register";
        header("location: login.php?message=$message");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <style>
        .container {
            width: 500px;
            margin: 20px auto;
            border-radius: 5px;
            border: 1px solid rgb(100, 100, 100);
            margin-top: 100px;
            padding: 10px;
        }

        form button {
            margin: auto;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="login-title text-center">Register</h3>
        <form action="" method="POST">
            <!-- <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= (isset($_POST['username'])) ? $_POST['username'] : '' ?>" required>
            </div> -->
            <?php
            if (!empty($errors)) : ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control <?= (isset($errors['username'])) ? 'is-invalid' : '' ?>" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $username ?>" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?= $errors['username'] ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" class="form-control <?= (isset($errors['password'])) ? 'is-invalid' : '' ?>" name="password" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?= $errors['password'] ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div> -->
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
                </div>
            <?php endif ?>
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
            <button type="submit" name="submit" class="btn btn-primary w-100" value="submit">Register</button>
        </form>
    </div>

    <script src="../dist/js/bootstrap.min.js"></script>
</body>

</html>