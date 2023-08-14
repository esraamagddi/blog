
<?php require_once 'inc/header.php' ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <?php
    require_once 'inc/dbconn.php';

    $query="select id, title, image, created_at from posts";

    $runquery=mysqli_query($conn,$query);


    if (mysqli_num_rows($runquery)>0)
    {
      $posts=mysqli_fetch_all($runquery,MYSQLI_ASSOC);

    }
    else
    {
      $msg= "no posts founded";
    }
    
    
    ?>

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
          <?php
            if(!empty($posts)):
          ?>
          <?php
          foreach($posts as $post):
          ?>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="assets/images/postImage/<?= $post['image']?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?= $post['title']?></h4></a>
                <h6><?= $post['created_at']?></h6>
                <p><?php // $post['desc'] loream ?> </p>

                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?=$post['id'];?>" class="btn btn-info "> view</a>
                </div>
                
              </div>
            </div>
          </div>
          <?php
          endforeach;
          
        else:
          echo $msg;
        endif;
          ?>
        </div>
      </div>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
