<?php
require_once 'login_detail.php';

function validateDonor($connection,$username,$password )
{
  $sql_username =  mysql_entities_fix_string($connection, $username);
  $sql_password =  mysql_entities_fix_string($connection, $password);
  $sql = "SELECT * FROM donor WHERE username = '$sql_username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $result->close();
          $salt1 = "jau&2js"; $salt2 = "aow@ues";
        $token = hash('ripemd128', "$salt1$sql_password$salt2");
          if($token == $row[2])  {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password']=$token;
               header("location: donor.php");
        }
        else die("Invalid username/password combination");
      }
      else die("Invalid username/password combination");
}

function validate_username($field) {
return ($field == "") ? "No Username was entered.\n" : "";
};
function validate_password($field) {
return ($field == "") ? "Please Enter your Password.\n" : "";
};
 ?>
