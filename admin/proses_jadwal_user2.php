<script type="text/javascript">
$(function() {
$('#tanggal').datepicker({dateFormat:'yy-mm-dd'});
});
</script> 
<?php 
mysql_connect("localhost", "root", "");
mysql_select_db("sim");

$no_ap=$_POST['no'];
$nama=$_POST['nama'];
$kantor=$_POST['kantor'];
$cabang=$_POST['cabang'];
$posisi=$_POST['posisi'];
$tanggal=$_POST['tanggal'];

$query=mysql_query("INSERT INTO jadwal_user VALUES ('$no_ap','$kantor','$cabang','$posisi','$tanggal')");
  
?>
<table><tr bgcolor="#00BFFF" align ="center">
<td style=' padding-left:5px; font-size:13px;'>No</td>
<td style=' width:120px; padding-left:10px; padding-right:10px;font-size:13px;'>No Applicant</td>
<td style=' width:120px; padding-left:10px; padding-right:10px;font-size:13px;'>Nama</td>
<td style=' width:120px; padding-left:10px; padding-right:10px;font-size:13px;'>Kantor</td>
<td style=' width:170px; padding-left:10px; padding-right:10px;font-size:13px;'>Cabang</td>
<td style=' width:100px; padding-left:10px; padding-right:10px;font-size:13px;'>Posisi</td>
<td style=' width:100px; padding-left:10px; padding-right:10px;font-size:13px;'>Tanggal</td>
</tr>
<?php	
$warnaGenap = "#FFFFFF";   // warna putih
$warnaGanjil = "#CCCCCC";  // warna abu-abu
$warnaHeading = "#00BFFF"; // warna merah untuk heading tabel
$batas=5;
$hal=$_GET['hal'];
if(empty($hal))
{
$posisi=0;
$hal=1;
}
else
{
$posisi = ($hal-1) * $batas;
}
$tampil="Select jadwal_user.*, applicant.nama_lengkap from jadwal_user INNER JOIN applicant on jadwal_user.no_applicant=applicant.no_applicant where jadwal_user.no_applicant='$no_ap'";
$hasil=mysql_query($tampil);
$no=$posisi+1;
while ($data=mysql_fetch_array($hasil)){

if ($no % 2 == 0) $warna = $warnaGenap;
else $warna = $warnaGanjil;
echo "<tr bgcolor='".$warna."' >";
echo "<td style=' padding-left:5px; font-size:12px;'>$no</td>";
echo "<td style=' padding-left:5px; font-size:12px;'>".$data['no_applicant']."<d>";
echo "<td style=' padding-left:5px; font-size:12px;'>".$data['nama_lengkap']."<d>";
echo "<td style=' padding-left:5px; font-size:12px;'>".$data['kantor']."<d>";
echo "<td style=' padding-left:5px; font-size:12px;'>".$data['cabang']."</td>";
echo "<td style=' padding-left:5px; font-size:12px;'>".$data['posisi']."</td>";
echo "<td style=' padding-left:5px; font-size:12px;'>".$data['tanggal_pengiriman']."</td>";
echo "</tr>";
$no++;
}

?>
<br></br>
   <div align="center"><span class="style1">ADD USER SCHEDULING</span><br />
    <br />
  </div>
  <table width="90%" border="0" align="center">
  <form method="post" action="?file=penjadwalan_user2"><br/>
<tr>No Applicant &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; Nama Applicant &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  Kantor &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  Cabang &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Posisi &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Tanggal Pengiriman &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</tr>
<br>
<input text="center" type="text" border="2 px" size=10 name="no" value=<?php echo $no_ap ?>>&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=18 name="nama" value=<?php echo $nama ?>>&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=10 name="kantor" >&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=12 name="cabang" >&nbsp;&nbsp;&nbsp; &nbsp;
<input text="center" type="text" border="2 px" size=10 name="posisi" >&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; 
<input text="center" type="text" border="2 px" size=10 name="tanggal" id="tanggal" >&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; 
<br></br>
  <tr><input type="submit" value="Save"/></tr></form>&nbsp;&nbsp;&nbsp; &nbsp;<a href='?file=penjadwalan2'><img src='images/back.jpg' width='16' height='16' border='0'>Back</a>
</table>
  
  