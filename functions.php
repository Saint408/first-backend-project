<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdasar";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";
// 


//ambil data dari tabel mahasiswa

// $result = mysqli_query($conn, "SELECT * FROM mahasiswa" );

//ambil data mahasiswa dari object result
// mysqli_fetch_row() // mengembalikan array numerik
// mysqli_fetch_assoc() // mengembalikan array associatif
// mysqli_fetch_array() // bisa mengambalikan array secara numerik dan associatif
// mysqli_fetch_object() //

// while($mhs = mysqli_fetch_assoc($result)){

// var_dump($mhs);
// }

//function untuk query yang ada, untuk menampung array pada index.php
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

//function untuk menambahkan barang
function tambah($data){
    global $conn;
        //ambil semua data pada semua form
       $nim = htmlspecialchars($data["nim"]);
       $nama = htmlspecialchars($data["nama"]);
       $email = htmlspecialchars($data["email"]);
       $jurusan = htmlspecialchars($data["jurusan"]);

      //upload gambar
      $gambar = upload();
      if(!$gambar){
      return false;
      }
        //query insert data
       $query = "INSERT INTO mahasiswa VALUES 
   
   ('','$nama','$nim','$email','$jurusan','$gambar')";
   mysqli_query($conn, $query);


   return mysqli_affected_rows($conn);
}

//function untuk upload gambar
function upload(){
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   //cek apakah tidak ada gambar yang diupload
   if($error === 4){
    echo "
    <script>
        alert('pilih ganbar terlebih dahulu!');
    </script>
    ";
    return false;
   }

   //mengecek apakah user mengupload gambar atau tidak
   $ekstensiGambarvalid = ['jpeg','jpg','png','gif','webp'];
   $ekstensiGambar = explode('.',$namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar)) ;
   if(!in_array($ekstensiGambar, $ekstensiGambarvalid)){
    echo "
    <script>
        alert('yang ada upload bukan gambar!');
    </script>
    ";
    return false;
   }
   //cek ukuran file
   if ($ukuranFile > 1500000){
   echo "
    <script>
        alert('ukuran gambar terlalu besar !');
    </script>
    ";
    return false;
}

//membuat/ganerite nama baru
$namaFileBaru = uniqid();
$namaFileBaru .='.';
$namaFileBaru .= $ekstensiGambar;

// semua lolos,gambar siap di upload
move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
return $namaFileBaru;
}

//function untuk menghapus barang
function hapus($id){
    global $conn;
    $result = mysqli_query($conn, "SELECT gambar FROM mahasiswa WHERE id = $id");
	$file = mysqli_fetch_assoc($result);

	$fileName = implode('.', $file);
	$location = "img/$fileName";
	if (file_exists($location)) {
		unlink('img/' . $fileName);
	}

	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}
    
//function untuk mengubah barang
function ubah($data){

    global $conn;
        //ambil semua data pada semua form
       $id = ($data["id"]); 
       $nim = htmlspecialchars($data["nim"]);
       $nama = htmlspecialchars($data["nama"]);
       $email = htmlspecialchars($data["email"]);
       $jurusan = htmlspecialchars($data["jurusan"]);
       $gambarLama = htmlspecialchars($data["gambarLama"]);
       //cek apakah user pili gambar baru atau tidak

       if($_FILES['gambar']['error'] === 4){

            $gambar = $gambarLama;

        }else{
        $result = mysqli_query($conn, "SELECT gambar FROM mahasiswa WHERE id = $id");
		$file = mysqli_fetch_assoc($result);

		$fileName = implode('.', $file);
		unlink('img/' . $fileName);

            $gambar = upload();
        }
        //query insert data
       $query = "UPDATE mahasiswa SET
       nim = '$nim',
       nama = '$nama',
       email = '$email',
       jurusan = '$jurusan',
       gambar = '$gambar'

            WHERE id = $id;
        ";//where id = $id berfungsi untuk identifayer
   mysqli_query($conn, $query);


   return mysqli_affected_rows($conn);

}

//function untuk mencari barang
function cari($keyword){
    
        $query = "SELECT * FROM mahasiswa 
        WHERE 

        nama LIKE '%$keyword%' OR
        nim LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' 
      
        
        ";
        return query($query);
}
//funchion untuk registrasi
function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username ada atau tidal

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "
    <script>
        alert('Username Sudah Terdaftar!');
    </script>
    ";
    return false;
    }


//CEK KONFIRMASI PASSWORD
if ($password !== $password2){
    echo "
    <script>
        alert('konfirmasi password tidak sesuai!');
    </script>
    ";
    return false;
}
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
        
    //tambahkan user baru di data base
    mysqli_query($conn, "INSERT INTO user VALUE('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

















?>

