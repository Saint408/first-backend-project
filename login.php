<?php
session_start();
require 'functions.php';
//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdassarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cokkie dan username 
    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
   
}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    //cel username
        if (mysqli_num_rows($result)=== 1){
            //cek password
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password"])){

                //set session untuk mengecek user
                $_SESSION["login"] = true;

                //cek remembermi
                if(isset($_POST['remember'])){
                    //buat cooke

                    setcookie('id', $row['id'], time()+ 60);
                    setcookie('key', hash('sha256', $row['username']), time()+60);
                }
                header("Location: index.php");
                exit;
            }
        }
        $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman regis</title>
</head>
<style>
    
body {
    font-family: Arial, sans-serif;
    background-color: #ebfcff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    display: flex;
    background-color: #2d2d2d;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.left-section, .right-section {
    padding: 40px;
}

.left-section {
    background-color: #1c1c1c;
    color: white;
    flex: 1;
}
.right-section {
    background: rgb(28,28,28);
background: linear-gradient(90deg, rgba(28,28,28,1) 10%, rgba(0,222,242,1) 57%, rgba(0,254,255,1) 79%);
    color: white;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.login-box {
    background-color: #333;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
}

.login-box h2 {
    margin: 0;
    font-size: 1.5em;
}

.login-box p {
    margin: 10px 0;
}

.login-box .social-login {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.login-box .social-login button {
    flex: 1;
    margin: 0 5px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.login-box .social-login .google {
    background-color: #db4437;
    color: white;
}

.login-box .social-login .facebook {
    background-color: #3b5998;
    color: white;
}

.login-box .social-login .github {
    background-color: #333;
    color: white;
}

.login-box .social-login .feide {
    background-color: #0072c6;
    color: white;
}

.login-box .divider {
    margin: 20px 0;
    font-size: 1.2em;
}

.login-box form {
    display: flex;
    flex-direction: column;
}

.login-box form input {
    margin: 10px 0;
    padding: 10px;
    border: none;
    border-radius: 5px;
}

.login-box form button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #206eff;
    color: white;
    cursor: pointer;
    
}
button a{
    text-decoration: none;
    color: white;
}
.style a{
    text-decoration: none;
    color: white;
}
.login-box .forgot-password {
    margin-top: 10px;
    display: block;
    color: #ffffff;
    text-decoration: none;
}

.login-box .forgot-password:hover {
    text-decoration: underline;
}
ul, li{
    list-style-type:none; 
    margin: 0;
    text-align: left;
    padding: 0;
  
}
</style>
<body>
    <div class="container">
        <div class="right-section">
            <div class="login-box">
                <h2>Login</h2>
                <p>Belum Punya Akun? <a href="registrasi.php " style="color: white; text-decoration: none;">REGISTRASI</a></p>
                <div class="social-login">
                    <button class="google">Google</button>
                    <button class="facebook">Facebook</button>
                    
                </div>
                <div class="divider">OR</div>
                <?php 
                    if (isset($error)) :?> 
                        <p style="font-style: italic; color:red; ">Username/Password Salah</p>
                    <?php endif?>
                <form action="" method="post">
                    <label for="username"></label>
                    <input type="text" placeholder="Username" name="username" id="username" required>

                    <label for="password"></label>
                    <input type="password" placeholder="Password" name="password" id="password" required>
                    <ul>
                        <li><label for="remember" style="text-align: left;">Ingat Saya</label></li>
                        <li><input type="checkbox" name="remember" id="remember" ></li>
                    </ul>
                    
                    <button type="submit" name="login">Login</button>
                   
                </form>
                <a href="" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </div>

</body>
</html>