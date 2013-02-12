<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="../../js/jquery.autocomplete.css" type="text/css" />

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
	
	
	
	 $(".quantity").blur ( function () {
              var resultVal = 0.0;
               $(".total").each ( function() {
					if ($(this).val() != ''){
                   resultVal += parseFloat ( $(this).val().replace(/\s/g,'').replace(',','.'));
					}
				});
                 document.getElementById('total').value = resultVal;  
        });
	
	$(".harga").blur ( function () {
              var resultVal = 0.0;
               $(".total").each ( function() {
					if ($(this).val() != ''){
                   resultVal += parseFloat ( $(this).val().replace(/\s/g,'').replace(',','.'));
					}
				});
                 document.getElementById('total').value = resultVal;  
            });
			
	$('body').keyup(function(e) {
		console.log('keyup called');
		var code = e.keyCode || e.which;
		if (code == '9') {
			//alert('Tab pressed');
			$('#bayar').focus();
		}
	 });

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
	
	function komplit(xx,lain,lain2){
    var kode = xx.value;
    if (!kode) return;
    xmlhttp.open('get', 'datapembelian.php?nama='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             var r = xmlhttp.responseXML.getElementsByTagName('data');
			 document.getElementById(xx.id).value = r[0].firstChild.data;
             document.getElementById(lain).value = r[1].firstChild.data;
			 document.getElementById(lain2).value = r[2].firstChild.data;
			 //document.getElementById('quatity0').value = 1;
        }
        return false;
    }
    xmlhttp.send(null);         
}
	
</script>
<script type="text/javascript">
function hitungPenjualan(x,y,z){
	var quantity 	= x.value;
	var harga  	= y.value;
		
	if (quantity==''){
		quantity = 0;
	}
	if (harga==''){
		harga = 0;
	}
	
	jml = quantity*harga;
	z.value = jml; 
}
function sisaPenjualan(a,b,s){
	var total = a.value;
	var bayar = b.value;
	
	if (total==''){
		total = 0;
	}
	if (bayar==''){
		bayar = 0;
	}
	
	sisa = bayar - total;
	s.value = sisa;
}
               
function handleEnter (field, event, angka) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if (keyCode == 13) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
				break;
		i = (i + angka) % field.form.elements.length;
		field.form.elements[i].focus();
		return false;
	} 
	else
	return true;
}      

function handleEnterc (field, event) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if (keyCode == 13) {
		var x;
		var duit = document.getElementById("kembali").value;
		var r=confirm("Kembali Rp. "+duit);
		if (r==true)
		  {
			document.getElementById("formPenjualan").submit();
		  }
		else
		  {
			x="You pressed Cancel!";
		  }
		return false;
	} 
	else
	return true;
} 

/* Tambahan Function buat alert isi npa*/
function cek()
{
	var salah = [];
	var cek = 0;
	var suplier = document.getElementById("suplier");
	if(suplier.value == "")
	{
		cek = cek+1;
		salah.push("Suplier wajib diisi");
	}
	var tanggal = document.getElementById("tanggal");
	if(tanggal.value == "")
	{
		cek=cek+1;
		salah.push("Semua wajib diisi");
	}
	if(cek > 0)
	{
		alert(salah.join("\n"));
		return false;
	}
}

</script>
<?php
	include("../../db_config.php");
	if ($npa != "") $npax = $npa; 
	else $npax=$_GET['id'];
	
	$cariagt = "SELECT nama, instansi FROM anggota WHERE npa='$npax' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari);
	if ($nama != "") $namax	 = $nama; 
	else $namax	 = $datacari['nama'];
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
<body bgcolor="#F5F5F5"  onload="document.formPembelian.suplier.focus()">
<form method="post" name="formPembelian" action="proses_pembelian.php" id="formPembelian">	

<h1><b><font color=”#006400”>Pembelian Barang</b></font></h1>
<div class="button"> 
<button type="submit" name="save" value="simpan" id="simpan"  onClick="return cek();"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

<a href="tampil_pembelian.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>
<a href="../../admin.php?menu=toko"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>	<br>

               <table>
				<tr>
					<td><label>Suplier</label></td>
					<td>: <input name="suplier" id="suplier" type="text" size="30" />
					<input name="suplier_" id="suplier_" type="hidden" size="30" />
					</td>
				</tr>	
				<tr>
					<td><label>Tanggal Beli</td>
					<td>: <input type="text" name="tgl" id="tanggal"  size="30" /> <value="<? echo $tanggal;						?>"/></td>
				</tr>	
				<tr>
				<td><label>Keterangan</label></td>
				<!--	<td>:<input type="radio" name="ket" value="cash"/>Cash &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="ket" value="kredit"/>Credit
					</td> -->
					
					<td>:
					<? if ($ket == "kredit"){?>
					<input type="radio" name="ket" value="cash"/>Cash&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="ket" value="kredit" checked="checked"/>Kredit
					<?}else{?>
					<input type="radio" name="ket" value="cash" checked="checked"/>Cash &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="ket" value="kredit"/>Kredit
					<?}?>
					</td>
					
				</tr>
				
				</table>		
				</fieldset>				
				<br>
				
<!--<div id="kontenbawah"> -->
<div style="width: 100%; font-size: 12px; font-family: Arial;">
<table width="100%" border="1" cellpadding="5" cellspacing="0" >
				<tr colspan="3" bgcolor="#3CB371">
				<th width="207px">Kode</th>
				<th width="329px">Nama Barang</th>
				<th width="84px">Quantity</th>
				<th width="146px">Harga</th>
				<th> Jumlah</th>
				</tr>
</table>
</div>
<div style="width: 100%; height: 302px; font-size: 12px; font-family: Arial; overflow: auto;">
<!--<div STYLE=" height: 100px; width: 100%; font-size: 12px; overflow: auto;"> -->
<table width="100%" border="1" cellpadding="5" cellspacing="0" >
				<?php
				  for ($i=0;$i<=100;$i++){
				?>
				<tr colspan="3">
				<th width="207px"><input type="text" size="30px" name="id_barang<?php echo $i;?>" id="id_barang<?php echo $i?>" style="border:0px; background: #f5f5f5;" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)"/></th>
				<th width="329px"><input type="text" size="50px" name="nama_barang<?php echo $i;?>" id="nama_barang<?php echo $i;?>" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'id_barang<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)" onkeypress="return handleEnter(this, event, 1)"/></th>
				<th width="84px"><input type="text" class="quantity" size="10px" id="quatity<?php echo $i?>" name="quatity<?php echo $i?>" onChange="hitungPenjualan(this,harga<?php echo $i;?>,jumlah<?php echo $i;?>)" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)" onkeypress="return handleEnter(this, event, 4)"/></th>
				<th width="146px"><input type="text" class="harga" size="20px" id="harga<?php echo $i?>" name="harga<?php echo $i?>" onChange="hitungPenjualan(quatity<?php echo $i;?>,this,jumlah<?php echo $i;?>)" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)"/></th>
				<th><input type="text" class="total" size="20px" id="jumlah<?php echo $i?>" name="jumlah<?php echo $i?>" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)"/></th>
				</tr>
				
				<?php
					}
				?>
				
				</table>
				</div>
				<br>
				<table align="right">
				
				<tr>
					<td><label><b>TOTAL</b></label></td>
					<td>: <input id="total" name="total" type="text" size="25" /></td>
				</tr>
				</tr>
					<tr>
					<td><label><b>BAYAR</b></label></td>
					<td>: <input name="bayar" id="bayar" type="text" size="25" onkeyup="sisaPenjualan(total,this,kembali)" onkeypress="return handleEnterc(this, event)"/></td>
				</tr>
					<tr>
					<td><label><b>KEMBALI</b></label></td>
					<td>: <input id="kembali" name="kembali" type="text" size="25" /></td>
				</tr>				
					
	<!--			<tr>
					<td><label>BKM</label></td>
					<td> : <input type="button" value="Bukti Kas Masuk"></td>
				</tr> -->
			
				</table>	
</div>
</form>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		for(i=0;i<100;i++)
		{
		$("#nama_barang"+i).autocomplete("getbarang.php",{delay:1,
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
		$("#nama_barang"+i).result(function(event, data, formatted) {
		if (data){
			var c = this.id.substr(11,3);
			//$("#quatity"+c).focus();
			//$(this).parent().next().find(':input').focus();
			//alert(c);
			}
		});
		
		}
		 
	});

</script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#suplier").autocomplete("get_suplier.php",{delay:1,
						minChar: 1,
						minLength: 2,
		 				formatResult: function(row){
		 					if(isNaN(row[2])){
								//return row[1];
								return row[1]+" "+row[2];
							}else{
								return row[1]+" "+row[2];
								//return row[1];
							}
						}
		});
		$("#suplier").result(function(event, data, formatted) {
			$("#suplier_").val(data[2]);
		});		 
	});

</script>

</html>