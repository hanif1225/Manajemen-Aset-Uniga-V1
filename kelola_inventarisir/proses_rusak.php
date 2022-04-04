<?php
//menyimpan hasil inputan kedalam variabel


$id_inventaris =$_GET['id_inventaris'];
$tgl_rusak= date("Y-m-d");
$kondisi ="Rusak";

include '../main/koneksi.php';
//delete code qr lama


$sql = "update inventaris set kondisi='$kondisi',tgl_rusak='$tgl_rusak'
 where id_inventaris='$id_inventaris'"; 


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

echo "<script>alert('Data telah di Update');window.location='data_rusak.php'</script>";
 ?> 