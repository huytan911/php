<?php
class ClientModel {
    var $connect;

    function __construct()
    {
        $this->connect = new mysqli('localhost', 'root', '', 'php2023');
    }

    function checkSignIn(){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $result = $this->connect->query("SELECT * FROM member WHERE username='$username' AND password='$password'");
        if(mysqli_num_rows($result)):
            return true;
        else:
            return false;
        endif;
    }
    function checkUsername(){
        $username = $_POST['username'];
        $result = $this->connect->query("SELECT * FROM member WHERE username='$username'");
        if(mysqli_num_rows($result)):
            return true;
        else:
            return false;
        endif;
    }
    function insertUser(){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $fullname = $_POST['fullname'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $this->connect->query("INSERT member(username, password, fullname, mobile, address, email) 
        VALUES('$username', '$password', '$fullname', '$mobile', '$address', '$email')");
    }
    function getProducts(){
        $query = "SELECT * FROM product WHERE status=1";
        if(isset($_GET['brandid'])){
            $query .= " AND brandid=".$_GET['brandid'];
        }
        return $this->connect->query($query);
    }

    function getBrands(){
        return $this->connect->query("SELECT * FROM brand WHERE status=1");
    }
} 
?>