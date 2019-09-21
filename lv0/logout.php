<?php 

session_start();

// include('../konfigurasi/konfig.php');

//       //Mengubah status menjadi ONLINE bukan offline
//       $user = $_SESSION['username'];
//       $update = "UPDATE `users` SET status_online=0 WHERE username='$user'";
//       $hasil = mysqli_query($conn,$update);

// Hapus cookie dengan cara mundurkan waktu berlaku 7 hari.
// setcookie('malas_login', '', time()-3600*24*7);

if(session_destroy()) // Destroying All Sessions
{
	header("location: index.php"); // Redirecting To Home Page
}
 ?>