<?php 
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	#Baca Variabel URL 
	$noRawat = $_GET['noRawat'];
	$mySql = "SELECT rawat.*, pasien.nm_pasien FROM rawat
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				WHERE rawat.no_rawat = '$noRawat'";
	$myQry = mysql_query ($mySql, $koneksidb) 
			or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array ($myQry);
	}
	else {
	echo "Nomor Rawat Tidak Terbaca";
	exit;
	}
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::Cetak Data Rawat Pasien per Nota I Klinik & Apotek Samudra Husada Kediri</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p class="style1">RAWAT PASIEN</p>
<p class="style1">&nbsp;</p>
<table width="500" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="132">No. Rawat </td>
    <td width="7">:</td>
    <td width="339"><?php echo $myData ['no_rawat'];?></td>
  </tr>
  <tr>
    <td>Tgl. Rawat </td>
    <td>:</td>
    <td><?php echo IndonesiaTgl ($myData ['tgl_rawat']);?></td>
  </tr>
  <tr>
    <td>Nomor RM </td>
    <td>:</td>
    <td><?php echo $myData ['nomor_rm'];?></td>
  </tr>
  <tr>
    <td>Nama Pasien </td>
    <td>:</td>
    <td><?php echo $myData ['nm_pasien'];?></td>
  </tr>
  <tr>
    <td>Diagnosa </td>
    <td>:</td>
    <td><?php echo $myData ['hasil_diagnosa'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="750" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC"><strong>DAFTAR TINDAKAN </strong></td>
  </tr>
  <tr>
    <td><div align="center">No</div></td>
    <td><div align="center">Tanggal</div></td>
    <td><div align="center">Kode</div></td>
    <td><div align="center">Nama Tindakan </div></td>
    <td><div align="center">Dokter</div></td>
  </tr>
 <?php
 //Skrip untuk mengambil data Daftar Tindakan yang diambil Pasien
 $mySql = "SELECT rawat_tindakan.*, tindakan.nm_tindakan, dokter.nm_dokter FROM rawat_tindakan
 	LEFT JOIN tindakan ON rawat_tindakan.kd_tindakan=tindakan.kd_tindakan
	LEFT JOIN dokter ON rawat_tindakan.kd_dokter=dokter.kd_dokter
	WHERE rawat_tindakan.no_rawat='$noRawat' ORDER BY id_tindakan";
$myQry = mysql_query ($mySql, $koneksidb)
	or die ("Gagal Query data Rawat ".mysql_error());
$nomor = 0;
while ($myData=mysql_fetch_array ($myQry)) {
	$nomor++;
	?>
	
  <tr>
    <td align="center"><?php echo $nomor;?></td>
    <td><?php echo IndonesiaTgl ($myData['tgl_tindakan']);?></td>
    <td><?php echo $myData ['kd_tindakan'];?></td>
    <td><?php echo $myData ['nm_tindakan'];?></td>
    <td><?php echo $myData ['nm_dokter'];?></td>
  </tr>
  <?php } ?>
</table>
<p>&nbsp;</p>
<p class="style1">&nbsp;</p>
</body>
</html>
