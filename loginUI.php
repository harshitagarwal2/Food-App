<?php
  require_once('login_detail.php');
  require_once('common_functions.php');
  require_once('genericLogin.php');

$username = $password = "";
$username_err = $password_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username = sanitizeString($_POST['username']);
  $password = sanitizeString($_POST['password']);
  $username_err = validate_username($username);
    $password_err = validate_password($password);
    $connection = createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
      validateDonor($connection,$username,$password);
      $connection->close();
};

?>

<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/loginUI.js"></script>
    <title>Pantry-Login</title>
  </head>
  <body id="home-section">
    <?php require_once('assets/includes/header.html') ?>
    <!-- HOME SECTION -->
    <div class="container position-absolute" id="login-section">
      <div class="row">
        <div class="col mx-auto" style="max-width: 600px;">
          <div class="card card-form text-center mt-4">
            <div class="card-body" id="loginCard">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  onsubmit="return validate(this)">
                          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                              <label>Username:<sup class="text-danger">*</sup></label>
                              <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                              <span class="help-block text-danger"><?php echo $username_err; ?></span>
                          </div>
                          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                              <label>Password:<sup class="text-danger">*</sup></label>
                              <input type="password" name="password" class="form-control">
                              <span class="help-block text-danger"><?php echo $password_err; ?></span>
                          </div>
                          <input type="submit" value="Log In" name="login" class="btn btn-outline-primary btn-block">
                        </form><br>

            </div>
            <br />
            <a href="register.php">Click Here to register</a>
          </div>
        </div>
      </div>
    </div>
    <footer class="bg-white position-absolute w-100" id="main-footer">
        <div class="container bg-faded">
          <div class="row">
            <div class="col text-center">
              <div class="py-2" id="footer-text">
                <h5>Davis Pantry</h5>
                <p>Copyright &copy; 2018</p>
              </div>
            </div>
          </div>
        </div>
    </footer>
  </body>
</html>
