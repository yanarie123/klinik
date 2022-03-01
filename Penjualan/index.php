<?php
session_start();
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TRANSAKSI PENJUALAN - APOTEK KLINIK </title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
</head>
<body>
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/logo.png" width="499" height="80"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="?page=Penjualan-Baru" target="_self">Penjualan Baru</a> | <a href="?page=Penjualan-Tampil" target="_self">Tampil Penjualan</a> I <a href="../index.php">Kembali ke Menu Utama</a> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<?php 
# KONTROL MENU PROGRAM
if(isset($_GET['page'])) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case 'Penjualan-Baru' :
			if(!file_exists ("penjualan_baru.php")) die ("Empty Main Page!"); 
			include "penjualan_baru.php";	break;
		case 'Pencarian-Obat' : 
			if(!file_exists ("pencarian_obat.php")) die ("Empty Main Page!"); 
			include "pencarian_obat.php";	break;
		case 'Penjualan-Tampil' : 
			if(!file_exists ("penjualan_tampil.php")) die ("Empty Main Page!"); 
			include "penjualan_tampil.php";	break;
		case 'Penjualan-Hapus' : 
			if(!file_exists ("penjualan_hapus.php")) die ("Empty Main Page!"); 
			include "penjualan_hapus.php";	break;
			case 'Pencarian-Pasien' :
if (!file_exists ("pencarian_pasien.php")) die ("Empty Main Page!") ; include "pencarian_pasien.php"; break;
	}
}
else {
	include "penjualan_baru.php";
}
?>
</body>
</html>
