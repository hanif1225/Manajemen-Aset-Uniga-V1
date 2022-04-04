<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/fontawesome_all.min.css">
    <link rel="stylesheet" href="../bootstrap/css/style.css">
    <link rel="stylesheet" href="../bootstrap/css/tampilan_tambahan.css">

    <title>sistem Manajemen</title>
  </head>
  <body>
    <div class="wrapper">
        <nav id="sidebar">

             <div class="sidebar-header">
                 <h3 align="center"><b>Manajemen Aset Uniga</b></h3>
             </div>

            <ul class="lisst-unstyled components">
 
            
                 <li >
                     <a href="../main/index2.php"><i class="fas fa-book"></i> <b>Menu Utama</b></a>
                 </li>

                 <li class="active">
                     <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-clipboard"></i> <b>Laporan</b></a>
                   <ul class="collapse list-unstyled" id="homeSubmenu">
                       <li>
                           <a href="../data_laporan/index.php"><b>Inventaris </b></a>
                       </li>
                       <li>
                           <a href="../data_lokasi/index.php"><b>Lokasi Barang </b></a>
                       </li>
       
                   </ul>
                 </li>

                 <li>
                     <a href="../main/about.php"><i class="fas fa-lightbulb"></i>  <b>About</b></a>
                 </li>
                        <li class="nav-item">
                            <a  onclick="return confirm('Apakah anda ingin logout');" href="../aksi_login/logout.php"><center><button class="btn btn-success "><i class="fas fa-sign-out-alt"></i> <b>Logout</b></button></center></a>
                        </li>
            </ul>
        </nav>
       
       
       <div id="content">   
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <div class="container-fluid">
                 <button type="button" id="sidebarCollapse" class="btn  btn-primary">
                 <i class="fas fa-arrows-alt-h"></i>    
                 </button>
             </div>
        </nav>
       
       <br>
       <br>
