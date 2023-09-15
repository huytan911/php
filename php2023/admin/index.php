<?php session_start() ?>
<?php $connect = new mysqli('localhost', 'root', '', 'shop_mobile') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/css.css"/>
    <script src="../public/ckeditor/ckeditor.js"></script>
    <title>ADMIN</title>
</head>
<body>
    <?php 
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $result = $connect->query($query);
            if (mysqli_num_rows($result) == 0){
                $alert = "Sai tên đăng nhập hoặc mật khẩu";
            } 
            else {
                $result = mysqli_fetch_array($result);
                if ($result['status'] == 0) {
                    $alert = "Tài khoản đã bị khóa";
                }
                else {
                    $_SESSION['admin'] = $username;
                    header("Refresh: 0");
                }
            }
        }
    ?>    
<section>
    <?php 
    if(isset($_SESSION['admin'])){
        include "admincontrolpanel.php";
    }
    else {
        include "loginadmin.php";
    }
    
    ?>
</section>
</body>
</html>