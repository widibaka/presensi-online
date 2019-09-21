<?php 

session_start();
$token = $_SESSION['token'];
include '../config.php';
// include '../functions.php';

// $sql2 = "SELECT * FROM `token` WHERE `token` = '$token'";
// $result = mysqli_query($conn, $sql);
// $jumlah_row = mysqli_num_rows($result);

$sql = "SELECT * FROM `shiryou` WHERE `koudo` = '$token'";
$result = mysqli_query($conn, $sql);
$jumlah_row = mysqli_num_rows($result);

?>

<div class="table-responsive">
	<table border="1"  class="table table-bordered" width="100%" cellspacing="0">
	 	<th>NIM</th>
	 	<th>Nama</th>
	 	<th>Opsi</th>
	<?php 
	while($row = mysqli_fetch_assoc($result)){
	?>
	<tr>
	 		<td><?= $row['nim'] ?></td>
	 		<td><?= "Uji Coba" ?></td>
	 		<td><button>Tolak</button></td>
	</tr>
	<?php 
	}
	?>
	</table>
	
</div>