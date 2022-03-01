<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

$row = 50;
$hal = isset ($_GET['hal']) ? $_GET ['hal']:0;
$pageSql = "SELECT * FROM tindakan " ;
$pageQry = mysql_query ($pageSql, $koneksidb) or die ("error : ".mysql_error());
$jml = mysql_num_rows ($pageQry);
$max = ceil ($jml/$row);
?>


<style type="text/css">
<!--
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style5 {font-size: 16px; font-weight: bold; }
-->
</style>
<table width="742" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2"><div align="center" class="style2">
      <p>DATA TINDAKAN </p>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Tindakan-Add"><img src="images/btn_add_data.png" width="140" height="34" border="0"></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list"  width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <th width="45" scope="col"><div align="center"><strong>No</strong></div></th>
        <th width="406" scope="col"><div align="center">Nama Tindakan </div></th>
        <th width="152" scope="col"><div align="center">Harga</div></th>
        <th colspan="2" scope="col"><div align="center">Tools</div></th>
        </tr>
		<?php
		//Menampilkan daftar tindakan
		$mySql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC LIMIT $hal, $row";
		$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".msql_error());
		$nomor = 0;
		while ($myData = mysql_fetch_array ($myQry)) {
		$nomor ++;
		$Kode = $myData ['kd_tindakan'];
		?>
      <tr>
        <td align="center"><?php echo $nomor; ?>
          <div align="center"></div></td>
        <td><?php echo $myData ['nm_tindakan']; ?></td>
        <td align="center"><?php echo format_angka ($myData['harga']); ?></td>
        <td width= "52" align = "center"> <a href="?page=Tindakan-Edit&Kode=<?php echo $Kode;?>" target="_self"><img src="images/edit.png" width="20" height="20" /></a></td>
        <td width= "43" align = "center"> <a href="?page=Tindakan-Delete&Kode=<?php echo $Kode;?>" target="_self" onclick="return confirm ('ANDA YAKIN MENGHAPUS DATA TINDAKAN INI...?')"><img src="images/delete.png" width="20" height="20" /></a></td>
      </tr>
	  <?php } ?>
    </table></td>
  </tr>
  
  <tr>
    <td width="428"><span class="style5">Jumlah Data : </strong><?php echo $jml; ?> </span></td>
    <td width="257"><span class="style5">Halaman ke : </strong>
      <?php 
	for ($h = 1; $h <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo " <a href='?page=Tindakan-Data&hal=$list[$h]'>$h</a>";
		}
		?>
	</span></td>
  </tr>
</table>
