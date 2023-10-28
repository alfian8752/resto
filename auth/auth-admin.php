<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
    header('location: /pkl/onlineshop/auth/login.php');
} else if ($_SESSION['user']['role'] != 'admin') {
    header('location: /pkl/onlineshop');
}