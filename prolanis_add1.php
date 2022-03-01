<?php
include_once "library/inc.seslogin.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($_POST['txtNama'])=="") {
	$pesanError[] = "Data <b>Nama Pasien</b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbKelamin'])=="KOSONG") {
	$pesanError[] = "Data <b>Jenia Kelamin</b> belum dipilih !";
	}	
	if (trim($_POST['cmbGDarah'])=="KOSONG") {
	$pesanError[] = "Data <b>Golongan Darah</b> belum dipilih !";
	}	
	if (trim($_POST['cmbAgama'])=="KOSONG") {
	$pesanError[] = "Data <b>Agama</b> belum dipilih !";
	}	
	if (trim($_POST['txtTempatLahir'])=="") {
	$pesanError[] = "Data <b>Tempat Lahir</b> tidak boleh kosong !";
	}
	if (trim($_POST['txtAlamat'])=="") {
	$pesanError[] = "Data <b>Alamat Tinggal</b> tidak boleh kosong !";
	}
	if (trim($_POST['txtTelepon'])=="") {
	$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong !";
	}

	
	# Baca Variabel Form
	$txtNama= $_POST['txtNama'];
	$txtNoIdentitas	= $_POST['txtNoIdentitas'];
	$cmbKelamin	= $_POST['cmbKelamin'];
	$cmbGDarah= $_POST['cmbGDarah'];
	$cmbAgama= $_POST['cmbAgama'];
	$txtAlamat	= $_POST['txtAlamat'];
	$txtTelepon	= $_POST['txtTelepon'];
	$txtTempatLahir	= $_POST['txtTempatLahir'];
	
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
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database
		$tanggal	= date('Y-m-d');
		$petugas	= $_SESSION['SES_LOGIN'];
		$kodeBaru	= buatKode("skrining", "SK");
		$mySql	= "INSERT INTO skrining (nomor_sk, nm_pasien, no_identitas, jns_kelamin, 
						gol_darah, agama, tempat_lahir, tgl_kembali, 
						no_telepon, alamat, status) 
					VALUES ('$kodeBaru', '$txtNama', '$txtNoIdentitas', '$cmbKelamin', 
							'$cmbGDarah', '$cmbAgama', '$txtTempatLahir', '$tanggalLahir', 
							'$txtTelepon', '$txtAlamat', '$tanggal')"; 

		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Prolanis-Add'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# VARIABEL DATA UNTUK DIBACA FORM
$dataKode	= buatKode("skrining", "SK");
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataNoIdentitas= isset($_POST['txtNoIdentitas']) ? $_POST['txtNoIdentitas'] : '';
$dataKelamin= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : '';
$dataGDarah	= isset($_POST['cmbGDarah']) ? $_POST['cmbGDarah'] : '';
$dataAgama	= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : '';
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataTelepon= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '';
$dataStatus	= isset($_POST['txtstatus']) ? $_POST['txtstatus'] : '';

// Tempat, Tgl Lahir
$dataTempatLahir= isset($_POST['txtTempatLahir']) ? $_POST['txtTempatLahir'] : '';
$dataThn		= isset($_POST['cmbThnLahir']) ? $_POST['cmbThnLahir'] : date('Y');
$dataBln		= isset($_POST['cmbBlnLahir']) ? $_POST['cmbBlnLahir'] : date('m');
$dataTgl		= isset($_POST['cmbTglLahir']) ? $_POST['cmbTglLahir'] : date('d');
$dataTglLahir 	= $dataThn."-".$dataBln."-".$dataTgl;

?><form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="form1" target="_self">
  <table class="table-list" width="718" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">TAMBAH DATA PASIEN </th>
    </tr>
    <tr>
      <td><strong>* Wajib di isi </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="198">Kode</td>
      <td width="5">:</td>
      <td width="493"><label>
        <input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/>
      </label></td>
    </tr>
    <tr>
      <td>Nama Pasien </td>
      <td>:</td>
      <td><label>
        <input name="txtNama" type="text" id="txtNama" value="<?php echo $dataNama;?>" size="70" maxlength="100">
      *</label></td>
    </tr>
    <tr>
      <td> No. Identitas (KTP/SIM) </td>
      <td>:</td>
      <td><label>
        <input name="txtNoIdentitas" type="text" id="txtNoIdentitas" value="<?php echo $dataNoIdentitas;?>" size="40" maxlength="40">
      </label></td>
    </tr>
    <tr>
      <td>Jenis Kelamin </td>
      <td>:</td>
      <td><label>
        <select name="cmbKelamin" id="cmbKelamin">
		<option value="KOSONG"....</option>
		<?php
		$pilihan = array ("Laki-laki", "Perempuan");
		foreach ($pilihan as $nilai) {
		if ($dataKelamin==$nilai) {
			$cek =" selected";
			} else {$cek = "";}
			echo "<option value = '$nilai' $cek>$nilai </option>";
			}
			?>
        </select>
      *</label></td>
    </tr>
    <tr>
      <td>Gol. Darah </td>
      <td>:</td>
      <td><label>
        <select name="cmbGDarah" id="cmbGDarah">
		<?php
		$pilihan = array ("Kosong","A", "B", "AB", "O");
		foreach ($pilihan as $nilai) {
		if ($dataGDarah == $nilai) {
		$cek =" selected";
		} else {$cek = "";}
		echo "<option value='$nilai' $cek> $nilai </option>";
		}
		?>
	    </select>
      *</label></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td><label>
        <select name="cmbAgama" id="cmbAgama">
		<option value = "KOSONG">...</option>
		<?php
		$pilihan = array ("islam", "Kristen", "Katolik", "Buda", "Hindu");
		foreach ($pilihan as $nilai) {
		if ($dataAgama== $nilai) {
		$cek = "selected";
		} else {$cek = "";}
		echo "<option value ='$nilai' $cek>$nilai</option>";
		}
		?>
        </select>
      *</label></td>
    </tr>
    <tr>
      <td>Tempat, Tgl. Lahir </td>
      <td>:</td>
      <td><label>
        <input name="txtTempatLahir" type="text" id="txtTempatLahir" value="<?php echo $dataTempatLahir;?>" size="30" maxlength="100">
        <?php echo listTanggal ("Lahir", $dataTglLahir);?>
      *</label></td>
    </tr>
    <tr>
      <td>Alamat Tinggal </td>
      <td>:</td>
      <td><label>
        <input name="txtAlamat" type="text" id="txtAlamat" value="<?php echo $dataAlamat;?>" size="70" maxlength="200">
      *</label></td>
    </tr>
    <tr>
      <td>No. Telepon </td>
      <td>:</td>
      <td><label>
        <input name="txtTelepon" type="text" id="txtTelepon" value="<?php echo $dataTelepon;?>" size="20" maxlength="20">
      *</label></td>
    </tr>
    <tr>
      <td>Status Nikah </td>
      <td>:</td>
      <td><label>
        <select name="cmbSttsNikah" id="cmbSttsNikah">
		<option value="KOSONG">....</option>
		<?php
		$pilihan = array ("Menikah", "Belum Nikah");
		foreach ($pilihan as $nilai) {
		if ($dataSttsNikah ==$nilai) {
		$cek = " selected";
		} else { $cek = "";}
		echo "<option value='$nilai' $cek> $nilai</option>";
		}
		?>
		</select>
      *</label></td>
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