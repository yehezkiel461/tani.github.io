<?php
	session_start();
	include'koneksi.php';
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
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="icon" type="image/png" href="images/icons/icons8-shop-48.png">
		<title>Bahan Tani</title>
	</head>
	<body>
	<!--Navigation-->
			<?php include'menu.php';?>
			
		<!--sidebar-->

		<div class="slider">
			<div class="load">
			</div>
		</div>
		<div class="content">
			<div class="principal">
				<b><h1>Welcome</h1></b>
				<p>Selamat Berbelanja Di sini</p>
			</div>
		</div>
        <!-- Page Content  -->
     <section id="portofolio" class="portofolio portofolio-light bg-light">
		<div class="container card-center">
			<div class="row mb-4 pt-4">
				<div class="col text-center" style="color:#000">
					<b><h2>Bahan Tani</b></h2>
				</div>
			</div>
		
			<div class="row mb-4">
			
				<?php $ambil = $koneksi->query("SELECT * FROM list_produk");?>
				<?php while($perproduk = $ambil->fetch_assoc()){?>
				
				<div class="col-md-3">
					<div class="thumbnail">
					  <img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" style="width:100%">
					  <div class="card-body">
						<div class="caption">
							<h3><?php echo $perproduk['nama_item'];?></h3>
							<h5><?php echo $perproduk['harga_produk'];?></h5>
							<a href="beli.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-warning">Detail</a>
						</div>
					  </div>
					</div>
				</div>
				<?php } ?>
				
			</div>
			
		</div>
	</section>
	<footer class="bg-dark text-white">
		<div class="container">
			<div class="row pt-3">
				<div class="col text-center">
					<p>CopyRight @2020</p>
				</div>
			</div>
		</div>
		
	</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>