<?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"; ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                       
                       
                        <h1 class="page-header">
                            welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <!-- Add Category Form -->
                        <div class="col-xs-6">
                        <form action="">
                            <div class="form-group">
                               <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                        </div>
                        
                        <!-- Add Category Form -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Catagory Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>Anatomy Catagory</td>
                                    <td>Cacti Catagory</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/footer.php"; ?>