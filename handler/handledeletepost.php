<?php
 require_once '../inc/dbconn.php';


 if (!isset($_SESSION['user_id']))
{
  header("location:../login.php");
}
else
{

    if(isset($_GET['id']))
    {
        
        
        $id=$_GET['id'];
    
        $query="select id,image from posts where id=$id";

        $runquery=mysqli_query($conn,$query);
        
        if (mysqli_num_rows($runquery)==1)
        {   
        $post=mysqli_fetch_assoc($runquery);
        $image=$post['image'];
        if (!empty($image))
        {

            unlink("../assets/images/postImage/$image");
            $query="delete from posts where id = $id ";
            
            $runquery=mysqli_query($conn,$query);
            
            if ($runquery)
            {
                $_SESSION['success']="post deleted successfully";
                header("location:../index.php");
            }
        }

    }
    else
    {
        $_SESSION['error']="post not found";
        header("location:../index.php");
        
    }
}
 else 
 {
    header("location:../index.php");
}
}




?>