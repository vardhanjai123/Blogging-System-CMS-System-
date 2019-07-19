
   <?php include "includes/db.php"; ?>
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
        <!-- Blog Entries Column -->
            <div class="col-md-8">
               
               
                
                
                <?php
                
                if(isset($_GET['p_id']))
                {
                    $the_post_id=$_GET['p_id'];
                
                 $query="SELECT * FROM posts where post_id=$the_post_id";
                    
                 $select_all_posts_query=mysqli_query($connection,$query);
                    
                    
                    while($row=mysqli_fetch_assoc($select_all_posts_query))
                    {
                        $post_title=$row['post_title'];
                        $post_author=$row['post_author'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];
                        
                        ?>
                        
                        
                <h1 class="page-header">
                    Page Heading <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php  echo $post_title ?></a>
                </h2>
                <p class="lead"> by <a href="index.php"><?php  echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php  echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo "$post_image";?>" alt="">
                <hr>
                <p><?php  echo $post_content ?></p>
                
<!--                <a href="admin/includes/view_all_bookmarks.php?p_id=<?php echo $the_post_id; ?>"><button class="btn btn-success"><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Add to Bookmark</button></a>
                -->
                <form action="" method="post">
                <button class="btn btn-success" value="<?php echo $the_post_id; ?>" name="insert_bookmark"><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Add to Bookmark</button>
                </form>
                <?php
                        
                   if(isset($_POST['insert_bookmark']))
                   {
                       if(isset($_SESSION['username'])){
                           $username=$_SESSION['username'];
                           $post_id_bookmark=$_POST['insert_bookmark'];
                       $query="insert into bookmark values('$username',$post_id_bookmark)";
                        $insert_bookmark_query=mysqli_query($connection,$query);
                                           if(!$insert_bookmark_query)
                                           {
                                               die("Query Failed");
                                           }
                       }
                   }
                        
                        
                ?>
                <!--<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>            -->
            
              <?php } } ?>
              
              <hr>
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php
                
                if(isset($_POST['create_comment']))
                {
                    
                  
                    $comment_post_id=$_GET['p_id'];
                    $comment_author=$_POST['comment_author'];
                    $comment_email=$_POST['comment_email'];
                    $comment_content=$_POST['comment_content'];
                    
                      if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) )
                      {
                    $query="INSERT into comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
                    $query .= "VALUES ($comment_post_id,'$comment_author','$comment_email','$comment_content','unapproved',now())";
                    
                    $create_comment_query=mysqli_query($connection,$query);
                    if(!$create_comment_query)
                    {
                        die('Query Failed'.mysqli_error($connection));
                    }
                      }
                    else
                    {
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                /* $query="UPDATE posts SET post_comment_count=post_comment_count+1 ";
                 $query .="WHERE post_id=$comment_post_id";
                 $update_comment_count_query=mysqli_query($connection,$query);
                */   
                    
                    
                    /*$sql = "DROP TRIGGER IF EXISTS `trgrep1`CREATE DEFINER=`root`@`localhost` TRIGGER `trgrep1` before INSERT ON `comments` FOR EACH ROW BEGIN\n"

    . "UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id=NEW.comment_post_id END";
                    */
                   
                    //$update_comment_count=mysqli_query($connection,$sql);

                    
                    
                    
                    
                    
                    
                }
                
                
                ?>
                
        
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                           <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                         <div class="form-group">
                           <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                           <label for="comment">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $comment_post_id=$_GET['p_id'];
               /* $query="SELECT * FROM comments WHERE comment_post_id=$comment_post_id ";
                $query .= "AND comment_status='approved' ";
                $query .= "ORDER by comment_id DESC";
*/                $query="CALL showComments($comment_post_id)";
                $display_approved_query=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($display_approved_query))
                {
                    $comment_author=$row['comment_author'];
                    $comment_date=$row['comment_date'];
                    $comment_content=$row['comment_content'];
                 ?>
                   
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                    
                    
                    
              <?php  }
               ?>
                
               </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

       <?php include "includes/footer.php"; ?>
