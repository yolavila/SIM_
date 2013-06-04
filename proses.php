<?php
	session_start();
	include "f_connect.php";
	if (!$_SESSION['username']){
		echo 0;
	} else {
		$mode = $_GET['mode'];
		if($mode == "tempat")
		{
			$sql = mysql_query("SELECT DISTINCT tempat_lahir as tl from applicant order by tempat_lahir ASC");
			while($result = mysql_fetch_array($sql))
			{
				echo "<option value='".$result['tl']."'>".$result['tl']."</option>";
			}
			echo "<option value='new'>*TAMBAH DATA BARU*</option>";
		}

		if($mode == "dobel")
		{
			$tmp = $_GET['tmp'];
			$tgl = $_GET['tgl'];
			$sql = mysql_query("SELECT * from applicant where tempat_lahir = '$tmp' AND DAYOFMONTH(tgl_lahir) = '$tgl'");
			$result = mysql_fetch_row($sql);
			if($result > 0)
			{
				echo FALSE;
			}
			else
			{
				echo TRUE;
			}
		}
	}
?>