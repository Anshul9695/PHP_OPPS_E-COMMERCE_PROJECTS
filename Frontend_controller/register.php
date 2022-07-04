<?php
include_once 'database.php';
$errors = array();
if (isset($_POST['register'])) {

    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : NULL;
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : NULL;
    $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : NULL;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
    $email = isset($_POST['email']) ? $_POST['email'] : NULL;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : NULL;
    $profile = isset($_FILES['profile']) ? $_FILES['profile'] : NULL;
    //var_dump($profile);
    $password = isset($_POST['password']) ? $_POST['password'] : NULL;
    $confirm_pass = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : NULL;

    if (empty($first_name)) {
        array_push($errors, "Fill The first_name..");
    }
    if (empty($last_name)) {
        array_push($errors, "last_name empty.. ");
    }
    if (empty($birthday)) {
        array_push($errors, "birthday can't be Empty..");
    }
    if (empty($gender)) {
        array_push($errors, "Please fill the gender ....");
    }
    if (empty($email)) {
        array_push($errors, "email can't be empty..");
    }
    if (empty($phone)) {
        array_push($errors, "phone can't be Empty..");
    }
    if (empty($profile)) {
        array_push($errors, "Upload the profile ....");
    }
    if (empty($password)) {
        array_push($errors, "password can't be emapty");
    }
    if (empty($confirm_pass)) {
        array_push($errors, "password can't be emapty");
    }

    if ($password != $confirm_pass) {
        array_push($errors, "password and confirm password not matched");
    }
    if (count($errors) == 0) {
        $register_user = $Database->customer_register($first_name, $last_name, $birthday, $gender, $email, $phone, $profile, $password);
        if ($register_user) {
            header("location: login.php");
        } else {
            array_push($errors, "errors To Register user");
        }
    } else {
        array_push($errors, "Fill the all Fields");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Register : Mishra Shop</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form For Coustomers</h2>
                    <form method="POST" enctype="multipart/form-data" action="register.php">
                        <div>
                            <?php if (count($errors) > 0) : ?>
                                <div class="error">
                                    <?php foreach ($errors as $error) : ?>
                                        <p><?php echo $error ?></p>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="first_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birthday">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Products Image</label>
                            <input type="file" id="myFile" class="form-control" name="profile">
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password:</label>
                                    <input class="input--style-4" type="text" name="password">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirm Password</label>
                                    <input class="input--style-4" type="text" name="confirm_pass">
                                </div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="register">Register</button>
                        </div>
                        <p>
                            <a href="index.php">Back To Home</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->