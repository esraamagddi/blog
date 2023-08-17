<?php
require_once '../inc/dbconn.php';
if (!isset($_SESSION['user_id']))
{
  header("location:../login.php");
}
else
{

    unset($_SESSION['user_id']);
    
    header("location:../Login.php");
}




?>