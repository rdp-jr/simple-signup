<?php
require 'cleaner.php';

if (isset($_POST['submit'])) {
  $newUser = new UserCleaner($_POST);
  $errors = $newUser->validate();

  if (empty($errors)) {
    $success = true;

    $url = 'https://webhook.site/731d0359-b527-48c8-947e-2eaff42c5241';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    
    $formData = $newUser->getArray();

    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($formData));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $res = curl_exec($curl);
    curl_close($curl);
    
  } 
}
  if (!isset($errors)) {
    $errors = [];
  }

  $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : "";
  $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : "";
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
  $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";

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
      <?php if(isset($success)):  ?>
            <div class="alert alert-success" role="alert">
              Sign Up successful!
            </div>
          <?php endif; ?>
        <div class="form-group">
          <label for="firstName">First Name <small class="text-muted">(required)</small></label>
          <input type="text" class="form-control" id="firstName" name="firstName" required value="<?php echo $firstName; ?>">

          <?php if(array_key_exists('firstName', $errors)):  ?>
            <small class="text-danger">
              <?php echo $errors['firstName']; ?>
            </small>
          <?php endif; ?>
        </div>

        <div class="form-group">

         

          <label for="lastName">Last Name <small class="text-muted">(optional)</small></label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">

          <?php if(array_key_exists('lastName', $errors)):  ?>
            <small class="text-danger">
              <?php echo $errors['lastName']; ?>
            </smal>
          <?php endif; ?>
        </div>

        <div class="form-group">

          

          <label for="email">Email <small class="text-muted">(required)</small></label>
          <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">

          <?php if(array_key_exists('email', $errors)):  ?>
            <small class="text-danger">
              <?php echo $errors['email']; ?>
            </small>
          <?php endif; ?>

        </div>

        <div class="form-group">
          <label for="phone">Phone Number <small class="text-muted">(optional)</small></label>
          <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">

          <?php if(array_key_exists('phone', $errors)):  ?>
            <small class="text-danger">
              <?php echo $errors['phone']; ?>
            </small>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary w-100" value="submit" name="submit">Submit</button>
        
      </form>
    </div>


    <a href="https://webhook.site/#!/731d0359-b527-48c8-947e-2eaff42c5241/bb6a7505-a70c-4ca7-859c-c012d5fdb5e8/1" target="_noblank">View Webhook.site</a>

  </div>

</body>
</html>