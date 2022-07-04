<?php
class Database{
    private $connection;
    public function __construct()
    {
        $this->connection_db();
    }
    public function connection_db(){
        $this->connection=mysqli_connect('localhost','root','rootdb','Admin_controller_database');
        if(mysqli_connect_error()){
            die("database connecion error".mysqli_connect_error().mysqli_connect_errno());
        }
    }
public function get_all_product(){
    $sql="SELECT * FROM products LIMIT 8";
    $result=mysqli_query($this->connection,$sql);
    if($result->num_rows>0){
        return $result;
    }else{
        return false;
    }
}
public function just_arrived(){
    $sql="SELECT * FROM products ORDER BY product_id DESC LIMIT 8";
    $result=mysqli_query($this->connection,$sql);
    if($result->num_rows>0){
        return $result;
    }else{
        return false;
    }    
}
public function get_category(){
    $sql="SELECT * FROM category";
    $result=mysqli_query($this->connection,$sql);
   if($result->num_rows>0){
       return $result;
   }else{
       return false;
   }
}
public function shop_products(){
    $sql="SELECT * FROM products";
    $result=mysqli_query($this->connection,$sql);
    if($result->num_rows>0){
        return $result;
    }else{
        return false;
    }
}

public function get_product_by_id($product_id){
    $sql="SELECT * FROM products WHERE product_id='$product_id'";
    $result=mysqli_query($this->connection,$sql);
    if($result->num_rows>0){
        return $result;
    }else{
        return false;
    }
}

}
$Database=new Database;
?>