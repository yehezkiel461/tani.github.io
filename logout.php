
<link rel="icon" type="image/png" href="images/icons/icons8-sign-out-48.png">
<?php
	session_start();
	
	//mengahancurkan session pelanggan
	session_destroy();
	
	echo"<script>alert('Anda telah Logout');</script>";
	echo"<script>location='index.php';</script>";
?>
