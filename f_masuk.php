<?php

/**
 * @author ADMIN
 * @copyright 2013
 */



?><div id="main">
    <table id="welcome" align="center">
        <td width="100%">
        <div style="float: center;">
            <div align="center"><h1>Selamat Datang Pada Sistem Informasi Manajemen SDM</h1><hr />
            </div>
            <div align="center">
            <label class="menu">Login Sebagai : </label>
            <select style="width: auto; height: 25px;" onChange="if(this.value) window.location.href=this.value"><option value="">Silahkan Pilih</option>
                    <option value="?menu=login_admin">Admin</option>
                    <option value="?menu=login_manager">Manager</option>
            </select>
            </div><hr style="width: 400px;">
        </div>
        </td>
    </table>
</div>
