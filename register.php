<?php
require_once('login_detail.php');
require_once('register_functions.php');
require_once('common_functions.php');

$name = $username = $password = $confirm_password = "";
$name_err = $username_err = $password_err = $confirm_password_err = '';


if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['username'])){
    $username = sanitizeString($_POST['username']);
  };
  if(isset($_POST['password'])){
    $password = sanitizeString($_POST['password']);
  };

  if(isset($_POST['confirm_password'])){
    $confirm_password = sanitizeString($_POST['confirm_password']);
  };

  $username_err = validate_username($username);
  $password_err = validate_password($password);
  $confirm_password_err = validate_confirmPassword($password,$confirm_password);

  echo $usertype;
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    $salt1 = "jau&2js"; $salt2 = "aow@ues";
  $token = hash('ripemd128', "$salt1$password$salt2");
    if($username!= "" && $password != "" && $confirm_password != "" ) {
      $connection = createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
      insertDonor($connection, $username, $password);
      $connection->close();
    }
  }
}

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
           <div class="card-body" id="registerCard">
             <p>Please fill out this form to register</p>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validate(this)" >
                <div class="form-group">
              <label for="username">Username</label>
              <input class="form-control" type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
                <span class="help-block text-danger"><?php echo $username_err; ?></span>
          </div>
          <div class="form-group">
            <label for="password">password</label>
            <input class="form-control" type="password" id="password" data-toggle="password" name="password" placeholder="Enter password" value="<?php echo $password; ?>">
              <span class="help-block text-danger"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Enter password again" value="<?php echo $confirm_password; ?>">
                <span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
            <br><br>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input class="form-control" type="text" name="location" placeholder="Enter the registered location" value="<?php echo $confirm_password; ?>">
                <span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
            <br><br>
        </div>
               <input type="submit" value="Register" name="register" class="btn btn-outline-primary btn-block">
             </form>
           </div>
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
