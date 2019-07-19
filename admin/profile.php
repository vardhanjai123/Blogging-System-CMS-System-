<?php include "includes/admin_header.php" ?>

<?php 
    
  if(isset($_SESSION['username']))  
  {
      $username=$_SESSION['username'];
      $query="SELECT * from users where username='$username'";
      $select_query=mysqli_query($connection,$query);
      while($row=mysqli_fetch_array($select_query))
      {
                          $user_id=$row['user_id'];
                           $username1=$row['username'];
                           $user_password=$row['user_password'];
                           $user_firstname=$row['user_firstname'];
                           $user_lastname=$row['user_lastname'];
                           $user_email=$row['user_email'];
                           $user_image=$row['user_image'];
                           $role=$row['role'];
      }
      
      
      
  }
    
    
    
    
    
?>
<?php


    if(isset($_POST['edit_user']))
    {
       // $the_user_id=$_GET['edit_user'];
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $role=$_POST['role'];
        $username1=$_POST['username'];
        
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
         $query .="username='$username1', ";
         $query .="user_email='$user_email', ";
         $query .="user_password='$user_password' ";
         $query .="WHERE username='$username' ";   
        $update_user_query = mysqli_query($connection,$query);
        
        confirmQuery($update_user_query);
        
        
   }


?>
   
   
   
   
   
   
   
   
   
   
   
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
       <input type="text" class="form-control" value="<?php echo $username1;   ?>" name="username">
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
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">   
   </div>
    
    
</form 
                  
                  
                  
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
  