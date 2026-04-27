<?php
include 'koneksi.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>RA Olshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="container mt-4">
    <h2 class="text-center mb-4"> Menu Cendol Segar </h2>

    <div class="container mt-3">

    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
        <a href="admin_dashboard.php" class="btn btn-danger">Dashboard Admin</a>
    <?php } ?>

</div>

    
    <div class="row">
        <?php
        $data = mysqli_query($conn, "SELECT * FROM produk");
        while($d = mysqli_fetch_array($data)){
        ?>
        
        <div class="col-md-4">
            <div class="card shadow text-center p-3 mb-4">
                <img src="assets/img/<?php echo $d['gambar']; ?>" class="img-fluid rounded">
                <h4 class="mt-2"><?php echo $d['nama']; ?></h4>
                <p><?php echo $d['deskripsi']; ?></p>
                <h5 class="text-success">Rp <?php echo number_format($d['harga']); ?></h5>
                <a href="keranjang.php?id=<?php echo $d['id']; ?>" class="btn btn-beli">🛒 Beli</a>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

</body>
</html>