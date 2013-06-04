<?php 	
	if(isset($_GET['no_applicant']) AND $_GET['no_applicant'] != "")
	{
		include "../f_connect.php";
		$no_ap = $_GET['no_applicant'];
		$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_query());
		//while ($data=mysql_fetch_array($sql)){
		if($res = mysql_num_rows($sql) == 1)
		{
			//update status applicant
			$query1=mysql_query("update applicant set status = 2 where no_applicant = '$no_ap'");
			echo 1;
			
		}
	}
	else
	{
	include "f_connect.php";
	$no_ap=$_POST['no_applicant'];
	$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_query());
		$qryi=mysql_query("SELECT * from penjadwalan where no_applicant='$no_ap' and jadwal='0000-00-00'");
		$cek_rows=mysql_num_rows($qryi);
		if ($cek_rows==0){
			echo "Data yang ada cari tidak ada atau data tersebut sudah terjadwalkan";
		}else{
					while ($data=mysql_fetch_array($sql)){
  
?>
 
  
  <div align="center"><span class="style1">TAMBAH PENJADWALAN</span><br />
    <br />
  </div>
  <table width="90%" border="0" align="center">
  <form method="post" action="../skripsi/admin/simpan_jadwal.php">
  <tr>
    <td width="26%">No Applicant</td>
    <td width="74%">:&nbsp;<input type="text" name="no" value=<?php echo $data['no_applicant'] ?>></td>
  </tr>
  <tr>
    <td valign="top">Nama Lengkap</td>
    <td>:&nbsp;<input type="text" name="nama" value=<?php echo $data['nama_lengkap'] ?>></td>
  </tr>
   <tr>
    <td>Posisi</td>
    <td>:&nbsp;<input type="text" name="posisi" value=<?php echo $data['posisi'] ?>></td>
  </tr>
   <tr>
    <td valign="top">Penempatan</td>
    <td>:&nbsp;<input type="text" name="penempatan" value=<?php echo $data['penempatan'] ?> ></td>
  </tr>
  <tr>
<tr><td><label for="jurl">Tanggal Penjadwalan</label></td>
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
									</select></td></tr>  </tr>
  <tr><td><input type="submit" value="Simpan Jadwal"/> </td></tr></form></table>
  
 <?php
 }
 }
 }
 ?>
 
  
  