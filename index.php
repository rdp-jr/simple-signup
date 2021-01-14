<?php

class User {
  private $uid, $firstName, $lastName, $email, $phone;

  public function __construct($firstName, $lastName, $email, $phone) {
    // $this->uid = 'implement later';
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->phone = $phone;
  }

  public function getUid() {
    return $this->uid;
  }

  public function getFirstName() {
    return $this->firstName;
  } 

  public function getLastName() {
    return $this->lastName;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setPhone($phone) {
    $this->phone = $phone;
  }

}


$user = new User('Juan', 'dela Cruz', 'juan.dcruz@gmail.com', '1234567890');

echo $user->getEmail() . '<br>';
$user->setLastName('Doe');
echo $user->getLastName();

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