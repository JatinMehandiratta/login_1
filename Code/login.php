<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php
    if (isset($_GET['notregiterederr'])) {
        echo '<div class="alert alert-danger">This User is not registered with us ! Please Register First</div>';
    };
    if (isset($_GET['invalidLogin'])) {
        echo '<div class="alert alert-danger">Wrong username/password combination</div>';
    };
    ?>
    <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
        <h1 class="text-center">User Login Page</h1>
    </div>

    <form method="post" action="loginUser.php">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control mt-2 mb-2 p-2" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control mt-2 mb-2 p-2" required>
        </div>
        <div class="form-group mt-2 mb-2 p-2">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            Not yet a member? <a href="signup.php">Sign up</a>
        </p>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
</body>

</html>