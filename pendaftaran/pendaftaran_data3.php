<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>

<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="right"><h1 align="center"><b>DATA PENDAFTARAN </b></h1></td>
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
        <th bgcolor="#CCCCCC"width="28" align="center"><strong>No</strong></th>
        <th bgcolor="#CCCCCC"width="78"><strong>No. Daftar </strong></th>
        <th bgcolor="#CCCCCC"width="87"><strong>Tgl. Daftar </strong></th>
        <th bgcolor="#CCCCCC"width="87"><strong>Nomor RM </strong></th>
        <th bgcolor="#CCCCCC"width="174"><strong>Nama Pasien </strong></th>
        <th bgcolor="#CCCCCC"width="87"><strong>Tgl. Janji </strong></th>
        <th bgcolor="#CCCCCC"width="115"><strong>Jam. Janji </strong></th>
        <td align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				ORDER BY pendaftaran.no_daftar DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_daftar'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_daftar']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
        <td align="center"><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_janji']); ?></td>
        <td align="center"><?php echo $myData['jam_janji']; ?></td>
        <td align="center"><a href="pendaftaran_cetak.php"></a><a href="?page=Pendaftaran-Ubah&Kode=<?php echo $Kode; ?>" target="_self"></a><a href="pendaftaran_hapus.php?page=Pendaftaran-Hapus&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENDAFTARAN INI ... ?')"><img src="../images/delete.png" width="20" height="20" border="0" /></a></td>
        </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
    <td width="299"><b>Jumlah Data :</b></td>
    <td width="480" align="right"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pendaftaran-Tampil&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
