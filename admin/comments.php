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
                            <small>Author</small>
                        </h1>
                        
                        <?php //Update and include query
//                            if(isset($_GET['update'])){
//                                
//                                $update_sel_cat_id = $_GET['update'];
//                                include "includes/update_categories.php";
//                            }  
//                        include "includes/view_posts.php";
                        ?>
                        

                        <?php
                        
                        if(isset($_GET['source'])){
                            
                            $source = $_GET['source'];
                        }
                        
                        switch($source){
                                
                                case 'view_comments';
                                include "includes/view_comments.php";
                                break;
                                
                                case 'add_post';
                                include "includes/add_posts.php";
                                break;
                                
                                case 'edit_post';
                                include "includes/edit_posts.php";
                                break;
                                
                            default:
                                include "includes/view_comments.php";
                                
                                
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php"; ?>