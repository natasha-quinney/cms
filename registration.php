<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
 
<?php 

    if(isset($_POST['submit'])){
        
        $reg_username = $_POST['username'];
        $reg_email = $_POST['email'];
        $reg_password = $_POST['password'];
        
        if(!empty($reg_username) && !empty($reg_email) && !empty($reg_password)){
        
        $reg_username = mysqli_real_escape_string($connection, $reg_username);
        $reg_email = mysqli_real_escape_string($connection, $reg_email);
        $reg_password = mysqli_real_escape_string($connection, $reg_password);
        
        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $query);
        
        if(!$select_randSalt_query){
        
        die("QUERY FAILED " . mysqli_error($connection));
    }  
            
        $row = mysqli_fetch_array($select_randSalt_query);
        $salt = $row['randSalt'];
        $reg_password = crypt($reg_password, $salt);
            
        $query = "INSERT INTO users(user_name, user_email, user_password, user_role ) ";
        $query .= "VALUES('{$reg_username}', '{$reg_email}', '{$reg_password}', 'genin' ) ";
        $register_user_query = mysqli_query($connection, $query);

         if(!$register_user_query){
        
            die("QUERY FAILED " . mysqli_error($connection));
        } 
            
        $message = "Your registration has been submitted.";
            
    } else {
              
        $message = "Fields cannot be empty.";  
            
        }
        
    } else {
        
        $message = "";
    }

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
