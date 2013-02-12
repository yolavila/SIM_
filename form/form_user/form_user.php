<?php
	$action="new";
	$status="Simpan";
	$readonly="";
	$username="";
	$password="";
	$admin="";
	$usp="";
	$toko="";
	$anggota="";
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['username']))
	{
		include("../../db_config.php");
		$n = $_GET['username'];
		$str="select * from user where username='$n'";
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$username=$data['username'];
		$admin=$data['admin'];
		$ketua=$data['ketua'];
		$usp=$data['usp'];
		$toko=$data['toko'];
		$anggota=$data['anggota'];
		$action="update";
		$simpan=$action;
		$readonly="readonly=readonly";
	}
?>
<script type="text/javascript">
$(function(){
	$("#formUser").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){
				if(data==1)
				{
					window.location = "user.php"
				}
				else
				{
					alert(data);
				}
			}
		});
		return false;
	});
})
</script>

<!--
	jika menambahkan instansi baru, maka
	form inilah yang akan dipanggil.
	ingat action pada proses.php. apabila diganti
	pastikan lokasi file benar.
-->

<form method="post" name="formUser" action="proses_user.php" id="formUser">
<table width="700">
<tr>
<td colspan="2">

<div class="button"> 
<button type="submit"  name="save" value="<? echo $status;?>"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
</button>

<button type="reset" value="Reset">
<img src="../../images/reset.png" alt="" width="20px" height="20px"/> 
Reset
</button>   

</div>
</tr>

<tr>
<input type="hidden" name="username" size="50" value="<? echo $username;?>" />
				<tr>
					<td><label>Username</label></td>
					<td>: <input name="username" type="text" size="30" value="<? echo $username;?>"/></td>
				</tr>	
				<tr>
					<td><label>Admin</label></td>
					<td>:<input type="checkbox" name="admin" <?php if($admin!=0){echo "checked";}?>  value="1" /></td>
				</tr>
				<tr>
					<td><label>Ketua</label></td>
					<td>:<input type="checkbox" name="ketua" <?php if($ketua!=0){echo "checked";}?> value="1" /></td>
				</tr>
				<tr>	
					<td><label>USP</label></td>
					<td>:<input type="checkbox" name="usp" <?php if($usp!=0){echo "checked";}?> value="1" /></td>
				</tr>
				<tr>
					<td><label>Toko</label></td>
			 		<td>:<input type="checkbox" name="toko" <?php if($toko!=0){echo "checked";}?> value="1" /></td>
				</tr>	
					<td><label>Anggota</label></td>
					<td>:<input type="checkbox" name="anggota" <?php if($anggota!=0){echo "checked";}?> value="1" /></td>
				</tr>
				
</tr>
<br>


</table>
<br
<!--
	apabila masukkan baru, maka $action akan otomatis
	terisi "new"
-->
<input type="hidden" name="action" value="<? echo $action;?>" />

</form>