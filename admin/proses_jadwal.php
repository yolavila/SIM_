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

  
  <div align="center"><span class="style1">TAMBAH PENJADWALAN</span><br>
    <br>
  </div>
  <table width="90%" border="0" align="center">
  <form method="post" action="admin/simpan_jad.php">
  <tr>
    <td width="26%">No Applicant</td>
    <td width="74%">:&nbsp;<input type="text" name="no" value=<?php echo $data['no_applicant'] ?>></td>
  </tr>
  <tr>
    <td valign="top">Nama Lengkap</td>
    <td>:&nbsp;<input type="text" name="nama" value=<?php echo $data['nama_lengkap'] ?>></td>
  </tr>
   <tr>
    <td>Posisi</td>
    <td>:&nbsp;<input type="text" name="posisi" value=<?php echo $data['posisi'] ?>></td>
  </tr>
   <tr>
    <td valign="top">Penempatan</td>
    <td>:&nbsp;<input type="text" name="penempatan" value=<?php echo $data['penempatan'] ?> ></td>
  </tr>
  <tr>
<tr><td><label for="jurl">Tanggal Penjadwalan</label></td>
            <td>:&nbsp;<input type="text" name="tanggal" id="tanggal" size="30"></td>
  <tr><td><input type="submit" value="Simpan Jadwal"/> </td></tr></form></table>
  
 <?php
 }
 ?>

  
  