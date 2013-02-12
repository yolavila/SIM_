<head>
<?php
	$action="new";
	$status="Simpan";
	$readonly="";
	$npa="";
	$nama="";
	$jabatan="";
	$jk="";
	$ttl="";
	$telp="";
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['npa']))
	{
		include("../../db_config.php");
		$str="select * from pengurus where npa=".($_GET['npa']);
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$npa=$data['npa'];
		$nama=$data['nama'];
		$jabatan=$data['jabatan'];
		$jk=$data['jk'];
		$ttl=$data['ttl'];
		$telp=$data['telp'];
		
		$action="update";
		$simpan=$action;
		$readonly="readonly=readonly";
	}
?>
<script type="text/javascript">
$(function(){
	$("#formPengurus").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){
				
				if(data==1)
				{
					window.location = "pengurus.php"
				}
				else
				{
					alert(data);
					//alert("gagal");
				}
				
				
			}
		});
		return false;
	});
})

function cariNpa()
{
	var npa = document.getElementById('npa');
	window.location = "pengurus.php?npa="+npa.value;
}
</script>
</head>
<?php
	include("../../db_config.php");
	if ($npa != "") $npax = $npa; 
	else $npax=$_GET['id'];
	
	$cariagt = "SELECT npa, nama, instansi, jk,ttl, telp FROM anggota WHERE npa='$npax' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari);
	if ($nama != "") $namax	 = $nama; 
	else 
	$npax	 = $datacari['npa'];
	$namax	 = $datacari['nama'];
	$instansix	 = $datacari['instansi'];
	$jk = $datacari['jk'];
	$ttlx	 = $datacari['ttl'];
	$telpx	 = $datacari['telp'];
	$itung	 = "SELECT count(*) as jml FROM `anggota` WHERE npa='$npax'";
	$qitung  = mysql_fetch_assoc(mysql_query($itung));
	$hitung  = $qitung['jml'];
	if (($hitung==0)&&($npax!='')){
		?>
		<script type="text/javascript">
			alert("NPA tidak terdaftar");			
		</script>
		<?php
	}
	
?>
<script type="text/javascript">
$(function() {
    $("#npa").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	});
	
</script>

<!--
	jika menambahkan instansi baru, maka
	form inilah yang akan dipanggil.
	ingat action pada proses.php. apabila diganti
	pastikan lokasi file benar.
-->
<body bgcolor="#F5F5F5">
<form method="post" name="formPengurus" action="proses_pengurus.php" id="formPengurus">
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

<table>
				<tr>
				<td><label>NPA</label> </td>
					<td>: <input name="npa" id="npa" size="30" value="<?php echo $npax; ?>" > 
					<input type="button" name="caribtn" id="submit" value="Cari" onClick="cariNpa();" readonly="readonly" /> </td>
					
					<td><label>Telp</td>
					<td>: <input type="text" name="telp" id="telp"  size="30"  value="<? echo $telpx;?>" readonly="readonly" /> </td>
														
				</tr>
				<tr>
					<td><label>Nama</label> </td>
					<td>: <input name="nama" size="30" value="<?php echo $namax; ?>" />
					
					<td><label>TTL</td>
					<td>: <input type="text" name="ttl" id="ttl"  size="30" value="<?php echo $ttlx;?>" readonly="readonly" /> </td>
				</tr>
				<tr>
				<td>
					<label>Jabatan</label> </td>
					<td>: <input name="jabatan" type="text" size="30" value="<? echo $jabatan;?>" /></td>
				</tr>
				<tr>
					<td><label>JK</label> </td>
					<td>: <input name="jk" type="text" size="30" value="<? echo $jk;?>" readonly="readonly" /></td>
				</tr>
			
			</table>
			
				
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