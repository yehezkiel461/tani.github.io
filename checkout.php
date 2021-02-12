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
		

		<!--CSS Saya-->
		<link rel="stylesheet" type="text/css" href="petani.css">
		<link rel="stylesheet" type="text/css" href="home.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" type="image/png" href="images/icons/icons8-check-for-payment-48.png">
		<title>Check Out</title>
	</head>
	<body>
			<?php include 'menu.php';?>
			<section class="konten">
				<div class="container">
					<h1><center>CheckOut</center></h1>
					<hr>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>SubHarga</th>
							</tr>
						</thead>
						<tbody>
						<?php $nomor=1;?>
						<?php $totalbelanja=0;?>
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
							</tr>
						<?php $nomor++;?>
						<?php $totalbelanja+=$subharga;?>
						<?php endforeach?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4">Total Belanja</th>
								<th>Rp. <?php echo number_format($totalbelanja)?></th>
							</tr>
						</tfoot>
					</table>
					<form method="POST">
							<div class="row">
								<div class="col-md-3">
									<label>Nama Pelanggan : </label>
									<div class="form-group">
										<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']?> " class="from-group">
									</div>
								</div>
								<div class="col-md-3">
									<label>No.Telepon : </label>
									<div class="form-group">
										<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?> " class="from-group">
									</div>
								</div>
								<div class="col-md-3">
									<label>Provinsi : </label>
									<select class="form-control" name="nama_provinsi">
										
									</select>
								</div>
								<div class="col-md-3">
									<label>Kota : </label>
									<select class="form-control" name="nama_distrik">
										
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label>Ekspedisi : </label>
									<select class="form-control" name="nama_ekspedisi">
										
									</select>
								</div>
								<div class="col-md-3">
									<label>Paket : </label>
									<select class="form-control" name="nama_paket">
										
									</select>
								</div>
							</div>
							<input type="hidden" name="total_berat" value="1200">
							<input type="hidden" name="provinsi">
							<input type="hidden" name="distrik">
							<input type="hidden" name="tipe">
							<input type="hidden" name="kodepos">
							<input type="hidden" name="ekspedisi">
							<input type="hidden" name="paket">
							<input type="hidden" name="ongkir">
							<input type="hidden" name="estimasi">
							<div class="form-group">
									<label>Alamat Detail : </label>
									<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan Alamat Lengkap"></textarea>
							</div>
					
							<button class="btn btn-info mt-3" name="checkout">CheckOut</button>
							
					</form>
					<?php
						if(isset($_POST["checkout"]))
						{


								$provinsi=$_POST["provinsi"];
							  	$tipe=$_POST["tipe"];
							  	$distrik=$_POST["distrik"];
							  	$kodepos=$_POST["kodepos"];
							  	$ekspedisi=$_POST["ekspedisi"];
							  	$paket=$_POST["paket"];
							  	$ongkir=$_POST["ongkir"];
							  	$estimasi=$_POST["estimasi"];

							$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
							$id_ongkir = $_POST["id_ongkir"];
							$tanggal_pembelian = date("Y-m-d");
							$alamat_pengiriman=$_POST['alamat_pengiriman'];
							
							$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_ongkir='$id_ongkir'");
							$arrayongkir = $ambil->fetch_assoc();
							$nama_kota=$arrayongkir['distrik'];
							
							$total_pembelian = $totalbelanja+$ongkir;
							//menyimpan data ke tabel pembelian
							$koneksi->query("INSERT INTO pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,alamat_pengiriman,provinsi,tipe,distrik,kodepos,ekspedisi,paket,ongkir,estimasi)
							VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$alamat_pengiriman','$provinsi','$tipe','$distrik','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi')");
							//mendapatkan id_pembelian barusan terjadi
							$id_pembelian_barusan = $koneksi->insert_id;
							
							foreach($_SESSION["keranjang"] as $id_produk =>$jumlah)
							{
								//mendapatkan data produk berdasarkan id_produk
								$ambil =$koneksi->query("SELECT * FROM list_produk WHERE id_produk='$id_produk'");
								$perproduk = $ambil->fetch_assoc();
								
								$nama=$perproduk['nama_item'];
								$harga=$perproduk['harga_produk'];
								$berat=$perproduk['berat_produk'];
								
								$subberat=$perproduk['berat_produk']*$jumlah;
								$subharga=$perproduk['harga_produk']*$jumlah;
								$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
								VALUES('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");
								
								//script update stok
								$koneksi->query("UPDATE list_produk SET stok_produk=stok_produk -$jumlah
								WHERE id_produk='$id_produk'");
							}
							
							//mengkosongkan keranjang
							unset($_SESSION["keranjang"]);
							
							//tampilan di alihkan ke halaman nota,nota dari pembelian barusan
							echo"<script>alert('Pembelian Sukses');</script>";
							echo"<script>location='nota.php?id=$id_pembelian_barusan';</script>";
						}
					?>
					</hr>
				</div>
			</section>
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
			
			<script>
				$(document).ready(function(){
					$.ajax({
						type:'POST',
						url:'dataprovinsi.php',
						success:function(hasil_provinsi)
						{
							$("select[name=nama_provinsi]").html(hasil_provinsi);
						}
					});
					
					$("select[name=nama_provinsi]").on("change",function(){
						//ambil id provinsi yang dipilih
						var id_provinsi_terpilih=$("option:selected",this).attr("id_provinsi");
						$.ajax({
							type:'POST',
							url:'datadistrik.php',
							data:'id_provinsi='+id_provinsi_terpilih,
							success:function(hasil_distrik)
							{
								$("select[name=nama_distrik]").html(hasil_distrik);
							}
						});
					});
					$.ajax({
							type:'POST',
							url:'dataekspedisi.php',
							success:function(hasil_ekspedisi)
							{
								$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
							}
						});
					$("select[name=nama_ekspedisi]").on("change",function(){
						//mendapatkan ongkos kirim

						//mendapatkan ekspedisi yang dipilih
						var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
						//mendapatkan id_distrik yang di pilih
						var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");
						//mendapatkan total berat dari inputan
						var total_berat = $("select[name=total_berat]").val();
						$.ajax({
							type:'POST',
							url:'datapaket.php',
							data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
							success:function(hasil_paket)
							{
								$("select[name=nama_paket]").html(hasil_paket);
								//console.log(hasil_paket);
								$("input[name=ekspedisi]").val(ekspedisi_terpilih);
							}
						})
					});
						$("select[name=nama_distrik]").on("change",function(){
							var prov = $("option:selected",this).attr("nama_provinsi");
							var dist = $("option:selected",this).attr("nama_distrik");
							var tipe = $("option:selected",this).attr("tipe_distrik");
							var kodepos = $("option:selected",this).attr("kodepos");

							$("input[name=provinsi]").val(prov);
							$("input[name=distrik]").val(dist);
							$("input[name=tipe]").val(tipe);
							$("input[name=kodepos]").val(kodepos);
						});
						$("select[name=nama_paket]").on("change",function(){
							var paket = $("option:selected",this).attr("paket");
							var ongkir = $("option:selected",this).attr("ongkir");
							var etd = $("option:selected",this).attr("etd");
							$("input[name=paket]").val(paket);
							$("input[name=ongkir]").val(ongkir);
							$("input[name=estimasi]").val(etd);
						})
				});
			</script>
	</body>
</html>