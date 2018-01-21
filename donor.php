<?php
require_once('login_detail.php');
require_once('common_functions.php');
require_once('donor_functions.php');

session_start();

// If session variable is not set it will redirect to login page
if(isset($_SESSION['username']) || !empty($_SESSION['username']))
{

$username = $_SESSION['username'];
$password = $_SESSION['password'] ;
$connection = createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
validateSession($connection,$username,$password);
$connection->close();
}
else{
header("location: login.php");
exit;
};


?>

<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="utf-8">
    <title>Davis Pantry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body id="home-section">

    <nav id="header-section" class="navbar fixed-top navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="index.php">Home</a>
        <ul id="login" class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
        <a id="user" class="d-none" href="user.php">username</a>
      </div>
    </nav>

    <!-- HOME SECTION -->
    <div class="container" id="login-section">
      <div class="row">
        <div class="col mx-auto" style="max-width: 600px;">
          <div class="card card-form text-center mt-4">
            <div class="row">
              <div class="col">
                <div class="card-body">
                  <h1 class="mb-3 text-center">Food Posting</h1>
                    <form class="mx-auto" method="POST" action="" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="text" class="form-control" name="foodDesc" placeholder="Food Description">
                      </div>
                      <div class="form-group text-left">
                        <label for="picture">Upload a photo of the food</label>
                        <input type="file" class="form-control-file" name="foodPic">
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
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
