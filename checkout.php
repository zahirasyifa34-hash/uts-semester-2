<?php
session_start();
include 'koneksi.php';

$no_wa = "6283840648742";

$pesan = "Halo RA Olshop\n";
$pesan .= "Saya ingin memesan:\n\n";

$total = 0;

if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id => $qty){
        $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
        $p = mysqli_fetch_array($ambil);

        $subtotal = $p['harga'] * $qty;
        $total += $subtotal;

        $pesan .= "• ".$p['nama']." x".$qty." = Rp ".number_format($subtotal)."\n";
    }
}

$pesan .= "\n------------------------\n";
$pesan .= "Total: Rp ".number_format($total)."\n";
$pesan .= "------------------------\n";
$pesan .= "Terima kasih";

$pesan_encoded = urlencode($pesan);

header("Location: https://wa.me/$no_wa?text=$pesan_encoded");
exit;
?>

<?php
session_start();
include 'koneksi.php';

if(!empty($_SESSION['cart'])){

    $nama = $_POST['nama']; // dari form
    $tanggal = date('Y-m-d');
    $total = 0;

    foreach($_SESSION['cart'] as $id => $qty){
        $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
        $data = mysqli_fetch_assoc($ambil);

        $total += $data['harga'] * $qty;
    }

    // SIMPAN KE TRANSAKSI
    mysqli_query($conn, "INSERT INTO transaksi (nama, tanggal, total_harga) 
                         VALUES ('$nama', '$tanggal', '$total')");

    // KOSONGKAN KERANJANG
    unset($_SESSION['cart']);

    echo "<script>alert('Pesanan berhasil!'); window.location='index.php';</script>";
}
?>