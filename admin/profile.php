<?php include "includes/admin_header.php" ?>
<?php
      if(isset($_SESSION['username'])){
          
    $username = $_SESSION['username'];
          
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    
    $select_user_profile_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id = $row['user_id']; 
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname']; 
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
        
        
    }
          
      }
?>    
<?php
  if(isset($_POST['edit_user'])){
            
        $username = escape($_POST['username']);
        $user_password = escape($_POST['user_password']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']); 
//        $user_image = escape($_FILES['image']['name']);
//        $user_image_temp = escape($_FILES['image']['tmp_name']);   
        $user_email = escape($_POST['user_email']);
        $user_role = escape($_POST['user_role']); 

//            
//        move_uploaded_file($post_image_temp, "../images/$user_image");
//        if(empty($user_image)) {
//            
//            $query = "SELECT * FROM users WHERE user_id = $the_user_id";
//            $select_image = mysqli_query($connection,$query);
//            while($row = mysqli_fetch_array($select_image)) {
//                $user_image = $row['post_image'];
//                
//            }
//            
//        }
            
        $query = "UPDATE users SET ";
        $query .="username = '{$username}', ";
        $query .="user_password = '{$user_password}', ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
//      $query .="user_image = '{$user_image}', ";
        $query .="user_email = '{$user_email}', ";    
        $query .="user_role = '{$user_role}' ";
        $query .= "WHERE username = '{$username}' ";

        $update_user = mysqli_query($connection,$query);

        queryFailed($update_user);

            
        }


?>
        <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            پروفائل:
                            <small><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']  ?>
                        </h1>
     <?php
    
    
    ?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="user_firstname">فرسٹ نیم </label>
    <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
</div>
<div class="form-group">
    <label for="user_lastname">لاسٹ نیم </label>
    <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
</div>
<div class="form-group">
    <label for="username">یوزرنیم</label>
    <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
</div>
<div class="form-group">
    <label for="user_email">ای میل</label>
    <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
</div>
<div class="form-group">
    <label for="user_password">پاس ورڈ</label>
    <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
</div>
<!--
<div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" class="form-control" name="image">
</div>
-->
<!--<div class="form-group">-->
<!--    <label for="sel_role">رول</label><br>-->
<!--    <select name="user_role" id="sel_role">-->
<!--    <option value='Subscriber'>--><?php //echo $user_role ?><!-- </option>-->
<?php
//if($user_role == 'Admin'){
//
//    echo "<option value='Subscriber'>سبسکرائبر </option>";
//} else {
//    echo "<option value='Admin'>ایڈمن</option>";
//
//}
//        ?><!--    -->
<!--    -->
<!--</select>-->
<!--</div>-->
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_user" value="اپ ڈیٹ  پروفائل ">
</div>   
</form>                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/admin_footer.php" ?>
  