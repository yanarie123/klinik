<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Rawat.xls");
?>

<h2>LAPORAN DATA RAWAT PASIEN </h2>
<table class="table-list" width="1055" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="67" bgcolor="#CCCCCC"><strong>No. Rawat </strong></td>
    <td width="74" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="140" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="78" align="right" bgcolor="#CCCCCC"><div align="left"><strong>Katagori</strong></div></td>
    <td width="76" align="right" bgcolor="#CCCCCC"><strong> Bayar (Rp) </strong></td>
    <td width="240" bgcolor="#CCCCCC"><strong>Hasil Diagnosa</strong></td>
    <td width="76" bgcolor="#CCCCCC"><div align="center"><strong>ID Dokter</strong></div></td>
    <td width="149" bgcolor="#CCCCCC"><strong>Dokter</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi rawat
	include_once "library/inc.connection.php";
	include_once "library/inc.tanggal.php";
	$mySql = "SELECT * FROM rawat
				INNER JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				INNER JOIN rawat_tindakan ON rawat.no_rawat = rawat_tindakan.no_rawat";
	
	$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
		$nomor = 0;
		while ($myData = mysql_fetch_array ($myQry)){
		$nomor ++ ;
			?>
	<tr><td align="center"><?php echo $nomor; ?></td>

    <td><?php echo $myData['no_rawat']; ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
	<td><?php echo $myData['tgl_rawat']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
	<td><?php echo $myData['Kategori']; ?></td>
	<td><?php echo $myData['uang_bayar']; ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td><?php echo $myData ['kd_dokter'];?></td>
    <td><?php 
	 $kd = $myData["kd_dokter"];
	 $ambil = "select * from dokter where kd_dokter= '$kd'";
	 $sql_dokter = mysql_query ($ambil, $koneksidb)     or die("Query failed with error: ".mysql_error());
	 while ($myDokter = mysql_fetch_array($sql_dokter)) {
	  echo $myDokter['nm_dokter']."<br>"; }?></td>
	<td width="8" align="center">&nbsp;</td>
  </tr>
  <?php } ?>
</table>
