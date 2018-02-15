<?php 
    if(isset($_POST['checkBoxArray'])){
        
     foreach($_POST['checkBoxArray'] as $checkBoxValue){
         
         $bulk_options = $_POST['bulk_options'];
         
         switch($bulk_options){
                 
                case 'published':
                 
                 $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                 $bulk_publish_query = mysqli_query($connection, $query);
                 confirm($bulk_publish_query);
                 
                break;
                 
                case 'draft':
                 
                 $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                 $bulk_draft_query = mysqli_query($connection, $query);
                 confirm($bulk_draft_query);
                 
                break;
                 
                case 'reset_views':
                 
                 $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$checkBoxValue} ";
                 $bulk_reset_views_query = mysqli_query($connection, $query);
                 confirm($bulk_reset_views_query);
                 
                break;
                 
                case 'clone':
                 
                 $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}' ";
                 $bulk_clone_select_query = mysqli_query($connection, $query);
                 confirm($bulk_clone_select_query);   

                    while($row = mysqli_fetch_assoc($bulk_clone_select_query)){
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
                 
                    $query = "INSERT INTO posts(post_title, post_author, post_date, post_cat_id, post_status, post_image, post_tags, post_content, post_comment_count) ";

                    $query .= "VALUES('{$post_title}', '{$post_author}', now(), '{$post_category}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', '{$post_comment_count}' ) ";

                    $clone_post_query = mysqli_query($connection, $query);
                    confirm($clone_post_query);

                break;
                 
                case 'delete':
                 
                 $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue} ";
                 $bulk_delete_query = mysqli_query($connection, $query);
                 confirm($bulk_delete_query);
                 
                break;
         }
     }   
    }

?>


<form action="" method="post">
 
  <table class="table table-bordered table-hover">
    
        <div id="bulkOptionsContainter" class="col-xs-4">

          <select class="form-control" name="bulk_options" id="">

              <option value="">Select Options</option>
              <option value="published">Publish</option>
              <option value="draft">Draft</option>
              <option value="reset_views">Reset Views</option>
              <option value="clone">Clone</option>
              <option value="delete">Delete</option>

          </select>
          
      </div>
      
      <div class="col-xs-4">
          
          <input type="submit" name="submit" class="btn btn-success" value="Apply">
          <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
          
      </div>
      
   <thead>
       <tr>
           <th><input id="selectAllBoxes" type="checkbox"></th>
           <th>ID</th>
           <th>Title</th>
           <th>Author</th>
           <th>Date</th>
           <th>Category</th>
           <th>Status</th>
           <th>Image</th>
           <th>Tags</th>
           <th>Views</th>
           <th>Comments</th>
           <th>Edit</th>
           <th>Delete</th>
       </tr>
   </thead>
    <tbody>

    <?php find_all_posts(); ?>
    <?php delete_posts(); ?>

</tbody>
</table>
</form>