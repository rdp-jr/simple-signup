<?php
include 'classes/user.php';

class UserCleaner {
  private $user;
  private $errors = [];

  public function __construct($data) {
    $this->user = new User($data['firstName'], $data['lastName'], $data['email'], $data['phone']);
  }

  public function validate() {

    $requiredFields = ['firstName', 'email'];
    
    $r = new ReflectionClass($this->user);
    foreach($requiredFields as $requiredField) {

      $p = $r->getProperty($requiredField);  
      $p->setAccessible(true);

      if (empty($p->getValue($this->user))) {
        $this->AddError($requiredField, "$requiredField is missing");
        return;
      }
    }
  
  if (!empty($this->errors)) {
    return $this->errors;
  }  

  $this->cleanFirstName();  
  $this->cleanLastName();  
  $this->cleanEmail();  
  $this->cleanPhone();  
  return $this->errors;
  
  }

  private function cleanFirstName() {
    $clean = filter_var($this->user->getFirstName(), FILTER_SANITIZE_STRING);
    $this->user->setFirstName($clean);
  }

  private function cleanLastName() {
    if (!empty($this->user->getLastName())) { 
      $clean = filter_var($this->user->getLastName(), FILTER_SANITIZE_STRING);
      $this->user->setLastName($clean);
    }
  }

  private function cleanEmail() {
    $clean = filter_var($this->user->getEmail(), FILTER_SANITIZE_EMAIL);
    $check = filter_var($clean, FILTER_VALIDATE_EMAIL);

    if ($check != false) {
      $this->user->setEmail($clean);
    } else {
      $this->AddError('email', 'Email is invalid');
    }
  }

  private function cleanPhone() {
    if (!empty($this->user->getPhone())) {
      $clean = filter_var($this->user->getPhone(), FILTER_SANITIZE_NUMBER_INT);
      $check = filter_var($clean, FILTER_VALIDATE_INT);

      if ($check != false) {
        $this->user->setPhone($clean);
      } else {
        $this->AddError('phone', 'Phone number is invalid');
      }
    }
  }

  private function AddError($field, $msg) {
    $this->errors[$field] = $msg;
  }

  public function getArray() {
    
    $data = array (
      'uid' => $this->user->getUid(),
      'firstName' => $this->user->getFirstName(),
      'lastName' => $this->user->getLastName(),
      'email' => $this->user->getEmail(),
      'phone' => $this->user->getPhone()
    );

    return $data;
  }

}

?>