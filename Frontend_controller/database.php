<?php
class Front_Database
{
    public $connection;
    public function __construct()
    {
        $this->connection_db();
    }

    public function connection_db()
    {
        $this->connection = mysqli_connect('localhost', 'root', 'rootdb', 'User_controller_database');
        // echo 'connection created sussfully';
        if (mysqli_connect_error()) {
            die("Database connection Error" . mysqli_connect_error() . mysqli_connect_errno());
        }
    }

    public function customer_register($first_name, $last_name, $birthday, $gender, $email, $phone, $profile, $password)
    {
        $sql_select = "SELECT * FROM user_register WHERE email='$email'";
        $check_exist = mysqli_query($this->connection, $sql_select);
        $result = mysqli_num_rows($check_exist);
        if ($result == 0) {
            //
            // $sql = "INSERT INTO user_register (first_name,last_name,birthday,gender,email,phone,profile,password) VALUES ('$first_name','$last_name','$birthday','$gender','$email','$phone','$profile','$password')";
            // $register = mysqli_query($this->connection, $sql);
            // return $register;
            $allow = array('jpg', 'jpeg', 'png');
            $exntension = explode('.', $profile['name']);
            $fileActExt = strtolower(end($exntension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'img/user_profile/' . $fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($profile['size'] > 0 && $profile['error'] == 0) {
                    if (move_uploaded_file($profile['tmp_name'], $filePath)) {

                        $sql = "INSERT INTO user_register (first_name,last_name,birthday,gender,email,phone,profile,password) VALUES ('$first_name','$last_name','$birthday','$gender','$email','$phone','$fileNew','$password')";
                        // echo $sql;
                        // die;
                        $register = mysqli_query($this->connection, $sql);
                        if ($register) {
                            return $register;
                        } else {
                            return false;
                        }
                    }
                }
            }
        } else {
            ///
            return false;
        }
    }
    public function login($email,$password){
        $sql="SELECT * FROM user_register WHERE email='$email' AND password='$password'";
        $check_exist=mysqli_query($this->connection,$sql);
        $result=mysqli_num_rows($check_exist);
        if($result==1){
            return true;
        }else{
            return false;
        }
    }
}
$Database = new Front_Database;
