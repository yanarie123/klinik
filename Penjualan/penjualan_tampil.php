<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style3 {
	font-size: 16px;
	font-weight: bold;
}
.style4 {font-size: 16px}
-->
</style>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="right"><p align="center" class="style1">DATA PENJUALAN </p></td>
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
        <th width="24" align="center"><span class="style2">No</span></th>
        <th width="85"><span class="style2">No. Nota </span></th>
        <th width="86"><span class="style2">Tgl. Nota </span></th>
        <th width="144"><span class="style2">Pelanggan </span></th>
        <th width="193"><span class="style2">Keterangan</span></th>
        <th width="123"><span class="style2">Petugas</span></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><span class="style2">Tools</span></td>
      </tr>
      <?php
	$mySql = "SELECT penjualan.*, petugas.nm_petugas
				FROM penjualan 
				LEFT JOIN petugas ON penjualan.kd_petugas = petugas.kd_petugas
				ORDER BY penjualan.no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_penjualan'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td align="center"><?php echo $myData['no_penjualan']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
        <td><?php echo $myData['pelanggan']; ?></td>
        <td><?php echo $myData['keterangan']; ?></td>
        <td><?php echo $myData['nm_petugas']; ?></td>
        <td width="44" align="center"><a href="penjualan_nota.php?noNota=<?php echo $Kode; ?>" target="_blank"><img src="../images/btn_print.png" width="20" height="20" /></a></td>
        <td width="44" align="center"><a href="?page=Penjualan-Hapus&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENJUALAN INI ... ?')"><img src="../images/delete.png" width="20" height="20" /></a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
    <td width="299"><span class="style3">Jumlah Data :</span></td>
    <td width="480" align="right"><span class="style4"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Penjualan-Tampil&hal=$list[$h]'>$h</a> ";
	}
	?>
    </span></td>
  </tr>
</table>
