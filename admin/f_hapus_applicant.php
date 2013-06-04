<?php
	include "../f_connect.php";
	
	$no_ap=$_GET['no_applicant'];
	
	$sql=mysql_query("SELECT * from applicant where no_applicant='$no_ap'") or die (mysql_error());
	
	if($res = mysql_num_rows($sql) == 1)
	{
		//$query=mysql_query("DELETE from applicant where no_applicant='$no_ap'");
		$query=mysql_query("UPDATE applicant SET status = 8 WHERE no_applicant = '$no_ap'") or die(mysql_error());
		//masukkan ke dalam tabel terminate
		$query_terminate = mysql_query("INSERT INTO terminate VALUES ('$no_ap', CURDATE())");
		echo 1;
	}
?>