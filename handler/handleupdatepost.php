<?php

require_once '../inc/dbconn.php';
// submit   post   validation   check=1  delete_img insert_image  > update
if (isset($_POST['submit']) && isset($_GET['id']))
{
    $id=$_GET['id'];
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

    $query="select * from posts where id=$id";

    $runquery=mysqli_query($conn,$query);

    if (mysqli_num_rows($runquery)==1)
    {
        $post=mysqli_fetch_assoc($runquery);

        $old_name=$post['image'];

        if (isset($_FILES['image']) && $_FILES['image']['name'])
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
            $new_name=$old_name;
        }

    }
    else
    {
        header("location:../index.php");

    }





    if (empty($error))
    {

        $query="update posts set `title`='$title',`body`='$body',`image`='$new_name' where id=$id";
        
        $runquery=mysqli_query($conn,$query);
        
        if ($runquery)
        {   
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
            {
                unlink("../assets/images/postImage/$old_name");
                move_uploaded_file($tmp_name,"../assets/images/postImage/$new_name");

            }
            $_SESSION['success']="post updated successfully";
            header("location:../viewPost.php?id=$id");
        }
        else
        {
            $_SESSION['errors']=["error while updating"];

        }
    }
    else
    {
        $_SESSION['errors']=$error;
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        header("location:../editPost.php");
    }


}
else 
{
    header("location:../index.php");
}


?>