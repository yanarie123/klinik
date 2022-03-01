<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Pasien.xls");
?>
	

<h2><strong>LAPORAN DATA OBAT</strong></h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="36" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td width="69" bgcolor="#CCCCCC"><div align="center"><strong>Kode</strong></div></td>
    <td width="218" bgcolor="#CCCCCC"><div align="center"><strong>Nama Obat</strong></div></td>
    <td width="147" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Harga (Rp) </strong></div></td>
    <td width="83" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Stok</strong></div></td>
    <td width="216" bgcolor="#CCCCCC"><div align="center"><strong>Keterangan</strong></div></td>
  </tr>
  <?php
  include_once "library/inc.connection.php";
  $mySql = "SELECT * FROM obat ";
  $myQry = mysql_query($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
	$nomor = 0;
  while ($myData = mysql_fetch_array ($myQry)) {
  $nomor++;
  ?> 
  
  <tr>
    <td><div align="center"><?php echo $nomor; ?></div></td>
    <td><div align="center"><?php echo $myData ['kd_obat']; ?></div></td>
    <td><?php echo $myData ['nm_obat'];?></td>
    <td algin="right"> <div align="center"><?php echo $myData ['harga_jual'];?></div></td>
    <td align="right"><div align="center"><?php echo $myData ['stok'];?> </div></td>
    <td> <div align="center"><?php echo $myData ['keterangan']; ?></div></td>
  </tr>
  <?php } ?>
  </table>
