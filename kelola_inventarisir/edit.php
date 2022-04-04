<?php
session_start();
include '../main/koneksi.php';
if(empty($_SESSION['status_login'])){
    header("location:../index.php");
      }
else if($_SESSION['level']=="admin"){
            include '../main/header.php';
  }

  $id_inventaris  =$_GET['id_inventaris'];
  $data = mysqli_query($konek,"select * from inventaris where id_inventaris='$id_inventaris'");
  $row = mysqli_fetch_array($data);
 $barang=  $row['id_barang'];
 $lokasi=  $row['id_lokasi'];
 ?>   

   <h3>Edit Data</h3>
      
   <form action="update.php" method="POST" enctype="multipart/form-data">
       <input type="text" value="<?php echo $row['id_inventaris']?>" name="id_inventaris" placeholder="Masukkan id_inventaris" class="form-control" hidden="">
           <div class="form-group row">  
               <label class="col-sm-2 col-form-label">id inventaris</label>
               <div class="col-sm-5">
                   <input type="text" value="<?php echo $row['id_inventaris']?>" name="id_inventaris" placeholder="Masukkan id inventaris" class="form-control" disabled="">
               </div>
           </div>
      
        <div class="form-group">  
          <?php
              $hasil = mysqli_query($konek,"SELECT * FROM nama_barang where id_barang='$barang'");
          ?>
          <?php foreach( $hasil as $rk ): ?>
            <label>Nama Barang <b><?php echo $rk['nm_barang'] ?> (<?php echo $rk['merek'] ?>)</b> Menjadi</label>  
          <?php endforeach; ?>  
          <select class="form-select" name="id_barang">
      <!-- Untuk menampilkan data kelas -->
          <?php
              $hl = mysqli_query($konek,"SELECT * FROM nama_barang ");
          ?>
          <?php foreach( $hl as $r ): ?>
            <option value="<?php echo $r['id_barang'];?>"> <?php echo $r['nm_barang'] ?> (<?php echo $r['merek'] ?>) </option>
          <?php endforeach; ?>  
      <!-- End menampilkan data kelas -->    
          </select>
        </div>

        <div class="form-group">
          <label>Tanggal Pengadaan awal : <b> <?php echo $row['tgl_pengadaan'] ?> </b> menjadi :</label>
          <input type="date" name="tgl_pengadaan"  class="form-control">
        </div>

        <div class="form-group">
          <label>Kode QR barang</label>
          <input type="text" name="qr_baru" value="<?php echo $row['qr']?>" class="form-control">
        </div>

        <div class="form-group">
          <label>Kondisi <b> <?php echo $row['kondisi']?></b> menjadi : </label>
          <select class="form-select" name="kondisi">
            <option value="Baru">Baru</option>
            <option value="Bekas">Bekas</option>
          </select>
        </div>

        <div class="form-group">
        <?php
              $hasil2 = mysqli_query($konek,"SELECT * FROM nama_lokasi where id_lokasi='$lokasi'");
          ?>
          <?php foreach( $hasil2 as $rc ): ?>
            <label>Lokasi <b><?php echo $rc['nm_lokasi'] ?></b> Menjadi</label>  
          <?php endforeach; ?>  
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
       
            <div class="form-group row">  
                <label class="col-sm-2 col-form-label"></label>
               <div class="col-sm-5">
                   <button type="submit" class="btn btn-danger">Simpan</button>
                   <a href="index.php" class="btn btn-success">Batal</a>
               </div>
           </div>
       </form>
   </div>

<?php
include '../main/footer.php';
?>
   