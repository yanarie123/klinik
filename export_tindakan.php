<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Tindakan.xls");
?>

<h2><span class="style1">LAPORAN DATA TINDAKAN </span>
</h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="547" bgcolor="#CCCCCC"><strong>Nama Tindakan </strong></td>
    <td width="112" align="right" bgcolor="#CCCCCC"><strong>Harga (Rp.) </strong></td>
  </tr>
  <?PHP
  include_once "library/inc.connection.php"  ;
  $mySql ="SELECT * FROM tindakan";
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
    <td align="center"> <?php echo $myData ['harga'];?></td>
  </tr>
  <?php } ?>
</table>
