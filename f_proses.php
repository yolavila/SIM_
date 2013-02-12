<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
 if (isset($_POST['submit'])){
$id_mhs = $_POST['id_mhs'];
$bayar_mhs = $_POST['bayar_mhs'];
$nama_mhs = $_POST['nama_mhs'];
$nim_mhs = $_POST['nim_mhs'];
$fk_mhs = $_POST['fk_mhs'];
$jrs_mhs = $_POST['jrs_mhs'];
?>
<div id="welcome">
<h1 align="center">Informasi Data Pemilik No Slip Pembayaran <?php echo $bayar_mhs;?></h1>
<hr />
<div id="daftar">
    <form action="?menu=proses2" method="post">
        <table align="center">
            <tr>
                <td class="dftr" colspan="3"><b>Informasi Data Umum</b></td>
            </tr><tr>
                <td style="padding-top: 15px;">No Slip Pembayaran</td>
                <td style="padding-top: 15px;"> : </td>
                <td style="padding-top: 15px;"><b><?php echo $bayar_mhs;?></b></td>
            </tr><tr>
                <td>Nama Mahasiswa</td>
                <td> : </td>
                <td><b><?php echo $nama_mhs;?></b></td>
            </tr><tr>
                <td>Nim Mahasiswa</td>
                <td> : </td>
                <td><b><?php echo $nim_mhs;?></b></td>
            </tr><tr>
                <td>Fakultas</td>
                <td> : </td>
                <td><b><?php echo $fk_mhs;?></b></td>
            </tr><tr>
                <td>Jurusan</td>
                <td> : </td>
                <td><b><?php echo $jrs_mhs;?></b></td>
            </tr><tr>
                <td class="dftr" colspan="3"><b>Formulir Informasi Keamanan</b></td>
            </tr><tr>
                <td style="padding-top: 15px;">Username</td>
                <td style="padding-top: 15px;"> : </td>
                <td style="padding-top: 15px;"><?php echo $nim_mhs?></td>
            </tr><tr>
                <td>Password</td>
                <td> : </td>
                <td><input class="ipt" type="password" name="password" /></td>
            </tr><tr>
                <td>Email</td>
                <td> : </td>
                <td><input class="ipt" type="text" name="email" /></td>
            </tr>
			<tr>
                <td>Angkatan</td>
                <td> : </td>
                <td><select name="angkatan" style="width:90px">
                  <option>2005</option>
                  <option>2006</option>
                  <option>2007</option>
                  <option>2008</option>
                  <option>2009</option>
                  <option>2010</option>
                </select></td>
			</tr><tr>
                <td><input type="hidden" name="id_mhs" /><td></td>                
                <input type="hidden" name="bayar_mhs" value="<?php echo $bayar_mhs;?>">
                <input type="hidden" name="nama_mhs" value="<?php echo $nama_mhs;?>">
                <input type="hidden" name="nim_mhs" value="<?php echo $nim_mhs;?>">
                <input type="hidden" name="fk_mhs" value="<?php echo $fk_mhs;?>">
                <input type="hidden" name="jrs_mhs" value="<?php echo $jrs_mhs;?>">
                <input type="hidden" name="username" value="<?php echo $nim_mhs;?>" /></td>
                <td><input class="button" type="submit" name="submit" value="Oke"/>
                <input class="button" type="reset" value="Reset"/></td>
            </tr>
        </table>
    </form>
</div>
<div id="catatan">

</div>
</div>
<?php } else {
} ?>
