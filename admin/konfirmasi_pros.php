<?php
	
	include "../f_connect.php";

	$no_ap=$_GET['no_applicant'];
	$status=$_GET['status'];
	//echo"$no_ap";
	$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_query());
		//while ($data=mysql_fetch_array($sql)){
		if($res = mysql_num_rows($sql) == 1)
		{
			//jika hadir
			if($status == 1)
			{
				$query=mysql_query("UPDATE penjadwalan SET Konfirmasi=1 where no_applicant='$no_ap'");
				$query1=mysql_query("UPDATE applicant SET status=3 where no_applicant='$no_ap'");
				echo 1;
			}
			//jika tidak hadir
			else
			{
				$query=mysql_query("UPDATE penjadwalan SET Konfirmasi=0 where no_applicant='$no_ap'");
				$query1=mysql_query("UPDATE applicant SET status=4 where no_applicant='$no_ap'");
				echo 1;
			}
		}
 
			
 
 // if($query){
	  // header('location:../../skripsi/home.php?file=konfirm');
 // }else{
 // echo "Update GAGAL";
 // }
 
 ?>