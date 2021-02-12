<?php session_start();?>
<?php include 'koneksi.php';?>
<?php
//mendapatkan url produk
$id_produk=$_GET["id"];

$ambil=$koneksi->query("SELECT * FROM list_produk WHERE id_produk='$id_produk'");
$detail=$ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Detail Produk</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<!--CSS Saya-->
		<link rel="stylesheet" type="text/css" href="petani.css">
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" type="image/png" href="images/icons/icons8-more-details-48.png">
	</head>
	<body>
		<?php include'menu.php';?>
		<section class="konten">
			<div class="container">
				<div class="col-md-6 mt-3">
					<img src="foto_produk/<?php echo $detail["foto_produk"];?>" class="img-responsived" style="width:100%">
				</div>
				<div class="col-md-6">
					<b><h2><?php echo $detail["nama_item"];?></h2></b>
					<h4>Berat : <?php echo $detail["berat_produk"];?>/Gr</h4>
					<h4>Harga : Rp.<?php echo number_format($detail["harga_produk"]);?>
					
					<h4>Stok: <?php echo $detail['stok_produk']	?></h4>
					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input type="number" min="1" class="form form-boredered mr-3" name="jumlah" max="<?php echo $detail['stok_produk'];?>">
								<button class="btn btn-info" name="beli">Beli</button>
							</div>
						</div>
					</form>
					<?php
					if(isset($_POST["beli"]))
					{
						$jumlah=$_POST["jumlah"];
						$_SESSION["keranjang"][$id_produk]=$jumlah;
						
						echo"<script>alert('Produk telah di tambahkan');</script>";
						echo"<script>location='keranjang.php';</script>";
					}
					
					
					?>
					
					
					<h4>Deskripsi : <?php echo $detail["deskripsi_produk"];?></h4>
				</div>
			</div>
		</section>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
</html>