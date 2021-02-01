  <?php
    include 'header.php';
    if(isset($_SESSION['id'])){
        header("Location: index.php");
    }
    ?>

  <div class="jumbotron bg-secondary mt-2 mb-4 p-3">
      <h1 class="text-center">User Sign Up Page</h1>
  </div>
  <div class="container">
      <form method="post" action="save.php" novalidate>
          <div class="form-group">
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="firstname" class="mb-2">First name</label>
                      <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="<?php echo htmlspecialchars($firstname); ?>" required>
                      <span class="text-danger"><?php  if (isset($firstname_error)) echo $firstname_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="lastname" class="mb-2">Last name</label>
                      <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="<?php echo htmlspecialchars($lastname); ?>" required>
                      <span class="text-danger"><?php  if (isset($lastname_error)) echo $lastname_error; ?></span>
                  </div>
              </div>
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="age" class="mb-2">Age</label>
                      <input type="number" class="form-control" name="age" placeholder="Enter Your Age">
                      <span class="text-danger"><?php if (isset($age_error)) echo $age_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="email" class="mb-2">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                      <span class="text-danger"><?php  if (isset($email_error)) echo $email_error; ?></span>
                  </div>
              </div>
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="gender" class="mb-2">Gender</label>
                      <br>
                          <input type="radio" name="gender" value="male"> Male
                          <input type="radio" name="gender" value="female"> Female
                          <input type="radio" name="gender" value="other"> Other
                      <span class="text-danger"><?php  if (isset($gender_error)) echo $gender_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="occupation" class="mb-2">Occupation</label>
                      <input type="text" class="form-control" name="occupation">
                      <span class="text-danger"><?php  if (isset($occupation_error))  echo $occupation_error; ?></span>
                  </div>
              </div>
              <div class="row mt-3 p-1">
                  <div class="col-md-6">
                      <label for="password" class="mb-2">Password</label>
                      <input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                      <span class="text-danger"><?php  if (isset($password_error))  echo $password_error; ?></span>
                  </div>
                  <div class="col-md-6">
                      <label for="confirm_password" class="mb-2">Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                  </div>
                  <span class="text-danger"><?php   if (isset($confirmpassword_error)) echo $confirmpassword_error; ?></span>
              </div>
              <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary" name="reg_user">Submit</button>
                  <button type="reset" class="btn btn-primary  ml-2">Reset</button>
              </div>
          </div>
      </form>
      <p class="mt-4">
          Already a member? <a href="login.php">Sign in</a>
      </p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  </body>

  </html>