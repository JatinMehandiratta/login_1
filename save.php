<?php include 'db.php';
include_once 'loginUser.php';
if(isset($_SESSION['id'])){
    header("Location: index.php");
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$firstname_error = "";
$lastname_error = "";
$email_error = "";
$gender_error = "";
$occupation_error = "";
$password_error = "";
$confirmpassword_error = "";

if (isset($_POST['reg_user'])) {
    $firstname  = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $age = $conn->real_escape_string($_POST['age']);
    $email = $conn->real_escape_string($_POST['email']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $occupation = $conn->real_escape_string($_POST['occupation']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);



    if (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
        $firstname_error = "Name must contain only alphabets and space";
    }
    
    if (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
        $lastname_error = "Name must contain only alphabets and space";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($email)) {
        $email_error = "Please Enter Valid Email ID";
    } else {
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $sql = "SELECT *  FROM user_table  WHERE email = '$email' ";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($email == isset($row['email'])) {
            $email_error = "This email is already registered";
        }
    }
    if (empty($gender)) {
        $gender_error = "Please select your gender";
    }
    if (empty($occupation)) {
        $occupation_error = "Please Enter your Occupation";
    }
    if (strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }
    if (strlen($confirmPassword) < 6) {
        $confirmpassword_error = "Confirm Password must be minimum of 6 characters";
    } else if ($password != $confirmPassword) {
        $confirmpassword_error = "Password and Confirm Password do not match";
    }

    if (empty($firstname_error) && empty($lastname_error) && empty($age_error) && empty($email_error) && empty($gender_error) && empty($occupation_error) && empty($password_error) && empty($confirmpassword_error)) {

        $sql = "INSERT INTO user_table (firstname, lastname, age,email,gender,occupation,password ,confirm_password)
VALUES ('" . $firstname . "','" . $lastname . "', '" . $age . "', '" . $email . "','" . $gender . "','" . $occupation . "','" . $password . "','" . $confirmPassword . "')";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success">You have successfully Signed up")</div>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        logger($email, $password);


        mysqli_close($conn);
    }
}
