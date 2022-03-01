<?php
session_start() ;
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
date_default_timezone_set ("Asia/Jakarta");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PENDAFTARAN PASIEN - KLINIK DOKTER</title>
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>
<link href="../style.css" rel="stylesheet" type="text/css" />
<linkrel="styleshee" type="text/css "href="../plugins/tigra_calendar/tcal.css""/>
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td><img src="../images/logo.png" width="584" height="79" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style1"><a href="?page=Pendaftaran-Baru">Pendaftaran Baru</a> I <a href="?page=Pendaftaran-Tampil">Tampilkan Pendaftaran</a> I <a href="../index.php">Kembali ke Menu Utama </a></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php 
#KONTROL MENU PROGRAM
if (isset ($_GET ['page'])) {
//Jika mendapatkan variabel URL ?page
switch ($_GET [ 'page']) {
case 'Pendaftaran-Baru' :
		if (!file_exists ("pendaftaran_baru.php")) die ("Empty Main Page!");
		include "pendaftaran_baru.php";break;
case 'Pendaftaran-Ubah':
		if (!file_exists ("pedaftaran_ubah.php")) die ("Empty Main Page!");
		include "pendaftaran_ubah.php"; break;
case 'Pendaftaran-Hapus' :
		if (!file_exists ("pendfataran_hapus.php")) die ("Empty Main Page!");
		include "pendaftaran_hapus.php"; break;
case 'Pendaftaran-Tampil':
		if (!file_exists ("pendaftaran_data.php")) die ("Empty Main Page!");
		include "pendaftaran_data.php"; break;
case 'Pencarian-Pasien' : 
		if (!file_exists ("pencarian_pasien.php")) die ("Empty Main Page!");
		include "pencarian_pasien.php"; break;
		}
}
else {
include "pendaftaran_baru.php";
}
?>

</body>
</html>
