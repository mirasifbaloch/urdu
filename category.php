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
        if(isset($_GET['category'])) {
            $post_category_id = $_GET['category'];
            
          if(isAdmin($_SESSION['username'])) {
    
        $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");
              
        } else {            
            
        $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");
        
        $published = 'Published';
              
          }
        
        if(isset($stmt1)) {
            
            mysqli_stmt_bind_param($stmt1, "i", $post_category_id);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_user, $post_date, $post_image, $post_content);
            
            $stmt = $stmt1;
            
        } else {
            
            mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $published);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_user, $post_date, $post_image, $post_content);
            
            $stmt = $stmt2;

        }
            
            if(mysqli_stmt_num_rows($stmt) === 0 ) {
                
//             echo "<h1 class='text-center'>Currently No Article is Available<h1>";
                
            }
 
         while($row = mysqli_stmt_fetch($stmt)):
            
               
        ?>
<!--
               
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->

                <!-- First Blog Post -->
                <h2>
                    <a href="/urdu/post/<?php echo $post_id; ?>"><?php echo $post_title ?>
                    </a>
                </h2> 
                
                <p class="lead">
                    <a href="/urdu/index"><?php echo $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $post_date ?></p>
                <hr>
                <a href="/urdu/post/<?php echo $post_id; ?>"><img class="img-responsive" src="/urdu/images/<?php echo $post_image; ?> " alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="/urdu/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
        
         <?php
         
         endwhile; 
         mysqli_stmt_close($stmt);
        }    else {
            
            header("Location: index.php");
            
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
        