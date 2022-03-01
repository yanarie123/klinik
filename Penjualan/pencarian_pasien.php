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

<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<p class="style1">Cari Pasien </p>
<form id="form1" name="form1" method="post" action="">
Cari Nama Pasien :
<label>
  <input name="txtCari" type="text" id="txtCari" value="<?php echo $dataCari;?>" size="40" maxlength="100" />
  </label>
<label>
<input name="btnCari" type="submit" id="btnCari" value="Cari" />
</label>
<table width="865" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <th width="33" bgcolor="#CCCCCC" scope="col">No</th>
    <th width="88" bgcolor="#CCCCCC"scope="col">Nomor RM </th>
    <th width="182" bgcolor="#CCCCCC" scope="col">Nama Pasien </th>
    <th width="87" bgcolor="#CCCCCC" scope="col">Kategori</th>
    <th width="69" bgcolor="#CCCCCC" scope="col">No. BPJS/Pertamina </th>
    <th width="69" bgcolor="#CCCCCC" scope="col">Kelamin</th>
    <th width="82" bgcolor="#CCCCCC" scope="col">Gol. Darah </th>
    <th width="115" bgcolor="#CCCCCC" scope="col">Alamat</th>
    <th width="63" bgcolor="#CCCCCC" scope="col">Tools</th>
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
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData ['nomor_rm'];?> </td>
    <td><?php echo $myData ['nm_pasien']; ?> </td>
    <td><?php echo $myData ['Kategori']; ?> </td>
    <td><?php echo $myData ['no_bpjs']; ?></td>
    <td><?php echo $myData ['jns_kelamin'] ; ?> </td>
    <td><?php echo $myData ['gol_darah'];?></td>
    <td><?php echo $myData ['alamat'] ; ?></td>
    <td><div align="center"><a href="?page=Penjualan-Baru&amp;NomorRM=<?php echo $myData ['nomor_rm'];?>">Pilih </a></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data : </strong></td> 
	<?php echo $jml; ?>
    <td colspan="6"><div align="right"><strong>Halaman ke</strong> : </div></td> 
	<?php  
	for ($h= 1; $h <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo "<a href='?page=Pencarian-Pasien&hal=$list[$h]
		&KeyWord=$dataCari'>$h</a> ";
		}
		?>
    </tr>
</table>
</form>

