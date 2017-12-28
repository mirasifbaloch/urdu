<?php include "includes/admin_header.php" ?>
       
        <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            کیٹگریز
<!--                            <small>Author</small>-->
                        </h1>
            <div class="col-xs-6">
            <?php
            insertCategories();
            
            ?>
            <form action="" method="post">
            <div class="form-group">
                <label for="cat_title">نئی  کیٹگری </label>
                 <input type="text" class="form-control" name="cat_title">   
            </div>
            <div class="form-group">
                 <input class="btn btn-primary" type="submit" name="submit" value="نئی  کیٹگری ">
            </div>    
            </form> <!-- Add Category Form --> 
            
              <!-- Edit Category Form --> 
            
               
               <?php //Update and Include Query 
            updateCategories();

             ?>
              </div>                    
            <div class="col-xs-6">
            
            
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
<!--                        <th>ID #</th>-->
                        <th>کیٹگری ٹائٹل </th>
                        <th>ڈیلیٹ </th>
                        <th>ایڈٹ </th>
                    </tr>
                </thead>
                <tbody>
       <?php // FIND ALL Categories Query 
        findAllCategories();
        ?> 
               
               
        <?php  // DELETE QUERY
        deleteCategories();
             
        ?>
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

 <?php include "includes/admin_footer.php" ?>
  