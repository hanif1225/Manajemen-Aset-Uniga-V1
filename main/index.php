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
		header("location:../index.php");
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

<h2 align="center" ><i class="fas fa-book"></i> <b>Menu Utama</b></h2>

<!-- div row -->
<center>
<table>
    <tr>
    <th>
  <div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>


  <script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Rusak", "Diperbaiki", "Digunakan", "Baru", "Bekas", "Selesai Diperbaiki"],
				datasets: [{
					label: 'Data Inventarisir',
					data: [
        <?php 
				$jumlah_rusak = mysqli_query($konek,"select * from inventaris where kondisi='Rusak'");
				echo mysqli_num_rows($jumlah_rusak);
				?>, 
				<?php 
				$jumlah_diperbaiki = mysqli_query($konek,"select * from inventaris where  kondisi='Rusak'");
				echo mysqli_num_rows($jumlah_diperbaiki);
				?>,
        <?php 
				$jumlah_digunakan = mysqli_query($konek,"select * from inventaris where kondisi='Digunakan'");
				echo mysqli_num_rows($jumlah_digunakan);
				?>, 
        <?php 
				$jumlah_baru= mysqli_query($konek,"select * from inventaris where kondisi='Baru'");
				echo mysqli_num_rows($jumlah_baru);
				?>, 
            <?php 
				$jumlah_bekas = mysqli_query($konek,"select * from inventaris where kondisi='Bekas'");
				echo mysqli_num_rows($jumlah_bekas);
				?>, 
            <?php 
				$jumlah_selesai = mysqli_query($konek,"select * from inventaris where kondisi='Selesai Diperbaiki'");
				echo mysqli_num_rows($jumlah_selesai);
				?>,
          
          ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(79, 255, 51, 0.2)',
					'rgba(255, 162, 0, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba( 126, 99, 50 , 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba( 79, 255, 51, 1)',
					'rgba(255, 162, 0, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba( 126, 99, 50 , 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
  </th>
   <tr>
</table>
</center>



<!-- End  -->

<?php
include 'footer.php';
?>