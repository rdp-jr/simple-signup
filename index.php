<?php
require 'cleaner.php';

if (isset($_POST['submit'])) {
  $newUser = new UserCleaner($_POST);
  $errors = $newUser->validate();
  echo print_r($errors);

  if (empty($errors)) {
    echo 'no errors';
  } else {
    echo 'there are errors!';
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Sign Up Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  
</head>
<body>
  <div class="container">
  <h1 class="text-center">Simple Sign Up</h1>
    <div class="d-flex justify-content-center">
    
      <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-group">
          <label for="firstName">First Name <small class="text-muted">(required)</small></label>
          <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>

        <div class="form-group">
          <label for="lastName">Last Name <small class="text-muted">(optional)</small></label>
          <input type="text" class="form-control" id="lastName" name="lastName">
        </div>

        <div class="form-group">
          <label for="email">Email <small class="text-muted">(required)</small></label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number <small class="text-muted">(optional)</small></label>
          <input type="text" class="form-control" id="phone" name="phone">
        </div>

        <button type="submit" class="btn btn-primary w-100" value="submit" name="submit">Submit</button>
        
      </form>
    </div>
  </div>

</body>
</html>