<?php

class Database{
    private $connection;
    public function __construct()
    {
        $this->connect_db();
    }
    public function connect_db(){
        $this->connection =mysqli_connect('localhost','root','rootdb','Admin_controller_database');
       
        if(mysqli_connect_error()){
         die("Database Connection error " .mysqli_connect_error().mysqli_connect_errno());
        }
    }

public function create($username,$email,$password_1){
    $sql_select="SELECT * FROM admin_register WHERE email='$email'";
    $check_exist=mysqli_query($this->connection,$sql_select);
    $result=mysqli_num_rows($check_exist); 
 
    if ($result == 0) {  
        $sql="INSERT INTO admin_register (user_name,email,password) VALUES ('$username','$email','$password_1')";
        $register=mysqli_query($this->connection,$sql); 
        return $register;
    } else {  
        return false;  
    }  
}

public function login($email, $password) {  

    $sql_select="SELECT * FROM admin_register WHERE email='$email' AND password='$password'";
    $check_exist=mysqli_query($this->connection,$sql_select);
    $result=mysqli_num_rows($check_exist); 

    if ($result == 1) {  
     return true;
    } else {  
        return false;  
    }  
} 


}
$Database=new Database;


?>