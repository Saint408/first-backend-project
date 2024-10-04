<?php
session_start();

//cek apakah user sudah masuk halaman melalui login atau belum
//kalau belom maka akan kembali kehalaman login.php
if( !isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}
require 'functions.php';
if (isset ($_POST["submit"])){

   //cek apakah data berhasil ditambahkan atau tidak

   if( tambah ($_POST) > 0){
    echo "
    <script>
        alert('data berhasil ditambahkan!');
        document.location.href ='index.php';
    </script>
    ";
   }else{
   echo "
    <script>
        alert('data gagal ditambahkan!');
        document.location.href ='index.php';
    </script>
   ";
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data Mahasiswa</title>
</head>
<style>
    .countener{
        width: 50%;
        margin: auto;
    }
    input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    h1{
        text-align: center;
    }
    button[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }

    button[type=submit]:hover {
    background-color: #45a049;
    }

    div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    }
</style>
<body>
    
<div class="countener">
  <form action="" method="post" enctype="multipart/form-data">
    <!-- untuk mengapload gambar perlu adanya enctype="multipart/form-data" -->
    <h1>Tambah Mahasiswa</h1>
    <label for="nim">NIM</label>
    <input type="text" id="nim" name="nim" required>

    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" required>

    <label for="email">Email</label>
    <input type="text" id="email" name="email" required>

    <label for="jurusan">Jurusan</label>
    <input type="text" id="jurusan" name="jurusan" required>

    <label for="gambar">Gambar</label>
    <input type="file" id="gambar" name="gambar" >

   <button type="submit" name="submit" >Tambah</button>
  </form>
</div>
</body>
</html>