
<h2>LAPORAN DATA DOKTER 
</h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="6" align="center">&nbsp;</td>
    <td align="center" ><div align="center"><a href="export_dokter.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></div></td>
  </tr>
  <tr>
    <td width="24" align="center" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td width="60" bgcolor="#CCCCCC"><div align="center"><strong>Kode</strong></div></td>
    <td width="150" bgcolor="#CCCCCC"><div align="center"><strong>Nama Dokter </strong></div></td>
    <td width="93" bgcolor="#CCCCCC"><div align="center"><strong>Spesialis</strong></div></td>
    <td width="186" bgcolor="#CCCCCC"><div align="center"><strong>Tempat, Tgl Lahir </strong></div></td>
    <td width="209" bgcolor="#CCCCCC"><div align="center"><strong>Alamat</strong></div></td>
    <td width="42" align="center" bgcolor="#CCCCCC"><div align="center"><strong>Tools</strong></div></td>
  </tr>
  <?php 
  $mySql = "SELECT * FROM dokter ORDER BY kd_dokter ASC";
  $myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array ($myQry)) {
  $nomor++;
  ?>
  
  <tr>
    <td><div align="center"><?php echo $nomor;?></div></td>
    <td><div align="center"><?php echo $myData ['kd_dokter'];?></div></td>
    <td><?php echo $myData ['nm_dokter'];?></td>
    <td><div align="center"><?php echo $myData ['spesialisasi'];?></div></td>
    <td><div align="center"><?php echo $myData ['tempat_lahir'];?>,<?php echo IndonesiaTgl ($myData['tanggal_lahir']);?></div></td>
	    <td><div align="center"><?php echo $myData ['alamat'] ; ?> </div></td>
    <td><div align="center"><a href="cetak/dokter_cetak.php?Kode=<?php echo $myData ['kd_dokter'];?>"><img src="images/btn_print.png" width="20" height="20" border="0" /></a></div></td>
  </tr>
  <?php } ?>
</table>
