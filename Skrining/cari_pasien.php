<?php
include_once "../library/inc.seslogin.php";

// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
	}
}
else {
	if($KeyWord){
		$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
	}
	else {
		$filterSql = "";
	}
} 

	
	# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien $filterSql";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>

<h2>Cari Pasien</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <b>Cari Nama Pasien :<img src="../images/search.png" width="14" height="15" />
  <input name="txtCari" type="text" value="<?php echo $dataCari; ?>" size="40" maxlength="100" />
  <input name="btnCari" type="submit" value="Cari" />
  </b>
</form>

<table width="700" border="0" cellspacing="1" cellpadding="3">
 <tr>
   <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th width="33" bgcolor="#CCCCCC" scope="col"><span class="style2">No</span></th>
    <th width="88" bgcolor="#CCCCCC"scope="col"><span class="style2">Nomor RM </span></th>
    <th width="200" bgcolor="#CCCCCC" scope="col"><span class="style2">Nama Pasien </span></th>
    <th width="69" bgcolor="#CCCCCC" scope="col"><span class="style2">Kelamin</span></th>
    <th width="82" bgcolor="#CCCCCC" scope="col"><span class="style2">Gol. Darah </span></th>
    <th width="115" bgcolor="#CCCCCC" scope="col"><span class="style2">Alamat</span></th>
    <th width="63" bgcolor="#CCCCCC" scope="col"><span class="style2">Tools</span></th>
  </tr>
  <?php 
  $mySql = "SELECT * FROM pasien $filterSql ORDER BY nomor_rm ASC LIMIT $hal, $row";
  $myQry = mysql_query ($mySql, $koneksidb)
  			or die ("Query Salah : ".mysql_error ());
	$nomor = 0;
	while ($myData = mysql_fetch_array ($myQry)) {
	$nomor++;
	?>
	  
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td align="center"><?php echo $myData ['nomor_rm'];?> </td>
    <td><?php echo $myData ['nm_pasien']; ?> </td>
    <td align="center"><?php echo $myData ['jns_kelamin'] ; ?> </td>
    <td align="center"><?php echo $myData ['gol_darah'];?></td>
    <td><?php echo $myData ['alamat'] ; ?></td>
    <td><div align="center"><a href="?page=Skrining-Baru&amp;NomorRM=<?php echo $myData ['nomor_rm'];?>">Daftar </a></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="4" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td colspan="4" align="right"><strong>Halaman ke :</strong>
    <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Cari-Pasien&hal=$list[$h]&KeyWord=$dataCari'>$h</a> ";
	}
	?></td>
  </tr>
</table>
</form>

