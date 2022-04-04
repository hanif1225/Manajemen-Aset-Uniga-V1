<?php
session_start();
include '../main/koneksi.php';
include "../phpqrcode-master/qrlib.php";
if(empty($_SESSION['status_login'])){
    header("location:../index.php");
      }
 else if($_SESSION['level']=="admin"){
            include '../index.php';
  }
  else if($_SESSION['level']=="kepala lab"){
    include '../main/header2.php';
}
  
  $tempdir = "temp/"; 
  if (!file_exists($tempdir))
      mkdir($tempdir);
 ?>   

<h2 align="center" style="color:#1E90FF"><i class="fas fa-boxes"></i> <b>Data inventarisir</b></h2>


<form action="#" method="POST" >
<table>
  <tr>
  <td>
  <label for="">Kondisi</label>
  <select class="form-select"  name="keadaan" >

  <option value="Rusak">Rusak</option>
  <option value="Diperbaiki">Diperbaiki</option>
  <option value="Digunakan">Digunakan</option>
  <option value="Bekas">Bekas</option>
  <option value="Baru">Baru</option>
</select>
</td>
<td>
<button type="submit" class="btn btn-sm btn-success ml-2" name="export"><i class="fas fa-file-export"></i> Export</button>
</td>

</tr>
</table>
</form>

<!-- Search -->
<form method="post" enctype="multipart/form-data" class="form-inline" id="pencarian_id"  action="<?php echo $_SERVER['PHP_SELF']?> ">
  <div class="form-group mx-sm-1 mb-1">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="text" class="form-control" name="keyword"  placeholder="Masukkan Nama Barang">
  </div>
  <button name="pencarian" type="submit" class="btn btn-success btn-sm"><b>Cari Data</b></button>
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
                    <th scope="col">Lokasi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $halaman = 10;
                $page=isset($_GET['halaman'])?(int)$_GET['halaman']:1;
                $mulai = ($page>1)?($page*$halaman)-$halaman:0;
                $result=mysqli_query($konek,"SELECT * FROM inventaris");
                $total= mysqli_num_rows($result);
                $pages=ceil($total/$halaman);

            if(isset($_POST['pencarian'])){
                //query pencarian data
                $keyword=$_POST['keyword'];
                $sql = "SELECT * from inventaris INNER JOIN nama_barang on nama_barang.id_barang=inventaris.id_barang
                INNER JOIN nama_lokasi on nama_lokasi.id_lokasi=inventaris.id_lokasi  
                where nm_barang like '%$keyword%' order by nm_barang ASC limit $mulai,$halaman";
            }
            else if(isset($_POST['export'])){
              $keadaan = mysqli_real_escape_string($konek,$_POST['keadaan']);
              echo "<script>window.location='export.php?keadaan=$keadaan'</script>";
            }
            else{
                //query menampilkan data biasa
                $sql = "SELECT * from inventaris INNER JOIN nama_barang on nama_barang.id_barang=inventaris.id_barang
                INNER JOIN nama_lokasi on nama_lokasi.id_lokasi=inventaris.id_lokasi order by id_inventaris ASC limit $mulai,$halaman";
                }
                $isi = mysqli_query($konek, $sql);
                $no=$mulai+1;
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
                    <td><?php echo $row['nm_lokasi']?></td>
                    <td>
                    <a href=<?php echo "'detail.php?id_inventaris=$row[id_inventaris]'" ?>  class='btn btn-success btn-sm'><i class="fas fa-search"></i></a>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </tbody>
    </table>
</div>

<div class="float-right">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <?php
      //untuk previous
          if($page > 1)
          {
          $prev= $page-1;        
      ?>

      <li class="page-item"><a class="page-link" href="index.php?halaman=<?php echo $prev; ?>">Previous</a></li>
    <?php
          }  
    ?>
   <?php for ($i=1; $i<=$pages ; $i++){ ?>
      <li class="page-item active"><a class="page-link" href="?halaman=<?php echo $i;?>"><?php echo $i;?></a></li>
  <?php } ?>
    <?php
    if($page != $pages ){
    $lanjut=$page+1;    
    ?>
      <li class="page-item"><a class="page-link" href="index.php?halaman=<?php echo $lanjut; ?>">Next</a></li>
    <?php
    }
    ?>
    </ul>
    </nav>
</div>         


<!-- MODAL ADD -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Inventarisir</h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="simpan.php" method="post" enctype="multipart/form-data">
 
        <div class="form-group">
          <label>Masukkan Nama Barang</label>
          <select class="form-select" name="id_barang">
      <!-- Untuk menampilkan data kelas -->
          <?php
              $hasil = mysqli_query($konek,"SELECT * FROM nama_barang");
          ?>
          <?php foreach( $hasil as $row ): ?>
            <option value="<?php echo $row['id_barang'];?>"> <?php echo $row['nm_barang'] ?> (<?php echo $row['merek'] ?>) </option>
          <?php endforeach; ?>  
      <!-- End menampilkan data kelas -->    
          </select>
        </div>

        <div class="form-group">
          <label>Masukkan Tanggal Pengadaan</label>
          <input type="date" name="tgl_pengadaan" class="form-control">
        </div>

        <div class="form-group">
          <label>Masukkan Kode QR barang</label>
          <input type="text" name="qr" class="form-control">
        </div>

        <div class="form-group">
          <label>Kondisi</label>
          <select class="form-select" name="kondisi">
            <option value="Baru">Baru</option>
            <option value="Bekas">Bekas</option>
          </select>
        </div>

        <div class="form-group">
          <label>Lokasi</label>
          <select class="form-select" name="id_lokasi">
      <!-- Untuk menampilkan data kelas -->
          <?php
              $hasil = mysqli_query($konek,"SELECT * FROM nama_lokasi");
          ?>
          <?php foreach( $hasil as $row ): ?>
            <option value="<?php echo $row['id_lokasi'];?>"> <?php echo $row['nm_lokasi'] ?> </option>
          <?php endforeach; ?>  
      <!-- End menampilkan data kelas -->    
          </select>
        </div>

       
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

<?php
include '../main/footer.php';
?>