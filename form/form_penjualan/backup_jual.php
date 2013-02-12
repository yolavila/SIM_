<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/ui/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
$(function(){
	/**
	FUNGSI UNTUK MENAMPILKAN TAMBAH FORM INSTANSI,
	DIGUNAKAN JAVASCRIPT UNTUK MENAMPILKAN FORM
	**/
	$("a.add").click(function(){
		page=$(this).attr("href")
		$("#Formcontent").html("loading...").load(page);
		return false
	})
})
</script>
<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>

<!-- Script tanggal dan Focus kursor -->
<script type="text/javascript">
$(function() {
    $("#npa").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	});
	
	function ubahstyle(x){
		document.getElementById(x).style.background="#98FB98";
	}	
	function balikin(x){
		document.getElementById(x).style.background="#f5f5f5";
	}
	
	function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
	}

	var xmlhttp = createRequestObject();
	
	function komplit(xx,lain,lain2,lain3){
    var kode = xx.value;
    if (!kode) return;
    xmlhttp.open('get', 'datapenjualan.php?nama='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             var r = xmlhttp.responseXML.getElementsByTagName('data');
			 document.getElementById(xx.id).value = r[0].firstChild.data;
             document.getElementById(lain).value = r[1].firstChild.data;
			 document.getElementById(lain2).value = r[2].firstChild.data;
			  document.getElementById(lain3).value = r[3].firstChild.data;
        }
        return false;
    }
    xmlhttp.send(null);         
}
	
</script>
<script type="text/javascript">
function kali() {
cek();
a=eval(form.harga.value);
b=eval(form.qty.value);
c=a*b
form.total.value = c;
}

</script>
<?php
	include("../../db_config.php");
	$npax=$_GET['id'];
	
	$cariagt = "SELECT nama FROM anggota WHERE npa='$npax' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari);
	$namax	 = $datacari['nama'];
	$instansix	 = $datacari['instansi'];
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
</head>

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
a:link{text-decoration:none;}
</style>
<body bgcolor="#F5F5F5"  onload="document.formPenjualan.npa.focus()">

<form method="post" name="formPenjualan" action="datapenjualan.php" id="formPenjualan">	

<h1><b><font color=”#006400”>Form Penjualan Barang</b></font></h1>
<div class="button"> 
<button type="submit" name="save" value="simpan"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

<a href="tampil_penjualan.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>

<a href="../../admin.php?menu=usp"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>	<br>

                <table>
				<input type="hidden" name="npa" size="50" value="<? echo $npa;?>" />
				<tr>
					<td><label>Npa</label></td>
					<td>: <input name="npa" type="text" size="30" value="<?php echo $npax;?>"/></td>
					<td><input type="submit" name="caribtn" id="submit" value="Cari"> </td>
					
					<td><label>Tanggal Beli</td>
					<td>: <input type="text" name="tgl_masuk" id="tanggal"  size="30" /> <value="<? echo $tanggal;?>"/></td>
				</tr>
				<tr>
					<td><label>Nama</label></td>
					<td>: <input name="nama" type="text" size="30" value="<?php echo $namax;?>"/></td>
					<td><input type="button" value="Cari"></td>
									
					<td><label>Keterangan</label></td>
					<td>:<input type="radio" name="jk" value="cash"/>Cash &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="jk" value="kredit"/>Credit
					</td>	
				</tr>	
				<tr>
					<td><label>Unit Kerja</label></td>
					<td>: <input name="nama" type="text" size="30" value="<?php echo $instansix;?>"/></td>
				</tr>	
				
				</table>	
				</div>
				</fieldset>				
				<br>
				
<div id="kontenbawah">

<form name="formJml" Onsubmit="perkalian()">
<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<tr colspan="3" bgcolor="#3CB371">
				<th width="10px">Kode</th>
				<th width="40px">Nama Barang</th>
				<th>Qty</th>
				<th width="10px">Diskon (%)</th>
				<th width="15px">Harga</th>
				<th>Jumlah</th>
				</tr>
				<?php
				  for ($i=0;$i<=10;$i++){
				?>
				<tr>
				<th ><input type="text" size="20px" id="id_barang<?php echo $i?>" readonly="readonly" style="border:0px; background: #f5f5f5;"/></th>
				<th><input type="text" size="40px" id="nama_barang<?php echo $i?>" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'id_barang<?php echo $i?>','harga<?php echo $i?>','diskon<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)"/></th>
				<th><input type="text" size="10px" id="<?php echo $i?>" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'id_barang<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)"/></th>
				<th><input type="text" size="10px" id="diskon<?php echo $i?>" readonly="readonly" style="border:0px; background: #f5f5f5;"/></th>
				<th><input type="text" size="24px" id="harga<?php echo $i?>" readonly="readonly" style="border:0px; background: #f5f5f5;"/></th>
				<th><input type="text" size="25px" id="jumlah<?php echo $i?>" readonly="readonly" style="border:0px; background: #f5f5f5;" onChange="perkalian()"/></th>
				</tr>
				<?php
					}
				?>
				</table>
				</form>
				<br>
				<table align="right">
				
				<tr>
					<td><label><b>TOTAL</b></label></td>
					<td>: <input name="nama" type="text" size="26" /></td>
				</tr>
					<tr>
					<td><label><b>BAYAR</b></label></td>
					<td>: <input name="nama" type="text" size="26" /></td>
				</tr>
					<tr>
					<td><label><b>KEMBALI</b></label></td>
					<td>: <input name="nama" type="text" size="26" /></td>
				</tr>
				<!--
				<tr>
					<td><label>BKM</label></td>
					<td> : <input type="button" value="Bukti Kas Masuk"></td>
				</tr>
				-->
				</table>
</div>
</form>
</body>
</html>