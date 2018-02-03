<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">
                            welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
<!--
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
-->
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <?php 
                                        
                                        $query = "SELECT * FROM posts";
                                        $select_posts = mysqli_query($connection, $query);
                                        
                                        $post_count = mysqli_num_rows($select_posts);
                                        
                                        echo "<div class='huge'>{$post_count}</div>";
                                        
                                        ?>
                                  
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php?source=view_post">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                     <?php 
                                        
                                        $query = "SELECT * FROM comments";
                                        $select_comments = mysqli_query($connection, $query);
                                        
                                        $comment_count = mysqli_num_rows($select_comments);
                                        
                                        echo "<div class='huge'>{$comment_count}</div>";
                                        
                                        ?>
                                        
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                     <?php 
                                        
                                        $query = "SELECT * FROM users";
                                        $select_users = mysqli_query($connection, $query);
                                        
                                        $user_count = mysqli_num_rows($select_users);
                                        
                                        echo "<div class='huge'>{$user_count}</div>";
                                        
                                        ?>
                                  
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php?source=view_users">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                       
                                        <?php 
                                        
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection, $query);
                                        
                                        $category_count = mysqli_num_rows($select_categories);
                                        
                                        echo "<div class='huge'>{$category_count}</div>";
                                        
                                        ?>
                            
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php 
                
                    //Count number of draft posts
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_draft_posts = mysqli_query($connection, $query);

                    $draft_post_count = mysqli_num_rows($select_draft_posts);
                
                    //Count number of unapproved comments
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $select_unapproved_comments = mysqli_query($connection, $query);

                    $unapproved_comment_count = mysqli_num_rows($select_unapproved_comments);
                
                    //Count number of non hokage users
                    $query = "SELECT * FROM users WHERE user_role != 'hokage'";
                    $select_nonhokage_users = mysqli_query($connection, $query);

                    $nonhokage_count = mysqli_num_rows($select_nonhokage_users);
                
                
                ?>
                
                <div class="row">

                    <script type="text/javascript">
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Data', 'Count'],
                                
                                <?php 
                                
                                    $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Non-admin Users', 'Categories'];
                                    $element_count = [$post_count, $draft_post_count, $comment_count, $unapproved_comment_count, $user_count, $nonhokage_count, $category_count];
                                
                                    for($i = 0; $i < 7; $i++){
                                        
                                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                        
                                    }
                                
                                
                                ?>
                                
//                              ['Posts', 1000],
                            
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                          }
                        
                        </script>
                        
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php"; ?>