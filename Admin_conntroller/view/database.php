<?php

class Database
{
    private $connection;
    public function __construct()
    {
        $this->connect_db();
    }
    public function connect_db()
    {
        $this->connection = mysqli_connect('localhost', 'root', 'rootdb', 'Admin_controller_database');

        if (mysqli_connect_error()) {
            die("Database Connection error " . mysqli_connect_error() . mysqli_connect_errno());
        }
    }

    public function create($username, $email, $password_1)
    {
        $sql_select = "SELECT * FROM admin_register WHERE email='$email'";
        $check_exist = mysqli_query($this->connection, $sql_select);
        $result = mysqli_num_rows($check_exist);

        if ($result == 0) {
            $sql = "INSERT INTO admin_register (user_name,email,password) VALUES ('$username','$email','$password_1')";
            $register = mysqli_query($this->connection, $sql);
            return $register;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {

        $sql_select = "SELECT * FROM admin_register WHERE email='$email' AND password='$password'";
        $check_exist = mysqli_query($this->connection, $sql_select);
        $result = mysqli_num_rows($check_exist);

        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }



    // CREATE THE CATEGORY HER..............

    public function create_category($category_name, $category_discription)
    {

        $sql_select = "SELECT * FROM category WHERE category_name='$category_name'";
        $check_exist = mysqli_query($this->connection, $sql_select);
        $result = mysqli_num_rows($check_exist);
        if ($result == 0) {
            $sql = "INSERT INTO category (category_name,category_discription) VALUES('$category_name','$category_discription')";
            $result_query = mysqli_query($this->connection, $sql);
            return $result_query;
        } else {
            return false;
        }
    }

    public function category_list()
    {
        $sql = "SELECT * FROM category";
        $select = mysqli_query($this->connection, $sql);

        if ($select->num_rows > 0) {
            return $select;
        } else {
            return false;
        }
    }


    //CREATE PRODUCTS .................
    public function create_products($product_name, $proudct_desc, $product_price, $category_id, $product_image)
    {

        //print_r($product_image);

        $allow = array('jpg', 'jpeg', 'png');
        $exntension = explode('.', $product_image['name']);
        $fileActExt = strtolower(end($exntension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'assets/products_images/' . $fileNew;
     
        if (in_array($fileActExt, $allow)) {
            if ($product_image['size'] > 0 && $product_image['error'] == 0) {
                if (move_uploaded_file($product_image['tmp_name'], $filePath)) {

                    $sql = "INSERT INTO products (products_name,products_description,products_price,category_id,product_image) VALUES ('$product_name','$proudct_desc','$product_price','$category_id','$fileNew')";
                   // echo $sql;
                    $result = mysqli_query($this->connection, $sql);
                    if ($result) {
                        return true;
                    } else {
                      return false;
                    }
                }
            }
        }
    }
// public function get_category_by_id($category_id){
//     $sql="SELECT category_name where category_id='$category_id'";
//     $select=mysqli_query($this->connection,$sql);
//     if($select->num_rows>0){
//         return $select;
//     }else{
//         return false;
//     }
// }

    public function Display_products(){
        $sql="SELECT * FROM products
        INNER JOIN category ON products.category_id=category.category_id;";
        $get_products=mysqli_query($this->connection,$sql);
        if($get_products->num_rows>0){
            return $get_products;
        }else{
            return false;
        }
    }
}
$Database = new Database;
