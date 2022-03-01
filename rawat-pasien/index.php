<?php
session_start () ;
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
date_default_timezone_set ("Asia/Jakarta") 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TRANSAKSI RAWAT PASIEN - KLINIK DOKTER</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
<style type="text/css">
<!--
.style2 {font-size: 14px}
-->
</style>
</head>

<body>
<table width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td><img src="../images/logo.png" width="584" height="79" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style2"><a href="?page=Rawat-Baru">Rawat Pasien Baru</a> I <a href="../index.php?page=Pasien-Add" target="popup" onclick="window.open('../index.php?page=Pasien-Add','popup','width=800,height=800'); return false;">Tambah Data Pasien Baru</a> I <a href="?page=Rawat-Tampil" >Tampilkan Pasien Rawat</a>  I <a href="../index.php?page=Rawat-Tampil">Kembali ke Menu Utama </a></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php 
#KONTROL MENU PROGRAM
if (isset ($_GET ['page'])) {
//Jika mendapatkan variabel URL ?page
switch ($_GET ['page']) {
case 'Rawat-Baru':
if (!file_exists ("rawat_baru.php")) die ("Empty Main Page!"); include "rawat_baru.php"; break;
case 'Rawat-Tampil' : 
if (!file_exists ("rawat_tampil.php")) die ("Empty Main Page!"); include "rawat_tampil.php"; break;
case 'Rawat-Hapus' :
if (!file_exists ("rawat_hapus.php")) die ("Empty Main Page!"); include "rawat_hapus.php"; break;
case 'Pencarian-Pasien' :
if (!file_exists ("pencarian_pasien.php")) die ("Empty Main Page!") ; include "pencarian_pasien.php"; break;
	}
}
else {
include "rawat_baru.php";
}
?>
</body>
</html>
