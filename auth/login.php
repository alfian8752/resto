<?php
include '../db.php';

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND pass = '$password'"));
    $_SESSION['user'] = $user;

    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] == 'admin') {
            header('location: ../admin');
        } else if ($_SESSION['user']['role'] == 'user') {
            header('location: ../index.php');
        }
    }
    if (!$user) {
        $error = true;
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

        .alert {
            width: fit-content;
            position: relative;
            top: 50px;
            margin: auto;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="alert alert-warning alert-dismissible fade <?= ($error) ? 'show' : '' ?>" role="alert">
        <strong>Email atau password salah</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="container">
        <h3 class="login-title text-center">Login</h3>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
            </div>
            <p>Belum punya akun? <a href="register.php">Register</a></p>
            <button type="submit" name="submit" class="btn btn-primary w-100 m-auto" value="submit">Login</button>
        </form>
    </div>

    <script src="../dist/js/bootstrap.min.js"></script>
</body>

</html>