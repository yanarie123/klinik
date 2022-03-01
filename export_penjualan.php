<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Penjualan.xls");
?>

<h2>LAPORAN PENJUALAN OBAT</h2>
<table class="table-list" width="820" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="30" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="87" bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
    <td width="125" bgcolor="#CCCCCC"><strong>No. Penjualan </strong></td>
    <td width="178" bgcolor="#CCCCCC"><strong>Pelanggan </strong></td>
    <td width="105" bgcolor="#CCCCCC"><strong>Keterangan </strong></td>
    <td width="264" align="center" bgcolor="#CCCCCC"><strong>Dokter</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan

			
				include_once "library/inc.connection.php";
	$mySql = "SELECT penjualan.* FROM penjualan";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['tgl_penjualan']; ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['pelanggan']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td align="center"><?php echo $myData['nm_dokter']; ?></td>
  </tr>
  <?php } ?>
  
</table>
