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
	
	function komplit(xx,lain,lain2){
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
			 //document.getElementById('quatity0').value = 1;
        }
        return false;
    }
    xmlhttp.send(null);         
}
	
</script>
<script type="text/javascript">
function hitungPenjualan(w,x,y,z){
	var qtyreturn = w.value;
	var quatity 	= x.value;
	var harga  	= y.value;
		
	if (quatity==''){
		quatity = 0;
	}
	if (qtyreturn==''){
		qtyreturn = 0;
	}
	if (harga==''){
		harga = 0;
	}
	
	if (parseInt(qtyreturn)>parseInt(quatity)){
		alert('nilai qty return nda boleh lebih besar dari qty barang!!!!');
	}
	
	jml = (quatity-qtyreturn)*harga;
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
	var struk = document.getElementById("struk");
	if(struk.value == "")
	{
		cek = cek+1;
		salah.push("Nomor Struk wajib diisi");
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

	if (isset($_GET['id'])){	
	$njbx=$_GET['id'];

	$cariagt = "SELECT a.nama namax,a.instansi instansix,p.* FROM `penjualan` p
				LEFT JOIN anggota a ON a.npa=p.npa WHERE njb='$njbx' LIMIT 0,1";
	$qcari	 = mysql_query($cariagt) or die(mysql_error());
	$datacari= mysql_fetch_assoc($qcari); 
	$namax	 = $datacari['namax'];
	$instansix	 = $datacari['instansix'];
	$npax = $datacari['npa'];
	$itung	 = "SELECT count(*) as jml FROM penjualan WHERE njb='$njbx'";
	$qitung  = mysql_fetch_assoc(mysql_query($itung));
	$hitung  = $qitung['jml'];
	if ($hitung==0){
		?>
		<script type="text/javascript">
			alert("No Struk tidak ditemukan, mohon cek ulang no struk anda.");			
		</script>
		<?php
		$njbx = '';
	}
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
<body bgcolor="#F5F5F5"  onload="document.formReturn.struk.focus()">
<form method="post" name="formReturn" action="proses_return_jual.php" id="formReturn" onSubmit="return cek();">	

<h1><b><font color=”#006400”>Return Penjualan Barang</b></font></h1>
<div class="button"> 
<button type="submit" name="save" value="simpan" id="simpan"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Simpan 
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

<a href="tampil_return_jual.php"><button type="button"><img src="../../images/preview.png" alt="" title="" border="0" width="20px" height="20px">Preview</button ></a>
<a href="../../admin.php"  onclick="self.history.back()"><button type="button"><img src="../../images/exit3.png" alt="" title="" border="0" width="20px" height="20px">Exit</button></a>

</div>	<br>

               <table>
				<tr>
					<td><label>No.Struk</label></td>
					<td>: <input name="struk" id="struk" type="text" size="30" value="<?php echo $njbx;?>"/></td>
					<td><input type="submit" name="caribtn" id="submit" value="Cari"> </td>
					
					<td><label>Tanggal Return</td>
					<td>: <input type="text" name="tgl" id="tgl"  size="20" value="<?php echo date("j/n/Y"); ?>" /></td>
				</tr>	
				<tr>
					<td><label>NPA</label></td>
					<td>: <input name="npa" type="text" size="30" value="<?php echo $npax;?>"/></td>
				</tr>	
				<tr>
					<td><label>Nama</label></td>
					<td>: <input name="nama"  size="30" value="<?php echo $namax;?>"/></td>
				<!--	<td><input type="button" value="Cari"></td> -->
				</tr>
				<tr>
					<td><label>Instansi</td>
				<td>: <input name="instansi" type="text" size="30" value="<?php echo $instansix;?>"/></td>

				</tr>	
				
				</table>	
				</fieldset>				
				<br>
				
<!--<div id="kontenbawah"> -->
<div style="width: 100%; font-size: 12px; font-family: Arial;">
<table width="100%" border="1" cellpadding="5" cellspacing="0" >
				<tr colspan="3" bgcolor="#3CB371">
				<th width="14%">Kode</th>
				<th width="31%">Nama Barang</th>
				<th width="10%">Qty</th>
				<th width="10%">Qty Return</th>
				<th width="15%">Harga</th>
				<th colspan="20%" width=""> Jumlah</th>
				</tr>
</table>
</div>
<div style="width: 100%; font-size: 12px; font-family: Arial; overflow: auto;">
<!--<div STYLE=" height: 100px; width: 100%; font-size: 12px; overflow: auto;"> -->
<table width="100%" border="1" cellpadding="5" cellspacing="0" >
				<?php
				$qry = mysql_query("SELECT p.id_jual idjual, p.njb njb, p.id_barang id, mb.nama nm, p.quatity qty, mb.harga_beli harga, p.jumlah jml FROM `penjualan` p
						LEFT JOIN master_barang mb ON mb.id_barang = p.id_barang
						WHERE p.njb = '$njbx'") or die(mysql_error());
				$i=0;
				  While ($dataxx=mysql_fetch_array($qry)){
				?>
				<tr colspan="3">
				<td width="64px"><input type="text" size="15px" name="id_barang<?php echo $i;?>" value="<?php echo $dataxx['id']?>" id="id_barang<?php echo $i?>" style="border:0px; background: #f5f5f5;" onfocus="ubahstyle(this.id)" onblur="balikin(this.id) "readonly= "readonly""/></td>
				<td width="40px"><input type="text" size="42px" name="nama_barang<?php echo $i;?>" value="<?php echo $dataxx['nm']?>" id="nama_barang<?php echo $i;?>" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'id_barang<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)" onkeypress="return handleEnter(this, event, 1) "readonly= "readonly"""/></td>
				<td width="10px"><input type="text" class="quantity" size="9px" value="<?php echo $dataxx['qty']?>" id="quatity<?php echo $i?>" name="quatity<?php echo $i?>" onChange="hitungPenjualan(qtyreturn<?php echo $i?>,this,harga<?php echo $i;?>,jumlah<?php echo $i;?>)" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)" onkeypress="return handleEnter(this, event, 4)"/></td>
				<td width="5px"><input type="text" size="9px" value="0" id="qtyreturn<?php echo $i?>" name="qtyreturn<?php echo $i?>" onChange="hitungPenjualan(this,quatity<?php echo $i?>,harga<?php echo $i;?>,jumlah<?php echo $i;?>)" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)" onkeypress="return handleEnter(this, event, 4)"/></td>				
				<td width="15px"><input type="text" class="harga" size="17px" value="<?php echo $dataxx['harga']?>" id="harga<?php echo $i?>" name="harga<?php echo $i?>" onChange="hitungPenjualan(qtyreturn<?php echo $i?>,quatity<?php echo $i;?>,this,jumlah<?php echo $i;?>)" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id)"/></td>
				<td width="15px"><input type="text" class="total" size="20px" value="<?php echo $dataxx['jml']?>" id="jumlah<?php echo $i?>" name="jumlah<?php echo $i?>" style="border:0px; background: #f5f5f5;" onchange="komplit(this,'satuan<?php echo $i?>','harga<?php echo $i?>')" onfocus="ubahstyle(this.id)" onblur="balikin(this.id) "readonly= "readonly"""/></td>
				<td width="5px" align="center"><a href="proses_return_jual.php?action=return&id_jual=<?php echo $njbx;?>&id_barang=<?php echo $dataxx['id'];?>" onclick="return confirm('Anda Yakin Ingin Mengembalikan barang?')"><img src="../../images/undo.png"  border="0"></a></td>
				</tr>
				
				<?php
						$i++;
					}
				?>
		<!--			<tr>
				<td align="right" colspan=4> <b>TOTAL</b></td>
				<td>-</td>
				</tr> -->
				</table>
				</div>
				<br>
	<!--			<table align="right">
				
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
					
				<tr>
					<td><label>BKM</label></td>
					<td> : <input type="button" value="Bukti Kas Masuk"></td>
				</tr> -->
			
				</table>	
</div>
</form>
</body>
</html>