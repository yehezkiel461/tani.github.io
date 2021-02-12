<?php
session_start();
include'koneksi.php';


$id_pembelian=$_GET["id"];

$ambil=$koneksi->query("SELECT * FROM pembayaran 
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay=$ambil->fetch_assoc();

if(empty($detbay)){
	echo"<script>alert('Belum Ada Data')</script>";
	echo"<script>location='riwayat.php';</script>";
	exit();
}

if ($_SESSION ["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]) {

	echo"<script>alert('Anda Tidak Memiliki Akses')</script>";
	echo"<script>location='riwayat.php';</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

		<!--CSS Saya-->
		<link rel="stylesheet" type="text/css" href="petani.css">
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>Lihat Pembayaran</title>
	</head>
	<body>
		<?php include'menu.php';?>

		<div class="container">
			<h3>Data Pembayaran Anda</h3>
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tr>
							<th>Nama</th>
							<td><?php echo $detbay["nama"]?></td>
						</tr>
						<tr>
							<th>Bank</th>
							<td><?php echo $detbay["bank"]?></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td><?php echo $detbay["tanggal"]?></td>
						</tr>
						<tr>
							<th>Jumlah</th>
							<td>Rp.<?php echo number_format($detbay["jumlah"])?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-4">
					<img src="bukti_pembayaran/<?php echo $detbay['bukti']?>" style="width:100%" class="img-responsive">
				</div>
			</div>
		</div>
	</body>
</html>