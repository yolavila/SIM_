<?php
require("../../db_config.php");

$t=mysql_query("SELECT distinct nama FROM master_barang WHERE nama like '".$_GET["q"]."%'");

while($h=mysql_fetch_row($t)){
	$r.=$h[0]."|".$h[0]."|".$h[0]."\n";
	//$r.=$h[0]."|".$h[1]."|".$pCh[0]."\n";
}
echo $r;
?>



