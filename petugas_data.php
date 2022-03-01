<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM petugas";
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
    <td colspan="2" align="right"><p align="center" class="style1">DATA PETUGAS </p></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Petugas-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="23"><div align="center" class="style2">No</div></th>
        <th width="209"><div align="center" class="style2">Nama Petugas </div></th>
        <th width="172"><div align="center" class="style2">No. Telepon </div></th>
        <th width="119"><div align="center" class="style2">Username</div></th>
        <th width="93"><div align="center" class="style2">Level</div></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><div align="center" class="style2">Tools</div></td>
        </tr>
      <?php
	$mySql 	= "SELECT * FROM petugas ORDER BY kd_petugas ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_petugas'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_petugas']; ?></td>
        <td align="center"><?php echo $myData['no_telepon']; ?></td>
        <td align="center"><?php echo $myData['username']; ?></td>
        <td align="center"><?php echo $myData['level']; ?></td>
        <td width="38" align="center"><a href="?page=Petugas-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"><img src="images/edit.png" width="20" height="20" border="0" /></a></td>
        <td width="46" align="center"><a href="?page=Petugas-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"><img src="images/delete.png" width="23" height="23" /></a></td>
      </tr>
      <?php } ?>
    </table>    </td>
  </tr>
  <tr class="selKecil">
    <td><span class="style5">Jumlah Data : <?php echo $jml; ?> </span></td>
    <td align="right"><span class="style5">Halaman ke : 
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Petugas-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
	</span></td>
  </tr>
</table>

