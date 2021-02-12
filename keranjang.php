<?php
	session_start();
	
	
	include'koneksi.php';


	//jika user belum login maka user tidak bisa mengakses checkout
	if(!isset($_SESSION["pelanggan"])){
		echo"<script>alert('Login Dulu!');</script>";
		echo"<script>location='login.php'</script>";
	}
	
	
	if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
	{
		echo"<script>alert('Keranjang kosong, silahkan belanja dahulu');</script>";
		echo"<script>location='index.php';</script>";
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
		<link rel="icon" type="image/png" href="images/icons/icons8-add-shopping-cart-48.png">
		<title>Keranjang</title>
	</head>
	<body>
			<?php include 'menu.php';?>
			
			
			
			<section class="konten">
				<div class="container">
					<h1><center>Keranjang Belanja</center></h1>
					<hr>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Prpduk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>SubHarga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php $nomor=1;?>
						<?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah):?>
						<?php 
						//menampilkan produk yang diperulangkan
						$ambil = $koneksi->query("SELECT * FROM list_produk WHERE id_produk='$id_produk'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah["harga_produk"]*$jumlah;
						
						?>
							<tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo $pecah['nama_item'];?></td>
								<td>Rp.<?php echo number_format($pecah["harga_produk"]);?></td>
								<td><?php echo $jumlah;?></td>
								<td>Rp.<?php echo number_format($subharga);?></td>
								<td>
									<a href="hapuskeranjang.php?id=<?php echo $id_produk?>" class="btn btn-danger btn-xs">hapus</a>
								</td>
							</tr>
						<?php $nomor++;?>
						<?php endforeach?>
						</tbody>
					</table>
					<a href="index.php" class="btn btn-info mt-3">Lanjutkan Belanja</a>
					<a href="checkout.php" class="btn btn-danger mt-3">Check Out</a>
					</hr>
				</div>
			</section>
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>