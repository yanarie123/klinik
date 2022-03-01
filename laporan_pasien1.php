
<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);


// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT * FROM pasien WHERE Kategori='$txtKataKunci' OR nm_pasien LIKE '%$txtKataKunci%' 
				  ORDER BY nomor_rm ASC LIMIT $hal, $row";
			}
		}	
		else {
		
		} 

// Membaca variabel form
$dataKataKunci	= isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';
?>


		

		<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style></head>
<body>
	
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<p class="style1">LAPORAN DATA PASIEN</p>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table  class="table-list" width="500" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th colspan="3"><strong>CARI PASIEN </strong></th>
    </tr>
    <tr>
      <td width="139"><strong>Kategori / Nama </strong></td>
      <td width="1"><strong>:</strong></td>
      <td width="332"><b>
        <input name="txtKataKunci" type="text" value="<?php echo $dataKataKunci; ?>" size="40" maxlength="100" />
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><b>
        <input name="btnCari" type="submit" value="Cari" />
      </b></td>
    </tr>
  </table>
</form>
<table class="table-list" width="1100" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="10" align="right"><a href="export_pasienpdf.php"></a><br>
      </br></td>
    <td align="center"><a href="export_pasienpdf.php"><img src="images/excel.png" width="30" height="30" border="0"></a></td>
  <tr>
    <td width="24" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="71" align="center" bgcolor="#CCCCCC"><strong>No. RM </strong></td>
    <td width="157" align="center" bgcolor="#CCCCCC"><strong>Nama Pasien </strong></td>
    <td width="87" align="center" bgcolor="#CCCCCC"><strong>TTL</strong></td>
    <td width="59" align="center" bgcolor="#CCCCCC"><strong>Kategori</strong></td>
    <td width="129" align="center" bgcolor="#CCCCCC"><strong>No. BPJS/Pertamina </strong></td>
    <td width="80" align="center" bgcolor="#CCCCCC"><strong>No. Identitas </strong></td>
    <td width="69" align="center" bgcolor="#CCCCCC"><strong>Kelamin</strong></td>
    <td width="76" align="center" bgcolor="#CCCCCC"><strong>Pekerjaan</strong></td>
    <td width="218" align="center" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
    <td width="74" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  <?PHP
  //Query SQL ada di bagian atas, kolom tombol cari (btnCari)
  $mySql = "SELECT * FROM pasien ORDER BY nomor_rm ASC LIMIT $hal, $row";
 	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array ($myQry)) {
  $nomor++;
  ?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData ['nomor_rm'];?></td>
    <td><?php echo $myData ['nm_pasien'];?></td>
    <td><?php echo $myData ['tempat_lahir'];?><?php echo IndonesiaTgl ($myData ['tanggal_lahir']);?></td>
    <td><?php echo $myData ['Kategori'];?></td>
    <td><?php echo $myData ['no_bpjs'];?></td>
    <td><?php echo $myData ['no_identitas'];?></td>
    <td><?php echo $myData ['jns_kelamin'];?></td>
    <td><?php echo $myData ['pekerjaan'];?></td>
    <td><?php echo $myData ['alamat'];?>,</td>
    <td><div align="center"><a href="cetak/pasien_cetak.php?NomorRM=<?php echo $myData ['nomor_rm'];?>" target="_blank"><img src="images/btn_print.png" width="20" height="20" border="0" /></a></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3">&nbsp;</td>
  <td colspan="8" align="right">  </tr>
  <tr>
     <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td colspan="8" align="right"><strong>Halaman ke :</strong>
  <?php
	for ($h = 1; $h  <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo "<a href='?page=Laporan-Pasien&hal=$list[$h]'> $h</a> ";
		}
		?>  </tr>
</table>
<p class="style1">&nbsp;</p>


</body>
</html>
