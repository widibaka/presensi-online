<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Presensi Online - Siswa</title>

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
// Koneksi database
include '../config.php';
// Fungsi-fungsi
include '../functions.php';
// Awal program
session_start();

// Penerima token siswa
if (isset($_POST['token'])) {
	$token = $_POST['token'];
	$nim = $_SESSION['siswa'];
	// Cek apakah token yang diinputkan sedang aktif ataukah tidak
	$sql = "SELECT * FROM `kidoushiteiru_token` WHERE token = '$token'";
	$result = mysqli_query($conn, $sql);
	$token_aktif = mysqli_num_rows($result);
	// Cek apakah token yang diinputkan sedang aktif ataukah tidak
	$sql = "SELECT * FROM `shiryou` WHERE nim = '$nim' AND koudo = '$token'";
	$result = mysqli_query($conn, $sql);
	$token_dobel = mysqli_num_rows($result);
	// Jika token sedang aktif, alias ada di table kidoushiteiru_token
	if($token_aktif && !$token_dobel){
	    // Selecting table
	    $sql = "INSERT INTO `shiryou` (`nim`, `koudo`) VALUES ('$nim', '$token')";
	    if(mysqli_query($conn, $sql)) {
	    	echo "<br># Token berhasil";
	    }
	    else {
	    	echo $conn->error;
	    }
	}
	elseif ($token_dobel) {
		echo "<br># Maaf, mengisi daftar hadir cukup sekali saja";
	}
	// Jika token tidak ada di tabel kidoushiteiru_token
	else{
		echo '<br># Maaf, matakuliah dengan token "' . $token . '" tidak ada atau telah kedaluwarsa';
	}
}

// Jika baru login pertama
if(isset($_POST['siswa_submit'])){
	// Collecting data
	$user = strtoupper($_POST['user']);
	$pass = $_POST['password'];
	// Check jika user sudah ada
	$sql = "SELECT * FROM riyousha1 WHERE namae = '$user' AND pasuwado = '$pass' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	if($num_rows == 1){
		$_SESSION['siswa'] = $user;
		header("refresh:0.5");
	}
}

// Check jika user tidak bermasalah
// Lanjut atau autentifikasi user jika sudah login
if(isset($_SESSION['siswa'])){
	// Mengizinkan untuk login
	$user = $_SESSION['siswa'];
	if(empty($num_rows)){
		$num_rows = "Memakai SESSION";
	}
	// Semua konten dashboard ditapilkan di bawahnya ini
	?>
<!-- KONTEN UTAMA -->
<p># Siswa LOGGED IN <br>
# <?= $num_rows ?><br><br>
Siswa: <?= $user; ?> <br>
<a href="../">Home</a><br>
<a href="logout.php">Logout</a>
</p>
<p>
	Masukkan Token Kehadiran
	<form action="" method="post">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Token..." name="token" autocomplete="off" autofocus>
        </div>
		<input type="submit" class="btn btn-primary form-control" name="token_submit" value="Kirim">
	</form>
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
