<?php
include_once "library/inc.seslogin.php";
//Periksa ada atau tidak variabel Kode URL (alamat browser)
if (isset ($_GET ['Kode'])) {
//Hapus data sesuai Kode yang didapat di URL
$mySql = "DELETE FROM dokter 
WHERE kd_dokter ='".$_GET ['Kode']. "'";
$myQry = mysql_query ($mySql, $koneksidb)
or die ("Eror hapus data".mysql_error());
if ($myQry) {
//Refresh halaman
echo "<meta http-equiv-'refresh' content='0; url=?page=Dokter-Data'?";
}
}
else {
//Jika tidak ada Kode ditemukan di URL
echo "<b> Data yang dihapus tidak ada</b>";
}
?>
