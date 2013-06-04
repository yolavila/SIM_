<?php
	
	include "../f_connect.php";

	$no_ap=$_GET['no_applicant'];
	$status=$_GET['status'];
	$tanggal=date("Y-m-d");
	//echo"$no_ap";
	$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_query());
		//while ($data=mysql_fetch_array($sql)){
		if($res = mysql_num_rows($sql) == 1)
		{
			//jika qualified
			if($status == 1)
			{
				$query1=mysql_query("UPDATE result SET hasil=1, tanggal=$tanggal where no_applicant='$no_ap'") or die (mysql_query());
				$query2=mysql_query("UPDATE applicant SET status=5 where no_applicant='$no_ap'") or die (mysql_query());
				echo 1;
			}
			//jika tidak qualified
			else
			{
				$query1=mysql_query("UPDATE result SET hasil=0 where no_applicant='$no_ap'") or die (mysql_query());
				$query2=mysql_query("UPDATE applicant SET status=6 where no_applicant='$no_ap'") or die (mysql_query());
				echo 1;
			}
		}
 
			
 
 // if($query){
	  // header('location:../../skripsi/home.php?file=result');
 // }else{
 // echo "Update GAGAL";
 // }
 
 ?>