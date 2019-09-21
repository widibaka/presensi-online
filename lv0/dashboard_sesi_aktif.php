<?php 
// Awal program
session_start();
// Koneksi database dan fungsi
include '../config.php';
include '../functions.php';
// Memasukkan token ke database supaya sistem menganggapnya aktif-- dari halaman dashboard
if(isset($_POST['token'])){
	// id_dosen iki menowo kanggo lah... jane yo ra kanggo sih
	$id_dosen = $_POST['id_dosen'];
	$token = $_POST['token'];
	$makul = '0';
	$sql = "INSERT INTO `kidoushiteiru_token` (`makul`,`token`) VALUES ('$makul','$token')";
	mysqli_query($conn, $sql);
	// Membuat session token
	$_SESSION['token'] = $_POST['token'];
	$token = $_SESSION['token'];
	// Di-refresh agar tombol refresh browser tidak menanyakan resubmission
	header("refresh:0.1");
} 
else if($_SESSION['token'] !== 0){
	$token = $_SESSION['token'];
}
else {
	echo "<br># Error";
}
// Delete kidoushiteiru_token di database supaya tidak aktif-- dari form halaman ini
if(isset($_POST['del_token'])){
	$token = $_POST['del_token'];
	$sql = "DELETE FROM `kidoushiteiru_token` WHERE `token` = '$token'";
	mysqli_query($conn, $sql);
	// Kosongkan session token agar token tidak dikenali lagi
	$_SESSION['token'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Presensi Online - Dosen</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php //include '../sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Presensi Online</h1>

<?php //require_once '../topbar.php'; ?>

	<style type="text/css">
		.chatMessages {
			color: blue;
		}
	</style>

<?php 
// Kalau token belum di db, maka kembali
if(strlen($_SESSION['token']) !== 6 AND !isset($_POST['token'])){
	header("location:dashboard.php");
}
// Lanjut atau autentifikasi user jika sudah login
if(isset($_SESSION['dosen'])){
	// Mengizinkan untuk login
	$user = $_SESSION['dosen'];
	if(empty($num_rows)){
		$num_rows = "Memakai SESSION";
	}
	// Semua konten dashboard ditapilkan di bawahnya ini
	?>
<!-- KONTEN UTAMA -->
<p># Dosen LOGGED IN <br>
# <?= $num_rows ?><br><br>
Dosen: <?= $user ?> <br>
<!-- Home -->
        <a href="../" class="mb-4 btn btn-primary btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-home"></i>
          </span>
          <span class="text">Home</span>
        </a>
<!-- Logout -->
        <a href="logout.php" class="mb-4 btn btn-warning btn-icon-split">
          <span class="icon text-white-50">
            <i class="fa fa-sign-out-alt"></i>
          </span>
          <span class="text">Logout</span>
        </a>
<form action="" method="post">
	<input type="hidden" name="del_token" value="<?= $token; ?>">
    <button type="submit" class="mb-4 btn btn-danger btn-icon-split">
      <span class="icon text-white-50">
      <i class="fas fa-angry"></i>
      </span>
      <span class="text">Tutup Sesi Absensi</span>
    </button>
</form>
<div class="text-center">
	<?php 
	if(isset($_POST['token'])){
		echo "Token:" . $token . "<br>";
	} 
	else if($_SESSION['token'] !== 0){
		echo "Token:" . $token . "<br>";
	}
	?>
</div>
<div class="list_siswa mt-4">
	*Loading...
</div>
</p>

<!-- End of KONTEN UTAMA -->
		<?php

	}
	else {
		// Reload jika terjadi kesalahan
		echo "<br># Terjadi kesalahan. Silakan ulangi lagi.";
		header("refresh:2; url=index.php");
	}

 ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<script src="jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
	function getMessages(){
		$.get('list_siswa.php', function(data){
			$(".list_siswa").html(data);
		});
	}
	setInterval(function(){
		getMessages();
	},4000);
});
</script>