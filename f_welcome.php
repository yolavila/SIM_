<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
if (!$_SESSION['username']){
?>
<div id="main">
    <table width="28%" align="center" id="welcome">
        <td width="99%">
        <div style="float: center;" id="content">
            <div><h1 align="center">Selamat Datang</h1><hr />
            </div>
			<center><div id="menu_admin1">
		    <input type="button" value="Login" onclick="document.location='?menu=masuk'" />
			</div></center>
</div>
<?php 
} else {
?>
<div style="padding-left: 30px;padding-right: px; font-family:trebuchet MS;"><p align='center' style='font-size: 25px;'>
</div></div></div></div></div>
<?php
}
?>