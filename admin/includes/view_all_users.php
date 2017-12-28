<table class="table table bordered table-hover">
         <thead>
             <tr>
<!--                 <th>Id</th>-->
                 <th>یوزرنیم </th>
<!--                 <th>Image</th>-->
                 <th>فرسٹ نیم</th>
                 <th>لاسٹ نیم</th>
                 <th>ای میل</th>
                 <th>رول</th>
                 <th>ایڈمن</th>
                 <th>سبسکرائبر</th>
                 <th>ایڈٹ</th>
                 <th>ڈیلیٹ</th>
             </tr>
         </thead>
     
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection,$query);
                    
        while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id']; 
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname']; 
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
            
        echo "<tr>";
//        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
//        echo "<td>{$user_image}</td>";
        
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
            
            
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";
            
//        $query = "SELECT * FROM users WHERE post_id = $comment_post_id";
//        $select_post_id_query = mysqli_query($connection,$query);
//        while($row = mysqli_fetch_assoc($select_post_id_query)) {
//            
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//        
//        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";
//        }
//            
//            





            
            
//        echo "<td>{$comment_date}</td>";
        echo "<td><a href='users.php?admin={$user_id}'>ایڈمن</a></td>";
        echo "<td><a href='users.php?sub={$user_id}'>سبسکرائبر</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'> ایڈٹ </a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>ڈیلیٹ</a></td>";
        echo "</tr>";
        }
    ?>
        
    </tbody> 
     </table>
     
                                                        
<?php

if(isset($_GET['admin'])){
        $the_user_id = escape($_GET['admin']);
        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $the_user_id ";
        $admin_query = mysqli_query($connection,$query);
        header("Location: users.php"); //refresh page
        }


if(isset($_GET['sub'])){
        $the_user_id = escape($_GET['sub']);
        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id ";
        $sub_query = mysqli_query($connection,$query);
        header("Location: users.php"); //refresh page
        }


if(isset($_GET['delete'])){
//
//        if(isset($_SESSION['user_role'])){
//
//            if($_SESSION['user_role'] == 'Admin'){
//
        $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: users.php"); //refresh page
//        }
//        }
        }
?>