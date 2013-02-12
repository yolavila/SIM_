<?php
	include("../../db_config.php");
	if ($_GET['action']=="reset")
	{
$user = $_GET['npa'];	
$pass = md5($user);
	
	$query = mysql_query("update anggota set password = '$pass' where npa = '$user'")or die(mysql_error());
	if($query)
	{
		echo 1;
	}
	else
	{
		echo "proses reset password gagal";
	}
	
	}
?>