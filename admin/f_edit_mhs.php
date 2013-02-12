<?php 

if($_SESSION['level'] == "admin"){
    include "f_connect.php";
    if($_GET['file'] == 'edit_mhs'){
  $sql=mysql_query("SELECT * from mahasiswa where id_mhs='$_GET[id_mhs]' ");
 $data=mysql_fetch_array($sql);
   
?>
 
  
  <div align="center"><span class="style1" style="font-family:trebuchet MS; color:#009900; letter-spacing:2px">PERBAHARUI DATA MAHASISWA </span><br />
    <br />
  </div>
  <table width="90%" border="0" align="center" style="font-family:trebuchet MS">
  <form method="post" action="?file=simpan_edit">
  <tr>
    <td width="19%">Username</td>
	<td width="2%">:</td>
    <td width="79%"><input type="text" name="user" value="<? echo $data['username'] ?>" /></td>
  </tr>
  <tr>
    <td>Password</td>
	<td>:</td>
    <td><input type="text" name="pass" value="<? echo $data['password'] ?>" /></td>
  </tr>
  <tr>
    <td>NIM</td>
	<td>:</td>
    <td><input type="text" name="nim_mhs" value="<? echo $data['nim_mhs'] ?>" /></td>
  </tr>
  <tr>
    <td valign="top">Nama </td>
    <td>:</td>
	<td><input type="text" name="nama_mhs" value="<? echo $data['nama_mhs'] ?>" /></td>
  </tr>
  <tr>
    <td>Angkatan </td>
	<td>:</td>
    <td><input type="text" name="ang" style="width:50px" value="<? echo $data['angkatan'] ?>" /></td>
  </tr>
  <tr>
  <td height="17"></td>
  <td></td>
  
   <tr>
    <td></td>
	<td></td>
    <td></td>
  </tr>
   <tr>
    <td colspan="3"><p>==========================================
      </p>
      </td>
	</tr>
	 <tr>
    <td>Dosen Pembimbing</td>
	<td></td>
    <td></td>
  </tr>
   <tr>
    <td>NIP</td>
	<td>:</td>
    <td><input type="text" name="nip_dsn"  /></td>
  </tr>
   <tr>
    <td>Nama Dosen</td>
	<td>:</td>
    <td><input type="text" name="nama_dsn"  /></td>
  </tr>
  <tr><td></td><td></td>
  <td><p>
    <input type="hidden" name="id_mhs" value="<?php echo $data['id_mhs'];?>" />
  </p>
    <p>
      <input name="submit" type="submit" value="Update"/> 
      <a href="?file=adm_mhs"> Back </a> </p></td>
  </tr>
  </form></table>
  
  <?php  } ?>
  
  <?php 

}elseif($_SESSION['level'] == "mahasiswa"){
    include "f_connect.php";
     $sql=mysql_query("SELECT * from mahasiswa where username='$_SESSION[username]' ");
 $data=mysql_fetch_array($sql);
   
?>

  
  <div align="center"><span class="style1" style="font-family:trebuchet MS; color:#009900; letter-spacing:2px">PROFIL MAHASISWA </span><br />
    <br />
  </div>
  <table width="90%" border="0" align="center" style="font-family:trebuchet MS">
  <form method="post" action="?file=simpan_edit">
  <tr>
    <td width="19%">Username</td>
	<td width="2%">:</td>
    <td width="79%"><input type="text" name="user" value="<? echo $data['username'] ?>" /></td>
  </tr>
  <tr>
    <td>Password</td>
	<td>:</td>
    <td><input type="text" name="pass" value="<? echo $data['password'] ?>" /></td>
  </tr>
  <tr>
    <td>NIM</td>
	<td>:</td>
    <td><input type="text" name="nim_mhs" value="<? echo $data['nim_mhs'] ?>" readonly /></td>
  </tr>
  <tr>
    <td valign="top">Nama </td>
    <td>:</td>
	<td><input type="text" name="nama_mhs" value="<? echo $data['nama_mhs'] ?>" /></td>
  </tr>
  <tr>
    <td>Angkatan </td>
	<td>:</td>
    <td><input type="text" name="ang" style="width:50px" value="<? echo $data['angkatan'] ?>" /></td>
  </tr>
  <tr>
  <td></td>
  <td></td>
  <td><input type="hidden" name="id_mhs" value="<?php echo $data['id_mhs'];?>" />
    <input name="submit" type="submit" value="Update"/> 
    </td>
  </tr></form></table>
  
  <?php  } ?>