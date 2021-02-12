<?php
session_start();
include'koneksi.php';

	if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
	{
		echo"<script>alert('Login Dulu');</script>";
		echo"<script>location='login.php';</script>";
		exit();
	}

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
			<h3>Data Konfirmasi Lunas</h3>
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
				<form method="POST" enctype="multipart/form-data">
				<div class="form-grup">
					<label>Foto Bukti Barang</label>
					<input type="file" class="form-control" name="foto">
				</div>

			<button class="btn btn-primary" name="kirim">Kirim</button>
			</form>
		</div>
		<?php
			if(isset($_POST["kirim"]))
			{
				
				$fotobarang = $_FILES['foto']['name'];
				$lokasibarang = $_FILES['foto']['tmp_name'];
				move_uploaded_file($lokasibarang,"bukti_barang/$fotobarang");
				$koneksi->query("UPDATE pembelian SET bukti_barang='$fotobarang' 
					WHERE id_pembelian='$id_pembelian'");
				
				echo"<script>alert('Data Sudah Masuk');</script>";
				echo"<script>location='riwayat.php';</script>";
			}
		?>
	</body>
</html>