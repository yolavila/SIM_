<?php

mysql_connect("localhost", "root", "");
mysql_select_db("sim");
($_GET['file'] == 'adm_applicant');
?>

<h3>Data Applicant</h3>
<form method="POST" action="admin/f_simpan_add.php" enctype="multipart/form-data"><table width=98%><tr>
	<input type="hidden" name="mode" value="add"></input>
	<tr><td>No Applicant</td>	
	<td>: <input type="text" name="no_applicant" size="30"></input></td></tr>
	<tr><td>Nomor Identitas</td>
	<td>: <input type="text" name="no_identitas" size="30"></input></td></tr>
	<tr><td>Nama Lengkap</td>
	<td>: <input type="text" name="nama_lengkap" size="30"></input></td></tr>
	<tr><td>Alamat</td>
	<td>: <textarea type="text" name="alamat"></textarea ></td></tr>
	<tr><td>Kota</td>
	<td>: <input type="text" name="kota" size="30"></input></td></tr>
	<tr><td>No Tlp</td>
	<td>: <input type="text" name="no_tlp" size="30"></input></td></tr>
	<tr><td>Email</td>
	<td>: <input type="text" name="email" size="30"></input></td></tr>
	<tr><td>Tempat Kelahiran</td>
	<td>: <input type="text" name="tempat_lahir" size="30"></input></td></tr>
	<tr><td><label for="jurl">Tanggal Lahir</label></td>
            <td class="last">:&nbsp;<select name="tgl" id="tgl">
									<option value="">Tanggal</option>
									<?php
									for ($tgl=01; $tgl<=31; $tgl++)
									{
									echo "<option value=$tgl> $tgl </option>";
									}
									?>
								</select> /
									<select name="bln" id="bln">
									<option value="">Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">Nopember</option>
									<option value="12">Desember</option>
								</select> /
										<select name="thn" id="thn">
									<option value="">Tahun</option>
									<?php
									$tahun=Date('Y');
									for ($thn=1970; $thn<=$tahun; $thn++)
										{
										echo "<option value=$thn> $thn</option>";
										}
									?>
									</select></td></tr>
	<tr><td><label for="jurl">Jenis Kelamin</label></td>
	<td>:  <select name=jenis_kelamin>
		<option value=pria>Pria</option>
		<option value=wanita>Wanita</option>
	</select>
	
	</td></tr>
	<tr><td><label for="jurl">Status Perkawinan</label></td>
	<td>: <select name=status_pernikahan>
		<option value="">Pilih Status</option>
		<option value="belum menikah">Belum Menikah</option>
		<option value="menikah">Menikah</option>
		<option value="bercerai hidup">Cerai Hidup</option>
		<option value="bercerai mati">Cerai Mati</option>
	</select>
	</td></tr>
	<tr><td><label for="jurl">Agama</label></td>
	<td>: <select name=agama>
		<option value="">Pilih Agama</option>
		<option value="Islam">Islam</option>
		<option value="Kristen">Kristen</option>
		<option value="khatolik">Khatolik</option>
		<option value="hindu">Hindu</option>
		<option value="budha">Budha</option>
	</select>
	</td></tr>
	<tr><td><label for="jurl">Golongan Darah</label></td>
	<td>: <select name=gol_darah>
		<option value="">Pilih Goldar</option>
		<option value="A">A</option>
		<option value="B">B</option>
		<option value="AB">AB</option>
		<option value="O">O</option>
	</select>
	</td></tr>
	<tr><td><label for="jurl">Pendidikan Terakhir</label></td>
		<td>: <select name=pendidikan>
		<option value="">Pilih Pendidikan</option>
		<option value="SMP">SMP</option>
		<option value="SMA">SMA</option>
		<option value="D1">D1</option>
		<option value="D2">D2</option>
		<option value="D3">D3</option>
		<option value="S1">S1</option>
		<option value="S2">S2</option>
		<option value="S3">S3</option>
	</select>
	</td></tr>
	<tr><td><label for="jurl">Penempatan</label></td>
		<td>: <select name=penempatan>
		<option value="">Pilih Penempatan</option>
		<option value="DIY">DIY</option>
		<option value="Solo">Solo</option>
		<option value="magelang">Magelang</option>
		<option value="cilacap">Cilacap</option>
		<option value="purwokerto">Purwokerto</option>
	</select>
	</td></tr>
		<tr><td><label for="jurl">Posisi</label></td>
		<td>: <select name=posisi>
		<option value="">Pilih Posisi</option>
		<option value="AO">Account Officer</option>
		<option value="Admin">Administration</option>
		<option value="frontliner">Frontliner</option>
		<option value="field">Field People</option>
	</select>
	</td></tr>
		<tr><td>Upload Image</td>
	<td>: <input type="file" name="imaage"></td></tr>
	  </table></tr>

<input class="button" type="submit" value="Save">
<input class="button" type="reset" value="Reset">
</form>

