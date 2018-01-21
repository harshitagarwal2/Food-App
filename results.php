<?php
  require_once('login_detail.php');
  require_once('common_functions.php');

  // Get locations
  $connection = createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
  $sql = "SELECT DISTINCT location FROM donor";
  $result = $connection->query($sql);
  if (!$result) die($connection->error);
  elseif ($result->num_rows) {
    $i = 0;
    $rows = array();
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $rows[$i] = $row[0];
      $i = $i + 1;
    }
    $location_array = json_encode($rows);
    $result->close();
  }
  $connection->close();

  // Get food
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = sanitizeString($_POST['location']);
    $connection = createConnection($GLOBALS['hostname'],$GLOBALS['database'], $GLOBALS['username_db'],$GLOBALS['password_db']);
    $sql_location = mysql_entities_fix_string($connection, $location);
    $sql = "SELECT d.username, d.location, f.foodPic, f.description FROM foodlist f, donor d WHERE f.donorid=d.userid && d.location = '$sql_location'";
    $result = $connection->query($sql);
    if (!$result) die($connection->error);
    elseif ($result->num_rows) {
      $i = 0;
      $rows = array();
      while($row = $result->fetch_array(MYSQLI_NUM)) {
        $rows[$i] = $row;
        $i = $i + 1;
      }
      $json_array = json_encode($rows);
      $result->close();
    }
    else {
      $location = "No food found!";
      $json_array = "[]";
    }
    $connection->close();
  } else {
    $location = "Enter a location!";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Access</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/awesomplete.css">
    <script>
      const locationArray = <?php echo $location_array; ?>;
      const initialResults = <?php echo $json_array; ?>;
    </script>
    <script src="assets/js/awesomplete.js"></script>
    <script src="assets/js/results.js"></script>
    <script src="assets/js/locationinput.js"></script>
  </head>
  <body id="results-body">
    <?php include("assets/includes/header.html");?>
    <div class="container mt-5 pt-4">
      <div class="row">
        <div class="col text-center">
          <form class="form-inline mb-4 mx-auto" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" onsubmit="return validate(this)" style="max-width:600px;">
            <input class="form-control w-100" type="search" id="location" name="location" value="<?php echo $location; ?>" aria-label="Search">
            <input type="submit" value="Search" class="btn btn-outline-primary w-25">
          </form>
          <h3>Results near <b>"<?php echo $location; ?>"</b></h3>
          <p>Found <span id="result-num"></span> results!</p>
        </div>
      </div>

      <div class="row">
        <div class="col mx-auto px-0" style="max-width:600px;" id="result-wrap">
        </div>
      </div>
    </div>
  </body>
</html>
