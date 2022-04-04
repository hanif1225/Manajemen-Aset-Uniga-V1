<?php
$id_lokasi =$_GET['id_lokasi'];

include '../main/koneksi.php';
$delete = mysqli_query($konek,"delete from nama_lokasi where id_lokasi='$id_lokasi'");   

echo "<script>alert('Data Lokasi berhasil dihapus');window.location='index.php'</script>";
?> 
 