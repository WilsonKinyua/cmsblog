<?php include "includes/admin_header.php"; ?>

<?php header("Location: "); ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Categories
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>


                    <div class="col-xs-6">

                    <?php edit_categories(); ?>




                        <form action="" method="POST">
                        <div class="form-group">
                            <label for="cat_title">Add Category</label>
                            <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                        </form>




                        <!-- form to update data from the database -->
                            <?php include "includes/edit_categories.php"; ?>
                            
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                        </div>
                        </form>









                    </div>
                    <div class="col-xs-6">
                    
                        <table class = 'table table-striped table-bordered table-hover '>
                            <thead>
                                <tr>
                                    <th >category Id</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- display data from the databse into the table -->

                                <?php findall_categories(); ?>

                                    <!-- delete data from the database -->

                                <?php delete_categories(); ?>



                                <tr>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php"; ?>