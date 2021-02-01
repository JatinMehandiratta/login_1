    <?php include 'header.php';
    if(isset($_SESSION['id'])){
        header("Location: index.php");
    }
    if (isset($_GET['logoutsuccess'])) {
        echo '<div class="alert alert-success">Log Out Successfull</div>';
    };
    if (isset($_GET['combinationerror'])) {
        echo '<div class="alert alert-danger">Wrong Email Id and Password combination</div>';
    };
    ?>
    <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
        <h1 class="text-center">User Login Page</h1>
    </div>

    <form method="post" action="loginUser.php">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control mt-2 mb-2 p-2" value="<?php echo $email; ?>">
            <span class="text-danger"><?php if(isset($email_error)) echo $email_error; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control mt-2 mb-2 p-2">
            <span class="text-danger"><?php  if(isset($password_error)) echo $password_error; ?></span>
        </div>
        <div class="form-group mt-2 mb-2 p-2">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="signup.php">Sign up</a>
        </p>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    </body>

    </html>