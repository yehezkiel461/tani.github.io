<?php
session_start();

//mendapatkan id
$id_item = $_GET['id'];




//jika sudah ada produk itu di keranjang, maka produk itu jumlah +1
if(isset($_SESSION['keranjang'][$id_item]))
{
	$_SESSION['keranjang'][$id_item] +=1;
}

//selain itu(blm ada dikeranjang),maka produk itu di anggap beli 1
else
{
	$_SESSION['keranjang'][$id_item] = 1;
}

//echo"<pre>";
	//print_r($_SESSION);
//echo"</pre>";

echo"<script>alert('produk telah dimasukan ke keranjang belanja');</script>";
echo"<script>location='keranjang.php';</script>";
?>