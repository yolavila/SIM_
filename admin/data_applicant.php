<?php 
include "f_connect.php";
if($_SESSION['level'] == "admin"){

?>
<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline; ">DAFTAR APPLICANT</p>
<br/><p>
  
 
 
 <form name="form1" method="POST" action="">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no">No Applicant</option>
	<option value="nama">Nama Applicant</option>
	<option value="penempatan">Penempatan</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari" ></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching"></td>
	</table>
</form>

</p><br/>

<a href='?file=adm_applicant'><img src='images/op.png' width='16' height='16' border='0'>Tambah Data Applicant</a><br/><br/>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 15%;" align="center">No Applicant</th>
	   <th style="width: 30%;" align="center">Nama Lengkap</th>
	   <th style="width: 20%;" align="center">Penempatan</th>
	   <th style="width: 20%;" align="center">Posisi</th>
	   <th style="width: 5%;" align="center">AKSI</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
		$sql=mysql_query("SELECT * from applicant");
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			echo "<tr>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[no_applicant]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_lengkap]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[penempatan]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[posisi]</td>
					<td style='border:1px solid #CBF3C2; width: 100%;'><center>
                    <a href='?file=edit_nilai&id_mhs=$row[nim_mhs]'><img src='images/det.png' width='16' height='16' border='0'></a> | 
					<a href='?file=edit_nilai&id_mhs=$row[nim_mhs]'><img src='images/edit.png' width='16' height='16' border='0'></a> |
					<a href='?file=edit_nilai&id_mhs=$row[nim_mhs]'><img src='images/del.png' width='16' height='16' border='0'></a>
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
      <br />
	     <br />
</div></div></div>
<?php  ?>

<?php 

}else{

}
