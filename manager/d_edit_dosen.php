<?php 
if(!$_SESSION['level'] == "dosen"){
    header('location:../home.php');
} else {
    
	include "f_connect.php";
    
 	$sql=mysql_query("SELECT * from dosen where nip_dsn='$_SESSION[username]' ");
 	$data=mysql_fetch_array($sql);
   
?>
 
  
  <div align="center"><span class="style1">PERBAHARUI PROFIL DOSEN </span><br />
    <br />
</div>
  <table width="90%" border="0" align="center">
  <form method="post" action="?file=simpan_dsn">
  <tr>
    <td width="26%">NIP / Username </td>
    <td width="74%"><input type="text" name="nip_dsn" value="<? echo $data['nip_dsn'] ?>" /></td>
  </tr>
  <tr>
    <td valign="top">Nama </td>
    <td><input type="text" name="nama_dsn" value="<? echo $data['nama_dsn'] ?>" /></td>
  </tr>
   <tr>
    <td>Password</td>
    <td><input type="text" name="pass" value="<? echo $data['password'] ?>" /></td>
  </tr>
  <tr>
  <td></td>
  <td><input type="hidden" name="id_dsn" value="<?php echo $data['id_dsn'];?>" />
  <input type="submit" value="Update"/> </td></tr></form></table>
  
  <?php }  ?>