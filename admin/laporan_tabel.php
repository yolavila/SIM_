  <script type="text/javascript">
$(function() {
$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
});

$(function() {
$('#tanggal1').datepicker({dateFormat:'yy-mm-dd'});
});
</script> 
  <h3>Search Report</h3>
<form name="form1" method="POST" action="?file=carii">
	Cari: <select name="pilihan" id="pilihan">
	<option value="buffer">Buffer</option>
	<option value="hadir">Hadir</option>
	<option value="thadir">Tidak Hadir</option>
	<option value="qualified">Qualified</option>
	<option value="tqualified">Not Qualifiend</option>
	<option value="hired">Hired</option>
	<option value="terminated">Terminated</option>
	</select></tr>
	<input name="tanggal" type="text" id="tanggal" placeholder="Mulai Tanggal"></input></td>
	<input name="tanggal1" type="text" id="tanggal1" placeholder="Sampai tanggal"></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching">
	<input name="clear" class="button" type="submit" id="clearSearch" value="Clear Search">
	</td>
	</table>
</form>
<br/><br/>