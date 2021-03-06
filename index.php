<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                
                $posts_per_page = 5;
                
                if(isset($_GET['page'])){
                    
                    $page_number = $_GET['page'];
                    
                } else {
                    
                    $page_number = "";
                    
                }
                
                if($page_number == "" || $page_number == 1){
                    
                    $page_1 = 0;
//                    $page_2 = 5;
                        
                } else {
                    
                    $page_1 = ($page_number * $posts_per_page)-$posts_per_page;
//                    $page_2 = $page_1 + 5;
                }
                
                //FIND NUMBER OF ACTIVE POSTS AND CALCULATE NUMBER OF PAGES REQUIRED    
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                
                $count_posts_query = mysqli_query($connection, $query);
                $post_count = mysqli_num_rows($count_posts_query);
                
                $post_count = ceil($post_count / $posts_per_page);
                
                
                    //FIND ALL ACTIVE POSTS AND LIMIT TO 5 POSTS PER PAGE
                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $posts_per_page ";
                    $select_all_posts_query = mysqli_query($connection,$query);
                    
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,300);
                        $post_cat_id = $row['post_cat_id'];
                        $post_tags = $row['post_tags'];
                        $post_status = $row['post_status'];
                        
                        
                        
                    
                        
                  ?>
                        
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="authors_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on " . $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src=images/<?php echo $post_image; ?> alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                        
                        
                <?php 

                    }
                
                ?>

  

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
            
            <?php
            
            for($i=1; $i <=$post_count; $i++){
                
                if($i == $page_number){
                    
                  echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                    
                } else {
                
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    
                }
            }
            ?>
            
            </ul>

<?php include "includes/footer.php"; ?>
