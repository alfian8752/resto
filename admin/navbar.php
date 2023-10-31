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
    <!-- <div class="dropend"> -->
    <!-- <img src="/pkl/onlineshop/assets/img/user.png" style="max-width: 50px;" class="col dropdown-toggle p-1" data-bs-toggle="dropdown" aria-expanded="false"/>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/pkl/onlineshop/admin/profile/profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="/pkl/onlineshop/auth/logout.php">Logout</a></li>
        </ul> -->
    <!-- </div> -->
    <div class="dropend">
        <p class="dropdown-toggle text-white" style="margin: 0 10px !important;" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
        </p>
        <!-- Dropdown menu links -->
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/pkl/onlineshop/admin/profile/profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="/pkl/onlineshop/auth/logout.php">Logout</a></li>
        </ul>
    </div>
    <!-- <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../">Admin</a> -->
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
                <a class="nav-link <?= ($path == 'kategori') ? 'active' : '' ?>" href="/pkl/onlineshop/admin/kategori/kategori.php">
                    <span data-feather="users"></span>
                    Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($path == 'meja') ? 'active' : '' ?>" href="/pkl/onlineshop/admin/meja/meja.php">
                    <span data-feather="users"></span>
                    Meja
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($path == 'user') ? 'active' : '' ?>" href="/pkl/onlineshop/admin/users/user.php">
                    <span data-feather="users"></span>
                    User
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="/pkl/onlineshop/dist/js/bootstrap.min.js"></script>