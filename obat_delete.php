<?php
include_once "library/inc.seslogin.php";
//Periksa adaatau tidak variabel Kode pada URL (alamat Browser)
if (isset ($_GET ['Kode'])) {
//Hapus data sesuai Kode yang didapat di URL
$mySql = "DELETE FROM obat WHERE kd_obat = '".$_GET ['Kode']."'";
$myQry = mysql_query ($mySql, $koneksidb)
or die ("Eror hapus data" .mysql_error());
if ($myQry) {
// Refresh Halaman
echo "<meta http-equiv='refresh' content = '0; url = ?page=Obat-Data'>";
}
}
else {
//JIka tidak ada data kode ditemukan di URL
echo "<b> Data yang dihapus tidak ada </b>";
}
?>