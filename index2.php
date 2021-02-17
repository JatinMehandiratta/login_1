<?php
include 'db.php';
include 'header.php';
include 'modifyRecord.php';
include 'modify_record.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
if (isset($_GET['deleted'])) {
    $id = $_GET['del_id'];
    echo "<script>alert('Row has been Deleted Successfully')</script>";
}
if (isset($_GET['results'])) {
    $results_per_page = $_GET['results'];
} else {
    $results_per_page = 5;
}

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    if (isset($_GET['find'])) {
        $find = $_GET['find'];
    } else {
        $find = 1;
    }
    $squery = "SELECT * FROM `user_table` WHERE `id` LIKE '%" . $search . "%' or `firstname` LIKE '%" . $search . "%' or `lastname` LIKE '%" . $search . "%' or `age` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' or `gender` LIKE '%" . $search . "%' or `occupation` LIKE '%" . $search . "%'";
    $searchresult = mysqli_query($conn, $squery)  or die(mysqli_error($conn));
    $search_result = mysqli_num_rows($searchresult);
    $slastpage = ceil($search_result / $results_per_page);
    $search_first_result = ($find - 1) * $results_per_page;
    if ($find > $slastpage) {
        $find = $slastpage;
    }
    if ($find < 1) {
        $find = 1;
    }
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
}
?>
<div class="container">
    <div class="header mt-0 mb-3">
        <h2>Home Page</h2>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="myFormId">
        <div class="form-group">
            <div class="row  ml-2 mr-2 p-2">
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="search" value="<?php if (isset($_GET['search'])) {
                                                                                        echo $_GET['search'];
                                                                                    } ?>" autocomplete="off" placeholder="search....." required>
                </div>
                <div class="col-sm-6">
                    <label for="num_rows">Number of rows</label>
                    <select name="results" required <?php  echo $_GET['results']; ?>>
                        <option value="" disabled selected>Choose option</option>
                        <?php 
                        $i=0;
                        while($i <= $number_of_result){
                            $i=$i+5;
                            echo "<option value=$i>".$i."<option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="text-center">
        <button type="button" onclick="resetForm();">Reset</button>
    </div>
    <div class="row ml-4 mr-4 p-3">
        </h3><strong>Welcome <?php echo $_SESSION["name"]; ?></strong></h3>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-striped table-hover">
            <?php
            $columns = array('firstname', 'lastname', 'age', 'email', 'gender', 'occupation');
            $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
            $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
            if (isset($_GET['search'])) {
                $query = mysqli_query($conn, "SELECT * FROM `user_table` WHERE `id` LIKE '%" . $search . "%' or `firstname` LIKE '%" . $search . "%' or `lastname` LIKE '%" . $search . "%' or `age` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' or `gender` LIKE '%" . $search . "%' or `occupation` LIKE '%" . $search . "%' ORDER BY  $column  $sort_order LIMIT " . $search_first_result . ',' . $results_per_page)
                    or die(mysqli_error($conn));
            } else {
                $query = mysqli_query($conn, "SELECT * FROM `user_table`  ORDER BY $column  $sort_order  LIMIT " . $page_first_result . ',' . $results_per_page)
                    or die(mysqli_error($conn));
            }
            $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
            $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
            $add_class = ' class="highlight"';

                if(isset($_GET['search'])){
                    $results_per_page= $_GET['results'];
                     ?>
              
                <thead class="thead-light">
                    <tr>
                        <th><a href="index2.php?find=<?php echo $find;?>&search=<?php echo $search;?>&results=<?php echo $results_per_page; ?>& column=firstname&order=<?php echo $asc_or_desc; ?>">Firstname<i class="fas fa-sort<?php echo $column == 'firstname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?find=<?php echo $find;?>&search=<?php echo $search;?>&results=<?php echo $results_per_page; ?>&column=lastname&order=<?php echo $asc_or_desc; ?>">Lastname<i class="fas fa-sort<?php echo $column == 'lastname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?find=<?php echo $find;?>&search=<?php echo $search;?>&results=<?php echo $results_per_page; ?>&column=age&order=<?php echo $asc_or_desc; ?>">Age<i class="fas fa-sort<?php echo $column == 'age' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?find=<?php echo $find;?>&search=<?php echo $search;?>&results=<?php echo $results_per_page; ?>&column=email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'email' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?find=<?php echo $find;?>&search=<?php echo $search;?>&results=<?php echo $results_per_page; ?>&column=gender&order=<?php echo $asc_or_desc; ?>">Gender<i class="fas fa-sort<?php echo $column == 'gender' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?find=<?php echo $find;?>&search=<?php echo $search;?>&results=<?php echo $results_per_page; ?>&column=occupation&order=<?php echo $asc_or_desc; ?>">Occupation<i class="fas fa-sort<?php echo $column == 'occupation' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <?php } else { ?>
                <thead class="thead-light">
                    <tr>
                        <th><a href="index2.php?page=<?php echo $page;?>& column=firstname&order=<?php echo $asc_or_desc; ?>">Firstname<i class="fas fa-sort<?php echo $column == 'firstname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?page=<?php echo $page;?>& column=lastname&order=<?php echo $asc_or_desc; ?>">Lastname<i class="fas fa-sort<?php echo $column == 'lastname' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?page=<?php echo $page;?>& column=age&order=<?php echo $asc_or_desc; ?>">Age<i class="fas fa-sort<?php echo $column == 'age' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?page=<?php echo $page;?>& column=email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'email' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?page=<?php echo $page;?>& column=gender&order=<?php echo $asc_or_desc; ?>">Gender<i class="fas fa-sort<?php echo $column == 'gender' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th><a href="index2.php?page=<?php echo $page;?>& column=occupation&order=<?php echo $asc_or_desc; ?>">Occupation<i class="fas fa-sort<?php echo $column == 'occupation' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <?php } ?>
                
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr id="row<?php echo $row['id']; ?>">
                        <td <?php echo $column == 'firstname' ? $add_class : ''; ?> id="fname_val<?php echo $row['id']; ?>"><?php echo $row['firstname'] ?></td>
                        <td <?php echo $column == 'lastname' ? $add_class : ''; ?> id="lname_val<?php echo $row['id']; ?>"><?php echo $row['lastname'] ?></td>
                        <td <?php echo $column == 'age' ? $add_class : ''; ?> id="age_val<?php echo $row['id']; ?>"><?php echo $row['age'] ?></td>
                        <td <?php echo $column == 'email' ? $add_class : ''; ?> id="email_val<?php echo $row['id']; ?>"><?php echo $row['email'] ?></td>
                        <td <?php echo $column == 'gender' ? $add_class : ''; ?> id="gender_val<?php echo $row['id']; ?>"><?php echo $row['gender'] ?></td>
                        <td <?php echo $column == 'occupation' ? $add_class : ''; ?> id="occu_val<?php echo $row['id']; ?>"><?php echo $row['occupation'] ?></td>
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
    <div class="text-center">
        <?php
            if(isset($_GET['search'])){
                $search = $_GET['search'];
                if(isset($_GET['find'])) {
                    $find = $_GET['find'];
                    }else {
                         $find = 1;
                    }
                if ($find == 1) {
                    echo "  ";
                } else {
                    echo " <a href='{$_SERVER['PHP_SELF']}?find=1&search=$search&results=$results_per_page'>FIRST</a> ";
                    $prevpage = $find- 1;
                    echo " <a href='{$_SERVER['PHP_SELF']}?$find=$prevpage&search=$search&results=$results_per_page'>PREV</a> ";
                }
                echo " ( Page $find of  $slastpage ) ";
                if ($find== $slastpage) {
                    echo "  ";
                } else {
                    $nextpage = $find + 1;
                    echo "<a href='{$_SERVER['PHP_SELF']}?find=$nextpage&search=$search&results=$results_per_page'>NEXT</a>";
                    echo " <a href='{$_SERVER['PHP_SELF']}?find=$slastpage&search=$search&results=$results_per_page'>LAST</a> ";
    
            
            }
        }
         else {
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
</div>
<script type="text/javascript">
    $(function() {
        $("#save_btn" + id).show();
    });
</script>
<script>
    function resetForm() {
        window.location = "index2.php";
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script type="text/javascript" src="modify_record.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</body>

</html>