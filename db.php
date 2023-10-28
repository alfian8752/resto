<?php 
$server = 'localhost';
$password = '';
$username = 'root';
$database = 'db_crud';

$conn = mysqli_connect($server, $username, $password, $database);

if( !$conn ) {
    die("Gagal koneksi ke database");
}