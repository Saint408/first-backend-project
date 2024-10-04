<?php
sleep(1);
require '../functions.php';
$keyword = $_GET["keyword"];


$query ="SELECT * FROM mahasiswa 
        WHERE 

        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' 
      
        
        ";
$mahasiswa = query($query);


?>
 <table>
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