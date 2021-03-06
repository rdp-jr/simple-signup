<?php
require 'cleaner.php';

if (isset($_POST['submit'])) {
  $newUser = new UserCleaner($_POST);
  $errors = $newUser->validate();

  if (empty($errors)) {
    $success = true;

    $url = 'https://webhook.site/d70961c9-0789-4f34-bfad-0d6f30dcc3c7';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    
    $formData = $newUser->getArray();

    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($formData));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $res = curl_exec($curl);
    curl_close($curl);

    $_POST = array();
    
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
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
  <body>
    <div class="container">
      <div class="bg-white mt-5 rounded shadow w-50 mx-auto">
        <h1 class="text-center font-weight-bold pb-2 pt-2">Sign Up</h1>
          <div class="d-flex justify-content-center" >
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
              <?php if(isset($success)):  ?>
                <div class="alert alert-success" role="alert">
                  Sign Up successful!
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="firstName" class="font-weight-bold">First Name <small class="text-muted">(required)</small></label>
                <input type="text" class="form-control" id="firstName" name="firstName" required value="<?php echo $firstName; ?>">
                <?php if(array_key_exists('firstName', $errors)):  ?>
                  <small class="text-danger">
                    <?php echo $errors['firstName']; ?>
                  </small>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="lastName" class="font-weight-bold">Last Name <small class="text-muted">(optional)</small></label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
                <?php if(array_key_exists('lastName', $errors)):  ?>
                  <small class="text-danger">
                    <?php echo $errors['lastName']; ?>
                  </smal>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="email" class="font-weight-bold">Email <small class="text-muted">(required)</small></label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
                <?php if(array_key_exists('email', $errors)):  ?>
                  <small class="text-danger">
                    <?php echo $errors['email']; ?>
                  </small>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="phone" class="font-weight-bold">Phone Number <small class="text-muted">(optional)</small></label>
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

          
          <div class="text-center pb-3 pt-3">
          <a class="mx-auto" href="https://webhook.site/#!/d70961c9-0789-4f34-bfad-0d6f30dcc3c7" target="_noblank">View Webhook.site</a>
          </div>
        </div>
    </div>
  </body>
</html>