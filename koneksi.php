<?php
$conn = mysqli_connect("localhost", "root", "", "ra-olshop");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>