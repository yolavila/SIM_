  <script type="text/javascript">
$(function() {
$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
});

$(function() {
$('#tanggal1').datepicker({dateFormat:'yy-mm-dd'});
});
</script> 
<?php 

if($_SESSION['level'] == "admin" || $_SESSION['level'] == "manager"){
	$search = "";
	$searchOptions = $_POST['pilihan'];
	$tanggal = $_POST['tanggal'];
	$tanggal1 = $_POST['tanggal1'];
	$qWord = $_POST['data_cari'];
	$searchMode = false;
	if(isset($_POST['search']) && $qWord != "")
	{
		$search = $qWord;
		$searchMode = true;
	}
	if(isset($_POST['search']) && $qWord === "")
	{
		echo "Please, fill the search box";
	}
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

?>

<h3></h3>

<form name="form1" method="POST" action="?file=carii">
	Cari: <select name="pilihan" id="pilihan">
	<option value="buffer">Buffer</option>
	<option value="hadir">Hadir</option>
	<option value="thadir">Tidak Hadir</option>
	<option value="qualified">Qualified</option>
	<option value="tqualified">Not Qualifiend</option>
	<option value="hired">Hired</option>
	<option value="terminated">Terminated</option>
	</select></tr>
	<input name="tanggal" type="text" id="tanggal" placeholder="Mulai Tanggal"></input></td>
	<input name="tanggal1" type="text" id="tanggal1" placeholder="Sampai tanggal"></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching">
	<input name="clear" class="button" type="submit" id="clearSearch" value="Clear Search">
	</td>
	</table>
</form>
</p><br/>
<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 15%;" align="center">No Applicant</th>
	   <th style="width: 30%;" align="center">Nama Lengkap</th>
	   <th style="width: 20%;" align="center">Kantor</th>
	   <th style="width: 20%;" align="center">Cabang</th>
	   <th style="width: 15%;" align="center">Posisi</th>
	   <th style="width: 10%;" align="center">Status</th>
	   <th style="width: 10%;" align="center">Tanggal</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
		if($searchOptions == "buffer")
		{
			$query = "Select * from applicant where tanggal between '$tanggal' AND '$tanggal1'";
			echo "<center><strong>Data Applicant Buffer per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";
		}
		if($searchOptions == "hadir")
		{
			$query = "Select applicant.*, penjadwalan.jadwal as tanggal, penjadwalan.konfirmasi from applicant INNER JOIN penjadwalan on applicant.no_applicant=penjadwalan.no_applicant where konfirmasi='1' and jadwal between '$tanggal' AND '$tanggal1'";
			echo "<center><strong>Data Applicant Hadir per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";
		}
		if($searchOptions == "thadir")
		{
			$query = "Select applicant.*, penjadwalan.jadwal as tanggal, penjadwalan.konfirmasi from applicant INNER JOIN penjadwalan on applicant.no_applicant=penjadwalan.no_applicant where konfirmasi='0' and jadwal between '$tanggal' AND '$tanggal1'";
					echo "<center><strong>Data Applicant Tidak Hadir per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";

		}
			if($searchOptions == "qualified")
		{
			$query = "select applicant.*, result.* from applicant inner join result on applicant.no_applicant=result.no_applicant where hasil=1 and result.tanggal between '$tanggal' and '$tanggal1'";
					echo "<center><strong>Data Applicant Qualified per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";
		}
			if($searchOptions == "tqualified")
		{
			$query = "select applicant.*, result.* from applicant inner join result on applicant.no_applicant=result.no_applicant where hasil=0 and result.tanggal between '$tanggal' and '$tanggal1'";
					echo "<center><strong>Data Applicant Not Qualified per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";
		}
			if($searchOptions == "hired")
		{
		$query = "SELECT applicant.*, hired.kantor, hired.cabang, hired.posisi as posisi, hired.tgl_hired as tanggal from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant where status='7' and tgl_hired between '$tanggal' AND '$tanggal1'";
			echo "<center><strong>Data Kandidat Hired per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";

		}
			if($searchOptions == "terminated")
		{
		$query = "SELECT applicant.*, hired.*, terminate.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant INNER JOIN terminate on applicant.no_applicant=terminate.no_applicant where status='8' and tgl_terminate between '$tanggal' AND '$tanggal1'";
			echo "<center><strong>Data Kandidat Terminate per Tanggal $tanggal sampai $tanggal1</strong></center>";
			echo"<br/>";
		}
		if($searchOptions == "clear")
		{
		$query = "SELECT applicant.*, hired.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant where status=7";
		}		
		$sql=mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			echo "<tr>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[no_applicant]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_lengkap]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[kantor]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[cabang]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[posisi]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>".getStatus($row['status'])."</td>
					<input type=\"hidden\" id=\"status_".$row[no_applicant]."\" value=".$row['status'].">
					<td style='border:1px solid #CBF3C2;' align='center'>$row[tanggal]</td>
					</td>

		         </tr>";
			$x++;
		  }
		} else {
		  echo "<tr>
					<td colspan='5' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";
		}
	}
  ?>
   </tbody>
  
</table>
 <br />
      <br />
	     <br />
</div></div></div>