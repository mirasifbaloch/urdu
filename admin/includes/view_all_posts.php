<?php include "delete_modal.php" ?>

<?php
if(isset($_POST['checkBoxArray'])) {

        foreach($_POST['checkBoxArray'] as $postValueId ){

    $bulk_options = escape($_POST['bulk_options']);

        switch($bulk_options){

            case 'Published':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= {$postValueId} ";

                $update_to_published_status = mysqli_query($connection,$query);

                break;


            case 'Draft':

                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= {$postValueId} ";

                $update_to_draft_status = mysqli_query($connection,$query);

                break;


            case 'Clone':


                $query = "SELECT * FROM posts WHERE post_id ='{$postValueId}' ";
                $select_post_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($select_post_query)){
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];

                }

                if(empty($post_tags)) {

                    $post_tags = "No Tags";
                }


                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) ";

                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

                $clone_query = mysqli_query($connection,$query);

                    queryFailed($clone_query);


                break;


            case 'Delete':

                $query = "DELETE FROM posts WHERE post_id= {$postValueId} ";

                $update_to_delete_status = mysqli_query($connection,$query);

                break;



        }
    }

}
?>
       <form action="" method="post">
        <table class="table table bordered table-hover">
         <div id="bulkOptionsContainer" class="col-xs-1">
        <select class="form-control" name="bulk_options" style="width: auto " id="">
            <option value="">آپشنز</option>
            <option value="Published">پبلش</option>
            <option value="Draft">ڈرافٹ</option>
            <option value="Clone">کلون</option>
            <option value="Delete">ڈیلیٹ </option>
        </select>     
         </div>
        <div class="col-xs-7">

        <input type="submit" name="submit" class="btn btn-success" value="اپلائی ">
        <a href="posts.php?source=add_posts" class="btn btn-primary">نئی پوسٹ </a>
            </div>
            <thead>
             <tr>
                 <th><input id="selectAllBoxes" type="checkbox"></th>
                 <th>Id</th>
                 <th>لکھاری</th>
                 <th>ٹائٹل</th>
                 <th>کیٹگری</th>
                 <th>سٹیٹس</th>
                 <th>تصویر</th>
                 <th>ٹیگز</th>
                 <th>کمنٹس</th>
                 <th>تاریخ</th>
                 <th>ویوز</th>
<!--                 <th>ری سیٹ ویوز</th>-->
                 <th>پوسٹ دیکھیں</th>
                 <th>ایڈٹ</th>
                 <th>ڈیلیٹ</th>
             </tr>
         </thead>
     
    <tbody>
        <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
//        $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";
//        
        
        $select_posts = mysqli_query($connection, $query);
                    
        while($row = mysqli_fetch_assoc($select_posts )) {
        $post_id = $row['post_id']; 
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status']; 
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_counts = $row['post_comment_counts']; 
        $post_date = $row['post_date'];
        $post_views = $row['post_views_count'];
//        $category_title = $row['cat_title'];
//        $category_id = $row['cat_id'];
      
        
        echo "<tr>";
        ?>
        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
        <?php
        echo "<td>{$post_id}</td>";
        
        if(!empty($post_author)){
        echo "<td>{$post_author}</td>";
        } elseif(!empty($post_user)){ 
        echo "<td>{$post_user}</td>";
        }
            
        
            
        echo "<td>{$post_title}</td>";
        
        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
        $select_categories_id = mysqli_query($connection,$query);
                    
        while($row = mysqli_fetch_assoc($select_categories_id)){
        $cat_id = $row['cat_id']; 
        $cat_title = $row['cat_title'];
            
            
        echo "<td>{$cat_title}</td>";
        
        }
            
            
            
        echo "<td>{$post_status}</td>";
        echo "<td><img width=100 src='../images/$post_image' alt='Image'></td>";
        echo "<td>{$post_tags}</td>";
            
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_query = mysqli_query($connection,$query);
        $row = mysqli_fetch_array($send_comment_query);
        $comment_id = $row['comment_id'];
        $count_comments = mysqli_num_rows($send_comment_query);
            
            
        echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";
            
            
        echo "<td>{$post_date}</td>";
        echo "<td>{$post_views}</td>";
//        echo "<td><a href='posts.php?reset={$post_id}'>Reset Count</a></td>";
        echo "<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>پوسٹ دیکھیں </a></td>";
        echo "<td><a class='btn btn-warning' href='posts.php?source=edit_posts&p_id={$post_id}'>ایڈٹ </a></td>";
//        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to Delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            
//        echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
        ?>
        <form method="post">

            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <?php

            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="ڈیلیٹ"></td>'
            ?>

        </form>

            
            
            
          <?php  
            echo "</tr>";
        }
        ?>
        
    </tbody> 
     </table>
    </form> 
                                                        
<?php 
if(isset($_POST['delete'])){
        $the_post_id = escape($_POST['post_id']);
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: posts.php"); //refresh page
        }


if(isset($_GET['reset'])){
        $the_post_id = escape($_GET['reset']);
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $reset_query = mysqli_query($connection,$query);
        header("Location: posts.php"); //refresh page
        }
?>


<script>
$(document).ready(function(){
    
$(".delete_link").on('click', function(){
    
    var id = $(this).attr("rel");

    var delete_url = "posts.php?delete="+ id +" ";
    $(".modal_delete_link").attr("href", delete_url);

    $("#myModal").modal('show');


});
});

$(document).ready(function(){
    $("#button").click(function(){
        alert("Text: " + $("#test").text());
    });
</script>
