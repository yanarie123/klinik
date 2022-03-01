<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Petugas.xls");
?>
<h2> LAPORAN DATA PETUGAS </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><div align="center"><b>No</b></div></td>
    <td width="50" bgcolor="#CCCCCC" align="center" ><div align="center"><strong>Kode</strong></div></td>
    <td width="242" bgcolor="#CCCCCC" align="center" ><div align="center"><b>Nama Petugas </b></div></td>
    <td width="94" bgcolor="#CCCCCC" align="center" ><div align="center"><b>No Telepon </b></div></td>
    <td width="97" bgcolor="#CCCCCC" align="center" ><div align="center"><b>Username</b></div></td>
    <td width="61" bgcolor="#CCCCCC" align="center" ><div align="center"><b>Level</b></div></td>
  </tr>
  <?php
  	include_once "library/inc.connection.php";
	$mySql 	= "SELECT * FROM petugas";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_petugas']; ?></td>
    <td> <?php echo $myData['nm_petugas']; ?> </td>
    <td> <?php echo $myData['no_telepon']; ?> </td>
    <td> <?php echo $myData['username']; ?> </td>
    <td> <?php echo $myData['level']; ?> </td>
  </tr>
  <?php } ?>
</table>
