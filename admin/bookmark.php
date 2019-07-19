  
    <?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        
 <?php include "includes/admin_navigation.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 id="page-wrapper">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                               
                            <table class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Post Title</th>
                                    <th>Category</th> 
                                    <th>View post</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                             <?php 
                                    $username=$_SESSION['username'];        
                    $query="SELECT * FROM bookmark where username='$username'";
                    $x=1;
                    $select_from_bookmark=mysqli_query($connection,$query);
                    /*if(!$select_from_bookmark)
                    {
                        die("failed");
                    }*/
                     while($row=mysqli_fetch_assoc($select_from_bookmark))
                    {
                         $username=$row['username'];
                         $post_id=$row['post_id'];
                         $query1="select * from posts where post_id=$post_id";
                         $select_post=mysqli_query($connection,$query1);
                         while($row=mysqli_fetch_assoc($select_post))
                         {
                             $post_title=$row['post_title'];
                             $post_category_id=$row['post_category_id'];
                         }
                         $query2="select * from categories where cat_id=$post_category_id";
                         $select_category=mysqli_query($connection,$query2);
                         while($row=mysqli_fetch_assoc($select_category))
                         {
                             $cat_title=$row['cat_title'];
                         }
                           
                             echo "<tr>";
                             echo "<td>$x</td>";
                             echo "<td>$post_title</td>";
                             echo "<td>$cat_title</td>";
                            echo "<td><a href='../post.php?p_id=$post_id'>View this post</a></td>";
                         
                         
                         
                             echo "<td><a href='bookmark.php?delete=$post_id'>Delete</a></td>";
                             echo "</tr>";  
                         $x++;
                     }    
                              ?>  
                               
                            </tbody>
                        </table>


<?php

if(isset($_GET['delete']))
{
    $delete_post_id=$_GET['delete'];
    
    $query="DELETE from bookmark WHERE post_id=$delete_post_id and username='$username'";
    $delete_query=mysqli_query($connection,$query);  
    header("Location: bookmark.php");
}
?>

  
 </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
  








