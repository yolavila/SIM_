<?php

	include "../db_config.php";
		
	require_once("mysql_backup.php");

	
	$mysql_dump = new MYSQL_DUMP($host,$user,$password);
	$sql = $mysql_dump->dumpDB($db,HAR_ALL_TABLES, HAR_ALL_OPTIONS);

	if($sql==false)
		echo $mysql_dump->error();

	//dump backup

	//$nilx2 = "_$jam$menit$detik";
	$nama_file = "$db.sql";
	$mysql_dump->download_sql($sql,$nama_file);


	//re-direct
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=backup/tampil_backup.php";
	<?php
	exit();
	
?>