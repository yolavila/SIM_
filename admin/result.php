<?php
	$search = "";
	$qWord = $_POST['no_applicant'];
	$searchMode = false;
	if(isset($qWord) && $qWord != "")
	{
		$search = $qWord;
		$searchMode = true;
	}
	if(isset($qWord) && $qWord === "")
	{
		echo "Please, fill the search box";
	}
?>
<h3>Data Result</h3>
<form method="POST" action="?file=f_result"><table width=98%><tr>
	<input type="hidden" name="mode" value="add"></input>
	<tr>
	<td><input type="text" name="no_applicant" size="30" placeholder="No Applicant" value="<?php echo $search; ?>"></input><input class="button" type="submit" value="cari">
</td></tr>
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
	   <th style="width: 5%;" align="center">Hasil</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
		include "f_connect.php";
		$query = "SELECT applicant.no_applicant, applicant.nama_lengkap, applicant.penempatan, applicant.posisi, penjadwalan.jadwal
FROM applicant
LEFT JOIN penjadwalan ON applicant.no_applicant = penjadwalan.no_applicant
WHERE penjadwalan.jadwal !='0000-00-00' AND konfirmasi = 'Hadir' AND status < 5";
		$searchQuery = "AND applicant.no_applicant = '$search'";
		if($searchMode)
		{
			$query = $query.$searchQuery;
		}
		$sql=mysql_query($query) or die (mysql_query());
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
					<td style='border:1px solid #CBF3C2; width: 100%;'><center>"?>
					<select name='konfirm'>
					<option value=''>Pilih</option>
					<option value='5' id="Qualified" onclick="prosesResult(<?php echo $row[no_applicant]; ?>,5);">Qualified</option>
					<option value='6' id="Not Qualified" onclick="prosesResult(<?php echo $row[no_applicant]; ?>,6);">Not Qualified</option>
					</select>
					</td>
		         </tr><?php
			$x++; 
		  }
		} else {
		  echo "<tr>
					<td colspan='7' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";
		}
  ?>
   </tbody>
  
</table>

<script type="text/javascript">

function prosesResult(id,k){

    var conf = confirm("Anda Yakin Applicant tersebut Qualified?");

    if(conf == true){

         //alert("OK... you chose to proceed with deletion of "+id);
		 
		 $.ajax({
			url:"admin/result_pros.php?no_applicant="+id+"&k="+k,
			type:"GET",
			success:function(hasil)
			{
				if(hasil==1)
				{
					//alert("ok");
					window.location = "home.php?file=f_result";
				}
				else
				{
					alert(hasil);
				}
			}
		 });

    }

}

</script>