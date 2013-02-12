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
<style type="text/css">
body,html
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
<body bgcolor="#F5F5F5">
<fieldset>
<td><input type="button" value="new"></td>
<td><input type="button" value="save"></td>
<td><input type="button" value="delete"></td>
<td><input type="button" value="find"></td>
<td><input type="button" value="preview"></td>
<td><input type="button" name="submit" value="exit" onclick="self.history.back()" img></td>

                       <h2>Jurnal Kas Masuk USP</h2>
        		<tr>
					<td><label>Isikan Periode</label></td>
					<td>: <select name="search">
						<option value="januari">Januari
						<option value="februari">Februari
						<option value="maret">Maret
						<option value="april">April
						<option value="mei">Maret
						<option value="juni">Juni
						<option value="juli">Juli
						<option value="agustus">Agustus
						<option value="september">September
						<option value="oktober">Oktober
						<option value="november">November
						<option value="desember">Desember
						</select>
					<tr>
					<input type="text" size="10"/></td>
					</tr> [ isikan tahun, contoh 2012 ] &nbsp
					<input type="button" value="Go">
					</td>
				</tr>
				</fieldset>	
				<br>
				
<div id="kontenbawah">


<table frame=hsides width="1100" border="1">
				<tr colspan="3" bgcolor="#3CB371">
				<th rowspan=2>Tanggal</th>
				<th rowspan=2>Untuk</th>
				<th rowspan=2>No.BKM</th>
				<th rowspan=2>Saldo Awal</th>
				<th rowspan=2>Penerimaan</th>
				<th rowspan=2>Pengeluaran</th>
				<th colspan=2>Stok Opname</th>
				<th rowspan=2>Saldo Akhir</th>
				</tr>
				<tr bgcolor="#3CB371">
				<td>In</td>
				<td>Out</td>
				</tr>
			
				<tr>
				<td colspan=3> <b><center>TOTAL (Rp)</b></center></td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
				</table>

</div>
				</html>