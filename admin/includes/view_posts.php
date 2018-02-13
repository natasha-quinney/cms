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