<?php
include '../main/koneksi.php';
//menyimpan hasil inputan kedalam variabel
$id_barang                    =$_POST['id_barang'];
$nm_barang                    =$_POST['nm_barang'];
$merek                        =$_POST['merek'];
$jenis                        =$_POST['jenis'];


//cek apakah ingin mengubah gambarnya atau tidak
if(isset($_POST['ubah_gambar'])){ // Jika user menceklis checkbox yang ada di form ubah,lakukan:
    //ambil data gambar yang dipilih dari form
    $gambar=$_FILES['gambar']['name'];
    $tmp=$_FILES['gambar']['tmp_name'];
    //rename nama gambar dengan menambahkan tanggal dan jam upload
    $gambarbaru=date('dmYHis').$gambar;
    //set path folder tempat menyimpan fotonya
    $path="images/".$gambarbaru;
    //proses upload
        if(move_uploaded_file($tmp, $path))
        {//cek apakah gambar berhasil upload atau tidak
        //query untuk menampilkan data berdasarkan kd_kajian
        $data = mysqli_query($konek,"select * from nama_barang where id_barang='$id_barang'");
        $row = mysqli_fetch_array($data);
        
            //cek apakah file gambar sebelumnya ada di folder images
            if(is_file("images/".$row['gambar'])) //jika gambar ada
                unlink("images/".$row['gambar']); //Hapus file foto sebelumnya yang ada di folder images
            //proses ubah data ke database
            $sql="update nama_barang SET nm_barang='$nm_barang',merek='$merek',
            jenis='$jenis',gambar='$gambarbaru' where id_barang='$id_barang'";
            //perintah untuk mengeksekusi query di atas
            $update= mysqli_query($konek,$sql);
                if($update)
                {// cek jika proses simpan ke database sukses atau tidak
                    //jika sukses, lakukan:
                    echo "<script>alert('Data telah di Update');window.location='index.php'</script>";
                
                }
                else
                {
                    //jika gagal, lakukan:
                    echo "<script>alert('Maaf terjadi kesalahan saat mengupdate');window.location='edit.php'</script>";
                }    
        }
        else
        {
            //jika gambar gagal diupload, Lakukan:
        echo "<script>alert('Maaf gambar gagal untuk diupload');window.location='edit.php'</script>";
        }
}
else
{ 
    $sql="update nama_barang SET nm_barang='$nm_barang',merek='$merek',
    jenis='$jenis' where id_barang='$id_barang'";
   //perintah untuk mengeksekusi query di atas
    $update =mysqli_query($konek,$sql);
        if($update)
        { // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
                echo "<script>alert('Data telah di Update');window.location='index.php'</script>";
        }
        else
        {
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br><a href='edit.php'>Kembali Ke Form</a>";
	    }
        }

?>