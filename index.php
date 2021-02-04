<?php
include 'db.php';
include 'header.php';
require 'modifyRecord.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
if (isset($_GET['updatesuccess'])) {
    echo  '<div class="alert alert-success">Record Updated Successfully</div>';
}
if (isset($_GET['deletesuccess'])) {
    echo  '<div class="alert alert-danger">Record Deleted Successfully</div>';
}
if (isset($_GET['emptyfields'])) {
    echo '<div class="alert alert-danger">Please fill all the fields all fields are required<div>';
}
$results_per_page = 5;

//find the total number of results stored in the database  
$query = "select *from user_table";
$result = mysqli_query($conn, $query);
$number_of_result = mysqli_num_rows($result);

//determine the total number of pages available  
$number_of_page = ceil($number_of_result / $results_per_page);

//determine which page number visitor is currently on  
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$page_first_result = ($page - 1) * $results_per_page;
?>
<div class="container-fluid mb-4">
    <div class="header">
        <h2>Home Page</h2>
    </div>
    <div>
        <div class="row ml-4 mr-4 p-3">
            </h3><strong>Welcome <?php echo $_SESSION["name"]; ?></strong></h3>
        </div>
        <div class="row ml-4 mr-4 p-3">
            <table id="table" class="table-responsive table-bordered">
                <thead>
                    <tr>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Age</td>
                        <td>Email</td>
                        <td>Gender</td>
                        <td>Occupation</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query = mysqli_query($conn, "SELECT * FROM `user_table`  LIMIT " . $page_first_result . ',' . $results_per_page)
                        or die(mysqli_error($conn));

                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr id="row<?php echo $row['id']; ?>">
                            <td id="fname_val<?php echo $row['id']; ?>"><?php echo $row['firstname'] ?></td>
                            <td id="lname_val<?php echo $row['id']; ?>"><?php echo $row['lastname'] ?></td>
                            <td id="age_val<?php echo $row['id']; ?>"><?php echo $row['age'] ?></td>
                            <td id="email_val<?php echo $row['id']; ?>"><?php echo $row['email'] ?></td>
                            <td id="gender_val<?php echo $row['id']; ?>"><?php echo $row['gender'] ?></td>
                            <td id="occu_val<?php echo $row['id']; ?>"><?php echo $row['occupation'] ?></td>
                            <td>
                                <button class="edit_button  btn-primary btn-sm" name="edit_btn" id="edit_button<?php echo $row['id']; ?>" value="edit" onclick="edit_row('<?php echo $row['id']; ?>');">Edit</button>
                                <button type='button' class="save_button  btn-primary btn-sm" style="display: none;" name="save_btn" id="save_button<?php echo $row['id']; ?>" value="save" onclick="save_row('<?php echo $row['id']; ?>');">Save</button>
                                <button type='button' class="delete_button btn-danger btn-sm" name="del_btn" id="delete_button<?php echo $row['id']; ?>" value="delete" onclick="delete_row('<?php echo $row['id']; ?>');">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';
    }  ?>
</div>

<script type="text/javascript">
    $(function() {
        $("#save_btn" + id).show();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="modify_record.js"></script>

</body>

</html>