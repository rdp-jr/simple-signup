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
    $clean = trim($this->user->getFirstName());
    if (empty($clean)) {
      $this->AddError('firstName', 'First Name must not be empty');
      return;
    }
    $clean = filter_var($clean, FILTER_SANITIZE_STRING);
    if (preg_match('/[a-zA-Z][a-zA-Z ]+/', $clean)) {
      $this->user->setFirstName($clean);
    } else {
      $this->AddError('firstName', 'First Name must be letters only');
    }
  }

  private function cleanLastName() {
    if (!empty($this->user->getLastName())) { 
      $clean = trim($this->user->getLastName());
      if (empty($clean)) {
        $this->user->setLastName('');
        return;
      }
      $clean = filter_var($clean, FILTER_SANITIZE_STRING);
      if (preg_match('/[a-zA-Z][a-zA-Z ]+/', $clean)) {
        $this->user->setLastName($clean);
      } else {
        $this->AddError('lastName', 'Last Name must be letters only');
      }
    }
  }

  private function cleanEmail() {
    $clean = trim($this->user->getEmail());
    $clean = filter_var($clean, FILTER_SANITIZE_EMAIL);
    $check = filter_var($clean, FILTER_VALIDATE_EMAIL);
    if ($check != false) {
      $this->user->setEmail($clean);
    } else {
      $this->AddError('email', 'Email is invalid');
    }
  }

  private function cleanPhone() {
    if (!empty($this->user->getPhone())) {
      $clean = trim($this->user->getPhone());
      $clean = filter_var($clean, FILTER_SANITIZE_NUMBER_INT);
      $minimumLength = 5;
      $maximumLength = 10;
      if (strlen($clean) < $minimumLength) {
        $this->AddError('phone', 'Phone number is too short');
        return;
      } else if (strlen($clean) > $maximumLength) {
        $this->AddError('phone', 'Phone number is too long');
        return;
      }
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
      'id' => $this->user->getId(),
      'firstName' => $this->user->getFirstName(),
      'lastName' => $this->user->getLastName(),
      'email' => $this->user->getEmail(),
      'phone' => $this->user->getPhone()
    );
    return $data;
  }
}

?>