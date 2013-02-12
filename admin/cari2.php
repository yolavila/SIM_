<?php 
if($_SESSION['level'] == "admin"){
include "f_connect.php";

?>
<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline;">DAFTAR NILAI MAHASISWA </p>
<br/><p>
  
  <form action="?file=simpan_nilai" method="post" >
        <table><tr>
  	<td><p style="text-decoration:underline">  	  Masukan Nilai Mahasiswa
  	  <br />
  	</p>
  	  </td>
	<td></td>
	<td></td>
  </tr>
  <tr>
  	<td>NIP Dosen</td>
	<td>:</td>
	<td><input type="text" name="nip" /></td>
  </tr>
  <tr>
  	<td>NIM Mahasiswa</td>
	<td>:</td>
	<td><input type="text" name="nim" /></td>
  </tr>
   <tr>
  	<td>Nilai Dosen Pembimbing </td>
	<td>:</td>
	<td><input type="text" name="nilai" /></td>
  </tr>
   <tr>
  	<td>Nilai Seminar </td>
	<td>:</td>
	<td><input type="text" name="nilai2" /></td>
  </tr>
  <tr>
  	<td>Nilai Instansi </td>
	<td>:</td>
	<td><input type="text" name="nilai3" /></td>
  </tr>
  <tr>
  	<td> </td>
	<td></td>
	<td><input type="submit" value="simpan" /></td>
  </tr>
  </table>
  </form>
 
 <form method="post" action="?file=carinilai" name="pencarian" id="pencarian">
 	<p align="right">
      <input type="text" name="search" id="search">
      <input type="submit" name="submit" id="submit" value="CARI"> 
      <em>*berdasarkan nim dan nama</em>    </p>
    </form>

</p><br/>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 8%;" align="center">NIM</th>
	   <th style="width: 25%;" align="center">NAMA</th>
	   <th style="width: 5%;" align="center">ANGKATAN</th>
	   <th style="width: 5%;" align="center">NILAI DOSEN PEMBIMBING</th>
	   <th style="width: 5%;" align="center">NILAI SEMINAR</th>
	   <th style="width: 5%;" align="center">NILAI INSTANSI</th>
     </tr>
   </thead>
   
<tbody id="tableBody" style="font-family:trebuchet MS;">
<?php

if ((isset($_POST['submit'])) AND ($_POST['search'] <> "")) {
  $search = $_POST['search'];
  $sql = mysql_query("SELECT * FROM mahasiswa,nilai WHERE mahasiswa.nim_mhs=nilai.id_mhs and mahasiswa.nim_mhs LIKE '%$search%' or mahasiswa.nim_mhs=nilai.id_mhs and mahasiswa.nama_mhs LIKE '%$search%'") or die(mysql_error());
  //menampilkan jumlah hasil pencarian
  $jumlah = mysql_num_rows($sql); 
  if ($jumlah > 0) {
    echo '<p>Ada '.$jumlah.' data yang sesuai.</p>';
   		$x = 1;
        while ($row=mysql_fetch_array($sql)) {
       
		  			echo "<tr $row[id_mhs]>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[nim_mhs]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_mhs]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[angkatan]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[nilai_dsn]</td>	
					<td style='border:1px solid #CBF3C2;' align='center'>$row[seminar]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[instansi]</td>				
				  </tr>";
			$x++;
      }
  }
  else {
   // menampilkan pesan zero data
    echo "<script >
alert('Mohon maaf data yang dicari tidak ada !'); 
document.location='?file=nilai';
</script>";;
  }
} 
else { echo "<script >
alert('Masukkan dulu kata kuncinya !'); 
document.location='?file=nilai';
</script>";}
?>

  </tbody>
   
</table>
   <br />
   <br/>
</div></div></div>
  
<?php } ?>
