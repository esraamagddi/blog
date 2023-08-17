<?php require_once 'inc/header.php' ?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
require_once 'inc/dbconn.php';
if (isset($_GET['id']))
{
  $id=$_GET['id'];
}
else
{
  header("location:index.php");
}
  $query="select * from posts where id=$id";
  $runquey=mysqli_query($conn,$query);
  
  if (mysqli_num_rows($runquey)==1)
  {
    
    $post=mysqli_fetch_assoc($runquey);

  }
  else
  {
    $msg= "no posts founded";
  }


?>
    
<div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <!-- <h2>Our Background</h2> -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/postImage/<?= $post['image'] ?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?= $post['title'] ?></h4>
              <p><?= $post['body'] ?></p>
              <h5><?= $post['created_at'] ?></h5><br>
              
              <div class="d-flex justify-content-center">
                  <a href="editPost.php?id=<?= $post['id']?>" class="btn btn-success mr-3 "> edit post</a>
              
                  <a href="handler/handledeletepost.php?id=<?= $post['id']?>" class="btn btn-danger "> delete post</a>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
