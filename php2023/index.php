<?php session_start(); ?>
<?php $conn = new mysqli('localhost', 'root', '', 'shop_mobile')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/css.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" href="css/mdb.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Trang chủ</title>
</head>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<body>
    <?php
        if(isset($_GET['option'])):
            switch ($_GET['option']):
                case 'ordersuccess':
                    include "views/ordersuccess.php";
                    break;
                case 'signin';
                    include "views/signin.php";
                    break;
                case 'signup':
                    include "views/signup.php";
                    break;
                case 'logout':   
                    session_unset();
                    header("location: ?option=home");
                    break; 
                default:
                    include "views/home.php";
                    break;
            endswitch;
        else:
            include "views/home.php";
        endif;
    ?>
</body>
</html>