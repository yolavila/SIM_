<?php


if ($_SESSION['level'] !== 'admin') {
	echo "Permision Denied!";
	exit;
}

include 'include/config.php';
include 'include/opendb.php';

?>

<h3>Data Aplicant</h3>
<form method="POST" action="../pendataan/pages/save/data_penduduk_save.php" enctype="multipart/form-data"><table width=98%><tr>
	<input type="hidden" name="mode" value="add"></input>
	<tr><td>No Aplicant</td>	
	<td>: <input type="text" name="nik" size="30"></input></td></tr>
	<tr><td>Nomor Kartu Keluarga</td>
	<td>: <input type="text" name="no_kk" size="30"></input></td></tr>
	<tr><td>Nama Lengkap</td>
	<td>: <input type="text" name="nama_lengkap" size="30"></input></td></tr>
	<tr><td>Alamat</td>
	<td>: <input type="text" name="alamat_tinggal" size="30"></input></td></tr>
	<tr><td>RT/RW</td>
	<td>: <input type="text" name="rt" size="3"></input> /
		  <input type="text" name="rw" size="3"></input> </td></tr>
	<tr><td><label for="jurl">Dusun</label></td>
	<td>: 
	<?php echo"<select name=dusun>";
	$query = "select * From table_lbl_dusun";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_dusun']."' name='id'.$x' /> ".$data['dusun']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
		<a href='../../pendataan/home.php?pages=tambah_dusun&action=add&id=$noticia[id_dusun]'  title='Tambah Dusun'><img src='images/op.png' width='18'> Tambah Dusun </a>
	</td></tr>
	<tr><td>Tempat Kelahiran</td>
	<td>: <input type="text" name="tempat_kelahiran" size="30"></input></td></tr>
	<tr><td><label for="jurl">Tanggal Lahir</label></td>
            <td class="last">:&nbsp;<select name="tgl" id="tgl">
									<option value="tgl">Tanggal</option>
									<?php
									for ($tgl=01; $tgl<=31; $tgl++)
									{
									echo "<option value=$tgl> $tgl </option>";
									}
									?>
								</select> /
									<select name="bln" id="bln">
									<option value="bln">Bulan</option>
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
									<option value="thn">Tahun</option>
									<?php
									$tahun=Date('Y');
									for ($thn=1970; $thn<=$tahun; $thn++)
										{
										echo "<option value=$thn> $thn</option>";
										}
									?>
									</select></td></tr>
	<tr><td><label for="jurl">Jenis Kelamin</label></td>
	<td>: 
	<?php echo"<select name=jenis_kelamin>";
	$query = "select * From table_jenis_kelamin";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_jeniskelamin']."' name='id'.$x' /> ".$data['jenis_kelamin']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td><label for="jurl">Hubungan Keluarga</label></td>
	<td>: 
	<?php echo"<select name=hub_keluarga>";
	$query = "select * From table_hub_keluarga";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_hub_keluarga']."' name='id'.$x' /> ".$data['hub_keluarga']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td>Anak Yang Ke-</td>
	<td>: <input type="text" name="anak_ke" size="3"></input></td></tr>
	<tr><td><label for="jurl">Status Perkawinan</label></td>
	<td>: 
	<?php echo"<select name=status_kawin>";
	$query = "select * From table_status_kawin";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_status_kawin']."' name='id'.$x' /> ".$data['status_kawin']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td><label for="jurl">Agama</label></td>
	<td>: 
	<?php echo"<select name=agama>";
	$query = "select * From table_agama";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_agama']."' name='id'.$x' /> ".$data['agama']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td><label for="jurl">Golongan Darah</label></td>
	<td>: 
	<?php echo"<select name=gol_darah>";
	$query = "select * From table_goldarah";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_goldarah']."' name='id'.$x' /> ".$data['gol_darah']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td><label for="jurl">Kewarganegaraan</label></td>
	<td>: 
	<?php echo"<select name=kewarganegaraan>";
	$query = "select * From table_kewarganegaraan";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_kewarganegaraan']."' name='id'.$x' /> ".$data['kewarganegaraan']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td>Nomor Passport</td>
	<td>: <input type="text" name="no_paspor" size="30"></input></td></tr>
	<tr><td>Nomor KITAS/KITAP</td>
	<td>: <input type="text" name="no_kitas_kitap" size="30"></input></td></tr>
	
	<tr><td><label for="jurl">kesehatan</label></td>
	<td>: 
	<?php echo"<select name=kesehatan>";
	$query = "select * From table_kesehatan";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_kesehatan']."' name='id'.$x' /> ".$data['kesehatan']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td><label for="jurl">Pendidikan</label></td>
	<td>: 
	<?php echo"<select name=pendidikan>";
	$query = "select * From table_pendidikan";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_pendidikan']."' name='id'.$x' /> ".$data['pendidikan']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td><label for="jurl">Pekerjaan</label></td>
	<td>: 
	<?php echo"<select name=pekerjaan>";
	$query = "select * From table_pekerjaan";
	$id =mysql_query ($query);
	$x=1;
	while ($data = mysql_fetch_array ($id))
	{
		echo"<option value='".$data['id_pekerjaan']."' name='id'.$x' /> ".$data['pekerjaan']."<br /></option>";
		$x++;
		}
		echo "</select>";
		?>
	</td></tr>
	<tr><td>Upload Image</td>
	<td>: <input type="file" name="fotox"/></td></tr>
	
	<tr>
	<tr><td><b>-Nama Orang Tua-</td></tr>
	<td>Nama Ibu</td>
	<td>: <input type="text" name="nama_ibu" size="30"></input></td></tr>
	<tr><td>NIK Ibu</td>
	<td>: <input type="text" name="nik_ibu" size="30"></input></td></tr>
	<tr><td>Nama Ayah</td>
	<td>: <input type="text" name="nama_ayah" size="30"></input></td></tr>
	<tr><td>NIK Ayah</td>
	<td>: <input type="text" name="nik_ayah" size="30"></input></td></tr>
	
<tr></tr>
<tr><td><b>-Jenis Status-</td></tr>	
<tr><td>Status</td>
<td>: <input type="radio" name="status" value="tetap"> Tetap
	  <input type="radio" name="status" value="pindah"> Pindah 
	  <input type="radio" name="status" value="mati"> Mati	  
	  </input></td></tr>
	  </table></tr>

<input class="button" type="submit" value="Save">
<input class="button" type="reset" value="Reset">
</form>

