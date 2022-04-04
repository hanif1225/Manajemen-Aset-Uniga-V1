<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../main/koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$pass=md5($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($konek,"select * from users where username='$username' and password='$pass'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		$_SESSION['status_login'] = "sudah login";
		// alihkan ke halaman dashboard admin
		header("location:../main/index.php");

	// cek jika user login sebagai kepala lab
	}
	 else if($data['level']=="kepala lab"){
	 	// buat session login dan username
	 	$_SESSION['username'] = $username;
        $_SESSION['level'] = "kepala lab";
        $_SESSION['status_login'] = "sudah login";
	// alihkan ke halaman dashboard kepala lab
		header("location:../main/index2.php");
	 }else{

		// alihkan ke halaman login kembali
		header("location:../index.php?pesan=gagal");
	}	
}else{
	header("location:../index.php?pesan=gagal");
}

?>