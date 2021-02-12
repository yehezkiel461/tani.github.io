<?php
	session_start();
	include'koneksi.php';
	
	//jika tidak login maka tidak bisa mengakses
	if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
	{
		echo"<script>alert('Login Dulu');</script>";
		echo"<script>location='login.php';</script>";
		exit();
	}
	
	
	//Jika tidak ada SESSION maka tidak bisa mengakses
	$idpem=$_GET["id"];
	$ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
	$detpem=$ambil->fetch_assoc();
	
	//mendapatkn id_pelanggan yang beli
	$id_pelanggan_beli=$detpem["id_pelanggan"];
	$id_pelanggan_login=$_SESSION["pelanggan"]["id_pelanggan"];
	
	if($id_pelanggan_login !==$id_pelanggan_beli)
	{
		echo"<script>alert('Hayoo,Jangan Nakal');</script>";
		echo"<script>location='riwayat.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		 <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

		<!--CSS Saya-->
		<link rel="stylesheet" type="text/css" href="petani.css">
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" type="image/png" href="images/icons/icons8-tax-48.png">
		<title>Pembayaran</title>
	</head>
	<body>
		<?php include'menu.php';?>
		<div class="container">
			<h2>Konfirmasi Pembayaran</h2>
			<p>Kirim data pembayaran di sini</p>
			<div class="alert alert-info">Total tagihan Anda <strong><?php echo number_format($detpem["total_pembelian"])?></strong></div>
			
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Lengkap:</label>
					<input type="text" class="form-control" name="nama" placeholder="Nama">
				</div>
				<div class="form-group">
					<label>Bank:</label>
					<select class="form-control" name="bank" placeholder="Bank">
										<strong><option value="">Pilih Nama Bank:</option></strong>
										<option>BCA</option>
										<option>Mandiri</option>
										<option>BRI</option>
										<option>BNI</option>
										<option>OVO</option>
					</select>
				</div>
				<div class="form-group">
					<label>Jumlah:</label>
					<input type="number" class="form-control" name="jumlah" min="1" placeholder="Jumlah">
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<input type="file" class="form-control" name="foto" Placeholder="Foto">
					<p class="text-danger">Foto Maksimal 1 MB</p>
				</div>
				<button class="btn btn-primary" name="kirim">Kirim</button>
				
			</form>
		</div>
		
		<?php
			//jika ada tombol kirim
			if(isset($_POST["kirim"]))
			{
				$namabukti=$_FILES["foto"]["name"];
				$lokasibukti=$_FILES["foto"]["tmp_name"];
				$namafiks=date("YmdHis").$namabukti;
				move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");
				
				$nama=$_POST["nama"];
				$bank=$_POST["bank"];
				$jumlah=$_POST["jumlah"];
				$tanggal=date("Y-m-d");
				//simpan pembayaran
				$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
				VALUES('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");
				
				//Update Status Pembelian
				$koneksi->query("UPDATE pembelian SET status_pembelian='Pembelian Berhasil'
				WHERE id_pembelian='$idpem'");
				
				echo"<script>alert('Terima Kasih Sudah Berbelanja');</script>";
				echo"<script>location='riwayat.php';</script>";
			}
		?>
		
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>