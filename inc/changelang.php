<?php
require_once 'dbconn.php';
if (isset($_GET['lang'])&& $_GET['lang']=="ar")
{
    $_SESSION['lang']="ar";
}
else
{
    $_SESSION['lang']="en";
}



header("location:".$_SERVER['HTTP_REFERER']);













?>