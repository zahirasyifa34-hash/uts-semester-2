<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// ambil gambar dulu
$data = mysqli_fetch_array(mysqli_query($conn,"SELECT gambar FROM produk WHERE id='$id'"));
$gambar = $data['gambar'];

// hapus file gambar
if(file_exists("assets/img/".$gambar)){
    unlink("assets/img/".$gambar);
}

// hapus dari database
mysqli_query($conn,"DELETE FROM produk WHERE id='$id'");

header("Location: admin_dashboard.php");
?>