<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
         
        <?php
    
    
     $session=session_id();
$time=time();
$time_out_in_seconds=60;
$time_out=$time-$time_out_in_seconds;

$query="SELECT * FROM users_online where session='$session'";
$send_query=mysqli_query($connection,$query);
$count=mysqli_num_rows($send_query);


if($count==NULL)
{
    mysqli_query($connection,"insert into users_online(session,time) VALUES('$session','$time')");
}
else
{
    mysqli_query($connection,"update users_online set time='$time' where session='$session' ");
}
   
$users_online_query=mysqli_query($connection,"select * from users_online where time>'$time_out' ");
 $users_online=mysqli_num_rows($users_online_query);
    
       ?>

        <!-- Navigation -->
 <?php include "includes/admin_navigation.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   
                    <div class="col-lg-12">
                          <h1 id="page-wrapper">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'];     ?></small>
                          </h1> 
                          <h1>
                              <?php echo $users_online;    ?>
                          </h1>
                          
                    </div>
                </div>
                <!-- /.row -->

          
                 
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        
                      $query="SELECT * from posts";
                      $select_allpost_query=mysqli_query($connection,$query);
                    $post_count=mysqli_num_rows($select_allpost_query);
                        
                    echo "<div class='huge'>$post_count</div>";
                        
                    ?>
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        
                      $query="SELECT * from comments";
                      $select_allcomments_query=mysqli_query($connection,$query);
                    $comment_count=mysqli_num_rows($select_allcomments_query);
                        
                    echo "<div class='huge'>$comment_count</div>";
                        
                    ?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                     <?php
                        
                      $query="SELECT * from users";
                      $select_allusers_query=mysqli_query($connection,$query);
                    $user_count=mysqli_num_rows($select_allusers_query);
                        
                    echo "<div class='huge'>$user_count</div>";
                        
                    ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        
                      $query="SELECT * from categories";
                      $select_allcategories_query=mysqli_query($connection,$query);
                    $category_count=mysqli_num_rows($select_allcategories_query);
                        
                    echo "<div class='huge'>$category_count</div>";
                        
                    ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                
                <?php
                    $query="SELECT * from posts where post_status='draft'";
                    $select_alldraft_query=mysqli_query($connection,$query);
                    $draft_post_count=mysqli_num_rows($select_alldraft_query);
                        
                   $query="SELECT * from posts where post_status='published'";
                    $select_allpublished_query=mysqli_query($connection,$query);
                    $published_post_count=mysqli_num_rows($select_allpublished_query);
                      
                
                
                
                    $query="SELECT * from comments where comment_status='unapproved'";
                    $select_allunapproved_query=mysqli_query($connection,$query);
                    $unapproved_comment_count=mysqli_num_rows($select_allunapproved_query);
                                
                
                    $query="SELECT * from users where role='subscriber'";
                    $select_all_subscriber_query=mysqli_query($connection,$query);
                    $subscriber_count=mysqli_num_rows($select_all_subscriber_query);
                
                
                
                
                
                ?>
                
                
                
                
                
                
                
                
                
                
                <div class="row">
                <script type="text/javascript">
               google.charts.load('current', {'packages':['bar']});
               google.charts.setOnLoadCallback(drawChart);

             function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['Date', 'Count'],
                  <?php
                  
                  $element_text=['Active Post','Published Post','Pending Post','Comments','Unapproved Comment','Users','Subscribers','Categories'];
                  $element_count=[$post_count,$published_post_count,$draft_post_count,$comment_count,$unapproved_comment_count,$user_count,$subscriber_count,$category_count];
                  
                  for($i=0;$i<7;$i++)
                  {
                      echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
                  }
                  
                  ?>
                  
              ]);

              var options = {
                 chart: {
                 title: '',
                 subtitle: '',
              }
              };

             var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
            }
            </script>
               
               <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
 
                    
                    
                </div>
           
           
           
           
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
  