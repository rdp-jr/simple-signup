<?php

class User {
  public $uid, $firstName, $lastName, $email, $phone;

  public function __construct($firstName, $lastName, $email, $phone) {
    // $this->uid = 'implement later';
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->phone = $phone;
  }
}


$user = new User('Juan', 'dela Cruz', 'juan.dcruz@gmail.com', '1234567890');
echo var_dump(get_object_vars($user));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple SignUp Form</title>
</head>
<body>
  
</body>
</html>