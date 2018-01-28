<?php 

insert_users();

?>
  <form action="" method = "post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
       <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
       <label for="user_role">Role</label>
       <select name = "user_role">
        <option value="genin">Select User Role</option>
        <option value="admin">Admin</option>
        <option value="hokage">Hokage</option>
        <option value="jonin">Jonin</option>
        <option value="chunin">Chunin</option>
        <option value="genin">Genin</option>
        </select>
    </div>
    
    <div class="form-group">
       <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div>
    
    <div class="form-group">
       <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
       <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
       <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    

    
<!--
     <div class="form-group">
       <select name="post_category" id="">
           
           <?php
                    
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
                        
//                }
           ?> 
       </select>
    </div>
-->
       

    

        


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>