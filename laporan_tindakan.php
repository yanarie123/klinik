<h2><span class="style1">LAPORAN DATA TINDAKAN </span>
</h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="2" align="center" >&nbsp;</td>
    <td align="center"><a href="export_tindakan.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td width="547" bgcolor="#CCCCCC"><div align="center"><strong>Nama Tindakan </strong></div></td>
    <td width="112" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Harga (Rp.) </strong></div></td>
  </tr>
  <?PHP
  $mySql ="SELECT * FROM tindakan ORDER BY kd_tindakan ASC";
  $myQry = mysql_query ($mySql, $koneksidb)
  			or die ("Query 1 salah : ".mysql_error ());
	$nomor = 0;
	while ($myData = mysql_fetch_array ($myQry)) {
	$nomor ++;
	?> 
	
  <tr>
    <td align="center"><?php echo $nomor;?>
    <div align="center"></div></td>
    <td><?php echo $myData ['nm_tindakan'];?></td>
    <td align="center"> <?php echo format_angka ($myData ['harga']);?></td>
  </tr>
  <?php } ?>
</table>
