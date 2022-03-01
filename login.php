<form action="?page=Login-Validasi" method="post" name="form1" target="_self" id="form1">
  <table width="500" border="1" align="center">
    <tr>
      <th width="51" rowspan="5" bgcolor="#CCCCCC" scope="col"><img src="images/login-key.png" width="150" height="97" /></th>
      <th colspan="2" bgcolor="#CCCCCC" scope="col">LOGIN SYSTEM </th>
    </tr>
    <tr>
      <td width="124">Username</td>
      <td width="303"><label>
        <input name="txtUser" type="text" id="txtUser" size="30" maxlength="20" />
      </label></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label>
        
		
		    <input name="txtPassword" type="password" size="30" maxlength="20" />
      </label></td>
    </tr>
    <!-- <tr>
      <td>Level</td>
      <td width="100"><label>
        <select name="cmbLevel" id="cmbLevel">
		<option value="KOSONG">....</option>
		<?php
		$pilihan = array ("Klinik", "Apotek", "Dokter", "Admin");
		foreach ($pilihan as $nilai) {
			if ($_POST ['cmbLevel']==$nilai) {
					$cek="selected";
			} else {$cek = "";}
			echo "<option value='$nilai' $cek>$nilai</option>";
		}
		?>
        </select>
      </label></td>
    </tr> -->
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="btnLogin" type="submit" id="btnLogin" value="Login" />
      </label></td>
    </tr>
  </table>
</form>

