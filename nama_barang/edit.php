<?php
session_start();
include '../main/koneksi.php';
if(empty($_SESSION['status_login']))
{
    header("location:../index.php");
}
else if($_SESSION['level']=="admin")
{
    include '../main/header.php';
}
$id_barang =$_GET['id_barang'];
$data = mysqli_query($konek,"select * from nama_barang where id_barang='$id_barang'");
$row = mysqli_fetch_array($data);

?>

   <h3>Edit Data</h3>
      
   <form action="update.php" method="POST" enctype="multipart/form-data">
       <input type="text" value="<?php echo $row['id_barang']?>" name="id_barang" placeholder="Masukkan ID" class="form-control" hidden="">
           <div class="form-group row">  
               <label class="col-sm-2 col-form-label">ID</label>
               <div class="col-sm-5">
                   <input type="text" value="<?php echo $row['id_barang']?>" name="id_barang" placeholder="Masukkan ID" class="form-control" disabled="">
               </div>
           </div>
      
           <div class="form-group row">  
               <label class="col-sm-2 col-form-label">Nama Barang</label>
               <div class="col-sm-5">
                   <input type="text" value="<?php echo $row['nm_barang']?>" required="" name="nm_barang" placeholder="Masukkan Nama Guru" class="form-control">
               </div>
           </div>

           <div class="form-group row">  
               <label class="col-sm-2 col-form-label">Merek</label>
               <div class="col-sm-5">
                   <input type="text" name="merek" value="<?php echo $row['merek'] ?>" required="" placeholder="Masukkan Merek" class="form-control">
               </div>
           </div>
      
          
           <div class="form-group">
          <label>Jenis<b><?php echo $row['jenis'] ?></b> menjadi</label>
          <select class="form-select" name="jenis">
          <option value="Furniture">Furniture</option>
            <option value="Hardware">Hardware</option>
            <option value="Equipment">Equipment</option>
          </select>
        </div>
           
         
           <div class="form-group row">
        <label class="col-sm-2 col-form-label">Gambar</label>
        <div class="col-sm-5"> 
            <input type="checkbox" name="ubah_gambar" value="true"> Ceklis jika ingin mengubah Gambar<br>
            <input type="file" name="gambar" class="form-control">
            </div>
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
   