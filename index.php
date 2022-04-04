<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="bootstrap/tampilan_pendukung/tampilan_login.css" type="text/css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <title>Form_Login</title>
  </head>
  <body>
      <section class="container-fluid bg">
          <section class="row justify-content-center">
              <section class="col-12 col-sm-6 col-md-3">
                  
                  <form class="form-container" action="aksi_login/proses.php" method="post">
                    <h4 align="center" >FORM LOGIN</h4>
                    <center><img src="bootstrap/uniga.png" height="150" width="150"/></center>
         
                       <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-user"></i></div>    
                          <input type="text" name="username" class="form-control"  aria-describedby="emailHelp" placeholder="Masukkan User Name" required="" >
                        </div>
                        </div>
                     </div>
                       
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                           <input type="password" name="password" class="form-control"  placeholder="Masukkan Password" required="">
                        </div>
                        </div>
                    </div>
                       
                    <div class="form-group form-check">
                    <!--    <input type="checkbox" class="form-check-input" id="exampleCheck1"> 
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>  -->
                    </div>
                        <button type="submit" class="btn btn-danger btn-block">Submit</button>
                        <button type="reset" class="btn btn-primary btn-block">Reset</button>
                    <!--   <center> <a href='index2.php' class='btn btn-success mt-1 '><i class="fas fa-home"></i>Bukan Admin</a></center> -->
                    </form>
              </section>    
          </section>
          
      </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>