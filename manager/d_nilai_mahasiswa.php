<?php 
include "f_connect.php";
if(!$_SESSION['level'] == "dosen"){
    header('location:home.php');
} else {
?>
<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline;">MASUKAN NILAI MAHASISWA YANG DIBIMBING</p>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 8%;" align="center">NIM</th>
	   <th style="width: 25%;" align="center">NAMA</th>
	   <th style="width: 5%;" align="center">ANGKATAN</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
		$sql=mysql_query("SELECT * from mahasiswa where id_dos='$_SESSION[username]' order by nim_mhs");
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			echo "<tr $row[id_mhs]>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[nim_mhs]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_mhs]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[angkatan]</td>
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
      <br />
	     <br />
</div></div></div>
<?php } ?>