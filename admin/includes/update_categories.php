<form action="" method = "post">
        <div class="form-group">
           <label for="cat_title">Update Category</label>

                <?php //Select update categories

                if(isset($_GET['update'])){
                    $update_sel_cat_id = $_GET['update'];
                    $query = "SELECT * FROM categories WHERE cat_id = {$update_sel_cat_id} ";
                    $update_sel_cat_id_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($update_sel_cat_id_query)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>

            <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

                <?php } } ?>

                <?php //Delete categories
                if(isset($_POST['update'])){
                    $update_cat_title = $_POST['cat_title'];
                    $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$update_sel_cat_id} ";
                    $update_cat_query = mysqli_query($connection,$query);

                    if(!$update_cat_query){
                    die("UPDATE CATEGORY FAILED" . mysqli_error($connection));
                    }
                    }
                ?>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update" value="Update Category">
        </div>
    </form>