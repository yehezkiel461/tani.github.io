<?php include'koneksi.php';?>
<?php
	$keyword=$_GET["keyword"];
	$semuadata=array();
	$ambil=$koneksi->query("SELECT * FROM list_produk WHERE nama_item LIKE '%$keyword%'
	OR deskripsi_produk LIKE '%$keyword%'");
	while($pecah=$ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
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
		<link rel="icon" type="image/png" href="images/icons/icons8-search-48.png">
		<title>Pencarian</title>
	</head>
	<body>
	<?php include'menu.php';?>
		<div class="container">
			<h3>Hasil Pencarian : </h3>
			<center><h2><?php echo $keyword?></h2></center>
			<div class="row">
				<?php foreach ($semuadata as $key => $value):?>
					
				
			
			
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $value['foto_produk'];?>" style="width:100%" class="img-responsive">
						<div class="caption">
							<h3><?php echo $value["nama_item"];?></h3>
							<h5>Rp. <?php echo number_format($value['harga_produk'])?></h5>
							<a href="beli.php?id=<?php echo $value['id_produk'];?>" class="btn btn-primary mb-3">Beli</a>
							<a href="detail.php?id=<?php echo $value['id_produk'];?>" class="btn btn-warning mb-3">Detail</a>
						</div>
					</div>
				</div>
				
				<?php endforeach ?>
				
				
			</div>
		</div>
	
	
	
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
	
</html>