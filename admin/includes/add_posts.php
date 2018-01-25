<?php 

insert_posts();

?>
  <form action="" method = "post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
       <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
       <label for="post_title">Post Date</label>
        <input type="text" class="form-control" name="post_date">
    </div>
    
     <div class="form-group">
       <select name="post_category" id="">
           
           <?php
                    
                $query = "SELECT * FROM categories ";
                $sel_post_cat_query = mysqli_query($connection,$query);
           
                confirm($sel_post_cat_query);

                while($row = mysqli_fetch_assoc($sel_post_cat_query)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                    
                echo "<option value='$cat_id'>{$cat_title}</option>";
                        
                }
           ?> 
       </select>
    </div>
       
        <div class="form-group">
       <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
       <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
        
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
       <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>