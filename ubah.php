<?php
require 'functions.php';
session_start();

//cek apakah user sudah masuk halaman melalui login atau belum
//kalau belom maka akan kembali kehalaman login.php
if( !isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

//ambil data url
$id = $_GET["id"];


//query data mahasiswa berdasarkan id

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

//cek apakah tombol submit sudah di tekan atau belom
if (isset ($_POST["submit"])){
   

   //cek apakah data berhasil diubah atau tidak

   if( ubah ($_POST) > 0){
  
    echo "
    <script>
        alert('data berhasil diubah!');
        document.location.href ='index.php';
    </script>
    ";
   }else{
   echo "
    <script>
        alert('data gagal diubah!');
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
    <title>Ubah data Mahasiswa</title>
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
    <h1>Ubah Mahasiswa</h1>

    <input type="hidden" value="<?= $mhs["id"];?>" name="id">
    <input type="hidden" value="<?= $mhs["gambar"];?>" name="gambarLama">
    
    <label for="nim">NIM</label>
    <input type="text" id="nim" name="nim" required value="<?= $mhs["nim"];?>">

    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" required value="<?= $mhs["nama"];?>">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" required value="<?= $mhs["email"];?>">

    <label for="jurusan">Jurusan</label>
    <input type="text" id="nim" name="jurusan" required value="<?= $mhs["jurusan"];?>">

    <label for="gambar">Gambar</label>
    <img src="img/<?= $mhs["gambar"];?>" style="width:100px;height:100px;">
    <input type="file" id="gambar" name="gambar">

   <button type="submit" name="submit" >Ubah</button>
  </form>
</div>
</body>
</html>