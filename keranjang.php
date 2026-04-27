<?php
session_start();
include 'koneksi.php';
include 'navbar.php';

// Tambah produk pertama kali
if(isset($_GET['id'])){
    $id = $_GET['id'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] += 1;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

// Tambah jumlah
if(isset($_GET['tambah'])){
    $id = $_GET['tambah'];
    $_SESSION['cart'][$id] += 1;
}

// Kurang jumlah
if(isset($_GET['kurang'])){
    $id = $_GET['kurang'];
    $_SESSION['cart'][$id] -= 1;

    if($_SESSION['cart'][$id] <= 0){
        unset($_SESSION['cart'][$id]);
    }
}

// Hapus produk
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    unset($_SESSION['cart'][$id]);
}

// Kosongkan keranjang
if(isset($_GET['clear'])){
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h3>🛒 Keranjang Belanja</h3>

    <table class="table table-bordered text-center">
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>

        <?php
        $total = 0;

        if(!empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $id => $qty){
                $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
                $p = mysqli_fetch_array($ambil);

                $subtotal = $p['harga'] * $qty;
                $total += $subtotal;
        ?>

        <tr>
            <td><?php echo $p['nama']; ?></td>
            <td>Rp <?php echo number_format($p['harga']); ?></td>
            <td>
                <a href="keranjang.php?kurang=<?php echo $id; ?>" class="btn btn-warning btn-sm">-</a>
                <strong><?php echo $qty; ?></strong>
                <a href="keranjang.php?tambah=<?php echo $id; ?>" class="btn btn-success btn-sm">+</a>
            </td>
            <td>Rp <?php echo number_format($subtotal); ?></td>
            <td>
                <a href="keranjang.php?hapus=<?php echo $id; ?>" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>

        <?php }} else { ?>
            <tr>
                <td colspan="5">Keranjang kosong 😢</td>
            </tr>
        <?php } ?>

        <tr>
            <th colspan="3">Total</th>
            <th colspan="2">Rp <?php echo number_format($total); ?></th>
        </tr>
    </table>

    <a href="index.php" class="btn btn-warning">⬅ Belanja Lagi</a>
    <a href="keranjang.php?clear=true" class="btn btn-secondary">Kosongkan</a>

    <?php if(!empty($_SESSION['cart'])){ ?>
        <a href="checkout.php" class="btn btn-success">Checkout WhatsApp</a>
    <?php } ?>

</div>

</body>
</html>