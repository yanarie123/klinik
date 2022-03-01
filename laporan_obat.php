<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM obat";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
	

<h2><strong>LAPORAN DATA OBAT</strong></h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5" >&nbsp;</td>
    <td align="right" ><a href="export_obat.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="20" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td width="55" bgcolor="#CCCCCC"><div align="center"><strong>Kode</strong></div></td>
    <td width="248" bgcolor="#CCCCCC"><div align="center"><strong>Nama Obat</strong></div></td>
    <td width="147" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Harga (Rp) </strong></div></td>
    <td width="83" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Stok</strong></div></td>
    <td width="216" bgcolor="#CCCCCC"><div align="center"><strong>Keterangan</strong></div></td>
  </tr>
  <?php
  $mySql = "SELECT * FROM obat ORDER BY kd_obat ASC LIMIT $hal, $row";
  $myQry = mysql_query($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
  $nomor = $hal;
  while ($myData = mysql_fetch_array ($myQry)) {
  $nomor++;
  ?> 
  
  <tr>
    <td><div align="center"><?php echo $nomor; ?></div></td>
    <td><div align="center"><?php echo $myData ['kd_obat']; ?></div></td>
    <td><?php echo $myData ['nm_obat'];?></td>
    <td algin="right"> <div align="center"><?php echo format_angka ($myData ['harga_jual']);?></div></td>
    <td align="right"><div align="center"><?php echo $myData ['stok'];?> </div></td>
    <td> <div align="center"><?php echo $myData ['keterangan']; ?></div></td>
  </tr>
  <?php } ?>
  <tr>
     <td colspan="3" bgcolor="#CCCCCC"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td colspan="3" align="right" bgcolor="#CCCCCC">
	<strong>Halaman ke :</strong>
  <?php
	for ($h = 1; $h <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Obat&hal=$list[$h]'>$h</a>";
		}
		?>  </tr>
</table>
<p>&nbsp; </p>
