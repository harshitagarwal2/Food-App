<?php

function validateSession($connection,$username,$password){
  $sql_username =  mysql_entities_fix_string($connection, $username);
  $sql_password =  mysql_entities_fix_string($connection, $password);
  $sql = "SELECT * FROM donor WHERE username = '$sql_username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $result->close();
          if($password != $row[2])  {
            die("Sorry Some Error occured-User not authorized Please login again <a href=loginUI.php>Click Here to Login</a> ");
          }
        else "";
      }
      else die("Sorry Some Error occured-User not authorized Please login again <a href=loginUI.php>Click Here to Login</a> ");
}


?>
