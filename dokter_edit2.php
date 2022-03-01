<?php
include_once "library/inc.seslogin.php";


#Tombol Simpan diklik
if (isset ($_POST ['btnSimpan'])) {
$pesanError = array () ;
if (trim ($_POST ['cmbKelamin']) == "KOSONG") {
	$pesanError [] = "Data <b> Jenia Kelamin </b> tidak boleh kosong!";
}
if (trim ($_POST ['txtTempatLahir']) ==""){
	$pesanError [] = "Data <b> Tempat Lahir </b> tidak boleh kosong!";
}

if (trim ($_POST ['txtAlamat']) == ""){
	$pesanError [] = "Data <b> Alamat Tinggal </b> tidak boleh kosong!";
}

if (trim ($_POST ['txtTelepon'])=="") {
	$pesanError [] = "Data <b> No. Telepon </b> tidak boleh kosong!";
}
if (trim ($_POST ['txtSIP']) =="") {
$pesanError [] = "Data <b> Surat Izin Praktek (SIP) </b> Tidak boleh kosong!";
}
if (trim ($_POST ['txtSpesialis'])=="") {
$pesanError [] = "Data <b> Spesialis </b> tidak boleh kosong!";
}
if (trim ($_POST ['txtBagiHasil']) == "") {
	$pesanerror [] = "Data <b> Bagi Hasil </b> tidak boleh kosong!";
}


#Variabel Data Untuk diBca Form
$cekSql = "SELECT * FROM dokter WHERE nm_dokter ='$txtNama'";
$cekQry = mysql_query ($cekSql, $koneksidb)
or die ("Eror Query" .mysql_error());
if (mysql_num_rows ($cekQry)>=1) {
$pesanError [] = "Maaf, Dokter <b> $txtNama </b> sudah ada, ganti dengan yang lain";
}


	# Baca Variabel Form
	$txtNama= $_POST['txtNama'];
	$txtNoIdentitas	= $_POST['txtNoIdentitas'];
	$cmbKelamin	= $_POST['$cmbKelamin'];
	$txtTempatLahir = $_POST['txtTempatLahir'];
	$txtAlamat	= $_POST['txtAlamat'];
	$txtTelepon	= $_POST['txtTelepon'];
	$txtSip= $_POST['txtSip'];
	$txtSpesialis= $_POST['txtSpesialis'];
	$txtBagiHasil= $_POST['txtBagiHasil'];
		
	// Membaca form tanggal lahir (comboBox : tanggal, bulan dan tahun lahir)
	$cmbTglLahir= $_POST['cmbTglLahir'];
	$cmbBlnLahir= $_POST['cmbBlnLahir'];
	$cmbThnLahir= $_POST['cmbThnLahir'];
	$tanggalLahir= "$cmbThnLahir-$cmbBlnLahir-$cmbTglLahir";

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
	}
	#SKRIP SIMPAN DATA KE DATABASE
	$kodeBaru = buatKode ("dokter", "D");
	$mySql = "UPDATE dokter SET kd_dokter='$txtKode', 
								nm_dokter='$txtNama', 
								jns_kelamin='$cmbKelamin',
								tempat_lahir= '$txtTempatLahir',
								tanggal_lahir= '$tanggalLahir',
								alamat = '$txtAlamat',
								no_telepon = '$txtTelepon',
								sip = '$txtSip',
								spesialisasi ='$txtSpesialis',
								bagi_hasil= '$txtBagiHasil'
				WHERE kd_dokter ='".$_POST ['txtKode']."'";
	$myQry = mysql_query ($mysql, $koneksidb) or die ("Gagal query".mysql_error());
	if ($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?page=Dokter-Data'>";
		}
		exit; 
			
} // Penutup Tombol Simpan

	#MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode = isset ($_GET ['Kode']) ? $_GET ['Kode'] : $_POST ['txtKode'];
$mySql = "SELECT * FROM dokter WHERE kd_dokter='$Kode'";
$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array ($myQry);
	

	

$dataKode = $myData ['kd_dokter'] ;
$dataNama = isset ($_POST ['txtNama']) ? $_POST ['txtNama'] : $myData ['nm_dokter'];
$dataKelamin = isset ($_POST ['cmbKelamin']) ? $_POST ['cmbKelamin'] : $myData ['nm_dokter'];
$dataAlamat = isset ($_POST ['txtAlamat']) ? $_POST ['txtAlamat'] : $myData ['alamat'];
$dataTelepon = isset ($_POST ['txtTelepon']) ? $_POST ['txtTelepon'] : $myData ['no_telepon'];
$dataSIP = isset ($_POST ['txtSIP']) ? $_POST ['txtSIP'] : $myData ['sip'];
$dataSpesialis = isset ($_POST ['txtSpesialis']) ? $_POST ['txtSpesialis'] : $myData ['spesialisasi'];
$dataBagiHasil = isset ($_POST ['txtBagiHasil']) ? $_POST ['txtBagiHasil'] : $myData ['bagi_hasil'];
$dataTempatLahir = isset ($_POST ['txtTempatLahir']) ? $_POST ['txtTempatLahir'] :$myData ['tempat_lahir'];

// Membaca Combo Tanggal, Bulan dan Tahun
$dataThn = isset ($_POST ['cmbThnLahir']) ? $_POST ['cmbThnLahir'] : date ('Y') ;
$dataBln = isset ($_POST ['cmbBlnLahir']) ? $_POST ['cmbBlnLahir'] : date ('m');
$dataTgl = isset ($_POST ['cmbTglLahir']) ? $_POST ['cmbTglLahir'] : date ('d') ;
$dataTglLahir = $dataThn."-" .$dataBln."-" .$dataTgl;
?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="form1" target="_self">
  <table class = "table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">TAMBAH DATA DOKTER </th>
    </tr>
    <tr>
      <td width="151">Kode</td>
      <td width="4">:</td>
      <td width="473"><label>
      <input name="txtKode" type="text" id="txtKode" value="<?php echo $dataKode;?>" size="10" maxlength="10" />
      </label></td>
    </tr>
    <tr>
      <td>Nama Dokter </td>
      <td>:</td>
      <td><label>
        <input name="txtNama" type="text" id="txtNama" value="<?php echo $dataNama;?>" size="70" maxlength="100">
      </label></td>
    </tr>
    <tr>
      <td>Jenis Kelamin </td>
      <td>:</td>
      <td><label>
        <select name="cmbKelamin" id="cmbKelamin">
		<option value = "KOSONG"> .....</option>
		<?php
		$pilihan = array ("Laki-laki", "Perempuan");
		foreach ($pilihan as $nilai) {
		if ($dataKelamin==$nilai) {
		$cek="selected";
		} else { $cek = "";}
		echo "<option value ='$nilai' $cek>$nilai</option>";
		}
		?>
		</select>
      </label></td>
    </tr>
    <tr>
      <td>Tempat, Tgl. Lahir </td>
      <td>:</td>
      <td>
        <input name="txtTempatLahir" type="text" id="txtTempatLahir" value="<?php echo $dataTempatLahir;?>" size="30" maxlength="100">
      <?php echo listTanggal ("Lahir", $dataTglLahir);?>	  </td>
    </tr>
    <tr>
      <td>Alamat Tinggal </td>
      <td>:</td>
      <td><label>
        <input name="txtAlamat" type="text" id="txtAlamat" value="<?php echo $dataAlamat; ?>" size="70" maxlength="200">
      </label></td>
    </tr>
    <tr>
      <td>No.Telepon</td>
      <td>:</td>
      <td><label>
        <input name="txtTelepon" type="text" id="txtTelepon" value="<?php echo $dataTelepon;?>" size="20" maxlength="20">
      </label></td>
    </tr>
    <tr>
      <td>SIP</td>
      <td>:</td>
      <td><label>
        <input name="txtSIP" type="text" id="txtSIP" value="<?php echo $dataSIP;?>" size="60" maxlength="40">
      </label></td>
    </tr>
    <tr>
      <td>Spesialisasi</td>
      <td>:</td>
      <td><label>
        <input name="txtSpesialis" type="text" id="txtSpesialis" value="<?php echo $dataSpesialis;?>" size="60" maxlength="60">
      </label></td>
    </tr>
    <tr>
      <td>Bagi Hasil (%) </td>
      <td>:</td>
      <td><label>
        <input name="txtBagiHasil" type="text" id="txtBagiHasil" value="<?php echo $dataBagiHasil;?>" size="20" maxlength="12">
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input name="btnSimpan" type="submit" id="btnSimpan" value="SIMPAN">
      </label></td>
    </tr>
  </table>
</form>