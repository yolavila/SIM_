<?php
	include "../f_connect.php";
	$no_ap = $_GET['no_applicant'];
	$tanggal = $_GET['tanggal'];
	//save
	$sql="INSERT INTO terminate VALUES ('$no_ap', '$tanggal')" ;
	if(mysql_query($sql))
	{
		echo 1;
	}
	else
	{
		echo mysql_error();
	}
?>