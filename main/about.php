<?php
session_start();
include '../main/koneksi.php';
 if(empty($_SESSION['status_login'])){
    header("location:../index.php");
      }
    else if($_SESSION['level']=="admin"){
        include 'header.php';
	}
    else if($_SESSION['level']=="kepala lab"){
		include 'header2.php';
	}
?>
 <script src="../bootstrap/js/chart.js"></script>
	<style type="text/css">
		body{
			font-family: roboto;
		}
	</style>
<?php

?>

<h2 align="center" ><i class="fas fa-lightbulb"></i> <b>About</b></h2>

<p align="justify">Sistem informasi aset yang telah dibuat ini membantu dalam proses pengelolaan aset yang ada di labkom Universirtas Garut;

Sistem pengelolaan aset ini membantu dalam pembuatan laporan setelah admin melakukan pengelolaan data barang, pengelolaan inventaris barang, pengelolaan lokasi barang.</p>

<center>
<h3><b>Rima Ardianti</b></h3>
<h3><b>1706110</b></h3>
</center>

<?php
include 'footer.php';
?>