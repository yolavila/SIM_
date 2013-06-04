<?php 
mysql_connect("localhost", "root", "");
mysql_select_db("sim");

	$no_ap=$_GET['no_applicant'];
	$sql = mysql_query("SELECT applicant.no_applicant, applicant.nama_lengkap, hired.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant where applicant.no_applicant='$no_ap'") or die (mysql_query());;
		while ($data=mysql_fetch_array($sql)){
  
?>
<script type="text/javascript">
$(function() {
$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
});
</script> 

  
  <div align="center"><span class="style1">DATA TERMINATE</span><br>
    <br>
  </div>
  <table width="90%" border="0" align="center">
  <form method="post" action="admin/simpan_terminated.php">
  <tr>
    <td width="26%">No Applicant</td>
    <td width="74%">:&nbsp;<input type="text" name="no" value=<?php echo $data['no_applicant'] ?>></td>
  </tr>
  <tr>
    <td valign="top">Nama Lengkap</td>
    <td>:&nbsp;<input type="text" name="nama" value=<?php echo $data['nama_lengkap'] ?>></td>
  </tr>
   <tr>
    <td>Kantor</td>
    <td>:&nbsp;<input type="text" name="kantor" value=<?php echo $data['kantor'] ?>></td>
  </tr>
   <tr>
    <td valign="top">Cabang</td>
    <td>:&nbsp;<input type="text" name="cabang" value=<?php echo $data['cabang'] ?> ></td>
  </tr>
    <tr>
    <td valign="top">Posisi</td>
    <td>:&nbsp;<input type="text" name="cabang" value=<?php echo $data['posisi'] ?> ></td>
  </tr>
  <tr>
<tr><td><label for="jurl">Tanggal Terminated</label></td>
            <td>:&nbsp;<input type="text" name="tanggal" id="tanggal" size="30"></td>
  <tr><td><input type="submit" value="Simpan Jadwal"/> </td></tr></form></table> &nbsp;&nbsp;&nbsp; &nbsp; <a href='?file=kry_terminate'><img src='images/back.jpg' width='16' height='16' border='0'>Back</a>

  
 <?php
 }
 ?>

  
  