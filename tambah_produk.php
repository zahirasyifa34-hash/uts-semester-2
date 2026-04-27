<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'],"assets/img/".$gambar);

    mysqli_query($conn,"INSERT INTO produk VALUES(NULL,'$nama','$harga','$gambar','$deskripsi')");

    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h3>Tambah Produk</h3>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Produk" required>
        <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>
        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <input type="file" name="gambar" class="form-control mb-2" required>

        <button name="simpan" class="btn btn-success">Simpan</button>
    </form>
</div>

</body>
</html>