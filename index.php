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
?>

<!DOCTYPE html>
<html lang="en" style="height:100%;">
  <head>
    <meta charset="utf-8">
    <title>Davis Pantry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/awesomplete.css">
    <script>
      const locationArray = <?php echo $location_array; ?>;
    </script>
    <script src="assets/js/awesomplete.js"></script>
    <script src="assets/js/locationinput.js"></script>
  </head>

  <body id="home-section">
    <?php require_once('assets/includes/header.html') ?>
    <!-- HOME SECTION -->
    <div class="container position-absolute" id="login-section">
      <div class="row">
        <div class="col mx-auto" style="max-width: 600px;">
          <div class="card card-form text-center mt-4">
            <div class="row">
              <div class="col text-center">
                <div class="card-body">
                  <h3 class="mb-3">Find food near your location</h3>
                  <form class="form-inline" method="post" action="results.php" onsubmit="return validate(this)">
                    <input class="form-control w-100" type="search" id="location" name="location" placeholder="Enter location!" aria-label="Search">
                    <input type="submit" value="Search" class="btn btn-outline-primary w-25">
                  </form>
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
