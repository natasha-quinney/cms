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
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?'); \" href='categories.php?delete={$cat_id}'>Delete</a></td>";
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
            $post_comment_count = 0;

            move_uploaded_file($post_image_temp, "../images/$post_image" );

            $query = "INSERT INTO posts(post_title, post_author, post_date, post_cat_id, post_status, post_image, post_tags, post_content, post_comment_count) ";

            $query .= "VALUES('{$post_title}', '{$post_author}', now(), '{$post_category}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', '{$post_comment_count}' ) ";

            $create_post_query = mysqli_query($connection, $query);

        confirm($create_post_query);
            
            $new_post_id = mysqli_insert_id($connection);
            
            echo "<p class='bg-success'>Post created: " . " " . "<a href='../post.php?p_id={$new_post_id}'>View Post</a>" . " or " . "<a href='./posts.php?source=view_post'>View All Posts</a></p><br> ";

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
            echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
            echo "<td>{$post_id}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
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
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }
    
    function delete_posts(){
        
        global $connection;

        if(isset($_GET['delete'])){
            $del_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$del_post_id} ";
            $delete_admin_post_query = mysqli_query($connection,$query);
        header("Location: posts.php?source=view_post");
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
            
            echo "<td><a href='../post.php?p_id=$post_comment_id'>{$post_title}</a></td>";
                
            }
            
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?'); \" href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }

    function delete_comments(){
        
        global $connection;

        if(isset($_GET['delete'])){
            $del_comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$del_comment_id} ";
            $delete_admin_comment_query = mysqli_query($connection,$query);
        header("Location: comments.php");
                                    }
    }

    function unapprove_comments(){
        
        global $connection;

        if(isset($_GET['unapprove'])){
            $unapprove_comment_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_comment_id}" ;
            $unapprove_admin_comment_query = mysqli_query($connection,$query);
        header("Location: comments.php");
                                    }
    }

    function approve_comments(){
        
        global $connection;

        if(isset($_GET['approve'])){
            $approve_comment_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve_comment_id}" ;
            $approve_admin_comment_query = mysqli_query($connection,$query);
        header("Location: comments.php");
                                    }
    }

    function insert_users(){
        
        global $connection;
            
        if(isset($_POST['create_user'])){
    
            $user_name = $_POST['user_name'];
            $user_password = $_POST['user_password'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            $user_role = $_POST['user_role'];

            move_uploaded_file($user_image_temp, "../images/$user_image" );
            
            if($user_role == "select"){
                
                $user_role = "genin";
                
                
            }

            $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_image, user_role ) ";

            $query .= "VALUES('{$user_name}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}' ) ";

            $create_user_query = mysqli_query($connection, $query);

        confirm($create_user_query);
            
            echo "User created: " . " " . "<a href='users.php?source=view_users'>View Users</a><br> ";

        }       
    }


        function find_all_users(){
        
        global $connection;
    
        $query = "SELECT * FROM users";
        $select_admin_user_query = mysqli_query($connection,$query);   

        while($row = mysqli_fetch_assoc($select_admin_user_query)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];
            
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_name}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
//            echo "<td><img width='100' src='../images/$user_image' alt='image'></td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?source=edit_user&edit={$user_id}'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?'); \" href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
    } 

    function delete_users(){
        
        global $connection;

        if(isset($_GET['delete'])){
            $del_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$del_user_id} ";
            $delete_admin_user_query = mysqli_query($connection,$query);
        header("Location: users.php");
                                    }
    }
?>

