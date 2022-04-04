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
  

 ?>   

<h2 align="center" style="color:#1E90FF"><i class="fas fa-boxes"></i> <b>Data Lokasi</b></h2>



<!-- Search -->


<div class="table-responsive">
    <table class="table table-success table-striped">
        <br>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Jumlah Data</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $halaman = 10;
                $page=isset($_GET['halaman'])?(int)$_GET['halaman']:1;
                $mulai = ($page>1)?($page*$halaman)-$halaman:0;
                $result=mysqli_query($konek,"SELECT * FROM nama_lokasi");
                $total= mysqli_num_rows($result);
                $pages=ceil($total/$halaman);



            if(isset($_POST['pencarian'])){
                //query pencarian data
                $keyword=$_POST['keyword'];
                $sql = "SELECT * from nama_lokasi where nm_lokasi like '%$keyword%' order by nm_lokasi ASC limit $mulai,$halaman";
            }
            else{
                //query menampilkan data biasa
                $sql = "SELECT * from nama_lokasi order by id_lokasi ASC limit $mulai,$halaman";
                }
                $isi = mysqli_query($konek, $sql);
                $no=$mulai+1;
                while ($row = mysqli_fetch_array($isi)){

            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['nm_lokasi'] ?></td>
                    <?php $id_lokasi= $row['id_lokasi'] ?>
                    <?php
                    $sql = mysqli_query($konek,"SELECT * FROM inventaris where id_lokasi='$id_lokasi'");
                    $jumlah = mysqli_num_rows($sql);
                    ?>

                    <td><?php echo $jumlah?></td>
                    <td>
                    <a href=<?php echo "'detail.php?id_lokasi=$row[id_lokasi]&nm_lokasi=$row[nm_lokasi]'" ?>  class='btn btn-success btn-sm'><i class="fas fa-search"></i></a>
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

      <li class="page-item"><a class="page-link" href="lokasi_barang.php?halaman=<?php echo $prev; ?>">Previous</a></li>
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
      <li class="page-item"><a class="page-link" href="lokasi_barang.php?halaman=<?php echo $lanjut; ?>">Next</a></li>
    <?php
    }
    ?>
    </ul>
    </nav>
</div>         

<?php
include '../main/footer.php';
?>