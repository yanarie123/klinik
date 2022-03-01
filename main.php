<?php
if(isset($_SESSION['SES_ADMIN'])) {
	echo "<h2>Selamat datang di Klinik & Apotek Samudra Husada Kusuma!</h2>";
	echo "<b> Anda login sebagai Admin";
	exit;
}
else if(isset($_SESSION['SES_PETUGAS'])) {
	echo "<h2>Selamat datang di Klinik & Apotek Samudra Husada Kusuma!</h2>";
	echo "<b> Anda login sebagai Petugas";
	exit;
}
else if (isset ($_SESSION ['SES_APOTEK'])) {
	echo "<h2> Selamat datang di Klinik & Apotek Samuidra Husada Kusuma! </h2>";
	echo "<b> Anda Login sebagai Petugas";
	exit; 
}
else if (isset ($_SESSION ['SES_DOKTER'])) {
	echo "<h2> Selamat datang di Klinik & Apotek Samuidra Husada Kusuma! </h2>";
	echo "<b> Anda Login sebagai Petugas";
	exit; 
}
else {
	echo "<h2>Selamat datang di Klinik & Apotek Samudra Husada Kusuma!</h2>";
	echo "<b>Anda belum login, silahkan <a href='?page=Login' alt='Login'>login </a>untuk mengakses sitem ini ";
	//Tambah auto redirect by Arie
	header('Location: ?page=Login');
}
?>