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
	if (trim($_POST['cmbSttsNikah'])=="KOSONG") {
	$pesanError[] = "Data <b>Status Nikah</b> belum dipilih !";
	}
	if (trim($_POST['cmbPekerjaan'])=="KOSONG") {
	$pesanError[] = "Data <b>Pekerjaan</b> belum dipilih !";
	}
	if (trim($_POST['cmbKategori'])=="KOSONG") {
	$pesanError[] = "Data <b>Kategori</b> belum dipilih !";
	}
	
	
	# Baca Variabel Form
	$txtNama= $_POST['txtNama'];
	$txtNoIdentitas	= $_POST['txtNoIdentitas'];
	$cmbKelamin	= $_POST['cmbKelamin'];
	$cmbGDarah= $_POST['cmbGDarah'];
	$cmbAgama= $_POST['cmbAgama'];
	$txtAlamat	= $_POST['txtAlamat'];
	$txtTelepon	= $_POST['txtTelepon'];
	$cmbSttsNikah= $_POST['cmbSttsNikah'];
	$cmbPekerjaan= $_POST['cmbPekerjaan'];
	$cmbKategori= $_POST ['cmbKategori'];
	$txtNoBpjs = $_POST ['txtNoBpjs'];
	$cmbSttsKeluarga= $_POST['cmbSttsKeluarga'];
	$txtKlgNama	= $_POST['txtKlgNama'];
	$txtKlgTelepon= $_POST['txtKlgTelepon'];
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
		$kodeBaru	= buatKode("pasien", "RM");
		$mySql	= "INSERT INTO pasien (nomor_rm, nm_pasien, no_identitas, jns_kelamin, 
						gol_darah, agama, tempat_lahir, tanggal_lahir, 
						no_telepon, alamat, stts_nikah, pekerjaan, Kategori, no_bpjs,
						keluarga_status, keluarga_nama, keluarga_telepon, tgl_rekam, 
						kd_petugas) 
					VALUES ('$kodeBaru', '$txtNama', '$txtNoIdentitas', '$cmbKelamin', 
							'$cmbGDarah', '$cmbAgama', '$txtTempatLahir', '$tanggalLahir', 
							'$txtTelepon', '$txtAlamat', '$cmbSttsNikah', '$cmbPekerjaan', '$cmbKategori', '$txtNoBpjs',
							'$cmbSttsKeluarga', '$txtKlgNama', '$txtKlgTelepon', '$tanggal', '$petugas')"; 

		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Pasien-Add'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# VARIABEL DATA UNTUK DIBACA FORM
$dataKode	= buatKode("pasien", "RM");
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataNoIdentitas= isset($_POST['txtNoIdentitas']) ? $_POST['txtNoIdentitas'] : '';
$dataKelamin= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : '';
$dataGDarah	= isset($_POST['cmbGDarah']) ? $_POST['cmbGDarah'] : '';
$dataAgama	= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : '';
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataTelepon= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '';
$dataSttsNikah	= isset($_POST['cmbSttsNikah']) ? $_POST['cmbSttsNikah'] : '';
$dataPekerjaan	= isset($_POST['cmbPekerjaan']) ? $_POST['cmbPekerjaan'] : '';
$dataKategori = isset ($_POST ['cmbKatageri']) ? $_POST ['cmbKatageri'] : '';
$dataNoBpjs= isset($_POST['txtNoBpjs']) ? $_POST['txtNoBpjs'] : '';
$dataSttsKeluarga= isset($_POST['cmbSttsKeluarga']) ? $_POST['cmbSttsKeluarga'] : '';
$dataKlgNama	= isset($_POST['txtKlgNama']) ? $_POST['txtKlgNama'] : '';
$dataKlgTelepon	= isset($_POST['txtKlgTelepon']) ? $_POST['txtKlgTelepon'] : '';

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
		$pilihan = array ("Menikah", "Belum Nikah", "Cerai Hidup", "Cerai Mati");
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
      <td>Pekerjaan</td>
      <td>:</td>
      <td><label>
        <select name="cmbPekerjaan" id="cmbPekerjaan">
		<option value="KOSONG">....</option>
		<?php 
		$pilihan = array ("Pegawai Negeri Sipil (PNS)",
		"Karyawan Swasta",
		"Wiraswasta",
		"Pelajar",
		"Pensiunan",
		"IRT",
		"Belum Bekerja",
		"Guru",
		"Industri",
		"Dokter",
		"Petani",
		"Lainnya");
		foreach ($pilihan as $nilai) {
		if ($dataPekerjaan ==$nilai) {
		$cek = "selected";
		} else {$cek = "";}
		echo "<option value ='$nilai' $cek>$nilai</option>";
		}
		?>
		</select>
        *</label></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td>&nbsp;</td>
      <td><label>
        <select name="cmbKategori" id="cmbKategori">
		<option value="KOSONG">....</option>
		<?php 
		$pilihan = array ("BPJS",
		"Umum",
		"Pertamina", "Nayaka");
		foreach ($pilihan as $nilai) {
		if ($dataPekerjaan ==$nilai) {
		$cek = "selected";
		} else {$cek = "";}
		echo "<option value ='$nilai' $cek>$nilai</option>";
		}
		?>
        </select>
      No. BPJS/Pertamina 
      <input name="txtNoBpjs" type="text" id="txtNoBpjs" value="<?php echo $dataNoBpjs;?>" size="40" maxlength="20" />
      *</label></td>
    </tr>
    <tr>
    <td bgcolor="#CCCCCC"><strong> KELUARGA</strong> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>Status Keluaga </td>
      <td>:</td>
      <td><label>
        <select name="cmbSttsKeluarga" id="cmbSttsKeluarga">
		<option value = "KOSONG">....</option>
		<?php
		$pilihan = array ("Ayah", "Ibu", "Suami", "Istri", "Saudara");
		foreach ($pilihan as $nilai) {
		if ($dataSttsKeluarga ==$nilai) {
		$cek=" selected";
		} else {$cek = "";}
		echo "<option value = '$nilai' $cek> $nilai</option>";
		}
		?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Nama Keluarga </td>
      <td>:</td>
      <td><label>
        <input name="txtKlgNama" type="text" id="txtKlgNama" value="<?php echo $dataKlgNama;?>" size="70" maxlength="100">
      </label></td>
    </tr>
    <tr>
      <td>No. Telepon </td>
      <td>:</td>
      <td><label>
        <input name="txtKlgTelepon" type="text" id="txtKlgTelepon" value="<?php echo $dataKlgTelepon;?>" size="20" maxlength="20">
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