<?php
        if(isset($_GET['edit_user'])) {
        $the_user_id = $_GET['edit_user'];
        
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_users_query = mysqli_query($connection, $query);

                queryFailed($select_users_query);

   
        while($row = mysqli_fetch_assoc($select_users_query)){
        
        $username = $row['username']; 
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email']; 
//        $user_image = $row['user_image'];
        $user_role = $row['user_role']; 
            
        }

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



            
//        $query = "SELECT randSalt FROM users";
//        $select_randsalt_query = mysqli_query($connection, $query);
//        if(!$select_randsalt_query) {
//        die("Query Failed" . mysqli_error($connection));
        
//            
//
//        $row = mysqli_fetch_array($select_randsalt_query);
//        $salt = $row['randSalt'];
//        $hashed_password = crypt($user_password, $salt);


        if(!empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $get_users_query = mysqli_query($connection, $query_password);

                queryFailed($select_users_query);
       $row = mysqli_fetch_array($get_users_query);
            
        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password){
        
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12 ) );

        
        }
        $query = "UPDATE users SET ";
        $query .="username = '{$username}', ";
        $query .="user_password = '{$hashed_password}', ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
//      $query .="user_image = '{$user_image}', ";
        $query .="user_email = '{$user_email}', ";    
        $query .="user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$the_user_id}";

        $update_user = mysqli_query($connection,$query);

        queryFailed($update_user);
       
        echo "User Updated." . " <a href='users.php'>View Users</a>";
        }
        
        }
        
        } else {
            
            header("Location: index.php");
            
        }
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
</div>
<div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
</div>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
</div>
<div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
</div>
<div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
</div>
<!--
<div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" class="form-control" name="image">
</div>
-->
<div class="form-group">
    <label for="sel_role">Role</label><br>
    <select name="user_role" id="sel_role">
    <option value='<?php echo $user_role ?>'><?php echo $user_role ?> </option>
<?php
if($user_role == 'Admin'){
    
    echo "<option value='Subscriber'>Subscriber </option>";
} else {
    echo "<option value='Admin'>Admin </option>";
    
}
        ?>    
    
</select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
</div>   
</form>