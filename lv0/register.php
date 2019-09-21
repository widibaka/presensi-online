<?php 
// Koneksi database
include '../config.php';
// Awal program
if(isset($_POST['submit'])){
	// Collecting data
	$user = strtoupper($_POST['user']);
	$pass = $_POST['password'];
	$pass0 = $_POST['password0'];
	// Check jika user sudah ada
	$sql = "SELECT * FROM riyousha0 WHERE namae = '$user' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_num_rows($result);
	// Check jika user dan password sudah tidak bermasalah
	if($pass == $pass0 && $row != 1){
		// Meng-insert data
		$sql = "INSERT INTO riyousha0 (namae, pasuwado) VALUES ('$user', '$pass')";
		if(mysqli_query($conn, $sql)){
			echo '<br># Successfully Inserted <a href="index.php">continue</a>';
		}
	}
	else {
		// Reload jika terjadi kesalahan
		echo "<br># Terjadi kesalahan. Silakan ulangi lagi.";
		header("refresh:2");
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Presensi Online - Register</title>
</head>
<body>
<p>Registrasi</p>
<form action="" method="post">
	<p>User:<input type="text" name="user" required></p>
	<p>Pass:<input type="password" name="password" required></p>
	<p>Konfirm. Pass:<input type="password" name="password0" required></p>
	<p><input type="submit" name="submit"></p>
</form>
</body>
</html>