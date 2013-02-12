<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi</title>
<script type="text/javascript" src="../scripts/jquery.js"></script>
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

<link type="text/css" href="../../js/ui/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="../../js/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="../../js/ui/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../js/ui/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
$(function() {
	  $("#npa").focus();
	$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
	});
	
</script>

<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
a:link{text-decoration:none;}
</style>
</head>
<?php $_GET['username']; ?>
<body bgcolor="#F5F5F5" >
<form method="post" action="proses_reset.php">	

<div class="button"> 
<button type="submit" name="change"> 
<img src="../../images/save3.png" alt="" width="20px" height="20px" /> 
Ganti
</button>

<button type="reset" value="Reset">
<img src="../../images/new.png" alt="" width="20px" height="20px"/> 
New
</button>   

</div>	
<br>

<table width="500">
<input type="hidden" name="npa" size="50" value="<? echo $npa;?>" />
			
				<tr>
					<td><label>Password Baru</label></td>
					<td>: <input type="password" name="passwordbaru" id="passwordbaru" size="30"/></td>
					<input type="hidden" name="username" value="<?php echo $_GET['username'];?>"/>
				</tr>
				</table>
<br>	
</form>			
</body>
</html>