<?php 
include "f_connect.php";
if($_SESSION['level'] == "admin"){

?>
<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline; ">PENJADWALAN USER</p>
<br/><p>
  
 
 <form name="form1" method="POST" action="">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no">No Applicant</option>
	<option value="nama">Nama Applicant</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari" ></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching"></td>
	</table></form>
	
</p><br/>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 10%;" align="center">No. Applicant</th>
	   <th style="width: 30%;" align="center">Nama</th>
	   <th style="width: 20%;" align="center">Kantor</th>
	   <th style="width: 20%;" align="center">Cabang</th>
	   <th style="width: 20%;" align="center">Posisi</th>
	   <th style="width: 10%;" align="center">Tanggal</th>
	   
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
   <?php
		$sql=mysql_query("SELECT * from mahasiswa where status='valid' order by nim_mhs");
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			echo "<tr $row[id_mhs]>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[nim_mhs]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_mhs]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[angkatan]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[username]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[password]</td>					
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[status]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[nama_dosen]</td>
                    <td style='border:1px solid #CBF3C2; width: 100%;'><center>
                    <a href='?file=edit_mhs&id_mhs=$row[id_mhs]'>edit</a>
                    <a href='?file=hapus_mhs&id_mhs=$row[id_mhs]'>delete</a>
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
  ?>
   </tbody>
   
</table>
   <br />
</div></div></div>

<?php
}
?>