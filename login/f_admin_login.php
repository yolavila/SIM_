<?php
session_start();
include "../f_connect.php"
?>

<div id="main">
    <table id="welcome" align="center">
        <td width="100%">
        <div style="float: center;">
            <div align="center"><h1>Selamat Datang Pada Sistem Informasi Manajemen SDM</h1><hr />
            </div>
            <div align="center">
            <label class="menu">Login Sebagai : </label>
            <select style="width: auto; height: 25px;"><option>Silahkan Pilih
                    <option onclick="document.location='?menu=login_admin'">Admin
                    <option onclick="document.location='?menu=login_Manager'">Manager</select>
            </div><hr style="width: 400px;">
    <div id="login"><center>Login Admin</center>
    <form action="?menu=cek_login" method="post">
        <table align="center">
            <tr>
                <td>Username</td>
                <td> : </td>
                <td><input class="ipt" type="text" name="username" /></td>
            </tr><tr>
                <td>Password</td>
                <td> : </td>
                <td><input class="ipt" type="password" name="password" /></td>
            </tr><tr>
                <td colspan="3" align="right"><input type="submit" class="button" name="l_admin" value="Login" /></td>
            </tr>
        </table>
    </form>
</div>
        </div>
        </td>
    </table>
</div>
