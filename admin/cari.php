<?php 
include "f_connect.php";
if($_SESSION['level'] == "admin"){
 
?>

<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline;">DAFTAR MAHASISWA KERJA PRAKTEK</p>

<br/><p>
  
  <form action="?file=carimhs" method="post" name="pencarian" id="pencarian">
   <input type="text" name="search" id="search">
  <input type="submit" name="submit" id="submit" value="CARI">
  </form>

</p><br/>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 8%;" align="center">NIM</th>
	   <th style="width: 25%;" align="center">NAMA</th>
	   <th style="width: 5%;" align="center">ANGKATAN</th>
	   <th style="width: 20%;" align="center">USERNAME</th>
	   <th style="width: 10%;" align="center">PASSWORD</th>	   
       <th style="width: 5%;" align="center">STATUS</th>
	    <th style="width: 20%;" align="center">DOSEN PEMBIMBING</th>
       <th style="width: 20%;" align="center">AKSI</th>
     </tr>
   </thead>


<tbody id="tableBody" style="font-family:trebuchet MS;">
<?php

if ((isset($_POST['submit'])) AND ($_POST['search'] <> "")) {
  $search = $_POST['search'];
  $sql = mysql_query("SELECT * FROM mahasiswa WHERE nim_mhs LIKE '%$search%' or nama_mhs LIKE '%$search%' ") or die(mysql_error());
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
					<td style='border:1px solid #CBF3C2;' align='center'>$row[username]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[password]</td>					
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[status]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[nama_dosen]</td>
                    <td style='border:1px solid #CBF3C2; width: 100%;'><center>
                    <a href='?file=edit_mhs&id_mhs=$row[id_mhs]'>edit</a>
                    <a href='?file=hapus_mhs&id_mhs=$row[id_mhs]'>delete</a>
                    </td>
				  </tr>";
			$x++;
      }
  }
  else {
   // menampilkan pesan zero data
    echo "<script >
alert('Mohon maaf data yang dicari tidak ada !'); 
document.location='?file=adm_mhs';
</script>";;
  }
} 
else { echo "<script >
alert('Masukkan dulu kata kuncinya !'); 
document.location='?file=adm_mhs';
</script>";}
?>

  </tbody>
   
</table>
   <br /><input type="submit" value="tambah" />
   <br/>
</div></div></div>

<?php  ?>

<?php 

}elseif($_SESSION['level'] == "dosen"){
include "f_connect.php";

?>

<p style="font-family:trebuchet MS; color:#006633; font-size:18px; text-decoration:underline;">DAFTAR MAHASISWA YANG DIBIMBING</p>

<br/><p>
  
  <form action="?file=carimhs" method="post" name="pencarian" id="pencarian">
   <input type="text" name="search" id="search">
  <input type="submit" name="submit" id="submit" value="CARI">
  <em>*berdasarkan nim dan nama</em>
  </form>

</p><br/>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 8%;" align="center">NIM</th>
	   <th style="width: 25%;" align="center">NAMA</th>
	   <th style="width: 5%;" align="center">ANGKATAN</th>
	   <th style="width: 5%;" align="center">NILAI</th>
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
