<?php 
//if($_SESSION['level'] == "admin"){
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
//}
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
</form>
