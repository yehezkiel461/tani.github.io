<?php 
include "koneksi.php";
	$username = $_POST['username'];
	$alamat   = $_POST['alamat'];
	$password = $_POST['password'];
	$password2= $_POST['password2'];
	$foto     = $_POST['foto'];
	$level    = "user";
	
	$query="SELECT * FROM tb_user";
	$hasil1=mysqli_query($conn , $query);
	$datalog=mysqli_fetch_assoc($hasil1);


	if ($password == $password2) {
		

		$pengacak = "p3ng4c4k";

		$passmd = md5($pengacak . md5($password));
		
		$query = "INSERT INTO tb_user VALUES ('$username','$password','$alamat','$foto','$level')";
		$hasil = mysqli_query($conn,$query);
		if ($hasil) {
			echo "<script type='text/javascript'>
					 alert('akun berhasil terdaftar');
					 document.location.href='login.php';
					</script>";


		}
		else {
			echo "<script type='text/javascript'>
					 alert('username sudah ada yang memiliki');
					 document.location.href='daftar.php';
					</script>";
		}
		
	}
	else{
		echo "<script type='text/javascript'>
					 alert('password yang anda masukkan tidak sama');
					 document.location.href='daftar.php';
					</script>";
	}
	

 ?>