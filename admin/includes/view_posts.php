<table class="table table-bordered table-hover">
   <thead>
       <tr>
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