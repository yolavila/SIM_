<?php

mysql_connect("localhost", "root", "");
mysql_select_db("sim");
?>


<h3>Data Result</h3>
<form method="POST" action="?file=add_jadwal" enctype="multipart/form-data"><table width=98%><tr>
	<input type="hidden" name="mode" value="add"></input>
	<tr>
	<td><input type="text" name="no_applicant" size="30" placeholder="No Applicant"></input><input class="button" type="submit" value="cari">
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
		$sql=mysql_query("SELECT applicant.no_applicant, applicant.nama_lengkap, applicant.penempatan, applicant.posisi, penjadwalan.jadwal
FROM applicant
LEFT JOIN penjadwalan ON applicant.no_applicant = penjadwalan.no_applicant
WHERE penjadwalan.jadwal !='0000-00-00' AND konfirmasi = 'Hadir'");
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
					<option value='5' id=Qualified onclick="prosesResult(<?php echo $row[no_applicant]; ?>);">Qualified</option>
					<option value='6' id="Not Qualified" onclick="document.location='?file=proses_result'">Non Qualified</option>
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

function prosesResult(id){

    var conf = confirm("Anda Yakin Applicant tersebut Qualified?");

    if(conf == true){

         //alert("OK... you chose to proceed with deletion of "+id);
		 
		 $.ajax({
			url:"admin/result_pros.php?no_applicant="+id,
			type:"GET",
			success:function(hasil)
			{
				if(hasil==1)
				{
					//alert("ok");
					window.location = "http://localhost/skripsi/home.php?file=f_result";
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