<?php
require_once '../inc/dbconn.php';

 if (isset($_POST['submit']))
 {
    $title=trim(htmlspecialchars($_POST['title']));
    $body=trim(htmlspecialchars($_POST['body']));

   
    $error=[];

    if(empty($title))
    {
        $error[]="title is required";
    }elseif(is_numeric($title))
    {
        $error[]="title must be string";

    }

    if(empty($body))
    {
        $error[]="body is required";
    }elseif(is_numeric($body))
    {
        $error[]="body must be string";

    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
    {   

        $image=$_FILES['image'];
        $image_name=$image['name'];
        $tmp_name=$image['tmp_name'];
        $ext=strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
        $image_error=$image['error'];
        $image_size=$image['size']/(1024*1024);
    

        if($image_error !=0 )
        {
            $error[]="image not found ";
        }elseif($image_size>1)
        {
            $error[]="large size image";
        }elseif(! in_array($ext,["png","jpg","jpeg","gif"]))
        {
            $error[]="image not correct ";
        }
        $new_name=uniqid().".".$ext;
    }
    else
    {
        $new_name=null;
    }
    if(empty($error))
    {
        //insert
$query="insert into posts (`title`,`body`,`image`,`user_id`) values ('$title','$body','$new_name',1 )";
        
         $runquery=mysqli_query($conn,$query);
         if ($runquery)
         {  
            if(isset($_FILES['image']) && $_FILES['image']['name'])
            {
                
                move_uploaded_file($tmp_name,"../assets/images/postImage/$new_name");
            }
                $_SESSION['success']="post inserted successfully";
                header("location:../index.php");

         }else
         {
            $_SESSION['errors']=["error while inserting"];
            header("location:../addPost.php");

         }
    }
    else
    {   
        $_SESSION['errors']=$error;
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        header("location:../addPost.php");
    }

 }
 else
 {
    header("location:../addPost.php");
 }







?>