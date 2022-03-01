<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Pendaftaran.xls");
?>

<h2>LAPORAN DATA PENDAFTARAN </h2>
<table class="table-list" width="842" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"></div>      <div align="center"><strong>Tgl. Daftar </strong></div></td>
    <td width="75" bgcolor="#CCCCCC"><div align="center"><strong>Nomor RM </strong></div></td>
    <td width="150" bgcolor="#CCCCCC"><div align="center"><strong>Nama Pasien  </strong></div></td>
    <td width="75" bgcolor="#CCCCCC"><div align="center"><strong>Tgl. Janji </strong></div></td>
    <td width="70" bgcolor="#CCCCCC"><div align="center"><strong>Jam. Janji </strong></div></td>
    <td width="134" bgcolor="#CCCCCC"><div align="center"><strong>Tindakan</strong></div></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><div align="center"><strong>Antri</strong></div>      <div align="center"></div></td>
  </tr>
  <?php
  include_once "library/inc.connection.php";
	# Perintah untuk menampilkan Semua Daftar Transaksi pendaftaran
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$nomor = 0;
		while ($myData = mysql_fetch_array ($myQry)){
		$nomor ++ ;	
		
	?>
  <tr>
    <td><div align="center"><?php echo $nomor; ?></div></td>
    <td><div align="center"></div>      <div align="center"><?php echo $myData['tgl_daftar']; ?></div></td>
    <td><div align="center"><?php echo $myData['nomor_rm']; ?></div></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><div align="center"><?php echo $myData['tgl_janji']; ?></div></td>
    <td><div align="center"><?php echo $myData['jam_janji']; ?></div></td>
    <td><div align="center"><?php echo $myData['nm_tindakan']; ?></div></td>
    <td width="69" align="center"><div align="center"><?php echo $myData['nomor_antri']; ?></div></td>
    </tr>
  <?php } ?>
</table>
