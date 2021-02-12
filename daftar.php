<?php include'koneksi.php';?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="images/icons/icons8-add-user-male-48.png">
    <title>Form Pendaftaran</title>
	<style>

	</style>
  </head>
  <body>
	<!--Layer1-->
	<div class="container">
		<h2 class="alert alert-primary text-center mt-3">Pendaftaran</h2>
		<form method="POST">
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="alamat">Nama Lengkap</label>
						<input type="text" name="name" class="form-control" placeholder="Nama Lengap" id="name" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="pass">Email</label>
						<input type="text" name="email" class="form-control" placeholder="Email" id="email" required>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl">Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" id="username" required>
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Confirm Password" id="pass" required>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl">Konfirmasi Password</label>
						<input type="password" name="password2" class="form-control" placeholder="Confirm Password" id="pass2" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl">No Telepon</label>
						<input type="number" name="nomor" class="form-control" placeholder="No.Telepon" id="nomor" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl">Alamat</label>
						<input type="text" name="alamat" class="form-control" placeholder="Alamat" id="alamat" required>
					</div>
				</div>
			</div>
				<button class="btn btn-primary" name="daftar">Daftar</button>
				<button class="btn btn-danger">Reset</button>
		</form>
		<?php
		//jika ada  tombol daftar
		if(isset($_POST["daftar"]))
		{
			//mengambil isi database pelanggan
			$nama=$_POST["name"];
			$email=$_POST["email"];
			$username=$_POST["username"];
			$password=$_POST["password"];
			$nomor=$_POST["nomor"];
			$alamat=$_POST["alamat"];
			//cek akun sudah terdaftar atau belum
			$ambil =  	$koneksi->query("SELECT * FROM pelanggan WHERE username='$username'");
			$yangcocok=$ambil->num_rows;
			if($yangcocok==1){
				echo"<script>alert('Pendaftaran Gagal,Akun sudah terdaftar!!!');</script>";
				echo"<script>location='daftar.php';</script>";
			}
			else{
				//query insert
				$koneksi->query("INSERT INTO pelanggan(username,password,nama_pelanggan,telepon_pelanggan,email_pelanggan,alamat_pelanggan)
				VALUES('$username','$password','$nama','$nomor','$email','$alamat')");
				
				echo"<script>alert('Pendaftaran Sukses, Silahkan Login!');</script>";
				echo"<script>location='login.php';</script>";
			}
		}
		?>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>