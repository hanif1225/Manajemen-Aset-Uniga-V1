<?php
// Load file koneksi.php
include "../main/koneksi.php";

// Ambil data NIS yang dikirim oleh info_kajian.php melalui URL
$id_barang = $_GET['id_barang'];

// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
$query = "SELECT * FROM nama_barang WHERE id_barang='".$id_barang."'";
$sql = mysqli_query($konek, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql

// Cek apakah file fotonya ada di folder images
if(is_file("images/".$row['gambar'])) // Jika foto ada
	unlink("images/".$row['gambar']); // Hapus foto yang telah diupload dari folder images

// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query2 = "DELETE FROM nama_barang WHERE id_barang='".$id_barang."'";
$sql2 = mysqli_query($konek, $query2); // Eksekusi/Jalankan query dari variabel $query

if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	header("location: index.php"); // Redirect ke halaman index.php
}else{
	// Jika Gagal, Lakukan :
	echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
?>
