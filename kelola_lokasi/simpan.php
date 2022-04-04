<?php
include '../main/koneksi.php';
//menyimpan hasil inputan kedalam variabel
$nm_lokasi           = $_POST['nm_lokasi'];



//perintah sql untu insert data
    $sql = "insert into nama_lokasi set nm_lokasi='$nm_lokasi'"; 
    // perintah untuk mengeksekusi query di atas    
    $insert =mysqli_query($konek,$sql);
    echo "<script>alert('Data telah disimpan');window.location='index.php'</script>";

 ?> 