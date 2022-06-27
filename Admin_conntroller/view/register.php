<?php
include_once 'database.php';

// initializing variables
$username = "";
$email    = "";
$errors = array(); 



// REGISTER USER
if (isset($_POST['reg_user'])) {
  
  // receive all input values from the form
  $username = isset($_POST['username'])?$_POST['username']:NULL;
  $email = isset($_POST['email'])?$_POST['email']:NULL;
  $password_1 = isset($_POST['password_1'])?$_POST['password_1']:NULL;
  $password_2 = isset($_POST['password_2'])?$_POST['password_2']:NULL;

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0){
    $register = $Database->create($username,$email,$password_1);  
   
    if($register){  
      header("location: index.php");
    }
    else
    {  
      array_push($errors, "Email Already exist");
    }  
}
}
?>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('error.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  </form>
</body>
</html>