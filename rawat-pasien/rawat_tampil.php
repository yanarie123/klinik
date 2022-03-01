<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style2 {
	font-size: 16px;
	font-weight: bold;
}
.style3 {font-size: 16px}
.style5 {font-size: 24px; font-weight: bold; }
-->
</style>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="right"><h1 align="center" class="style5">DATA RAWAT PASIEN </h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="25" align="center"><span class="style1">No</span></th>
        <th width="89" align="center"><span class="style1">No. Rawat </span></th>
        <th width="85" align="center"><span class="style1">Tgl. Rawat </span></th>
        <th width="80" align="center"><span class="style1">Nomor RM  </span></th>
        <th width="116" align="center"><span class="style1">Nama Pasien </span></th>
        <th width="282" align="center"><span class="style1">Hasil Diagnosa </span></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><span class="style1">Tools</span></td>
      </tr>
      <?php
	$mySql = "SELECT rawat.*, pasien.nm_pasien
				FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				ORDER BY rawat.no_rawat DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_rawat'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td align="center"><?php echo $myData['no_rawat']; ?></td>
        <td align="center"><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
        <td align="center"><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo $myData['hasil_diagnosa']; ?></td>
        <td width="29" align="center"><a href="rawat_nota.php?nomorRawat=<?php echo $Kode; ?>" target="_blank"><img src="../images/btn_print.png" width="20" height="20" border="0" /></a></td>
        <td width="37" align="center"><a href="?page=Rawat-Hapus&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA RAWAT INI ... ?')"><img src="../images/delete.png" width="20" height="20" /></a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
    <td width="299"><span class="style2">Jumlah Data :</span></td>
    <td width="480" align="right"><span class="style3"><b>Halaman ke :</b>
   <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Rawat-Tampil&hal=$list[$h]'>$h</a> ";
	}
	?>
		   </td>
  </tr>
</table>
