    <form action="" method="POST">
    <div class="form-group">
    <label for="cat_title">Update Category</label>

        <!-- get data from the database -->
    <?php
    if(isset($_GET['edit'])){

        $cat_id = $_GET['edit'];
        // $query  = "SELECT * FROM posts INNER JOIN categories ON posts.posts_id = categories.cat_id";
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
        $select_categories_id = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_categories_id)){

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
        ?>
        <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
    <?php   }}  ?>
        
                <!-- update data -->
    <?php

    //  update category without preparing the statement

    // if(isset($_POST['update_category'])){
    //     $the_cat_title = $_POST['cat_title'];
    //     $query = "UPDATE categories SET cat_title =  '{$the_cat_title}'  WHERE cat_id = {$cat_id} ";
    //     $update_query = mysqli_query($connection,$query);
    //     header("Location: categories.php");
    //     if(!$update_query){
    //         die("not connecting".mysqli_error($connection));

    //     }
    // }



    if(isset($_POST['update_category'])){

        $the_cat_title = $_POST['cat_title'];

        $stmt = mysqli_prepare($connection,"UPDATE categories SET cat_title =  ?  WHERE cat_id = ? ");
        mysqli_stmt_bind_param($stmt,'si',$the_cat_title ,$cat_id);

        mysqli_stmt_execute($stmt);

        if(!$stmt){
            die("not connecting".mysqli_error($connection));

        }

        header("Location: categories.php");
        mysqli_stmt_close($stmt);

        }

    ?>
