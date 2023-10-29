<?php 
var_dump($_SERVER['REQUEST_METHOD']);
// if (isset($_POST["submit"])) {
//     // Upload gambar
//     $target_dir = "/pkl/onlineshop/assets/produk-image/";
//     $target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//     // upload data
//     $nama = $_POST['nama'];
//     $harga = $_POST['harga'];
//     $kategori = $_POST['kategori'];
//     $gambar = '/pkl/onlinesop/assets/' . basename($_FILES["fileInput"]["name"]);

//     if (mysqli_query($conn, "UPDATE produk SET 'gambar' = '', 'judul' = '$nama', 'harga' = '$harga', 'kategori' = '$kategori') Where id_produk = $id")) {
//         // move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file);
//         echo "produk baru ditambahkan";
//         header('Location: /pkl/onlineshop/admin/produk/produk.php');
//     } else {
//         header('Location: /pkl/onlineshop/admin/dashboard/produk.php');
//         echo "produk gagal ditambahkan";
//     }
// }