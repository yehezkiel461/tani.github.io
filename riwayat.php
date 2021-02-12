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
?>
<!doctype html>
<html lang="en">
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
		<link rel="icon" type="image/png" href="images/icons/icons8-time-machine-48.png">
		<title>Riwayat Belanja</title>
	</head>
	<body>
			<?php include'menu.php';?>
			<section class="riwayat">
				<div class="container">
					<h3>Riwayat Belanja :</h3>
					<h3><center><strong><?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?></strong></center></h3>
					
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Status</th>
								<th>Total</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$nomor=1;
							$id_pelanggan=$_SESSION["pelanggan"]['id_pelanggan'];
							
							$ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
							while($pecah=$ambil->fetch_assoc()){;
							?>
							<tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $pecah['tanggal_pembelian'];?></td>
								<td>
									<?php echo $pecah['status_pembelian'];?>
									<br>
									<?php if(!empty($pecah['resi_pengiriman'])):?>
									Resi: <?php echo $pecah['resi_pengiriman'];?>
									<?php endif ?>
								</td>
								<td>Rp. <?php echo number_format($pecah['total_pembelian']);?></td>
								<td>
									<a href="nota.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info">Nota</a>
									
									<?php if ($pecah['status_pembelian']=="pending"):?>
										<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-success">Input Pembayaran</a>
									<?php elseif($pecah['status_pembelian']=="Pembelian Berhasil"):?>
										<a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-primary">Lihat Pembayaran</a>
									<?php elseif($pecah['status_pembelian']=="Barang Dikirim"):?>
										<a href="lunas.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-warning">Barang Terkirim,Lunas</a>
									<?php endif?>
									
								</td>
							</tr>
							<?php $nomor++;?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>