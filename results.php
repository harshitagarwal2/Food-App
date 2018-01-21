<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Davis Pantry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/results.js"></script>
  </head>
  <body class="bg-light">
    <?php include("assets/includes/header.html");?>
    <div class="container mt-5 pt-4">
      <div class="row">
        <div class="col text-center">
          <form class="form-inline mb-4 mx-auto" method="post" action="" onsubmit="return validate(this)" style="max-width:600px;">
            <input class="form-control w-75" type="search" value="[Location entered]" aria-label="Search">
            <input type="submit" value="Search" class="btn btn-outline-primary w-25">
          </form>
          <h3>Results near <span id="result-location"></span></h3>
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
