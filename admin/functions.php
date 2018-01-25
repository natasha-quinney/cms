<?php

function confirm($result){
    
        global $connection;
    
        if(!$result){
        
        die("QUERY FAILED " . mysqli_error($connection));
    }  
}

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

    function insert_posts(){
        
        global $connection;
            
        if(isset($_POST['create_post'])){
    
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            $post_date = date('d-m-y');
            $post_category = $_POST['post_category'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_comment_count = 4;

            move_uploaded_file($post_image_temp, "../images/$post_image" );

            $query = "INSERT INTO posts(post_title, post_author, post_date, post_cat_id, post_status, post_image, post_tags, post_content, post_comment_count) ";

            $query .= "VALUES('{$post_title}', '{$post_author}', now(), '{$post_category}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', '{$post_comment_count}' ) ";

            $create_post_query = mysqli_query($connection, $query);

        confirm($create_post_query);

        }       
    }
    
        function find_all_posts(){
        
        global $connection;
    
        $query = "SELECT * FROM posts";
        $select_admin_post_query = mysqli_query($connection,$query);   

        while($row = mysqli_fetch_assoc($select_admin_post_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_category = $row['post_cat_id'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_title}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_date}</td>";

            $query = "SELECT * FROM categories WHERE cat_id = {$post_category} ";
            $sel_post_cat_title_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($sel_post_cat_title_query)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            
            echo "<td>{$cat_title}</td>";
                
            }
            
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }
    
    function delete_posts(){
        
        global $connection;

        if(isset($_GET['delete'])){
            $del_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$del_post_id} ";
            $delete_admin_post_query = mysqli_query($connection,$query);
        header("Location: posts.php");
                                    }
    }

        function find_all_comments(){
        
        global $connection;
    
        $query = "SELECT * FROM comments";
        $select_admin_comment_query = mysqli_query($connection,$query);   

        while($row = mysqli_fetch_assoc($select_admin_comment_query)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_title = $row['comment_title'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_title}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
            $sel_post_comment_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($sel_post_comment_query)){
            $post_comment_id = $row['post_id'];
            $post_title = $row['post_title'];
            
            echo "<td>{$post_title}</td>";
                
            }
            
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?source=approve_comment&com_id={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?source=unapprove_commentt&com_id={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }
?>

