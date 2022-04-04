<?php
// Load file koneksi.php
include "../main/koneksi.php";



//Mengambil id
$id_inventaris = $_GET['id_inventaris'];


$query = "SELECT * FROM inventaris WHERE id_inventaris='".$id_inventaris."'";
$sql = mysqli_query($konek, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql

unlink("temp/".$row['qr'].".png");



$query2 = "DELETE FROM inventaris WHERE id_inventaris='".$id_inventaris."'";
$sql2 = mysqli_query($konek, $query2); 

if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	echo "<script>alert('Data Inventaris berhasil dihapus');window.location='index.php'</script>";
}else{
	// Jika Gagal, Lakukan :
	echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
?>
