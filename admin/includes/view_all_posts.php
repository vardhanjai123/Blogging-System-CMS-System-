
<?php


   if(isset($_POST['checkBoxArray']))
   {
       foreach($_POST['checkBoxArray'] as $checkBoxValue){
           $bulk_Options=$_POST['bulkOptions'];
           switch($bulk_Options)
           {
                   
               case 'published':
                   $query="UPDATE posts SET post_status='published' where post_id=$checkBoxValue";
                   $publish_query=mysqli_query($connection,$query);
                   confirmQuery($publish_query);
                   
                   
                break;
                   case 'draft':
                   $query="UPDATE posts SET post_status='draft' where post_id=$checkBoxValue";
                   $draft_query=mysqli_query($connection,$query);
                   confirmQuery($draft_query);
                   
                   
                break;

                   case 'delete':
                   $query="DELETE FROM posts  where post_id=$checkBoxValue";
                   $delete_query=mysqli_query($connection,$query);
                   confirmQuery($delete_query);
                   
                   
                break;

           }
       }
       
   }






?>







<form action="" method="post">

 <table class="table table-bordered table-hover" >
                           <div id="bulkOptionsContainer" class="col-xs-4">
                               
                               <select class="form-control" name="bulkOptions" id="">
                                   
                                   <option value="">Select Options</option>
                                   <option value="published">Publish</option>
                                   <option value="draft">Draft</option>
                                   <option value="delete">Delete</option>
                                   
                               </select>
                               
                           </div>
                           <div>
                               
                            <input type="submit" name="submit" class="btn btn-success" value="Apply">
                              <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                               
                               
                           </div>
                           
                           
                           
                           
                           
                           
                           
                            <thead>
                                <tr>
                                   <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th> 
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View All post</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                             <?php 
                               $query="SELECT * FROM posts";
                    
                    $select_posts=mysqli_query($connection,$query);
                     while($row=mysqli_fetch_assoc($select_posts))
                    {
                           $post_id=$row['post_id'];
                           $post_category_id=$row['post_category_id'];
                           $post_title=$row['post_title'];
                           $post_author=$row['post_author'];
                           $post_date=$row['post_date'];
                           $post_image=$row['post_image'];
                           $post_comment_count=$row['post_comment_count'];
                           $post_tags=$row['post_tags'];
                           $post_status=$row['post_status'];
                         
                         
                             echo "<tr>";
                         ?>
                            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                            
                        <?php
                             echo "<td>$post_id</td>";
                             echo "<td>$post_author</td>";
                             echo "<td>$post_title</td>";
                         
                         
                         
                            $query="SELECT * from categories WHERE cat_id=$post_category_id";
                            $display_category_title=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($display_category_title))
                            {
                                $cat_title=$row['cat_title'];
                            }
                             echo "<td>$cat_title</td>";
                         
                         
                         
                         
                             echo "<td>$post_status</td>";
                             echo "<td><img width='100' class='image-responsive' src='../images/$post_image' alt='image'></td>";
                             echo "<td>$post_tags</td>";
                             echo "<td>$post_comment_count</td>";
                             echo "<td>$post_date</td>";
                            echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
                             echo "<td><a href='posts.php?delete=$post_id'>Delete</a></td>";
                             echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
                         
                             echo "</tr>";   
                     }    
                              ?>  
                               
                            </tbody>
                        </table>
</form>


<?php
if(isset($_GET['delete']))
{
    $delete_post_id=$_GET['delete'];
    $query="DELETE from posts WHERE post_id=$delete_post_id";
    $delete_query=mysqli_query($connection,$query);  
    header("Location: posts.php");
}
?>

  








