<?php

function insert_categories(){
    
    global $connection;
                            
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
         
    function find_all_categories(){
        
        global $connection;
    
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
    }
    
    function delete_categories(){
        
        global $connection;

        if(isset($_GET['delete'])){
            $del_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
            $delete_admin_cat_query = mysqli_query($connection,$query);
        header("Location: categories.php");
                                    }
    }
}



?>