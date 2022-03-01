<?php
include_once "library/inc.seslogin.php";
$row = 20;
$hal = isset ($_GET ['hal']) ? $_GET ['hal'] : 0;
$pageSql = "SELECT * FROM dokter";
$pageQry = mysql_query ($pageSql, $koneksidb)
or die ("error paging: ".mysql_error ()); 
$jml = mysql_num_rows ($pageQry);
$max = ceil ($jml/$row);
?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style5 {font-size: 16px}
-->
</style>


<table width="742" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="3"><div align="center" class="style1">
      <p>DATA DOKTER </p>
      </div></td>
  </tr>
  <tr>
    <td colspan="3"><a href="?page=Dokter-Add"><img src="images/btn_add_data.png" width="140" height="34" border="0"></a></td>
  </tr>
  <tr>
   <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="6%" scope="col"><div align="center">No</div></th>
        <th width="23%" scope="col"><div align="center">Nama Dokter </div></th>
        <th width="12%" scope="col"><div align="center">Spesialisasi</div></th>
        <th width="12%" scope="col"><div align="center">No. Telepon </div></th>
        <th width="38%" scope="col"><div align="center">Alamat </div></th>
        <th colspan="2" scope="col"><div align="center">Tools</div></th>
        </tr>
<?php
$mySql = "SELECT * FROM dokter ORDER By kd_dokter ASC LIMIT $hal,$row";
$myQry = mysql_query ($mySql, $koneksidb)
		or die ("Query salah : ".mysql.error ());
$nomor = 0;
while ($myData = mysql_fetch_array ($myQry)) {
$nomor ++ ;
$Kode = $myData ['kd_dokter'];
?>

      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData ['nm_dokter'] ; ?></td>
        <td><?php echo $myData ['spesialisasi'] ; ?></td>
        <td><?php echo $myData ['no_telepon'] ; ?> </td>
        <td><?php echo $myData ['alamat'] ; ?></td>
        <td width="3%" align="center"><div align="center"><a href="?page=Dokter-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self"><img src="images/edit.png" width="20" height="20" border="0" /></a></div></td>
        <td width="6%" align="center"><div align="center"><a href="?page=Dokter-Delete&Kode=<?php echo $Kode;?>" target="_self" onclick="return confirm ('ANDA YAKIN AKANMENGHAPUS DATA DOKTER INI...?')"> <img src="images/delete.png" width="20" height="20" /></a></div></td>
      </tr>
<?php } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
  <tr class="selKecil">
    <td width="246"><span class="style5"><strong> Jumlah Data : </strong><?php echo $jml;?></span></td>
    <td width="481" align="right"><span class="style5"><strong>Halaman ke :</strong>
	
	
        <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Dokter-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
    </span></td>
  </tr>
</table>
