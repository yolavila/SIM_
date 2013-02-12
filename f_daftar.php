<?php

/**
 * @author ADMIN
 * @copyright 2011
 */



?>
<div id="main">
    <table id="welcome" align="center">
        <td width="100%">
        <div style="float: left;" id="content">
            <div><h1>Pendaftaran Kerja Praktek Mahasiswa UIN Sunan Kalijaga Yogyakarta</h1><hr />
            </div>
            <div id="daftar">
            <form action="?menu=cek_validasi" method="post">
            <table align="center">
            <tr>
                <td>No Slip Pembayaran</td>
                <td><input class="ipt" type="text" name="bayar_mhs"/></td>
            </tr><tr>
                <td><input type="hidden" name="id_mhs" /></td>
                <td><input class="button" type="submit" name="submit" value="Cek Slip Saya"/></td>
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