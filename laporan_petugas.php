<h2> LAPORAN DATA PETUGAS </h2>
<table class="table-list" width="600" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5" align="right"><form id="form1" name="form1" method="post" action="">
      <label></label>
      <a href="export_petugas.php"></a></form>      </td>
    <td align="center"><a href="export_petugas.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><div align="center"><b>No</b></div></td>
    <td width="50" bgcolor="#CCCCCC"><div align="center"><strong>Kode</strong></div></td>
    <td width="242" bgcolor="#CCCCCC"><div align="center"><b>Nama Petugas </b></div></td>
    <td width="94" bgcolor="#CCCCCC"><div align="center"><b>No Telepon </b></div></td>
    <td width="97" bgcolor="#CCCCCC"><div align="center"><b>Username</b></div></td>
    <td width="61" bgcolor="#CCCCCC"><div align="center"><b>Level</b></div></td>
  </tr>
  <?php
	$mySql 	= "SELECT * FROM petugas ORDER BY kd_petugas";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <div align="center"><?php echo $nomor; ?> </div></td>
    <td><div align="center"><?php echo $myData['kd_petugas']; ?></div></td>
    <td> <div align="left"><?php echo $myData['nm_petugas']; ?> </div><div align="left"></div></td>
    <td> <div align="center"><?php echo $myData['no_telepon']; ?> </div></td>
    <td> <div align="center"><?php echo $myData['username']; ?> </div></td>
    <td> <div align="center"><?php echo $myData['level']; ?> </div></td>
  </tr>
  <?php } ?>
</table>
