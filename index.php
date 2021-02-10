<?php
include 'db.php';
include 'header.php';
include 'modifyRecord.php';
include 'modify_record.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
if (isset($_GET['updatesuccess'])) {
    echo  '<div class="alert alert-success">Record Updated Successfully</div>';
}
if (isset($_GET['deletesuccess'])) {
    echo  '<div class="alert alert-danger">Record Deleted Successfully</div>';
}
?>
<div class="container-fluid mb-4">
    <div class="header mt-0 mb-3">
        <h2>Home Page</h2>
    </div>
    <div class="d-flex justify-content-around">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="myFormId">
            <div class="row  ml-4 mr-4 p-3">
                <div class="col-sm-5">
                    <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                echo $_GET['search'];
                                                            } ?>" autocomplete="off">
                    <button type="submit" class="btm btn-success">Search</button>

                </div>
            </div>
        </form>
        <div class="text-center">
            <button type="button" onclick="resetForm();">Reset</button>
        </div>
    </div>
    <div class="row ml-4 mr-4 p-3">
        </h3><strong>Welcome <?php echo $_SESSION["name"]; ?></strong></h3>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-striped table-hover">
            <thead class="thead-light">
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
                $results_per_page = 5;
                if (isset($_GET['search'])) {
                $search = htmlspecialchars($_GET['search']);
                    if (isset($_GET['find'])) {
                        $find = $_GET['find'];
                    } else {
                        $find = 1;
                    }
                    $squery = "SELECT * FROM `user_table` WHERE `id` LIKE '%" . $search . "%' or `firstname` LIKE '%" . $search . "%' or `lastname` LIKE '%" . $search . "%' or `age` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' or `gender` LIKE '%" . $search . "%' or `occupation` LIKE '%" . $search . "%' ";
                    $searchresult = mysqli_query($conn, $squery)  or die(mysqli_error($conn));
                    $search_result = mysqli_num_rows($searchresult);
                    $slastpage = ceil($search_result / $results_per_page);
                    $search_first_result = ($find - 1) * $results_per_page;

                    if ($find > $slastpage) {
                        $find = $slastpage;
                    } // if
                    if ($find < 1) {
                        $find = 1;
                    } // if
                    $searchquery = mysqli_query($conn, "SELECT * FROM `user_table` WHERE `id` LIKE '%" . $search . "%' or `firstname` LIKE '%" . $search . "%' or `lastname` LIKE '%" . $search . "%' or `age` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' or `gender` LIKE '%" . $search . "%' or `occupation` LIKE '%" . $search . "%' LIMIT " . $search_first_result . ',' . $results_per_page)
                        or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($searchquery)) { ?>
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
                    <?php }
                } else {
                    $query = "select * from user_table";
                    $result = mysqli_query($conn, $query);


                    $number_of_result = mysqli_num_rows($result);

                    //determine the total number of pages available  
                    $lastpage = ceil($number_of_result / $results_per_page);

                    //determine which page number visitor is currently on  
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $page_first_result = ($page - 1) * $results_per_page;
                    $allquery = mysqli_query($conn, "SELECT * FROM `user_table`  LIMIT " . $page_first_result . ',' . $results_per_page)
                        or die(mysqli_error($conn));


                    while ($row = mysqli_fetch_assoc($allquery)) { ?>
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
                <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center">
    <?php
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        if (isset($_GET['find'])) {
           $find = $_GET['find'];
        } else {
            $find = 1;
        }
        if ($find == 1) {
            echo "  ";
        } else {
            echo " <a href='{$_SERVER['PHP_SELF']}?find=1 & search=$search'>FIRST</a> ";
            $prevpage = $find - 1;
            echo " <a href='{$_SERVER['PHP_SELF']}?find=$prevpage & search=$search'>PREV</a> ";
        }
        echo " ( Page $find of $slastpage ) ";
        if ($find == $slastpage) {
            echo "  ";
        } else {
            $nextpage = $find + 1;
            echo "<a href='{$_SERVER['PHP_SELF']}?find=$nextpage & search=$search '>NEXT</a>";
            echo " <a href='{$_SERVER['PHP_SELF']}?find=$slastpage & search=$search'>LAST</a> ";
        } // if
    } else {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        if ($page == 1) {
            echo "  ";
        } else {
            echo " <a href='{$_SERVER['PHP_SELF']}?page=1'>FIRST</a> ";
            $prevpage = $page - 1;
            echo " <a href='{$_SERVER['PHP_SELF']}?page=$prevpage'>PREV</a> ";
        }
        echo " ( Page $page of $lastpage ) ";
        if ($page == $lastpage) {
            echo "  ";
        } else {
            $nextpage = $page + 1;
            echo " <a href='{$_SERVER['PHP_SELF']}?page=$nextpage'>NEXT</a> ";
            echo " <a href='{$_SERVER['PHP_SELF']}?page=$lastpage'>LAST</a> ";
        } // if
    }
    ?>
</div>


<script type="text/javascript">
    $(function() {
        $("#save_btn" + id).show();
    });
</script>
<script>
    function resetForm() {
        window.location = "index.php";
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script type="text/javascript" src="modify_record.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>

</html>

