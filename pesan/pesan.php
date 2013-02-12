<?php
/**
 * @author ADMIN
 * @copyright 2011
 */
session_start();
?>
<script>
var x = 1;
function cek(){
    $.ajax({
        url: "pesan/cekpesan.php",
        cache: false,
        success: function(msg){
            $("#baca").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}
$(document).ready(function(){
    cek();
});
</script>
<?php
include "./f_connect.php";
if ($_SESSION['level']=='mahasiswa'){
$sql = mysql_query ("select * from mahasiswa where username=$_SESSION[username]");
$row = mysql_fetch_array($sql);
echo "<span id='baca'></span>";
echo "
<form action='home.php?file=psnkirim' method='post'>
    <table>
        <tr>
            <td><br/></td>
            <td><br/></td>
			<br/><br/>
        </tr>
		<tr>
            <td>Kepada Dosen Pembimbing  : </td>
            <td>$row[nama_dosen]</td>
        </tr><tr>
            
            <td><textarea name='pesan'></textarea></td>
        </tr><tr>
        <td><input type='hidden' name='pengirim' value='$_SESSION[username]'>
        <input type='hidden' name='penerima' value='$row[id_dos]'>
        <input type='submit' value='Kirim'></td>
    </table>
</form>";
}elseif ($_SESSION['level']=='dosen'){
$sql = mysql_query ("select * from mahasiswa where id_dos='$_SESSION[username]'");
while($row = mysql_fetch_array($sql)) {
$id=$row["username"];
$thing1=$row["nama_mhs"]; 
$mhs.="<OPTION VALUE=\"$thing1\">".$thing1; 
}
echo "<span id='baca'></span>";
echo "
<form action='home.php?file=psnkirim' method='post'>
    <table>
       
		<tr>
            <td><br/></td>
            <td><br/></td>
			<br/><br/>
        </tr>
		<tr>
            <td>Kepada Mahasiswa : </td>
            <td><select name='mhs><option value=''>$mhs</option></select></td>
        </tr><tr>
            <td></td>
            <td><textarea name='pesan'></textarea></td>
        </tr><tr>
        <td><input type='hidden' name='pengirim' value='$_SESSION[username]'>
        <input type='hidden' name='penerima' value='$id'></td>
        <td><input type='submit' value='Kirim'></td>
    </table>
</form>";    

}
?>