<?php

require 'functions.php';

if(isset($_POST["register"])){
    if(Registrasi($_POST) > 0){
        echo "
        <script>
            alert('Registrasi barhasil!');
        </script>
        ";
    }else{
        echo mysqli_error($conn);
    }
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

.left-section h1 {
    font-family: "Roboto Slab", serif;
    font-optical-sizing: auto;
    font-weight: weight;
    font-style: normal;
    margin: 0;
    font-size: 2em;
}

.left-section .heart {
    color: #00FF00;
}

.left-section p {
    margin-top: 10px;
    font-size: 1.2em;
}

.left-section ul {
    font-family: "Nunito", sans-serif;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: italic;
    list-style: none;
    padding: 10;
    margin-top: 20px;
}

.left-section ul li {
    margin: 10px 0;
    display: flex;
    align-items: center;
}

.left-section ul li::before {
    margin-right: 10px;
}

.left-section img {
    margin-top: 20px;
    width: 100px;
    height: auto;
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

</style>
<body>
    <div class="container">
        <div class="right-section">
            <div class="login-box">
                <h2>Registrasi</h2>
                <p>Sudah Punya Akun? <a href="login.php" style="color:white; text-decoration: none;" >LOGIN</a></p>
                <div class="social-login">
                    <button class="google">Google</button>
                    <button class="facebook">Facebook</button>
                    
                </div>
                <div class="divider">OR</div>

                <form action="" method="post">
                    <label for="username"></label>
                    <input type="text" placeholder="Username" name="username" id="username" required>

                    <label for="password"></label>
                    <input type="password" placeholder="Password" name="password" id="password" required>

                    <label for="password2"></label>
                    <input type="password" placeholder="Konfirmasi Password" name="password2" id="password2" required>

                    <button type="submit" name="register">Registrasi</button>
                   
                </form>
                <a href="" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </div>

</body>
</html>