<?php 
if($_SESSION['level'] == "admin"){
	if(isset($_POST['clear']))
	{
		$searchOptions = "clear";
		$qWord = "";
	}

	function getStatus($status) {
		switch($status)
		{
			case 1 : return "buffer"; break;
			case 2 : return "terjadwal"; break;
			case 3 : return "hadir"; break;
			case 4 : return "tidak hadir"; break;
			case 5 : return "qualified"; break;
			case 6 : return "not qualified"; break;
			case 7 : return "hired"; break;
			case 8 : return "terminate"; break;
		}
	}
}
?>

<form name="form1" method="POST" action="?file=cari_penjadwalan">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no_applicant">No Applicant</option>
	<option value="nama_lengkap">Nama Applicant</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari"></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching">
	<input name="clear" class="button" type="submit" id="clearSearch" value="Clear Search">
	</td>
	</table>
</form>
<br><br/>
<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 15%;" align="center">No Applicant</th>
	   <th style="width: 30%;" align="center">Nama Lengkap</th>
	   <th style="width: 20%;" align="center">Kantor</th>
	   <th style="width: 15%;" align="center">cabang</th>
	   <th style="width: 10%;" align="center">Posisi</th>
	   <th style="width: 10%;" align="center">Tanggal</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
<?php

$warnaGenap = "#CCCCCC";   // warna abu-abu
$warnaGanjil = "#FFFFFF";  // warna putih
$warnaHeading = "#greenyellow"; // warna merah untuk heading tabel
$batas=10;
$hal=$_GET['hal'];
if(empty($hal))
{
$posisi=0;
$hal=1;
}
else
{
$posisi = ($hal-1) * $batas;
}
$pil = $_REQUEST['pilihan'];
$kunci = $_REQUEST['data_cari'];
if ($pil=="no_applicant"){
$tampil="Select jadwal_user.*, applicant.nama_lengkap from jadwal_user INNER JOIN applicant on jadwal_user.no_applicant=applicant.no_applicant where applicant.$pil=$kunci";
}else{
$tampil="Select jadwal_user.*, applicant.nama_lengkap from jadwal_user INNER JOIN applicant on jadwal_user.no_applicant=applicant.no_applicant where applicant.$pil like '%$kunci%'";
}
if(isset($_POST['clear']))
{
	$tampil="Select jadwal_user.*, applicant.nama_lengkap from jadwal_user INNER JOIN applicant on jadwal_user.no_applicant=applicant.no_applicant where applicant.$pil like '%$kunci%' LIMIT 0";
}
$hasil=mysql_query($tampil);
$no=$posisi+1;
if(mysql_num_rows($hasil) > 0){
while ($data=mysql_fetch_array($hasil)){
if ($no % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
echo "<tr bgcolor='".$warna."' >";
echo "<td style=' padding-left:5px; font-size:12px;'>$no</td>";
echo "<td style='border:1px solid #CBF3C2;' align='center'>$data[no_applicant]</td>";
echo "<td style='border:1px solid #CBF3C2;' align='center'>$data[nama_lengkap]</td>";
echo "<td style='border:1px solid #CBF3C2;' align='center'>$data[kantor]</td>";
echo "<td style='border:1px solid #CBF3C2;' align='center'>$data[cabang]</td>";
echo "<td style='border:1px solid #CBF3C2;' align='center'>$data[posisi]</td>";
echo "<td style='border:1px solid #CBF3C2;' align='center'>$data[tanggal_pengiriman]</td>";
echo "</tr>";
$no++;

}
}else{
		  echo "<tr>
					<td colspan='7' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";

}
echo "</table><br>";

?>
