<?php
//menyimpan hasil inputan kedalam variabel
$id_barang       = $_POST['id_barang'];
$id_lokasi       = $_POST['id_lokasi'];
$qr              = $_POST['qr'];
$kondisi         = $_POST['kondisi'];
$tgl_pengadaan   = $_POST['tgl_pengadaan'];

include '../main/koneksi.php';
//perintah sql untu insert data
$sql = "insert into inventaris set id_barang='$id_barang',id_lokasi='$id_lokasi',
qr='$qr',kondisi='$kondisi',tgl_pengadaan='$tgl_pengadaan'"; 
// perintah untuk mengeksekusi query di atas    
$insert =mysqli_query($konek,$sql);
/*
if($insert)
    echo "isert data berhasil";
}
 else {
echo "insert data gagal";    
}
*/
echo "<script>alert('Data telah disimpan');window.location='index.php'</script>";

 ?> 