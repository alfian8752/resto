<?php
$path = $_SERVER['PHP_SELF'];
$path = basename($path);
$path = substr($path, 0, strpos($path, '.'));

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id_admin = $_SESSION['user']['id'];
$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = $id_admin"));
?>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <div class="dropend">
        <div class="row">
            <img src="/pkl/onlineshop/assets/img/user.png" style="max-width: 50px;" class="col dropdown-toggle p-1" data-bs-toggle="dropdown" aria-expanded="false"/>
            <p class="col text-white"><?= $admin['nama'] ?></p>
        </div>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="/pkl/onlineshop/auth/logout.php">Logout</a></li>
        </ul>
    </div>
    <!-- <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"></a> -->
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
    <div class="w-100"></div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="/pkl/onlineshop/auth/logout.php">Log out</a>
        </div>
    </div>
</header>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($path == 'index') ? 'active' : '' ?>" aria-current="page" href="../index.php">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($path == 'pesanan') ? 'active' : '' ?>" href="/pkl/onlineshop/admin/pesanan/pesanan.php">
                    <span data-feather="file"></span>
                    Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($path == 'produk') ? 'active' : '' ?>" href="/pkl/onlineshop/admin/produk/produk.php">
                    <span data-feather="shopping-cart"></span>
                    Menu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($path == 'user') ? 'active' : '' ?>" href="#">
                    <span data-feather="users"></span>
                    Customers
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="/pkl/onlineshop/dist/js/bootstrap.min.js"></script>