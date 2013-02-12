<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
error_reporting(0);
include "f_connect.php";
$id_mhs = $_POST['bayar_mhs'];
$bayar_mhs = $_POST['bayar_mhs'];
$check=mysql_query("select * from mahasiswa where bayar_mhs='$bayar_mhs'");
$checking=mysql_num_rows($check);
$check2=mysql_query("select from mahasiswa");
$checking2=mysql_fetch_array($check);
if (empty($checking)){
    $sql = mysql_query("SELECT * FROM un_mahasiswa WHERE bayar_mhs = '$bayar_mhs'");
    if (mysql_num_rows($sql)>0) {
       $row  = mysql_fetch_array($sql);
?>
<div id="welcome">
<h1 align="center">Informasi Data Pemilik No Slip Pembayaran <?php echo $bayar_mhs;?></h1>
<hr />
<div id="daftar">
    <form action="?menu=proses" method="post">
        <table align="center">
            <tr>
                <td>No Slip Pembayaran</td>
                <td> : </td>
                <td><b><?php echo $bayar_mhs;?></b></td>
            </tr><tr>
                <td>Nama Mahasiswa</td>
                <td> : </td>
                <td><b><?php echo $row['nama_mhs'];?></b></td>
            </tr><tr>
                <td>Nim Mahasiswa</td>
                <td> : </td>
                <td><b><?php echo $row['nim_mhs'];?></b></td>
            </tr><tr>
                <td>Fakultas</td>
                <td> : </td>
                <td><b><?php echo $row['fk_mhs'];?></b></td>
            </tr><tr>
                <td>Jurusan</td>
                <td> : </td>
                <td><b><?php echo $row['jrs_mhs'];?></b></td>
            </tr>            
            <tr>
                <td><input type="hidden" name="id_mhs" /><td></td>
                <input type="hidden" name="bayar_mhs" value="<?php echo $row['bayar_mhs'];?>">
                <input type="hidden" name="nama_mhs" value="<?php echo $row['nama_mhs'];?>">
                <input type="hidden" name="nim_mhs" value="<?php echo $row['nim_mhs'];?>">
                <input type="hidden" name="fk_mhs" value="<?php echo $row['fk_mhs'];?>">
                <input type="hidden" name="jrs_mhs" value="<?php echo $row['jrs_mhs'];?>"></td>
                <td><input class="button" type="submit" name="submit" value="Ini Data Saya"/>
                <input class="button" type="button" onclick="document.location='?menu=daftar'" value="Bukan Saya"/></td>
            </tr>
        </table>
    </form>
</div>
<div id="catatan">
<p>Keterangan : </p>
<p>*) No Slip Pembayaran merupakan nomor yang didapatkan dari Bank tempat anda melakukan registrasi</p>
<p>*) Pastikan No Slip Pembayaran yang anda masukkan sesuai dengan slip pembayaran aslinya</p>
<p>*) Jika anda suda yakin, Silahkan klik tombol "Cek Slip Saya" untuk melanjutkan pendaftaran</p>
</div>
</div>
<?php
}
else echo "<script language='javascript'>
	alert('No Slip Anda salah / Anda belum memasukan no slip...  ');
	document.location='?menu=daftar';
	</script>";
} else {
    echo "<script language='javascript'>
	alert('Anda telah terdaftar dengan ID $checking2[id_mhs] pada tanggal $checking2[tgl_daftar]. System akan mengarahkan anda pada menu login');
	document.location='?menu=login_mahasiswa';
	</script>";
}
?>