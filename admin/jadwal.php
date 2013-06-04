<?php
	//let's process search query
if($_SESSION['level'] == "admin"){
	$search_no_applicant = $_POST['no_applicant'];
	$search = $_POST['search'];
	$searchMode = false;
	if(isset($search) && $search_no_applicant != "")
	{
		$searchMode = true; //activate search mode		
	}
	
	if(isset($search) && $search_no_applicant === "")
	{
		$message = "Please, fill the search box"; //return message if search box is empty
	}
	
	if(isset($_POST['clear']))
	{
		$searchMode = false;
	}
?>
<h3>Data Penjadwalan Applicant</h3>
<form method="POST" action="?file=penjadwalan"><table width=98%><tr>	
	<tr>
	<td>
	<input type="text" name="no_applicant" size="30" placeholder="No Applicant" value="<?php echo ($searchMode) ? $search_no_applicant : "" ; ?>"></input>
	<input class="button" type="submit" value="cari" name="search">
	<input name="clear" class="button" type="submit" id="clearSearch" value="Clear Search">
	</td>
	</tr>
	<?php
		if(!empty($message))
		{
			echo "<tr><td style=\"color:red;\">". $message ."</td></tr>";
		}
	?>
	</table></tr>
</form>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 15%;" align="center">No Applicant</th>
	   <th style="width: 15%;" align="center">Tanggal Penjadwalan</th>
	   <th style="width: 25%;" align="center">Nama Lengkap</th>
	   <th style="width: 15%;" align="center">Posisi</th>
	   <th style="width: 15%;" align="center">Penempatan</th>
	   <?php
			if($_SESSION['level'] == "admin")
			{
	   ?>
	   <th style="width: 5%;" align="center"><?php echo ($searchMode) ? "STATUS" : "AKSI" ;?></th>
	   <?php
			}
	   ?>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
  		if($searchMode)
		{
			$sql = mysql_query("SELECT *, status.status as on_status from applicant LEFT JOIN penjadwalan on applicant.no_applicant = penjadwalan.no_applicant LEFT JOIN status on status.id_status = applicant.status where applicant.no_applicant = '$search_no_applicant' AND applicant.status = status.id_status") or die(mysql_error());
		}
		else 
		{			
		$sql=mysql_query("SELECT applicant.no_applicant, applicant.nama_lengkap, applicant.penempatan, applicant.posisi, penjadwalan.jadwal
FROM applicant
LEFT JOIN penjadwalan ON applicant.no_applicant = penjadwalan.no_applicant
WHERE penjadwalan.jadwal = '0000-00-00' AND applicant.status = 2");
		}
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			echo "
				<tr $row[no_applicant]>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[no_applicant]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[jadwal]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_lengkap]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[posisi]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[penempatan]</td>
			";
					if($searchMode)
					{
						echo "<td style='border:1px solid #CBF3C2;' align='center'>$row[on_status]</td>";
					}
					else
					{
					if($_SESSION['level'] == "admin"){			
			echo "
					<td style='border:1px solid #CBF3C2; width: 100%;'><center>						
					<a href='?file=proses&no_applicant=$row[0]'><img src='images/edit.png' width='16' height='16' border='0'>Proses</a>
					</td>
		         </tr>";
				 }
					}
			$x++;
		  }
		} else {
		  echo "<tr>
					<td colspan='7' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";
		}}
  ?>
   </tbody>
  
</table>
