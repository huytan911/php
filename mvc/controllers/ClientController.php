<?php
include "models/ClientModel.php";

class ClientController {
    var $cm;
    var $brands;
    function __construct(){
        $this->cm = new ClientModel();
        $this->brands = $this->cm->getBrands();
    }

    // function getActiveBrands(){
    //     $brands = $this->cm->getBrands();
    //     return $brands;
    // }


    function routes() {
        if(isset($_GET['request'])):
            switch ($_GET['request']):
                case 'view':
                    $products = $this->cm->getProducts();
                    include "views/home.php";
                    break;
                case 'home':
                    $products = $this->cm->getProducts();    
                    include "views/home.php";
                    break;
                case 'news':    include "views/news.php";    break;
                case 'feedback':    include "views/feedback.php";    break;
                case 'cart':    include "views/cart.php";    break;
                case 'signin':
                    if (isset($_POST['username'])):
                        if(!$this->cm->checkSignIn()):
                            $alert = "Wrond username or password";
                            include "views/signin.php";
                        else:
                            $_SESSION['user'] = $_POST['username'];
                            header("location: ?request=home");
                        endif;
                    else:
                        include "views/signin.php";
                    endif;
                    break;
                case 'signup':    
                    if(isset($_POST['username'])):
                        if($this->cm->checkUsername()):
                            $alert = "This username was exsited! Please try another.";
                        else:
                            $this->cm->insertUser();
                            header("location: ?request=signin");
                        endif;
                    endif;
                    include "views/signup.php";
                    break;
                case 'logout': 
                    unset($_SESSION['user']);
                    header("location: ?request=home");
                    break;
            endswitch;
        else:
            $products = $this->cm->getProducts();    
            include "views/home.php";
        endif;
    }
}
?>