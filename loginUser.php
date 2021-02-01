<?php
include 'db.php';
session_start();
if(isset($_SESSION['id'])){
    header("Location: index.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function logger($email, $password)
{
    global $conn;
    $query = "SELECT * FROM user_table WHERE BINARY email= '$email' AND BINARY password= '$password' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['firstname'];
    }
}
$email_error = "";
$password_error = "";

if (isset($_POST['login_user'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

     
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($email) ) {
        $email_error = "Please Enter Valid Email ID";
    }else  {
        // first check the database to make sure 
        // a user does exists with the same  email
        $sql = "SELECT *  FROM user_table  WHERE email = '$email' ";
    
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        if ($email == isset($row['email'])) {
           $email_error = "This email is not Registered with us Please Sign up";
        }
        if (empty($password)) {
        $password_error = "Please Enter your Password to Login";
        }
} if (empty($password_error) && empty($email_error)) {
    logger($email,$password);
}else {
    header("Location: login.php?combinationerror");
}
}
