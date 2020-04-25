                <?php include "includes/admin_header.php"; ?>
                <?php $posts_count              = count_records(getAllUserPost()); ?>
                <?php $comment_count            = count_records(getAllPosts_UserComments()); ?>
                <?php $category_count            = count_records(getAllPosts_UserCategories()); ?>
               <?php  $post_published_count     = count_records(getAllPublishedUserPosts()); ?>
               <?php  $posts_draft_count        = count_records(getAllDraftUserPosts()); ?>
               <?php  $approved_comment_count   = count_records(getAllCommentUserPostApprovedstatus()); ?>
               <?php  $unapproved_comment_count  = count_records(getAllCommentUserPostUnapprovedstatus()); ?>




                    <?php 

                    ?>
                <div id="wrapper">

                    <!-- Navigation -->
                    <?php include "includes/admin_nav.php"; ?>

                    <div id="page-wrapper">

                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Welcome to the Admin Dashboard <?php echo strtoupper(getUsername()); ?>
                                    </h1>
                                        
                                        
                            <!-- /.row -->
                            

                            <!-- /.row -->
                                
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                                <?php echo "<div class='huge'>".$posts_count."</div>"; ?>
                            
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                echo "<div class='huge'>$comment_count</div>";
                                ?>

                                <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                        <?php
                                        echo "<div class='huge'>$category_count</div>";
                                        ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <?php 



                // $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                // $unapproved_comments_query = mysqli_query($connection,$query);
                // $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);
                



            ?>

                    <div class="row">
                    <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Data','count'],

                    <?php 

                    $element_text     = ['All Posts','Active Posts','Draft Posts', 'Comments','Approved Comments','Pending Comments', 'Categories'];
                    $element_count    = [$posts_count,$post_published_count,$posts_draft_count, $comment_count,$approved_comment_count,$unapproved_comment_count,$category_count];

    
                        for($i =0;$i < 7; $i++) {
                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                    }
                    
                    
                    ?>
            //     ['Posts',100],

                    ]);

                    var options = {
                    chart: {
                        title: '',
                        subtitle: '',
                    }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                    </div>




                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- /#page-wrapper -->


                    <?php include "includes/admin_footer.php"; ?>


                    <!-- <script src="https://js.pusher.com/5.1/pusher.min.js"></script> -->
                    
                    <script>
                        //  $(document).ready(function(){
                        //     var pusher = new Pusher('ae87c6cb9aa95d1ce30c',{
                        //         cluster: 'us2',
                        //         encrypted: true
                        //     });

                        //    var notificationChannel = pusher.subscribe('notifications');
                        //    notificationChannel.bind('new_user', function(notification){

                        //         var message = notification.message;

                        //         toastr.success(`${message} just registered`);

                        //         });


                        //  });

                    </script>