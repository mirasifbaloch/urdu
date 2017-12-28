<?php

/***** DATABASE FUNCTIONS *****/

/***** Query *****/
function query($query) {
global $connection;
return mysqli_query($connection, $query);
}

/***** Fetch Array *****/
function fetch_array($result) {
global $connection;
return mysqli_fetch_array($result);
}

/***** Query Checker *****/
function queryFailed($result) {
    global $connection;
    if(!$result) {

        die("QUERY FAILED" . mysqli_error($connection));
    }
}

/***** Count Rows (Data Numbers) *****/
function row_count($result) {
global $connection;
return mysqli_num_rows($result);
}
/***** DATABASE FUNCTIONS ENDS *****/



/***** HELPER FUNCTIONS *****/
/***** Page Redirection *****/
function redirect($location){
return header("Location:" . $location);
}

/***** Session Messages *****/
function set_message($message){
if(!empty($message)){
    $_SESSION['message'] = $message;
    } else
    $message = "";
}

/***** Dislay Session Messages *****/
function display_message(){
if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    }
}

function token_generator(){
    
}




/*****Secure From SQL Injection in Form Entries *****/
function escape($string){
global $connection;
return mysqli_real_escape_string($connection, trim($string));
}

/***** Clean Data in forms *****/
function clean($string) {
global $connection;
return htmlentities($string);
}





/***** Navigation - How Many User Online *****/
function users_online() {

    if(isset($_GET['onlineusers'])) {
    global $connection;

    if(!$connection) {

        session_start();

    include ("../includes/db.php");


    $session = session_id();
    $time = time();
    $time_out_in_seconds = 05;
    $time_out = $time - $time_out_in_seconds;


    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL) {
       mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
    } else {
       mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }

    $users_online_query =
       mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    echo $count_user = mysqli_num_rows($users_online_query);

    }

    }
}
users_online();



/*****  *****/
function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
        return false;
}

/***** Navigation - If Loggedin Show  *****/
function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

/***** Navigation - If Loggedin Redirect  *****/
function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}

/***** Categories - Create *****/
function insertCategories() {
    global $connection;
    if(isset($_POST['submit'])){
    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title)){
    echo "This feild should not be left blank";
    }   else {

    $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)");
    mysqli_stmt_bind_param($stmt, 's', $cat_title);
    mysqli_stmt_execute($stmt);

    if(!$stmt){
    die('QUERY FAILED' . mysqli_error($connection));
    }

    mysqli_stmt_close($stmt);
    }
}}

/***** Categories - Read *****/
function findAllCategories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
//        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>ڈیلیٹ </a></td>";
//        echo "<td><a href='categories.php?edit={$cat_id}'></a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>ایڈٹ</a></td>";
        echo "<tr>";
        }

}

/***** Categories - Update *****/
function updateCategories(){
        global $connection;
        if(isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        include "includes/edit_categories.php";
        }
}

/***** Categories - Delete *****/
function deleteCategories(){
        global $connection;
        if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php"); //refresh page
        }
}



/***** Admin/Index - DashBoard Count Function *****/
function recordCount($table){
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_all_post = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_post);

    queryFailed($result);

    return $result;
}

/***** Admin/Index - DashBoard Status Graph Function *****/
function checkStatus($table, $column, $status){
    global $connection;
    $query = "SELECT * FROM  $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);

    queryFailed($result);
    return mysqli_num_rows($result);


}

/***** Admin/Index - DashBoard Role Graph Function *****/
function checkUserRole($table, $column, $role){
    global $connection;
    $query = "SELECT * FROM  $table WHERE $column = '$role' ";
    $result = mysqli_query($connection, $query);

    queryFailed($result);
    return mysqli_num_rows($result);


}

/***** Admin/User - Only Admin Can See User Page *****/
function isAdmin($username = ''){
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    queryFailed($result);
    $row =  mysqli_fetch_array($result);

    if($row['user_role'] == 'Admin') {

        return true;
} else {

    return false;

}
}


/***** Registration Duplicate Username Check *****/
function usernameExist($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    queryFailed($result);

    if(mysqli_num_rows($result) > 0) {

    return true;
} else {

    return false;

}
}


/***** Registration Duplicate Email Check *****/
function emailExist($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);

    queryFailed($result);

    if(mysqli_num_rows($result) > 0) {

    return true;
} else {

    return false;

}
}

/***** Registration *****/
function registerUser($username, $email, $password) {
    global $connection;

$username = mysqli_real_escape_string($connection, $username);
$email    = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);

$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12 ) );


$query = "INSERT INTO users (username, user_email, user_password, user_role) ";
$query .= "VALUES('{$username}','{$email}','{$password}', 'Subscriber' )";
$register_user_query = mysqli_query($connection, $query);

    queryFailed($register_user_query);

}


/***** Login *****/
function loginUser($username, $password) {
    global $connection;

$username = trim($username);
$password = trim($password);

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);

$query = "SELECT * FROM users WHERE username = '{$username}' ";
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query) {

    die("QUERY FAILED" . mysqli_error($connection));
}
    while($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_email = $row['user_email'];
        $db_user_role = $row['user_role'];



//    $password = crypt($password, $db_user_password);


if(password_verify($password, $db_user_password)) {

    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_password'] = $db_user_password;
    $_SESSION['user_email'] = $db_user_email;
    $_SESSION['user_role'] = $db_user_role;

    redirect("/urdu/admin");

    } else {
    redirect("/urdu/index.php");    }
}}

?>