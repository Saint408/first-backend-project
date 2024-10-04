<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ");


$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<body>
<table border="1" style="width:100%" >
<h1>Daftar Mahasiswa</h1>
<tr>
  <th>No.</th>
  <th>Gambar</th>
  <th>NIM</th>
  <th>Nama</th>
  <th>Email</th>
  <th>Jurusan</th>
</tr>';
$i = 1;
foreach($mahasiswa as $row){
    $html .='<tr>
    <td>'. $i++ .'</td>
    <td><img src="img/'. $row["gambar"] .'" width="60px" height="60px"></td>
    <td>'. $row["nim"] .'</td>
    <td>'. $row["nama"] .'</td>
    <td>'. $row["email"] .'</td>
    <td>'. $row["jurusan"] .'</td>

    </tr>';
}

$html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);
?>