<html>
<?php

	include("../../db_config.php");
	function get_code() {
		$query  = mysql_query("SELECT RIGHT(`npa`, 3) AS `SEQ` FROM `anggota` ORDER BY `npa` DESC");
		$result = $query;
	if ($result == (mysql_num_rows($result) > 0)) {
		$seq = mysql_result($result, 0);
		return $seq;
	} else
		return '000';
	}
	$lastSeq = get_code();
	$npa = 0;
	$currSeq = $lastSeq+1;
	if (strlen($currSeq)==1)
	{
		  $npa .= '000'.$currSeq;
	}
	if (strlen($currSeq)==2)
	{
		  $npa .= '00'.$currSeq;
	}
	if(strlen($currSeq)==3)
	{
		  $npa .= '0'.$currSeq;
	}
	if(strlen($currSeq)==4)
	{
		  $npa .= $currSeq;
	}
	$npa;
	
	$action="new";
	$status="Simpan";
	$readonly="";
	$nama="";
	$alamat="";
	$instansi="";
	$kota="";
	$tgl_masuk="";
	$jk="";
	$ttl="";
	$telp="";
	$tipe="";
	
	//GANTIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['npa']))
	{
		include("../../db_config.php");
		$npa = $_GET['npa'];
		$str="select * from anggota where npa='$npa'";
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$nama=$data['nama'];
		$alamat=$data['alamat'];
		$instansi=$data['instansi'];
		$kota=$data['kota'];
		$tgl_masuk=$data['tgl_masuk'];
		$jk=$data['jk'];
		$ttl=$data['ttl'];
		$telp=$data['telp'];
		$tipe=$data['tipe'];
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
<script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="../../js/jquery.autocomplete.css" type="text/css" />

<!-- Script tanggal dan Focus kursor -->
<script type="text/javascript">
$(function() {
    $("#nama").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	});
	
</script>

</head>


<script type="text/javascript">
$(function(){
	$("#formAnggota").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){
				if(data==1)
				{
					window.location = "anggota.php"
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
<body>
<form method="post" name="formAnggota" action="proses_anggota.php" id="formAnggota">
<table width="700">
<tr>
<td colspan="2">

<div class="button"> 
<button type="submit" name="save" value="<? echo $status;?>"> 
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
<input type="hidden" name="npa" size="50" value="<? echo $npa;?>" />
				<tr>
					<td><label>Nama Lengkap</label></td>
					<td>: <input name="nama" id="nama" type="text" size="30" value="<? echo $nama;?>"/></td>

					<td><label>Tanggal Masuk</td>
					<td>: <input type="text" name="tgl_masuk" id="tanggal"  size="30" value="<? echo $tgl_masuk;?>"/></td>
								
					</tr>	
				<tr>
					<td><label>Alamat</label></td>
					<td>: <input name="alamat" type="text" size="30" value="<? echo $alamat;?>"/></td>
						
					<td><label>TTL</label></td>
					<td>: <input name="ttl" type="text" size="30" value="<? echo $ttl;?>"/></td>
				</tr>
				<tr>
					<td><label>Instansi</label></td>
			 		<td>: <input name="instansi" type="text" id='instansi' size="30" value="<? echo $instansi;?>"/></td>
					
					<td><label>Telp</label></td>
					<td>: <input name="telp" type="text" size="30" value="<? echo $telp;?>"/></td>
				</tr>
				<tr>
					<td><label>Kota</label></td>
					<td>: <input name="kota" type="text" size="30" value="Magetan"/></td>
					
					<td><label>Jenis Kelamin</label> </td>
					<td>: <select name="jk">
					<option value="laki-laki" <?php if($jk == "laki-laki"){echo "selected";} ?>>laki-laki</option>
					<option value="perempuan" <?php if($jk == "perempuan"){echo "selected";} ?>>perempuan</option></select>
					</td>
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
</body>
<script type="text/javascript">
	$(document).ready(function() {
		$("#instansi").autocomplete("get_instansi.php",{delay:1,
						minChar: 1,
						minLength: 2,
		 				formatResult: function(row){
		 					if(isNaN(row[2])){
								return row[1];
							}else{
								//return row[2]+"*"+row[1];
								return row[1];
							}
						}
		});
		$("#instansi"+i).result(function(event, data, formatted) {
		if (data){
			var c = this.id.substr(11,3);
				}
		});
	 
	});

</script>
</html>