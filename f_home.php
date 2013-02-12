<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
if (!$_SESSION['username']){
?>
<div id="main">
    <table id="welcome" align="center">
        <td width="70%">
        <div style="float: left;" id="content">
           <div>
           <p align="center" style="font-size: 20px;">Selamat Datang <b><?php echo $_SESSION['username'];?></b> di Halaman Administrator</p>
            </div>
        </div>
        </td>
        <td width="30%">
        </td>
    </table>
</div>
<?php 
}
?>