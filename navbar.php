<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar-custom {
    background: linear-gradient(90deg, #2e7d32, #66bb6a);
}

.navbar-brand {
    font-weight: bold;
    font-size: 22px;
    color: white !important;
}

.nav-link {
    font-weight: 500;
    transition: 0.3s;
    color: white !important;
}

.nav-link:hover {
    transform: scale(1.1);
    color: #ffd966 !important;
}

.badge-admin {
    background: #ffeb3b;
    color: black;
    font-size: 11px;
    margin-left: 5px;
}

/* Banner */
.banner img {
    border-radius: 15px;
    transition: 0.3s;
}

.banner img:hover {
    transform: scale(1.02);
}
</style>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom shadow">
  <div class="container">

    <a class="navbar-brand" href="index.php">
        🛍️ RA Olshop
    </a>

    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      ☰
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item">
          <a class="nav-link" href="index.php">🏠 Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="keranjang.php">🛒 Keranjang</a>
        </li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
        <li class="nav-item">
            <a href="admin_dashboard.php" class="btn btn-warning btn-sm me-2">
                👑 Dashboard
            </a>
        </li>
        <?php } ?>

        <li class="nav-item">
        <?php if(isset($_SESSION['role'])){ ?>
            <a class="nav-link" href="logout.php">🚪 Logout</a>
        <?php } else { ?>
            <a class="nav-link" href="login.php">🔐 Login</a>
        <?php } ?>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>