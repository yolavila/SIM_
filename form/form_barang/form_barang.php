<?php
	$action="new";
	$status="Simpan";
	$readonly="";
	$id_barang="";
	$nama="";
	$harga_beli="";
	$harga_jual="";
	$kategori="";
	$suplier="";
	$jumlah="";
	$satuan="";
//	$tgl_beli="";
//	$expired="";
	$titip="";
	
		
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id_barang']) and !empty($_GET['ks']))
	{
		include("../../db_config.php");
		//tambah
		$id_barang = $_GET['id_barang'];
		$ks = $_GET['ks'];
		$str="select s.nama as namsup,s.*,m.* from master_barang m inner join suplier s on m.id_barang='$id_barang' and s.kode_suplier = '$ks'";
		$res=mysql_query($str) or die("query gagal dijalankan");
		$data=mysql_fetch_assoc($res);
		$id_barang=$data['id_barang'];
		$nama=$data['nama'];
		$harga_beli=$data['harga_beli'];
		$harga_jual=$data['harga_jual'];
		$kategori=$data['kategori'];
		$suplier=$data['namsup'];
		$kode_suplier=$data['kode_suplier'];
		$jumlah=$data['jumlah'];
		$satuan=$data['satuan'];
		$diskon=$data['diskon'];
		$titip=$data['titip'];
		$action="update";
		$simpan=$action;
		$readonly="readonly=readonly";
	}
?>
<html>
<script type="text/javascript">
$(function(){
	$("#formBarang").submit(function(){
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){
				if(data==1)
				{
					window.location = "master_barang.php"
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

<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/ui/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="../../js/jquery.autocomplete.css" type="text/css" />

<script type="text/javascript">
$(function() {
//    $("#nama").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	$('#tanggal2').datepicker({dateFormat:'yy-mm-dd'});
	});
</script>
<script type="text/javascript">
function hitungDiskon(){
	harga_beli 	= document.formBarang.harga_beli.value;
	diskon  	= document.formBarang.diskon.value;
	
	hdiskon = parseFloat(harga_beli)-(parseFloat(harga_beli)*(parseFloat(diskon)/100));
	document.formBarang.harga_jual.value = hdiskon;
}
</script>
<script type="text/javascript">

function validateForm()
{

var nama=document.formBarang.nama.value;
var tahun=document.formBarang.tahun.value;
alert("sss");
/*
if ( nama=="" && tahun=="")
  {
	alert("Lengkapi form yang tersedia");
	return false;
  }
*/
}
	
</script>
<body >
<form method="post" name="formBarang" action="proses_barang.php" id="formBarang">
<table width="700">
<tr>
<td colspan="2">

<div class="button"> 
<button type="submit"  name="save" value="<? echo $status;?>" onClick="validateForm();"> 
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
<input type="hidden" name="id_barang" size="50" value="<? echo $id_barang;?>" /> 
				<tr>
					<td><label>Nama Barang</label></td>
					<td>: <input id="nama" name="nama" type="text" size="30" value="<? echo $nama;?>"/></td>
					
					<td><label>Harga Beli</label></td>
					<td>: <input name="harga_beli" type="text" size="30" value="<? echo $harga_beli;?>"/></td>
					
				</tr>	
				<tr>	
					<td><label>Diskon</label></td>
					<td>: <input name="diskon" type="text" size="30" onChange="hitungDiskon()" value="<? echo $diskon;?>"/>%</td>
								
					<td><label>Kategori</label> </td>
					<td>: <select name="kategori">
					<option value="Brg Konsumsi" <?php if($kategori == "Barang Konsumsi"){echo "selected";} ?>>Barang Konsumsi</option>
					<option value="Barang Lain" <?php if($kategori == "Barang Lain"){echo "selected";} ?>>Barang Lain</option>
					</select>
					</td>
					
					
				</tr>	
				<tr>	
					<td><label>Harga Jual</label></td>
					<td>: <input name="harga_jual" type="text" size="30" value="<? echo $harga_jual;?>"/></td>				
					
					<td><label>Satuan</label></td> 
					<td>: <select name="satuan" >
					<option value="Kg" <?php if($satuan == "Kg"){echo "selected";} ?>>Kg</option>
					<option value="Pcs" <?php if($satuan == "Pcs"){echo "selected";} ?>>Pcs</option>
					<option value="Dus" <?php if($satuan == "Dus"){echo "selected";} ?>>Dus</option>
					<option value="Liter" <?php if($satuan == "Liter"){echo "selected";} ?>>Liter</option>
					<option value="Biji" <?php if($satuan == "Biji"){echo "selected";} ?>>Biji</option>
					<option value="Batang" <?php if($satuan == "Batang"){echo "selected";} ?>>Batang</option>
					<option value="Sachet" <?php if($satuan == "Sachet"){echo "selected";} ?>>Sachet</option>
					<option value="Botol" <?php if($satuan == "Botol"){echo "selected";} ?>>Botol</option>
					<option value="Potong" <?php if($satuan == "Potong"){echo "selected";} ?>>Potong</option>
					<option value="Pack" <?php if($satuan == "Pack"){echo "selected";} ?>>Pack</option>
					<option value="Lusin" <?php if($satuan == "Lusin"){echo "selected";} ?>>Lusin</option>
					<option value="Kaleng" <?php if($satuan == "Kaleng"){echo "selected";} ?>>Kaleng</option>
					</select>
					</td>
				</tr>
				<tr>
					<td><label>Suplier</label></td>
					<td>: <input name="suplier" id="suplier" type="text" size="30" value="<? echo $suplier;?>" /></td>
					<input type='hidden' name="suplier_" id="suplier_" size="30" value="<? echo $kode_suplier;?>" /></td>
					
					<td><label>Barang Titip</label></td> 
					<td>:<input type="checkbox" name="titip" <?php if($titip!=""){echo "checked";}?> /></td>
					</td>
				</tr>
				<tr>	
					<td><label>Jumlah</label></td>
					<td>: <input name="jumlah" type="text" size="30" value="<? echo $jumlah;?>"/></td>
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
		$("#suplier").autocomplete("get_suplier.php",{delay:1,
						minChar: 1,
						minLength: 2,
		 				formatResult: function(row){
		 					if(isNaN(row[2])){
								//return row[1];
								return row[1];
							}else{
								return row[1];
								//return row[1];
							}
						}
		});
		$("#suplier").result(function(event, data, formatted) {
			$("#suplier_").val(data[2]);
		});
		
		
	});

</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#nama").autocomplete("get_barang.php",{delay:1,
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
		$("#nama"+i).result(function(event, data, formatted) {
		if (data){
			var c = this.id.substr(11,3);
				}
		});
	 
	});

</script>
</html>