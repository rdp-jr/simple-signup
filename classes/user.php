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
?>