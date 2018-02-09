<?php 

    if(isset($_GET['p_id'])){
        
        $edit_post_id = $_GET['p_id'];
    }

        $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
        $select_post_by_id_query = mysqli_query($connection,$query);   

        while($row = mysqli_fetch_assoc($select_post_by_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_category = $row['post_cat_id'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
            $post_content = $row['post_content'];
        }

        if(isset($_POST['edit_post'])){
            
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_category_id = $_POST['post_category'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_status = $_POST['post_status'];
            
            move_uploaded_file($post_image_temp, "../images/$post_image" );
            
            if(empty($post_image)){
                
                $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
                $select_image_query = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_array($select_image_query)){
                    
                    $post_image = $row['post_image'];
                }
            }

            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_cat_id = '{$post_category_id}', ";
            $query .= "post_image = '{$post_image}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_date = now() ";
            $query .= "WHERE post_id = {$edit_post_id} ";
            
            $update_post_query = mysqli_query($connection, $query);

        confirm($update_post_query);
            
            echo "<p class='bg-success'>Post updated: " . " " . "<a href='../post.php?p_id={$edit_post_id}'>View Post</a>" . " or " . "<a href='./posts.php?source=view_post'>View All Posts</a></p><br> ";
   
        }

?>
 
  <form action="" method = "post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
       <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
       <label for="post_title">Post Date</label>
        <input value="<?php echo $post_date; ?>" type="text" class="form-control" name="post_date">
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
           
           p
       </select>
    </div>
       
       <div class="form-group">
       <select name="post_status" id="">
           <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
           
           <?php if($post_status == "published"){
    
                        echo "<option value='draft'>Draft</option>";
                            
                    } else {
    
                        echo "<option value='published'>Published</option>";
                    }
           
           ?>
       </select>
      </div>
    
    <div class="form-group">
       <label for="post_image">Post Image</label><br>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="image">
        <input type="file" name="selected_image">
    </div>
        
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
       <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?>   
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Update Post">
    </div>
</form>