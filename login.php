<?php
session_start();
include 'koneksi.php';

$error_message = '';
$success_message = '';

if (isset($_SESSION['error_message'])) { // simpan error message
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
if (isset($_SESSION['success_message'])) { // simpan success message
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // ambil usn dan pw dari register
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ambil data dari database
    $sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($sql);

if ($result->num_rows > 0) { // jika ada user yg cocok
        $row = $result->fetch_assoc(); // ambil data user dri db
        // login berhasil
        $_SESSION['user_id'] = $row['id']; // simpan id user ke session
        $_SESSION['username'] = $row['username']; // simpan username ke session
        header("Location: home.php");
        exit();
    } else {
        // usn or pw salah
        $_SESSION['error_message'] = "Login gagal! Username atau password salah.";
        header("Location: login.php");
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css"> </head>
<body>

    <div class="login-container">
        <h2 class="login-title">Login</h2>
        
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

        <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?> 
        <div class="alert success" style="padding: 2px 0px;">
                <h3>Berhasil Logout</h3>
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
            <button type="submit" class="login-button">Login</button>
        </form>
        <p class="register-link">Belum punya akun? <a href="register.php">register</a> disini</p>
    </div>
</body>
</html>