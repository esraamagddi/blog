<?php
require_once '../inc/dbconn.php';

if (isset($_POST['submit']))
{
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['password']));
    $errors=[];
    
    if (empty($email))
    {
        $errors[]="email is required";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $errors[]="email not correct";
    }

    if (empty($password))
    {
        $errors[]="password is required";
    }
    elseif(strlen($password)<6)
    {
        $errors[]="password must be more than 6 chars";
    }

    $query=" select * from users where `email`='$email' ";

    $runquery=mysqli_query($conn,$query);
    
    if (mysqli_num_rows($runquery)==1)
    {
        $user=mysqli_fetch_assoc($runquery);
        $hashed_password=$user['password'];
        $user_name=$user['name'];
        $user_id=$user['id'];
        $password_verify=password_verify($password,$hashed_password);
        if($password_verify)
        {
            $_SESSION['user_id']=$user_id;
            $_SESSION['success']="welcome $user_name";
            header("location:../index.php");
        }
        else
        {
            $_SESSION['errors']=["credintional not correct"];
            header("location:../Login.php");


        }
    }
    else
    {
        $_SESSION['errors']=["this account not exist"];
        header("location:../Login.php");

    
    }


}
else
{
header("location:../Login.php");
}








?>