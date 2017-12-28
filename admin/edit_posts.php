<?php
        if(isset($_GET['p_id'])) {
        $the_post_id = escape($_GET['p_id']);
        }
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_posts_by_id = mysqli_query($connection, $query);
   
        while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id']; 
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status']; 
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content']; 
        $post_comment_counts = $row['post_comment_counts']; 
        $post_date = $row['post_date']; 
            
        }
    
        if(isset($_POST['update_post'])){
            
//        $post_author = $_POST['post_author'];
        $post_user = escape($_POST['post_user']);
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']); 
        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);    
        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']); 

            
        move_uploaded_file($post_image_temp, "../images/$post_image");
        if(empty($post_image)) {
            
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_image = mysqli_query($connection,$query);
            while($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
                
            }
            
        }
            
        $query = "UPDATE posts SET ";
        $query .="post_author = '{$post_author}', ";
        $query .="post_user = '{$post_user}', ";
        $query .="post_title = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date = now(), ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_image = '{$post_image}', ";
        $query .="post_tags = '{$post_tags}', ";    
        $query .="post_content = '{$post_content}' ";
        $query .= "WHERE post_id = {$the_post_id}";

        $update_post = mysqli_query($connection,$query);

        queryFailed($update_post);
            
        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'> View Post</a> or <a href='posts.php'> Edit Other Post</a></p>";

            
        }

?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
</div>
<div class="form-group">
<label for="sel_cat">Select Category</label><br>
<select name="post_category" id="sel_cat">

<?php
            
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
        
        queryFailed($select_categories);    
            
        while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id']; 
        $cat_title = $row['cat_title'];
        
        if($cat_id == $post_category_id) {
            
        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";    
            
        } else {
          
        echo "<option value='{$cat_id}'>{$cat_title}</option>";    
            
        }
        
        }
            
?>    
    
</select>
</div>
<div class="form-group">
<label for="sel_cat">Users</label><br>
<select name="post_user" id="sel_cat">
<?php        echo "<option value='$post_user'>{$post_user}</option>";
?>
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
    <input value="<?php //echo $post_author; ?>" type="text" class="form-control" name="post_author">
</div>
-->
<div class="form-group">
    <label for="sel_status">Post Status</label><br>
    <select name="post_status" id="sel_status">
    <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
       
<?php
if($post_status == 'Published'){
    
    echo "<option value='Draft'>Draft </option>";
} else {
    echo "<option value='Published'>Published </option>";
    
}
?>
</select>
</div>
<div class="form-group">
<label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
<img width="100" src="../images/<?php echo $post_image; ?>" alt="">    
</div> 
<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>
<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content; ?>
    </textarea>
    <content></content>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
</div>   
</form>