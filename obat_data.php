<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM obat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style5 {font-size: 16px; font-weight: bold; }
-->
</style>
<table width="742" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><p align="center" class="style1">DATA OBAT</p></td>
  </tr>
  <tr>
    <td width="401" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Obat-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="23" align="center"><div align="center" class="style2">No</div></th>
        <th width="60"><div align="center" class="style2">Kode</div></th>
        <th width="242"><div align="center" class="style2">Nama Obat</div></th>
        <th width="48" align="center"><div align="center" class="style2">Stok</div></th>
        <th width="98" align="right"><div align="center" class="style2">Harga (Rp)</div></th>
        <th width="193"><div align="center" class="style2">Keterangan</div></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><div align="center" class="style2">Tools</div></td>
      </tr>
	<?php
	$mySql = "SELECT * FROM obat ORDER BY kd_obat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_obat'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td align="center"><?php echo $myData['kd_obat']; ?></td>
        <td><?php echo $myData['nm_obat']; ?></td>
        <td align="center"><?php echo $myData['stok']; ?></td>
        <td align="center"><?php echo format_angka($myData['harga_jual']); ?></td>
        <td align="center"><?php echo $myData['keterangan']; ?></td>
        <td width="45" align="center"><a href="?page=Obat-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"><img src="images/edit.png" width="20" height="20" /></a></td>
        <td width="44" align="center"><a href="?page=Obat-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA OBAT INI ... ?')"><img src="images/delete.png" width="20" height="20" /></a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td><span class="style5">Jumlah Data : <?php echo $jml; ?> </span></td>
    <td align="right">
	  <span class="style5">Halaman ke : 
	  <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Obat-Data&hal=$list[$h]'>$h</a> ";
	}
	?>	
    </span></td>
  </tr>
</table>
