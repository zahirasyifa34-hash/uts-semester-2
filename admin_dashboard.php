<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

// HAPUS PRODUK
if(isset($_GET['hapus'])){
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
    header("Location: dashboard.php");
    exit;
}

// TOTAL DATA
$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'];
$total_transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi"))['total'];
$total_pendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_harga) as total FROM transaksi"))['total'];

?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container mt-4">
    <h2 class="mb-3">🎛️ Dashboard Admin</h2>
    <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['admin']); ?></p>

    <div class="row g-3">

        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5><i class="fa fa-box"></i> Produk</h5>
                    <h2><?php echo $total_produk; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5><i class="fa fa-receipt"></i> Transaksi</h5>
                    <h2><?php echo $total_transaksi; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5><i class="fa fa-money-bill"></i> Pendapatan</h5>
                    <h2>Rp <?php echo number_format($total_pendapatan); ?></h2>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <h4>📦 Manajemen Produk</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

<?php
$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
$no = 1;
while($p = mysqli_fetch_assoc($produk)){
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $p['nama']; ?></td>
    <td>Rp <?php echo number_format($p['harga']); ?></td>
    <td>
        <a href="?hapus=<?php echo $p['id']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin hapus produk ini?')">
           Hapus
        </a>
    </td>
</tr>
<?php } ?>

        </tbody>
    </table>

    <hr>

    <div class="d-flex gap-2 mb-3">
        <a href="tambah_produk.php" class="btn btn-success">+ Tambah Produk</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <h4>📊 Laporan Transaksi</h4>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="date" name="dari" class="form-control">
        </div>
        
        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

<?php
$where = "";
if(isset($_GET['dari']) && isset($_GET['sampai']) && $_GET['dari'] && $_GET['sampai']){
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $where = "WHERE tanggal BETWEEN '$dari' AND '$sampai'";
}

$query = mysqli_query($conn, "SELECT * FROM transaksi $where ORDER BY id DESC");
$no = 1;
while($data = mysqli_fetch_assoc($query)){
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['tanggal']; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td>Rp <?php echo number_format($data['total_harga']); ?></td>
</tr>
<?php } ?>

        </tbody>
    </table>

</div>

</body>
</html>
