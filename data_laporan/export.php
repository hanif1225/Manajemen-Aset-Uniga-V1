<?php 
include '../main/koneksi.php';
include "../phpqrcode-master/qrlib.php";

$keadaan      = $_GET['keadaan'];

   //library mpdf
//Jika download plugin mpdf tanpa composer (versi lama)
//Jika download plugin mpdf tanpa composer (versi lama)
define('_MPDF_PATH','../mpdf/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4', 11, 'Georgia');

//setting dan nama file pdf
$nama_dokumen='data-pdf';
ob_start();
?>
<h4>Data Barang <?php echo $keadaan ?></h4>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Merek</th>
        <th>Jenis</th>
        <th>Gambar</th>
        <th>Nama Lokasi</th>
        <th>Kondisi</th>
        <th>Tanggal Pengadaan</th>
        <th>Tanggal Rusak</th>
        <th>Tanggal Diperbaiki</th>
        <th>Kode QR</th>
    </tr>
    <?php 
    $hasil = mysqli_query($konek,"SELECT * from inventaris INNER JOIN nama_barang on nama_barang.id_barang=inventaris.id_barang
    INNER JOIN nama_lokasi on nama_lokasi.id_lokasi=inventaris.id_lokasi WHERE kondisi='$keadaan'");
    $no = 1;
    ?>
    <?php foreach($hasil as $d): ?>
        <?php
        $teks = $d['qr'];
        $namafile = $teks.".png";
        ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nm_barang']; ?></td>
        <td><?php echo $d['merek']; ?></td>
        <td><?php echo $d['jenis']; ?></td>
        <?php echo " <td><img src='../nama_barang/images/$d[gambar]' width='100' height='100'> </td>" ?>
        <td><?php echo $d['nm_lokasi']; ?></td>
        <td><?php echo $d['kondisi']; ?></td>
        <td><?php echo $d['tgl_pengadaan']; ?></td>
        <td><?php echo $d['tgl_rusak']; ?></td>
        <td><?php echo $d['tgl_diperbaiki']; ?></td>
        <td><img src="temp/<?php echo $namafile; ?>" width="100px"></td>
    </tr>
    <?php endforeach; ?>  
</table>

<?php
$html = ob_get_contents();
ob_end_clean();
 
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("".$nama_dokumen.".pdf" ,'D');
$db1->close();
?>

