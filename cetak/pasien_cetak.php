<?php 
//untuk membuka koneksi dan librari program
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if ($_GET) {
	//Baca Variabel URL<br />
	$NomorRM = isset ($_GET ['NomorRM']) ? $_GET ['NomorRM'] : '';
	//Perintah Membaca Data Pasien
	$mySql = "SELECT * FROM pasien WHERE nomor_rm='$NomorRM'";
	$myQry = mysql_query ($mySql, $koneksidb)
			or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array ($myQry);
	}
	else {
		echo "Nomor Rekam Medik (RM) Tidak Terbaca";
		exit;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::Cetak Pasien I Klinik & Apotek Samudra Husada Kediri</title>
<link href="../styles/styles_cetak.css" rel="styleshee" type="text/css">
</head>

<body>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>

<span class="style1">CETAK DATA PASIEN </span>
<table width="750" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td width="205">Nomor RM </td>
    <td width="6">:</td>
    <td width="517"><?php echo $myData ['nomor_rm'];?></td>
  </tr>
  <tr>
    <td>Nama Pasien </td>
    <td>:</td>
    <td><?php echo $myData ['nm_pasien'];?></td>
  </tr>
  <tr>
    <td>No. Identitas (KTP/SIM) </td>
    <td>:</td>
    <td><?php echo $myData ['no_identitas'];?></td>
  </tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td>:</td>
    <td><?php echo $myData ['jns_kelamin'];?></td>
  </tr>
  <tr>
    <td>Gol. Darah </td>
    <td>:</td>
    <td><?php echo $myData ['gol_darah'];?></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td>:</td>
    <td><?php echo $myData ['agama'];?></td>
  </tr>
  <tr>
    <td>Tempat, Tgl. Lahir </td>
    <td>:</td>
    <td><?php echo $myData ['tempat_lahir'];?>, <?php echo IndonesiaTgl ($myData ['tanggal_lahir']);?></td>
  </tr>
  <tr>
    <td>Alamat Tinggal </td>
    <td>:</td>
    <td><?php echo $myData ['alamat'];?></td>
  </tr>
  <tr>
    <td>No. Telepon </td>
    <td>:</td>
    <td><?php echo $myData ['no_telepon'];?></td>
  </tr>
  <tr>
    <td>Status Nikah </td>
    <td>:</td>
    <td><?php echo $myData ['stts_nikah'];?></td>
  </tr>
  <tr>
    <td>Pekerjaan</td>
    <td>:</td>
    <td><?php echo $myData ['pekerjaan'];?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">KELUARGA</td>
    <td bgcolor="#CCCCCC"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Status Keluarga </td>
    <td>:</td>
    <td><?php echo $myData ['stts_nikah'];?></td>
  </tr>
  <tr>
    <td>Nama Keluarga </td>
    <td>:</td>
    <td><?php echo $myData ['keluarga_nama'];?></td>
  </tr>
  <tr>
    <td>No. Telepon </td>
    <td>:</td>
    <td><?php echo $myData['keluarga_telepon']; ?></td>
	
  </tr>
</table>

</body>
</html>
