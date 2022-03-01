<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Dokter.xls");
?>

<h2>LAPORAN DATA DOKTER 
</h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="6" align="right"><a href="export_excel.php"></a></td>
  </tr>
  <tr>
    <td width="24" align="center" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td width="60" bgcolor="#CCCCCC"><div align="center"><strong>Kode</strong></div></td>
    <td width="150" bgcolor="#CCCCCC"><div align="center"><strong>Nama Dokter </strong></div></td>
    <td width="93" bgcolor="#CCCCCC"><div align="center"><strong>Spesialis</strong></div></td>
    <td width="186" bgcolor="#CCCCCC"><div align="center"><strong>Tempat, Tgl Lahir </strong></div></td>
    <td width="209" bgcolor="#CCCCCC"><div align="center"><strong>Alamat</strong></div></td>
  </tr>
  <?php 
  include_once "library/inc.connection.php";
  $mySql = "SELECT * FROM dokter";
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
    <td><div align="center"><?php echo $myData ['tempat_lahir'];?>,<?php echo $myData['tanggal_lahir'];?></div></td>
	    <td><div align="center"><?php echo $myData ['alamat'] ; ?> </div></td>
  </tr>
  <?php } ?>
</table>
