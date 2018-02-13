<?php 

    if(isset($_GET['edit'])){
        
        $edit_user_id = $_GET['edit'];
    }

        $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
        $select_user_by_id_query = mysqli_query($connection,$query);   

        while($row = mysqli_fetch_assoc($select_user_by_id_query)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];
        }
        
//        confirm($select_user_by_id_query);

        if(isset($_POST['edit_user'])){
            
            $user_name = $_POST['user_name'];
            $user_password = $_POST['user_password'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
//            $user_image = $_FILES['image']['name'];
//            $user_image_temp = $_FILES['image']['tmp_name'];
            $user_role = $_POST['user_role'];
            
//            move_uploaded_file($user_image_temp, "../images/$user_image" );
            
//            if(empty($user_image)){
//                
//                $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
//                $select_image_query = mysqli_query($connection, $query);
//                
//                while($row = mysqli_fetch_array($select_image_query)){
//                    
//                    $user_image = $row['user_image'];
//                }
//            }
            
             if($user_role == "select"){
                
                $query = "SELECT * FROM users WHERE user_id = $edit_user_id ";
                $select_role_query = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_array($select_role_query)){
                    
                    $user_role = $row['user_role'];
                }
            }
        
        $user_password = mysqli_real_escape_string($connection, $user_password); 
  
        $encrypt_password = crypt($user_password, $randSalt);
            

            $query = "UPDATE users SET ";
            $query .= "user_name = '{$user_name}', ";
            $query .= "user_password = '{$encrypt_password}', ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_email = '{$user_email}', ";
//            $query .= "user_image = '{$user_image}', ";
            $query .= "user_role = '{$user_role}' ";
            $query .= "WHERE user_id = {$edit_user_id} ";
            
            $update_user_query = mysqli_query($connection, $query);

        confirm($update_user_query);
   
        }

?>
 
  <form action="" method = "post" enctype="multipart/form-data">
   
        <div class="form-group">
       <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
       <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
       <label for="user_role">Role</label>
       <select name = "user_role">
        <option value="<?php echo $user_role?>"><?php echo $user_role?></option>
        <option value="admin">admin</option>
        <option value="hokage">hokage</option>
        <option value="jonin">jonin</option>
        <option value="chunin">chunin</option>
        <option value="genin">genin</option>
        </select>
    </div>
    
<!--
    <div class="form-group">
       <label for="user_image">User Image</label>
        <input value="<?php echo $user_image; ?>" type="file" class="form-control" name="user_image">
    </div>
-->
    
    <div class="form-group">
       <label for="user_name">Username</label>
        <input value="<?php echo $user_name; ?>" type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
       <label for="user_email">Email</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
       <label for="user_password">Password</label>
        <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
    </div>
    
<!--
    <div class="form-group">
       <select name="post_category" id="">
           
           <?php
//                    
//                $query = "SELECT * FROM categories ";
//                $sel_post_cat_query = mysqli_query($connection,$query);
//           
//                confirm($sel_post_cat_query);
//
//                while($row = mysqli_fetch_assoc($sel_post_cat_query)){
//                $cat_id = $row['cat_id'];
//                $cat_title = $row['cat_title'];
//                    
//                echo "<option value='$cat_id'>{$cat_title}</option>";
//                        
//                }
//           
           ?>
           
           
       </select>
    </div>
-->
       

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>