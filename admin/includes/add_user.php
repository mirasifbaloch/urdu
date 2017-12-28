<?php
if(isset($_POST['create_user'])){
    
    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);
//    $user_image = escape($_FILES['image']['name']);
//    $user_image_temp = escape($_FILES['image']['tmp_name']);
    $user_role = escape($_POST['user_role']);
//    $post_date = escape(date('d-m-y'); 
    
    
//    move_uploaded_file($user_image_temp, "../images/$user_image");
    
$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10 ) );

    
  $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";  
  
$query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}') ";

$add_user = mysqli_query($connection,$query);

    queryFailed($add_user);
    
    echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";
}
?>


<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="user_firstname">فرسٹ نیم </label>
    <input type="text" class="form-control" name="user_firstname">
</div>
<div class="form-group">
    <label for="user_lastname">لاسٹ نیم </label>
    <input type="text" class="form-control" name="user_lastname">
</div>
<div class="form-group">
    <label for="username">یوزرنیم</label>
    <input type="text" class="form-control" name="username">
</div>
<div class="form-group">
    <label for="user_email">ای میل</label>
    <input type="email" class="form-control" name="user_email">
</div>
<div class="form-group">
    <label for="user_password">پاس ورڈ</label>
    <input type="password" class="form-control" name="user_password">
</div>
<!--
<div class="form-group">
    <label for="user_image">User Image</label>
    <input type="file" class="form-control" name="image">
</div>
-->
<div class="form-group">
    <label for="sel_role">رول</label><br>
    <select name="user_role" id="sel_role"><?php echo $user_role; ?>
        <option value='Subscriber'>آپشنز</option>
        <option value='Admin'>ایڈمن</option>
        <option value='Subscriber'>سبسکرائبر</option></select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="ایڈ  یوزر ">
</div>   
</form>