<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM skrining_baru";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);

?><table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="right"><h1><b>DATA SKRINING </b></h1></td>
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
        <th width="28" align="center"><strong>No</strong></th>
        <th width="78"><strong>No. Daftar </strong></th>
        <th width="87"><strong>Nomor RM </strong></th>
        <th width="180"><strong>Nama Pasien </strong></th>
        <th width="103">No. Telepon </th>
        <th width="92"><strong>Skrining II </strong></th>
        <th width="112"><strong>Status </strong></th>
		 <td width="63" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT skrining_baru.*, pasien.nm_pasien, no_telepon 
				FROM skrining_baru 
				LEFT JOIN pasien ON skrining_baru.nomor_rm = pasien.nomor_rm
				ORDER BY skrining_baru.no_sk DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_sk'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_sk']; ?></td>
        <?php
		$lanjut = $myData['tgl_daftar'];
		$sekarang=date ("Y-m-d h:i:sa");
		$date = new DateTime ($lanjut);
		$lambat		=new DateTime($sekarang);
		$diff	=$lambat->diff($date);
		?>
        <td><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo $myData['no_telepon']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
        <td><b><?php echo $diff->m." bulan"?> </b> <?php echo $diff->d." Hari"?></td>
		<td align="center"><a href="?page=Skrining-Ubah&amp;Kode=<?php echo $Kode; ?>" target="_self"></a><a href="?page=Skrining-Hapus&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENDAFTARAN INI ... ?')">Delete</a></td>
		</tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
    <td width="299"><b>Jumlah Data :</b></td>
    <td width="480" align="right"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Skrining-Data&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
