<?php
	$action="new";
	$status="Simpan";
	$readonly="";
	$no="";
	$nama="";
	$instansi="";
	$alamat="";
	$kota="";
	$jk="";
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['no']))
	{
		include("../../db_config.php");
		$str="select * from non_anggota where no=".intval($_GET['no']);
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$no=$data['no'];
		$nama=$data['nama'];
		$instansi=$data['instansi'];
		$alamat=$data['alamat'];
		$kota=$data['kota'];
		$jk=$data['jk'];
		$action="update";
		$simpan=$action;
		$readonly="readonly=readonly";
	}

?>
<script type="text/javascript">
$(function(){
	$("#formNonAnggota").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){
				if(data==1)
				{
					window.location = "non_anggota.php"
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
<script type="text/javascript">
    $("#nama").focus();
</script>
<!--
	jika menambahkan instansi baru, maka
	form inilah yang akan dipanggil.
	ingat action pada proses.php. apabila diganti
	pastikan lokasi file benar.
-->

<form method="post" name="formNonAnggota" action="proses_non_anggota.php" id="formNonAnggota">
<table width="400" >
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
		 <button type="cetak" value="">
		<a href="../cetak/cetak.php"><img src="../../images/print.png" alt="" title="" border="0" width="20px" height="20px"></a>
		Cetak
		</button>   
		</div>
		</tr>

<input type="hidden" name="no" size="50" value="<? echo $no;?>" />

<tr>
<td><label>Nama Lengkap</label></td>
<td>: <input id="nama" name="nama" type="text" size="30" value="<? echo $nama;?>" /></td>
</tr>
<tr>
<td><label>Instansi</label></td>
<td>: <input name="instansi" type="text" size="30" value="<? echo $instansi;?>" /></td>
</tr>
<tr>
<td><label>Alamat</label></td>
<td>: <input name="alamat" type="text" size="30" value="<? echo $alamat;?>" /></td>
</tr>
<tr>
<td><label>Kota</label></td>
<td>: <input name="kota" type="text" size="30" value="<? echo $kota;?>" /></td>
</tr>
<tr>
<td><label>Jenis Kelamin</label></td>
<td>: <select name="jk">
<option value="laki-laki">laki-laki</option>
<option value="perempuan">perempuan</option></select>
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