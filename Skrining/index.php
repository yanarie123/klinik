<?php
session_start();
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: SKRINING PASIEN - KLINIK DOKTER</title>
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
    <td><a href="./?page=Skrining-Baru" target="_self">Pendaftaran Baru</a> | <a href="./?page=Skrining-Data" target="_self">Tampil Pendaftaran </a></td>
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
		case 'Skrining-Baru' :
			if(!file_exists ("skrining_baru.php")) die ("Empty Main Page!"); 
			include "skrining_baru.php";	break;
		case 'Skrining-Ubah' :
			if(!file_exists ("skrining_ubah.php")) die ("Empty Main Page!"); 
			include "skrining_ubah.php";	break;
		case 'Skrining-Data' : 
			if(!file_exists ("skrining_data.php")) die ("Empty Main Page!"); 
			include "skrining_data.php";	break;
		case 'Cari-Pasien' : 
			if(!file_exists ("cari_pasien.php")) die ("Empty Main Page!"); 
			include "cari_pasien.php";	break;
		case 'Skrining-Hapus' : 
			if(!file_exists ("Skrining_hapus.php")) die ("Empty Main Page!"); 
			include "skrining_hapus.php";	break;
	}
}
else {
	include "skrining_baru.php";
}
?>
</body>
</html>
