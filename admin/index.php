<?php include "includes/admin_header.php" ?>

            <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>


<div id="wrapper">
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">خوش آمدید: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?> </h1>
<!--                    <h3>--><?php //echo $_SESSION['firstname'] ?><!--</h3>-->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-right">
                                    <span class="pull-right">
                                    <div class='huge' text-left><?php echo $post_counts = recordCount('posts')?> </div>
                                    <div>پوسٹس </div>
                                    </span>

                                </div>
                                <div class="col-xs-3">
                                    <span class="pull-left">
                                    <i class="fa fa-file-text fa-5x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-right">تفصیلی جائزہ </span>
                                <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-right">
                                    <span class="pull-right">
                                    <div class='huge'><?php echo $comment_counts = recordCount('comments')?> </div>
                                    <div>کمنٹس</div>
                                    </span>
                                </div>
                                <div class="col-xs-3">
                                    <span class="pull-left">
                                    <i class="fa fa-comments fa-5x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-right">تفصیلی جائزہ </span>
                                <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-right">
                                    <span class="pull-right">
                                    <div class='huge'><?php echo $user_counts = recordCount('users')?> </div>
                                    <div> یوزرز</div>
                                    </span>
                                </div>
                                <div class="col-xs-3">
                                    <span class="pull-left">
                                    <i class="fa fa-user fa-5x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-right">تفصیلی جائزہ </span>
                                <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-right">
                                    <span class="pull-right">
                                    <div class='huge'><?php echo $categories_counts = recordCount('categories')?> </div>
                                    <div>کیٹگریز</div>
                                    </span>
                                </div>
                                <div class="col-xs-3">
                                    <span class="pull-left">
                                    <i class="fa fa-list-alt fa-5x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-right">تفصیلی جائزہ </span>
                                <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
<?php

$post_publish_counts = checkStatus('posts', 'post_status','Published');

$post_draft_counts = checkStatus('posts', 'post_status','Draft');

$unapproved_comment_counts = checkStatus('comments', 'comment_status','Unapproved');

$subscriber_counts = checkUserRole('users', 'user_role','Subscriber');

?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                        <?php
                            $element_text = ['All Post', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_counts, $post_publish_counts, $post_draft_counts, $comment_counts, $unapproved_comment_counts, $user_counts, $subscriber_counts, $categories_counts];
                        for($i =0;$i < 8; $i++) {

                            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

                        }

                            ?>
//          ['Post', 1000],

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

    <!--<?php include "includes/admin_footer.php" ?>-->











    <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
