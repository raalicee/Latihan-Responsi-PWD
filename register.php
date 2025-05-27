<?php
session_start();
include 'koneksi.php';

$error_message = '';
$success_message = '';

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ambil data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Lindungi dari SQL Injection
    $username = $koneksi->real_escape_string($username);
    $password = $koneksi->real_escape_string($password); 

    // Cek apakah username sudah ada
    $check_user_sql = "SELECT id FROM users WHERE username = '$username'";
    $check_user_result = $koneksi->query($check_user_sql);

    if ($check_user_result->num_rows > 0) {
        $_SESSION['error_message'] = "Register gagal. Username sudah terdaftar.  ";
        header("Location: register.php");
        exit();
    }
    // validasi dan konfirmasi password
    if ($password != $confirm_password) {
        $_SESSION['error_message'] = "Password dan confirm password tidak cocok.";
        header("Location: register.php");
        exit();
    }
    // insert data user baru ke database
    $insert_sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($koneksi->query($insert_sql) === TRUE) {
        $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error saat registrasi: " . $koneksi->error;
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="register.css"> </head>
<body>
    <div class="regist-container">
        <h2 class="regist-title">Register</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <label for="username">username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">konfirmasi password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="regist-button">Register</button>
        </form>
        <p class="login-link">Sudah punya akun? <a href="login.php">login</a> disini</p>
    </div>
</body>
</html>