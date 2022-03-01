<?php
include_once "library/inc.seslogin.php";

#Deklarasi Variabel
$filterPeriode = "";
$tglAwal = "";
$tglAkhir = "";
#Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal = isset ($_POST ['txtTglAwal']) ? $_POST ['txtTglAwal'] : "01-".date('m-Y');
$tglAkhir= isset ($_POST ['txtTglAkhir']) ? $_POST ['txtTglAwal'] : date ('d-m-Y') ;
//Jika tombol filter tanggal (tampilkan) diklik
if (isset ($_POST ['btnTampil'])) {
//membuat sub SQL filter data berdasarkan 2 tanggal (periode)
$filterPeriode = "WHERE (tgl_janji BETWEEN'".InggrisTgl ($tglAwal)."' AND'".InggrisTgl ($tglAkhir)."')";
}
else {
//Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
//Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
$filterPeriode = "WHERE (tgl_janji BETWEEN '".InggrisTgl ($tglAwal)."' AND'". InggrisTgl ($tglAkhir)."')"; 
}

#NOMOR HALAMAN PAGING
$row = 50;
$hal = isset ($_GET ['hal']) ? $_GET ['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran $filterPeriode"; 
$pageQry = mysql_query ($pageSql, $koneksidb)
			or die ("error paging: ".mysql_error());
$jml = mysql_num_rows ($pageQry);
$max = ceil ($jml/$row);
?> 

<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<h2>LAPORAN DATA PENDAFTARAN PER PERIODE JANJI 
</h2>
<form action="<?php $_SERVER ['PHP_SELF'];?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>PERIODE JANJI </strong></td>
    </tr>
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="391">
	  <input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" /> s/d
      <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
	  
</form>
  <table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="7" align="center" >&nbsp;</td>
    <td align="center" ><a href="export_pendaftaran.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"></div>      <div align="center"><strong>Tgl. Daftar </strong></div></td>
    <td width="75" bgcolor="#CCCCCC"><div align="center"><strong>Nomor RM </strong></div></td>
    <td width="150" bgcolor="#CCCCCC"><div align="center"><strong>Nama Pasien </strong></div></td>
    <td width="75" bgcolor="#CCCCCC"><div align="center"><strong>Tgl. Janji </strong></div></td>
    <td width="70" bgcolor="#CCCCCC"><div align="center"><strong>Jam. Janji </strong></div></td>
    <td width="182" bgcolor="#CCCCCC"><div align="center"><strong>Tindakan</strong></div></td>
    <td width="37" align="center" bgcolor="#CCCCCC"><div align="center"><strong>Antri</strong></div></td>
  </tr>
	<?php
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran
				LEFT JOIN pasien ON pendaftaran. nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				$filterPeriode
				ORDER BY pendaftaran.no_daftar ASC LIMIT $hal, $row";
	$myQry = mysql_query ($mySql, $koneksidb)
				or die ("Query salha : ".mysql_error());
	$nomor = $hal;
	while ($myData = mysql_fetch_array ($myQry)) {
		$nomor++;
	?>
	
    <tr>
      <td><div align="center"><?php echo $nomor; ?></div></td>
      <td><div align="center"></div>        <div align="center"><?php echo IndonesiaTgl ($myData['tgl_daftar']);?></div></td>
      <td><div align="center"><?php echo $myData ['nomor_rm'];?></div></td>
      <td><?php echo $myData ['nm_pasien'];?></td>
      <td><div align="center"><?php echo IndonesiaTgl ($myData['tgl_janji']);?></div></td>
      <td><div align="center"><?php echo $myData ['jam_janji'];?> </div></td>
      <td><div align="center"><?php echo $myData ['nm_tindakan'];?> </div></td>
      <td align="center"><div align="center"><?php echo $myData['nomor_antri'];?></div></td>
    </tr>
	<?php } ?>
    <tr>
  <td colspan="2"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="6" align="right"><strong>Halaman ke :</strong>
    <?php
	  	for ($h = 1; $h <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo "<a href='?page=Laporan-Pendaftaran&hal=$list[$h] &tglAwal=$tglAwal&tglAkhir=$tglAkhir='>$h</a>";
		}
		?>    </tr>
  </table>

