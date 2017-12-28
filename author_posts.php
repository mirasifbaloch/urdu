        <!-- Header -->
<?php include "includes/header.php" ?>        
        <!-- Navigation -->
<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
        
<?php    
        if(isset($_GET['p_id'])){
            
            $the_post_id = escape($_GET['p_id']);
            $the_post_author = escape($_GET['author']);

        }
    
        $query = "SELECT * FROM posts WHERE post_user = '$the_post_author' AND post_status = 'Published' ";
        $allPosts = mysqli_query($connection, $query);


         while($row = mysqli_fetch_assoc($allPosts)){
             $post_id = $row['post_id'];
             $post_title = $row['post_title'];
             $post_author = $row['post_author'];
             $post_user = $row['post_user'];
             $post_date = $row['post_date'];
             $post_image = $row['post_image'];
             $post_content = $row['post_content'];
            
        ?>
<!--
               
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->

                <!-- First Blog Post -->
                <h2>
                    <a href=""><?php echo $post_title ?>
                    </a>
                </h2> 
                
                <p class="lead">
                    All posts by <?php echo $post_user ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?> " alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>
            
        
         <?php
         }
                
        ?>        
    
        
        
        
        
        </div>
    
        <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>
    
        </div>
        <!-- /.row -->

        <hr>
        <!-- Footer -->
<?php include "includes/footer.php" ?>
        