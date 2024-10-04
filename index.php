<?php
session_start();

//cek apakah user sudah masuk halaman melalui login atau belum
//kalau belom maka akan kembali kehalaman login.php
if( !isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ");

// tombol cari di clik 
if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman admin</title>
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
button{
  border: none;
  border-radius: 5px;
}
a{
  text-decoration: none;
  color: black;
  
  

}
.kiri{
  float: right;
  padding-right: 100px;
  padding-top: 40px;
  
}
.tambah{
  background-color: yellow;
  color: white; 
  padding: 0px 10px;
  text-align: center;
  display: inline-block;
  font-size: 15px;
  

}
.kiri1{
  border: none;
  background-color: red;
  text-decoration: none;
  text-align: center;
  padding: 10px 20px;
  display: inline-block;
  float: right;
  margin-top: 40px;
  margin-right: 20px;

  
}
.loader{
  width: 40px;
  position:absolute;
  top: 154px;
  margin-left: 10px;
  display: none;
}
td, th {
  border: 1px solid #04AA6D;
  
  text-align: center;
  padding: 8px;
}
th{
  background-color: #04AA6D;
  color: white;
}
tr:nth-child(even){background-color: #f2f2f2;
}
tr:hover {background-color: #ddd;}
h1{
  text-align: center;
}
@media print{
  
}
</style>
<body>

    <h1>Daftar Mahasiswa</h1>
   <br><br>
<button class="tambah"><a href="tambah.php"><p>Tambah Mahasiswa</p></a></button>
<button type="button" class="kiri1"><a href="cetak.php" style="color: white;" target="_blank" >Cetak</a></button>

<form action="" method="post" class="kiri">
      <input type="text"  name="keyword" value="" size="50" autofocus placeholder="Cari mahasiswa" autocomplete="off" style="height: 30px; border:none; border-bottom: 1px solid; " id="keyword">
      <button type="submit" name="cari" style="background-color: green;color: white; padding: 10px 20px;text-align: center;display: inline-block;font-size: 15px;" id="tombol-cari">Cari</button>   
      <img src="img/loader.webp" alt="" srcset="" class="loader">
      
    </form>


<br><br>

<br>
<div id="container">
    <table >
  <tr>
    <th>No.</th>
    <th>Gambar</th>
    <th>NIM</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Jurusan</th>
    <th>Aksi</th>
  </tr>
  <?php $i = 1 ;?>
  <?php foreach($mahasiswa as $row) :?>
  
  <tr>
    <td><?= $i;?></td>
     
      <td><img src="img/<?= $row["gambar"]?>" alt="" srcset="" style="width: 60px; height= 60px; border-radius: 20%;"></td>
      <td><?= $row["nim"]?></td>
      <td><?= $row["nama"]?></td>
      <td><?= $row["email"]?></td>
      <td><?= $row["jurusan"]?></td> 
      <td>
          <button style="background-color: yellow ;color: white; padding: 10px 20px;text-align: center;display: inline-block;font-size: 15px;"><a href="ubah.php?id=<?= $row['id']?>">Ubah</a></button>
          <button  style="background-color: red;color: white; padding: 10px 20px;text-align: center;display: inline-block;font-size: 15px;"><a href="hapus.php?id=<?= $row['id']?>" onclick="return confirm('yakin');//fungsi  onclick= untuk menkonfirm apakah mau mengghapus data" style="color: #f2f2f2;">Hapus</a></button>
      </td>
  </tr>
  <?php $i++?>
  <?php endforeach?>
</table>
</div>
<a href="logout.php">Keluar</a>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/script.js"></script>


</script>
</body>
</html>