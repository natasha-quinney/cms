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
                       
                        ?>
                        
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
                               </tr>
                           </thead>
                            <tbody>
                            
                            <?php find_all_posts(); ?>

                       </tbody>
                       </table>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php"; ?>