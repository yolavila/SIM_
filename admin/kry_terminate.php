<?php 
if($_SESSION['level'] == "admin"){
	$search = "";
	$searchOptions = $_POST['pilihan'];
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
<script type="text/javascript">
$(function() {	
	$('input.tanggal').datepicker({dateFormat:'yy-mm-dd'});
});
</script> 


<h3>Terminate Employee</h3>

<form name="form1" method="POST" action="">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no" <?php echo ($searchOptions == "no" ? "selected" : ""); ?>>No Applicant</option>
	<option value="nama" <?php echo ($searchOptions == "nama" ? "selected" : ""); ?>>Nama Applicant</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari" value="<?php echo $qWord; ?>"></input></td>
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
	   <th style="width: 10%;" align="center">No Applicant</th>
	   <th style="width: 25%;" align="center">Nama Lengkap</th>
	   <th style="width: 20%;" align="center">Kantor</th>
	   <th style="width: 15%;" align="center">Cabang</th>
	   <th style="width: 15%;" align="center">Posisi</th>
	   <th style="width: 10%;" align="center">Tanggal Hired</th>
	   <?php
			if($_SESSION['level'] == "admin")
			{
	   ?>
	   <th style="width: 10%;" align="center">Tanggal Terminate</th>
	   <?php
			}
	   ?>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
			$query = "SELECT applicant.*, hired.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant where status=7";
		if($searchOptions == "no")
		{
			$query = "SELECT applicant.*, hired.*, terminate.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant LEFT JOIN terminate on applicant.no_applicant = terminate.no_applicant  where applicant.no_applicant = '$search'";
		}
		if($searchOptions == "nama")
		{
			$query = "SELECT applicant.*, hired.*, terminate.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant LEFT JOIN terminate on applicant.no_applicant = terminate.no_applicant  where applicant.nama_lengkap like '%$search%'";
		}
		if(empty($searchOptions))
		{
			$query = $query." and status = 7";
		}
		if($searchOptions == "clear")
		{
			$query = "SELECT applicant.*, hired.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant where status=7";
		}
			
		$sql=mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			$terminate = ($search != "" && $row['tgl_terminate'] != NULL) ? TRUE : FALSE ;
			echo "<tr>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[no_applicant]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_lengkap]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[kantor]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[cabang]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[posisi]</td>
			";			
			if($terminate)
			{
				echo "
						<td style='border:1px solid #CBF3C2;' align='center'>$row[tgl_hired]</td>
						<td style='border:1px solid #CBF3C2;' align='center'>$row[tgl_terminate]</td>
			         </tr>";
			}
			else
			{
				echo "
						<td style='border:1px solid #CBF3C2;' align='center'>$row[tgl_hired]</td>
						<td style='border:1px solid #CBF3C2; width: 100%;'><center>						
						<a href='?file=proses_terminate&no_applicant=$row[0]'><img src='images/edit.png' width='16' height='16' border='0'>Proses</a>
						</td>
			         </tr>";
			}
			$x++;
		  }
		} else {
			if($_SESSION['level'] == "admin"){
				echo "<tr>
					<td colspan='8' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";
			}
			else
			{
				echo "<tr>
					<td colspan='6' style='border:1px solid #CBF3C2;font-size:20px;' align='center'></td>
                    </td>
				  </tr>";
			}
		}}
  ?>
   </tbody>
  
</table>
 <br />
      <br />
	     <br />
</div></div></div>

<script type="text/javascript">
	function saveTerminate(id)
	{
		alert(id); //alert(tanggal);
		/*
		var conf = confirm("Simpan?");	
		
		if(conf == true)
		{
			$.ajax({
				url:"admin/save_terminate.php?no_applicant="+id+"&tanggal="+tanggal,
				type:"GET",
				success:function(hasil)
				{
					if(hasil==1)
					{
						alert("berhasil");
					}
					else
					{
						alert(hasil);
					}
				}
			 });
		}
		*/
	}
</script>