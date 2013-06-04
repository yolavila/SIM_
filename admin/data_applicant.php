<?php 
if($_SESSION['level'] == "admin"){
	$search = "";
	$searchOptions = $_POST['pilihan'];
	$qWord = $_POST['data_cari'];
	$searchMode = false;
	if(isset($_POST['search']) && $qWord != "")
	{
		$search = $qWord;
		$searchMode = true;
	}
	if(isset($_POST['search']) && $qWord === "")
	{
		echo "Please, fill the search box";
	}
	if(isset($_POST['clear']))
	{
		$searchOptions = "clear";
		$qWord = "";
	}
	
	function getStatus($status) {
		switch($status)
		{
			case 1 : return "buffer"; break;
			case 2 : return "terjadwal"; break;
			case 3 : return "hadir"; break;
			case 4 : return "tidak hadir"; break;
			case 5 : return "qualified"; break;
			case 6 : return "not qualified"; break;
			case 7 : return "hired"; break;
			case 8 : return "terminate"; break;
		}
	}

?>
<h3>Daftar Applicant</h3>

<form name="form1" method="POST" action="?file=adm_data">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no" <?php echo ($searchOptions == "no" ? "selected" : ""); ?>>No Applicant</option>
	<option value="nama" <?php echo ($searchOptions == "nama" ? "selected" : ""); ?>>Nama Applicant</option>
	<option value="penempatan" <?php echo ($searchOptions == "penempatan" ? "selected" : ""); ?>>Penempatan</option>
	<option value="posisi" <?php echo ($searchOptions == "posisi" ? "selected" : ""); ?>>Posisi</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari" value="<?php echo $qWord; ?>"></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching">
	<input name="clear" class="button" type="submit" id="clearSearch" value="Clear Search">
	</td>
	</table>
</form>

</p><br/>

	<a href='?file=adm_applicant'><img src='images/op.png' width='16' height='16' border='0'>Tambah Data Applicant</a><br/><br/> 


<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 12%;" align="center">No Applicant</th>
	   <th style="width: 23%;" align="center">Nama Lengkap</th>
	   <th style="width: 15%;" align="center">Penempatan</th>
	   <th style="width: 15%;" align="center">Posisi</th>
	   <th style="width: 10%;" align="center">AKSI</th>
	   <th style="width: 15%;" align="center">STATUS</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
  $batas=10;
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

  
		$query = "SELECT * from applicant where 1";
		if($searchOptions == "no")
		{
			$query = $query." and no_applicant = '$search'";
		}
		if($searchOptions == "nama")
		{
			$query = $query." and nama_lengkap LIKE '%$search%'";
		}
		if($searchOptions == "penempatan")
		{
			$query = $query." and penempatan LIKE '%$search%'";
		}
		if($searchOptions == "posisi")
		{
			$query = $query." and posisi LIKE '%$search%'";
		}
		if($searchOptions == "clear")
		{
			$query = "SELECT * from applicant where 1 and status != 8 ";
		}
		$x=$posisi+1;
		//add order
		$query = $query." order by no_applicant DESC limit $posisi,$batas";		
		$sql=mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($sql) > 0){

		while($row=mysql_fetch_array($sql)){
			echo "<tr>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[no_applicant]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_lengkap]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[penempatan]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[posisi]</td>
					<td style='border:1px solid #CBF3C2; width: 15%;'><center>
					<a href=\"#\" onclick=\"AddtoPenjadwalan($row[no_applicant]);return false;\"><img src='images/check.png' width='16' height='16' border='0'></a> |
                    <a href='?file=adm_applicant&id_applicant=$row[no_applicant]&mode=view'><img src='images/det.png' width='16' height='16' border='0'></a> | 
					<a href='?file=adm_applicant&id_applicant=$row[no_applicant]&mode=edit'><img src='images/edit.png' width='16' height='16' border='0'></a> |
					<a href='#' onclick='deleteApplicant($row[no_applicant]);return false;'><img src='images/del.png' width='16' height='16' border='0'></a>
					</td>
					<td style='border:1px solid #CBF3C2;' align='center'>".getStatus($row['status'])."</td>
					<input type=\"hidden\" id=\"status_".$row[no_applicant]."\" value=".$row['status'].">
		         </tr>";
			$x++;
		  }
		} else {
		  echo "<tr>
					<td colspan='5' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";
		}
		
  ?>
   </tbody>
  
</table>
 <br />
 <?php
 $file="?file=adm_data";

$tampil2="SELECT * from applicant";

$hasil2=mysql_query($tampil2);
$jmldat=mysql_num_rows($hasil2);

$jmlhalama=ceil($jmldat/$batas);


//link ke halaman sebelumnya (previous)
if($hal > 1)
{
$previous=$hal-1;
echo "<a href=$file&&hal=1><< First</a> | 
<a href=$file&&hal=$previous>< Previous</a> | ";
}
else
{ 
echo "<< First | < Previous | ";
}

$angk =($hal > 3 ? " ... " : " ");
for($k=$hal-2;$k<$hal;$k++)
{
if ($k < 1) 
continue;
$angk .= "<a href=$file&&hal=$k>$k</a> ";
}

$angk .= " <b>$hal</b> ";
for($k=$hal+1;$k<($hal+3);$k++)
{
if ($k > $jmlhalama) 
break;
$angk .= "<a href=$file&&hal=$k>$k</a> ";
}

$angk .= ($hal+2<$jmlhalama ? " ... 
<a href=$file&&hal=$jmlhalama>$jmlhalama</a> " : " ");

echo "$angk";

//link kehalaman berikutnya (Next)
if($hal < $jmlhalama)
{
$next=$hal+1;
echo " | <a href=$page&&hal=$next>Next ></a> | 
<a href=$file&&hal=$jmlhalama>Last >></a> ";
}
else
{ 
echo " | Next > | Last >>";
}
echo "<p>Total Applicant : <b>$jmldat</b> Applicant</p>";

?>

      <br />
	     <br />
</div></div></div>
<script type="text/javascript">
	function AddtoPenjadwalan(id)
	{
	
	//check if registrant is ever scheduled or not
	var status_reg = document.getElementById("status_"+id).value;
	if(status_reg == 1)
	{
		var conf = confirm("Tambahkan ke daftar penjadwalan?");
		
		if(conf==true)
		{
			$.ajax({
				url:"admin/jadwal_add.php?no_applicant="+id,
				type:"GET",
				success:function(hasil)
				{
					if(hasil==1)
					{
						//alert("ok");
						window.location = "home.php?file=penjadwalan";
					}
					else
					{
						alert(hasil);
					}
				}
			 });
		}
	}
	else
	{
		alert("Pendaftar ini sudah terjadwal.");
	}
	
	}
	
	function deleteApplicant(id)
	{
	
	var conf = confirm("Yakin ingin menghapus applicant ini? \n Menghapus akan membuat applicant menjadi terminate");
	
	if(conf==true)
	{
		$.ajax({
			url:"admin/f_hapus_applicant.php?no_applicant="+id,
			type:"GET",
			success:function(hasil)
			{
				if(hasil==1)
				{
					alert("applicant berhasil dihapus");
					window.location = "home.php?file=adm_data";
				}
				else
				{
					alert(hasil);
				}
			}
		 });
	}
	
	}
</script>
<?php  ?>

<?php 

}else{
	$search = "";
	$searchOptions = $_POST['pilihan'];
	$qWord = $_POST['data_cari'];
	$searchMode = false;
	if(isset($_POST['search']) && $qWord != "")
	{
		$search = $qWord;
		$searchMode = true;
	}
	if(isset($_POST['search']) && $qWord === "")
	{
		echo "Please, fill the search box";
	}
	if(isset($_POST['clear']))
	{
		$searchOptions = "clear";
		$qWord = "";
	}
	
	function getStatus($status) {
		switch($status)
		{
			case 1 : return "buffer"; break;
			case 2 : return "terjadwal"; break;
			case 3 : return "hadir"; break;
			case 4 : return "tidak hadir"; break;
			case 5 : return "qualified"; break;
			case 6 : return "not qualified"; break;
			case 7 : return "hired"; break;
			case 8 : return "terminate"; break;
		}
	}

?>
<h3>Daftar Applicant</h3>

<form name="form1" method="POST" action="?file=adm_data">
	Cari: <select name="pilihan" id="pilihan">
	<option value="no" <?php echo ($searchOptions == "no" ? "selected" : ""); ?>>No Applicant</option>
	<option value="nama" <?php echo ($searchOptions == "nama" ? "selected" : ""); ?>>Nama Applicant</option>
	<option value="penempatan" <?php echo ($searchOptions == "penempatan" ? "selected" : ""); ?>>Penempatan</option>
	</select></tr>
	<input name="data_cari" type="text" id="data_cari" value="<?php echo $qWord; ?>"></input></td>
	<input name="search" class="button" type="submit" id="search" value="Searching">
	<input name="clear" class="button" type="submit" id="clearSearch" value="Clear Search">
	</td>
	</table>
</form>

</p><br/>

<table width="100%">
   <thead style="height: font-family:trebuchet MS; auto;">
     <tr bgcolor="#8DD3FF">
	   <th style="width: 3%;" align="center">NO</th>
	   <th style="width: 15%;" align="center">No Applicant</th>
	   <th style="width: 30%;" align="center">Nama Lengkap</th>
	   <th style="width: 20%;" align="center">Penempatan</th>
	   <th style="width: 15%;" align="center">Posisi</th>
	   <th style="width: 10%;" align="center">STATUS</th>
     </tr>
   </thead>
   <tbody id="tableBody" style="font-family:trebuchet MS;">
  <?php
    $batas=10;
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
		$query = "SELECT * from applicant where 1";
		if($searchOptions == "no")
		{
			$query = $query." and no_applicant = '$search'";
		}
		if($searchOptions == "nama")
		{
			$query = $query." and nama_lengkap LIKE '%$search%'";
		}
		if($searchOptions == "penempatan")
		{
			$query = $query." and penempatan LIKE '%$search%'";
		}
		if($searchOptions == "clear")
		{
			$query = "SELECT * from applicant where 1 and status != 8 ";
		}
		//add order
		$query = $query." order by no_applicant DESC limit $posisi,$batas";		
		$sql=mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($sql) > 0){
		  $x = 1;
		  while($row=mysql_fetch_array($sql)){
			echo "<tr>
					<td style='border:1px solid #CBF3C2;' align='center'>$x</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[no_applicant]</td>
                    <td style='border:1px solid #CBF3C2;' align='center'>$row[nama_lengkap]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[penempatan]</td>
					<td style='border:1px solid #CBF3C2;' align='center'>$row[posisi]</td>					
					<td style='border:1px solid #CBF3C2;' align='center'>".getStatus($row['status'])."</td>
					<input type=\"hidden\" id=\"status_".$row[no_applicant]."\" value=".$row['status'].">
		         </tr>";
			$x++;
		  }
		} else {
		  echo "<tr>
					<td colspan='5' style='border:1px solid #CBF3C2;font-size:20px;' align='center'>Data Kosong</td>
                    </td>
				  </tr>";
		}
  ?>
   </tbody>
  
</table>
 <br />
      <br />
	     <br />
 <?php
 $file="?file=adm_data";

$tampil2="SELECT * from applicant";

$hasil2=mysql_query($tampil2);
$jmldat=mysql_num_rows($hasil2);

$jmlhalama=ceil($jmldat/$batas);


//link ke halaman sebelumnya (previous)
if($hal > 1)
{
$previous=$hal-1;
echo "<a href=$file&&hal=1><< First</a> | 
<a href=$file&&hal=$previous>< Previous</a> | ";
}
else
{ 
echo "<< First | < Previous | ";
}

$angk =($hal > 3 ? " ... " : " ");
for($k=$hal-2;$k<$hal;$k++)
{
if ($k < 1) 
continue;
$angk .= "<a href=$file&&hal=$k>$k</a> ";
}

$angk .= " <b>$hal</b> ";
for($k=$hal+1;$k<($hal+3);$k++)
{
if ($k > $jmlhalama) 
break;
$angk .= "<a href=$file&&hal=$k>$k</a> ";
}

$angk .= ($hal+2<$jmlhalama ? " ... 
<a href=$file&&hal=$jmlhalama>$jmlhalama</a> " : " ");

echo "$angk";

//link kehalaman berikutnya (Next)
if($hal < $jmlhalama)
{
$next=$hal+1;
echo " | <a href=$page&&hal=$next>Next ></a> | 
<a href=$file&&hal=$jmlhalama>Last >></a> ";
}
else
{ 
echo " | Next > | Last >>";
}
echo "<p>Total Applicant : <b>$jmldat</b> Applicant</p>";

?>

</div></div></div>
<?php
	}
?>