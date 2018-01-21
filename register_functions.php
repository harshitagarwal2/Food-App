<?php

  $reg_username = $reg_password = $location = "";
  if(isset($_POST['reg_username'])){
    $reg_username = fix_string($_POST["reg_username"]);
  }

  if(isset($_POST['reg_password'])){
   $reg_password = fix_string($_POST["reg_password"]);
  }

  if(isset($_POST['location'])){
   $location = fix_string($_POST["location"]);
  }

  $fail = validate_username($reg_username);
  $fail .= validate_password($reg_password);



  function validate_username($field) {
  return ($field == "") ? "No Username was entered.\n" : "";
  };
  // Function for PHP validation of the submitted Password field if it's entered or not.
  function validate_password($field) {
  return ($field == "") ? "Please Enter your Password.\n" : "";
  };

//Checking if both the passwords are same or not from the given field.
function validate_confirmPassword($password,$confirm_password) {
  if(empty($confirm_password)) return 'Please enter confirm password.';
  else if($password != $confirm_password) return 'Password did not match.';
  else return "";
};

  function insertDonor($conn, $username, $password){
    $username= mysql_entities_fix_string($conn, $username);
    $password= mysql_entities_fix_string($conn,$password);
    $salt1 = "jau&2js"; $salt2 = "aow@ues";
    $token = hash('ripemd128', "$salt1$password$salt2");
    $sql = "INSERT INTO donor VALUES (NULL,'$username','$token')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header('location: loginUI.php');

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }



?>
