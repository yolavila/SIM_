<?php 
include "f_connect.php";
if($_SESSION['level'] == "admin"){

?>
<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline; ">CARI KANDIDAT</p>
<br/><p>
  
 
 
 <form name="form1" method="POST" action="">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no">No Applicant</option>
	<option value="nama">Nama Applicant</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari" ></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching"></td>
	</table>
</form>
<?php
}
?>