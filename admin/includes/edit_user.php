<?php


    if(isset($_GET['edit_user']))
    {
         $the_user_id=$_GET['edit_user'];
         $query="SELECT * FROM users where user_id=$the_user_id";
         $select_users_query=mysqli_query($connection,$query);
         while($row=mysqli_fetch_assoc($select_users_query))
                    {
                           $user_id=$row['user_id'];
                           $username=$row['username'];
                           $user_password=$row['user_password'];
                           $user_firstname=$row['user_firstname'];
                           $user_lastname=$row['user_lastname'];
                           $user_email=$row['user_email'];
                           $user_image=$row['user_image'];
                           $role=$row['role'];
                    } 
                           
    
    }




    if(isset($_POST['edit_user']))
    {
        $the_user_id=$_GET['edit_user'];
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $role=$_POST['role'];
        $username=$_POST['username'];
        
        /*$post_image=$_FILES['image']['name'];
        $post_image_temp=$_FILES['image']['tmp_name'];
        */
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
       // $post_date=date('d-m-y');
       // $post_comment_count=4;
        
//       move_uploaded_file($post_image_temp,"../images/$post_image"); 
        
        
         $query = "UPDATE users SET ";
         $query .="user_firstname='$user_firstname', ";
         $query .="user_lastname='$user_lastname', ";
         $query .="role='$role', ";
         $query .="username='$username', ";
         $query .="user_email='$user_email', ";
         $query .="user_password='$user_password' ";
         $query .="WHERE user_id=$the_user_id ";   
        $update_user_query = mysqli_query($connection,$query);
        
        confirmQuery($update_user_query);
        
        
   }



         


?>







<form action="" method="post" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="title">Firstname</label>
       <input type="text" class="form-control" value="<?php echo $user_firstname;   ?>" name="user_firstname">
   </div>
   
   <div class="form-group">
       <label for="post_status">Lastname</label>
       <input type="text" class="form-control" value="<?php echo $user_lastname;   ?>" name="user_lastname">
   </div>
    
       <div class="form-group">
     <select name="role" id="">
     
     
      
      <option value="<?php echo $role ?>"><?php echo $role; ?></option>
      <?php
      if($role=='admin')
      {
      
          echo "<option value='subscriber'>subscriber</option>"; 
      
      }else
      {
          echo "<option value='admin'>admin</option>"; 
      }
      ?>
                  
     </select>
   </div>
    
         
    
    
   
<!--   <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file"  name="image">
   </div>-->
   
   <div class="form-group">
       <label for="post_tags">Username</label>
       <input type="text" class="form-control" value="<?php echo $username;   ?>" name="username">
   </div>
   
   <div class="form-group">
       <label for="post_content">Email</label>
       <input type="email" class="form-control" value="<?php echo $user_email;   ?>" name="user_email">

   </div>
   
      <div class="form-group">
       <label for="post_content">Password</label>
       <input type="password" class="form-control" value="<?php echo $user_password;   ?>" name="user_password">

      </div>
   
   <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">   
   </div>
    
    
</form 