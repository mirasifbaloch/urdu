<?php
if(isset($_POST['create_post'])){
    
    $post_user = escape($_POST['post_user']);
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date('d-m-y')); 
    
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
  $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";  
  
$query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

$add_post = mysqli_query($connection,$query);

    queryFailed($add_post);
    
    $the_post_id = mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'> View Post</a> or <a href='posts.php?source=edit_posts&p_id={$the_post_id}'>Edit Post</a> or <a href='posts.php'> Edit Other Post</a></p>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">ٹائٹل</label>
    <input type="text" class="form-control" name="title">
</div>
<div class="form-group">
<label for="sel_cat"> کیٹگری</label><br>
<select name="post_category" id="sel_cat">
<?php
            
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
        
        queryFailed($select_categories);    
            
        while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id']; 
        $cat_title = $row['cat_title'];
            
        echo "<option value='$cat_id'>{$cat_title}</option>";
        }
            
?>    
    
</select>
</div>
<div class="form-group">
<label for="sel_cat">لکھاری</label><br>
<select name="post_user" id="sel_cat">
<?php
            
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection,$query);
        
        queryFailed($select_categories);    
            
        while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id']; 
        $username = $row['username'];
            
        echo "<option value='$username'>{$username}</option>";
        }
            
?>    
    
</select>
</div>

<!--
<div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author">
</div>
-->
<div class="form-group">
    <label for="sel_status">سٹیٹس</label><br>
    <select name="post_status" id="sel_status"><?php echo $post_status; ?>
    <option value='Draft'> آپشنز</option>
    <option value='Draft'>ڈرافٹ</option>
        <option value='Published'>پبلشڈ</option></select>
</div>
<div class="form-group">
    <label for="post_image">تصویر </label>
    <input type="file" class="form-control" name="image">
</div> 
<div class="form-group">
    <label for="post_tags">ٹیگز </label>
    <input type="text" class="form-control" name="post_tags">
</div>
<div class="form-group">
    <label for="post_content">مضمون </label>
    <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
    <content></content>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="پوسٹ کریں ">
</div>   
</form>