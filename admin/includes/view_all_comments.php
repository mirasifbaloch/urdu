<table class="table table bordered table-hover">
         <thead>
             <tr>
<!--                 <th>Id</th>-->
                 <th>لکھاری</th>
                 <th>کمنٹ</th>
                 <th>ای میل </th>
                 <th>سٹیٹس</th>
                 <th>کس پوسٹ پر </th>
                 <th>تاریخ</th>
                 <th>پبلش</th>
                 <th>ریجیکٹ </th>
                 <th>ڈیلیٹ</th>
             </tr>
         </thead>
     
    <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection,$query);
                    
        while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id']; 
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        
        $comment_content = $row['comment_content']; 
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
            
        echo "<tr>";
//        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";
        
//        $query = "SELECT * FROM comments WHERE cat_id = {$post_category_id} ";
//        $select_categories_id = mysqli_query($connection,$query);
//                    
//        while($row = mysqli_fetch_assoc($select_categories_id)){
//        $cat_id = $row['cat_id']; 
//        $cat_title = $row['cat_title'];
//            
//            
//        echo "<td>{$cat_title}</td>";
//        
//        }
//            
            
            
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";
            
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post_id_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post_id_query)) {
            
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
        
        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";
        }
            
            
            
        
        
            
            
            
            
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>پبلش</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>ریجیکٹ </a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>ڈیلیٹ</a></td>";
        echo "</tr>";
        }
    ?>
        
    </tbody> 
     </table>
     
                                                        
<?php

if(isset($_GET['approve'])){
        $the_comment_id = escape($_GET['approve']);
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id ";
        $approve_query = mysqli_query($connection,$query);
        header("Location: comments.php"); //refresh page
        }


if(isset($_GET['unapprove'])){
        $the_comment_id = escape($_GET['unapprove']);
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id ";
        $unapprove_query = mysqli_query($connection,$query);
        header("Location: comments.php"); //refresh page
        }


if(isset($_GET['delete'])){
        $the_comment_id = escape($_GET['delete']);
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: comments.php"); //refresh page
        }
?>