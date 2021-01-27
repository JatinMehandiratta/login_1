<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
  <?php 
   if(isset ($_GET['passwordmatcherr']))  {
    echo '<div class="alert alert-danger">The two passwords do not match</div>';
   }
   if (isset ($_GET['alreadyregisteredmailerr'])) {
    echo '<div class="alert alert-danger">This Email is already registered with us Try Using another Email</div>';
   };
  ?>

    <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
        <h1 class="text-center">User Sign Up Page</h1>
    </div>
    <div class="container">
        <form method="post" action="save.php" autocomplete="off">
            <div class="form-group">
                <div class="row mt-3 p-1">
                    <div class="col-md-6">
                        <label for="firstname" class="mb-2">First name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter First Name " required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="mb-2">Last name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" required>
                    </div>
                </div>
                <div class="row mt-3 p-1">
                    <div class="col-md-6">
                        <label for="age" class="mb-2">Age</label>
                        <input type="number" class="form-control" name="age" placeholder="Enter Your Age" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="mb-2">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                    </div>
                </div>
                <div class="row mt-3 p-1">
                    <div class="col-md-6">
                        <label for="gender" class="mb-2">Gender</label>
                        <br>
                        <label class="mr-2">
                            <input type="radio" name="gender" value="male"> Male
                        </label>
                        <label class="mr-2">
                            <input type="radio" name="gender" value="female"> Female
                        </label>
                        <label class="mr-2">
                            <input type="radio" name="gender" value="other"> Other
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label for="occupation" class="mb-2">Occupation</label>
                        <input type="text" class="form-control" name="occupation" required>
                    </div>
                </div>
                <div class="row mt-3 p-1">
                    <div class="col-md-6">
                        <label for="password" class="mb-2">Password</label>
                        <input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                    <div class="col-md-6">
                        <label for="confirm_password" class="mb-2">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary" name="reg_user">Submit</button>
                </div>
            </div>
        </form>
        <p class="mt-4">
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
</body>

</html>