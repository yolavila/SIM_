<?php
	include include "../f_connect.php";
	
	function check_hired_terminate($id)
	{
		$query = "SELECT applicant.*, hired.*, terminate.* from applicant INNER JOIN hired on applicant.no_applicant=hired.no_applicant LEFT JOIN terminate on applicant.no_applicant = terminate.no_applicant where 1 and no_applicant = '$id'";
		$sqlquery = mysql_query($query) or die(mysql_error());
		$arr = mysql_fetch_array($sqlquery);
		if(!empty($arr))
		{
			//delete hired
			$query = "DELETE FROM hired where no_applicant = $id";
			$sqlquery = mysql_query($query) or die(mysql_error());
			
			//delete terminate
			$query = "DELETE FROM terminate where no_applicant = $id";
			$sqlquery = mysql_query($query) or die(mysql_error());
			
			$query = "DELETE FROM jadwal_user where no_applicant = $id";
			$sqlquery = mysql_query($query) or die(mysql_error());
			
			$query = "DELETE FROM penjadwalan where no_applicant = $id";
			$sqlquery = mysql_query($query) or die(mysql_error());
		}
	}
	
	function check_penjadwalan($id)
	{
		$query = "SELECT applicant.*, jadwal_user.*, penjadwalan.* from applicant INNER JOIN penjadwalan on applicant.no_applicant=penjadwalan.no_applicant LEFT JOIN terminate on applicant.no_applicant = terminate.no_applicant where 1 and no_applicant = '$id'";
	}
?>