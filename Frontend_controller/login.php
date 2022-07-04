<?php
session_start();
include_once 'database.php';
$errors = array();

if (isset($_POST['login_user'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];


  if (empty($email)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $result = $Database->login($email, $password);
    if ($result) {
      $_SESSION['email']=$email;
      header("location: dashboard.php");
     
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>


<html>

<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="../Admin_conntroller/view/assets/css/style.css">
</head>

<body>
  <div class="header">
    <h2>Login</h2>
  </div>

  <form method="post">
    <?php if (count($errors) > 0) : ?>
      <div class="error">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error ?></p>
        <?php endforeach ?>
      </div>
    <?php endif ?>

    <div class="input-group">
      <label>Username</label>
      <input type="text" name="email">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
       <a href="index.php">Back To Home</a>
    </p>
  </form>
</body>

</html>