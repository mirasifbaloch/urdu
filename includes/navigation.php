<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/urdu/">صفحہ اول</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php  
        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_all_categories_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title']; 
            
        $category_class = '';
        $registration_class = '';
        $pagename = basename($_SERVER['PHP_SELF']);
        $registration = 'registration.php';
            
            if(isset($_GET['category']) && $_GET['category'] == $cat_id) {
                
            $category_class = 'active';
            } else if ($pagename == $registration) {
                
             $registration_class = 'active';
  
                
            }
            
            
            
            echo "<li class='$category_class'><a href='/urdu/category/$cat_id'>{$cat_title}</a></li>";
        }
                    ?>
                        <li><a href="/urdu/contact">رابطہ </a></li>
                        <li class='<?php echo $registration_class ?> '><a href="registration">رجسٹر ہوں </a></li>
                    <?php if(isLoggedIn()): ?>
                        <li><a href="/urdu/admin">ایڈمن </a></li>
                        <li><a href="/urdu/includes/logout.php">لوگ آوٹ</a></li>
                    <?php else:  ?>
                        <li><a href="/urdu/login">لوگ ان </a></li>
                    <?php endif;  ?>


            <?php
                    
            if(isset($_SESSION['user_role'])){
            if(isset($_GET['p_id'])){
                
                $the_post_id = $_GET['p_id'];
                
            echo " <li><a href='/urdu/admin/posts.php?source=edit_posts&p_id={$the_post_id}'>Edit Post</a></li>";
                
            }    
            }
                    
            ?>
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>