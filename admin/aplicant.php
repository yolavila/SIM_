<?php

$id_applicant = $_GET['id_applicant'];

function getNamaBulan($bulan) {
	switch($bulan)
	{
		case 1 : return "Januari"; break;
		case 2 : return "Februari"; break;
		case 3 : return "Maret"; break;
		case 4 : return "April"; break;
		case 5 : return "Mei"; break;
		case 6 : return "Juni"; break;
		case 7 : return "Juli"; break;
		case 8 : return "Agustus"; break;
		case 9 : return "September"; break;
		case 10: return "Oktober"; break;
		case 11: return "November"; break;
		case 12: return "Desember"; break;
	}
}

function getStatus($status) {
	switch($status)
	{
		case 1 : return "buffer"; break;
		case 2 : return "terjadwal"; break;
		case 3 : return "hadir"; break;
		case 4 : return "tidak hadir"; break;
		case 5 : return "qualified"; break;
		case 5 : return "not qualified"; break;
		case 6 : return "hired"; break;
		case 7 : return "terminate"; break;
	}
}



if (!isset($_GET['id_applicant'])){
	
	//get latest number of registrant
	$sql = mysql_query("SELECT no_applicant from applicant order by no_applicant DESC");
	$no = mysql_fetch_row($sql);
?>

<h3>Data Applicant</h3>
<form method="POST" action="admin/f_simpan_add.php" enctype="multipart/form-data"><table width=98%><tr>
	<input type="hidden" name="mode" value="add"></input>
	<tr><td>No Applicant</td>	
	<td>: <input type="text" name="no_applicant" size="30" value="<?php echo $no[0]+1; ?>" readonly></input></td></tr>
	<tr><td>Nama Lengkap</td>
	<td>: <input type="text" name="nama_lengkap" size="30"></input></td></tr>
	<tr><td>Tempat Kelahiran</td>
	<!--<td>: <input type="text" name="tempat_lahir" size="30"></input></td></tr>-->
	<td>: 
		<div id="newtmplahir" style="display:none;">
			<input type="text" name="tempat_lahir_new" id="tempat_lahir_new" size="30" value=""></input>
			<a href="#" onClick="backtodropdown();">cancel</a>
		</div>
		<select id="tempat_lahir" onChange="cekTempatLahir();"><option value="0">-- silakan pilih --</option></select>		
		<img style="display:none;" id="wait-img" src="images/ajax-loader.gif" />
	</td>
	<tr><td><label for="jurl">Tanggal Lahir</label></td>
            <td class="last">:&nbsp;<select name="tgl" id="tgl" onChange="cekDouble();">
									<option value="">Tanggal</option>
									<?php
									for ($tgl=01; $tgl<=31; $tgl++)
									{
									echo "<option value=$tgl> $tgl </option>";
									}
									?>								
								</select> <img style="display:none;" id="wait-img-cek" src="images/ajax-loader.gif" /> /
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
									</select>
									<p id="errortext" style="color:red; display:none;">data dobel. Silakan isi ulang data anda</p>
								</td></tr>
	<tr><td><label for="jurl">Jenis Kelamin</label></td>
	<td>:  <select name=jenis_kelamin>
		<option value=pria>Pria</option>
		<option value=wanita>Wanita</option>
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
	<tr><td><label for="jurl">Status Perkawinan</label></td>
	<td>: <select name=status_pernikahan>
		<option value="">Pilih Status</option>
		<option value="belum menikah">Belum Menikah</option>
		<option value="menikah">Menikah</option>
		<option value="bercerai hidup">Cerai Hidup</option>
		<option value="bercerai mati">Cerai Mati</option>
	</select>
	</td></tr>
	<tr><td>Nomor Identitas</td>
	<td>: <input type="text" name="no_identitas" size="30"></input></td></tr>
	<tr><td><label for="jurl">Golongan Darah</label></td>
	<td>: <select name=gol_darah>
		<option value="">Pilih Goldar</option>
		<option value="A">A</option>
		<option value="B">B</option>
		<option value="AB">AB</option>
		<option value="O">O</option>
	</select>
	</td></tr>
	<tr><td>Alamat</td>
	<td>: <textarea type="text" name="alamat"></textarea ></td></tr>
	<tr><td>Kota</td>
	<td>: <input type="text" name="kota" size="30"></input></td></tr>
	<tr><td>No Tlp</td>
	<td>: <input type="text" name="no_tlp" size="30"></input></td></tr>
	<tr><td>Email</td>
	<td>: <input type="text" name="email" size="30"></input></td></tr>
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
	<td>: <input type="file" name="image"></td></tr>
	  </table></tr>

<input class="button" type="submit" value="Save">
<input class="button" type="reset" value="Reset">
</form>

<?php } else if (!empty( $_GET['id_applicant']) && $_GET['mode'] == "edit") {
               $id_applicant = $_GET['id_applicant']; 
               $query = mysql_query("SELECT applicant.*, dayofmonth(applicant.tgl_lahir) as tanggal, month(applicant.tgl_lahir) as bulan, year(applicant.tgl_lahir) as tahun  FROM applicant where no_applicant = '$id_applicant'") or die (mysql_error());
                if(mysql_num_rows($query) > 0){
                while($row=mysql_fetch_array($query)){ 
             
?>
                <h3>Data Applicant</h3>
                <form method="POST" action="admin/f_simpan_add.php" enctype="multipart/form-data"><table width=98%><tr>
	                <input type="hidden" name="mode" value="update"></input>
	                <tr><td>No Applicant</td>	
	                <td>: <input type="text" name="no_applicant" size="30" value="<?php echo $row['no_applicant']; ?>"></input></td></tr>
	                <tr><td>Nomor Identitas</td>
	                <td>: <input type="text" name="no_identitas" size="30" value="<?php echo $row['no_identitas']; ?>"></input></td></tr>
	                <tr><td>Nama Lengkap</td>
	                <td>: <input type="text" name="nama_lengkap" size="30" value="<?php echo $row['nama_lengkap']; ?>"></input></td></tr>
	                <tr><td>Alamat</td>
	                <td>: <textarea type="text" name="alamat"><?php echo $row['alamat']; ?></textarea ></td></tr>
	                <tr><td>Kota</td>
	                <td>: <input type="text" name="kota" size="30" value="<?php echo $row['kota']; ?>"></input></td></tr>
	                <tr><td>No Tlp</td>
	                <td>: <input type="text" name="no_tlp" size="30" value="<?php echo $row['no_tlp']; ?>"></input></td></tr>
	                <tr><td>Email</td>
	                <td>: <input type="text" name="email" size="30" value="<?php echo $row['email']; ?>"></input></td></tr>
	                <tr><td>Tempat Kelahiran</td>
	                <td>: <input type="text" name="tempat_lahir" size="30" value="<?php echo $row['tempat_lahir']; ?>"></input></td></tr>
	                <tr><td><label for="jurl">Tanggal Lahir</label></td>
                            <td class="last">:&nbsp;<select name="tgl" id="tgl" onChange="cekDouble();">
									                <option value="">Tanggal</option>
									                <?php
									                for ($tgl=01; $tgl<=31; $tgl++)
									                {
														if($tgl == $row['tanggal'])
														{
															echo "<option value=$tgl selected> $tgl </option>";
														}
														else
														{
															echo "<option value=$tgl> $tgl </option>";
														}
									                }
									                ?>
								                </select> /
									                <select name="bln" id="bln">
									                <option value="">Bulan</option>
									                <option value="1" <?php echo $row['bulan']==1 ? "selected" : ""; ?>>Januari</option>
									                <option value="2" <?php echo $row['bulan']==2 ? "selected" : ""; ?>>Februari</option>
									                <option value="3" <?php echo $row['bulan']==3 ? "selected" : ""; ?>>Maret</option>
									                <option value="4" <?php echo $row['bulan']==4 ? "selected" : ""; ?>>April</option>
									                <option value="5" <?php echo $row['bulan']==5 ? "selected" : ""; ?>>Mei</option>
									                <option value="6" <?php echo $row['bulan']==6 ? "selected" : ""; ?>>Juni</option>
									                <option value="7" <?php echo $row['bulan']==7 ? "selected" : ""; ?>>Juli</option>
									                <option value="8" <?php echo $row['bulan']==8 ? "selected" : ""; ?>>Agustus</option>
									                <option value="9" <?php echo $row['bulan']==9 ? "selected" : ""; ?>>September</option>
									                <option value="10" <?php echo $row['bulan']==10 ? "selected" : ""; ?>>Oktober</option>
									                <option value="11" <?php echo $row['bulan']==11 ? "selected" : ""; ?>>Nopember</option>
									                <option value="12" <?php echo $row['bulan']==12 ? "selected" : ""; ?>>Desember</option>
								                </select> /
										                <select name="thn" id="thn">
									                <option value="">Tahun</option>
									                <?php
									                $tahun=Date('Y');
									                for ($thn=1970; $thn<=$tahun; $thn++)
										                {
															if($row['tahun'] == $thn)
															{
																echo "<option value=$thn selected> $thn</option>";
															}
															else
															{
																echo "<option value=$thn> $thn</option>";
															}
										                }
									                ?>
									                </select></td></tr>
	                <tr><td><label for="jurl">Jenis Kelamin</label></td>
	                <td>:  <select name=jenis_kelamin>
		                <option value=pria <?php echo $row['jenis_kelamin']=="pria" ? "selected" : ""; ?>>Pria</option>
		                <option value=wanita <?php echo $row['jenis_kelamin']=="wanita" ? "selected" : ""; ?>>Wanita</option>
	                </select>
	
	                </td></tr>
	                <tr><td><label for="jurl">Status Perkawinan</label></td>
	                <td>: <select name=status_pernikahan>
		                <option value="">Pilih Status</option>
		                <option value="belum menikah" <?php echo $row['status_pernikahan']=="belum menikah" ? "selected" : ""; ?>>Belum Menikah</option>
		                <option value="menikah" <?php echo $row['status_pernikahan']=="menikah" ? "selected" : ""; ?>>Menikah</option>
		                <option value="bercerai hidup" <?php echo $row['status_pernikahan']=="bercerai hidup" ? "selected" : ""; ?>>Cerai Hidup</option>
		                <option value="bercerai mati" <?php echo $row['status_pernikahan']=="bercerai mati" ? "selected" : ""; ?>>Cerai Mati</option>
	                </select>
	                </td></tr>
	                <tr><td><label for="jurl">Agama</label></td>
	                <td>: <select name=agama>
		                <option value="">Pilih Agama</option>
		                <option value="Islam" <?php echo $row['agama']=="Islam" ? "selected" : ""; ?>>Islam</option>
		                <option value="Kristen" <?php echo $row['agama']=="Kristen" ? "selected" : ""; ?>>Kristen</option>
		                <option value="khatolik" <?php echo $row['agama']=="khatolik" ? "selected" : ""; ?>>Khatolik</option>
		                <option value="hindu" <?php echo $row['agama']=="hindu" ? "selected" : ""; ?>>Hindu</option>
		                <option value="budha" <?php echo $row['agama']=="budha" ? "selected" : ""; ?>>Budha</option>
	                </select>
	                </td></tr>
	                <tr><td><label for="jurl">Golongan Darah</label></td>
	                <td>: <select name=gol_darah>
		                <option value="">Pilih Goldar</option>
		                <option value="A" <?php echo $row['gol_darah']=="A" ? "selected" : ""; ?>>A</option>
		                <option value="B" <?php echo $row['gol_darah']=="B" ? "selected" : ""; ?>>B</option>
		                <option value="AB" <?php echo $row['gol_darah']=="AB" ? "selected" : ""; ?>>AB</option>
		                <option value="O" <?php echo $row['gol_darah']=="O" ? "selected" : ""; ?>>O</option>
	                </select>
	                </td></tr>
	                <tr><td><label for="jurl">Pendidikan Terakhir</label></td>
		                <td>: <select name=pendidikan>
		                <option value="">Pilih Pendidikan</option>
		                <option value="SMP" <?php echo $row['pendidikan']=="SMP" ? "selected" : ""; ?>>SMP</option>
		                <option value="SMA" <?php echo $row['pendidikan']=="SMA" ? "selected" : ""; ?>>SMA</option>
		                <option value="D1" <?php echo $row['pendidikan']=="D1" ? "selected" : ""; ?>>D1</option>
		                <option value="D2" <?php echo $row['pendidikan']=="D2" ? "selected" : ""; ?>>D2</option>
		                <option value="D3" <?php echo $row['pendidikan']=="D3" ? "selected" : ""; ?>>D3</option>
		                <option value="S1" <?php echo $row['pendidikan']=="S1" ? "selected" : ""; ?>>S1</option>
		                <option value="S2" <?php echo $row['pendidikan']=="S2" ? "selected" : ""; ?>>S2</option>
		                <option value="S3" <?php echo $row['pendidikan']=="S3" ? "selected" : ""; ?>>S3</option>
	                </select>
	                </td></tr>
	                <tr><td><label for="jurl">Penempatan</label></td>
		                <td>: <select name=penempatan>
		                <option value="">Pilih Penempatan</option>
		                <option value="DIY" <?php echo $row['penempatan']=="DIY" ? "selected" : ""; ?>>DIY</option>
		                <option value="Solo" <?php echo $row['penempatan']=="Solo" ? "selected" : ""; ?>>Solo</option>
		                <option value="magelang" <?php echo $row['penempatan']=="magelang" ? "selected" : ""; ?>>Magelang</option>
		                <option value="cilacap" <?php echo $row['penempatan']=="cilacap" ? "selected" : ""; ?>>Cilacap</option>
		                <option value="purwokerto" <?php echo $row['penempatan']=="purwokerto" ? "selected" : ""; ?>>Purwokerto</option>
	                </select>
	                </td></tr>
		                <tr><td><label for="jurl">Posisi</label></td>
		                <td>: <select name=posisi>
		                <option value="">Pilih Posisi</option>
		                <option value="AO" <?php echo $row['posisi']=="AO" ? "selected" : ""; ?>>Account Officer</option>
		                <option value="Admin" <?php echo $row['posisi']=="Admin" ? "selected" : ""; ?>>Administration</option>
		                <option value="frontliner" <?php echo $row['posisi']=="frontliner" ? "selected" : ""; ?>>Frontliner</option>
		                <option value="field" <?php echo $row['posisi']=="field" ? "selected" : ""; ?>>Field People</option>
	                </select>
	                </td></tr>
		                <tr><td>Uploaded Image</td>
	                <td>: <?php echo ($row['image'] != "") ? "<img src=\"uploaded_file/".$row['image']."\" width=\"50%\" alt=\"profil\"></img>" : "no image uploaded";?>
	                	<br> or you can upload new image <input type="file" name="image">
	                	<br><?php echo ($row['image'] != "") ? "or you can delete the uploaded image <input type=\"checkbox\" name=\"del_image\" value=\"1\">" : " " ;?>
	                </td></tr>
	                  </table></tr>

					<input class="button" type="submit" value="Save">
					<input class="button" type="reset" value="Reset">
					<INPUT type="button" VALUE="Kembali" onClick="history.go(-1)">
                </form>
<?php
}
}
}
elseif(!empty( $_GET['id_applicant']) && $_GET['mode'] == "view")
{
				$id_applicant = $_GET['id_applicant']; 
               $query = mysql_query("SELECT applicant.*, dayofmonth(applicant.tgl_lahir) as tanggal, month(applicant.tgl_lahir) as bulan, year(applicant.tgl_lahir) as tahun  FROM applicant where no_applicant = '$id_applicant'") or die (mysql_error());
                if(mysql_num_rows($query) > 0){
                while($row=mysql_fetch_array($query)){              
?>
                <h3>Data Applicant</h3>
                <table width=98%><tr>
	                <tr><td>No Applicant</td>	
	                <button value="edit applicant"><img src='images/edit.png' width='16' height='16' border='0'><a href='?file=adm_applicant&id_applicant=<?php echo $row['no_applicant']; ?>&mode=edit'>Edit Applicant</a></button>
	                <td>: <?php echo $row['no_applicant']; ?></td></tr>
	                <tr><td>Nomor Identitas</td>
	                <td>: <?php echo $row['no_identitas']; ?></td></tr>
	                <tr><td>Nama Lengkap</td>
	                <td>: <?php echo $row['nama_lengkap']; ?></td></tr>
	                <tr><td>Alamat</td>
	                <td>: <?php echo $row['alamat']; ?></td></tr>
	                <tr><td>Kota</td>
	                <td>: <?php echo $row['kota']; ?></td></tr>
	                <tr><td>No Tlp</td>
	                <td>: <?php echo $row['no_tlp']; ?></td></tr>
	                <tr><td>Email</td>
	                <td>: <?php echo $row['email']; ?></td></tr>
	                <tr><td>Tempat Kelahiran</td>
	                <td>: <?php echo $row['tempat_lahir']; ?></td></tr>
	                <tr><td><label for="jurl">Tanggal Lahir</label></td>
                            <td>: <?php echo $row['tanggal']." ".getNamaBulan($row['bulan'])." ".$row['tahun']; ?></td></tr>
	                <tr><td><label for="jurl">Jenis Kelamin</label></td>
	                <td>:  <?php echo $row['jenis_kelamin']; ?>
	
	                </td></tr>
	                <tr><td><label for="jurl">Status Perkawinan</label></td>
	                <td>: <?php echo $row['status_pernikahan']; ?>
	                </td></tr>
	                <tr><td><label for="jurl">Agama</label></td>
	                <td>: <?php echo $row['agama']; ?>
	                </td></tr>
	                <tr><td><label for="jurl">Golongan Darah</label></td>
	                <td>: <?php echo $row['gol_darah']; ?>
	                </td></tr>
	                <tr><td><label for="jurl">Pendidikan Terakhir</label></td>
		                <td>: <?php echo $row['pendidikan']; ?>
	                </td></tr>
	                <tr><td><label for="jurl">Penempatan</label></td>
		                <td>: <?php echo $row['penempatan']; ?>
	                </td></tr>
		                <tr><td><label for="jurl">Posisi</label></td>
		                <td>: <?php echo $row['posisi']; ?>
	                </td></tr>
		                <tr><td>Upload Image</td>
	                <td>: <?php echo ($row['image'] != "") ? "<img src=\"uploaded_file/".$row['image']."\" width=\"50%\" alt=\"profil\"></img>" : "no image uploaded";?>	                	
	                </td>
	                </tr>
	                  </table></tr>

					<INPUT type="button" VALUE="OK" onClick="history.go(-1)">
                </form>
<?php
}
}
}
?>

<script type="text/javascript">
	$(document).ready(function(){		
		$.ajax({
			url : "proses.php?mode=tempat",
			type : "POST",
			beforeSend : function(){
				$('#wait-img').show();
			},
			success : function(data){
				$('#tempat_lahir').append(data);
				$('#wait-img').hide();
			}
		});
	});

	function cekTempatLahir()
	{
		if($('#tempat_lahir').val() == 'new')
		{
			$('#tempat_lahir').hide();
			$('#newtmplahir').css('display', 'inline-block');
		}
	}

	function backtodropdown()
	{
		$('#tempat_lahir').val('0');
		$('#tempat_lahir').show();
		$('#tempat_lahir_new').val('');
		$('#newtmplahir').hide();
	}

	function resetfield()
	{
		$('#tempat_lahir').val('0');
		$('#tgl').val('0');
	}

	function cekDouble()
	{
		var tmp = $('#tempat_lahir').val();
		var tgl = $('#tgl').val();
		$.ajax({
			url : "proses.php?mode=dobel&tmp="+tmp+"&tgl="+tgl,			
			type : "GET",
			beforeSend : function(){
				$('#wait-img-cek').show();
				$('#errortext').hide();
			},
			success : function(data){				
				if(!data)
				{
					$('#errortext').css('display', 'inline-block');
					resetfield();
				}
				$('#wait-img-cek').hide();
			}
		});
	}
</script>
