<?php
//menyimpan hasil inputan kedalam variabel


$id_inventaris =$_POST['id_inventaris'];
$id_barang =$_POST['id_barang'];
$id_lokasi =$_POST['id_lokasi'];
$tgl_pengadaan =$_POST['tgl_pengadaan'];
$qr_baru =$_POST['qr_baru'];
$kondisi =$_POST['kondisi'];

include '../main/koneksi.php';
//delete code qr lama

$query = "SELECT * FROM inventaris WHERE id_inventaris='".$id_inventaris."'";
$sql2 = mysqli_query($konek, $query); // Eksekusi/Jalankan query dari variabel $query
$r = mysqli_fetch_array($sql2); // Ambil data dari hasil eksekusi $sql

unlink("temp/".$r['qr'].".png");

//update
$sql = "update inventaris set id_barang='$id_barang',id_lokasi='$id_lokasi', 
tgl_pengadaan='$tgl_pengadaan',qr='$qr_baru',kondisi='$kondisi' where id_inventaris='$id_inventaris'"; 


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

echo "<script>alert('Data telah di Update');window.location='index.php'</script>";
 ?> 