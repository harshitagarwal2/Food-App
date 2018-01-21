<?php
require_once('login_detail.php');
require_once('common_functions.php');
require_once('donor_functions.php');

session_start();

$donorid = $description = $foodPic = $location= "";
// If session variable is not set it will redirect to login page
if(isset($_SESSION['username']) || !empty($_SESSION['username']))
{

$username = $_SESSION['username'];
$password = $_SESSION['password'] ;
$connection = createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
validateSession($connection,$username,$password);
$text = getDonorID($connection,$username,$password);
$a = explode(',' , $text);
$donorid = $a[0];
$connection->close();
}
else{
header("location: login.php");
exit;
};

// Store the information into variable $description
if(isset($_POST['foodDesc'])){
  $description = fix_string($_POST["foodDesc"]);
}

if(isset($_POST['foodpic'])){
 $foodPic = fix_string($_POST["foodpic"]);
}

if(isset($_POST['location'])){
 $location = fix_string($_POST["location"]);
}

function fix_string($string) {
  if (get_magic_quotes_gpc()) $string = stripslashes($string);
   return htmlentities ($string);
 }

if(isset($_POST['submit'])){
  global $description,$foodPic,$location ;
  $connection= createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
  insertData($GLOBALS['description'],$GLOBALS['foodPic'],$connection,$GLOBALS['donorid'], $GLOBALS['location']);
}

function insertData($description,$foodPic,$conn,$donorid,$location){
  $donorid= mysql_entities_fix_string($conn,$donorid);
  $description= mysql_entities_fix_string($conn, $description);
  $foodPic = mysql_entities_fix_string($conn,$foodPic);
  $location = mysql_entities_fix_string($conn,$location);
  $sql = "INSERT INTO foodlist (donorid, description, foodPic, location)
    VALUES ('$donorid', '$description', '$foodPic', '$location')";
    $result = $conn->query($sql);
    if (!$result) die ("Database access failed: " . $conn->error);
      else{
        echo "saved";
      }
}

?>

<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="utf-8">
    <title>Access</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body id="home-section">

    <?php require_once('assets/includes/header.html') ?>

    <!-- HOME SECTION -->
    <div class="container" id="login-section">
      <div class="row">
        <div class="col mx-auto" style="max-width: 600px;">
          <div class="card card-form text-center mt-4">
            <div class="row">
              <div class="col">
                <div class="card-body">
                  <h1 class="mb-3 text-center">Food Posting</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validate(this)" >
                        <div class="form-group">
                        <input type="text" class="form-control" name="foodDesc" placeholder="Food Description">
                      </div>
                      <div class="form-group text-left">
                        <label for="picture">Upload a photo of the food</label>
                        <input type="file" class="form-control-file" name="foodpic">
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
    <?php require_once('assets/includes/footer.html') ?>
  </body>
</html>
