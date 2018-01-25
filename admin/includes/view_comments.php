<table class="table table-bordered table-hover">
   <thead>
       <tr>
           <th>ID</th>
           <th>Author</th>
           <th>Title</th>
           <th>Comment</th>
           <th>Email</th>
           <th>Status</th>
           <th>In response to</th>
           <th>Date</th>
           <th>Approve</th>
           <th>Unapprove</th>
           <th>Delete</th>
       </tr>
   </thead>
    <tbody>

    <?php find_all_comments(); ?>
    <?php //delete_posts(); ?>

</tbody>
</table>