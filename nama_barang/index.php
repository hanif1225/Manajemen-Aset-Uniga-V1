<?php
session_start();
include '../main/koneksi.php';
if(empty($_SESSION['status_login'])){
    header("location:../index.php");
      }
else if($_SESSION['level']=="admin"){
            include '../main/header.php';
	}


 ?>   

<h2 align="center" style="color:#1E90FF"><i class="fas fa-boxes"></i> <b>Data Barang</b></h2>
<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah Barang</a>
<!-- Search -->
<form method="post" enctype="multipart/form-data" class="form-inline" id="pencarian_id"  action="<?php echo $_SERVER['PHP_SELF']?> ">
  <div class="form-group mx-sm-1 mb-1">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="text" class="form-control" name="keyword"  placeholder="Masukkan Nama Barang">
  </div>
  <button name="pencarian" type="submit" class="btn btn-primary mb-2">Cari Data</button>
</form>

<div class="table-responsive">
    <table class="table">
        <br>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Merek</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $halaman = 10;
                $page=isset($_GET['halaman'])?(int)$_GET['halaman']:1;
                $mulai = ($page>1)?($page*$halaman)-$halaman:0;
                $result=mysqli_query($konek,"SELECT * FROM nama_barang");
                $total= mysqli_num_rows($result);
                $pages=ceil($total/$halaman);
            if(isset($_POST['pencarian'])){
                //query pencarian data
                $keyword=$_POST['keyword'];
                $sql = "SELECT * from nama_barang  where nm_barang like '%$keyword%' order by nm_barang ASC limit $mulai,$halaman";
            }else{
                //query menampilkan data biasa
                $sql = "SELECT * from nama_barang order by id_barang ASC limit $mulai,$halaman";
                }
                $isi = mysqli_query($konek, $sql);
                $no=$mulai+1;
                while ($row = mysqli_fetch_array($isi)){
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nm_barang'] ?></td>
                    <td><?php echo $row['merek']?></td>
                    <td><?php echo $row['jenis']?></td>
                    <?php echo " <td><img src='images/$row[gambar]' width='100' height='100'> </td>" ?>
                    <td>
                    
                    <a href=<?php echo "'edit.php?id_barang=$row[id_barang]'" ?>  class='btn btn-warning btn-sm'>
                    <i class='fas fa-edit'></i>
                    </a>

                    <a onclick="return confirm('Apakah data ingin dihapus')"  class='btn btn-danger btn-sm' href=<?php echo "'delete.php?id_barang=$row[id_barang]'"?>  ><i class='fas fa-trash-alt'></i></a>
                    
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
        <button type="button" class="close" id="closeadd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="form" action="simpan.php" method="post" enctype="multipart/form-data">
 
        <div class="form-group">
          <label>Masukkan Nama Barang</label>
          <input type="text" name="nm_barang" class="form-control">
        </div>
        <div class="form-group">
          <label>Masukkan Merek</label>
          <input type="text" name="merek" class="form-control">
        </div>
        <div class="form-group">
          <label>Pilih Jenis</label>
          <select class="form-select" name="jenis">
            <option value="Furniture">Furniture</option>
            <option value="Hardware">Hardware</option>
            <option value="Equipment">Equipment</option>
          </select>
        </div>
      
        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Gambar Barang</label>
        <div class="col-sm-10"> 
            <input type="file" name="gambar" class="form-control" required="">
            </div>
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