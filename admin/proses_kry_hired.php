<?php 
mysql_connect("localhost", "root", "");
mysql_select_db("sim");

	$no_ap=$_GET['no_applicant'];
	$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_query());
		while ($data=mysql_fetch_array($sql)){
  
?>
 
<script type="text/javascript">
$(function() {
$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
});
</script>
 
  <div align="center"><span class="style1"><strong>Add Hired Employee</strong></span><br />
    <br />
  </div>
  <table width="90%" border="0" align="center">
  <form method="post" action="admin/proses_kry_hired2.php">
<tr>No Applicant &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; Nama Applicant &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  Kantor &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  Cabang &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Posisi &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Tanggal Hired &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</tr>
<br>
<input text="center" type="text" border="2 px" size=10 name="no" value=<?php echo $data['no_applicant'] ?>>&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=18 name="nama" value=<?php echo $data['nama_lengkap'] ?>>&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=10 name="kantor" >&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=12 name="cabang" >&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=10 name="posisi" >&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; 
<input text="center" type="text" border="2 px" size=10 name="tanggal" id="tanggal">&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; 
<br></br>
  <tr><input type="submit" value="Save"/></tr></form>&nbsp;&nbsp;&nbsp; &nbsp;<a href='?file=kry_hiredd'><img src='images/back.jpg' width='16' height='16' border='0'>Back</a>
</table>
  
 <?php
 }
 ?>

  
  