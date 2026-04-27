<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $cek = mysqli_query($conn,"SELECT * FROM admin WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($cek) > 0){
        $_SESSION['admin'] = $user;
        header("Location: admin_dashboard.php");
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #2e7d32, #66bb6a) !important;
    height: 100vh;
}

/* Card login */
.login-card {
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Tombol login */
.btn-login {
    background-color: #2e7d32 !important;
    color: white !important;
    border: none;
}

.btn-login:hover {
    background-color: #1b5e20 !important;
}

/* Input focus */
input:focus {
    border-color: #2e7d32 !important;
    box-shadow: 0 0 5px #66bb6a !important;
}
</style>
</head>

<body class="bg-warning d-flex justify-content-center align-items-center" style="height:100vh;">

<form method="POST" class="bg-white p-4 rounded shadow">
    <div class="card login-card p-4 text-center">
    <h4>🔒 Login Admin</h4>

    <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<button name="login" class="btn btn-login w-100">Login</button>
</div>
</form>

</body>
</html>