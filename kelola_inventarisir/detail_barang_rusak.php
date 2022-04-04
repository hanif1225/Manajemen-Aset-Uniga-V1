<?php
session_start();
include '../main/koneksi.php';
include "../phpqrcode-master/qrlib.php";
if(empty($_SESSION['status_login'])){
    header("location:../index.php");
      }
else if($_SESSION['level']=="admin"){
            include '../main/header.php';
  }

  $tempdir = "temp/"; 
  if (!file_exists($tempdir))
      mkdir($tempdir);
      
  $id_inventaris  =$_GET['id_inventaris'];
  $data = mysqli_query($konek,"select * from inventaris INNER JOIN nama_barang on nama_barang.id_barang=inventaris.id_barang
  INNER JOIN nama_lokasi on nama_lokasi.id_lokasi=inventaris.id_lokasi where id_inventaris='$id_inventaris'");
  $row = mysqli_fetch_array($data);

  $teks = $row['qr'];
  //Isi dari QRCode Saat discan
  $isi_teks1 = $teks;
  //Nama file yang akan disimpan pada folder temp 
  $namafile1 = $teks.".png";
  //Kualitas dari QRCode 
  $quality1 = 'H'; 
  //Ukuran besar QRCode
  $ukuran1 = 4; 
  $padding1 = 0; 
  QRCode::png($isi_teks1,$tempdir.$namafile1,$quality1,$ukuran1,$padding1);

 ?>   

<div class="form-group">            
            <center><?php echo "<img src='../nama_barang/images/$row[gambar]' class='img-thumbnail'  width='400px'>"?></center>
            </div>

            <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
                <center><b>Detail Data</b></center>
            </a>

            <table class="table">
            <br>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <td scope="col"><?php echo $row['nm_barang'] ?></td>
                </tr>
                <tr>
                <th scope="col">Merek</th>
                <td scope="col"><?php echo $row['merek'] ?></td>
                </tr>
                <tr>
                <th scope="col">Jenis</th>
                <td scope="col"><?php echo $row['jenis'] ?></td>
                </tr>
                <tr>
                <th scope="col">Lokasi</th>
                <td scope="col"><?php echo $row['nm_lokasi'] ?></td>
                </tr>
                <tr>
                <th scope="col">Kondisi</th>
                <td scope="col"><?php echo $row['kondisi'] ?></td>
                </tr>
                <tr>
                <th scope="col">Tanggal Pengadaan</th>
                <td scope="col"><?php echo $row['tgl_pengadaan'] ?></td>
                </tr>
                <tr>

                <th scope="col">Kode QR</th>
                <td style="padding: 10px;"><img src="temp/<?php echo $namafile1; ?>" width="100px"></td>
                </tr>
    

            </table>
            </div>
            <div class="list-group">




            <a href ="data_rusak.php" class="btn btn-primary"><b>Kembali</b></a>
        
            </div>
   </div>

<?php
include '../main/footer.php';
?>
   