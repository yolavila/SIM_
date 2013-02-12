<?php

	$kode_suplier;
	$action="new";
	$status="Simpan";
	$readonly="";
	$kode_suplier="";
	$nama="";
	$alamat="";
	$kota="";
	$telepon="";
	
		if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['kode_suplier']))
		{
		include("../../db_config.php");
		$kode_suplier = $_GET['kode_suplier'];
		$str="select * from suplier where kode_suplier='$kode_suplier'";
		
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$nama=$data['nama'];
		$alamat=$data['alamat'];
		$kota=$data['kota'];
		$telepon=$data['telepon'];
		$action="update";
		$simpan=$action;
		$readonly="readonly=readonly";
	}
?>

<head>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/ui/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
$(function() {
	$("#nama").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	});
	
</script>

</head>
<script type="text/javascript">
$(function(){
	$("#formSuplier").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){
				if(data==1)
				{
					window.location = "suplier.php"
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

<form method="post" name="formSuplier" action="proses_suplier.php" id="formSuplier">
<table width="650">
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

<input type="hidden" name="kode_suplier" size="50" value="<? echo $kode_suplier;?>" />
<tr>
					<td><label>Nama Suplier</label></td>
					<td>: <input id="nama" name="nama" type="text" size="30" value="<? echo $nama;?>" /></td>
				<tr>
					<td><label>Alamat</label></td>
					<td>: <input name="alamat" type="textarea" size="30" value="<? echo $alamat;?>" /></td>
				</tr>
				<tr>	
					<td><label>Kota</label></td>
					<td>: <input name="kota" type="text" size="30" value="<? echo $kota;?>" /></td>
				</tr>
				<tr>	
					<td><label>Telepon</label></td>
					<td>: <input name="telepon" type="text" size="30" value="<? echo $telepon;?>" /></td>
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