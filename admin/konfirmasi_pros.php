<?php
mysql_connect("localhost", "root", "");
mysql_select_db("sim");

	$no_ap=$_GET['no_applicant'];
	//echo"$no_ap";
	$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_query());
		//while ($data=mysql_fetch_array($sql)){
		if($res = mysql_num_rows($sql) == 1)
		{
			$query=mysql_query("UPDATE penjadwalan SET Konfirmasi='Hadir' where no_applicant='$no_ap'");
			echo 1;
		}
 
			
 
 // if($query){
	  // header('location:../../skripsi/home.php?file=konfirm');
 // }else{
 // echo "Update GAGAL";
 // }
 
 ?>