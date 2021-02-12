
<?php
	session_start();
	include'koneksi.php';
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
		<link rel="icon" type="image/png" href="images/icons/icons8-paid-bill-48.png">
		<title>Nota Belanja	</title>
	</head>
	<body>
			<?php include'menu.php';?>
			<section class="konten">
				<div class="container">
					
					
					<h2><center>Nota Belanja</center></h2>
					<?php
						$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
							ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
							WHERE pembelian.id_pembelian = '$_GET[id]'");
						$detail = $ambil->fetch_assoc();
					?>
					
					
					<!--Jika pelanggan yang beli tidak sama akan di arahan ke login
					pelanggan yang beli harus yang login-->
					<?php
					//mendapatkan id_pelanggan yang beli
					$idpelangganyangbeli = $detail["id_pelanggan"];
					
					//mendapatkan id pelanggan yang login
					$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
					
					if($idpelangganyangbeli!==$idpelangganyanglogin)
					{
						echo"<script>alert('hayooo,jangan nakal! Login Dulu');</script>";
						echo"<script>location='riwayat.php';</script>";
						exit();
					}
					
					?>
					
					
					
					
					<div class="row">
						<div class="col-md-4">
							<h3>Pembelian</h3>
							<strong>No.Pembelian: <?php echo $detail['id_pembelian'];?></strong><br>
							Tanggal : <?php echo $detail['tanggal_pembelian'];?><br>
							Total : Rp. <?php echo number_format($detail['total_pembelian'])?>
						</div>
						<div class="col-md-4">
							<h3>Pelanggan</h3>
							<strong><?php echo	 $detail['nama_pelanggan'];?></strong><br>
							<p>
								No.Telepon : <?php echo $detail['telepon_pelanggan'];?><br>
								Email : <?php echo $detail['email_pelanggan'];?>
							</P>
						</div>
						<div class="col-md-4">
							<h3>Pengiriman</h3>
							<strong>Ekspedisi : <?php echo $detail['ekspedisi'];?></strong><br>
							Ongkos Kirim : Rp.<?php echo number_format($detail['ongkir']);?><br>
							Tujuan : <?php echo $detail['distrik'];?>, <?php echo $detail['provinsi'];?>,  <?php echo $detail['kodepos'];?><br>
							Alamat Detail: <?php echo $detail['alamat_pengiriman'];?>
						</div>
						
						
					</div>
					
					
					<table class=" table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Berat</th>
								<th>Jumlah</th>
								<th>SubBerat</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor=1;?>
							<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");?>
							<?php while($pecah=$ambil->fetch_assoc()){ ?>
							<tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $pecah['nama'];?></td>
								<td>Rp.<?php echo number_format($pecah['harga']);?></td>
								<td><?php echo $pecah['berat'];?> Gr.</td>
								<td><?php echo $pecah['jumlah'];?></td>
								<td><?php echo $pecah['subberat'];?> Gr.</td>
								<td>Rp.<?php echo number_format($pecah['subharga']);?></td>
							</tr>
							<?php $nomor++;?>
							<?php } ?>
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-7">
							<div class="alert alert-info">
							<p>
								Silahkan Melakukan Pembayaran Rp.<?php echo number_format($detail['total_pembelian']);?> 
								ke<br>
								<strong>Bank BCA 3151296686 Yehezkiel Sutiono</strong>
							</p>
							</div>
						</div>
					</div>
					
					
					
				</div>
			</section>
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>