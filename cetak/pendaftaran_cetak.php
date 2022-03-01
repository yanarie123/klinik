<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

if($_GET) {
	# Baca variabel URL
	$Kode= isset($_GET['Kode']) ?  $_GET['Kode'] : ''; 
	
	# Perintah untuk mendapatkan data dari tabel pembelian
	$mySql	= "SELECT * FROM pendaftaran WHERE no_daftar='$Kode'";
	$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Daftar Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>:: Cetak Data Dokter | Klinik & Apotek Samudara Husada Kusuma</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> CETAK DATA PENDAFTARAN </h2>
<table width="100%" cellpadding="4" cellspacing="2" class="table-list">
	<tr>
	  <td width="15%"><strong>No. Daftar </strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="84%"><?php echo $myData['no_daftar']; ?></td>
	</tr>
	<tr>
      <td><strong>Tgl. Daftar </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['tgl_daftar']; ?></td>
    </tr>
	<tr>
      <td><strong>Nomor RM </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['nomor_rm']; ?></td>
    </tr>
	<tr>
      <td><strong>Tgl. Janji </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['tgl_janji']; ?></td>
	</tr>
	<tr>
      <td><strong>Jam Janji </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['jam_janji']; ?></td>
    </tr>
		<tr>
	  <td><strong>No. Antri</strong> </td>
	  <td><strong>: </strong></td>
	  <td><?php echo $myData['nomor_antri']; ?></td>
  </tr>
</table>
</form>

