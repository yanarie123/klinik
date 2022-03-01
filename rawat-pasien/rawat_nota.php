<?php
include_once "../library/inc.connection.php";
include "../library/inc.library.php";
#Baca noNota dari URL
if (isset($_GET ['nomorRawat'])) {
	$nomorRawat = $_GET ['nomorRawat'];
	//Perintah untuk mendapatkan data dari tabel rawat
	$mySql = "SELECT rawat.*, petugas.nm_petugas FROM rawat
	LEFT JOIN petugas ON rawat .kd_petugas=petugas.kd_petugas
	WHERE no_rawat='$nomorRawat'";
	$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
	$kolomData = mysql_fetch_array ($myQry);
	}
	else {
	echo "Nomor Rawat (nomorRawat) tidak ditemukan ";
	exit;
	}
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Nota Rawat Pasien - Apotek & Klinik Samudra Husada Kusuma</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css"
<script type="text/javascript">
</script>
<style type="text/css">
<!--
.style1 {font-family: "Courier New", Courier, monospace}
-->
</style>
</head>
<body onLoad="window.print()">
<table width="600" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="4"><p align="center" class="style1"><strong>APOTEK &amp; KLINIK SAMUDRA HUSADA KUSUMA</strong></p>
      <p align="center" class="style1"><strong>Jl. Iskandar Muda No.15 Kota Kediri(0354 - 699958) </strong></p>
    </td>
  </tr>
  <tr>
    <td colspan="2"><span class="style1"><strong>No. Nota : <?php echo $kolomData['no_rawat']; ?> </strong></span></td>
    <td colspan="2"> <span class="style1"><?php echo IndonesiaTgl ($kolomData['tgl_rawat']);?></span> </td>
  </tr>
  <tr>
    <td width="22"><span class="style1"><strong>No</strong></span></td>
    <td width="232"><span class="style1"><strong>Daftar Tindakan </strong></span></td>
    <td width="197"><span class="style1"><strong>Dokter</strong></span></td>
    <td width="88"><div align="right" class="style1"><strong>Harga@</strong></div></td>
  </tr>
  <?php 
  #Baca Fariable
  $totalBayar = 0;
  $uangKembali= 0;
  
  #menampilkan list Item yang dibeli untuk Nomor Transaksi Terpilih
  $notaSql = "SELECT rawat_tindakan.*, tindakan.nm_tindakan, dokter.nm_dokter FROM rawat_tindakan
  				LEFT JOIN tindakan ON rawat_tindakan.kd_tindakan=tindakan.kd_tindakan
				LEFT JOIN dokter ON rawat_tindakan.kd_dokter=dokter.kd_dokter 
				WHERE rawat_tindakan.no_rawat='$nomorRawat'
				ORDER BY tindakan.kd_tindakan ASC";
	$notaQry = mysql_query ($notaSql, $koneksidb) or die ("Query list salah: ".mysql_error());
	$nomor = 0;
	while ($notaData = mysql_fetch_array ($notaQry)) {
	$nomor++;
		$totalBayar = $totalBayar + $notaData ['harga'];
		$uangKembali = $kolomData ['uang_bayar'] - $totalBayar;
	?>
	  <tr>
    <td><span class="style1"><?php echo $nomor; ?></span></td>
    <td><span class="style1"><?php echo $notaData ['kd_tindakan'] ; ?> / <?php echo $notaData ['nm_tindakan']; ?></span></td>
    <td><span class="style1"><?php echo $notaData ['nm_dokter'];?></span></td>
    <td align="right"><span class="style1"><?php echo format_angka ($notaData['harga']);?></span></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><div align="right" class="style1"><strong>Total Biaya Tindakan (Rp.) : </strong></div></td>
	 <td align="right" bgcolor="#F5F5F5"><span class="style1"><?php echo format_angka($totalBayar); ?></span></td>
  </tr>
  <tr>
    <td colspan="3"><div align="right" class="style1"><strong>Uang Bayar (Rp.) : </strong></div></td>
     <td align="right"><span class="style1"><?php echo format_angka($kolomData['uang_bayar']); ?></span></td>
  </tr>
  <tr>
   <td colspan="3" align="right">
     <span class="style1"><strong>
	 <?php 
	// membuat keterangan status Uang Kembali / Uang Hutang
	if($kolomData['uang_bayar'] < $totalBayar) {
		echo "Hutang Pasien (Rp) : ";
	}
	else {
		echo "Uang Kembali (Rp) : ";
	}; ?>
    </strong></span></td>
	  <td align="right"><span class="style1"><?php echo format_angka($uangKembali); ?></span></td>
    <td width="1">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="1">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="4"><span class="style1"><strong>Petugas :</strong> <?php echo $kolomData['nm_petugas']; ?></span></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
