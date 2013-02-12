<?php
session_start();
unset($_SESSION['username']);

session_destroy();


// now that the user is logged out,
// go to login page
header('Location:index.php');

?> 

