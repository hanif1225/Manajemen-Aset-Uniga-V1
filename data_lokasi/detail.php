<?php
session_start();
include '../main/koneksi.php';
include "../phpqrcode-master/qrlib.php";

$id_lokasi  =$_GET['id_lokasi'];
$nm_lokasi  =$_GET['nm_lokasi'];
if(empty($_SESSION['status_login'])){
    header("location:../index.php");
      }
else if($_SESSION['level']=="kepala lab"){
            include '../main/header2.php';
  }
else if($_SESSION['level']=="admin"){
            include '../index.php';
  }
  
  $tempdir = "../kelola_inventarisir/temp/"; 
  if (!file_exists($tempdir))
      mkdir($tempdir);

 ?>   

<h2 align="center" style="color:#1E90FF"><i class="fas fa-boxes"></i> <b>Data Lokasi <?php echo $nm_lokasi ?></b></h2>


<form action="#" method="POST" >
<table>
  <tr>
<td>
<button type="submit" class="btn btn-sm btn-success ml-2" name="export_lokasi"><i class="fas fa-file-export"></i> Export</button>
</td>
</tr>
</table>
</form>

<div class="table-responsive">
    <table class="table table-success table-striped">
        <br>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Merek</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Tanggal Pengadaan</th>
                    <th scope="col">Tanggal Rusak</th>
                    <th scope="col">Tanggal Diperbaiki</th>
                    <th scope="col">QR Code</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['export_lokasi'])){
              echo "<script>window.location='export.php?nm_lokasi=$nm_lokasi'</script>";
            }
            else{
                //query menampilkan data biasa
                $sql = "SELECT * from inventaris INNER JOIN nama_barang on nama_barang.id_barang=inventaris.id_barang
                INNER JOIN nama_lokasi on nama_lokasi.id_lokasi=inventaris.id_lokasi where  nm_lokasi='$nm_lokasi'";
                }
                $isi = mysqli_query($konek, $sql);
                $no=1;
                while ($row = mysqli_fetch_array($isi)){
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
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nm_barang'] ?></td>
                    <td><?php echo $row['merek']?></td>
                    <?php echo " <td><img src='../nama_barang/images/$row[gambar]' width='100' height='100'> </td>" ?>
                    <td><?php echo $row['kondisi']?></td>
                    <td><?php echo $row['tgl_pengadaan']?></td>
                    <td><?php echo $row['tgl_rusak']?></td>
                    <td><?php echo $row['tgl_diperbaiki']?></td>
                    <td style="padding: 10px;"><img src="../kelola_inventarisir/temp/<?php echo $namafile1; ?>" width="100px"></td>
                </tr>

                <?php
                    }
                ?>
            </tbody>
    </table>
    <a href="index.php" class="btn btn-success">Kembali</a>
</div>


<?php
include '../main/footer.php';
?>