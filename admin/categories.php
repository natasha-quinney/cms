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
                        
                        <!-- Add Category Form -->
                        <div class="col-xs-6">
                        
                        <?php 
                            
                            if(isset($_POST['submit'])){
                                
                                $cat_title = $_POST['cat_title'];
                                
                                if($cat_title == "" || empty($cat_title)){
                                    echo "This field should not be left empty.";
                                } else {
                                    $query = "INSERT INTO categories(cat_title) ";
                                    $query .= "VALUE('$cat_title')";
                                    
                                    $add_category_query = mysqli_query($connection, $query);
                                    
                                    if(!$add_category_query){
                                        die('ADD CATEGORY FAILED ' . mysqli_error($connection));
                                    }
                                }
                                
                            }
                            
                        ?>
                        
                        <form action="" method = "post">
                            <div class="form-group">
                               <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                        
                        <?php 
                            if(isset($_GET['update'])){
                                
                                $update_sel_cat_id = $_GET['update'];
                                include "includes/update_categories.php";
                            }
                            
                            
                            
                            
                            
                        ?>
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
                                  
                                    <?php   //Display all categories
                                    $query = "SELECT * FROM categories";
                                    $select_admin_cat_query = mysqli_query($connection,$query);   

                                    while($row = mysqli_fetch_assoc($select_admin_cat_query)){
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    echo "<tr>";
                                    echo "<td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                    echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
                                    echo "</tr>";
                                    }
                                    ?>
                                    
                                    <?php   //Delete categories
                                    if(isset($_GET['delete'])){
                                        $del_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
                                        $delete_admin_cat_query = mysqli_query($connection,$query);
                                        header("Location: categories.php");
                                    }
                                    ?>
                                    
                                    

                                    
                                    <?php
                                    
                                    
                                  
                                
//                                    
//                                    if(isset($_POST['submit'])){
//                                    $username = $_POST['username'];
//                                    $password = $_POST['password'];
//                                    $id = $_POST['id'];
//                                    $query = "UPDATE users SET ";
//                                    $query .= "username = '$username', ";
//                                    $query .= "password = '$password' ";
//                                    $query .= "WHERE id = $id";
//                                    $result = mysqli_query($connection, $query);
//
//                                    if(!$result){
//                                        die("Query failed" . mysqli_error($connection));
//                                    } else {
//                                        echo "User updated.";
//                                    }
//                                    }
                                    ?>
                                    
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

   <?php include "includes/admin_footer.php"; ?>