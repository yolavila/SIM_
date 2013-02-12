<?php
session_start();
include "../f_connect.php";
if ($_SESSION['level']=='mahasiswa'){
$sql = mysql_query ("select * from konsultasi where konsultasi.pengirim='$_SESSION[username]' or konsultasi.penerima='$_SESSION[username]'");
while ($row = mysql_fetch_array($sql)){
    echo "<br><strong><font color='#006633'>$row[pengirim]  </font>: $row[pesan]</strong> <br/> <font  style='font-style:italic'> --- $row[tgl] </font> <br>";
}
}elseif($_SESSION['level']=='dosen'){
$sql = mysql_query ("select * from konsultasi where konsultasi.pengirim='$_SESSION[username]' or konsultasi.penerima='$_SESSION[username]'
");
while ($row = mysql_fetch_array($sql)){
    echo "<br><strong><font color='#006633' face='trebuchet MS'> $row[pengirim]</font> : <font face='trebuchet MS'>$row[pesan] </font></strong><br/> <font  style='font-style:italic' color='#0000FF'> --- $row[tgl] </font><br>";
}
}

?>