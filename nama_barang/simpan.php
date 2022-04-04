<?php
include '../main/koneksi.php';
//menyimpan hasil inputan kedalam variabel
$nm_barang        = $_POST['nm_barang'];
$merek            = $_POST['merek'];
$jenis            = $_POST['jenis'];

$gambar           = $_FILES['gambar']['name'];
$tmp              = $_FILES['gambar']['tmp_name'];

//rename nama gambar dengan menambahkan tanggal dan jam upload
$gambarbaru = date('dmYHis').$gambar;
//Set path folder tempat menyimpan fotonya
$path ="images/".$gambarbaru;
//proses upload
if(move_uploaded_file($tmp, $path)){
    //perintah sql untuk inser data
    $sql = "insert into nama_barang SET nm_barang='$nm_barang',merek='$merek'
            ,jenis='$jenis',gambar='$gambarbaru'";
$insert= mysqli_query($konek, $sql);
if($insert){//cek jika proses simpan ke database sukses atau tidak
    //jika sukses, lakukan :
     echo "<script>alert('Data telah disimpan');window.location='index.php'</script>";   
}
else
{
    // jika gagal, Lakukan:
    echo "Maaf, terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='index.php'>kembali ke form</a>";
}

}
else{
    //jika gambar gagal di upload lakukan:
    echo "Maaf gambar gagal untuk diupload.";
    echo "<br><a href='simpan.php'>kembali ke form</a>";
}
?>

