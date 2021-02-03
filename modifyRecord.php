<?php
require('db.php');

if (isset($_POST['edit_row'])) {
    $row_id= ($_POST['row_id']);
    $firstname  = ($_POST['fname_val']);
    $lastname = ($_POST['lname_val']);
    $age = ($_POST['age_val']);
    $email = ($_POST['email_val']);
    $gender= ($_POST['gender_val']);
    $occupation= ($_POST['occu_val']);

    if (empty($firstname)) {
        $firstname_error = "Please enter your firstname";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
        $firstname_error = "Name must contain only alphabets and space";
    }
    if (empty($lastname)) {
        $lastname_error = "Please enter your lastname";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
        $lastname_error = "Name must contain only alphabets and space";
    }
    if (empty($age)) {
        $age_error = "Please enter your age";
    }
    if (empty($email)) {
        $email_error = "Please enter your email";
    }
    if (empty($gender)) {
        $gender_error = "Please enter your gender";
    }
    if (empty($occupation)) {
        $occupation_error = "Please Enter your Occupation";
    }

    if (empty($firstname_error) && empty($lastname_error) && empty($age_error) && empty($email_error) && empty($gender_error) && empty($occupation_error)) {

    $editquery = "UPDATE  user_table SET firstname='$firstname', lastname='$lastname', age='$age', email='$email', gender='$gender', occupation='$occupation'  WHERE id='$row_id' ";
    if (mysqli_query($conn, $editquery)) {
        echo "success";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
}
if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
 $del_query="DELETE from user_table where id='$row_no'";
if (mysqli_query($conn, $del_query)) {
  echo "success";
   exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
